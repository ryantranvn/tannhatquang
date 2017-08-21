<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Root extends CI_Controller {

    public $data = array();

    public function __construct()
    {
        parent::__construct();

			// if (!in_array ($_SERVER['REMOTE_ADDR'], array("115.79.63.188"))) {
			//    redirect(F_URL);
			// }
		// load
	        $this->load->helper('form');
	        $this->load->library('form_validation');
	        $this->form_validation->set_error_delimiters('', '');

	        $this->load->library('PHPExcel');
	        $this->load->model('Permission_model');
	    // page info
	        $this->data['project']['folder'] = PROJECT_FOLDER;
	        $this->data['project']['name'] = PAGE_NAME;
	        $this->data['project']['logo'] = LOGO_URL;
	        $this->data['page']['title'] = "Admin Control Panel";

	    // Auth & Permissions
	        if ( $this->session->userdata('authMember') == FALSE) {
	            redirect(B_URL.'auth');
	        }
            $this->data['authMember'] = $this->session->userdata('authMember');
            $this->data['permissionsMember'] = $this->Permission_model->get_memberPermissions($this->data['authMember']['id']);
	    // Menu
	        $modules = $this->Base_model->get_db('module',NULL, NULL ,NULL,'order','asc');
	        $arrModules  = array();
	        foreach ($modules as $module) {
                $arrModules[$module['control_name']] = $module;
	        }
            $this->data['modules'] = $arrModules;

        	// print_r("<pre>"); print_r($arrModules); exit();
        // Reply Template
        	$this->data['reply'] = reply();

        // pass data to JS
        	$this->data['varJS']['authMember'] = $this->data['authMember'];
        	$this->data['varJS']['permissionsMember'] = $this->data['permissionsMember'];
            $this->data['varJS']['url'] = array('view_backend'=>APPPATH.'views/backend/');
	        if ($this->session->userdata('replyError') !== FALSE) {
	            $this->data['varJS']['replyErrorContent'] = $this->session->userdata('replyError');
	            $this->session->unset_userdata('replyError');
	        }
        // block js & css
            $this->data['cssBlock'] = array();
            $this->data['jsBlock'] = array();

            $this->data['css_version'] = time();
            $this->data['js_version'] = time();
	}

// index
    public function index()
    {
    }

// Permission member
    public function havePermission($permissionMember, $module, $id_permission)
    {
        if ($permissionMember[$module][$id_permission] == 1) {
            return TRUE;
        }
        return FALSE;
    }
// not access => show 404
    public function noAccess($permissionMember, $module, $id_permission)
    {
        if (!$this->havePermission($permissionMember, $module, $id_permission)) {
            redirect(B_URL . 'page404');
        }
    }
}
