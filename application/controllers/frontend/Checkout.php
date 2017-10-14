<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/frontend/Root.php')) {
    require_once(APPPATH . 'controllers/frontend/Root.php');
}
//if (file_exists(APPPATH . 'libraries/Gump.php')) {
//    require_once(APPPATH . 'libraries/Gump.php');
//}

class Checkout extends Root
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('pagination');
        $this->load->model('Product_model');
        $this->load->model('Category_model');
        // set template
        $this->data['remove_banner'] = TRUE;
        $this->data['remove_hotline'] = TRUE;
        $this->data['remove_navigation'] = TRUE;
    }

    public function index()
    {
        // $cssBlock = array('<link rel="stylesheet" type="text/css" href="'.assetsUrl('frontend','css','jquery.simplyscroll.css').'">');
        // $this->data['cssBlock'] = $cssBlock;

        // $jsBlock = array('<script language="javascript" type="text/javascript" src="'.ASSETS_URL.'frontend/js/compressed/sly.min.js"></script>');
        // $this->data['jsBlock'] = $jsBlock;

        // get product in cart
        $session_cart = array();
        if ($this->session->userdata('session_cart') != FALSE) {
            $session_cart = $this->session->userdata('session_cart');
        }
        if (count($session_cart)==0 || count($session_cart['list'])==0) {
            redirect(F_URL . 'gio-hang');
        }
        $this->data['session_cart'] = $session_cart;

//        print_r("<pre>");
//        print_r($session_cart);exit();

        $this->template->load($this->gate . '/template', $this->gate . '/checkout', $this->data);
    }

}