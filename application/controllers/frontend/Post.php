<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/frontend/Root.php')) {
    require_once(APPPATH . 'controllers/frontend/Root.php');
}

class Post extends Root
{

    private $params = array();
    private $segs = array();

    public function __construct()
    {
        parent::__construct();

        $this->load->library('pagination');
        $this->load->model('Product_model');
        $this->load->model('Category_model');

        //$this->data['active_nav'] = "product";
        //$this->params = $this->input->get();
        //$this->segs = $this->uri->segment_array();
    }

    // Post
    public function index()
    {
        $segs = $this->uri->segment_array();
        $params = $this->input->get();
        $lastSeg = $segs[count($segs)];
        $typeCharacter = substr($lastSeg, 0, 1);
        $id = substr($lastSeg, 1);

        if ($typeCharacter == 'c') { // category
            $this->product_list($id);
        }
        else if ($typeCharacter == 'p') { // product
            $this->product_detail($id);
        }
        else if ($typeCharacter == 'n') { // news

        }
        else {
            redirect('404_override');
        }
    }

    private function product_list($id = NULL)
    {
        $page = 1;
        if ($this->input->get('page',TRUE)>1) {
            $page = $this->input->get('page',TRUE);
        }
        $sql = "SELECT post.id
                    ,post.category_id
                    ,post.category_name
                    ,post.status
                    ,product.code
                    ,product.name
                    ,product.url
                    ,product.description
                    ,product.unit
                    ,manufacturer.name AS manufacturer
                    ,product.quantity
                    ,product.price
                    ,product.price_sale
                    ,product.price_sale_percent
                    ,product.order
                    ,product.detail
                    , (SELECT url FROM post_picture WHERE post_id=post.id LIMIT 1) as thumbnail
                FROM post
                INNER JOIN product ON product.post_id = post.id
                INNER JOIN manufacturer ON manufacturer.id = product.manufacturer_id
                LEFT JOIN category ON category.id = post.category_id
        ";
        $where = " WHERE post.type = 'product' AND post.del_flg=0";
        $segs = $this->uri->segment_array();
        $mainCategoryUrl = $segs[1];
        if ($mainCategoryUrl == "san-pham" && $id == 0) {

        }
        else {
            // get path
            $sqlCategory = "
                SELECT path, status
                FROM category
                WHERE status = 'active' AND url = '$mainCategoryUrl'";
            if ($id !== NULL) {
                $sqlCategory .= " AND id = ".$id;
            }
            $queryCategory = $this->db->query($sqlCategory);
            $categories = $queryCategory->result_array();
            if (count($categories)==0) {
                redirect('404_override');
            }
            $category = $categories[0];
            $where .= " AND category.path LIKE '%".$category['path']."%'";
        }
        
        // filter manufacturer
        $brandStr = $this->input->get('brand',TRUE);
        if (strlen($brandStr)>0) {
            $brands = explode('-', $brandStr);
            $this->data['filterBrands'] = $brands;
            $where .= ' AND (';
            foreach ($brands as $keyBrand => $brand) {
                $where .= "manufacturer_url LIKE '%".$brand."%'";
                if ($keyBrand < count($brands)-1) {
                    $where .= " OR ";
                }
            }
            $where .= ")";
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
        $config['reuse_query_string'] = TRUE;

        $offset = $config['per_page'] * $page - $config['per_page'];
        if ($offset <= 0) $offset=0;
        $sql .= " LIMIT ". $offset . ', ' . $config['per_page'];
        $this->data['products'] = $this->Base_model->table_get_list($sql);

        $this->pagination->initialize($config);

        $this->data['paging'] =  $this->pagination->create_links();

        $this->data['activeMainCategoryUrl'] = $mainCategoryUrl;
        // $this->data['activeMainCategoryUrl'] = $mainCategoryUrl;
        //pr($this->data['products']);

        $this->template->load($this->gate.'/template', $this->gate.'/sanpham', $this->data);
    }

    private function product_detail($id = NULL)
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

        $segs = $this->uri->segment_array();
        $productUrl = $segs[1];
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
                    ,product.manufacturer_id
                    ,product.manufacturer_url
                    ,product.quantity
                    ,product.price
                    ,product.price_sale
                    ,product.price_sale_percent
                    ,product.order
                    ,product.detail
                FROM post
                INNER JOIN product ON product.post_id = post.id
            ";
        $where = " WHERE post.type = 'product' AND post.del_flg=0 AND product.url='".$productUrl."'";

        $sql .= $where;
        $query = $this->db->query($sql);
        $products = $query->result_array();
        if ($products == FALSE || count($products)==0) {
            redirect('404_override');
        }
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