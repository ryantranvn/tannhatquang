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
    public function insertModule($connection, $moduleAdd)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $this->connection->trans_begin();

        // create module folder
        /*
            $path = APPPATH.'modules/b_'.$moduleAdd['url'];
            if (!file_exists($path.'/controllers')) { mkdir($path.'/controllers', 0775, true); }
            if (!file_exists($path.'/models')) { mkdir($path.'/models', 0775, true); }
            if (!file_exists($path.'/views')) { mkdir($path.'/views', 0775, true); }
        */
        // insert module
            $this->insertDB($connection, 'module', $moduleAdd);
            $id = $this->connection->insert_id();
        // insert permission
            $members = $this->getDB($connection, 'member', array('id'));
            $permissions = $this->getDB($connection, 'permission', array('id'));
            foreach ($members as $member) {
                foreach ($permissions as $permission) {
                    if ($member['id'] == 1) { // for admin
                        $this->insertDB($connection, 'member_permission', array('id_member'=>$member['id'], 'id_permission'=>$permission['id'], 'id_module'=>$id, 'active' => 1));
                    }
                    else { // for all
                        $this->insertDB($connection, 'member_permission', array('id_member'=>$member['id'], 'id_permission'=>$permission['id'], 'id_module'=>$id));
                    }
                }
            }

        if ($this->connection->trans_status() === FALSE)
        {
            $this->connection->trans_rollback();
            return FALSE;
        }
        else
        {
            $this->connection->trans_commit();
            return $id;
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