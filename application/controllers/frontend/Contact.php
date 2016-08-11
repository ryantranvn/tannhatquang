<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/frontend/Root.php')) {
    require_once(APPPATH . 'controllers/frontend/Root.php');
}

class Contact extends Root {

    public function __construct()
    {
        parent::__construct();

        $this->data['activeMenu'] = 'contact';
        $this->data['page'] = 'contact';
    }
// CONTACT
    public function index()
    {
        $this->data['url']['vn'] = F_URL . 'vn/lien-lac';
        $this->data['url']['en'] = F_URL . 'en/contact';

        $this->template->load($this->gate.'/template', $this->gate.'/contact', $this->data);
    }

// SUBMIT
    public function ajax_submitContactBox()
    {
        $arrJSON = array();
    // valid form
        $this->form_validation->set_rules('fullname', 'HỌ VÀ TÊN', 'trim|required|max_length[200]|xss_clean');
        $this->form_validation->set_rules('email', 'EMAIL', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('phone', 'SỐ ĐIỆN THOẠI', 'trim|max_length[20]|xss_clean');
        $this->form_validation->set_message('required', '%s is not empty');
        $this->form_validation->set_message('max_length', '%s is maximum 200 characters');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
        if ( $this->form_validation->run() == FALSE) {
            if ( validation_errors() != "" ) {
                $arrJSON['error'] = 1;
                $arrJSON['errorContent'] = validation_errors();
            }
        }
        else {
            $arrData = array('fullname' => $this->input->post('fullname',TRUE),
                             'email' => $this->input->post('email',TRUE),
                             'phone' => $this->input->post('phone',TRUE),
                             'ip' => client_ip(),
                             'browser_info' => $_SERVER['HTTP_USER_AGENT'],
                             'created_datetime' => date("Y-m-d H:i:s"),
                             'service' => $this->input->post('service',TRUE),
                             'type' => 'contact box'
                            );
            if ($this->User_model->insertContactBox('db',$arrData) == FALSE) {
                $arrJSON['error'] = 1;
                $arrJSON['errorContent'] = "Lỗi kết nối dữ liệu";
            }
            else {
                $arrJSON['error'] = 0;
            }
        }

        echo json_encode($arrJSON);
    }    

    public function ajax_submitContactPage()
    {
        $arrJSON = array();
    // valid form
        $this->form_validation->set_rules('fullname', 'HỌ VÀ TÊN', 'trim|required|max_length[200]|xss_clean');
        $this->form_validation->set_rules('email', 'EMAIL', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('phone', 'SỐ ĐIỆN THOẠI', 'trim|max_length[20]|xss_clean');
        $this->form_validation->set_rules('address', 'ĐỊA CHỈ', 'trim|required|max_length[200]|xss_clean');
        $this->form_validation->set_rules('title', 'TIÊU ĐỀ', 'trim|required|max_length[200]|xss_clean');
        $this->form_validation->set_rules('content', 'NỘI DUNG', 'trim|required|max_length[2000]|xss_clean');
        $this->form_validation->set_message('required', '%s is not empty');
        $this->form_validation->set_message('max_length', '%s is too long');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
        if ( $this->form_validation->run() == FALSE) {
            if ( validation_errors() != "" ) {
                $arrJSON['error'] = 1;
                $arrJSON['errorContent'] = validation_errors();
            }
        }
        else {
            $arrData = array('fullname' => $this->input->post('fullname',TRUE),
                             'email' => $this->input->post('email',TRUE),
                             'phone' => $this->input->post('phone',TRUE),
                             'address' => $this->input->post('address',TRUE),
                             'title' => $this->input->post('title',TRUE),
                             'content' => $this->input->post('content',TRUE),
                             'ip' => client_ip(),
                             'browser_info' => $_SERVER['HTTP_USER_AGENT'],
                             'created_datetime' => date("Y-m-d H:i:s"),
                             'type' => 'contact page'
                            );
            if ($this->User_model->insertContactPage('db',$arrData) == FALSE) {
                $arrJSON['error'] = 1;
                $arrJSON['errorContent'] = "Lỗi kết nối dữ liệu";
            }
            else {
                $arrJSON['error'] = 0;
            }
        }

        echo json_encode($arrJSON);
    } 
}