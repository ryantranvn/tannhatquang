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

// udpate member (both add & edit)
    public function update_member($member_data, $permissions, $id_member)
    {
        $this->db->trans_begin();

            if ($id_member == NULL) { // add
            // insert member
                $sql_member = "INSERT INTO member (`username`, `password`, `thumbnail`, `status`, `created_datetime`) VALUES (?, ?, ?, ?, ?)";
                $this->db->query($sql_member, array($member_data['username'], $member_data['password'], $member_data['thumbnail'], $member_data['status'], $member_data['datetime']));
                $id_member = $this->db->insert_id();
            // insert permission
                $sql_permission = "INSERT INTO member_permission (`id_member`,`id_module`, `id_permission`, `active`) VALUES (?, ?, ?, ?)";
                foreach ($permissions as $permission) {
                    $this->db->query($sql_permission, array($id_member, $permission['id_module'], $permission['id_permission'], $permission['active']));
                }
            }
            else { // edit
            // update permission
                $sql_permission = "UPDATE member_permission SET `active`=? WHERE `id_member`=? AND `id_module`=? AND `id_permission`=? ";
                foreach ($permissions as $permission) {
                    $this->db->query($sql_permission, array($permission['active'], $id_member, $permission['id_module'], $permission['id_permission']));
                }
            // update member
                if (isset($member_data['password'])) {
                    $sql_member = "UPDATE member SET `password`=?, `thumbnail`=?, `status`=?, `modified_datetime`=? WHERE `id`=?";
                    $this->db->query($sql_member, array($member_data['password'], $member_data['thumbnail'], $member_data['status'], $member_data['datetime'], $id_member));
                }
                else {
                    $sql_member = "UPDATE member SET `thumbnail`=?, `status`=?, `modified_datetime`=? WHERE `id`=?";
                    $this->db->query($sql_member, array($member_data['thumbnail'], $member_data['status'], $member_data['datetime'], $id_member));
                }
            }
            if ($this->db->trans_status() === FALSE)
            {
                $this->db->trans_rollback();
                return FALSE;
            }
            else
            {
                $this->db->trans_commit();
                return TRUE;
            }
    }

// delete member
	public function delete_member($id)
	{
		$this->db->trans_begin();

		// delete member_permission
			$this->delete_db('member_permission', 'id_member', array($id));
		// delete member
			$this->delete_db('member', 'id	', array($id));

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}
		else
		{
			$this->db->trans_commit();
			return TRUE;
		}
	}

/*
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
*/
}
