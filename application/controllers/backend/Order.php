<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (file_exists(APPPATH . 'controllers/backend/Root.php')) {
    require_once(APPPATH . 'controllers/backend/Root.php');
}

class Order extends Root
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
        $this->data['breadcrumb'][0] = array('name' => "Đơn hàng", 'url' => B_URL . $this->currentModule['url']);
        // block js and css
        // array_push($this->data['cssBlock'], '<link rel="stylesheet" type="text/css" href="'. ASSETS_URL . 'backend/css/category.min.css" />');
        array_push($this->data['jsBlock'], '<script language="javascript" type="text/javascript" src="' . ASSETS_URL . 'backend/js/init_height.js"></script>');
        array_push($this->data['jsBlock'], '<script language="javascript" type="text/javascript" src="' . ASSETS_URL . 'backend/js/order.js"></script>');
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
        //$this->data['frmImport'] = frm(B_URL.$this->currentModule['url'].'/import', array('id' => "frmImport"), TRUE);

        $this->template->load('backend/template', 'backend/order', $this->data);
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
        $sql = "SELECT  o.id
                        ,o.customer_id
                        ,o.customer_address_id
                        ,o.note
                        ,o.total
                        ,o.status
                        ,o.created_datetime
                        ,IF (o.customer_address_id IS NOT NULL, ca.address, ca.address=NULL) as address
                        ,ca.province_id
                        ,p.name AS province
                        ,ca.district_id
                        ,d.name AS district
                        ,ca.status as address_status
                        ,ca.customer_id
                        ,c.fullname
                        ,c.phone
                    FROM `order` AS o
                    LEFT JOIN `customer` AS c ON c.id = o.customer_id
                    LEFT OUTER JOIN `customer_address` AS ca ON ca.id = o.customer_address_id OR o.customer_address_id IS NULL
                    LEFT OUTER JOIN `province` AS p ON p.id = ca.province_id AND o.customer_address_id IS NOT NULL
                    LEFT OUTER JOIN `district` AS d ON d.id = ca.district_id AND o.customer_address_id IS NOT NULL
            ";

        if ( $params['sidx'] == "address") {
            $params['sidx'] = "ca." . $params['sidx'];
        }
        else if ( $params['sidx'] == "province") {
            $params['sidx'] = "p.name";
        }
        else if ( $params['sidx'] == "district") {
            $params['sidx'] = "d.name";
        }
        else if ( $params['sidx'] == "phone") {
            $params['sidx'] = "c.phone";
        }
        else if ( $params['sidx'] == "fullname") {
            $params['sidx'] = "c.fullname";
        }
        else {
            $params['sidx'] = "o." . $params['sidx'];
        }

        $where = " WHERE ca.del_flg = 0 AND o.del_flg = 0";
        if (isset($_GET['filters'])) {
            $params['filters'] = json_decode($_GET['filters']);
            if (count($params['filters']->rules)>0) {
                foreach($params['filters']->rules as $rule) {
                    if ($where == "") {$where .= "WHERE"; } else { $where .= " AND"; }
                    $field = $rule->field;
                    $value = $this->db->escape_like_str($rule->data);
                    if ($field == "status") {
                        $where .= " o.status='" . $value . "'";
                    }
                    else if ($field == "id") {
                        $where .= " o.id LIKE '%" . $value . "%'";
                    }
                    else if ($field == "total") {
                        $where .= " o.total LIKE '%" . $value . "%'";
                    }
                    else if ($field == "created_datetime") {
                        $where .= " o.created_datetime LIKE '%" . $value . "%'";
                    }
                    else if ($field == "fullname") {
                        $where .= " c.fullname LIKE '%" . $value . "%'";
                    }
                    else if ($field == "phone") {
                        $where .= " c.phone LIKE '%" . $value . "%'";
                    }
                    else if ($field == "address") {
                        $where .= " ca.address LIKE '%" . $value . "%'";
                    }
                    else if ($field == "province") {
                        $where .= " p.name LIKE '%" . $value . "%'";
                    }
                    else if ($field == "district") {
                        $where .= " d.name LIKE '%" . $value . "%'";
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
        if ($this->Base_model->update_db('order', array('status'=>$value), array('id' => $id)) === FALSE) {
            echo "false";
        }
        else {
            echo "true";
        }
    }
// Edit
    public function edit($order_id)
    {
        // check permission
        $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 3);
        // breadcrumb
        $this->data['breadcrumb'][1] = array('name'=>'Chi tiết', 'url' => '');

    // get order information
        $frmData = $this->model->get_order($order_id);
        if ($frmData == FALSE || count($frmData)==0) {
            $this->session->set_userdata('invalid', "Không tìm thấy dữ liệu.");
            redirect(B_URL . $this->currentModule['url']);
        }
        $this->data['frmData'] = $frmData[0];
        $customer_id = $frmData[0]['customer_id'];
    // get customer information
        $customer = $this->Base_model->get_db('customer',NULL,array('id'=>$customer_id));
        if ($customer == FALSE || count($customer)==0) {
            $this->session->set_userdata('invalid', "Không tìm thấy dữ liệu.");
            redirect(B_URL . $this->currentModule['url']);
        }
        $this->data['customer'] = $customer[0];
    // get customer_address
        $customer_address = $this->Base_model->get_address($customer_id, 1);
        if ($customer_address != FALSE || count($customer_address)>0) {
            $this->customer_address = $customer_address[0];
        }
    // get order_address
        if ($frmData[0]['customer_address_id']!='') {
            $order_address = $this->Base_model->get_order_address($frmData[0]['customer_address_id']);
            if ($customer_address == FALSE || count($customer_address)==0) {
                $this->order_address = $customer_address[0];
            }
        }

        // get order detail
        $order_detail = $this->model->get_order_detail($order_id);
        if ($order_detail == FALSE || count($order_detail)==0) {
            $this->session->set_userdata('invalid', "Không tìm thấy dữ liệu.");
            redirect(B_URL . $this->currentModule['url']);
        }
        $this->data['order_detail'] = $order_detail;
//        print_r("<pre>");
//        print_r($order_detail);
//        exit();

        // create form
        $this->data['frmOrder'] = frm(B_URL .$this->currentModule['url'] . '/update', array('id' => 'frmOrder'), FALSE, array('order_id'=>$order_id));

        $this->template->load('backend/template', 'backend/order/form', $this->data);
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
        if ($this->Base_model->update_db('order', array('del_flg'=>1), array('id'=>$id)) === FALSE) {
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
            if ($this->Base_model->update_db('order', array('del_flg'=>1), array('id'=>$id)) !== FALSE) {
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