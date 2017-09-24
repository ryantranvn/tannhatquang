<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Exceptions extends CI_Exceptions {

    public function __construct() {
        parent::__construct();

    }

    public function show_404($page = '', $log_error = TRUE)
    {
        $CI =& get_instance();
        $request_uri = $_SERVER['REQUEST_URI'];
        $arr_uri = explode('/', $request_uri);
        $url_404 = "";

        if ($arr_uri[1] == 'backend') {
            $CI->load->view('backend/maintain');
        }
        else {
            $CI->load->view('frontend/maintain');
        }
        /*
        if (count($arr_uri)==1) {
            $url_404 = '404';     // Not found controller for frontend
        }
        else {
            $uri2 = $arr_uri[1];
            if ($uri2 != "" && $uri2 == 'backend') {
                $url_404 = 'backend/404';       // Not found controller for backend
            }
            else {
                $url_404 = '404';      // Not found controller for frontend
            }
        }
        // $_SESSION["error"] = "404";
        header('Location: '.F_URL.$url404);
        exit;
        */
    }
}
