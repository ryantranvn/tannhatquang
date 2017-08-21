<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends Base_model {

    public function __construct()
    {
        parent::__construct();
    }

// get category with ID
    function get_category_haveID($id)
    {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('id',$id);
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }

// get string Path
    function strPath($path)
    {
        $this->db->trans_begin();
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
                $arrName = $this->get_db('category', array('name'), array('id'=>$arrCategory[$i]));
                if ( $arrName !== FALSE && count($arrName)>0 ) {
                    $pathName .= $arrName[0]['name'].'-';
                }
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
            return array('pathName' => $pathName);
        }
    }

// update active and update for all children
    function update_status($id, $status)
    {
        // get category path
            $categories = $this->Base_model->get_db('category', array('path'), array('id' => $id));
            $path = $categories[0]['path'];

            if ($status == 'active') {
                // just active for this
                $this->Base_model->update_db('category', array('status'=>$status), array('id' => $id));
            }
            else {
                // update active for all children
                $sql_updateChildren = "UPDATE category SET status=? WHERE path LIKE ?";
                $this->db->query($sql_updateChildren, array($status, $path.'%'));
            }
        // run trans
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

// insert
    // first    : insert new category
    // second   : get id recent add
    // third    : update PATH with that ID recent add
    function insert_category($insertArr, $path)
    {
        $insertSql = "INSERT INTO category (`name`,`url`,`desc`,`thumbnail`,`order`,`status`,`parent_id`,`created_datetime`,`created_by`) VALUES (?,?,?,?,?,?,?,?,?)";
        $updateSql = "UPDATE category SET `path`=? WHERE id=?";

        $this->db->trans_begin();

            $this->db->query($insertSql,array($insertArr['name'],$insertArr['url'],$insertArr['desc'],$insertArr['thumbnail'],$insertArr['order'],$insertArr['status'],$insertArr['parent_id'],$insertArr['created_datetime'],$insertArr['created_by']));
            $id = $this->db->insert_id();
            $path .= $id."-";
            $this->db->query($updateSql,array($path, $id));

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

// update
    // first    : update category
    // second   : update all children if status=inactive/block
    function update_category($categoryEdit, $id)
    {
        $this->db->trans_begin();

        $this->Base_model->update_db('category', $categoryEdit, array('id' => $id));
        if ($categoryEdit['status']!='active') {
            // inactive/block all children
            $sql_updateChildren = "UPDATE category SET status=? WHERE path LIKE ?";
            $this->db->query($sql_updateChildren, array($categoryEdit['status'], $categoryEdit['path'].'%'));
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

// delete
    // 1. move all post (if have) to default parent and set deleted=1
    // 2. delete all children category
    // 3. delete this category
    function delete_category($id)
    {
        $this->db->trans_begin();

        // get category need delete and find root parent
            $categories = $this->get_db('category', NULL, array('id'=>$id));
            if ($categories == FALSE || count($categories)==0) {
                return FALSE;
            }
            $category = $categories[0];
            $root_parent_id = explode('-', $category['path'])[1];

        // get all children
            $children = $this->Base_model->get_db('category', array('id', 'path'), NULL, array('path' => $category['path']));
            foreach ($children as $child) {
                // move all post
                $this->update_db('post', array('category_id' => $root_parent_id, 'deleted' => 1), array('category_id'=>$child['id']));
                // delete category
                $this->delete_db('category', 'id', $child['id']);
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

}
