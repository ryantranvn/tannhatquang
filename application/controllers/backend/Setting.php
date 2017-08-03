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

    // load
        $this->load->model($this->module.'_model', 'model');

        $this->data['activeModule'] = $this->module;
        $this->data['activeNav'] = $this->module;
        $this->data['breadcrumb'][0] = array('name'=>ucfirst($this->module), 'url' => B_URL . $this->module);
    }
// index
    public function index()
    {
    // check not access
        $this->noAccess($this->data['permissionsMember'], $this->module, 1);
        $this->noAccess($this->data['permissionsMember'], $this->module, 2);
        $this->noAccess($this->data['permissionsMember'], $this->module, 3);
        $this->noAccess($this->data['permissionsMember'], $this->module, 4);

        $this->data['breadcrumb'][1] = array('name'=>'List', 'url' => B_URL . $this->router->fetch_method());

    // meta
        $pageTitle = $this->Base_model->getDB('db','setting', array('value'),array('name'=>'page_title'));
        $pageTitle != false ? $this->data['pageTitle'] = $pageTitle[0]['value'] : $this->data['pageTitle'] = "";

        $metaKey = $this->Base_model->getDB('db','setting', array('value'),array('name'=>'meta_key'));
        $metaKey != false ? $this->data['metaKey'] = $metaKey[0]['value'] : $this->data['metaKey'] = "";

        $metaDesc = $this->Base_model->getDB('db','setting', array('value'),array('name'=>'meta_desc'));
        $metaDesc != false ? $this->data['metaDesc'] = $metaDesc[0]['value'] : $this->data['metaDesc'] = "";

        $this->data['frmEditMeta'] = frm(B_URL.$this->module.'/edit_meta_db', array('id' => 'frmEditMeta'), TRUE);

        $this->template->load('backend/template', 'backend/'.$this->module.'/setting', $this->data);
    }

    public function edit_meta_db()
    {
        $pageTitle = $this->input->post('pageTitle',TRUE);
        $metaKey = $this->input->post('metaKey',TRUE);
        $metaDesc = $this->input->post('metaDesc',TRUE);

        if ( $this->model->updateMeta('db', $pageTitle, $metaKey, $metaDesc) === FALSE ) {
            $this->session->set_userdata('invalid', "Error update data.");
            redirect($_SERVER['HTTP_REFERER']);
        }

        $this->session->set_userdata('valid', "Update data successful.");
        redirect(B_URL.$this->router->fetch_class());
    }

}
