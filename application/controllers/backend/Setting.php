<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/backend/Root.php')) {
    require_once(APPPATH . 'controllers/backend/Root.php');
}

class Setting extends Root {

	private $module = 'setting';

    public function __construct()
    {
        parent::__construct();

        $this->currentModule = $this->data['modules'][ucfirst($this->router->fetch_class())];
        $this->data['varJS']['currentModule'] = $this->currentModule;
    // load
        $this->load->model($this->currentModule['control_name'].'_model', 'model');

        $this->data['activeModule'] = $this->currentModule['control_name'];
        $this->data['activeNav'] = $this->currentModule['control_name'];
        $this->data['breadcrumb'][0] = array('name'=>$this->currentModule['name'], 'url' => B_URL . $this->currentModule['url']);

    // block js and css
        // array_push($this->data['cssBlock'], '<link rel="stylesheet" type="text/css" href="'. ASSETS_URL . 'backend/css/category.min.css" />');
        array_push($this->data['jsBlock'], '<script language="javascript" type="text/javascript" src="'. ASSETS_URL . 'backend/js/setting.js"></script>');

    }
// index
    public function index()
    {
    // check not access
        $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 1);
        $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 2);
        $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 3);
        $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 4);

    // meta
        $page_title = $this->Base_model->get_db('setting', array('value'),array('name'=>'page_title'));
        $page_title != false ? $this->data['page_title'] = $page_title[0]['value'] : $this->data['page_title'] = "";

        $meta_key = $this->Base_model->get_db('setting', array('value'),array('name'=>'meta_key'));
        $meta_key != false ? $this->data['meta_key'] = $meta_key[0]['value'] : $this->data['meta_key'] = "";

        $meta_desc = $this->Base_model->get_db('setting', array('value'),array('name'=>'meta_description'));
        $meta_desc != false ? $this->data['meta_desc'] = $meta_desc[0]['value'] : $this->data['meta_desc'] = "";

    // create frm
        // $this->data['frmTopButtons'] = frm(B_URL.$this->currentModule['url'].'/multi_delete', array('id' => "frmTopButtons"), FALSE);
        $this->data['frmEditMeta'] = frm(B_URL.$this->currentModule['url'].'/update_meta', array('id' => 'frmEditMeta'), FALSE);

        $this->template->load('backend/template', 'backend/setting', $this->data);
    }
// update_meta
    public function update_meta()
    {
        $page_title = $this->input->post('page_title',TRUE);
        $meta_key = $this->input->post('meta_key',TRUE);
        $meta_desc = $this->input->post('meta_desc',TRUE);

        if ( $this->model->update_meta($page_title, $meta_key, $meta_desc) === FALSE ) {
            $this->session->set_userdata('invalid', "Error update data.");
            redirect($_SERVER['HTTP_REFERER']);
        }

        $this->session->set_userdata('valid', "Update data successful.");
        redirect(B_URL.$this->router->fetch_class());
    }

}
