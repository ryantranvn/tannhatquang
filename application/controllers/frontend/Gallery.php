<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/frontend/Root.php')) {
    require_once(APPPATH . 'controllers/frontend/Root.php');
}

class Gallery extends Root {

    public function __construct()
    {
        parent::__construct();

        $this->data['activeMenu'] = 'gallery';
        $this->data['page'] = 'gallery';
    }
// GALLERY
    public function index()
    {
    	$subMenu = $this->uri->segment(3,0);
        switch ($subMenu) {
            case 'xe-truoc-va-sau-dich-vu':
            case 'before-after':
                $this->data['activeSubMenu'] = 'beforeafter';
                $this->data['subCat'] = 'beforeafter';
                $this->data['url']['vn'] = F_URL . 'vn/thu-vien/xe-truoc-va-sau-dich-vu';
                $this->data['url']['en'] = F_URL . 'en/gallery/before-after';
                break;
            case 'su-kien-khac':
            case 'event':
                $this->data['activeSubMenu'] = 'event';
                $this->data['subCat'] = 'event';
                $this->data['url']['vn'] = F_URL . 'vn/thu-vien/su-kien-khac';
                $this->data['url']['en'] = F_URL . 'en/gallery/event';
                break;
            default:
                break;
        }

        $this->template->load($this->gate.'/template', $this->gate.'/gallery', $this->data);
    }

// ajax_gallery
    public function ajax_gallery()
    {
        $arrJSON = array();

        echo json_encode($arrJSON);
    }

}