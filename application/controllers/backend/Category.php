<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/backend/Root.php')) {
    require_once(APPPATH . 'controllers/backend/Root.php');
}

class Category extends Root {

	private $module = 'category';
    private $childModule ='';

    public function __construct()
    {
        parent::__construct();

    // load
        $this->load->model($this->module.'_model', 'model');

        $this->data['activeModule'] = $this->module;
        $this->data['activeNav'] = $this->module;
        $this->data['breadcrumb'][0] = array('name'=>ucfirst($this->module), 'url' => B_URL . $this->module);

        if ($this->session->userdata('childModule') !== FALSE) {
            $this->childModule = $this->session->userdata('childModule');
        }
    }
// index
    public function index()
    {
    // check not access
        $this->noAccess($this->data['permissionsMember'], $this->module, 1);

        if ($this->session->userdata('childModule') !== FALSE) {
            $this->session->unset_userdata('childModule');
            $this->childModule = "";
        }

        $this->data['breadcrumb'][1] = array('name'=>'List', 'url' => B_URL . $this->router->fetch_method());
        
        // frm
            $this->data['frmTopButtons'] = frm(B_URL.$this->module.'/multi_delete', array('id' => "frmTopButtons"), FALSE);
            // $this->data['frmImport'] = frm(B_URL.$this->module.'/import_db', array('id' => "frmImport"), TRUE);

        $this->template->load('backend/template', 'backend/category/list', $this->data);
    }

//  Ajax List
    public function ajax_list()
    {
        $arrJSON = array();
        $page = $_GET['page']; // get the requested page
        $limit = $_GET['rows']; // get how many rows we want to have into the grid
        $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
        $sord = $_GET['sord']; // get the direction
        //if(!$sidx) $sidx=1;
        if ( $sidx == "parent") {
            $sidx = "c2.name";
        }
        else {
            $sidx = "c1.".$sidx;
        }
        // add where in string
            // $where = array('name <>' => 'default');
            $where = "";
        // get filter if have
            $like = "";
            if (isset($_GET['filters'])) {
                $filters = $_GET['filters'];
                $filters = json_decode($filters);
                if (count($filters->rules)>0) {

                    foreach($filters->rules as $rule) { // filter is active
                        $field = $rule->field;
                        $value = $rule->data;
                        if ($field == "status") {
                            $where .= "c1.status='".$value."'";
                        }
                        else {
                            if ($field == "parent") {
                                $field = "c2.name";
                            }
                            else {
                                $field = "c1.".$field;
                            }
                            $like .= $field." LIKE '%".$value."%'";
                        }
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

        if ( $this->model->update_status('db', $id, $value) === FALSE ) {
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
            if (isset($this->childModule) && $this->childModule != '') {
                $this->noAccess($this->data['permissionsMember'], $this->childModule, 2);
            }
            else {
                $this->noAccess($this->data['permissionsMember'], $this->module, 2);    
            }
        
        $this->data['breadcrumb'][1] = array('name'=>'Add', 'url' => B_URL . $this->router->fetch_method());

        $arrCategory = $this->Base_model->getDB('db', 'category', NULL, NULL, NULL, array('path','order','name', 'name_en'), array('asc','asc','asc','asc'));
        foreach ($arrCategory as $key => $category) {
            $indent = count(explode('-', $category['path']));
            $arrCategory[$key]['indent'] = $indent-1;
        }
        $this->data['categories'] = $arrCategory;
        // print_r("<pre>");print_r($arrCategory); die();
        // create form
            $this->data['frmAdd'] = frm(B_URL.$this->module.'/add_db', array('id' => 'frmAdd'), TRUE);

        $this->template->load('backend/template', 'backend/category/add', $this->data);
    }
    public function add_db()
    {
        // check permission
            if (isset($this->childModule) && $this->childModule != '') {
                $this->noAccess($this->data['permissionsMember'], $this->childModule, 2);
            }
            else {
                $this->noAccess($this->data['permissionsMember'], $this->module, 2);    
            }
        // valid form
            $this->form_validation->set_rules('name', 'Name VN', 'trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('url', 'URL VN', 'trim|required|max_length[255]|alpha_dash|xss_clean');
            $this->form_validation->set_rules('desc', 'Description VN', 'trim|max_length[1025]|xss_clean');
            $this->form_validation->set_rules('nameEN', 'Name EN', 'trim|required|max_length[255]|xss_clean');
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
            $name = $this->input->post('name', TRUE);
            $url = $this->input->post('url', TRUE);
            $parent_id = $this->input->post('parent_id', TRUE);

            if ($this->_existed('add', $parent_id, $url, NULL)) {
                $this->session->set_userdata('invalid', "This category name existed.");
                redirect($_SERVER['HTTP_REFERER']);
            }
            $nameEN = $this->input->post('nameEN', TRUE);
            $urlEN = $this->input->post('urlEN', TRUE);
            if ($this->_existed('add', $parent_id, $urlEN, NULL, 'en')) {
                $this->session->set_userdata('invalid', "This category name existed.");
                redirect($_SERVER['HTTP_REFERER']);
            }
            
        // make path
            $path = "";
            
            if ($parent_id == 0) {
                $path = "0-";
            }
            else {
                // get path of parent
                $parentPath = $this->model->get_category_haveID('db', $parent_id);
                if ($parentPath === FALSE || count($parentPath)==0) {
                    $this->session->set_userdata('invalid', "Error insert new data. (Can not find path of parent)");
                    redirect($_SERVER['HTTP_REFERER']);
                }
                $path .= $parentPath[0]['path'];
            }

        // get param having add a child name "other" 
            $other = $this->input->post('other', TRUE);
            if ($other == NULL || $other == "") {
                $other = NULL;
            }

        // insert database
            $categoryAdd = array('name' => $name,
                                 'url' => $url,
                                 'desc' => $this->input->post('desc', TRUE),
                                 'name_en' => $nameEN,
                                 'url_en' => $urlEN,
                                 'desc_en' => $this->input->post('descEN', TRUE),
                                  'order' => $this->input->post('order', TRUE),
                                  'status' => $this->input->post('status', TRUE),
                                  'parent_id' => $parent_id,
                                  'path' => $path,
                                  'thumbnail' => $this->input->post('thumbnail', TRUE),
                                  'created_datetime' => date('Y-m-d H:i:s'),
                                  'created_by' => $this->data['authMember']['username']
                                 );
            if ( $this->model->insertCategory('db', $categoryAdd, $path, $other) === FALSE ) {
                $this->session->set_userdata('invalid', "Error insert new data.");
                redirect($_SERVER['HTTP_REFERER']);
            }
            $this->session->set_userdata('valid', "Insert new data successful.");
            
            if ($this->childModule != "") {
                redirect(B_URL.$this->childModule);
            }
            redirect(B_URL.$this->router->fetch_class());
    }

// Edit
    public function edit($id)
    {
        // check permission
        if (isset($this->childModule) && $this->childModule != '') {
            $this->noAccess($this->data['permissionsMember'], $this->childModule, 3);
        }
        else {
            $this->noAccess($this->data['permissionsMember'], $this->module, 3);    
        }

        $this->data['breadcrumb'][1] = array('name'=>'Edit', 'url' => B_URL . $this->router->fetch_method());

        // get list of category for tree
        $arrCategory = $this->Base_model->getDB('db', 'category', NULL, NULL, NULL, array('path','order','name', 'name_en'), array('asc','asc','asc','asc'));
        foreach ($arrCategory as $key => $category) {
            $indent = count(explode('-', $category['path']));
            $arrCategory[$key]['indent'] = $indent-1;
        }
        $this->data['categories'] = $arrCategory;
        
        // get edit category
        if ($id === FALSE) {
            $this->session->set_userdata('invalid', "Data does not exist.");
            redirect($_SERVER['HTTP_REFERER']);
        }
        $arrEditCategory = $this->Base_model->getDB('db','category',NULL,array('id'=>$id));
        if ($arrEditCategory === FALSE || count($arrEditCategory) == 0) {
            $this->session->set_userdata('invalid', "Can not find category with this ID.");
            redirect($_SERVER['HTTP_REFERER']);
        }
        $this->data['editCategory'] = $arrEditCategory[0];

        // create form
            $this->data['frmEdit'] = frm(B_URL.$this->module.'/edit_db', array('id' => 'frmEdit'), TRUE, array('id'=>$id));

        $this->template->load('backend/template', 'backend/category/edit', $this->data);
    }
    public function edit_db()
    {
        // check permission
        if (isset($this->childModule) && $this->childModule != '') {
            $this->noAccess($this->data['permissionsMember'], $this->childModule, 3);
        }
        else {
            $this->noAccess($this->data['permissionsMember'], $this->module, 3);    
        }

        $id = $this->input->post('id',TRUE);
        if ($id === FALSE) {
            $this->session->set_userdata('invalid', "Can not find category with this ID.");
            redirect(B_URL.$this->router->fetch_class());
        }
        // valid form
            $this->form_validation->set_rules('name', 'Name VN', 'trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('url', 'URL VN', 'trim|required|max_length[255]|alpha_dash|xss_clean');
            $this->form_validation->set_rules('desc', 'Description VN', 'trim|max_length[1025]|xss_clean');
            $this->form_validation->set_rules('nameEN', 'Name EN', 'trim|required|max_length[255]|xss_clean');
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
            $name = $this->input->post('name', TRUE);
            $url = $this->input->post('url', TRUE);
            $parent_id = $this->input->post('parent_id', TRUE);
            if ($this->_existed('edit', $parent_id, $url, $id)) {
                $this->session->set_userdata('invalid', "This category name existed. edit");
                redirect($_SERVER['HTTP_REFERER']);
            }
            $nameEN = $this->input->post('nameEN', TRUE);
            $urlEN = $this->input->post('urlEN', TRUE);
            if ($this->_existed('edit', $parent_id, $urlEN, $id, 'en')) {
                $this->session->set_userdata('invalid', "This category name existed.");
                redirect($_SERVER['HTTP_REFERER']);
            }

        // make path
            $path = "";
            
            if ($parent_id == 0) {
                $path = "0-";
            }
            else {
                // get path of parent
                $parentPath = $this->model->get_category_haveID('db', $parent_id);
                if ($parentPath === FALSE || count($parentPath)==0) {
                    $this->session->set_userdata('invalid', "Error edit data. (Can not find path of parent)");
                    redirect($_SERVER['HTTP_REFERER']);
                }
                $path .= $parentPath[0]['path'];
            }
        // update database
            $path .= $id."-";
            $categoryEdit = array('name' => $name,
                                  'url' => $url,
                                  'desc' => $this->input->post('desc', TRUE),
                                  'name_en' => $nameEN,
                                  'url_en' => $urlEN,
                                  'desc_en' => $this->input->post('descEN', TRUE),
                                  'order' => $this->input->post('order', TRUE),
                                  'status' => $this->input->post('status', TRUE),
                                  'parent_id' => $parent_id,
                                  'path' => $path,
                                  'thumbnail' => $this->input->post('thumbnail', TRUE),
                                  'modified_datetime' => date('Y-m-d H:i:s'),
                                  'modified_by' => $this->data['authMember']['username']
                                 );
            if ( $this->model->updateCategory('db', $categoryEdit, $id) === FALSE ) {
                $this->session->set_userdata('invalid', "Error update data.");
                redirect($_SERVER['HTTP_REFERER']);
            }
            $this->session->set_userdata('valid', "Update data successful.");
            
            if ($this->childModule != "") {
                redirect(B_URL.$this->childModule);
            }
            redirect(B_URL.$this->router->fetch_class());
    }

// Delete
    public function delete($id)
    {
        // check permission
        if (isset($this->childModule) && $this->childModule != "") {
            $this->noAccess($this->data['permissionsMember'], $this->childModule, 4);
        }
        else {
            $this->noAccess($this->data['permissionsMember'], $this->module, 4);    
        }

        $_GET['dc'] == 1 ? $deleteChildren = TRUE : $deleteChildren = FALSE;

        if ($id === FALSE) {
            $this->session->set_userdata('invalid', 'This ID is not existing.');
            redirect($_SERVER['HTTP_REFERER']);
        }
        if ($this->model->deleteCategory('db', $id, $deleteChildren) === FALSE) {
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
        if (isset($this->childModule) && $this->childModule != "") {
            $this->noAccess($this->data['permissionsMember'], $this->childModule, 4);
        }
        else {
            $this->noAccess($this->data['permissionsMember'], $this->module, 4);    
        }

        $ids = $this->input->post('ids', TRUE);
        $arrID = explode(",", $ids[0]);
        $dc = $this->input->post('dc', TRUE);
        $dc == 1 ? $deleteChildren = TRUE : $deleteChildren = FALSE;

        $deleted = 0;
        foreach ($arrID as $id) {
            if ($this->model->deleteCategory('db', $id, $deleteChildren) === TRUE) {
                $deleted++;
            }
        }
        if ($deleted < count($arrID)) {
            $this->session->set_userdata('invalid', "Delete data did not completed.");
        }
        else {
            $this->session->set_userdata('valid', "Delete data successful.");
        }

        redirect($_SERVER['HTTP_REFERER']);
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
        $existed_url = $this->Base_model->getDB('db','category',array('id'),$where);
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

// check can move - now do not use
    private function _canMove($path, $oldParentPath, $newParentPath)
    {
        if ( strpos($path, $newParentPath) !== FALSE ) { // path of new parent appears in path
            return FALSE;
        }
        return TRUE;
    }

// ajax_getCategory
    public function ajax_getCategory()
    {
        $arrJSON = array();
        $id = $this->input->post('id',TRUE);

        $arrCategory = $this->model->getDB('db', 'category', NULL, array('id' => $id));
        if ($arrCategory === FALSE || count($arrCategory) == 0) {
            $arrJSON['error'] = '1';
        }
        else {
            $arrJSON['error'] = '0';
            $arrJSON['category'] = $arrCategory;
        }
        echo json_encode($arrJSON);
    }

// ajax_getSubCategory
    public function ajax_getSubCategory()
    {
        $arrJSON = array();
        $parent_id = $this->input->post('parent_id',TRUE);

        $arrCategory = $this->model->getDB('db', 'category', NULL, array('parent_id' => $parent_id));
        if ($arrCategory === FALSE || count($arrCategory) == 0) {
            $arrJSON['error'] = '1';
        }
        else {
            $arrJSON['error'] = '0';
            $arrJSON['category'] = $arrCategory;
        }
        echo json_encode($arrJSON);
    }
}