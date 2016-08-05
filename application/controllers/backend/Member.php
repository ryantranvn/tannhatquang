<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/backend/Root.php')) {
    require_once(APPPATH . 'controllers/backend/Root.php');
}

class Member extends Root {

	private $module = 'member';

    public function __construct()
    {
        parent::__construct();

        // load
        $this->load->model($this->module.'_model', 'model');

        $this->data['activeModule'] = $this->module;
        $this->data['activeNav'] = "member";
        $this->data['breadcrumb'][0] = array('name'=>ucfirst($this->module), 'url' => B_URL . $this->router->fetch_class());
    }
// index
    public function index()
    {
        // check not access
        $this->noAccess($this->data['permissionsMember'], $this->module, 1);

        $this->data['breadcrumb'][1] = array('name'=>'List', 'url' => B_URL . $this->router->fetch_method());
        // frm
            $this->data['frmTopButtons'] = frm(B_URL.$this->module.'/multi_delete', array('id' => "frmTopButtons"), FALSE);
            // $this->data['frmImport'] = frm(B_URL.$this->module.'/import_db', array('id' => "frmImport"), TRUE);

        $this->template->load('backend/template', 'backend/member/list', $this->data);
    }

//  Ajax List
    public function ajax_list()
    {
        $arrJSON = array();
        $page = $_GET['page']; // get the requested page
        $limit = $_GET['rows']; // get how many rows we want to have into the grid
        $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
        $sord = $_GET['sord']; // get the direction
        if(!$sidx) $sidx=1;
        // add where in string
            $where = "";
        // get filter if have
            // $search = $_GET['_search'];
            $like = array();
            if (isset($_GET['filters'])) {
                $filters = $_GET['filters'];
                $filters = json_decode($filters);
                
                foreach($filters->rules as $rule) { // filter is active
                    $field = $rule->field;
                    $value = $rule->data;
                    if ($field == "status") {
                        $where['status'] = $value;
                    }
                    else {
                        $field = 'member.'.$field;
                        $like[$field] = $value;
                    }
                }
            }
            
        // get total row => total page
            $count = $this->model->total_Rows('db', $where, $like); 
            if( $count>0 ) {
                $total_pages = ceil($count/$limit);
            } else {
                $total_pages = 0;
            }
            if ($page > $total_pages) $page=$total_pages;
            $start = $limit*$page - $limit;
            if ($start <= 0) $start=0;
        // query database
            $list = $this->model->get_List('db', $where, $like, $sidx, $sord, $start, $limit);

        // arrange result
            $arrJSON['sidx'] = $sidx;
            $arrJSON['page'] = $page;
            $arrJSON['total'] = $total_pages;
            $arrJSON['records'] = $count;
            $arrJSON['rows'] = $list;

        // return json 
            echo json_encode($arrJSON);
    }

// ajax_status
    public function ajax_status()
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->module, 3);
            
        $id = $this->input->post('id',TRUE);
        $value = $this->input->post('value',TRUE);

        if ( $this->Base_model->updateDB('db', 'member', array('status' => $value), array('id' => $id)) === FALSE ) {
            echo "false";
        }
        else {
            echo "true";
        }
    }

// Add
    public function add()
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->module, 2);

            $this->data['breadcrumb'][1] = array('name'=>'Add', 'url' => B_URL . $this->router->fetch_method());
        // create form
            $this->data['frmAdd'] = frm(B_URL.$this->module.'/add_db', array('id' => 'frmAdd'), TRUE);
        
        $this->template->load('backend/template', 'backend/member/add', $this->data);
    }

    public function add_db()
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->module, 2);
        // validate
            $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]|xss_clean');
            // set error message
            $this->form_validation->set_message('required', '"%s" is required<br/>');
            $this->form_validation->set_message('min_length', '"%s" is minimum with 3 characters<br/>');
            $this->form_validation->set_message('max_length', '"%s" is maximum with 255 characters<br/>');
            $this->form_validation->set_message('matches', 'Confirm Password must match with Password<br/>');
            if ( $this->form_validation->run() == FALSE) {
                $this->session->set_userdata('invalid', validation_errors());
                redirect(B_URL.$this->router->fetch_class().'/add');
            }

        // check existed
            $arrInsert = array('username' => $this->input->post('username', TRUE),
                               'password' => encrypt_pass($this->input->post('password', TRUE)),
                               'thumbnail' => $this->input->post('thumbnail', TRUE),
                               'status' =>$this->input->post('status', TRUE),
                               'created_datetime' => date('Y-m-d H:i:s')
                               );
            // valid existed
            if ($this->_existed('add', $arrInsert['username'])) {
                $this->session->set_userdata('invalid', "This username existed.");
                redirect(B_URL.$this->router->fetch_class().'/add');
            }

        // get permissions
            $arrPermission = array();
            foreach ($this->data['modules'] as $module) {
                $this->input->post($module['name'].'_read',TRUE) == "on" ? $read = 1 : $read = 0;
                $this->input->post($module['name'].'_add',TRUE) == "on" ? $add = 1 : $add = 0;
                $this->input->post($module['name'].'_edit',TRUE) == "on" ? $edit = 1 : $edit = 0;
                $this->input->post($module['name'].'_delete',TRUE) == "on" ? $delete = 1 : $delete = 0;
                $arrTemp = array();
                $arrTemp[0] = array('id_module' => $module['id'], 'id_permission' => 1, 'active' => $read);
                $arrTemp[1] = array('id_module' => $module['id'], 'id_permission' => 2, 'active' => $add);
                $arrTemp[2] = array('id_module' => $module['id'], 'id_permission' => 3, 'active' => $edit);
                $arrTemp[3] = array('id_module' => $module['id'], 'id_permission' => 4, 'active' => $delete);

                array_push($arrPermission, $arrTemp);
            }
            // print_r("<pre>");print_r($arrPermission);die();
        
        // insert data
            if ($this->model->insertMember('db', $arrInsert, $arrPermission) === FALSE) {
                $this->session->set_userdata('invalid', "Error insert data.");
                redirect(B_URL.$this->router->fetch_class().'/add');
            }
            $this->session->set_userdata('valid', "Insert data successful.");
            redirect(B_URL.$this->router->fetch_class());
    }

// Edit
    public function edit($id)
    {
        if ($id===FALSE) {
            $this->session->set_userdata('invalid', "Requested data is not exitesed");
            redirect(B_URL.$this->router->fetch_class());
        }
        $this->data['breadcrumb'][1] = array('name'=>'Edit', 'url' => B_URL . $this->router->fetch_method());
        // get member
        $arrMember = $this->Base_model->getDB('db','member',array('id','username','thumbnail','status'),array('id'=>$id));
        $this->data['member'] = $arrMember[0];
        // get member permission
        foreach ($this->data['modules'] as $key => $item) {
            $permissions = $this->Base_model->getDB('db','member_permission', array('id AS id_member_permission', 'id_permission','active AS activePermission'), array('id_member'=>$id, 'id_module' => $item['id']), NULL, array('id_member','id_module','id_permission'), array('asc','asc','asc'));
            $this->data['modules'][$key]['permission_read'] = $permissions[0]['activePermission'];
            $this->data['modules'][$key]['permission_add'] = $permissions[1]['activePermission'];
            $this->data['modules'][$key]['permission_edit'] = $permissions[2]['activePermission'];
            $this->data['modules'][$key]['permission_delete'] = $permissions[3]['activePermission'];
        }
        
        // create form
            $this->data['frmEditInfo'] = frm(B_URL.$this->module.'/edit_info_db', array('id' => 'frmEditInfo'), TRUE, array('id'=>$id));
            $this->data['frmEditPassword'] = frm(B_URL.$this->module.'/edit_password_db', array('id' => 'frmEditPassword'), FALSE, array('id'=>$id));
            $this->data['frmEditPermission'] = frm(B_URL.$this->module.'/edit_permission_db', array('id' => 'frmEditPermission'), FALSE, array('id'=>$id));
            
        $this->template->load('backend/template', 'backend/member/edit', $this->data);
    }
    public function edit_info_db()
    {
        $id = $this->input->post('id', TRUE);
        // validate
            $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[255]|xss_clean');
            // set error message
            $this->form_validation->set_message('required', '"%s" is required<br/>');
            $this->form_validation->set_message('max_length', '"%s" is maximum with 255 characters<br/>');
            if ( $this->form_validation->run() == FALSE) {
                $this->session->set_userdata('invalid', validation_errors());
                redirect(B_URL.$this->router->fetch_class().'/edit/'.$id);
            }

        // check existed
            $arrUpdate = array('username' => $this->input->post('username', TRUE),
                               'thumbnail' => $this->input->post('thumbnail', TRUE),
                               'status' =>$this->input->post('status', TRUE)
                               );
            // print_r("<pre>"); print_r($arrUpdate); die();
            // valid existed
            if ($this->_existed('edit', $arrUpdate['username'], $id)) {
                $this->session->set_userdata('invalid', "This username existed.");
                redirect(B_URL.$this->router->fetch_class().'/edit/'.$id);
            }
        
        // update data
            if ($this->Base_model->updateDB('db', 'member', $arrUpdate, array('id' => $id)) === FALSE) {
                $this->session->set_userdata('invalid', "Error update data.");
                redirect(B_URL.$this->router->fetch_class().'/edit/'.$id);
            }
            $this->session->set_userdata('valid', "Update data successful.");
            redirect(B_URL.$this->router->fetch_class());
    }
    public function edit_password_db()
    {
        $id = $this->input->post('id', TRUE);
        // validate
            $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|min_length[3]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('password', 'New Password', 'trim|required|min_length[3]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]|xss_clean');
            // set error message
            $this->form_validation->set_message('required', '"%s" is required<br/>');
            $this->form_validation->set_message('min_length', '"%s" is minimum with 3 characters<br/>');
            $this->form_validation->set_message('max_length', '"%s" is maximum with 255 characters<br/>');
            $this->form_validation->set_message('matches', 'Confirm Password must match with New Password<br/>');
            if ( $this->form_validation->run() == FALSE) {
                $this->session->set_userdata('invalid', validation_errors());
                redirect(B_URL.$this->router->fetch_class().'/edit/'.$id);
            }

        // check old password
            $old_password = encrypt_pass($this->input->post('old_password', TRUE));
            $arrOldPassword = $this->Base_model->getDB('db','member', array('password'), array('id' => $id));
            if ($arrOldPassword !== FALSE && count($arrOldPassword)>0) {
                if ($old_password != $arrOldPassword[0]['password']) {
                    $this->session->set_userdata('invalid', "Invalid old password.");
                    redirect(B_URL.$this->router->fetch_class().'/edit/'.$id);
                }
            }

        // update password
            $arrUpdate = array('password' => encrypt_pass($this->input->post('password', TRUE)));
            if ($this->Base_model->updateDB('db', 'member', $arrUpdate, array('id' => $id)) === FALSE) {
                $this->session->set_userdata('invalid', "Error update data.");
                redirect(B_URL.$this->router->fetch_class().'/edit/'.$id);
            }
            $this->session->set_userdata('valid', "Update data successful.");
            redirect(B_URL.$this->router->fetch_class());
    }
    public function edit_permission_db()
    {
        $id = $this->input->post('id',TRUE);
        // get permissions
            $arrPermission = array();
            foreach ($this->data['modules'] as $module) {
                $this->input->post($module['name'].'_read',TRUE) == "on" ? $read = 1 : $read = 0;
                $this->input->post($module['name'].'_add',TRUE) == "on" ? $add = 1 : $add = 0;
                $this->input->post($module['name'].'_edit',TRUE) == "on" ? $edit = 1 : $edit = 0;
                $this->input->post($module['name'].'_delete',TRUE) == "on" ? $delete = 1 : $delete = 0;
                $arrTemp = array();
                $arrTemp[0] = array('id_module' => $module['id'], 'id_permission' => 1, 'active' => $read);
                $arrTemp[1] = array('id_module' => $module['id'], 'id_permission' => 2, 'active' => $add);
                $arrTemp[2] = array('id_module' => $module['id'], 'id_permission' => 3, 'active' => $edit);
                $arrTemp[3] = array('id_module' => $module['id'], 'id_permission' => 4, 'active' => $delete);

                array_push($arrPermission, $arrTemp);
            }
            // print_r("<pre>");print_r($arrPermission);die();
        // update password
            if ($this->model->updateMemberModule('db', $arrPermission, $id) === FALSE) {
                $this->session->set_userdata('invalid', "Error update data.");
                redirect(B_URL.$this->router->fetch_class().'/edit/'.$id);
            }
            $this->session->set_userdata('valid', "Update data successful.");
            redirect(B_URL.$this->router->fetch_class());
    }

// Delete
    public function delete($id)
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->module, 4);

        if ($id === FALSE) {
            $this->session->set_userdata('invalid', "Data does not exist.");
            redirect($_SERVER['HTTP_REFERER']);
        }
        if ($this->model->deleteMember('db', array($id)) === FALSE) {
            $this->session->set_userdata('invalid', "Error delete data");
        }
        else {
            $this->session->set_userdata('valid', "Delete data successful.");
        }
        redirect(B_URL.$this->router->fetch_class());
    }    

// Multi Delete
    public function multi_delete()
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->module, 4);
            
        $ids = $this->input->post('ids', TRUE);
        $arrID = explode(",", $ids[0]);
        
        if ($this->model->deleteMember('db', $arrID) === FALSE) {
            $this->session->set_userdata('invalid', "Error delete data");
        }
        else {
            $this->session->set_userdata('valid', "Delete data successful.");
        }

        redirect(B_URL.$this->router->fetch_class());
    }


// ********************************
// check existed
    private function _existed($oper, $username, $id=NULL)
    {
        if ($oper == "add") { // add
            $existed_username = $this->Base_model->getDB('db','member',array('id'),array('username' => $username));
        }
        else { // edit
            $existed_username = $this->Base_model->getDB('db','member',array('id'),array('id <>' => $id, 'username =' => $username));
        }
        if ($existed_username !== FALSE && count($existed_username) > 0) {
            return TRUE;    // existed
        }
        else {
            return FALSE;
        }
    }

// ajax_existed_username
    public function ajax_existed_username()
    {
        $oper = $this->input->post('oper',TRUE);
        $username = $this->input->post('username',TRUE);
        $id = $this->input->post('id',TRUE); // get id on edit
        if ($id===FALSE || $id == 0) { $id = NULL; }

        if ($this->_existed($oper, $username, $id)) {
            echo "false";   // // existed => return false for validation
        }
        else {
            echo "true";
        }
    } 
}