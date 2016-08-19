<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/frontend/Root.php')) {
    require_once(APPPATH . 'controllers/frontend/Root.php');
}

class Gallery extends Root {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Gallery_model');

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
                $banner = $this->Base_model->getDB('db','post',array('url','url_en'),array('parent_id'=>11,'type'=>'gallery-beforeafter'));
                $this->data['banner'] = $banner[0];
                $this->data['gallery'] = $this->Gallery_model->getBeforeAfter('db', $this->data['lang']);
                // print_r("<pre>"); print_r($this->data['gallery']); die();
                break;
            case 'su-kien-khac':
            case 'event':
                $this->data['activeSubMenu'] = 'event';
                $this->data['subCat'] = 'event';
                $this->data['url']['vn'] = F_URL . 'vn/thu-vien/su-kien-khac';
                $this->data['url']['en'] = F_URL . 'en/gallery/event';
                $banner = $this->Base_model->getDB('db','post',array('url','url_en'),array('parent_id'=>11,'type'=>'gallery-event'));
                $this->data['banner'] = $banner[0];
                $gallery = $this->Gallery_model->getEvent('db', $this->data['lang']);
                $album = $video = array();
                foreach ($gallery as $item) {
                    if ($item['detail'][0]['type'] == 'album') {
                        array_push($album, $item);
                    }
                    else {
                        array_push($video, $item);
                    }
                }
                $this->data['gallery'] = array('album'=>$album, 'video'=>$video);
                $this->data['file'] = $video[0]['detail'][0]['value'];
                // print_r("<pre>"); print_r($this->data['gallery']); die();
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
        $id = $this->input->post('id',TRUE);
        $gallery = $this->Base_model->getDB('db', 'post_detail', array('value', 'type'), array('post_id'=>$id), NULL, array('id'), array('asc'));
        if ($gallery == FALSE || count($gallery)==0) {
            $arrJSON['error'] = 1;
        }
        else {
            $arrJSON['error'] = 0;
            $arrJSON['gallery'] = $gallery;
        }

        echo json_encode($arrJSON);
    }



}