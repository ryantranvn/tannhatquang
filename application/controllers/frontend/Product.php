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
            $category_url = $segs[1];
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
                        ,post_picture.url as thumbnail
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
                    INNER JOIN post_picture ON post_picture.post_id = post.id
                    INNER JOIN product ON product.post_id = post.id
                    INNER JOIN category ON category.id = post.category_id
            ";
        $where = " WHERE post.type = 'product' AND post.del_flg=0 AND category.url='".$category_url."'";
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
print_r('<pre>');
print_r($this->data['products']);
exit();
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

        $url = $this->uri->segment(1,0);
        $products = $this->Product_model->get_one($url);
        if ($products == FALSE || count($products)==0) {
            $this->template->load('frontend/template', 'frontend/maintain/page404', $this->data);
        }
        else {
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
/*
    public function ajax_product_categroies()
    {
        $arr_JSON = array();
        $path = '0-1-';
        $categories = $this->Category_model->get_categories($path);
        if ($categories == FALSE || count($categories)==0) {
            $arr_JSON['err'] = 1;
        }
        else {
            $categories_nav_1 = $categories_nav_2 = array();
            foreach ($categories as $key => $category) {
                $indent = count(explode('-', $category['path']));
                $categories[$key]['indent'] = $indent-1;

                if ($categories[$key]['indent']==3) {
                    $categories[$key]['sub'] = array();
                    array_push($categories_nav_1, $categories[$key]);
                }
                else if ($categories[$key]['indent']==4) {
                    array_push($categories_nav_2, $categories[$key]);
                }

            }
            foreach ($categories_nav_1 as $key => $cat_1) {
                foreach ($categories_nav_2 as $cat_2) {
                    if (strpos($cat_2['path'], $cat_1['path'])!==FALSE) {
                        array_push($categories_nav_1[$key]['sub'], $cat_2);
                    }
                }
            }
            $arr_JSON['categories'] = $categories_nav_1;
        }

        echo json_encode($arr_JSON);
    }
*/

}
