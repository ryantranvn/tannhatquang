<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (file_exists(APPPATH . 'controllers/backend/Root.php')) {
    require_once(APPPATH . 'controllers/backend/Root.php');
}

class Price_list extends Root
{

    public function __construct()
    {
        parent::__construct();

        // load
        $this->currentModule = $this->data['modules'][ucfirst($this->router->fetch_class())];
        $this->data['varJS']['currentModule'] = $this->currentModule;
        // load
        $this->load->model($this->currentModule['control_name'] . '_model', 'model');
        $this->load->model('Customer_model');
        $this->data['activeModule'] = $this->currentModule['control_name'];
        $this->data['activeNav'] = $this->currentModule['control_name'];
        $this->data['breadcrumb'][0] = array('name' => "Bảng giá", 'url' => B_URL . $this->currentModule['url']);
        // block js and css
        // array_push($this->data['cssBlock'], '<link rel="stylesheet" type="text/css" href="'. ASSETS_URL . 'backend/css/category.min.css" />');
        array_push($this->data['jsBlock'], '<script language="javascript" type="text/javascript" src="' . ASSETS_URL . 'backend/js/init_height.js"></script>');
        array_push($this->data['jsBlock'], '<script language="javascript" type="text/javascript" src="' . ASSETS_URL . 'backend/js/price_list.js"></script>');
    }

// index
    public function index()
    {
        // check not access
        $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 1);
        // breadcrumb
        $this->data['breadcrumb'][1] = array('name' => 'Danh sách', 'url' => B_URL . $this->currentModule['url']);
        // create frm
        $this->data['frmTopButtons'] = frm(B_URL . $this->currentModule['url'] . '/multi_delete', array('id' => "frmTopButtons"), FALSE);
        $this->data['frmPriceList'] = frm(B_URL . $this->currentModule['url'] . '/submit', array('id' => 'frmPriceList'), FALSE);

        $this->template->load('backend/template', 'backend/price_list', $this->data);
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
        $sql = "SELECT * FROM price_list";
        $where = "";
        if (isset($_GET['filters'])) {
            $params['filters'] = json_decode($_GET['filters']);
            if (count($params['filters']->rules)>0) {
                if ($where == "") {$where .= " WHERE"; } else { $where .= " AND"; }
                foreach($params['filters']->rules as $rule) {
                    $field = $rule->field;
                    $value = $this->db->escape_like_str($rule->data);

                    $where .= " $field LIKE '%$value%'";
                }
            }
        }
        $sql .= $where;
        // return json
        echo json_encode($this->Base_model->table_list_in_page($sql, $params));
    }
// ajax_get_edit
    public function ajax_get_edit()
    {
        $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 3);
        $arrJSON = array();
        $id = $this->input->post('id', TRUE);
        if ($id == FALSE) {
            $msg['err'] = 1;
            $msg['msg'] = "Error data";
        }
        else {
            $arr_date = $this->Base_model->get_db('price_list', NULL, array('id' => $id));
            if ($arr_date==FALSE || count($arr_date)==0) {
                $msg['err'] = 1;
                $msg['msg'] = "Error data";
            }
            else {
                $msg['err'] = 0;
                $msg['price_list'] = $arr_date[0];
            }
        }
        echo json_encode($msg);
    }
// Submit
    public function submit()
    {
        $id = $this->input->post('id', TRUE);
        // check permission
        if ($id == NULL) { // add
            $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 2);
        }
        else {
            $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 3);
        }
    // valid data
        $this->form_validation->set_rules('title', 'Tiêu đề', 'trim|required|max_length[255]|xss_clean');
        $this->form_validation->set_message('required', '%s is not empty');
        $this->form_validation->set_message('max_length', '%s is maximum 255 characters');
        if ( $this->form_validation->run() == FALSE && validation_errors() != "") {
            $this->session->set_userdata('invalid', "Không tìm thấy dữ liệu.");
            redirect(B_URL . $this->currentModule['url']);
        }
        $arr_data = array('title' => $this->input->post('title', TRUE),
            'filename' => $this->input->post('filename', TRUE),
            'desc' => $this->input->post('desc', TRUE),
            'order' => $this->input->post('order', TRUE)
        );
        if ($id == NULL) { // add
            if ( $this->Base_model->insert_db('price_list', $arr_data) === FALSE ) {
                $this->session->set_userdata('invalid', "Lỗi không thể thêm dữ liệu mới.");
            }
            else {
                $this->session->set_userdata('valid', "Đã thêm dữ liệu mới thành công.");
            }
        }
        else {  // edit
            if ( $this->Base_model->update_db('price_list', $arr_data, array('id'=>$id)) === FALSE ) {
                $this->session->set_userdata('invalid', "Lỗi không thể cập nhật dữ liệu mới.");
            }
            else {
                $this->session->set_userdata('valid', "Đã cập nhật dữ liệu thành công.");
            }
        }

        redirect(B_URL . $this->currentModule['url']);
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
        if ($this->Base_model->delete_db('price_list', 'id', $id) === FALSE) {
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
            if ($this->Base_model->delete_db('price_list', 'id', $id) !== FALSE) {
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
}