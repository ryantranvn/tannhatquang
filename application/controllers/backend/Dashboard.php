<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/backend/Root.php')) {
    require_once(APPPATH . 'controllers/backend/Root.php');
}

class Dashboard extends Root {

	private $module = 'dashboard';

    public function __construct()
    {
        parent::__construct();
        $this->currentModule = $this->data['modules'][ucfirst($this->router->fetch_class())];
        $this->data['varJS']['currentModule'] = $this->currentModule;

        $this->data['activeModule'] = $this->currentModule['control_name'];
        $this->data['activeNav'] = $this->currentModule['control_name'];
        $this->data['breadcrumb'][0] = array('name'=>$this->currentModule['control_name'], 'url' => B_URL . $this->currentModule['url']);

        // block js and css
            // array_push($this->data['cssBlock'], '<link rel="stylesheet" type="text/css" href="'. ASSETS_URL . 'backend/css/category.min.css" />');
        	// array_push($this->data['jsBlock'], '<script language="javascript" type="text/javascript" src="'. ASSETS_URL . 'backend/js/category.min.js"></script>');
        // status array
            // $this->data['statusArr'] = array(
                //  'active' => '<button class="btn bg-color-green txt-color-white" data-value="active">Active</button>'
                // ,'inactive' => '<button class="btn bg-color-blueDark txt-color-white" data-value="inactive">Inactive</button>'
                // ,'block' => '<button class="btn bg-color-red txt-color-white" data-value="block">Block</button>'
            // );
    }
// index
    public function index()
    {
        $this->template->load('backend/template', 'backend/dashboard', $this->data);
        // $this->load->view('backend/dashboard',$this->data);
    }


}
