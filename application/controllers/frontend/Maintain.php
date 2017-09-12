<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/frontend/Root.php')) {
    require_once(APPPATH . 'controllers/frontend/Root.php');
}

class Maintain extends Root {

    public function __construct()
    {
        parent::__construct();

    }
// Understruction
    public function index()
    {
        // $this->load->view('frontend/maintain');
        $this->template->load('frontend/template', 'frontend/maintain/understruction', $this->data);
    }

// page404
    public function page404()
    {
        $this->template->load('frontend/template', 'frontend/maintain/page404', $this->data);
    }

// Understruction
    public function error_csrf()
    {
        $this->template->load('frontend/template', 'frontend/maintain/error_csrf', $this->data);
    }
}
