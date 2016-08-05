<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Languageswitcher extends CI_Controller
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
        
        redirect($_SERVER['HTTP_REFERER']);
    }
}