<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends Base_model {

    var $tbl_member = 'member';

    function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
    }

/*
    auth_member :
        => return FALSE
        or return TRUE with authMember array session
*/
    function auth_member($data)
    {
        if ($data['captcha'] !== NULL) {
            // delete old captcha
            if ($this->delete_oldCaptcha($data) === FALSE) {
                $this->session->set_userdata('invalidAuthMember', "Error captcha.");
                return FALSE;
            }
        }
        // authorize
        $auth_where = array('username' => $data['username'], 'password' => $data['password']);
        $auth_arr = $this->get_db('member', NULL, $auth_where);
        if ( count($auth_arr)==0 ) {
            $this->session->set_userdata('invalidAuthMember', "Error authorization.");
            return FALSE;
        }
        // check active yet
        if ( $auth_arr[0]['status']!="active" ) {
            $this->session->set_userdata('invalidAuthMember', "User have not active yet.");
            return FALSE;
        }
        // get permission of member
        $authMember = $auth_arr[0];
        // print_r("<pre>"); print_r($permission_arr); die();

        $this->session->set_userdata('authMember',array('id'=>$authMember['id'], 'username'=>$authMember['username'], 'thumbnail'=>$authMember['thumbnail']));
        return TRUE;
    }

    function delete_oldCaptcha($data)
    {
        $expiration = time()-7200; // Two hour limit
        $this->db->delete('captcha',array('captcha_time <' => $expiration));
        $captcha_where = array('word =' => $data['captcha'], 'ip_address =' => $data['ip_address'], 'captcha_time >' => $expiration);
        $captcha_arr = $this->get_db('captcha', NULL, $captcha_where);
        if ( count($captcha_arr) == 0 ) {
            return FALSE;
        }
        return TRUE;
    }

}
