<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_model extends Base_model {
    
	protected $connection;

    public function __construct()
    {
        parent::__construct();
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

        $sql = "SELECT user_contact.id FROM user_contact INNER JOIN user ON user_contact.user_id=user.id";
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

        $sql = "SELECT user_contact.*, user.fullname, user.phone, user.email, user.address FROM user_contact INNER JOIN user ON user_contact.user_id=user.id";
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
        // get images of car
        foreach ($result as $key => $item) {
        	$result[$key]['thumbnail'] = array();
        	$images = $this->getDB($connection, 'user_car', array('image AS imgCar'), array('contact_id'=>$item['id']));
			if ($images!==FALSE && count($images)>0) {
				foreach ($images as $image) {
					array_push($result[$key]['thumbnail'], $image['imgCar']);
				}
			}        	
        }

        return $result;
    }

    public function getExport($connection)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $this->connection->trans_begin();

            $sql = "SELECT user_contact.*, user.fullname, user.phone, user.email, user.address FROM user_contact INNER JOIN user ON user_contact.user_id=user.id";
            $query = $this->db->query($sql);
            $result = $query->result_array();
            // get images of car
            foreach ($result as $key => $item) {
                $result[$key]['thumbnail'] = array();
                $images = $this->getDB($connection, 'user_car', array('image AS imgCar'), array('contact_id'=>$item['id']));
                if ($images!==FALSE && count($images)>0) {
                    foreach ($images as $image) {
                        array_push($result[$key]['thumbnail'], $image['imgCar']);
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
            return $result;
        }
    }
}