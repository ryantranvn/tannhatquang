<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends Base_model {
    
	protected $connection;

    public function __construct()
    {
        parent::__construct();
    }

// FRONTEND
    function updateLogIn($connection, $idUser)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $this->connection->trans_begin();

            $timeNow = time();

        // update logged
            $this->updateDB($connection, 'user', array('logged'=>1, 'timestamp'=>$timeNow), array('id'=>$idUser));
        // insert log
            $this->insertDB($connection, 'user_log', array('id_user'=>$idUser, 'timeIn'=>$timeNow));
            $idLog = $this->connection->insert_id();

        if ($this->connection->trans_status() === FALSE)
        {
            $this->connection->trans_rollback();
            return FALSE;
        }
        else
        {
            $this->connection->trans_commit();
            return $idLog;
        }
    }
    function updateLogOut($connection, $idUser, $idLog)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $this->connection->trans_begin();

            $timeNow = time();
        // update logged
            $this->updateDB($connection, 'user', array('logged'=>0, 'timestamp'=>0), array('id'=>$idUser));
        // insert log
            $this->updateDB($connection, 'user_log', array('timeOut'=>$timeNow), array('id'=>$idLog));

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

// BACKEND

// total rows
    public function total_Rows($connection, $where="", $like=NULL)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $sql = "SELECT user.id FROM user";
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

        $sql = "SELECT * FROM user";
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
        $sql .= " ORDER BY ".$sidx." ".$sord;
        $sql .= " LIMIT ".$start.", ".$limit;
        
        $query = $this->db->query($sql);

        $result = $query->result_array();
        

        return $result;
    }

// sub total rows
    public function subTotal_Rows($connection, $where="", $like=NULL)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $sql = "SELECT id FROM quiz";
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
        $query = $this->connection->query($sql);
        
        $result = $query->result_array();
        
        return count($result);
    }

// sub list
    public function get_subList($connection, $where, $like, $sidx, $sord, $start, $limit)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);
        
        $sql = "SELECT * FROM quiz";
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
        $sql .= " ORDER BY ".$sidx." ".$sord;
        $sql .= " LIMIT ".$start.", ".$limit;
        $query = $this->connection->query($sql);

        $result = $query->result_array();

        return $result;
    }

// getExport
    // function getExport($connection)
    // {
    //     // set connection
    //     if ($connection===NULL) {
    //         $connection = 'db';
    //     }
    //     $this->connect_to($connection);
    //     $this->connection->trans_begin();

    //     $sql = "SELECT quiz.*, user.email FROM quiz inner join user on quiz.id_user=user.id WHERE quiz.id_user<>? AND quiz.id_user<>? AND quiz.id_user<>?";
    //     $query = $this->db->query($sql,array(1,2,3));
    //     $result = $query->result_array();

    //     if ($this->connection->trans_status() === FALSE)
    //     {
    //         $this->connection->trans_rollback();
    //         return FALSE;
    //     }
    //     else
    //     {
    //         $this->connection->trans_commit();
    //         return $result;
    //     }
    // }

// getContact
    public function getContact($connection)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $sql = "SELECT user_contact.*, user.fullname, user.phone, user.email, user.address FROM user_contact INNER JOIN user ON user_contact.user_id=user.id";
        $query = $this->db->query($sql);
        $result = $query->result_array();

        return $result;
    }

}