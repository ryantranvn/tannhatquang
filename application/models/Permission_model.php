<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permission_model extends Base_model {
    
	protected $connection;

    public function __construct()
    {
        parent::__construct();
    }

    private function get_permissions($connection, $id_member)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $this->connection->select('member_permission.*, module.url AS moduleURL');
        $this->connection->from('member_permission');
        $this->connection->join('module','module.id=member_permission.id_module');
        $this->connection->where(array('member_permission.id_member' => $id_member, 'module.active' => 1));
        $this->connection->order_by('member_permission.id_module','asc');
        $this->connection->order_by('member_permission.id_permission','asc');
        $query = $this->connection->get();

        $result = $query->result_array();

        return $result;
    }
    
    public function get_MemberPermissions($connection, $id_member)
    {
        $permissions = $this->get_permissions($connection, $id_member);
        $permission_arr = array();
        foreach ($permissions as $permission) {
            if (!array_key_exists($permission['moduleURL'], $permission_arr)) {
                $permission_arr[$permission['moduleURL']] = array();
            }
            $permission_arr[$permission['moduleURL']][$permission['id_permission']] = $permission['active'];
        }
        return $permission_arr;
    }

}