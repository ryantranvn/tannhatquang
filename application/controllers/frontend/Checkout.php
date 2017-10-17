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

    public function confirm()
    {
        $cssBlock = array('<link rel="stylesheet" type="text/css" href="'.ASSETS_URL.'common/css/select2.min.css">');
        $this->data['cssBlock'] = $cssBlock;

        $jsBlock = array('<script language="javascript" type="text/javascript" src="'.ASSETS_URL.'common/js/select2.min.js"></script>');
        $this->data['jsBlock'] = $jsBlock;

        $session_cart = $this->has_cart();
        if (!$session_cart) {
            redirect(F_URL );
        }
        $this->data['provinces'] = loadProvinces();
        $this->data['dictricts'] = loadDistricts(92); // Cần Thơ

        $this->data['frmCustomer'] = frm(F_URL . 'checkout/complete', array('id' => 'frmCustomer'), FALSE);

        $this->template->load($this->gate . '/template', $this->gate . '/checkout_confirm', $this->data);
    }

    public function complete()
    {
        $session_cart = $this->has_cart();
        if (!$session_cart) {
            redirect(F_URL );
        }
        // valid form
        $this->form_validation->set_rules('fullname', 'Họ tên', 'trim|required|max_length[512]|xss_clean');
        $this->form_validation->set_rules('phone', 'Điện thoại', 'trim|required|max_length[20]|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|xss_clean');
        $this->form_validation->set_message('required', '%s bắt buộc nhập');
        $this->form_validation->set_message('max_length', '%s vượt số ký tự quy định');
        $this->form_validation->set_message('valid_email', '%s không đúng định dạng');
        if ( $this->form_validation->run() == FALSE && validation_errors() != "") {
            $this->session->set_userdata('invalid', validation_errors());
            redirect($_SERVER['REQUEST_URI']);
        }
        // get customer data
        $arr_customer = array(
            'fullname'      => $this->input->post('fullname',TRUE),
            'phone'         => $this->input->post('phone',TRUE),
            'email'         => strtolower($this->input->post('fullname',TRUE)),
            'note'       => $this->input->post('address',TRUE),
        );
        $arr_address = array();
        array_push($arr_address, array('province_id'   => $this->input->post('province_id_1',TRUE),
                                        'district_id'   => $this->input->post('district_id_1',TRUE),
                                        'address'       => $this->input->post('address_1',TRUE),
                                        'status'        => '1'
                                        ));
        $same_address = $this->input->post('same_address',TRUE);
        if ($same_address == 0) {
            array_push($arr_address, array('province_id'   => $this->input->post('province_id_2',TRUE),
                                            'district_id'   => $this->input->post('district_id_2',TRUE),
                                            'address'       => $this->input->post('address_2',TRUE),
                                            'status'        => '0'
                                        ));
        }
        // update db
        if ($this->Order_model->insert_order($session_cart, $arr_customer, $arr_address) === FALSE) {
            $this->session->set_userdata('invalid', "Error.");
            redirect($_SERVER['REQUEST_URI']);
        }
        $this->session->set_userdata('valid', "Successful.");
        redirect($_SERVER['REQUEST_URI']);
    }
}