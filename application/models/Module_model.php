<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module_model extends Base_model {

	protected $connection;

    public function __construct()
    {
        parent::__construct();
    }
// total rows
    public function total_Rows($connection, $where="", $like=NULL)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $this->connection->select('module.id');
        $this->connection->from('module');
        if ($where != NULL && count($where)>0) {
            $this->connection->where($where);
        }
        if ( $like !== NULL && count($like)>0 ) {
            $this->connection->like($like);
        }
        $query = $this->connection->get();

        $result = $query->result_array();

        return count($result);
    }

// list
    public function get_List($connection, $where, $like, $sidx, $sord, $start, $limit)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $this->connection->select('*');
        $this->connection->from('module');
        if ($where != NULL && count($where)>0) {
            $this->connection->where($where);
        }
        if ( $like !== NULL && count($like)>0 ) {
            $this->connection->like($like);
        }
        $this->connection->limit($limit, $start);
        $this->connection->order_by($sidx, $sord);
        $query = $this->connection->get();

        $result = $query->result_array();

        return $result;
    }

// insert
    public function insert_module($module_data)
    {
        $this->db->trans_begin();

        // insert module
            $this->insert_db('module', $module_data);
            $module_id = $this->db->insert_id();
        // insert permission
            $members = $this->get_db('member', array('id'));
            $permissions = $this->get_db('permission', array('id'));
            foreach ($members as $member) {
                foreach ($permissions as $permission) {
                    if ($member['id'] == 1) { // for admin
                        $this->insert_db('member_permission', array('id_member'=>$member['id'], 'id_permission'=>$permission['id'], 'id_module'=>$module_id, 'active' => 1));
                    }
                    else { // for all
                        $this->insert_db('member_permission', array('id_member'=>$member['id'], 'id_permission'=>$permission['id'], 'id_module'=>$module_id));
                    }
                }
            }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }
		else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

// delete
    public function deleteModule($connection, $arrID)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $this->connection->trans_begin();

        // delete permission
            $this->deleteDB($connection, 'member_permission', 'id_module', $arrID);
        // delele folder
            foreach ($arrID as $id) {
                $moduleArr = $this->getDB($connection, 'module', array('url'), array('id'=>$id));
                if ($moduleArr === FALSE || count($moduleArr)>0) {
                    $path = APPPATH.'modules/b_'.$moduleArr[0]['url'];
                    if (file_exists($path.'/controllers')) { rmdir($path.'/controllers'); }
                    if (file_exists($path.'/views')) { rmdir($path.'/views'); }
                    if (file_exists($path.'/models')) { rmdir($path.'/models'); }
                    if (file_exists($path)) { rmdir($path); }
                }
            }
        // delete module
            $this->deleteDB($connection, 'module', 'id', $arrID);

        if ($this->connection->trans_status() === FALSE)
        {
            $this->connection->trans_rollback();
            return FALSE;
        }
        else
        {
            $this->connection->trans_commit();
            return TRUE;
        }
    }
}
