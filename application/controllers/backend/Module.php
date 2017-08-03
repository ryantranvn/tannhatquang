<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/backend/Root.php')) {
    require_once(APPPATH . 'controllers/backend/Root.php');
}

class Module extends Root {

	public function __construct()
    {
        parent::__construct();
        $this->currentModule = $this->data['modules'][ucfirst($this->router->fetch_class())];
        $this->data['varJS']['currentModule'] = $this->currentModule;
    // load
        $this->load->model($this->currentModule['control_name'].'_model', 'model');

        $this->data['activeModule'] = $this->currentModule['control_name'];
        $this->data['activeNav'] = $this->currentModule['control_name'];
        $this->data['breadcrumb'][0] = array('name'=>$this->currentModule['control_name'], 'url' => B_URL . $this->currentModule['url']);
    // block js and css
        // array_push($this->data['cssBlock'], '<link rel="stylesheet" type="text/css" href="'. ASSETS_URL . 'backend/css//module.min.css" />');
        array_push($this->data['jsBlock'], '<script language="javascript" type="text/javascript" src="'. ASSETS_URL . 'backend/js/module.min.js"></script>');
    // status array
        $this->data['statusArr'] = array(
             'active' => '<button class="btn bg-color-green txt-color-white" data-value="active">Active</button>'
            ,'inactive' => '<button class="btn bg-color-blueDark txt-color-white" data-value="inactive">Inactive</button>'
            // ,'block' => '<button class="btn bg-color-red txt-color-white" data-value="block">Block</button>'
        );
    }
// index
    public function index()
    {
    // check not access
        $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 1);
        $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 2);
        $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 3);
        $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 4);

    	// $this->data['breadcrumb'][1] = array('name'=>'List', 'url' => B_URL . $this->router->fetch_method());

        // frm
        	$this->data['frmModule'] = frm(B_URL . $this->currentModule['url'] . '/submit_db', array('id' => "frmModule"), FALSE);
            $this->data['frmTopButtons'] = frm(B_URL . $this->currentModule['url'] . '/multi_delete', array('id' => "frmTopButtons"), FALSE);
            // $this->data['frmImport'] = frm(B_URL.$this->module.'/import_db', array('id' => "frmImport"), TRUE);

        $this->template->load('backend/template', 'backend/module/list', $this->data);
    }
//  Ajax List
    public function ajax_list()
    {
        // get params
            $params = array(
                 'page'     => $_GET['page']
                ,'limit'    => $_GET['rows']
                ,'sidx'     => $_GET['sidx']
                ,'sord'     => $_GET['sord']
            );
            $sql = "SELECT * FROM module";
            $where = "";
            if (isset($_GET['filters'])) {
                $params['filters'] = json_decode($_GET['filters']);
                if (count($params['filters']->rules)>0) {
                    if ($where == "") {$where .= "WHERE"; } else { $where .= " AND"; }
                    foreach($params['filters']->rules as $rule) {
                        $field = $this->db->escape($rule->field);
                        $value = $this->db->escape_like_str($rule->data);
                        if ($field == "status") {
                            $where .= " status='" . $value . "'";
                        }
                        else {
                            $where .= $field . " LIKE '%" . $value . "%'";
                        }
                    }
                }
            }
            $sql .= $where;

        // return json
            echo json_encode($this->Base_model->table_list_in_page($sql, $params));
    }

/*
//  Ajax List
    public function ajax_list()
    {
        $arrJSON = array();
        $page = $_GET['page']; // get the requested page
        $limit = $_GET['rows']; // get how many rows we want to have into the grid
        $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
        $sord = $_GET['sord']; // get the direction
        if(!$sidx) $sidx=1;
        // add where in string
            $where = array();
        // get filter if have
            // $search = $_GET['_search'];
            $like = array();
            if (isset($_GET['filters'])) {
                $filters = $_GET['filters'];
                $filters = json_decode($filters);

                foreach($filters->rules as $rule) { // filter is active
                    $field = $rule->field;
                    $value = $rule->data;
                    if ($field == "status") {
                        $where['status'] = $value;
                    }
                    else {
                        if ($field == "categoryName") {
                            $field = 'category.name';
                        }
                        else {
                            $field = 'post.'.$field;
                        }
                        $like[$field] = $value;
                    }
                }
            }

        // get total row => total page
            $count = $this->model->total_Rows('db', $where, $like);
            if( $count>0 ) {
                $total_pages = ceil($count/$limit);
            } else {
                $total_pages = 0;
            }
            if ($page > $total_pages) $page=$total_pages;
            $start = $limit*$page - $limit;
            if ($start <= 0) $start=0;
        // query database
            $list = $this->model->get_List('db', $where, $like, $sidx, $sord, $start, $limit);

        // arrange result
            $arrJSON['sidx'] = $sidx;
            $arrJSON['page'] = $page;
            $arrJSON['total'] = $total_pages;
            $arrJSON['records'] = $count;
            $arrJSON['rows'] = $list;


            // foreach ($list as $key => $item) {
            // }


        // return json
            echo json_encode($arrJSON);
    }

// ajax_getModule
    public function ajax_getModule()
    {
        // check permission
        $this->noAccess($this->data['permissionsMember'], $this->module, 3);

        $arrJSON = array();
        $id = $this->input->post('id', TRUE);
        $arrData = $this->Base_model->getDB('db', 'module', NULL, array('id' => $id));
        if ($arrData !== FALSE && count($arrData)>0) {
            $arrJSON['error'] = 0;
            $arrJSON['module'] = $arrData[0];
        }
        else {
            $arrJSON['error'] = 1;
        }

        echo json_encode($arrJSON);
    }

// Submit DB
    public function submit_db()
    {
        $oper = $this->input->post('oper', TRUE);

        if ($oper == "add") {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->module, 2);
        // valid data
            $this->form_validation->set_rules('name', 'name', 'trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('url', 'url', 'trim|required|max_length[255]|alpha_dash|xss_clean');
            $this->form_validation->set_message('required', '%s is not empty');
            $this->form_validation->set_message('max_length', '%s is maximum 255 characters');
            $this->form_validation->set_message('alpha_dash', '%s just contains alpha-numeric characters, underscores or dashes');
            if ( $this->form_validation->run() == FALSE) {
                if ( validation_errors() != "" ) {
                    $this->session->set_userdata('invalid', validation_errors());
                    redirect(B_URL.$this->router->fetch_class());
                }
            }
            $name = $this->input->post('name', TRUE);
            $url = $this->input->post('url', TRUE);
        // valid existed
            if ($this->_existed($oper, $name, NULL)) {
                $this->session->set_userdata('invalid', "This module name existed.");
                redirect(B_URL.$this->router->fetch_class());
            }
            $moduleAdd = array('name' => $name,
                                'url' => $url,
                                'icon' => $this->input->post('icon', TRUE),
                                'desc' => $this->input->post('desc', TRUE),
                                'order' => $this->input->post('order', TRUE)
                                 );
            if ( $this->model->insertModule('db', $moduleAdd) === FALSE ) {
                $this->session->set_userdata('invalid', "Error insert new data.");
                redirect(B_URL.$this->router->fetch_class());
            }
            $this->session->set_userdata('valid', "Insert new data successful.");

            redirect(B_URL.$this->router->fetch_class());
        }
        else {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->module, 3);
        // get id on edit
            $id = $this->input->post('id',TRUE);
        // Just for edit icon and description
            $icon = $this->input->post('icon', TRUE);
            $desc = $this->input->post('desc', TRUE);
            $order = $this->input->post('order', TRUE);
            if ($this->Base_model->updateDB('db', 'module', array('icon' => $icon, 'desc' => $desc, 'order' => $order), array('id' => $id)) === FALSE) {
                $this->session->set_userdata('invalid', "Error update data.");
                redirect(B_URL.$this->router->fetch_class());
            }
            $this->session->set_userdata('valid', "Update data successful.");
            redirect(B_URL.$this->router->fetch_class());
        }

    }

// Delete
    public function delete($id)
    {
        // check permission
        $this->noAccess($this->data['permissionsMember'], $this->module, 4);

        if ($id === FALSE) {
            $this->session->set_userdata('invalid', "This module does not exist.");
            redirect($_SERVER['HTTP_REFERER']);
        }
        if ($this->model->deleteModule('db', array($id)) === FALSE) {
            $this->session->set_userdata('invalid', "Error delete data");
        }
        else {
            $this->session->set_userdata('valid', "Delete data successful.");
        }
        redirect(B_URL.$this->router->fetch_class());
    }

// ********************************
// check existed
    private function _existed($oper, $name, $id=NULL)
    {
        $url = url_str($name);
        if ($oper == "add") { // add
            $existed_url = $this->Base_model->getDB('db','module',array('id'),array('url' => $url));
        }
        else { // edit
            $existed_url = $this->Base_model->getDB('db','module',array('id'),array('id <>' => $id, 'url =' => $url));
        }
        if ($existed_url !== FALSE && count($existed_url) > 0) {
            return TRUE;    // existed
        }
        else {
            return FALSE;
        }
    }

// ajax_existed_inCategory
    public function ajax_existed()
    {
        $oper = $this->input->post('oper',TRUE);
        if ($oper == "add") {
            $name = $this->input->post('name',TRUE);
            $id = $this->input->post('id',TRUE); // get id on edit
            if ($id===FALSE || $id == 0) { $id = NULL; }

            if ($this->_existed($oper, $name, $id)) {
                echo "false";   // existed => return false for validation
            }
            else {
                echo "true";
            }
        }
        else {
            echo "true"; // not valid because do not allow change name
        }
    }
*/
}
