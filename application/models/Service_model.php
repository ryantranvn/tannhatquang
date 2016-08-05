<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service_model extends Base_model {
    
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

        $sql = "SELECT post.*, category.name, category.name_en FROM post LEFT JOIN category ON post.parent_id=category.id";
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

        $sql = "SELECT post.*, category.name AS categoryName, category.name_en AS categoryNameEN FROM post LEFT JOIN category ON post.parent_id=category.id";
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

// insert
    function insertPost($connection, $insertArr)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $insertSql = "INSERT INTO post (`title`,`url`,`desc`,`title_en`,`url_en`,`desc_en`,`thumbnail`,`order`,`status`,`parent_id`,`created_datetime`,`created_by`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        
        $this->connection->trans_begin();
        $this->connection->query($insertSql,array($insertArr['title'],$insertArr['url'],$insertArr['desc'],$insertArr['title_en'],$insertArr['url_en'],$insertArr['desc_en'],$insertArr['thumbnail'],$insertArr['order'],$insertArr['status'],$insertArr['parent_id'],$insertArr['created_datetime'],$insertArr['created_by']));
        
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
// update
	function updatePost($connection, $id, $updateArr)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        return $this->updateDB($connection, 'post', $updateArr, array('id'=>$id));
    }
}