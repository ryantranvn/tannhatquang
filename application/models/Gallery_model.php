<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_model extends Base_model {
    
	protected $connection;

    public function __construct()
    {
        parent::__construct();
    }
// FRONTEND
    public function getBeforeAfter($connection, $lang)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        if ($lang=='vn') {
            $post = $this->getDB($connection, 'post', array('id','title','desc'), array('parent_id'=>9, 'status'=>'active'), NULL, array('order','id'), array('asc','desc'));
        }
        else {
            $post = $this->getDB($connection, 'post', array('id','title_en AS title','desc_en AS desc'), array('parent_id'=>9, 'status'=>'active'), NULL, array('order','id'), array('asc','desc'));
        }
        
        if ($post !== FALSE && count($post)>0) {
            foreach ($post as $key => $item) {
                $detail = $this->getDB($connection, 'post_detail', array('value', 'type'), array('post_id'=>$item['id']), NULL, array('type'), array('desc'));
                if ($detail !== FALSE && count($detail)>0) {
                    $post[$key]['detail'] = $detail;
                }
            }
        }
        
        return $post;
    }
    public function getEvent($connection, $lang)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        if ($lang=='vn') {
            $post = $this->getDB($connection, 'post', array('id','title','desc'), array('parent_id'=>10, 'status'=>'active'), NULL, array('order','id'), array('asc','desc'));
        }
        else {
            $post = $this->getDB($connection, 'post', array('id','title_en AS title','desc_en AS desc'), array('parent_id'=>10, 'status'=>'active'), NULL, array('order','id'), array('asc','desc'));
        }
        
        if ($post !== FALSE && count($post)>0) {
            foreach ($post as $key => $item) {
                $detail = $this->getDB($connection, 'post_detail', array('value', 'type'), array('post_id'=>$item['id']), NULL, array('type'), array('desc'));
                if ($detail !== FALSE && count($detail)>0) {
                    $post[$key]['detail'] = $detail;
                }
            }
        }
        
        return $post;
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
    function insertPost($connection, $insertArr, $type, $arrDetail)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $this->connection->trans_begin();
        // insert data to post
            $this->insertDB($connection, 'post', $insertArr);
            $post_id = $this->connection->insert_id();
        // insert data to post detail
            if ($insertArr['parent_id'] == 9) {
                foreach ($arrDetail as $key => $item) {
                    $this->insertDB($connection, 'post_detail', array('post_id' => $post_id, 'type' => $key, 'value' => $item));
                }
            }
            else if ($insertArr['parent_id'] == 10) {
                foreach ($arrDetail as $key => $item) {
                    $this->insertDB($connection, 'post_detail', array('post_id' => $post_id, 'type' => $type, 'value' => $item));
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
    
// delete
    function deleteGallery($connection, $arr)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);
        $this->connection->trans_begin();
        // delete detail
        $this->deleteDB($connection, 'post_detail', 'post_id', $arr);
        // delete post
        $this->deleteDB($connection, 'post', 'id', $arr);

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