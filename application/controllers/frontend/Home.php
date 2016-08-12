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

        // get banner pos 1
            $arrBannerPos1 = $this->Base_model->getDB('db','post',array('url','url_en'),array('parent_id'=>11,'type'=>'home_1'),NULL,array('url','url_en'),array('asc','asc'));
            $bannerPos1_VN = $bannerPos1_EN = array();
            foreach ($arrBannerPos1 as $item) {
                if ($item['url'] != "") {
                    array_push($bannerPos1_VN, $item['url']);
                } else if ($item['url_en'] != "") {
                    array_push($bannerPos1_EN, $item['url_en']);
                }
            }
            $this->data['bannerPos1_VN'] = $bannerPos1_VN;
            $this->data['bannerPos1_EN'] = $bannerPos1_EN;
        // get banner pos 2
            $arrBannerPos2 = $this->Base_model->getDB('db','post',array('url','url_en'),array('parent_id'=>11,'type'=>'home_2'));
            $bannerPos2_VN = $bannerPos2_EN = array();
            foreach ($arrBannerPos2 as $item) {
                if ($item['url'] != "") {
                    array_push($bannerPos2_VN, $item['url']);
                } else if ($item['url_en'] != "") {
                    array_push($bannerPos2_EN, $item['url_en']);
                }
            }
            $this->data['bannerPos2_VN'] = $bannerPos2_VN;
            $this->data['bannerPos2_EN'] = $bannerPos2_EN;

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