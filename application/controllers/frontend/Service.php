<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/frontend/Root.php')) {
    require_once(APPPATH . 'controllers/frontend/Root.php');
}

class Service extends Root {

    public function __construct()
    {
        parent::__construct();

        $this->data['activeMenu'] = 'service';
        $this->data['page'] = 'service';
    }

// SERVICE
    public function index()
    {
    	$subMenu = $this->uri->segment(3,0);
        switch ($subMenu) {
            case 'gioi-thieu':
            case 'introduction':
                $this->data['activeSubMenu'] = 'introduction';
                $this->data['subCat'] = 'introduction';
                $this->data['url']['vn'] = F_URL . 'vn/dich-vu/gioi-thieu';
                $this->data['url']['en'] = F_URL . 'en/service/introduction';
                break;
            case 'dich-vu':
            case 'service':
                $this->data['activeSubMenu'] = 'service';
                $this->data['subCat'] = 'service';
                $this->data['url']['vn'] = F_URL . 'vn/dich-vu/dich-vu';
                $this->data['url']['en'] = F_URL . 'en/service/service';
                break;
            case 'chung-nhan-chat-luong':
            case 'certification':
                $this->data['activeSubMenu'] = 'certification';
                $this->data['subCat'] = 'certification';
                $this->data['url']['vn'] = F_URL . 'vn/dich-vu/chung-nhan-chat-luong';
                $this->data['url']['en'] = F_URL . 'en/service/certification';
                break;
            default:
                break;
        }
        

        $this->template->load($this->gate.'/template', $this->gate.'/service', $this->data);
    }


}