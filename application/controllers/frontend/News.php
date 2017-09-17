<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/frontend/Root.php')) {
    require_once(APPPATH . 'controllers/frontend/Root.php');
}

class News extends Root {

    public function __construct()
    {
        parent::__construct();

    }
// NEWS
    public function index()
    {
        // $cssBlock = array('<link rel="stylesheet" type="text/css" href="'.assetsUrl('frontend','css','jquery.simplyscroll.css').'">');
        // $this->data['cssBlock'] = $cssBlock;

        // $jsBlock = array('<script language="javascript" type="text/javascript" src="'.ASSETS_URL.'frontend/js/compressed/sly.min.js"></script>');
    	// $this->data['jsBlock'] = $jsBlock;

        $this->load->library('pagination');

        $config['base_url'] = F_URL.'tin-tuc/page/';
        $config['uri_segment'] = 3;
        $config['total_rows'] = 1000;
        $config['per_page'] = 12;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 5;

        $this->pagination->initialize($config);

        $this->data['paging'] =  $this->pagination->create_links();

        $this->data['active_nav'] = "tintuc";
        $this->template->load($this->gate.'/template', $this->gate.'/tintuc', $this->data);
    }


}
