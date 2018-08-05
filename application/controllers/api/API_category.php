<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'libraries/Gump.php')) {
    require_once(APPPATH . 'libraries/Gump.php');
}

class API_category extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

    // load
        $this->load->model('Category_model');

    }
    public function get_category()
    {
    }
    public function post_category()
    {
        $name = $this->input->post('name',TRUE);
        $url = $this->input->post('url',TRUE);
        $desc = $this->input->post('desc',TRUE);
        $thumbnail = $this->input->post('thumbnail',TRUE);
        $parent_id = $this->input->post('parent_id',TRUE);
        $action = $this->input->post('action',TRUE);
        $id = $this->input->post('id',TRUE);

        $gump = new GUMP();
        $_POST = $gump->sanitize($_POST);
        // validation field
            $gump->validation_rules(array(
                	'name' => 'required|max_len,256',
                	'url' => 'required|max_len,256',
                    'desc' => 'max_len,2048',
                    'parent_id' => 'required|integer'
            ));
            $gump->filter_rules(array(
                    'name' => 'trim|sanitize_string',
                    'url' => 'trim|sanitize_string',
                    'desc' => 'trim|sanitize_string',
                    'parent_id' => 'trim|sanitize_numbers'
            ));
            $validated_data = $gump->run($_POST);
            if($validated_data === FALSE) {
                $msg['err'] = 1;
                $msg['msg'] = $gump->get_readable_errors(TRUE);
            }
        // valid default
            else if ($this->is_default($url)) {
                $msg['err'] = 1;
                $msg['msg'] = 'Category name is not "default".';
            }
        // valid existed
            else if ($this->is_existed($url, $parent_id, $action, $id)) {
                $msg['err'] = 1;
                $msg['msg'] = 'This category name existed.';
            }
            else {
                // make path
                $path = $this->make_path($parent_id);
                if ($action == "edit") {
                    $path .= $id . '-';
                }
                if ($path===FALSE) {
                    $msg['err'] = 1;
                    $msg['msg'] = 'Can not find path of parent';
                }
                else {
                    if ( $this->session->userdata('authMember') !== FALSE) {
                        $authMember = $this->session->userdata('authMember');
                        $created_by = $authMember['username'];
                    }
                    else {
                        $created_by = '';
                    }
                    if ($action == 'add') {
                        // insert database
                        $categoryAdd = array('name' => $name,
                                             'url' => strtolower($url),
                                             'desc' => $desc,
                                             'thumbnail' => $thumbnail,
                                              'order' => $this->input->post('order', TRUE),
                                              'status' => $this->input->post('status', TRUE),
                                              'parent_id' => $parent_id,
                                              'path' => $path,
                                              'created_datetime' => date('Y-m-d H:i:s'),
                                              'created_by' => $created_by
                                             );
                        if ( $this->Category_model->insert_category($categoryAdd, $path) === FALSE ) {
                            $msg['err'] = 1;
                            $msg['msg'] = 'Error insert new data.';
                        }
                        else {
                            $msg['err'] = 0;
                            $this->session->set_userdata('valid', "Insert new data successful.");
                        }
                    }
                    else {
                        // update database
                        $categoryEdit = array('name' => $name,
                                              'url' => $url,
                                              'desc' => $desc,
                                              'thumbnail' => $thumbnail,
                                              'order' => $this->input->post('order', TRUE),
                                              'status' => $this->input->post('status', TRUE),
                                              'parent_id' => $parent_id,
                                              'path' => $path,
                                              'updated_datetime' => date('Y-m-d H:i:s'),
                                              'updated_by' => $created_by
                                             );
                        if ( $this->Category_model->update_category($categoryEdit, $id) === FALSE ) {
                            $msg['err'] = 1;
                            $msg['msg'] = 'Error update data.';
                        }
                        else {
                            $msg['err'] = 0;
                            $this->session->set_userdata('valid', "Update data successful.");
                        }
                    }
                }
            }

        echo json_encode($msg);
    }
    
/* MORE */
    /* is_default */
        private function is_default($url)
        {
            if ( $url == 'default' ) {
                return TRUE; // is default
            }
            return FALSE;
        }

    /* is_existed */
        private function is_existed($url, $parent_id, $action, $id=NULL)
        {
            if ($action == "add") { // add
                $where = array('parent_id' => $parent_id, 'url' => $url);
            }
            else if ($action == "edit") { // edit
                $where = array('id <>' => $id, 'parent_id' => $parent_id, 'url' => $url);
            }
            $existed_url = $this->Base_model->get_db('category',array('id'), $where);
            if ($existed_url !== FALSE && count($existed_url) > 0) {
                return TRUE;    // existed
            }
            else {
                return FALSE;
            }
        }

    /* make path */
        //return path or FALSE
        private function make_path($parent_id)
        {
            $path = "";
            if ($parent_id == 0) {
                $path = "0-";
            }
            else {
                // get path of parent
                $parentPath = $this->Category_model->get_category_haveID($parent_id);
                if ($parentPath === FALSE || count($parentPath)==0) {
                    return FALSE;
                }
                $path .= $parentPath[0]['path'];
            }
            return $path;
        }

}
