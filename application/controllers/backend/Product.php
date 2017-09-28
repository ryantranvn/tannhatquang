<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (file_exists(APPPATH . 'controllers/backend/Root.php')) {
    require_once(APPPATH . 'controllers/backend/Root.php');
}
class Product extends Root {

    private $path = '0-1-';
    private $id = '1';
    private $name = 'Sản phẩm';

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
        	array_push($this->data['jsBlock'], '<script language="javascript" type="text/javascript" src="'. ASSETS_URL . 'backend/js/product.js"></script>');
            array_push($this->data['jsBlock'], '<script language="javascript" type="text/javascript" src="'. ASSETS_URL . 'backend/js/tree.js"></script>');
        // status array
            $this->data['statusArr'] = array(
                 'active' => '<button class="btn bg-color-green txt-color-white" data-value="active">Active</button>'
                ,'inactive' => '<button class="btn bg-color-blueDark txt-color-white" data-value="inactive">Inactive</button>'
                // ,'block' => '<button class="btn bg-color-red txt-color-white" data-value="block">Block</button>'
            );
        $this->data['is_sub_category'] = 1;
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
            $this->data['selected_category_id'] = $this->id;
            $this->data['selected_category_name'] = $this->name;
        // create frm
            $this->data['frmTopButtons'] = frm(B_URL.$this->currentModule['url'].'/multi_delete', array('id' => "frmTopButtons"), FALSE);
            $this->data['frmImport'] = frm(B_URL.$this->currentModule['url'].'/import', array('id' => "frmImport"), TRUE);
            $this->data['frmProduct'] = frm('', array('id' => 'frmProduct'), TRUE);
        // get error_file from import
            if ($this->session->userdata('error_file') != FALSE) {
                $this->data['error_file'] = $this->session->userdata('error_file');
                $this->session->unset_userdata('error_file');
            }

        $this->template->load('backend/template', 'backend/product', $this->data);
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
                        ,post.del_flg
                        ,post.status
                        ,product.id AS product_id
                        ,product.post_id
                        ,product.code
                        ,product.name
                        ,product.unit
                        ,product.order
                        ,product.quantity
                        ,product.stock_in_trade
                        ,product.price
                        ,category.name AS category
                    FROM post
                    INNER JOIN product ON product.post_id = post.id
                    LEFT JOIN category ON category.id = post.category_id
                    ";
            if ( $params['sidx'] == "category_name") {
                $params['sidx'] = "category." . $params['sidx'];
            }
            else if ( $params['sidx'] == "id" || $params['sidx'] == "type" || $params['sidx'] == "del_flg") {
                $params['sidx'] = "post." . $params['sidx'];
            }
            else {
                $params['sidx'] = "product." . $params['sidx'];
            }
            $where = "WHERE post.type='product'";
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
                            else if ($field == "id" || $field == "del_flg" || $field == "type") {
                                $where .= " post." . $field . " LIKE '%" . $value . "%'";
                            }
                            else {
                                $where .= " product." . $field . " LIKE '%" . $value . "%'";
                            }
                        }
                    }
                }
            }
            $sql .= $where;
            $list = $this->Base_model->table_list_in_page($sql, $params);
            // get pictures
            foreach ($list['rows'] as $key => $item) {
                $pictures = $this->Base_model->get_db('post_picture', array('url'), array('post_id'=>$item['post_id']));
                $list['rows'][$key]['pictures'] = array();
                foreach ($pictures as $picture) {
                    array_push($list['rows'][$key]['pictures'], $picture['url']);
                }
            }

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
            $this->data['selected_category_id'] = $this->id;
            $this->data['selected_category_name'] = $this->name;
            $this->data['parent_id'] = 0;
        // creare form
            $this->data['frmProduct'] = frm(NULL, array('id' => 'frmProduct'), TRUE);
        $this->template->load('backend/template', 'backend/product/form', $this->data);
    }
// edit
    public function edit($post_id)
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 3);
        // breadcrumb
            $this->data['breadcrumb'][1] = array('name'=>'Edit', 'url' => '');
        // get post
            $posts = $this->Base_model->get_post('product', $post_id);
            if ($posts === FALSE && count($posts)==0) {
                $this->session->set_userdata('invalid', "Không tìm thấy dữ liệu.");
                redirect(B_URL . $this->currentModule['url']);
            }
            $this->data['frmData'] = $post = $posts[0];
            $pictures = $this->Base_model->get_db('post_picture', NULL, array('post_id' => $post_id));
            if ($pictures !== FALSE && count($pictures)>0) {
                $this->data['pictures'] = $pictures;
                $str = "[";
                foreach ($pictures as $key => $picture) {
                    if ($key!=0) {
                        $str .= ",";
                    }
                    $str .= '"' . $picture['url']. '"';
                }
                $str .= "]";
                $this->data['picture_input'] = $str;
            }
        // get category tree
            $arrCategory = $this->Base_model->get_db('category', NULL, NULL, array('path'=>$this->path), array('path','order','name'), array('asc','asc','asc'));
            foreach ($arrCategory as $key => $category) {
                $indent = count(explode('-', $category['path']));
                $arrCategory[$key]['indent'] = $indent-1;
            }
            $this->data['categories'] = $arrCategory;
            $this->data['selected_category_id'] = $post['category_id'];
            $this->data['selected_category_name'] = $post['category_name'];
            $this->data['parent_id'] = $post['category_id'];
        // creare form
            $this->data['frmProduct'] = frm(NULL, array('id' => 'frmProduct'), TRUE);
        $this->template->load('backend/template', 'backend/product/form', $this->data);
    }
// update
    public function update()
    {
        $post_id = $this->input->post('post_id', TRUE);
        $code = strtoupper($this->input->post('code', TRUE));
        $category_id = $this->input->post('category_id', TRUE);
        $url = strtolower($this->input->post('url', TRUE));
        // check permission
            if ($post_id == NULL) { // add
                $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 2);
            }
            else {
                $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 3);
            }
        // valid form
            $this->form_validation->set_rules('code', 'Mã sản phẩm', 'trim|required|max_length[20]|xss_clean');
            $this->form_validation->set_rules('name', 'Tên sản phẩm', 'trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('url', 'URL', 'trim|required|max_length[255]|alpha_dash|xss_clean');
            $this->form_validation->set_rules('desc', 'Mô tả', 'trim|max_length[1025]|xss_clean');
            $this->form_validation->set_message('required', '%s bắt buộc nhập');
            $this->form_validation->set_message('max_length', '%s tối đa 255 ký tự');
            $this->form_validation->set_message('alpha_dash', '%s chỉ gồm [a-z][0-9] và dấu gạch ngang');
            if ( $this->form_validation->run() == FALSE && validation_errors() != "") {
                $msg['err'] = 1;
                $msg['msg'] = validation_errors();
            }
        // valid existed
            else if ($this->is_existed_code($code, $post_id)) {
                $msg['err'] = 1;
                $msg['msg'] = 'Mã sản phẩm đã tồn tại';
            }
            /*
            else if ($this->is_existed($url, $category_id, $post_id)) {
                $msg['err'] = 1;
                $msg['msg'] = 'Sản phẩm đã tồn tại trong chuyên mục này.';
            }*/
            else {
            // array for picture
                $thumbnail = $this->input->post('thumbnail', TRUE);
                $arrPicture = explode(",", str_replace('"', '', substr($thumbnail, 1, strlen($thumbnail)-2)));
                $productData = array(
                     'post_id' => $post_id
                    ,'code' => $code
                    ,'category_id' => $category_id
                    ,'category_name' => $category_name
                    ,'name' => $this->input->post('name', TRUE)
                    ,'url' => $url
                    ,'description' => $this->input->post('desc', TRUE)
                    ,'manufacturer' => $this->input->post('manufacturer', TRUE)
                    ,'unit' => $this->input->post('unit', TRUE)
                    ,'price' => $this->input->post('price', TRUE)
                    ,'price_sale' => $this->input->post('price_sale', TRUE)
                    ,'price_sale_percent' => $this->input->post('price_sale_percent', TRUE)
                    ,'quantity' => $this->input->post('quantity', TRUE)
                    ,'arrPicture' => $arrPicture
                    ,'order' => $this->input->post('order', TRUE)
                    ,'status' => $this->input->post('status', TRUE)
                    ,'detail' => $this->input->post('detail', TRUE)
                    ,'by' => $this->data['authMember']['username']
                );
                if ($post_id == NULL) { // add
                    if ( $this->model->insert_product($productData) === FALSE ) {
                        $msg['err'] = 1;
                        $msg['msg'] = 'Error insert new data.';
                    }
                    else {
                        $msg['err'] = 0;
                        $this->session->set_userdata('valid', "Insert new data successful.");
                    }
                }
                else { // edit
                    $pictures = $this->Base_model->get_db('post_picture', NULL, array('post_id' => $post_id));
                    $arr_new = $arr_old = $arr_del = array();
                    // find picture need delete
                    foreach ($pictures as $picture) {
                        array_push($arr_old, $picture['url']);
                        if (in_array($picture['url'], $arrPicture) === FALSE) {
                            array_push($arr_del, $picture['url']);
                        }
                    }
                    // find picture need insert
                    foreach ($arrPicture as $key => $pic) {
                        if (in_array($pic, $arr_old) === FALSE) {
                            array_push($arr_new, $pic);
                        }
                    }
                    if ( $this->model->update_product($productData, $arr_del, $arr_new) === FALSE ) {
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
            if ($this->Base_model->delete_post('product', $id) === FALSE) {
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
                if ($this->Base_model->delete_post('product', $id) !== FALSE) {
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
/*
 * import
 * case category not existed or code existed => not insert => return download file contains error product
 */
    public function import()
    {
        if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
            $inputFileName = $_FILES['importFile']['tmp_name'];
            $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
            $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,null,null,null,null);
            $importData = array();
            foreach ($sheetData as $key => $row) {
                if ($key > 0 && $this->security->xss_clean($row[0]) != "") {
                    $arr = array();
                    $arr['code'] = strtoupper($this->security->xss_clean($row[1]));
                    $arr['name'] = $this->security->xss_clean($row[2]);
                    $arr['unit'] = $this->security->xss_clean($row[3]);
                    $arr['quantity'] = $this->security->xss_clean($row[4]);
                    $arr['price'] = $this->security->xss_clean($row[5]);
                    $arr['category_id'] = $this->security->xss_clean($row[6]);
                    $arr['manufacturer'] = $this->security->xss_clean($row[7]);
                    $arr['url'] = url_str($arr['name']);
                    array_push($importData, $arr);
                }
            }
            $import_result = $this->model->import_db($importData);
            if (is_array($import_result) && count($import_result)>0) {
                // create excel file
                $arr_title = array('code','name','unit','quantity','price','category_id','manufacturer','url');
                $error_file = export_excel($arr_title, $import_result, TRUE, FALSE);
                $this->session->set_userdata('error_file', $error_file);
            }
            $this->session->set_userdata('valid', "Import data successful.");
        }
        redirect(B_URL . $this->router->fetch_class());
    }
/* MORE */
    private function is_existed_code($code, $post_id=NULL)
    {
        $sql = "SELECT id FROM product";
        if ($post_id == NULL) { // add
            $where = " WHERE code = '".$code."'";
        }
        else { // edit
            $where = " WHERE code = '".$code."' AND post_id <> ".$post_id;
        }
        $sql .= $where;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        if ($result==FALSE || count($result)==0) {
            return FALSE; // not existed
        }
        return TRUE;
    }
    /* is_existed in category */
    private function is_existed($url, $category_id, $id_post=NULL)
    {
        $sql = "SELECT post.id FROM product
                INNER JOIN post ON post.id = product.post_id
                ";
        if ($id_post == NULL) { // add
            $where = " WHERE product.url = '".$url."' AND post.category_id = '".$category_id."'";
        }
        else { // edit
            $where = " WHERE product.url = '".$url."' AND post.category_id = '".$category_id."' AND post.id <> ".$id_post;
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
