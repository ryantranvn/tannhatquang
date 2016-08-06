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
// HOME
    public function index()
    {
    	// echo $this->data['device'];
        $this->template->load($this->gate.'/template', $this->gate.'/news', $this->data);
    }

}