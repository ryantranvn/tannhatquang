<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/frontend/Root.php')) {
    require_once(APPPATH . 'controllers/frontend/Root.php');
}
//if (file_exists(APPPATH . 'libraries/Gump.php')) {
//    require_once(APPPATH . 'libraries/Gump.php');
//}

class Cart extends Root
{

    private $params = array();
    private $segs = array();

    public function __construct()
    {
        parent::__construct();

        $this->load->library('pagination');
        $this->load->model('Product_model');
        $this->load->model('Category_model');
        // set template
        $this->data['remove_banner'] = TRUE;
        $this->data['remove_hotline'] = TRUE;
    }

    public function index()
    {
        // $cssBlock = array('<link rel="stylesheet" type="text/css" href="'.assetsUrl('frontend','css','jquery.simplyscroll.css').'">');
        // $this->data['cssBlock'] = $cssBlock;

        // $jsBlock = array('<script language="javascript" type="text/javascript" src="'.ASSETS_URL.'frontend/js/compressed/sly.min.js"></script>');
        // $this->data['jsBlock'] = $jsBlock;

        // get product in cart
        $session_cart = array();
        if ($this->session->userdata('session_cart')!=FALSE) {
            $session_cart = $this->session->userdata('session_cart');
        }
        if (count($session_cart)>0 && $session_cart['total_item']>0) {
            foreach ($session_cart['list'] as $post_id => $item) {
                $products = $this->Product_model->get_post('product', $post_id);
                if ($products != FALSE && count($products)>0) {
                    array_push($session_cart['list'][$post_id], $products[0]);
                }
            }
        }
//        print_r("<pre>");
//        print_r($session_cart);exit();

        $this->template->load($this->gate.'/template', $this->gate.'/giohang', $this->data);
    }


    public function ajax_to_cart()
    {
        $arr_JSON = array();
        if ($this->session->userdata('session_cart')==FALSE) {
            $session_cart = array('total_item'=>0, 'list'=>array());
        }
        else {
            $session_cart = $this->session->userdata('session_cart');
        }
        $arr_data = $this->input->post('arr_data', TRUE);
        if (count($arr_data)>0) {
            // validation data
            foreach ($arr_data as $data) {
                $post_id = (int)$data['post_id'];
                $number_item = (int)$data['number_item'];
                if ($post_id==0 || $number_item==0 || $number_item > MAX_NUMBER_ITEM_CART) {
                    $arr_JSON['error'] = 1;
                    $arr_JSON['msg'] = "Lỗi thông tin giỏ hàng";
                    echo json_encode($arr_JSON);
                    exit();
                }
                // check over cart
                if ($session_cart['total_item'] + $number_item > MAX_NUMBER_ITEM_CART) {
                    $arr_JSON['error'] = 1;
                    $arr_JSON['msg'] = "Lỗi thông tin giỏ hàng: số lượng vượt mức cho phép";
                    echo json_encode($arr_JSON);
                    exit();
                }
                // check exist in cart
                if (!array_key_exists($post_id, $session_cart['list'])) {
                    $session_cart['list'][$post_id] = array('number_item'=>$number_item);
                }
                else {
                    $session_cart['list'][$post_id]['number_item'] = $session_cart[$post_id]['number_item']+$number_item;
                }
                $session_cart['total_item'] += $number_item;
            }
            if ($this->session->userdata('session_cart')!==FALSE) {
                $this->session->unset_userdata('session_cart');
            }
            $this->session->set_userdata('session_cart', $session_cart);
            $arr_JSON['error'] = 0;
            $arr_JSON['total_item'] = $session_cart['total_item'];
        }
        else {
            $arr_JSON['error'] = 1;
            $arr_JSON['msg'] = "Lỗi thông tin giỏ hàng";
        }
        echo json_encode($arr_JSON);
    }
}