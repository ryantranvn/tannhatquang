<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/frontend/Root.php')) {
    require_once(APPPATH . 'controllers/frontend/Root.php');
}

class Product extends Root {

    private $params = array();
    private $segs = array();

    public function __construct()
    {
        parent::__construct();

        $this->load->library('pagination');
        $this->load->model('Product_model');
        $this->load->model('Category_model');

        $this->data['active_nav'] = "product";
        $this->params = $this->input->get();
        $this->segs = $this->uri->segment_array();
    }
// Product
    public function index()
    {
        // $cssBlock = array('<link rel="stylesheet" type="text/css" href="'.assetsUrl('frontend','css','jquery.simplyscroll.css').'">');
        // $this->data['cssBlock'] = $cssBlock;

        // $jsBlock = array('<script language="javascript" type="text/javascript" src="'.ASSETS_URL.'frontend/js/compressed/sly.min.js"></script>');
    	// $this->data['jsBlock'] = $jsBlock;
        $params = $this->params;

        if (count($params) == 0) {
            $this->product_detail();
        }
        else {
            $this->product_list();
        }

    }
// list
    private function product_list()
    {
        $params = $this->params;
        $segs = $this->segs;
        if (isset($params['cat']) && $params['cat']=="sp" && count($segs)>0) {
            if (count($segs)>1) {
                $category_url = $segs[2];
            }
            else {
                $category_url = '';
            }
        }
        if (isset($params['page']) && $params['page']>1) {
            $page = $params['page'];
        }
        else {
            $page = 1;
        }

        $sql = "SELECT
                        post.id
                        ,post.category_id
                        ,post.category_name
                        ,post.status
                        ,product.code
                        ,product.name
                        ,product.url
                        ,product.description
                        ,product.unit
                        ,product.manufacturer
                        ,product.quantity
                        ,product.price
                        ,product.price_sale
                        ,product.price_sale_percent
                        ,product.order
                        ,product.detail
                        , (SELECT url FROM post_picture WHERE post_id=post.id LIMIT 1) as thumbnail
                    FROM post
                    INNER JOIN product ON product.post_id = post.id
                    INNER JOIN category ON category.id = post.category_id
            ";
        $where = " WHERE post.type = 'product' AND post.del_flg=0";
        if ($category_url!="") {
            $where .= " AND category.url='".$category_url."'";
        }
        $sql .= $where;
        $total = $this->Base_model->table_total_rows($sql);

        $config['base_url'] = paging_base_url($this->params);
        $config['first_url'] = paging_base_url($this->params) . '&page=1';
        $config['query_string_segment'] = 'page';
        $config['total_rows'] = $total;
        $config['per_page'] = 12;
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['num_links'] = 5;
        $config['first_link'] = "<<";
        $config['last_link'] = ">>";

        $offset = $config['per_page'] * $page - $config['per_page'];
        if ($offset <= 0) $offset=0;
        $sql .= " LIMIT ". $offset . ', ' . $config['per_page'];
        $this->data['products'] = $this->Base_model->table_get_list($sql);

        $this->pagination->initialize($config);
        $this->data['paging'] =  $this->pagination->create_links();

        $this->template->load($this->gate.'/template', $this->gate.'/sanpham', $this->data);
    }
// detail
    private function  product_detail()
    {
         $cssBlock = array('<link rel="stylesheet" type="text/css" href="'.LIB_URL.'elastislide/css/elastislide.css">');
         $this->data['cssBlock'] = $cssBlock;

         $jsBlock = array(
             '<script language="javascript" type="text/javascript" src="'.LIB_URL.'elastislide/js/modernizr.custom.17475.js"></script>',
             '<script language="javascript" type="text/javascript" src="'.LIB_URL.'elastislide/js/jquerypp.custom.js"></script>',
             '<script language="javascript" type="text/javascript" src="'.LIB_URL.'elastislide/js/jquery.elastislide.js"></script>',
             '<script language="javascript" type="text/javascript" src="'.ASSETS_URL.'frontend/js/jquery.elevatezoom.js"></script>'
         );
         $this->data['jsBlock'] = $jsBlock;

        $url = $this->uri->segment(2,0);
        $products = $this->Product_model->get_one($url);
        if ($products == FALSE || count($products)==0) {
            $this->template->load('frontend/template', 'frontend/maintain/page404', $this->data);
        }
        else {

            // get pictures
            $pictures = $this->Base_model->get_db('post_picture', array('url'), array('post_id'=>$products[0]['id']));
            $products[0]['pictures'] = array();
            if ($pictures != FALSE && count($pictures)>0) {
                foreach ($pictures as $picture) {
                    array_push($products[0]['pictures'], $picture['url']);
                }
            }
            $this->data['product'] = $products[0];

            // get related_products
            $related_products = $this->Product_model->get_related($products[0]['id'], $products[0]['category_id']);
            $this->data['related_products'] = array();
            if ($related_products != FALSE && count($related_products)>0) {
                $this->data['related_products'] = $related_products;
            }

            $this->template->load($this->gate.'/template', $this->gate.'/sanpham_chitiet', $this->data);
        }
    }

}
