<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends Base_model {
    
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

        $sql = "SELECT id FROM member";
        if ($where != NULL && $where != "") {
            $sql .= " WHERE ".$where;
        }
        if ($like != NULL && $like != "") {
            if ($where=="") {
                $like = " WHERE ".$like;
            }
            else {
                $like = " AND ".$like;
            }
            $sql .= $like;
        }
        $query = $this->db->query($sql);
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
        
        $sql = "SELECT * FROM member";
        if ($where != NULL && $where != "") {
            $sql .= " WHERE ".$where;
        }
        if ($like != NULL && $like != "") {
            if ($where=="") {
                $like = " WHERE ".$like;
            }
            else {
                $like = " AND ".$like;
            }
            $sql .= $like;
        }
        $query = $this->db->query($sql);
        $result = $query->result_array();

        return $result;
    }

// insertMember
    public function insertMember($connection, $arrInsert, $arrPermission)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $this->connection->trans_begin();

        // insert new member
            $this->insertDB($connection, 'member', $arrInsert);
            $idMember = $this->connection->insert_id();
        // update permission array 
            foreach ($arrPermission as $arrSub) {
                foreach ($arrSub as $item) {
                    $item['id_member'] = $idMember;
                    $this->insertDB($connection, 'member_permission', $item);
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
            return TRUE;
        }
    }

// updateMemberModule
    public function updateMemberModule($connection, $arrPermission, $id) 
    {
    // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $this->connection->trans_begin();

            foreach ($arrPermission as $module) {
                foreach ($module as $item) {
                    $this->Base_model->updateDB($connection,'member_permission',array('active'=>$item['active']),array('id_member'=>$id, 'id_module'=>$item['id_module'], 'id_permission'=>$item['id_permission']));
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
            return TRUE;
        }
    }

// deleteMember
    public function deleteMember($connection, $arrMember)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $this->connection->trans_begin();

        $this->deleteDB($connection, 'member', 'id', $arrMember);
        $this->deleteDB($connection, 'member_permission', 'id_member', $arrMember);

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