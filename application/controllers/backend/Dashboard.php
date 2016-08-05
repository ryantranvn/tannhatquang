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

        $this->data['activeModule'] = $this->module;
        $this->data['activeNav'] = "dashboard";
        $this->data['breadcrumb'][0] = array('name'=>ucfirst($this->module), 'url' => B_URL . $this->router->fetch_class());
    }
// index
    public function index()
    {
        
        $this->template->load('backend/template', 'backend/dashboard', $this->data);
        // $this->load->view('backend/dashboard',$this->data);
    }


}