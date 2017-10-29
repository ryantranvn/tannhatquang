<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Security extends CI_Security {

    public function __construct()
    {
        parent::__construct();
    }
	public function csrf_show_error()
	{
        header('Location: ' . F_URL . 'error_csrf');
        exit();
	}
}
