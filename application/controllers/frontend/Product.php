<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/frontend/Root.php')) {
    require_once(APPPATH . 'controllers/frontend/Root.php');
}

class Product extends Root {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Product_model');
        $this->load->model('Category_model');
    }
// Product
    public function index()
    {
        // $cssBlock = array('<link rel="stylesheet" type="text/css" href="'.assetsUrl('frontend','css','jquery.simplyscroll.css').'">');
        // $this->data['cssBlock'] = $cssBlock;

        // $jsBlock = array('<script language="javascript" type="text/javascript" src="'.ASSETS_URL.'frontend/js/compressed/sly.min.js"></script>');
    	// $this->data['jsBlock'] = $jsBlock;

        $this->data['activeNav'] = "product";
        $this->template->load($this->gate.'/template', $this->gate.'/product', $this->data);
    }

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
}
