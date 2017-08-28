<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permission_model extends Base_model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_module_permissions($id_member)
    {
        $this->db->select('member_permission.*, module.control_name');
        $this->db->from('member_permission');
        $this->db->join('module','module.id=member_permission.id_module');
        $this->db->where(array('member_permission.id_member' => $id_member, 'module.active' => 1));
        $this->db->order_by('member_permission.id_module','asc');
        $this->db->order_by('member_permission.id_permission','asc');
        $query = $this->db->get();

        $result = $query->result_array();

        return $result;
    }

    public function get_member_permissions($id_member)
    {
        $permissions = $this->get_module_permissions($id_member);

        $permission_arr = array();
        foreach ($permissions as $permission) {
            if (!array_key_exists($permission['control_name'], $permission_arr)) {
                $permission_arr[$permission['control_name']] = array();
            }
            $permission_arr[$permission['control_name']][$permission['id_permission']] = $permission['active'];
        }
        return $permission_arr;
    }

}
