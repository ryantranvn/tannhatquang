<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (file_exists(APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php')) {
    require_once(APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php');
}

    function pr($print_what)
    {
        print_r("<pre>");
        if (is_array($print_what)) {
            foreach ($print_what as $arr) {
                print_r($arr);
                print_r('<br/>');
            }
        }
        else {
            print_r($print_what);
        }
        exit();
    }
// URL
    function assetsUrl($whatModule,$folder,$filename) {
        return F_URL . 'assets/'.$whatModule.'/'.$folder.'/'.$filename;
    }
    function libsUrl($whatLibrary,$folder,$filename) {
        return F_URL . 'library/'.$whatLibrary.'/'.$folder.'/'.$filename;
    }
    function uploadUrl($type, $filename, $thumbnail=FALSE) {
        if ($thumbnail != FALSE) {
            return F_URL . 'upload/.thumbs/'.$type.'/'.$filename;
        }
        return F_URL . 'upload/'.$type.'/'.$filename;
    }
    function currentPageURL() {
        $pageURL = 'http';
        //if ( $_SERVER["HTTPS"] == "on") { $pageURL .= "s"; }
        $pageURL .= "://";
        if ( $_SERVER["SERVER_PORT"] != "80" ) {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        }
        else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }

    // get paging base url
    function paging_base_url($params)
    {
        if (isset($params['page'])) {
            unset($params['page']);
        }
        $params_str = "";
        if (count($params)>0) {
            foreach ($params as $key => $value) {
                $params_str .= $key."=".$value;
            }
        }
        if ($params_str == "") {
            return current_url();
        }
        return current_url() . '?' . $params_str;
    }

    function config_paging($params, $total, $per_page)
    {
        $config['base_url'] = paging_base_url($params);
        $config['first_url'] = paging_base_url($params) . '&page=1';
        $config['query_string_segment'] = 'page';
        $config['total_rows'] = $total;
        $config['per_page'] = $per_page;
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['num_links'] = 5;
        $config['first_link'] = "<<";
        $config['last_link'] = ">>";

        return $config;
    }
// BROWSER info
	function client_ip()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    /*
    function browser_info()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }*/

// REPLY in Backend
    function reply()
    {
        $CI = & get_instance();
        $reply = array();
        if ($CI->session->userdata('valid') !== FALSE && $CI->session->userdata('valid') !== "") {
            $reply['valid'] = $CI->session->userdata('valid');
            $CI->session->unset_userdata('valid');
        }
        if ($CI->session->userdata('invalid') !== FALSE) {
            $reply['invalid'] = $CI->session->userdata('invalid');
            $CI->session->unset_userdata('invalid');
            if ($CI->session->userdata('invalid_data') !== FALSE) {
                $reply['invalid_data'] = $CI->session->userdata('invalid_data');
                $CI->session->unset_userdata('invalid_data');
            }
        }
        return $reply;
    }

// AUTO LOAD
    function loadProvinces()
    {
        $CI = & get_instance();
        $provinces = $CI->Base_model->get_db('province',NULL,NULL,NULL,'name','asc');

        return $provinces;
    }
    function loadDistricts($id_province=FALSE)
    {
        $CI = & get_instance();
        if ($id_province==FALSE) {
            $districts = $CI->Base_model->get_db('district',array('id','name AS text', 'type', 'location', 'id_province'),NULL,NULL,'id_province','asc');
        }
        else {
            $districts = $CI->Base_model->get_db('district', array('id', 'name AS text', 'type', 'location', 'id_province'), array('id_province' => $id_province), NULL, 'name', 'asc');
        }

        return $districts;
    }

    function load_order_status()
    {
        $CI = & get_instance();
        $order_status = $CI->Base_model->get_db('order_status',NULL,NULL,NULL,'id','asc');

        return $order_status;
    }
// FORM
    // create form
    function frm($action, $attrArr, $hasUpload, $hiddenArr=NULL)
    {
        $form = array();

        if (!$hasUpload) {
            if (isset($hiddenArr) && count($hiddenArr)>0) {
                $form['open'] = form_open($action, $attrArr, $hiddenArr);
            }
            else {
                $form['open'] = form_open($action, $attrArr);
            }
        }
        else {
            if (isset($hiddenArr) && count($hiddenArr)>0) {
                $form['open'] = form_open_multipart($action, $attrArr, $hiddenArr);
            }
            else {
                $form['open'] = form_open_multipart($action, $attrArr);
            }
        }
        $form['close'] = form_close();

        return $form;
    }

// Captcha
    function get_captcha()
    {
        $CI = & get_instance();
        $CI->load->helper('string');
        $CI->load->library('Captcha');
        $configs = array('img_path' => './captcha/',
                        'img_url' => F_URL . 'captcha/',
                        'img_height' => '50',
                        'img_width' => '140'
                        );

        $cap = $CI->captcha->get_antispam_image($configs);

        // insert data
        $data = array(  'captcha_time' => $cap['time'],
                        'ip_address' => $CI->input->ip_address(),
                        'word' => $cap['word'],
                        'security_code' => $cap['security_code']
                        );
        if ( $CI->Base_model->insert_db('captcha', $data) == FALSE ) {
            return FALSE;
        }
        return $cap;
    }

// PAGING
    function paging_links($base_url, $total_rows, $per_page, $uri_segment)
    {
        $CI = & get_instance();
        $CI->load->library('pagination');

        $config['base_url'] = $base_url;
        $config['first_url'] = '1';
        $config['uri_segment'] = $uri_segment;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 5;
        $config['first_link'] = false;
        $config['last_link'] = false;

        $CI->pagination->initialize($config);

        return  $CI->pagination->create_links();
    }
/*  ------------------------------------------- STRING */

// remove VN Character
    function removeVNCharacter($str)
    {
        // trim space more than 1 between 2 words
        $str = trim_odd_space($str);

        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            ''=>',',
            ''=>"'",
            ''=>'%',
            ''=>',',
            ''=>'.',
            ''=>' '
        );

        foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        $str = str_replace(".","",$str);
        return strtolower($str);
    }

// return url string
/**
 * @param $str
 * @return mixed|string
 */
    function url_str($str)
    {
        // trim space more than 1 between 2 words
        $str = trim_odd_space($str);

        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            '-' => ' '
        );
        try {
            foreach($unicode as $nonUnicode=>$uni){
                $str = preg_replace('/'.preg_quote($uni).'/i', $nonUnicode, $str);
            }
        } catch (Exception $e) { }
        $str = trim_odd_character(removeVNCharacter(strtolower($str)),"-");
        $arr = array(' ','(',')','{','}','[',']','|','+','/','\\',':',';','"','\'','*','?','!','@','#','$','%','^','&','=','<','>',',','.','ф');
        $str = str_replace($arr, '', $str);
        return $str;
    }

    function url_str_with($str, $character)
    {
        // trim space more than 1 between 2 words
        $str = trim_odd_space($str);

        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            ''=>',',
            ''=>"'",
            ''=> '"',
            ''=>'%',
            $character=>',',
            $character=>' '
        );
        try {
            foreach($unicode as $nonUnicode=>$uni){
                $str = preg_replace("/($uni)/i", $nonUnicode, $str);
            }
        } catch (Exception $e) {
        }

        return strtolower($str);
    }


// trim add space
    function trim_odd_space($str)
    {
        return trim(preg_replace("/ {2,}/", " ", $str));
    }
// trim add space
    function trim_odd_character($str, $character)
    {
        return trim(preg_replace("/".$character."{2,}/", "", $str));
    }

/* ------------------------------------------- ENCRYPT */

// encrypt_pass
    function encrypt_pass($str)
    {
        $hash = $str;
        for ($i=1; $i<=8; $i++) {
            $hash = sha1($hash);
        }
        return $hash;
    }

/*
// encode_pass
    function encode_pass($str)
    {
        $CI = & get_instance();
        $CI->load->library('encrypt');
        $hash = $str;

        $hash = $CI->encrypt->encode($str);

        return $hash;
    }

// decode_pass
    function decode_pass($str)
    {
        $CI = & get_instance();
        $CI->load->library('encrypt');
        $hash = $str;

        $hash = $CI->encrypt->decode($str);

        return $hash;
    }
*/

/* ------------------------------------------- XML */
    function xml2Array($filename)
    {
        try{
            $xml = simplexml_load_file($filename, "SimpleXMLElement", LIBXML_NOCDATA);
            // $get = file_get_contents($filename);
            // $xml = simplexml_load_string($get);
        }
        catch(Exception $e) {
        }
        $json = json_encode($xml);
        return json_decode($json,TRUE);
    }

    function array2XML($obj, $array)
    {
        foreach ($array as $key => $value)
        {
            if(is_numeric($key)) $key = 'item' . $key;
            if (is_array($value))
            {
                $node = $obj->addChild($key);
                array2XML($node, $value);
            }
            else
            {
                $obj->addChild($key, htmlspecialchars($value,ENT_QUOTES,'UTF-8'));
            }
        }
    }

/* ------------------------------------------- SECURITY */

/* ------------------------------------------- EMAIL */
    /*
    function send_gmail($fromEmail, $passEmail, $toEmail, $titleEmail, $contentEmail, $cc, $bcc, $attachs)
    {
        $CI = & get_instance();
        $CI->load->library('email');
        $config = array();
        $config['useragent']           = PAGE_NAME;
        $config['mailpath']            = "/usr/sbin/sendmail"; // "/usr/bin/sendmail"; or "/usr/sbin/sendmail"
        $config['protocol']            = "smtp";
        $config['smtp_host']           = "ssl://smtp.googlemail.com";
        // $config['smtp_host']           = "ssl://smtp.gmail.com";
        // $config['smtp_host']           = "tls://smtp.gmail.com";
        // $config['smtp_port']           = 25;
        $config['smtp_port']           = 587;
        // $config['smtp_port']           = 465;
        $config['smtp_crypto']         = 'tls';
        $config['smtp_user']            = $fromEmail;
        $config['smtp_pass']            = $passEmail;
        $config['mailtype']            = 'html';
        $config['charset']             = 'utf-8';
        $config['newline']             = "\r\n";
        $config['wordwrap']            = TRUE;

        $CI->email->initialize($config);
        $CI->email->from($fromEmail, $titleEmail);
        $CI->email->to($toEmail);
        if ($cc!==NULL && count($cc)>0) {
            foreach ($cc as $item) {
                $CI->email->cc($item);
            }
        }
        if ($bcc!==NULL && count($bcc)>0) {
            foreach ($bcc as $item) {
                $CI->email->bcc($item);
            }
        }
        $CI->email->subject($titleEmail);
        $CI->email->message($contentEmail);
        if ($attachs!==NULL && count($attachs)>0) {
            foreach ($attachs as $item) {
                $CI->email->attach(ATTACH_FOLDER.$item);
            }
        }
        if($CI->email->send()){
            return TRUE;
        }
        else
        {
            // return FALSE;
            show_error($CI->email->print_debugger());
        }
    }
    */
    function send_gmail($fromEmail, $passEmail, $toEmail, $titleFrom, $titleEmail, $contentEmail, $cc, $bcc, $attachs)
    {
        // send_gmail(EMAIL, EMAILPASS, 'ryantran.vn@gmail.com', EMAIL_TITLE_1, 'Tiêu đề', NULL, NULL, NULL);
        //Create a new PHPMailer instance
        $mail = new PHPMailer;

        $mail->CharSet = "UTF-8";
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 0;

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
        $mail->Username = $fromEmail;

        //Password to use for SMTP authentication
        $mail->Password = $passEmail;

        //Set who the message is to be sent from
        $mail->setFrom($fromEmail, $titleFrom);

        //Set an alternative reply-to address
        // $mail->addReplyTo('replyto@example.com', 'First Last');

        //Set who the message is to be sent to
        if (is_array($toEmail)) {
            foreach ($toEmail as $email) {
                $mail->addAddress($email);
            }
        }
        else {
            $mail->addAddress($toEmail);
        }

        //Set the subject line
        $mail->Subject = $titleEmail;

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        // $mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
        $mail->msgHTML($contentEmail);

        //Replace the plain text body with one created manually
        // $mail->AltBody = 'This is a plain-text message body';

        //Attach an image file
        if (isset($attachs) && is_array($attachs)) {
            foreach ($attachs as $attach) {
                $mail->addAttachment(ATTACH_FOLDER.$attach);
            }
        }

        //send the message, check for errors
        if (!$mail->send()) {
            // echo "Mailer Error: " . $mail->ErrorInfo;
            return FALSE;
        } else {
            // echo "Message sent!";
            return TRUE;
        }
    }

    function send_email($fromEmail, $passEmail, $toEmail, $titleFrom, $titleEmail, $contentEmail, $cc, $bcc, $attachs)
    {
        //Create a new PHPMailer instance
        $mail = new PHPMailer;
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        $mail->CharSet = "UTF-8";

        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 0;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';

        //Set the hostname of the mail server
        $mail->Host = MAIL_SERVER;
        //Set the SMTP port number - likely to be 25, 465 or 587
        $mail->Port = 775;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = '';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = false;
        //Username to use for SMTP authentication
        $mail->Username = $fromEmail;
        //Password to use for SMTP authentication
        $mail->Password = $passEmail;
        //Set who the message is to be sent from
        $mail->setFrom($fromEmail, $titleFrom);
        // Set an alternative reply-to address
        // $mail->addReplyTo($fromEmail, 'Body and Paint Center');
        //Set who the message is to be sent to
        $mail->addAddress($toEmail);
        //Set the subject line
        $mail->Subject = $titleEmail;
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML($contentEmail);
        //Replace the plain text body with one created manually
        // $mail->AltBody = $contentEmail;
        //Attach an image file
        if (isset($attachs) && is_array($attachs)) {
            foreach ($attachs as $attach) {
                $mail->addAttachment(ATTACH_FOLDER.$attach);
            }
        }
        $mail->send();
        // //send the message, check for errors
        // if (!$mail->send()) {
        //     // echo "Mailer Error: " . $mail->ErrorInfo;
        //     return false;
        // } else {
        //     // echo "Message sent!";
        //     return true;
        // }
    }

    function send_CIMail($fromEmail, $passEmail, $toEmail, $titleEmail, $contentEmail, $cc, $bcc, $attachs)
    {
        //Create a new PHPMailer instance
        $mail = new PHPMailer;
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        $mail->CharSet = "UTF-8";

        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 2;
        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';

        //Set the hostname of the mail server
        $mail->Host = 'mail.icore.net.vn';
        //Set the SMTP port number - likely to be 25, 465 or 587
        $mail->Port = 587;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = false;
        //Username to use for SMTP authentication
        $mail->Username = $fromEmail;
        //Password to use for SMTP authentication
        $mail->Password = $passEmail;
        //Set who the message is to be sent from
        $mail->setFrom($fromEmail, 'Test');
        // Set an alternative reply-to address
        // $mail->addReplyTo($fromEmail, 'Body and Paint Center');
        //Set who the message is to be sent to
        $mail->addAddress($toEmail);
        //Set the subject line
        $mail->Subject = $titleEmail;
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML($contentEmail);
        //Replace the plain text body with one created manually
        // $mail->AltBody = $contentEmail;
        //Attach an image file
        if (isset($attachs) && is_array($attachs)) {
            foreach ($attachs as $attach) {
                $mail->addAttachment(ATTACH_FOLDER.$attach);
            }
        }
        $mail->send();
        // //send the message, check for errors
        if (!$mail->send()) {
            // echo "Mailer Error: " . $mail->ErrorInfo;
            return false;
        } else {
            // echo "Message sent!";
            return true;
        }
    }

/* ------------------------------------------- VALID FILE */
// valid TYPE
    function valid_filetype($file_type, $arr_type)
    {
        //$valid_type = array("image/gif", "image/jpeg", "image/pjpeg", "image/png");
        if (in_array($file_type, $arr_type))
            return TRUE;
        return FALSE;
    }

// valid SIZE
    function valid_filesize($file_size, $max_size=0)
    {
        if ( $max_size == 0 || $max_size == NULL ) {
            return TRUE;
        }
        if ( $file_size/1024 <= $max_size )
            return TRUE;
        return FALSE;
    }

// valid WIDTH
    function valid_MaxWidth($file_width, $max_width=0)
    {
        if ( $max_width == 0 || $max_width == NULL ) {
            return TRUE;
        }
        if ( $file_width <= $max_width )
            return TRUE;
        return FALSE;
    }
    function valid_MinWidth($file_width, $min_width=0)
    {
        if ( $min_width == 0 || $min_width == NULL ) {
            return TRUE;
        }
        if ( $file_width > $min_width )
            return TRUE;
        return FALSE;
    }

// valid HEIGHT
    function valid_MaxHeight($file_height, $max_height=0)
    {
        if ( $max_height == 0 || $max_height == NULL ) {
            return TRUE;
        }
        if ( $file_height <= $max_height )
            return TRUE;
        return FALSE;
    }
    function valid_MinHeight($file_height, $min_height=0)
    {
        if ( $min_height == 0 || $min_height == NULL ) {
            return TRUE;
        }
        if ( $file_height > $min_height )
            return TRUE;
        return FALSE;
    }

// get EXTENTION
    function file_ext($str)
    {
        $ext = substr($str, strrpos($str, "."));
        if ($ext == ".JPG") { $ext = ".jpg"; }
        if ($ext == ".PNJ") { $ext = ".png"; }
        return $ext;
    }

// RENAME file
    function rename_file($filename, $encryptNum=NULL)
    {
        $CI = & get_instance();
        $CI->load->helper('string');
        if ($encryptNum!==NULL) {
            $name = random_string('alnum', $encryptNum);
        }
        else {
            $name = random_string('alnum', 6);
        }
        $ext = file_ext($filename);
        //return $name.$ext;
        return time()."-".$name.$ext;
    }

// RESIZE image
    function resize_image($img, $from, $to, $width=NULL, $height=NULL)
    {
        $CI = & get_instance();
        $CI->load->library('SimpleImage');
        $thumb = new SimpleImage();
        $thumb->load($from.$img);
        if ($width != NULL && $height != NULL) {
            $thumb->resize($width, $height);
        }
        else {
            if ($width != NULL) {
                $thumb->resizeToWidth($width);
            }
            elseif ($height != NULL) {
                $thumb->resizeToHeight($height);
            }
        }

        $thumb->save($to.$img);
    }

// arrange upload file array
    function reArrayFiles($file_post)
    {
        $file_array = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i=0; $i<$file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_array[$i][$key] = $file_post[$key][$i];
            }
        }

        return $file_array;
    }

// VALID
    function valid_upload_file($file, $upload_config, $fileType="image")
    {
        // $errorCode = 0;
        if ( !valid_filetype($file['type'], $upload_config['type']) ) {
            return 10;
        }
        if ( !valid_filesize($file['size'], $upload_config['max_size']) ) {
            return 11;
        }
        if ($fileType === "image") {
            $imageInformation = getimagesize($file['tmp_name']);
            if (isset($upload_config['max_width'])) {
                if ( !valid_MaxWidth($imageInformation[0], $upload_config['max_width']) ) {
                    return 12;
                }
            }
            if (isset($upload_config['max_height'])) {
                if ( !valid_MaxHeight($imageInformation[1], $upload_config['max_height']) ) {
                    return 13;
                }
            }
            if (isset($upload_config['min_width'])) {
                if ( !valid_MinWidth($imageInformation[0], $upload_config['min_width']) ) {
                    return 14;
                }
            }
            if (isset($upload_config['min_height'])) {
                if ( !valid_MinHeight($imageInformation[1], $upload_config['min_height']) ) {
                    return 15;
                }
            }
        }
        if ($file["error"] != 0) {
            return 99;
        }

        return 0;
    }

// inport & export excel
    function export_excel($arr_title, $arr_export, $error_col=TRUE, $download=TRUE)
    {
        $CI = & get_instance();
        $CI->load->library('PHPExcel');
        $objPHPExcel = new PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Ryan")
            ->setLastModifiedBy("Ryan")
            ->setTitle("Office 2007 XLSX Document")
            ->setSubject("Office 2007 XLSX Document")
            ->setDescription("Document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Result file");
        // Add title
        $strAlpha = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if ($error_col) {
            array_push($arr_title, 'error');
        }
        foreach ($arr_title as $key => $title) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($strAlpha[$key].'1', $title);
        }
        $i = 2;
        if ($arr_export != FALSE && count($arr_export)>0) {
            foreach ($arr_export as $row) {
                $j=0;
                foreach($row as $key => $item) {
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($strAlpha[$j] . $i, $item);
                    $j++;
                }
                $i++;
            }
        }
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Data');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        $filename = "data_".time().".xls";
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        if ($download) {
            // Redirect output to a client’s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            $objWriter->save('php://output');
            return;
        }
        else {
            $objWriter->save(str_replace(__FILE__,'user_data/'.$filename,__FILE__));
            return $filename;
        }
    }

    /*
     * $arr_number_columns : array contains numbers of columns want to get data
     * $arr_key_name : array contains key names
     * */
    function import_excel($arr_number_columns, $arr_key_name)
    {
        $CI = & get_instance();
        $CI->load->library('PHPExcel');
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        $str_null = '';
        foreach ($arr_number_columns as $item) {
            $str_null .= 'null,';
        }
        $str_null = substr($str_null, 0, -1);
        $sheetData = $objPHPExcel->getActiveSheet()->toArray($str_null);
        $importData = array();
        foreach ($sheetData as $key => $row) {
            if ($key > 0 && $this->security->xss_clean($row[0]) != "") {
                $arr = array();
            }
        }
    }
/* ------------------------------------------- DB */

// backup db ($table can be an array)
    function backup($tables='*')
    {
        $db_host = DB_HOST;
        $db_user = DB_USER;
        $db_pass = DB_PASS;
        $db_name = DB_NAME;

        $day_of_backup = 'Monday'; //possible values: `Monday` `Tuesday` `Wednesday` `Thursday` `Friday` `Saturday` `Sunday`
        $backup_path = 'DB/'; //make sure it ends with "/"

        //set the correct date for filename
        if (date('l') == $day_of_backup) {
            $date = date("Y-m-d");
        }
        else {
            //set $date to the date when last backup had to occur
            $datetime1 = date_create($day_of_backup);
            $date = date("Y-m-d", strtotime($day_of_backup.' -7 days'));
        }

        if (!file_exists($backup_path.$date.'-backup'.'.sql')) {

            //connect to db
            $link = mysqli_connect($db_host,$db_user,$db_pass);
            mysqli_set_charset($link,'utf8');
            mysqli_select_db($link,$db_name);

            //get all of the tables

            if($tables == '*')
            {
                $all = TRUE;
                $tables = array();
                $result = mysql_query('SHOW TABLES');
                while($row = mysql_fetch_row($result))
                {
                    $tables[] = $row[0];
                }
            }
            else
            {
                $all = FALSE;
                $tables = is_array($tables) ? $tables : explode(',',$tables);
            }


            //disable foreign keys (to avoid errors)
            $return = 'SET FOREIGN_KEY_CHECKS=0;' . "\r\n";
            $return.= 'SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";' . "\r\n";
            $return.= 'SET AUTOCOMMIT=0;' . "\r\n";
            $return.= 'START TRANSACTION;' . "\r\n";

            //cycle through
            foreach($tables as $table)
            {
                $result = mysqli_query($link, 'SELECT * FROM '.$table);
                $num_fields = mysqli_num_fields($result);
                $num_rows = mysqli_num_rows($result);
                $i_row = 0;

                //$return.= 'DROP TABLE '.$table.';';
                $row2 = mysqli_fetch_row(mysqli_query($link,'SHOW CREATE TABLE '.$table));
                $return.= "\n\n".$row2[1].";\n\n";

                if ($num_rows !== 0) {
                    $row3 = mysqli_fetch_fields($result);
                    $return.= 'INSERT INTO '.$table.'( ';
                    foreach ($row3 as $th)
                    {
                        $return.= '`'.$th->name.'`, ';
                    }
                    $return = substr($return, 0, -2);
                    $return.= ' ) VALUES';

                    for ($i = 0; $i < $num_fields; $i++)
                    {
                        while($row = mysqli_fetch_row($result))
                        {
                            $return.="\n(";
                            for($j=0; $j<$num_fields; $j++)
                            {
                                $row[$j] = addslashes($row[$j]);
                                $row[$j] = preg_replace("#\n#","\\n",$row[$j]);
                                if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                                if ($j<($num_fields-1)) { $return.= ','; }
                            }
                            if (++$i_row == $num_rows) {
                                $return.= ");"; // last row
                            } else {
                                $return.= "),"; // not last row
                            }
                        }
                    }
                }
                $return.="\n\n\n";
            }

            // enable foreign keys
            $return .= 'SET FOREIGN_KEY_CHECKS=1;' . "\r\n";
            $return.= 'COMMIT;';

            //set file path
            if (!is_dir($backup_path)) {
                mkdir($backup_path, 0755, true);
            }

            //delete old file
            // $old_date = date("Y-m-d", strtotime('-4 weeks', strtotime($date)));
            // $old_file = $backup_path.$old_date.'-backup'.'.sql';
            // if (file_exists($old_file)) unlink($old_file);

            //save file
            if($all) {
                $handle = fopen($backup_path.'backup-'.time().'.sql','w+');
            }
            else {
                $handle = fopen($backup_path.'backup-'.time().'-'.(implode(',',$tables)).'.sql','w+');
            }
            fwrite($handle,$return);
            fclose($handle);
        }
    }

// another code backup db
    function EXPORT_TABLES($host,$user,$pass,$name,  $tables=false, $backup_name=false )
    {
        $table_name = "question";
        $backup_name  = "/DB/".$table_name."-".time().".sql";

        $mysqli = new mysqli($host,$user,$pass,$name);
        $mysqli->select_db($name);
        $mysqli->query("SET NAMES 'utf8'");
        $queryTables = $mysqli->query('SHOW TABLES');
        while($row = $queryTables->fetch_row()) {
            $target_tables[] = $row[0];
        }
        if($tables !== false) {
            $target_tables = array_intersect( $target_tables, $tables);
        }
        $content = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--Database: `".$name."`\r\n\r\n\r\n";
        foreach($target_tables as $table) {
            $result = $mysqli->query('SELECT * FROM '.$table);
            $fields_amount=$result->field_count;
            $rows_num=$mysqli->affected_rows;
            $res = $mysqli->query('SHOW CREATE TABLE '.$table);
            $TableMLine=$res->fetch_row();
            $content .= "\n\n".$TableMLine[1].";\n\n";
            for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) {
                while($row = $result->fetch_row())  { //when started (and every after 100 command cycle):
                    if ($st_counter%100 == 0 || $st_counter == 0 )  {
                        $content .= "\nINSERT INTO ".$table." VALUES";
                    }
                    $content .= "\n(";
                    for($j=0; $j<$fields_amount; $j++)  { $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) ); if (isset($row[$j])){$content .= '"'.$row[$j].'"' ; }else {$content .= '""';}     if ($j<($fields_amount-1)){$content.= ',';}      }
                    $content .=")";
                    //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
                    if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) {$content .= ";";} else {$content .= ",";} $st_counter=$st_counter+1;
                }
            }
            $content .="\n\n\n";
        }
        $content .= "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
        //$backup_name = $backup_name ? $backup_name : $name."___(".date('H-i-s')."_".date('d-m-Y').")__rand".rand(1,11111111).".sql";
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"".$backup_name."\"");
        echo $content;
        exit;
    }

// call url background
    function run_background($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_exec($ch);

        // if (curl_errno($ch)) {
        //     $arrJSON['curl'] = curl_error($ch);
        // } else {
        //     // check the HTTP status code of the request
        //     $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        //     if ($resultStatus == 200) {
        //         $arrJSON['curl'] = 'good';
        //     } else {
        //         $arrJSON['curl'] = $resultStatus;
        //     }
        // }

        curl_close($ch);
    }

// get all main category
    function getMainCategory($parentId) {
        $CI = & get_instance();
        $category = $CI->Base_model->get_db('category',NULL,array('status'=>'active', 'parent_id' => $parentId),NULL,'name','asc');

        return $category;
    }
// get all sub category
    function getSubProductCategory() {
        $CI = & get_instance();
        $sql = "SELECT * FROM category WHERE path like '%0-1-%'  AND parent_id >= 3 AND status='active' ORDER BY `name` ASC";
        $query = $CI->db->query($sql);
        $category = $query->result_array();

        return $category;
    }