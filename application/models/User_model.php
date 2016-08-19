<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends Base_model {
    
	protected $connection;

    public function __construct()
    {
        parent::__construct();
    }

// FRONTEND
    public function insertContactBox($connection, $arrData)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);
        $this->connection->trans_begin();

        // insert user
            $user = $this->getDB($connection, 'user', array('id'), array('email'=>$arrData['email']));
            if ($user == FALSE && count($user)==0) {
                $insertUser = "INSERT INTO user (`fullname`,`email`,`phone`,`ip`,`browser_info`,`created_datetime`) VALUES (?,?,?,?,?,?)";
                $this->connection->query($insertUser,array($arrData['fullname'],$arrData['email'],$arrData['phone'],$arrData['ip'],$arrData['browser_info'],$arrData['created_datetime']));
                $idUser = $this->connection->insert_id();
            }
            else {
                $updateUser = "UPDATE user SET `fullname`=?,`email`=?,`phone`=?,`ip`=?,`browser_info`=?,`created_datetime`=? WHERE `id`=".$user[0]['id'];
                $this->connection->query($updateUser,array($arrData['fullname'],$arrData['email'],$arrData['phone'],$arrData['ip'],$arrData['browser_info'],$arrData['created_datetime']));
                $idUser = $user[0]['id'];
            }
        // insert user contact
            $insertUserContact = "INSERT INTO user_contact (`user_id`,`service`,`type`,`ip`,`browser_info`,`created_datetime`) VALUES (?,?,?,?,?,?)";
            $this->connection->query($insertUserContact,array($idUser,$arrData['service'],$arrData['type'],$arrData['ip'],$arrData['browser_info'],$arrData['created_datetime']));
        
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
    public function insertContactPage($connection, $arrData)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);
        $this->connection->trans_begin();

        // insert user
            $user = $this->getDB($connection, 'user', array('id'), array('email'=>$arrData['email']));
            if ($user == FALSE && count($user)==0) {
                $insertUser = "INSERT INTO user (`fullname`,`email`,`phone`,`address`,`ip`,`browser_info`,`created_datetime`) VALUES (?,?,?,?,?,?,?)";
                $this->connection->query($insertUser,array($arrData['fullname'],$arrData['email'],$arrData['phone'],$arrData['address'],$arrData['ip'],$arrData['browser_info'],$arrData['created_datetime']));
                $idUser = $this->connection->insert_id();
            }
            else {
                $updateUser = "UPDATE user SET `fullname`=?,`email`=?,`phone`=?,`address`=?,`ip`=?,`browser_info`=?,`created_datetime`=? WHERE `id`=".$user[0]['id'];
                $this->connection->query($updateUser,array($arrData['fullname'],$arrData['email'],$arrData['phone'],$arrData['address'],$arrData['ip'],$arrData['browser_info'],$arrData['created_datetime']));
                $idUser = $user[0]['id'];
            }
        // insert user contact
            $insertUserContact = "INSERT INTO user_contact (`user_id`,`title`,`content`,`type`,`ip`,`browser_info`,`created_datetime`) VALUES (?,?,?,?,?,?,?)";
            $this->connection->query($insertUserContact,array($idUser,$arrData['title'],$arrData['content'],$arrData['type'],$arrData['ip'],$arrData['browser_info'],$arrData['created_datetime']));
        
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

    public function insertBooking($connection, $arrData, $arrFile)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);
        $this->connection->trans_begin();

        // insert user
            $user = $this->getDB($connection, 'user', array('id'), array('email'=>$arrData['email']));
            if ($user == FALSE && count($user)==0) {
                $insertUser = "INSERT INTO user (`fullname`,`email`,`phone`,`address`,`ip`,`browser_info`,`created_datetime`) VALUES (?,?,?,?,?,?,?)";
                $this->connection->query($insertUser,array($arrData['fullname'],$arrData['email'],$arrData['phone'],$arrData['address'],$arrData['ip'],$arrData['browser_info'],$arrData['created_datetime']));
                $idUser = $this->connection->insert_id();
            }
            else {
                $updateUser = "UPDATE user SET `fullname`=?,`email`=?,`phone`=?,`address`=?,`ip`=?,`browser_info`=?,`created_datetime`=? WHERE `id`=".$user[0]['id'];
                $this->connection->query($updateUser,array($arrData['fullname'],$arrData['email'],$arrData['phone'],$arrData['address'],$arrData['ip'],$arrData['browser_info'],$arrData['created_datetime']));
                $idUser = $user[0]['id'];
            }
        // insert user contact
            $insertUserContact = "INSERT INTO user_contact (`user_id`,`title`,`content`,`service`,`type`,`brandcar`,`modelcar`,`date`,`ip`,`browser_info`,`created_datetime`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
            $this->connection->query($insertUserContact,array($idUser,$arrData['title'],$arrData['content'],$arrData['service'],$arrData['type'],$arrData['brandcar'],$arrData['modelcar'],$arrData['date'],$arrData['ip'],$arrData['browser_info'],$arrData['created_datetime']));
            $idContact = $this->connection->insert_id();
        // insert car image
            if ($arrFile != FALSE && count($arrFile)>0) {
                foreach ($arrFile as $file) {
                    $insertUserCar = "INSERT INTO user_car (`user_id`,`contact_id`,`image`) VALUES (?,?,?)";
                    $this->connection->query($insertUserCar,array($idUser,$idContact,$file));
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