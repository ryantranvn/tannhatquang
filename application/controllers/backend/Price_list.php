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
        $this->data['frmPriceList'] = frm(NULL, array('id' => 'frmPriceList'), TRUE);

        $this->template->load('backend/template', 'backend/price_list', $this->data);
    }
// Add
/*
    public function add()
    {
        // check permission
        $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 2);
        // breadcrumb
        $this->data['breadcrumb'][1] = array('name' => 'Thêm mới', 'url' => '');

        // creare form


        $this->template->load('backend/template', 'backend/price_list/form', $this->data);
    }
*/
}