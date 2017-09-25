<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (file_exists(APPPATH . 'controllers/backend/Root.php')) {
    require_once(APPPATH . 'controllers/backend/Root.php');
}
class Category extends Root {
    public function __construct()
    {
        parent::__construct();
            $this->currentModule = $this->data['modules'][ucfirst($this->router->fetch_class())];
            $this->data['varJS']['currentModule'] = $this->currentModule;
        // load
            $this->load->model($this->currentModule['control_name'].'_model', 'model');
            $this->data['activeModule'] = $this->currentModule['control_name'];
            $this->data['activeNav'] = $this->currentModule['control_name'];
            $this->data['breadcrumb'][0] = array('name'=>$this->currentModule['name'], 'url' => B_URL . $this->currentModule['url']);
        // block js and css
            // array_push($this->data['cssBlock'], '<link rel="stylesheet" type="text/css" href="'. ASSETS_URL . 'backend/css/category.min.css" />');
            array_push($this->data['jsBlock'], '<script language="javascript" type="text/javascript" src="'. ASSETS_URL . 'backend/js/init_height.js"></script>');
        	array_push($this->data['jsBlock'], '<script language="javascript" type="text/javascript" src="'. ASSETS_URL . 'backend/js/category.js"></script>');
            array_push($this->data['jsBlock'], '<script language="javascript" type="text/javascript" src="'. ASSETS_URL . 'backend/js/tree.js"></script>');
        // status array
            $this->data['statusArr'] = array(
                 'active' => '<button class="btn bg-color-green txt-color-white" data-value="active">Active</button>'
                ,'inactive' => '<button class="btn bg-color-blueDark txt-color-white" data-value="inactive">Inactive</button>'
                // ,'block' => '<button class="btn bg-color-red txt-color-white" data-value="block">Block</button>'
            );
            $this->data['is_sub_category'] = 0;
    }
// index
    public function index()
    {
        // check not access
            $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 1);
        // breadcrumb
            $this->data['breadcrumb'][1] = array('name'=>'List', 'url' => B_URL . $this->currentModule['url']);
        // for tree
            $arrCategory = $this->Base_model->get_db('category', NULL, NULL, NULL, array('path','order','name'), array('asc','asc','asc'));
            foreach ($arrCategory as $key => $category) {
                $indent = count(explode('-', $category['path']));
                $arrCategory[$key]['indent'] = $indent-1;
            }
            $this->data['categories'] = $arrCategory;
            $this->data['parent_id'] = 0;
            $this->data['selected_category_id'] = 0;
            $this->data['selected_category_name'] = 'Root';
        // create frm
            $this->data['frmTopButtons'] = frm(B_URL.$this->currentModule['url'].'/multi_delete', array('id' => "frmTopButtons"), FALSE);
            $this->data['frmCategory'] = frm('', array('id' => 'frmCategory'), TRUE);
            $this->template->load('backend/template', 'backend/category', $this->data);
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
            $sql = " SELECT
                         c1.id
                        , c1.name
                        , c1.desc
                        , c1.thumbnail
                        , c1.order
                        , c1.status
                        , IF (c1.parent_id=0, 'ROOT', c2.name) AS parent
                    FROM category c1
                    LEFT JOIN category c2 ON c1.parent_id=c2.id
                ";
            if ( $params['sidx'] !== "parent") {
                $params['sidx'] = "c1." . $params['sidx'];
            }
            $where = "";
            if (isset($_GET['filters'])) {
                $params['filters'] = json_decode($_GET['filters']);
                if (count($params['filters']->rules)>0) {
                    foreach($params['filters']->rules as $rule) {
                        if ($where == "") {$where .= "WHERE"; } else { $where .= " AND"; }
                        $field = $rule->field;
                        $value = $this->db->escape_like_str($rule->data);
                        if ($field == "status") {
                            $where .= " c1.status='" . $value . "'";
                        }
                        else {
                            if ($field == "parent") {
                                $where .= " c2.name LIKE '%" . $value . "%'";
                            }
                            else if ($field == "path") {
                                $where .= " c1.path LIKE '%" . $value . "%'";
                            }
                            else {
                                $where .= " c1." . $field . " LIKE '%" . $value . "%'";
                            }
                        }
                    }
                }
            }
            $sql .= $where;
        // return json
            echo json_encode($this->Base_model->table_list_in_page($sql, $params));
    }
// ajax_status
    public function ajax_status()
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 3);
        // get data
            $id = $this->input->post('id',TRUE);
            $value = $this->input->post('value',TRUE);
        // update
            if ( $this->model->update_status($id, $value) === FALSE ) {
                echo "false";
            }
            else {
                echo "true";
            }
    }
// Add
    public function add()
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 2);
        // breadcrumb
            $this->data['breadcrumb'][1] = array('name'=>'Add', 'url' => '');
        $arrCategory = $this->Base_model->get_db('category', NULL, NULL, NULL, array('path','order','name'), array('asc','asc','asc'));
        foreach ($arrCategory as $key => $category) {
            $indent = count(explode('-', $category['path']));
            $arrCategory[$key]['indent'] = $indent-1;
        }
        $this->data['categories'] = $arrCategory;
        $this->data['selected_category_id'] = 0;
        $this->data['selected_category_name'] = 'Root';
        $this->data['parent_id'] = 0;
        // create form
            $this->data['frmCategory'] = frm('', array('id' => 'frmCategory'), TRUE);
        $this->template->load('backend/template', 'backend/category/form', $this->data);
    }
// Edit
    public function edit($id)
    {
        // check permission
        $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 3);
        $this->data['breadcrumb'][1] = array('name'=>'Edit', 'url' => '');
        // get list of category for tree
        $arrCategory = $this->Base_model->get_db('category', NULL, NULL, NULL, array('path','order','name'), array('asc','asc','asc'));
        foreach ($arrCategory as $key => $category) {
            $indent = count(explode('-', $category['path']));
            $arrCategory[$key]['indent'] = $indent-1;
        }
        $this->data['categories'] = $arrCategory;
        // get edit category
        if ($id === FALSE || $id<3) {
            $this->session->set_userdata('invalid', "Data does not exist or this is default category.");
            redirect(B_URL . $this->currentModule['url']);
        }
        $arrEditCategory = $this->Base_model->get_db('category',NULL,array('id'=>$id));
        if ($arrEditCategory === FALSE || count($arrEditCategory) == 0) {
            $this->session->set_userdata('invalid', "Can not find category with this ID.");
            redirect(B_URL . $this->currentModule['url']);
        }
        $this->data['frmData'] = $arrEditCategory[0];
        $this->data['parent_id'] = $arrEditCategory[0]['parent_id'];
        $this->data['selected_category_id'] = $id;
        $this->data['selected_category_name'] = 'Root';
        // create form
            $this->data['frmCategory'] = frm('', array('id' => 'frmCategory'), TRUE);

        $this->template->load('backend/template', 'backend/category/form', $this->data);
    }
// Update
    public function update()
    {
        $name = $this->input->post('name',TRUE);
        $url = $this->input->post('url',TRUE);
        $desc = $this->input->post('desc',TRUE);
        $thumbnail = $this->input->post('thumbnail',TRUE);
        $id = $this->input->post('id',TRUE);
        // check permission
            if ($id == NULL) { // add
                $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 2);
                $parent_id = $this->input->post('selected_category_id',TRUE);
            }
            else { // edit
                $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 3);
                $selected_category_id = $this->input->post('selected_category_id',TRUE);
                if ($selected_category_id == $id) {
                    $parent_id = $this->input->post('parent_id',TRUE);
                }
                else {
                    $parent_id = $selected_category_id;
                }
            }
        // valid form
            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('url', 'URL', 'trim|required|max_length[255]|alpha_dash|xss_clean');
            $this->form_validation->set_rules('desc', 'Description', 'trim|max_length[1025]|xss_clean');
            $this->form_validation->set_message('required', '%s is not empty');
            $this->form_validation->set_message('max_length', '%s is maximum 255 characters');
            $this->form_validation->set_message('alpha_dash', '%s just contains alpha-numeric characters or dashes');
            if ( $this->form_validation->run() == FALSE && validation_errors() != "") {
                $msg['err'] = 1;
                $msg['msg'] = validation_errors();
            }
        // valid existed
            /*
            else if ($this->is_existed($url, $parent_id, $id)) {
                $msg['err'] = 1;
                $msg['msg'] = 'This category name existed.';
            }
            */
            else {
                // make path
                $path = $this->make_path($parent_id);
                if ($id != NULL) { // edit
                    $path .= $id . '-';
                }
                if ($path===FALSE) {
                    $msg['err'] = 1;
                    $msg['msg'] = 'Can not find path of parent';
                }
                else {
                    if ($id == NULL || $id == "") { // add
                        // insert database
                        $categoryAdd = array('name' => $name,
                                             'url' => strtolower($url),
                                             'desc' => $desc,
                                             'thumbnail' => $thumbnail,
                                              'order' => $this->input->post('order', TRUE),
                                              'status' => $this->input->post('status', TRUE),
                                              'parent_id' => $parent_id,
                                              'path' => $path,
                                              'created_datetime' => date('Y-m-d H:i:s'),
                                              'created_by' => $this->data['authMember']['username']
                                             );
                        if ( $this->model->insert_category($categoryAdd, $path) === FALSE ) {
                            $msg['err'] = 1;
                            $msg['msg'] = 'Error insert new data.';
                        }
                        else {
                            $msg['err'] = 0;
                            $this->session->set_userdata('valid', "Insert new data successful.");
                        }
                    }
                    else {
                        // update database
                        $categoryEdit = array('name' => $name,
                                              'url' => $url,
                                              'desc' => $desc,
                                              'thumbnail' => $thumbnail,
                                              'order' => $this->input->post('order', TRUE),
                                              'status' => $this->input->post('status', TRUE),
                                              'parent_id' => $parent_id,
                                              'path' => $path,
                                              'modified_datetime' => date('Y-m-d H:i:s'),
                                              'modified_by' => $this->data['authMember']['username']
                                             );
                        if ( $this->model->update_category($categoryEdit, $id) === FALSE ) {
                            $msg['err'] = 1;
                            $msg['msg'] = 'Error update data.';
                        }
                        else {
                            $msg['err'] = 0;
                            $this->session->set_userdata('valid', "Update data successful.");
                        }
                    }
                }
            }
        echo json_encode($msg);
    }
// Delete
    public function delete($id)
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 4);
        // exclude  default categories
            if ($id===FALSE || $id=="" || $id==0) {
                $this->session->set_userdata('invalid', 'This ID is not existing.');
                redirect($_SERVER['HTTP_REFERER']);
            }
            else if ($id===1 || $id==2) { // not equal 1,2
                $this->session->set_userdata('invalid', 'This is default category.');
                redirect($_SERVER['HTTP_REFERER']);
            }
        // delete db
            if ($this->model->delete_category($id) === FALSE) {
                $this->session->set_userdata('invalid', "Error delete data");
            }
            else {
                $this->session->set_userdata('valid', "Delete data successful.");
            }
        redirect($_SERVER['HTTP_REFERER']);
    }
// Multi Delete
    public function multi_delete()
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 4);
        // get data
            $ids = $this->input->post('ids', TRUE);
            $arrID = explode(",", $ids[0]);
            $deleted = 0;
            foreach ($arrID as $id) {
            // exclude  default categories
                if ($id===FALSE || $id=="" || $id==0) {
                    $this->session->set_userdata('invalid', 'This ID is not existing.');
                    redirect($_SERVER['HTTP_REFERER']);
                }
                else if ($id===1 || $id==2) { // not equal 1,2
                    $this->session->set_userdata('invalid', 'This is default category.');
                    redirect($_SERVER['HTTP_REFERER']);
                }

            // delete db
                if ($this->model->delete_category($id) !== FALSE) {
                    $deleted++;
                }
            }
            if ($deleted==count($arrID)) {
                $this->session->set_userdata('valid', "Delete data successful.");
            }
            else {
                $this->session->set_userdata('invalid', "Error delete data");
            }
        redirect($_SERVER['HTTP_REFERER']);
    }
/* MORE */
    /* is_default */
        private function is_default($url)
        {
            if ( $url == 'default' ) {
                return TRUE; // is default
            }
            return FALSE;
        }
    /* is_existed */
        private function is_existed($url, $parent_id, $id=NULL)
        {
            if ($id == NULL) { // add
                $where = array('parent_id' => $parent_id, 'url' => $url);
            }
            else { // edit
                $where = array('id <>' => $id, 'parent_id' => $parent_id, 'url' => $url);
            }
            $existed_url = $this->Base_model->get_db('category',array('id'), $where);
            if ($existed_url !== FALSE && count($existed_url) > 0) {
                return TRUE;    // existed
            }
            else {
                return FALSE;
            }
        }
    /* make path */
        //return path or FALSE
        private function make_path($parent_id)
        {
            $path = "";
            if ($parent_id == 0) {
                $path = "0-";
            }
            else {
                // get path of parent
                $parentPath = $this->model->get_category_haveID($parent_id);
                if ($parentPath === FALSE || count($parentPath)==0) {
                    return FALSE;
                }
                $path .= $parentPath[0]['path'];
            }
            return $path;
        }
}
