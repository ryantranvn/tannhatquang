<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Root extends CI_Controller {

    public $data = array();

    public function __construct()
    {
        parent::__construct();

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
	        else {
	            $this->data['authMember'] = $this->session->userdata('authMember');
	            $this->data['permissionsMember'] = $this->Permission_model->get_MemberPermissions('db', $this->data['authMember']['id']);
	            // print_r("<pre>");print_r($this->data['permissionsMember']);die();
	        }
	    // Menu
	        $modules = $this->Base_model->getDB('db','module',NULL, NULL ,NULL,'order','asc');
	        $arrMobdules = array();
	        foreach ($modules as $module) {
	        	$arrMobdules[$module['url']] = $module;
	        }
        	$this->data['modules'] = $arrMobdules;
        // Reply Template
        	$this->data['reply'] = reply();

        // pass data to JS
        	$this->data['varJS']['authMember'] = $this->data['authMember'];
        	$this->data['varJS']['permissionsMember'] = $this->data['permissionsMember'];
	        if ($this->session->userdata('replyError') !== FALSE) {
	            $this->data['varJS']['replyErrorContent'] = $this->session->userdata('replyError');
	            $this->session->unset_userdata('replyError');
	        }
	}

// index
    public function index()
    {
        // Some example data
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