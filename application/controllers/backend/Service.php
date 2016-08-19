<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/backend/Root.php')) {
    require_once(APPPATH . 'controllers/backend/Root.php');
}

class Service extends Root {

	private $module = 'service';
    private $idCategory = 2;

    public function __construct()
    {
        parent::__construct();

    // load
        $this->load->model($this->module.'_model', 'model');

        $this->data['activeModule'] = $this->module;
        $this->data['activeNav'] = $this->module;
        $this->data['breadcrumb'][0] = array('name'=>ucfirst($this->module), 'url' => B_URL . $this->module);
    }
// index
    public function index()
    {
    // check not access
        $this->noAccess($this->data['permissionsMember'], $this->module, 1);

        $this->data['breadcrumb'][1] = array('name'=>'List', 'url' => B_URL . $this->router->fetch_method());
        
        // frm
            $this->data['frmTopButtons'] = frm(B_URL.$this->module.'/multi_delete', array('id' => "frmTopButtons"), FALSE);
            // $this->data['frmImport'] = frm(B_URL.$this->module.'/import_db', array('id' => "frmImport"), TRUE);

        $this->template->load('backend/template', 'backend/'.$this->module.'/list', $this->data);
    }

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
            $where = 'category.parent_id=2';
        // get filter if have
            // $search = $_GET['_search'];
            $like = "";
            if (isset($_GET['filters'])) {
                $filters = $_GET['filters'];
                $filters = json_decode($filters);
                
                foreach($filters->rules as $rule) { // filter is active
                    $field = $rule->field;
                    $value = $rule->data;
                    if ($field == "categoryName") {
                        $field = 'category.name';
                    } 
                    else {
                        $field = 'post.'.$field;
                    }
                    $like .= $field." LIKE '%".$value."%'";
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

// ajax_status
    public function ajax_status()
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->module, 3);
            
        $id = $this->input->post('id',TRUE);
        $value = $this->input->post('value',TRUE);

        if ( $this->Base_model->updateDB('db', 'post', array('status' => $value), array('id' => $id)) === FALSE ) {
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
            $this->noAccess($this->data['permissionsMember'], $this->module, 2);
        
            $this->data['breadcrumb'][1] = array('name'=>'Add', 'url' => B_URL . $this->router->fetch_method());

        // get service category list
            $this->data['arrService'] = $this->Base_model->getDB('db', 'category', NULL, array('parent_id' => $this->idCategory), NULL, array('id','order','name','name_en'), array('asc','asc','asc','asc'));
        // create form
            $this->data['frmAdd'] = frm(B_URL.$this->module.'/add_db', array('id' => 'frmAdd'), TRUE);

        $this->template->load('backend/template', 'backend/'.$this->module.'/add', $this->data);
    }
    public function add_db()
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->module, 2);    
        // valid form
            $this->form_validation->set_rules('title', 'Title VN', 'trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('url', 'URL VN', 'trim|required|max_length[255]|alpha_dash|xss_clean');
            $this->form_validation->set_rules('desc', 'Description VN', 'trim|max_length[1025]|xss_clean');
            $this->form_validation->set_rules('titleEN', 'Title EN', 'trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('urlEN', 'URL EN', 'trim|required|max_length[255]|alpha_dash|xss_clean');
            $this->form_validation->set_rules('descEN', 'Description EN', 'trim|max_length[1025]|xss_clean');
            $this->form_validation->set_message('required', '%s is not empty');
            $this->form_validation->set_message('max_length', '%s is maximum 255 characters');
            $this->form_validation->set_message('alpha_dash', '%s just contains alpha-numeric characters or dashes');
            if ( $this->form_validation->run() == FALSE) {
                if ( validation_errors() != "" ) {
                    $this->session->set_userdata('invalid', validation_errors());
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
        // valid default
            if ( $this->input->post('url', TRUE) == 'default' ) {
                $this->session->set_userdata('invalid', 'Sorry! You can not name "default"');
                redirect($_SERVER['HTTP_REFERER']);
            }
            if ( $this->input->post('urlEN', TRUE) == 'default' ) {
                $this->session->set_userdata('invalid', 'Sorry! You can not name "default"');
                redirect($_SERVER['HTTP_REFERER']);
            }

        // check existed
            $title = $this->input->post('title', TRUE);
            $url = $this->input->post('url', TRUE);
            $parent_id = $this->input->post('category', TRUE);

            if ($this->_existed('add', $parent_id, $url, NULL)) {
                $this->session->set_userdata('invalid', "This post name VN existed.");
                redirect($_SERVER['HTTP_REFERER']);
            }
            $titleEN = $this->input->post('titleEN', TRUE);
            $urlEN = $this->input->post('urlEN', TRUE);
            if ($this->_existed('add', $parent_id, $urlEN, NULL, 'en')) {
                // $this->session->set_userdata('invalid', "This post name EN existed.");
                redirect($_SERVER['HTTP_REFERER']);
            }

        // insert database
            $postAdd = array('title' => $title,
                                 'url' => $url,
                                 'desc' => $this->input->post('desc', TRUE),
                                 'title_en' => $titleEN,
                                 'url_en' => $urlEN,
                                 'desc_en' => $this->input->post('descEN', TRUE),
                                 'content' => $this->input->post('contentService'),
                                 'content_en' => $this->input->post('contentServiceEN'),
                                  'order' => $this->input->post('order', TRUE),
                                  'status' => $this->input->post('status', TRUE),
                                  'parent_id' => $parent_id,
                                  'thumbnail' => $this->input->post('thumbnail', TRUE),
                                  'created_datetime' => date('Y-m-d H:i:s'),
                                  'created_by' => $this->data['authMember']['username']
                                 );
            if ( $this->model->insertPost('db', $postAdd) === FALSE ) {
                $this->session->set_userdata('invalid', "Error insert new data.");
                redirect($_SERVER['HTTP_REFERER']);
            }
            $this->session->set_userdata('valid', "Insert new data successful.");

            redirect(B_URL.$this->router->fetch_class());
    }

// Edit
    public function edit($id)
    {
        // $this->session->sess_destroy();
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->module, 3);
        
            $this->data['breadcrumb'][1] = array('name'=>'Edit', 'url' => B_URL . $this->router->fetch_method());

        // get service category list
            $this->data['arrService'] = $this->Base_model->getDB('db', 'category', NULL, array('parent_id' => $this->idCategory), NULL, array('id','order','name','name_en'), array('asc','asc','asc','asc'));
        
        // get edit post
            if ($id === FALSE) {
                $this->session->set_userdata('invalid', "Data does not exist.");
                redirect($_SERVER['HTTP_REFERER']);
            }
            $arrEditPost = $this->Base_model->getDB('db','post',NULL,array('id'=>$id));
            if ($arrEditPost === FALSE || count($arrEditPost) == 0) {
                $this->session->set_userdata('invalid', "Can not find post with this ID.");
                redirect($_SERVER['HTTP_REFERER']);
            }
            $this->data['editPost'] = $arrEditPost[0];

        // create form
            $this->data['frmEdit'] = frm(B_URL.$this->module.'/edit_db', array('id' => 'frmEdit'), TRUE, array('id'=>$id));

        $this->template->load('backend/template', 'backend/'.$this->module.'/edit', $this->data);
    }
    public function edit_db()
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->module, 2);    

            $id = $this->input->post('id',TRUE);
            if ($id === FALSE) {
                $this->session->set_userdata('invalid', "Can not find post with this ID.");
                redirect(B_URL.$this->router->fetch_class());
            }
        // valid form
            $this->form_validation->set_rules('title', 'Title VN', 'trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('url', 'URL VN', 'trim|required|max_length[255]|alpha_dash|xss_clean');
            $this->form_validation->set_rules('desc', 'Description VN', 'trim|max_length[1025]|xss_clean');
            $this->form_validation->set_rules('titleEN', 'Title EN', 'trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('urlEN', 'URL EN', 'trim|required|max_length[255]|alpha_dash|xss_clean');
            $this->form_validation->set_rules('descEN', 'Description EN', 'trim|max_length[1025]|xss_clean');
            $this->form_validation->set_message('required', '%s is not empty');
            $this->form_validation->set_message('max_length', '%s is maximum 255 characters');
            $this->form_validation->set_message('alpha_dash', '%s just contains alpha-numeric characters or dashes');
            if ( $this->form_validation->run() == FALSE) {
                if ( validation_errors() != "" ) {
                    $this->session->set_userdata('invalid', validation_errors());
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
        // valid default
            if ( $this->input->post('url', TRUE) == 'default' ) {
                $this->session->set_userdata('invalid', 'Sorry! You can not name "default"');
                redirect($_SERVER['HTTP_REFERER']);
            }
            if ( $this->input->post('urlEN', TRUE) == 'default' ) {
                $this->session->set_userdata('invalid', 'Sorry! You can not name "default"');
                redirect($_SERVER['HTTP_REFERER']);
            }

        // check existed
            $title = $this->input->post('title', TRUE);
            $url = $this->input->post('url', TRUE);
            $parent_id = $this->input->post('category', TRUE);

            if ($this->_existed('edit', $parent_id, $url, $id)) {
                $this->session->set_userdata('invalid', "This post name VN existed.");
                redirect($_SERVER['HTTP_REFERER']);
            }
            $titleEN = $this->input->post('titleEN', TRUE);
            $urlEN = $this->input->post('urlEN', TRUE);
            if ($this->_existed('edit', $parent_id, $urlEN, $id, 'en')) {
                $this->session->set_userdata('invalid', "This post name EN existed.");
                redirect($_SERVER['HTTP_REFERER']);
            }

        // update database
            $postEdit = array('title' => $title,
                                 'url' => $url,
                                 'desc' => $this->input->post('desc', TRUE),
                                 'title_en' => $titleEN,
                                 'url_en' => $urlEN,
                                 'desc_en' => $this->input->post('descEN', TRUE),
                                 'content' => $this->input->post('contentService'),
                                 'content_en' => $this->input->post('contentServiceEN'),
                                  'order' => $this->input->post('order', TRUE),
                                  'status' => $this->input->post('status', TRUE),
                                  'parent_id' => $parent_id,
                                  'thumbnail' => $this->input->post('thumbnail', TRUE),
                                  'modified_datetime' => date('Y-m-d H:i:s'),
                                  'modified_by' => $this->data['authMember']['username']
                                 );
            if ( $this->model->updatePost('db', $id, $postEdit) === FALSE ) {
                $this->session->set_userdata('invalid', "Error update data.");
                redirect($_SERVER['HTTP_REFERER']);
            }
            
            $this->session->set_userdata('valid', "Update data successful.");
            // print_r("<pre>"); print_r($this->session->userdata()); die();
            redirect(B_URL.$this->router->fetch_class());
    }

// Delete
    public function delete($id)
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->module, 4);

        if ($id === FALSE) {
            $this->session->set_userdata('invalid', "Data does not exist.");
            redirect($_SERVER['HTTP_REFERER']);
        }
        if ($this->Base_model->deleteDB('db', 'post', 'id', array($id)) === FALSE) {
            $this->session->set_userdata('invalid', "Error delete data");
        }
        else {
            $this->session->set_userdata('valid', "Delete data successful.");
        }
        redirect(B_URL.$this->router->fetch_class());
    }    

// Multi Delete
    public function multi_delete()
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->module, 4);
            
        $ids = $this->input->post('ids', TRUE);
        $arrID = explode(",", $ids[0]);
        
        if ($this->Base_model->deleteDB('db', 'post', 'id', $arrID) === FALSE) {
            $this->session->set_userdata('invalid', "Error delete data");
        }
        else {
            $this->session->set_userdata('valid', "Delete data successful.");
        }

        redirect(B_URL.$this->router->fetch_class());
    }

// ********************************
// check existed
    private function _existed($oper, $parent_id, $url, $id=NULL, $lang="")
    {
        $lang = $lang == "" ? "" : "_".$lang;
        if ($oper == "add") { // add
            $where = array('parent_id' => $parent_id, 'url'.$lang => $url);
        }
        else if ($oper == "edit") { // edit
            $where = array('id <>' => $id, 'parent_id' => $parent_id, 'url'.$lang => $url);
        }
        $existed_url = $this->Base_model->getDB('db','post',array('id'),$where);
        if ($existed_url !== FALSE && count($existed_url) > 0) {
            return TRUE;    // existed
        }
        else {
            return FALSE;
        }
    }
    public function ajax_existed_inCategory()
    {
        $oper = $this->input->post('oper',TRUE);
        $parent_id = $this->input->post('parent_id',TRUE);
        $url = $this->input->post('url',TRUE);
        $lang = $this->input->post('lang',TRUE) == 'vn' ? "" : $this->input->post('lang',TRUE);
        $id = $this->input->post('id',TRUE); // get id on edit
        if ($id===FALSE || $id == 0) { $id = NULL; }

        if ($this->_existed($oper, $parent_id, $url, $id, $lang)) {
            echo "false";   // // existed => return false for validation
        }
        else {
            echo "true";
        }
    }
    public function ajax_multi_existed_inCategory()
    {
        $arrJSON = array();

        $oper = $this->input->post('oper',TRUE);
        $parent_id = $this->input->post('parent_id',TRUE);
        $url = $this->input->post('url',TRUE);
        $urlEN = $this->input->post('urlEN',TRUE);
        $id = $this->input->post('id',TRUE);
        if ($id===FALSE || $id == 0) { $id = NULL; }

        if ($this->_existed($oper, $parent_id, $url, $id) === TRUE) {
            $arrJSON['error'] = '1';
        }
        else {
            if ($this->_existed($oper, $parent_id, $urlEN, $id, 'en') === TRUE) {
                $arrJSON['error'] = '2'; // error url EN
            }
            else {
                $arrJSON['error'] = '';
            }
        }

        echo json_encode($arrJSON);
    }
}