<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/backend/Root.php')) {
    require_once(APPPATH . 'controllers/backend/Root.php');
}

class Maintain extends Root {

    /**
     * Maintain constructor.
     */
    public function __construct()
    {
        parent::__construct();

    }
// Understruction
    public function index()
    {
        echo 'here';
        // $this->load->view('backend/maintain');
//        $this->template->load('backend/template', 'backend/maintain/understruction', $this->data);
    }

// page404
    public function page404()
    {
        $this->template->load('backend/template', 'backend/maintain/page404', $this->data);
    }

// Understruction
    public function error_csrf()
    {
        $this->template->load('backend/template', 'backend/maintain/error_csrf', $this->data);
    }
}
