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
            ";
        $where = " WHERE post.type = 'product' AND post.del_flg=0";
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
        $this->template->load($this->gate.'/template', $this->gate.'/sanpham_chitiet', $this->data);
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
