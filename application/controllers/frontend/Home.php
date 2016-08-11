<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/frontend/Root.php')) {
    require_once(APPPATH . 'controllers/frontend/Root.php');
}

class Home extends Root {

    public function __construct()
    {
        parent::__construct();

        $this->data['activeMenu'] = 'home';
    }
// HOME
    public function index()
    {
    	$this->data['url']['vn'] = F_URL . 'vn';
        $this->data['url']['en'] = F_URL . 'en';

        $this->template->load($this->gate.'/template', $this->gate.'/home', $this->data);
    }

// get user data to autofill
    public function ajax_get_user()
    {
        $type = $this->input->post('type',TRUE);
        $inputData = $this->input->post('inputData',TRUE);

        $userData = $this->Base_model->getDB('db','user',NULL,array($type => $inputData));
        if ($userData == FALSE || count($userData)==0) {
            $arrJSON['error'] = 1;
        }
        else {
            $arrJSON['error'] = 0;
            $arrJSON['user'] = $userData[0];
        }

        echo json_encode($arrJSON);
    }
}