<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Exceptions extends CI_Exceptions {

    // private $CI;
    /**
     * 404 Error Handler
     *
     * @uses    CI_Exceptions::show_error()
     *
     * @param   string  $page       Page URI
     * @param   bool    $log_error  Whether to log the error
     * @return  void
     */
    public function __construct() {
        parent::__construct();
        // $this->CI =& get_instance();
    }

    public function show_404($page = '', $log_error = TRUE)
    {

        $request_uri = $_SERVER['REQUEST_URI'];
        $arr_uri = explode('/', $request_uri);
        $url404 = "";

        if (count($arr_uri)==1) {
            $url404 = '404';     // Not found controller for frontend
        }
        else {
            $uri2 = $arr_uri[1];
            if ($uri2 != "" && $uri2 == 'backend') {
                $url404 = 'backend/404';       // Not found controller for backend
            }
            else {
                $url404 = '404';      // Not found controller for frontend
            }
        }
        // $_SESSION["error"] = "404";
        header('Location: '.F_URL.$url404);
        exit;
    }
}
