<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/frontend/Root.php')) {
    require_once(APPPATH . 'controllers/frontend/Root.php');
}

class Languageswitcher extends Root
{
    public function __construct() {
        parent::__construct();     
    }
 
    function switch_lang($language = "") 
    {
        $language = ($language != "") ? $language : "en";
        if ($this->session->userdata('site_lang')!==FALSE) {
        	$this->session->unset_userdata('site_lang');
        }
        $this->session->set_userdata('site_lang', $language);

        // print_r("<pre>"); print_r($this->data['links']); die();
        redirect($_SERVER['HTTP_REFERER']);
    }
}