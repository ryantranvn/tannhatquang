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
// Submit
    public function submit()
    {
        // check permission
        $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 2);
        // breadcrumb
        $this->data['breadcrumb'][1] = array('name' => 'Thêm mới', 'url' => '');



    }
}