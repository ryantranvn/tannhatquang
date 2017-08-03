<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'libraries/OAuth2/Autoloader.php')) {
    require_once(APPPATH . 'libraries/OAuth2/Autoloader.php');
}

class Auth extends CI_Controller {

	private $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Auth_model');

        //$this->data['varJS']['bUrl'] = B_URL;
    }
// index - login
    public function index()
    {
		// print_r(encrypt_pass('*123#'));

    // reply invalid
    	if ( $this->session->userdata('invalidAuthMember') != FALSE ) {
            $this->data['invalidAuthMember'] = $this->session->userdata('invalidAuthMember');
            $this->session->unset_userdata('invalidAuthMember');
        }
    // create form
        $form_attr = array('name' => 'login_form', 'id' => 'login_form', 'class' => 'smart-form client-form');
        $form_action = B_URL.'auth/submit';
        $this->data['frmLogin'] = frm($form_action, $form_attr, FALSE, NULL);

        $captcha = get_captcha();
        $this->data['captcha_img'] = $captcha['image'];

    // set view
        $this->load->view('backend/auth/login', $this->data);
    }

// auth member
    function submit()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[255]|alpha_dash|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[255]|xss_clean');
        $this->form_validation->set_message('required', '%s not empty');
        $this->form_validation->set_message('max_length', '%s maximum 255 characters');
        $this->form_validation->set_message('alpha_dash', '%s just contains alpha and dash');
        if ( $this->form_validation->run() == FALSE) {
            if ( validation_errors() != "" ) {
                $this->session->set_userdata('invalidAuthMember', validation_errors());
            }
            redirect(B_URL . 'auth');
        }
        else {
            $password = encrypt_pass($this->input->post('password', TRUE));
            $captcha = $this->input->post('captcha', TRUE);
            $arr = array('username' => $this->input->post('username', TRUE),
                         'password' => $password,
                         'captcha' => $captcha,
                         'ip_address' => $_SERVER['REMOTE_ADDR']
                        );
            if( $this->Auth_model->auth_member($arr)==TRUE) {
                redirect(B_URL . 'dashboard');
            }
            else {
                redirect(B_URL . 'auth');
            }
        }
    }

// logout
    function logout()
    {
        $this->session->sess_destroy();

        redirect(B_URL . 'auth');
    }

// refesh captcha
    function ajax_captcha()
    {
        $security_code = $this->input->post('sc',TRUE);
        $this->db->delete('captcha', array('security_code' => $security_code));
        $captcha = get_captcha();
        echo json_encode($captcha['image']);
    }

}
