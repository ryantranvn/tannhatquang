<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/frontend/Root.php')) {
    require_once(APPPATH . 'controllers/frontend/Root.php');
}
require_once(APPPATH . 'libraries/PHPImageWorkshop/Core/ImageWorkshopLayer.php');
require_once(APPPATH . 'libraries/PHPImageWorkshop/Exception/ImageWorkshopException.php');
require_once(APPPATH . 'libraries/PHPImageWorkshop/ImageWorkshop.php');


class Booking extends Root {

    public function __construct()
    {
        parent::__construct();

        $this->data['activeMenu'] = 'booking';
        $this->data['page'] = 'booking';
    }

// Booking
    public function index()
    {
        $frmBooking_attr = array('name' => 'frmBooking', 'id' => 'frmBooking');
        $frmBooking_action = F_URL.'booking/submit';
        $this->data['frmBooking'] = frm($frmBooking_action, $frmBooking_attr, FALSE, NULL);

        $frmUpload_attr = array('name' => 'frmUpload', 'id' => 'frmUpload');
        $frmUpload_action = F_URL.'vn/booking/ajax_upload/';
        $this->data['frmUpload'] = frm($frmUpload_action, $frmUpload_attr, TRUE, NULL);

        $this->data['url']['vn'] = F_URL . 'vn/dat-hen-tu-van';
        $this->data['url']['en'] = F_URL . 'en/booking';
        if ($this->data['device']=='pc') {
            $banner = $this->Base_model->getDB('db','post',array('url','url_en'),array('parent_id'=>11,'type'=>'booking'));
        }
        else {
            $banner = $this->Base_model->getDB('db','post',array('url','url_en'),array('parent_id'=>11,'type'=>'booking-mobile'));
        }
        $this->data['banner'] = $banner[0];
        
        $this->template->load($this->gate.'/template', $this->gate.'/booking', $this->data);
    }

// ajax_upload
    public function ajax_upload()
    {
        global $picture_extensions;
        $arrJSON = array('errorText' => "");
        $ajax_files = reArrayFiles($_FILES['ajax_files']);
        if ( count($_FILES['ajax_files']['name']) < 1 || count($_FILES['ajax_files']['name']) > 5 ) {
            $arrJSON['errorText'] = $this->data['errorText']['uploadOver'];
        }
        else {
            $folder_Temps = './upload/user/temps/';
            $upload_config = array('folder' => $folder_Temps, 
                                   'type' => $picture_extensions, 
                                   'max_size' => IMG_SIZE,
                                   'max_width' => IMG_MAX_WIDTH,
                                   'max_height' => IMG_MAX_HEIGHT,
                                   'encryptNum' => 16
                            );
            $arrJSON['files'] = array();
            foreach ($ajax_files as $file) {
                $errorCode = valid_upload_file($file, $upload_config);
                if ($errorCode==0) {
                    $new_name = rename_file($file["name"], $upload_config['encryptNum']);
                    move_uploaded_file($file["tmp_name"], $folder_Temps . $new_name);
                    array_push($arrJSON['files'],$new_name);
                }
                else {
                    $arrJSON['errorText'] = $this->data['errorText']['invalid'][$errorCode];
                    break;
                }
            }
        }

        echo json_encode($arrJSON);
    }

// submit
    public function ajax_submitBooking()
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
            $filenames = $this->input->post('filenames',TRUE);
            $arrFile = array();
            for ($i=0; $i<5; $i++) {
                if (isset($filenames[$i]) && $filenames[$i]['value'] != "") {
                    array_push($arrFile,$filenames[$i]['value']);
                }
            }
            $arrData = array('fullname' => $this->input->post('fullname',TRUE),
                             'email' => $this->input->post('email',TRUE),
                             'phone' => $this->input->post('phone',TRUE),
                             'address' => $this->input->post('address',TRUE),
                             'title' => $this->input->post('title',TRUE),
                             'content' => $this->input->post('content',TRUE),
                             'brandcar' => $this->input->post('car',TRUE),
                             'modelcar' => $this->input->post('model',TRUE),
                             'service' => $this->input->post('service',TRUE),
                             'date' => $this->input->post('date',TRUE),
                             'ip' => client_ip(),
                             'browser_info' => $_SERVER['HTTP_USER_AGENT'],
                             'created_datetime' => date("Y-m-d H:i:s"),
                             'type' => 'booking',
                            );
            if ($this->User_model->insertBooking('db',$arrData, $arrFile) == FALSE) {
                $arrJSON['error'] = 1;
                $arrJSON['errorContent'] = "Can not load data";
            }
            else {
                $arrJSON['error'] = 0;

            // move file to booking folder
                $folder_Temps = './upload/user/temps/';
                $folder_Booking = './upload/user/booking/';
                foreach ($arrFile as $filename) {
                    copy($folder_Temps.$filename, $folder_Booking.$filename);
                }
            // send email
                try {
                    $listEmail = $this->Base_model->getDB('db','setting',NULL,array('name'=>'email', 'status'=>'active'));
                    $toListEmail = array();
                    foreach ($listEmail as $item) {
                        array_push($toListEmail, $item['value']);
                    }
                    if ($toListEmail!=FALSE && count($toListEmail)>0) {
                        $contentEmail = '<p>Fullname : '.$arrData['fullname'].'</p>';
                        $contentEmail .= '<p>Email : '.$arrData['email'].'</p>';
                        $contentEmail .= '<p>Phone : '.$arrData['phone'].'</p>';
                        $contentEmail .= '<p>Address : '.$arrData['address'].'</p>';
                        $contentEmail .= '<p>Brand : '.$arrData['brandcar'].'</p>';
                        $contentEmail .= '<p>Model : '.$arrData['modelcar'].'</p>';
                        $contentEmail .= '<p>Date : '.$arrData['date'].'</p>';
                        $contentEmail .= '<p>Title : '.$arrData['title'].'</p>';
                        $contentEmail .= '<p>Content : '.$arrData['content'].'</p>';

                        send_gmail(EMAIL, EMAILPASS, $toListEmail, EMAIL_TITLE_1, $contentEmail, NULL, NULL, $arrFile);
                    }
                }
                catch (Exception $e) {}                    
            }
        }

        echo json_encode($arrJSON);
    }
}