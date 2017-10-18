<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/frontend/Root.php')) {
    require_once(APPPATH . 'controllers/frontend/Root.php');
}

class Maintain extends Root {

    public function __construct()
    {
        parent::__construct();
        // set template
        $this->data['remove_banner'] = TRUE;
        $this->data['remove_hotline'] = TRUE;
    }
// Understruction
    public function index()
    {
        switch (ENVIRONMENT) {
            case 'commingsoon':
                break;
            case 'understruction':
                $this->template->load('frontend/template', 'frontend/maintain/understruction', $this->data);
                break;
            case 'commingsoon':
                break;
            default;
                $this->template->load('frontend/template', 'frontend/maintain/page404', $this->data);
                break;
        }
    }

// Understruction
//    public function error_csrf()
//    {
//        $this->template->load('frontend/template', 'frontend/maintain/error_csrf', $this->data);
//    }
}
