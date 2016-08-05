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
    	$subMenu = $this->uri->segment(2,0);
        switch ($subMenu) {
            case 'gioi-thieu':
            case 'introduction':
                $this->data['activeSubMenu'] = 'introduction';
                $this->data['subCat'] = 'introduction';
                break;
            case 'dich-vu':
            case 'service':
                $this->data['activeSubMenu'] = 'service';
                $this->data['subCat'] = 'service';
                break;
            case 'chung-nhan-chat-luong':
            case 'certification':
                $this->data['activeSubMenu'] = 'certification';
                $this->data['subCat'] = 'certification';
                break;
            default:
                break;
        }

        $this->template->load($this->gate.'/template', $this->gate.'/service', $this->data);
    }


}