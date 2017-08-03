<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'libraries/Gump.php')) {
    require_once(APPPATH . 'libraries/Gump.php');
}

class API_auth extends CI_Controller {

    private $permissionsMember;

    public function __construct()
    {
        parent::__construct();

    // load
        $this->load->model('Permission_model');

    }

    public function is_auth()
    {
        if ( $this->session->userdata('authMember') == FALSE) {
            return FALSE;
        }
        else {
            return $this->session->userdata('authMember');
        }
    }

    public function get_permisions_of_member($id_member, $module_id)
    {
        return $this->Permission_model->get_member_permissions($member_id, $module_id);
    }

}
