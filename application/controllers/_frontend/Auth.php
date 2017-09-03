<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/frontend/Root.php')) {
    require_once(APPPATH . 'controllers/frontend/Root.php');
}

class Auth extends Root {

    public function __construct()
    {
        parent::__construct();
        // redirect(F_URL);
    }
// Auth
    public function index()
    {
     //    $cssBlock = array('<link rel="stylesheet" type="text/css" href="'.assetsUrl('frontend','css','jquery.simplyscroll.css').'">');
     //    $this->data['cssBlock'] = $cssBlock;
        
     //    $jsBlock = array('<script language="javascript" type="text/javascript" src="'.assetsUrl('frontend','js','jquery.simplyscroll.min.js').'"></script>');
    	// $this->data['jsBlock'] = $jsBlock;
        
     //    $this->data['activeNav'] = "dangky";
     //    $this->template->load($this->gate.'/template', $this->gate.'/dangky', $this->data);
    }
// dangnhap
    public function dangnhap()
    {
        if ($this->is_authUser()==TRUE) {
            redirect(F_URL);
        }
        if ($this->session->userdata('email')!=FALSE) {
            $this->data['email'] = $this->session->userdata('email');
            $this->session->unset_userdata('email');
        }
        // frm dangky
        $form_attr = array('name' => 'frmLogin', 'id' => 'frmLogin');
        $form_action = F_URL.'dang-nhap/gui';
        $this->data['frmLogin'] = frm($form_action, $form_attr, FALSE, NULL);

        $this->data['activeNav'] = "dangnhap";
        $this->template->load($this->gate.'/template', $this->gate.'/dangnhap', $this->data);
    }
// dangnhap_submit
    public function dangnhap_submit()
    {
        if ($this->is_authUser()==TRUE) {
            redirect(F_URL);
        }
        // valid form
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[255]|xss_clean');
        $this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required|max_length[255]|xss_clean');
        $this->form_validation->set_message('required', '%s bắt buộc');
        $this->form_validation->set_message('valid_email', '%s không đúng định dạng');
        $this->form_validation->set_message('max_length', '%s tối đa 255 ký tự');
        if ( $this->form_validation->run() == FALSE) {
            if ( validation_errors() != "" ) {
                $this->session->set_userdata('invalidUser', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        else {
            $email = $this->input->post('email',TRUE);
            $password = encrypt_pass($this->input->post('password',TRUE));
            $arrUser = $this->Base_model->getDB('db', 'user', NULL, array('email'=>$email));
            if ($arrUser==FALSE && count($arrUser)==0) {
                $this->session->set_userdata('invalidUser', "Tài khoản đăng nhập không tồn tại");
                redirect($_SERVER['HTTP_REFERER']);
            }
            else {
                $user = $arrUser[0];
                if ($user['status']!='active') {
                    $this->session->set_userdata('invalidUser', "Tài khoản đã bị khóa. Vui lòng liên hệ quản trị để biết thêm chi tiết");
                    redirect($_SERVER['HTTP_REFERER']);
                }
                else {
                    $parts = explode("@", $user['email']);
                    $user['username'] = $parts[0];
                    if ($password == $user['password']) {
                        // check log
                        if ($user['logged']==1 && time()-$user['timestamp']<=3600) {
                            $this->session->set_userdata('invalidUser', "Hiện tài khoản này đang đăng nhập trên một thiết bị khác.<br/>Bạn vui lòng thoát tài khoản trên thiết bị đã đăng nhập trước.");
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                        // update logged
                        $idLog = $this->User_model->updateLogIn('db', $user['id']);

                        $this->session->set_userdata('authUser', array('id'=>$user['id'], 'username'=>$user['username'], 'score'=>$user['score'], 'idLog'=>$idLog, 'ld'=>0));
                        redirect(F_URL.'cuoc-thi');
                    }
                    else if ($password == $user['password_start']) {
                        // check log
                        if ($user['logged']==1 && $user['timestamp']-time()<=3600) {
                            $this->session->set_userdata('invalidUser', "Hiện tài khoản này đang đăng nhập trên một thiết bị khác. Bạn vui lòng thoát tài khoản trên thiết bị đã đăng nhập trước.");
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                        // update logged
                        $idLog = $this->User_model->updateLogIn('db', $user['id']);
                        // update password
                        $this->Base_model->updateDB('db', 'user', array('password'=>$user['password_start'], 'password_start'=>''), array('id'=>$user['id']));
                        
                        $this->session->set_userdata('authUser', array('id'=>$user['id'], 'username'=>$user['username'], 'score'=>0, 'idLog'=>$idLog, 'ld'=>1));
                        redirect(F_URL.'cuoc-thi');
                    }
                    else {
                        $this->session->set_userdata('invalidUser', "Đăng nhập không thành công. Vui lòng thử lại");
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                }
            }
            redirect($_SERVER['HTTP_REFERER']);

        }
    }
// stopNotification
    public function stopNotification()
    {
        $arrJSON = array();
        // update authUser session
        $authUser = $this->session->userdata('authUser');
        $authUser['ld'] = 0;
        $this->session->unset_userdata('authUser');
        $this->session->set_userdata('authUser',$authUser);

        $arrJSON['error'] = 0;
        echo json_encode($arrJSON);
    }
// dangky
    public function dangky()
    {
        if ($this->is_authUser()==TRUE) {
            redirect(F_URL);
        }
        // frm dangky
        $form_attr = array('name' => 'frmRegist', 'id' => 'frmRegist');
        $form_action = F_URL.'dang-ky/gui';
        $this->data['frmRegist'] = frm($form_action, $form_attr, FALSE, NULL);

        $this->data['activeNav'] = "dangky";
        $this->template->load($this->gate.'/template', $this->gate.'/dangky', $this->data);
    }
// dangky_submit
    public function dangky_submit()
    {
        // valid form
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[255]|xss_clean');
        $this->form_validation->set_message('required', '%s bắt buộc');
        $this->form_validation->set_message('valid_email', '%s không đúng định dạng');
        $this->form_validation->set_message('max_length', '%s tối đa 255 ký tự');
        if ( $this->form_validation->run() == FALSE) {
            if ( validation_errors() != "" ) {
                $this->session->set_userdata('invalidUser', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        else {
            $email = strtolower($this->input->post('email',TRUE));
            // check existed
            $user = $this->Base_model->getDB('db', 'user', array('id'), array('email'=>$email));
            if ($user!=FALSE && count($user)>0) {
                $this->session->set_userdata('invalidUser', 'Email đã được đăng ký.');
                redirect($_SERVER['HTTP_REFERER']);
            }
            // random string to changepass url
            $this->load->helper('string');
            $password_start = random_string('nozero', 6);
            $arrData = array('email' => $email,
                             'password_start' => encrypt_pass($password_start),
                             'ip' => client_ip(),
                             'browser_info' => $_SERVER['HTTP_USER_AGENT'],
                             'created_datetime' => date("Y-m-d H:i:s")
                            );
            if ($this->Base_model->insertDB('db', 'user', $arrData) == FALSE) {
                $this->session->set_userdata('invalidUser', "Lỗi kết nối.");
                redirect($_SERVER['HTTP_REFERER']);
            }
            else {
                $this->session->set_userdata('successRegist', TRUE);
            // send email
                try {
                    $contentEmail = 'Chúc mừng bạn đã đăng ký thành công tham gia chuyến tàu thời gian PRU EXPRESS.';
                    $contentEmail .= '<p>Tên đăng nhập: : '.$email.'</p>';
                    $contentEmail .= '<p>Mật khẩu : '.$password_start.'</p>';
                    $contentEmail .= 'Sau khi đăng nhập lần đầu, hãy đổi mật khẩu để bảo mật thông tin.';
                    $contentEmail .= 'Cảm ơn bạn đã đăng ký!';
                    send_gmail(EMAIL, EMAILPASS, $email, "PRU EXPRESS", "Mật khẩu đăng nhập tạm thời PRUEXPRESS", $contentEmail, NULL, NULL, NULL);
                } catch (Exception $e) {
                }
                redirect(F_URL.'dang-ky-thanh-cong');
            }
        }

        
    }
// dangky_success
    public function dangky_success()
    {
        if ($this->session->userdata('successRegist')==FALSE) {
            redirect(F_URL.'dang-ky');
        }
        $this->session->unset_userdata('successRegist');

        $this->data['activeNav'] = "dangky";
        $this->template->load($this->gate.'/template', $this->gate.'/dangky_success', $this->data);
    }
// doimatkhau
    public function doimatkhau()
    {
        if ($this->is_authUser()==FALSE) {
            redirect(F_URL.'dang-nhap');
        }
        // frm 
        $form_attr = array('name' => 'frmChangePass', 'id' => 'frmChangePass');
        $form_action = F_URL.'doi-mat-khau/gui';
        $this->data['frmChangePass'] = frm($form_action, $form_attr, FALSE, NULL);

        $this->data['activeNav'] = "user";
        $this->template->load($this->gate.'/template', $this->gate.'/doimatkhau', $this->data);
    }
// doimatkhau_submit
    public function doimatkhau_submit()
    {
        if ($this->is_authUser()==FALSE) {
            redirect(F_URL.'dang-nhap');
        }
        // valid form
        $this->form_validation->set_rules('password_old', 'Mật khẩu hiện tại', 'trim|required|max_length[255]|xss_clean');
        $this->form_validation->set_rules('password_new', 'Mật khẩu mới', 'trim|required|max_length[255]|xss_clean');
        $this->form_validation->set_rules('password_confirm', 'Nhập lại mật khẩu mới', 'required|matches[password_new]');
        $this->form_validation->set_message('required', '%s bắt buộc');
        $this->form_validation->set_message('matches', '%s không chính xác');
        $this->form_validation->set_message('max_length', '%s tối đa 255 ký tự');
        if ( $this->form_validation->run() == FALSE) {
            if ( validation_errors() != "" ) {
                $this->session->set_userdata('invalidUser', validation_errors());
            }
        }
        else {
            $authUser = $this->data['authUser'];
            // check oldpassword
            $oldPassword = $this->input->post('password_old',TRUE);
            $oldPassword = encrypt_pass($oldPassword);
            $user = $this->Base_model->getDB('db','user',array('id'),array('id'=>$authUser['id'], 'password'=>$oldPassword));
            if ($user==FALSE || count($user)==0) {
                $this->session->set_userdata('invalidUser', "Mật khẩu hiện tại không chính xác");
            }
            else {
                $newPassword = $this->input->post('password_new',TRUE);
                $newPassword = encrypt_pass($newPassword);
                // update new password
                if ($this->Base_model->updateDB('db','user',array('password'=>$newPassword), array('id'=>$authUser['id']))==FALSE) {
                    $this->session->set_userdata('invalidUser', "Lỗi kết nối dữ liệu");
                }
                else {
                    $this->session->set_userdata('invalidUser', "Mật khẩu đã được cập nhật thành công");
                    redirect(F_URL.'cuoc-thi');
                }
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
// quenmatkhau
    public function quenmatkhau()
    {
        if ($this->is_authUser()==TRUE) {
            redirect(F_URL);
        }

        // frm 
        $form_attr = array('name' => 'frmLostPass', 'id' => 'frmLostPass');
        $form_action = F_URL.'quen-mat-khau/gui';
        $this->data['frmLostPass'] = frm($form_action, $form_attr, FALSE, NULL);

        $this->data['activeNav'] = "user";
        $this->template->load($this->gate.'/template', $this->gate.'/quenmatkhau', $this->data);
    }
// quenmatkhau_submit
    public function quenmatkhau_submit()
    {
        // valid form
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[255]|xss_clean');
        $this->form_validation->set_message('required', '%s bắt buộc');
        $this->form_validation->set_message('valid_email', '%s không đúng định dạng');
        $this->form_validation->set_message('max_length', '%s tối đa 255 ký tự');
        if ( $this->form_validation->run() == FALSE) {
            if ( validation_errors() != "" ) {
                $this->session->set_userdata('invalidUser', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        else {
            $email = $this->input->post('email',TRUE);
            // check existed
            $arrUser = $this->Base_model->getDB('db', 'user', array('id','email','reset_password','reset_time','status'), array('email'=>$email));
            if ($arrUser==FALSE && count($arrUser)==0) {
                $this->session->set_userdata('invalidUser', 'Email chưa được đăng ký.');
                redirect($_SERVER['HTTP_REFERER']);
            }
            $user = $arrUser[0];
            if ($user['reset_password'] != "") {
                if (time()-$user['reset_time']<=7200) {
                    $this->session->set_userdata('invalidUser', 'Tài khoản này vừa kích hoạt thiết lập mật khẩu mới. Bạn chỉ có thể thực hiện lại thao tác này sau 02 giờ nữa.');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }

            $this->load->helper('string');
            $reset_password = random_string('alnum', 12);
            
            $reset_time = time();
            // update db
            if ($this->Base_model->updateDB('db','user',array('password_start'=>'', 'reset_password'=>$reset_password, 'reset_time'=>time()),array('id'=>$user['id']))==FALSE) {
                $this->session->set_userdata('invalidUser', 'Lỗi kết nối.');
                redirect($_SERVER['HTTP_REFERER']);
            }
            else {
                $this->session->set_userdata('successReset', TRUE);
            // send email
                try {
                    $contentEmail = '<p>Để thiết lập lại mật khẩu tài khoản, vui lòng click vào link sau :</p>';
                    $contentEmail .= '<p>Mã xác nhận : '.$reset_password.'</p>';
                    $contentEmail .= '<p>Bạn cũng có thể sử dụng đường dẫn sau đây để vào trang thiết lập lại mật khẩu mới và nhập mã xác nhận.</p>';
                    $contentEmail .= '<a href="'.F_URL.'nhap-ma-xac-nhan/'.$user['id'].'">'.F_URL.'nhap-ma-xac-nhan/'.$user['id'].'</a>';
                    send_gmail(EMAIL, EMAILPASS, $user['email'], "PRU EXPRESS", "Mật khẩu đăng nhập mới", $contentEmail, NULL, NULL, NULL);
                } catch (Exception $e) {
                }
                redirect(F_URL.'nhap-ma-xac-nhan/'.$user['id']);
            }
        }
    }
// nhapmaxacnhan
    public function nhapmaxacnhan()
    {
        $id = $this->uri->segment(2,0);

        // check existed
            $arrUser = $this->Base_model->getDB('db', 'user', array('id','email','reset_password','reset_time','status'), array('id'=>$id));
            if ($arrUser==FALSE && count($arrUser)==0) {
                $this->session->set_userdata('invalidUser', 'Tài khoản này chưa được đăng ký.');
                redirect(F_URL);
            }
            $user = $arrUser[0];
        // check reset_password and reset_time
            if ($user['reset_password']=="" || $user['reset_password']==NULL || $user['reset_time']=="" || $user['reset_time']==NULL) {
                $this->session->set_userdata('invalidUser', 'Hệ thống ghi nhận không có yêu cầu thiết lập mật khẩu mới của tài khoản này.');
                redirect(F_URL);
            }
        // frm 
        $form_attr = array('name' => 'frmCodeReset', 'id' => 'frmCodeReset');
        $form_action = F_URL.'nhap-ma-xac-nhan/gui';
        $form_hidden = array('email'=>$user['email']);
        $this->data['frmCodeReset'] = frm($form_action, $form_attr, FALSE, $form_hidden);

        $this->data['activeNav'] = "user";
        $this->template->load($this->gate.'/template', $this->gate.'/nhapmaxacnhan', $this->data);
    }
// nhapmaxacnhan_submit
    public function nhapmaxacnhan_submit()
    {
        // valid form
        $this->form_validation->set_rules('code', 'Mã xác nhận', 'trim|required|max_length[255]|xss_clean');
        $this->form_validation->set_message('required', '%s bắt buộc');
        $this->form_validation->set_message('max_length', '%s tối đa 255 ký tự');
        if ( $this->form_validation->run() == FALSE) {
            if ( validation_errors() != "" ) {
                $this->session->set_userdata('invalidUser', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        else {
            $email = $this->input->post('email', TRUE);
            $code = $this->input->post('code', TRUE);
            // get info
                $arrUser = $this->Base_model->getDB('db','user',array('id','email','reset_password','reset_time'),array('email'=>$email));
                if ($arrUser==FALSE || count($arrUser)==0) {
                    $this->session->set_userdata('invalidUser', 'Email chưa đăng ký');
                    redirect($_SERVER['HTTP_REFERER']);
                }
                $user = $arrUser[0];
                if ($code!=$user['reset_password']) {
                    $this->session->set_userdata('invalidUser', 'Mã xác nhận không chính xác');
                    redirect($_SERVER['HTTP_REFERER']);
                }
                if (time()-$user['reset_time']>7200) {
                    $this->session->set_userdata('invalidUser', 'Mã xác nhận hết hạn');
                    redirect($_SERVER['HTTP_REFERER']);
                }

            redirect(F_URL.'thiet-lap-mat-khau-moi/'.$user['id']);
        }
    }
// thietlapmatkhaumoi
    public function thietlapmatkhaumoi()
    {
        if (!isset($_SERVER['HTTP_REFERER']) || (strpos($_SERVER['HTTP_REFERER'],"nhap-ma-xac-nhan")==FALSE && strpos($_SERVER['HTTP_REFERER'],"thiet-lap-mat-khau-moi")==FALSE)) {
            redirect(F_URL);
        }
        $id = $this->uri->segment(2,0);
        if ($id==FALSE || $id=="") {
            redirect(F_URL);
        }
        // check existed
            $arrUser = $this->Base_model->getDB('db', 'user', array('email'), array('id'=>$id));
            if ($arrUser==FALSE && count($arrUser)==0) {
                $this->session->set_userdata('invalidUser', 'Email chưa được đăng ký.');
                redirect(F_URL);
            }
            $user = $arrUser[0];
        // frm 
            $form_attr = array('name' => 'frmResetPass', 'id' => 'frmResetPass');
            $form_action = F_URL.'thiet-lap-mat-khau-moi/gui';
            $form_hidden = array('email'=>$user['email']);
            $this->data['frmResetPass'] = frm($form_action, $form_attr, FALSE, $form_hidden);

            $this->data['activeNav'] = "user";
            $this->template->load($this->gate.'/template', $this->gate.'/thietlapmatkhaumoi', $this->data);
    }
// thietlapmatkhaumoi_submit
    public function thietlapmatkhaumoi_submit()
    {
        $email = $this->input->post('email', TRUE);
        // valid form
        $this->form_validation->set_rules('password_new', 'Mật khẩu mới', 'trim|required|max_length[255]|xss_clean');
        $this->form_validation->set_rules('password_confirm', 'Nhập lại mật khẩu mới', 'required|matches[password_new]');
        $this->form_validation->set_message('required', '%s bắt buộc');
        $this->form_validation->set_message('matches', '%s không chính xác');
        $this->form_validation->set_message('max_length', '%s tối đa 255 ký tự');
        if ( $this->form_validation->run() == FALSE) {
            if ( validation_errors() != "" ) {
                $this->session->set_userdata('invalidUser', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        else {
            $newPassword = $this->input->post('password_new',TRUE);
            $newPassword = encrypt_pass($newPassword);
            // update new password
                if ($this->Base_model->updateDB('db','user',array('password'=>$newPassword, 'reset_password'=>'', 'reset_time'=>''), array('email'=>$email))==FALSE) {
                    $this->session->set_userdata('invalidUser', "Lỗi kết nối dữ liệu");
                    redirect($_SERVER['HTTP_REFERER']);
                }
                else {
                    $this->session->set_userdata('invalidUser', "Mật khẩu đã được cập nhật thành công");
                    // get user
                    $arrUser = $this->Base_model->getDB('db', 'user', NULL, array('email'=>$email));
                    if ($arrUser==FALSE && count($arrUser)==0) {
                        $this->session->set_userdata('invalidUser', 'Email chưa được đăng ký.');
                        redirect(F_URL);
                    }
                    $user = $arrUser[0];
                    $parts = explode("@", $user['email']);
                    $user['username'] = $parts[0];
                    $this->session->set_userdata('authUser',$user);
                    redirect(F_URL.'cuoc-thi');
                }
        }
    }
// thoat
    public function thoat()
    {
        if ($this->session->userdata('authUser') == FALSE) {
            redirect(F_URL);
        }

        $user = $this->data['authUser'];
        if (isset($user['idLog']) && $user['idLog']!=0) {
            // update logout
            $this->User_model->updateLogOut('db', $user['id'], $user['idLog']);    
        }
        $this->session->sess_destroy();
        
        redirect(F_URL);
    }
// test
    // public function testMail()
    // {
    //     echo send_gmail(EMAIL, EMAILPASS, 'ryantran.vn@gmail.com', "PRU Registration", "Mật khẩu đăng nhập tạm thời PRUEXPRESS", "Test", NULL, NULL, NULL);
    // }
}