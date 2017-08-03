<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (file_exists(APPPATH . 'libraries/Mobile_Detect.php')) {
    require_once(APPPATH . 'libraries/Mobile_Detect.php');
}
if (file_exists(APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php')) {
    require_once(APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php');
}

class Root extends CI_Controller {

    public $data = array();
    public $gate = "frontend";

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('User_model');

    // detect Mobile device
        $detect = new Mobile_Detect;
        if ( $detect->isMobile() || $detect->isTablet() ) {
            // redirect(mUrl());
            $this->data['device'] = 'mobile';
        }
        else {
            $this->data['device'] = 'pc';
        }
    // authUser
        $this->data['authUser'] = array();
        if ($this->session->userdata('authUser') != FALSE) {
            $this->data['authUser'] = $this->session->userdata('authUser');
        }
    // pass data to JS
        $this->data['varJS']['authUser'] = $this->data['authUser'];
        if ($this->session->userdata('invalidUser') != FALSE) {
            $this->data['varJS']['invalidUser'] = $this->session->userdata('invalidUser');
            $this->session->unset_userdata('invalidUser');
        }
        else {
            $this->data['varJS']['invalidUser'] = "";
        }

    // text config something
        $this->data['page']['title'] = PAGE_NAME;
        $this->data['altImg'] = PAGE_NAME;
        $this->data['onair'] = ONAIR;
        $this->data['imgAlt'] = "Tân Nhật Quang";

    // Meta tag
        $this->data['pageTitle'] = "Tân Nhật Quang";
        $meta = array('description'=>'',
                      'keywords'=>'',
                      'author'=>'Tân Nhật Quang'
                     );
        $this->data['meta'] = $meta;

    // more blocks
        $this->data['cssBlock'] = array();
        $this->data['jsBlock'] = array();
    }

    public function index()
    {
        // Some example data
    }

    public function is_authUser()
    {
        if ($this->data['authUser']==FALSE || count($this->data['authUser'])==0) {
            return FALSE;
        }
        return TRUE;
    }
}
