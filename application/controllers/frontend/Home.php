<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/frontend/Root.php')) {
    require_once(APPPATH . 'controllers/frontend/Root.php');
}

class Home extends Root {

    public function __construct()
    {
        parent::__construct();

        $this->data['activeMenu'] = 'home';
    }
// HOME
    public function index()
    {
    	$this->data['url']['vn'] = F_URL . 'vn';
        $this->data['url']['en'] = F_URL . 'en';

        // get banner pos 1
        
        if ($this->data['device']=='pc') {
            $arrBannerPos1 = $this->Base_model->getDB('db','post',array('url','url_en','desc','desc_en','type'),array('parent_id'=>11,'type'=>'home_1'),NULL,array('url','url_en'),array('asc','asc'));
        }
        else {
            $arrBannerPos1 = $this->Base_model->getDB('db','post',array('url','url_en','desc','desc_en'),array('parent_id'=>11,'type'=>'home_1-mobile'),NULL,array('url','url_en'),array('asc','asc'));   
        }
            $bannerPos1_VN = $bannerPos1_EN = array();
            foreach ($arrBannerPos1 as $item) {
                if ($item['url'] != "") {
                    array_push($bannerPos1_VN, array('url'=>$item['url'], 'link'=>$item['desc']));
                } else if ($item['url_en'] != "") {
                    array_push($bannerPos1_EN, array('url'=>$item['url_en'], 'link'=>$item['desc_en']));
                }
            }
            if ($this->data['lang']=='vn') {
                $this->data['bannerPos1'] = $bannerPos1_VN;
            }
            else {
                $this->data['bannerPos1'] = $bannerPos1_EN;    
            }
        // get banner pos 2
            if ($this->data['device']=='pc') {
                $arrBannerPos2 = $this->Base_model->getDB('db','post',array('url','url_en','desc','desc_en'),array('parent_id'=>11,'type'=>'home_2'),NULL,array('url','url_en'),array('asc','asc'));
            }
            else {
                $arrBannerPos2 = $this->Base_model->getDB('db','post',array('url','url_en','desc','desc_en'),array('parent_id'=>11,'type'=>'home_2-mobile'),NULL,array('url','url_en'),array('asc','asc'));
            }
            $bannerPos2_VN = $bannerPos2_EN = array();
            foreach ($arrBannerPos2 as $item) {
                if ($item['url'] != "") {
                    array_push($bannerPos2_VN, array('url'=>$item['url'], 'link'=>$item['desc']));
                } else if ($item['url_en'] != "") {
                    array_push($bannerPos2_EN, array('url'=>$item['url_en'], 'link'=>$item['desc_en']));
                }
            }
            if ($this->data['lang']=='vn') {
                $this->data['bannerPos2'] = $bannerPos2_VN;
            }
            else {
                $this->data['bannerPos2'] = $bannerPos2_EN;    
            }
        
        // get service
            $this->data['service'] = $this->Base_model->getDB('db','post',NULL,array('status='=>'active', 'parent_id='=>4, 'id<>'=>65),NULL,array('order'),array('asc'));
        // get certication
            $certification = $this->Base_model->getDB('db','post',NULL,array('status='=>'active', 'parent_id='=>5, 'id<>'=>66),NULL,array('order'),array('asc'));
            $this->data['certification'] = array_chunk($certification, 2);

        // get gallery
            $this->load->model('Gallery_model');
            $gallery = $this->Gallery_model->getBeforeAfter('db', $this->data['lang']);
            $this->data['gallery'] = $gallery;

            // print_r("<pre>"); print_r($gallery); die();

        $this->template->load($this->gate.'/template', $this->gate.'/home', $this->data);
    }

// get user data to autofill
    public function ajax_get_user()
    {
        $type = $this->input->post('type',TRUE);
        $inputData = $this->input->post('inputData',TRUE);

        $userData = $this->Base_model->getDB('db','user',NULL,array($type => $inputData));
        if ($userData == FALSE || count($userData)==0) {
            $arrJSON['error'] = 1;
        }
        else {
            $arrJSON['error'] = 0;
            $arrJSON['user'] = $userData[0];
        }

        echo json_encode($arrJSON);
    }

// test
    public function test_email()
    {
        //send_gmail(EMAIL, EMAILPASS, array('ryantran.vn@gmail.com'), EMAIL_TITLE_1, 'Nội dung email', NULL, NULL, NULL);
        
    /*
        //Create a new PHPMailer instance
        $mail = new PHPMailer;

        //Tell PHPMailer to use SMTP
        // $mail->isSMTP();

        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 2;

        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';

        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6

        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 465;

        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'ssl';

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = EMAIL;

        //Password to use for SMTP authentication
        $mail->Password = EMAILPASS;

        //Set who the message is to be sent from
        $mail->setFrom(EMAIL, 'Body and Paint Center');

        //Set an alternative reply-to address
        // $mail->addReplyTo('replyto@example.com', 'First Last');

        //Set who the message is to be sent to
        $mail->addAddress('ryantran.vn@gmail.com', 'Ryan Tran');

        //Set the subject line
        $mail->Subject = 'PHPMailer GMail SMTP test';

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        // $mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
        $mail->msgHTML('<p>Hello Ryan!</p>');

        //Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';

        //Attach an image file
        // $mail->addAttachment(assetsUrl('frontend','images','logo.png'));

        //send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
    */
    }
            
}