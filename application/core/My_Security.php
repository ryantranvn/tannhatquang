<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Security extends CI_Security {

    public function __construct()
    {
        parent::__construct();
    }
	public function csrf_show_error()
	{
        // show_error(B_URL . explode('/', $_SERVER['REQUEST_URI'])[2]);
        header('Location: ' . B_URL . 'error_csrf');
        exit();
	}
}
