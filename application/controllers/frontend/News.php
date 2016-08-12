<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/frontend/Root.php')) {
    require_once(APPPATH . 'controllers/frontend/Root.php');
}

class News extends Root {

    public function __construct()
    {
        parent::__construct();

        $this->data['activeMenu'] = 'news';
        $this->data['page'] = 'news';
    }
// NEWS
    public function index()
    {
        $this->data['url']['vn'] = F_URL . 'vn/tin-tuc';
        $this->data['url']['en'] = F_URL . 'en/news';
        $banner = $this->Base_model->getDB('db','post',array('url','url_en'),array('parent_id'=>11,'type'=>'news'));
        $this->data['banner'] = $banner[0];

        $this->template->load($this->gate.'/template', $this->gate.'/news', $this->data);
    }

// DETAIL
    public function detail()
    {
        // get detail


        $this->data['url']['vn'] = F_URL . 'vn/tin-tuc';
        $this->data['url']['en'] = F_URL . 'en/news';
        $banner = $this->Base_model->getDB('db','post',array('url','url_en'),array('parent_id'=>11,'type'=>'news'));
        $this->data['banner'] = $banner[0];

        $this->template->load($this->gate.'/template', $this->gate.'/news_detail', $this->data);
    }

}