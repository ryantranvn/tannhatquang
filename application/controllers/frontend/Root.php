<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (file_exists(APPPATH . 'libraries/Mobile_Detect.php')) {
    require_once(APPPATH . 'libraries/Mobile_Detect.php');
}
// if (file_exists(APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php')) {
//     require_once(APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php');
// }

class Root extends CI_Controller {

    public $data = array();
    public $gate = "frontend";

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('User_model');

    // detect Mobile device
        $detect = new Mobile_Detect;
        if ( $detect->isMobile() || $detect->isTablet() ) {
            // redirect(mUrl());
            $this->data['device'] = 'mobile';
        }
        else {
            $this->data['device'] = 'pc';
        }
    // authUser
        // $this->data['authUser'] = array();
        // if ($this->session->userdata('authUser') != FALSE) {
        //     $this->data['authUser'] = $this->session->userdata('authUser');
        // }
    // pass data to JS
        // $this->data['varJS']['authUser'] = $this->data['authUser'];
        // if ($this->session->userdata('invalidUser') != FALSE) {
        //     $this->data['varJS']['invalidUser'] = $this->session->userdata('invalidUser');
        //     $this->session->unset_userdata('invalidUser');
        // }
        // else {
        //     $this->data['varJS']['invalidUser'] = "";
        // }

    // Meta tag
        $this->data['meta'] = array('description'=>'',
                              'keywords'=>'',
                              'author'=>'Tân Nhật Quang'
                             );;

    // more blocks
        $this->data['cssBlock'] = array();
        $this->data['jsBlock'] = array();
    // frmSearch
        $this->data['frmSearch'] = frm('', array('id'=>'frmSearch'), FALSE);
    // categories
        $this->data['categories'] = $this->get_product_categroies();
        // print_r('<pre>');
        // print_r($this->data['categories']);
        // exit();
    }

    public function index()
    {
        // Some example data

    }
    public function get_product_categroies()
    {
        $path = '0-1-';
        $this->load->model('Category_model');
        $categories = $this->Category_model->get_categories($path);
        if ($categories != FALSE || count($categories)>0) {
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
        }

        return $categories_nav_1;
    }
    /*
    public function is_authUser()
    {
        if ($this->data['authUser']==FALSE || count($this->data['authUser'])==0) {
            return FALSE;
        }
        return TRUE;
    }
    */
}
