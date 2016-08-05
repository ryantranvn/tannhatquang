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

    // Lang
        $this->data['lang'] = $this->session->userdata('site_lang');
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

    // set value to transfer to javascript
        /*
        $varJS = array('projectName' => PAGE_NAME, 'projectFolder' => PROJECT_FOLDER);
        $varJS['assetsUrl'] = F_URL . 'assets/';
        $varJS['fUrl'] = F_URL;
        // $varJS['libsUrl'] = F_URL . 'libs/';
        // $varJS['uploadDir'] = F_URL . 'upload/';
        // $varJS['lang'] = $this->data['lang'];
        $varJS['device'] = $this->data['device'];
        
        $varJS['valid'] = $varJS['invalid'] = $varJS['validationType'] = "";
        if ($this->session->userdata('invalid')!==FALSE) {
            $varJS['invalid'] = $this->session->userdata('invalid');
            $varJS['validationType'] = $this->session->userdata('validationType');
            $this->data['invalidData'] = $this->session->userdata('invalidData');

            $this->session->unset_userdata('invalid');
            $this->session->unset_userdata('validationType');
            $this->session->unset_userdata('invalidData');
        }
        if ($this->session->userdata('valid')!==FALSE) {
            $varJS['valid'] = $this->session->userdata('valid');
            $varJS['validationType'] = $this->session->userdata('validationType');

            $this->session->unset_userdata('valid');
            $this->session->unset_userdata('validationType');
        }
       
        // FB
            // $varJS['fb_id'] = FBAPP_ID;
            //$varJS['fb_secret'] = FBAPP_SECRET;
            // $varJS['fb_fanpage'] = FANPAGE_ID;
            //$varJS['fb_scope'] = FBSCOPE;
            //$varJS['fb_redirectUrl'] = FB_REDIRECT_URL;
        
        // csrf
            // $varJS['csrf_name'] = $this->security->get_csrf_token_name();
            $varJS['csrf_hash'] = $this->security->get_csrf_hash();

        $this->data['varJS'] = json_encode($varJS);
        */

    }

    public function index()
    {
        // Some example data
    }

}
