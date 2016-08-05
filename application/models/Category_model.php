<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends Base_model {
    
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

        $sql = "SELECT c1.id, c1.name, c1.url, c1.desc, c1.thumbnail, c1.order, c1.status, if (c1.parent_id =0, 'ROOT', c2.name) AS parent FROM category c1 left join category c2 on c1.parent_id=c2.id";
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

        $sql = "SELECT c1.id, c1.name, c1.url, c1.desc, c1.thumbnail, c1.order, c1.status, if (c1.parent_id =0, 'ROOT', c2.name) AS parent FROM category c1 left join category c2 on c1.parent_id=c2.id";
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

// get category with ID
    function get_category_haveID($connection, $id)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $this->connection->select('*');
        $this->connection->from('category');
        $this->connection->where('id',$id);
        $query = $this->connection->get();
        $result = $query->result_array();
        
        return $result;
    }

// get string Path
    function strPath($connection, $path)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $this->connection->trans_begin();
        $pathName = "";
        $arrCategory = explode('-', $path);
        for ($i=0; $i<count($arrCategory)-2; $i++) { // not get itself
            if ($arrCategory[$i] == "0") {
                $pathName .= "ROOT-";
            }
            else if ($arrCategory[$i] == "1") {
                $pathName .= "DEFAULT-";
            }
            else {
                $arrName = $this->getDB($connection, 'category', array('name'), array('id'=>$arrCategory[$i]));
                if ( $arrName !== FALSE && count($arrName)>0 ) {
                    $pathName .= $arrName[0]['name'].'-';
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
            return array('pathName' => $pathName);
        }
    }

// update active and update for all children
    function update_status($connection, $id, $status)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $this->connection->trans_begin();

        // get category path
            $categories = $this->Base_model->getDB($connection, 'category', array('path'), array('id' => $id));
            $path = $categories[0]['path'];

            if ($status == 'active') {
                // just active for this
                $this->Base_model->updateDB('db', 'category', array('status'=>$status), array('id' => $id));
            }
            else {
                // update active for all children
                $sql_updateChildren = "UPDATE category SET status=? WHERE path LIKE ?";
                $this->connection->query($sql_updateChildren, array($status, $path.'%'));
            }
        // run trans
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

// insert
    // first    : insert new category
    // second   : get id recent add
    // third    : update PATH with that ID recent add
    function insertCategory($connection, $insertArr, $path, $other)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $insertSql = "INSERT INTO category (`name`,`url`,`desc`,`name_en`,`url_en`,`desc_en`,`thumbnail`,`order`,`status`,`parent_id`,`created_datetime`,`created_by`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        $updateSql = "UPDATE category SET `path`=? WHERE id=?";
        if ($other !== NULL) {
            $addChildOther = "INSERT INTO category (`name`,`url`,`desc`,`name_en`,`url_en`,`desc_en`,`parent_id`) VALUES (?,?,?,?,?,?,?)";
        }
        
        $this->connection->trans_begin();
        $this->connection->query($insertSql,array($insertArr['name'],$insertArr['url'],$insertArr['desc'],$insertArr['name_en'],$insertArr['url_en'],$insertArr['desc_en'],$insertArr['thumbnail'],$insertArr['order'],$insertArr['status'],$insertArr['parent_id'],$insertArr['created_datetime'],$insertArr['created_by']));
        $id = $this->connection->insert_id();
        $path .= $id."-";
        $this->connection->query($updateSql,array($path,$id));
        if ($other !== NULL) {
            $this->connection->query($addChildOther,array('Other', 'other', 'Other', 'Other', 'other', 'Other', $id));
            $id_other = $this->connection->insert_id();
            $path .= $id_other."-";
            $this->connection->query($updateSql,array($path, $id_other));
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

// update
    // first    : update category
    // second   : update all children if status=inactive/block
    function updateCategory($connection, $categoryEdit, $id)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $this->connection->trans_begin();

        $this->Base_model->updateDB($connection, 'category', $categoryEdit, array('id' => $id));
        if ($categoryEdit['status']!='active') {
            // inactive/block all children
            $sql_updateChildren = "UPDATE category SET status=? WHERE path LIKE ?";
            $this->connection->query($sql_updateChildren, array($categoryEdit['status'], $categoryEdit['path'].'%'));
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
    // 1. move all post (if have) to default
    // 2. move all children category (if have) to default
    // 3. delete this category
    function deleteCategory($connection, $id, $deleteChildren)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $this->connection->trans_begin();
        
        // 1. move all post (if have) to default or delete
            /*$posts = $this->getDB($connection , 'post', array('id'), array('id_category' => $id));
            if (count($posts)>0) {
                if ($deleteChildren) {
                    $this->deleteDB($connection, 'post', 'id_category', array($id));
                }
                else {
                    $this->updateDB($connection, 'post', array('id_category' => 1), array('id_category' => $id));
                }
            }*/
        
        // 2. move all children category (if have) to default
            $children = $this->getDB($connection , 'category', array('id'), array('parent_id' => $id));
            if ($children != FALSE && count($children)>0) {
                if ($deleteChildren) {
                    $children_arrayID = array();
                    foreach ($children as $child) {
                        array_push($children_arrayID, $child['id']);
                    }
                    $this->deleteDB($connection ,'category', 'id', $children_arrayID);
                }
                else {
                    foreach ($children as $child) {
                        $new_path = '0-1-'.$child['id']."-";
                        $this->updateDB($connection , 'category', array('parent_id' => 1, 'path' => $new_path), array('id' => $child['id']));
                    }
                }
            }

        // 3. delete this category
            $this->deleteDB($connection, 'category', 'id', array($id));

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