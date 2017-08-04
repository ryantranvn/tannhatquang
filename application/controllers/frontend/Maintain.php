<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//
// if (file_exists(APPPATH . 'controllers/frontend/Root.php')) {
//     require_once(APPPATH . 'controllers/frontend/Root.php');
// }

class Maintain extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

    }
// Understruction
    public function index()
    {
        if (ENVIRONMENT == 'commingsoon') {
            $this->load->view('frontend/maintain/commingsoon');
        }
        else {
            $this->load->view('frontend/maintain/understruction');
        }
    }

// page404
    public function page404()
    {
        $this->load->view('frontend/maintain/page404');
    }

}
