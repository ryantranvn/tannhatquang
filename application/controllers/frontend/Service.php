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
        // $gioithieu = $this->Base_model->getDB('db','post',NULL,array('parent_id'=>3,'status'=>'active'),NULL,array('id'),array('desc'));
        // $this->data['gioithieu'] = $gioithieu[0];
        // $dichvu = $this->Base_model->getDB('db','post',NULL,array('parent_id'=>4,'status'=>'active'),NULL,array('id'),array('desc'));
        // $this->data['dichvu'] = $dichvu;
        // $chungnhan = $this->Base_model->getDB('db','post',NULL,array('parent_id'=>5,'status'=>'active'),NULL,array('id'),array('desc'));
        // $this->data['chungnhan'] = $chungnhan;
        $gioithieu = $this->Base_model->getDB('db','post',NULL,array('status'=>'active','id'=>64));
        $this->data['gioithieu'] = $gioithieu[0];
        $dichvu = $this->Base_model->getDB('db','post',NULL,array('status'=>'active','id'=>65));
        $this->data['dichvu'] = $dichvu[0];
        $chungnhan = $this->Base_model->getDB('db','post',NULL,array('status'=>'active','id'=>66));
        $this->data['chungnhan'] = $chungnhan[0];

    	$subMenu = $this->uri->segment(3,0);
        $urlDetail = $this->uri->segment(4,0);
        switch ($subMenu) {
            case 'gioi-thieu':
            case 'introduction':
                $this->data['activeSubMenu'] = 'introduction';
                $this->data['subCat'] = 'introduction';
                $this->data['url']['vn'] = F_URL . 'vn/dich-vu/gioi-thieu';
                $this->data['url']['en'] = F_URL . 'en/service/introduction';
                $banner = $this->Base_model->getDB('db','post',array('url','url_en'),array('parent_id'=>11,'type'=>'service-introduction'));
                $this->data['banner'] = $banner[0];
                /*
                    if ($urlDetail == FALSE || $urlDetail=="") {
                        $this->data['detail'] = $gioithieu[0];
                    }
                    else {
                        if ($this->data['lang']=="vn") {
                            $detail = $this->Base_model->getDB('db','post',NULL,array('parent_id'=>3,'status'=>'active','url'=>$urlDetail));
                        }
                        else {
                            $detail = $this->Base_model->getDB('db','post',NULL,array('parent_id'=>3,'status'=>'active','url_en'=>$urlDetail));   
                        }
                        $this->data['detail'] = $detail[0];
                    }
                */
                $this->data['detail'] = $gioithieu[0];
                break;
            case 'dich-vu':
            case 'service':
                $this->data['activeSubMenu'] = 'service';
                $this->data['subCat'] = 'service';
                $this->data['url']['vn'] = F_URL . 'vn/dich-vu/dich-vu';
                $this->data['url']['en'] = F_URL . 'en/service/service';
                $banner = $this->Base_model->getDB('db','post',array('url','url_en'),array('parent_id'=>11,'type'=>'service-service'));
                $this->data['banner'] = $banner[0];
                /*
                    if ($urlDetail == FALSE || $urlDetail=="") {
                        $this->data['detail'] = $dichvu[0];
                    }
                    else {
                        if ($this->data['lang']=="vn") {
                            $detail = $this->Base_model->getDB('db','post',NULL,array('parent_id'=>4,'status'=>'active','url'=>$urlDetail));
                        }
                        else {
                            $detail = $this->Base_model->getDB('db','post',NULL,array('parent_id'=>4,'status'=>'active','url_en'=>$urlDetail));   
                        }
                        $this->data['detail'] = $detail[0];
                    }
                */
                $this->data['detail'] = $dichvu[0];
                break;
            case 'chung-nhan-chat-luong':
            case 'certification':
                $this->data['activeSubMenu'] = 'certification';
                $this->data['subCat'] = 'certification';
                $this->data['url']['vn'] = F_URL . 'vn/dich-vu/chung-nhan-chat-luong';
                $this->data['url']['en'] = F_URL . 'en/service/certification';
                $banner = $this->Base_model->getDB('db','post',array('url','url_en'),array('parent_id'=>11,'type'=>'service-certification'));
                $this->data['banner'] = $banner[0];
                /*
                    if ($urlDetail == FALSE || $urlDetail=="") {
                        $this->data['detail'] = $chungnhan[0];
                    }
                    else {
                        if ($this->data['lang']=="vn") {
                            $detail = $this->Base_model->getDB('db','post',NULL,array('parent_id'=>5,'status'=>'active','url'=>$urlDetail));
                        }
                        else {
                            $detail = $this->Base_model->getDB('db','post',NULL,array('parent_id'=>5,'status'=>'active','url_en'=>$urlDetail));   
                        }
                        $this->data['detail'] = $detail[0];
                    }
                */
                $this->data['detail'] = $chungnhan[0];
                break;
            default:
                break;
        }

        $this->template->load($this->gate.'/template', $this->gate.'/service', $this->data);
    }


}