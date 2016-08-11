<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/Mobile_Detect.php');

class Root extends CI_Controller {

    public $data = array();
    public $gate = "frontend";

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('User_model');

        $urlLang = $this->uri->segment(1,0);
        if ($urlLang == FALSE || $urlLang == "") {
            $urlLang = 'vn';
            redirect(F_URL.'vn');
        }
        // echo $urlLang; die();

    // Lang
        $this->data['lang'] = $urlLang;
        // $this->data['lang'] = $this->session->userdata('site_lang');
        if ($this->data['lang']) {
            $this->lang->load('root',$this->data['lang']);
        } else {
            $this->data['lang'] = 'vn';
            $this->lang->load('root','vn');
        }
        $this->data['navigator'] = $this->lang->line('navigator');
        $this->data['navigatorSub'] = $this->lang->line('navigatorSub');
        $this->data['links'] = $this->lang->line('links');
        $this->data['breadcrumb'] = $this->lang->line('breadcrumb');
        $this->data['errorText'] = $this->lang->line('errorText');
        $this->data['car'] = $this->lang->line('car');
        $this->data['mercedes'] = $this->lang->line('mercedes');


    // detect Mobile device
        $detect = new Mobile_Detect;
        if ( $detect->isMobile() || $detect->isTablet() ) {
            // redirect(mUrl());
            $this->data['device'] = 'mobile';
        }
        else {
            $this->data['device'] = 'pc';
        }

    // pass data to JS
        $this->data['varJS']['authUser'] = array();//$this->data['authUser'];
        if ($this->session->userdata('invalid') !== FALSE) {
            $this->data['varJS']['invalid'] = $this->session->userdata('invalid');
            $this->session->unset_userdata('invalid');
        }
        $this->data['varJS']['errorText'] = $this->data['errorText'];

    // frm contact
        $form_attr = array('name' => 'frmContact', 'id' => 'frmContact');
        $form_action = F_URL.'contact/ajax_submit';
        $this->data['frmContact'] = frm($form_action, $form_attr, FALSE, NULL);

    // text config something
        $this->data['activeSubMenu'] = '';
        $this->data['page']['title'] = PAGE_NAME;
        $this->data['altImg'] = PAGE_NAME;
        $this->data['onair'] = ONAIR;

    }

    public function index()
    {
        // Some example data
    }

}
