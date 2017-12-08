<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/backend/Root.php')) {
    require_once(APPPATH . 'controllers/backend/Root.php');
}

class Document extends Root {

    public function __construct()
    {
        parent::__construct();
    }

    // index
    public function index()
    {
        $this->data['activeNav'] = 'introduction';

        $this->template->load('backend/template_document', 'backend/document', $this->data);
    }

    public function category()
    {
        $this->data['activeNav'] = 'category';

        $this->template->load('backend/template_document', 'backend/document/category', $this->data);
    }
}