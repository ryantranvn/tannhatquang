<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/backend/Root.php')) {
    require_once(APPPATH . 'controllers/backend/Root.php');
}

class Member extends Root {

	public function __construct()
    {
        parent::__construct();
        $this->currentModule = $this->data['modules'][ucfirst($this->router->fetch_class())];
        $this->data['varJS']['currentModule'] = $this->currentModule;
    // load
        $this->load->model($this->currentModule['control_name'].'_model', 'model');

        $this->data['activeModule'] = $this->currentModule['control_name'];
        $this->data['activeNav'] = $this->currentModule['control_name'];
        $this->data['breadcrumb'][0] = array('name'=>$this->currentModule['control_name'], 'url' => B_URL . $this->currentModule['url']);
    // block js and css
        // array_push($this->data['cssBlock'], '<link rel="stylesheet" type="text/css" href="'. ASSETS_URL . 'backend/css/module.min.css" />');
        array_push($this->data['jsBlock'], '<script language="javascript" type="text/javascript" src="'. ASSETS_URL . 'backend/js/member.js?ver='.$this->data['js_version'].'"></script>');
    // status array
        $this->data['statusArr'] = array(
             'active' => '<button class="btn bg-color-green txt-color-white" data-value="active">Active</button>'
            ,'inactive' => '<button class="btn bg-color-blueDark txt-color-white" data-value="inactive">Inactive</button>'
            // ,'block' => '<button class="btn bg-color-red txt-color-white" data-value="block">Block</button>'
        );
    }

// index
    public function index()
    {
        // check not access
            $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 1);

        // breadcrumb
            $this->data['breadcrumb'][1] = array('name'=>'List', 'url' => B_URL . $this->currentModule['url']);

        // frm
            $this->data['frmTopButtons'] = frm(B_URL.$this->currentModule['url'].'/multi_delete', array('id' => "frmTopButtons"), FALSE);

        $this->template->load('backend/template', 'backend/member', $this->data);
    }

//  Ajax List
    public function ajax_list()
    {
        // get params
            $params = array(
                 'page'     => $_GET['page']
                ,'limit'    => $_GET['rows']
                ,'sidx'     => $_GET['sidx']
                ,'sord'     => $_GET['sord']
            );
        // sql
            $sql = "SELECT * FROM member";
            $where = "";
            if ($this->data['authMember']['username'] != 'admin') {
                $where .= " WHERE username <> 'admin'";
            }
            if (isset($_GET['filters'])) {
                $params['filters'] = json_decode($_GET['filters']);
                if (count($params['filters']->rules)>0) {
                    if ($where == "") {$where .= " WHERE"; } else { $where .= " AND"; }
                    foreach($params['filters']->rules as $rule) {
                        $field = $rule->field;
                        $value = $this->db->escape_like_str($rule->data);

                        $where .= " $field LIKE '%$value%'";
                    }
                }
            }
            $sql .= $where;

        // return json
            echo json_encode($this->Base_model->table_list_in_page($sql, $params));
    }

// ajax_status
    public function ajax_status()
    {
        // check not access
            $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 3);

        $id = $this->input->post('id',TRUE);
        $value = $this->input->post('value',TRUE);

        // update
            if ($this->Base_model->update_db('member', array('status'=>$value), array('id' => $id)) === FALSE) {
                echo "false";
            }
            else {
                echo "true";
            }
    }
// Add
    public function add()
    {
        // check not access
            $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 2);
        // breadcrumb
            $this->data['breadcrumb'][1] = array('name'=>'Add', 'url' => '');
        // create form
            $this->data['frmMember'] = frm(NULL, array('id' => 'frmMember'), FALSE);

        $this->template->load('backend/template', 'backend/member/form', $this->data);
    }
// Edit
    public function edit($id)
    {
        // check not access
            $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 3);
        // check $id
            if ($id===FALSE) {
                $this->session->set_userdata('invalid', "Requested data is not exitesed");
                redirect(B_URL.$this->router->fetch_class());
            }
        // breadcrumb
            $this->data['breadcrumb'][1] = array('name'=>'Edit', 'url' => '');
        // create form
            $this->data['frmMember'] = frm(NULL, array('id' => 'frmMember'), FALSE);
        // get member infor
            $members = $this->Base_model->get_db('member', array('id','username', 'thumbnail', 'status'), array('id'=>$id));
            if ($members== FALSE || count($members)==0) {
                $this->session->set_userdata('invalid', "Requested data is not exitesed");
                redirect(B_URL.$this->router->fetch_class());
            }
            $this->data['frmData'] = $members[0];
        // get permissions
            $this->load->model('Permission_model');
            $permissions = $this->Permission_model->get_member_permissions(2);

            foreach ($permissions as $key => $permission) {
                $this->data['modules'][$key]['permission'] = $permission;

                if ($permission[1]+$permission[2]+$permission[3]+$permission[4]==4) {
                    $full_permission = 1;
                }
                else {
                    $full_permission = 0;
                }
                $this->data['modules'][$key]['permission'][0] = $full_permission;
            }

        $this->template->load('backend/template', 'backend/member/form', $this->data);
    }
// Submit
    public function update()
    {
        $id = $this->input->post('id', TRUE);
        // check permission
        if ($id == NULL) { // add
            $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 2);
        }
        else {
            $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 3);
        }
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
            $msg['err'] = 1;
            $msg['msg'] = validation_errors();
        }
        else {
            $username = strtolower($this->input->post('username', TRUE));
        // get permissions
            $permissions = $this->input->post('permissions',TRUE);
            $new_permissions = array();
            foreach ($permissions as $key => $permission) {
                $exp = explode('_', $key);
                $id_module = $exp[1];
                for ($i=1; $i<=4; $i++) {
                    array_push($new_permissions, array('id_member'=>$id, 'id_module'=>$id_module, 'id_permission'=>$i, 'active'=>$permission[$i]));
                }
            }
            $member_data = array(
                 'username' => $username
                ,'thumbnail' => $this->input->post('thumbnail', TRUE)
                ,'status' => $this->input->post('status', TRUE)
                ,'datetime' => date('Y-m-d H:i:s')
            );
            if ($id == NULL) { // add
                $users = $this->_existed($username);
                if ($users != FALSE && count($users)>0) {
                    $msg['err'] = 1;
                    $msg['msg'] = "This username existed.";
                }
                else {
                    $member_data['password'] = encrypt_pass($this->input->post('password', TRUE));
                    if ($this->model->update_member($member_data, $new_permissions) === FALSE) {
                        $msg['err'] = 1;
                        $msg['msg'] = 'Error insert new data.';
                    }
                    else {
                        $msg['err'] = 0;
                        $this->session->set_userdata('valid', "Insert new data successful.");
                    }
                }
            }
            else {
                $users = $this->_existed($username, $id);
                if ($users != FALSE && count($users)>1) {
                    $msg['err'] = 1;
                    $msg['msg'] = "This username existed.";
                }
                else {
                    $user = $users[0];
                    // check old_password
                    $old_password = $this->input->post('old_password', TRUE);
                    if ($old_password != "") {
                        $old_password = encrypt_pass($old_password);
                        if ($old_password != $user['password']) {
                            $msg['err'] = 1;
                            $msg['msg'] = "Old password is wrong";
                            echo json_encode($msg);
                            exit();
                        }
                        else {
                            // get new password
                            $member_data['password'] = encrypt_pass($this->input->post('password', TRUE));
                        }
                    }
                    if ($this->model->update_member($member_data, $new_permissions, $id) === FALSE) {
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
// Delete
    public function delete($id)
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 4);
        // exclude  default categories
            if ($id===FALSE || $id=="" || $id==0) {
                $this->session->set_userdata('invalid', 'This ID is not existing.');
                redirect($_SERVER['HTTP_REFERER']);
            }
        // delete db
            if ($this->model->delete_member($id) === FALSE) {
                $this->session->set_userdata('invalid', "Error delete data");
            }
            else {
                $this->session->set_userdata('valid', "Delete data successful.");
            }
        redirect($_SERVER['HTTP_REFERER']);
    }
// _existed
    private function _existed($username, $id=NULL)
    {
        if ($id == NULL) { // add
            $users = $this->Base_model->get_db('member', NULL, array('username' => $username));
        }
        else { // edit
            $users = $this->Base_model->get_db('member', NULL, array('id' => $id, 'username =' => $username));
        }
        if ($users !== FALSE && count($users) > 0) {
            return $users;    // existed
        }
        else {
            return FALSE;
        }
    }


/*

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
*/

}
