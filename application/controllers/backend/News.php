<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (file_exists(APPPATH . 'controllers/backend/Root.php')) {
    require_once(APPPATH . 'controllers/backend/Root.php');
}
class News extends Root {

    private $path = '0-2-';

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
            // array_push($this->data['cssBlock'], '<link rel="stylesheet" type="text/css" href="'. ASSETS_URL . 'backend/css/.css" />');
            array_push($this->data['jsBlock'], '<script language="javascript" type="text/javascript" src="'. ASSETS_URL . 'backend/js/init_height.js"></script>');
        	array_push($this->data['jsBlock'], '<script language="javascript" type="text/javascript" src="'. ASSETS_URL . 'backend/js/news.js"></script>');
            array_push($this->data['jsBlock'], '<script language="javascript" type="text/javascript" src="'. ASSETS_URL . 'backend/js/tree.js"></script>');
        // status array
            $this->data['statusArr'] = array(
                 'active' => '<button class="btn bg-color-green txt-color-white" data-value="active">Active</button>'
                ,'inactive' => '<button class="btn bg-color-blueDark txt-color-white" data-value="inactive">Inactive</button>'
                // ,'block' => '<button class="btn bg-color-red txt-color-white" data-value="block">Block</button>'
            );
        $this->data['is_sub_category'] = 2;
        $this->data['is_post'] = 1;
    }

// index
    public function index()
    {
        // check not access
            $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 1);
        // breadcrumb
            $this->data['breadcrumb'][1] = array('name'=>'List', 'url' => B_URL . $this->currentModule['url']);
        // for tree
            $arrCategory = $this->Base_model->get_db('category', NULL, NULL, array('path'=>$this->path), array('path','order','name'), array('asc','asc','asc'));
            foreach ($arrCategory as $key => $category) {
                $indent = count(explode('-', $category['path']));
                $arrCategory[$key]['indent'] = $indent-1;
            }
            $this->data['categories'] = $arrCategory;
            $this->data['parent_id'] = 0;
            $this->data['selected_category_id'] = 2;
        // create frm
            $this->data['frmTopButtons'] = frm(B_URL.$this->currentModule['url'].'/multi_delete', array('id' => "frmTopButtons"), FALSE);
            $this->data['frmImport'] = frm(B_URL.$this->currentModule['url'].'/import', array('id' => "frmImport"), TRUE);

        $this->template->load('backend/template', 'backend/news', $this->data);
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
            $sql = "SELECT
                         post.id
                        ,post.type
                        ,post.deleted
                        ,post.status
                        ,news.title
                        ,news.thumbnail
                        ,news.order
                        ,category.name AS category
                    FROM post
                    INNER JOIN news ON news.post_id = post.id
                    LEFT JOIN category ON category.id = post.category_id
                    ";
            if ( $params['sidx'] == "category_name") {
                $params['sidx'] = "category." . $params['sidx'];
            }
            else if ( $params['sidx'] == "id" || $params['sidx'] == "type" || $params['sidx'] == "deleted") {
                $params['sidx'] = "post." . $params['sidx'];
            }
            else {
                $params['sidx'] = "news." . $params['sidx'];
            }
            $where = " WHERE post.type='news'";
            if (isset($_GET['filters'])) {
                $params['filters'] = json_decode($_GET['filters']);
                if (count($params['filters']->rules)>0) {
                    foreach($params['filters']->rules as $rule) {
                        if ($where == "") {$where .= "WHERE"; } else { $where .= " AND"; }
                        $field = $rule->field;
                        $value = $this->db->escape_like_str($rule->data);
                        if ($field == "status") {
                            $where .= " post.status='" . $value . "'";
                        }
                        else {
                            if ($field == "category") {
                                $where .= " category.name LIKE '%" . $value . "%'";
                            }
                            else if ($field == "path") {
                                $where .= " category.path LIKE '%" . $value . "%'";
                            }
                            else if ($field == "id" || $field == "deleted" || $field == "type") {
                                $where .= " post." . $field . " LIKE '%" . $value . "%'";
                            }
                            else {
                                $where .= " news." . $field . " LIKE '%" . $value . "%'";
                            }
                        }
                    }
                }
            }
            $sql .= $where;
            $list = $this->Base_model->table_list_in_page($sql, $params);

        // return json
            echo json_encode($list);
    }
// Ajax_status
    public function ajax_status()
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 3);
        // get data
            $id = $this->input->post('id',TRUE);
            $value = $this->input->post('value',TRUE);
        // update
            if ($this->Base_model->update_db('post', array('status'=>$value), array('id' => $id)) === FALSE) {
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
        // tree
            $arrCategory = $this->Base_model->get_db('category', NULL, NULL, array('path'=>$this->path), array('path','order','name'), array('asc','asc','asc'));
            foreach ($arrCategory as $key => $category) {
                $indent = count(explode('-', $category['path']));
                $arrCategory[$key]['indent'] = $indent-1;
            }
            $this->data['categories'] = $arrCategory;
            $this->data['selected_category_id'] = 2;
            $this->data['parent_id'] = 0;
        // creare form
            $this->data['frmNews'] = frm(NULL, array('id' => 'frmNews'), TRUE);
        $this->template->load('backend/template', 'backend/news/form', $this->data);
    }
// Edit
    public function edit($id)
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 3);
        // breadcrumb
            $this->data['breadcrumb'][1] = array('name'=>'Edit', 'url' => '');
        // get post
            $posts = $this->Base_model->get_post('news', $id);
            if ($posts === FALSE && count($posts)==0) {
                $this->session->set_userdata('invalid', "Không tìm thấy dữ liệu.");
                redirect(B_URL . $this->currentModule['url']);
            }
            $this->data['frmData'] = $post = $posts[0];
        // get category tree
            $arrCategory = $this->Base_model->get_db('category', NULL, NULL, array('path'=>$this->path), array('path','order','name'), array('asc','asc','asc'));
            foreach ($arrCategory as $key => $category) {
                $indent = count(explode('-', $category['path']));
                $arrCategory[$key]['indent'] = $indent-1;
            }
            $this->data['categories'] = $arrCategory;
            $this->data['selected_category_id'] = $post['category_id'];
            $this->data['parent_id'] = $post['category_id'];
        // creare form
            $this->data['frmNews'] = frm(NULL, array('id' => 'frmNews'), TRUE);
        $this->template->load('backend/template', 'backend/news/form', $this->data);
    }
// Update
    public function update()
    {
        $id_post = $this->input->post('id', TRUE);
        $code = strtoupper($this->input->post('code', TRUE));
        $category_id = $this->input->post('category_id', TRUE);
        $url = strtolower($this->input->post('url', TRUE));
        // check permission
            if ($id_post == NULL) { // add
                $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 2);
            }
            else {
                $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 3);
            }
        // valid form
            $this->form_validation->set_rules('title', 'Tiêu đề', 'trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('url', 'URL', 'trim|required|max_length[255]|alpha_dash|xss_clean');
            $this->form_validation->set_rules('desc', 'Mổ tả', 'trim|max_length[1025]|xss_clean');
            $this->form_validation->set_message('required', '%s bắt buộc nhập');
            $this->form_validation->set_message('max_length', '%s tối đa 255 ký tự');
            $this->form_validation->set_message('alpha_dash', '%s chỉ gồm [a-z][0-9] và dấu gạch ngang');
            if ( $this->form_validation->run() == FALSE && validation_errors() != "") {
                $msg['err'] = 1;
                $msg['msg'] = validation_errors();
            }
        // valid existed
            else if ($this->is_existed($url, $category_id, $id_post)) {
                $msg['err'] = 1;
                $msg['msg'] = 'Sản phẩm đã tồn tại trong chuyên mục này.';
            }
            else {
                $arr_data = array(
                     'id' => $id_post
                    ,'category_id' => $category_id
                    ,'title' => $this->input->post('title', TRUE)
                    ,'url' => $url
                    ,'description' => $this->input->post('desc', TRUE)
                    ,'thumbnail' => $this->input->post('thumbnail', TRUE)
                    ,'order' => $this->input->post('order', TRUE)
                    ,'status' => $this->input->post('status', TRUE)
                    ,'detail' => $this->input->post('detail', TRUE)
                    ,'datetime' => date('Y-m-d H:i:s')
                    ,'by' => $this->data['authMember']['username']
                );
                if ($id_post == NULL) { // add
                    if ( $this->model->insert_news($arr_data) === FALSE ) {
                        $msg['err'] = 1;
                        $msg['msg'] = 'Error insert new data.';
                    }
                    else {
                        $msg['err'] = 0;
                        $this->session->set_userdata('valid', "Insert new data successful.");
                    }
                }
                else { // edit
                    if ( $this->model->update_news($arr_data) === FALSE ) {
                        $msg['err'] = 1;
                        $msg['msg'] = 'Error update data.';
                    }
                    else {
                        $msg['err'] = 0;
                        $this->session->set_userdata('valid', "Update data successful.");
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
        // delete db
            if ($this->Base_model->delete_post('news', $id) === FALSE) {
                $this->session->set_userdata('invalid', "Error delete data");
            }
            else {
                $this->session->set_userdata('valid', "Delete data successful.");
            }
        redirect($_SERVER['HTTP_REFERER']);
    }
// Multi delete
    public function multi_delete()
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 4);
        // get data
            $ids = $this->input->post('ids', TRUE);
            $arrID = explode(",", $ids[0]);
            $deleted = 0;
            foreach ($arrID as $id) {
            // delete db
                if ($this->Base_model->delete_post('news', $id) !== FALSE) {
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
/* is_existed in category */
    private function is_existed($url, $category_id, $id_post=NULL)
    {
        $sql = "SELECT post.id FROM news
                INNER JOIN post ON post.id = news.post_id
                ";
        if ($id_post == NULL) { // add
            $where = " WHERE news.url = '".$url."' AND post.category_id = '".$category_id."'";
        }
        else { // edit
            $where = " WHERE news.url = '".$url."' AND post.category_id = '".$category_id."' AND post.id <> ".$id_post;
        }
        $sql .= $where;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        if ($result == FALSE || count($result) == 0) {
            return FALSE; // not existed
        }
        return TRUE;
    }
}
