<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/backend/Root.php')) {
    require_once(APPPATH . 'controllers/backend/Root.php');
}


class Document extends Root {

    public function __construct()
    {
        parent::__construct();
        array_push($this->data['cssBlock'], '<link rel="stylesheet" type="text/css" href="'. LIB_URL . 'lightbox/css/lightbox.min.css" />');
        array_push($this->data['jsBlock'], '<script language="javascript" type="text/javascript" src="'. LIB_URL . 'lightbox/js/lightbox.min.js"></script>');
        array_push($this->data['jsBlock'], '<script language="javascript" type="text/javascript" src="'. ASSETS_URL . 'backend/js/document.js"></script>');

    }

    // index
    public function index()
    {
        $this->data['activeNav'] = 'introduction';

        $this->template->load('backend/template_document', 'backend/document', $this->data);
    }

    public function category()
    {
        $this->data['activeNav'] = 'category';

        $this->template->load('backend/template_document', 'backend/document/category', $this->data);
    }
    public function product()
    {
        $this->data['activeNav'] = 'product';

        $this->template->load('backend/template_document', 'backend/document/product', $this->data);
    }
    public function order()
    {
        $this->data['activeNav'] = 'order';

        $this->template->load('backend/template_document', 'backend/document/order', $this->data);
    }
    public function customer()
    {
        $this->data['activeNav'] = 'customer';

        $this->template->load('backend/template_document', 'backend/document/customer', $this->data);
    }
    public function news()
    {
        $this->data['activeNav'] = 'news';

        $this->template->load('backend/template_document', 'backend/document/news', $this->data);
    }
    public function price_list()
    {
        $this->data['activeNav'] = 'price_list';

        $this->template->load('backend/template_document', 'backend/document/price_list', $this->data);
    }
}