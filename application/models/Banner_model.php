<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner_model extends Base_model {
    
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
    function insertBannerHome($connection, $page, $arrBannerHome_1VN, $arrBannerHome_1EN, $arrBannerHome_2VN, $arrBannerHome_2EN, $arrBannerHome_1VN_del, $arrBannerHome_1EN_del, $arrBannerHome_2VN_del, $arrBannerHome_2EN_del)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $this->connection->trans_begin();

        // insert home 
            if (isset($arrBannerHome_1VN) && count($arrBannerHome_1VN)>0) {
                foreach ($arrBannerHome_1VN as $value) {
                    $this->insertDB($connection, 'post', array('parent_id'=>11, 'type'=>$page.'_1', 'url' => $value));
                }
            }
            if (isset($arrBannerHome_1EN) && count($arrBannerHome_1EN)>0) {
                foreach ($arrBannerHome_1EN as $value) {
                    $this->insertDB($connection, 'post', array('parent_id'=>11, 'type'=>$page.'_1', 'url_en' => $value));
                }
            }
            if (isset($arrBannerHome_2VN) && count($arrBannerHome_2VN)>0) {
                foreach ($arrBannerHome_2VN as $value) {
                    $this->insertDB($connection, 'post', array('parent_id'=>11, 'type'=>$page.'_2', 'url' => $value));
                }
            }
            if (isset($arrBannerHome_2EN) && count($arrBannerHome_2EN)>0) {
                foreach ($arrBannerHome_2EN as $value) {
                    $this->insertDB($connection, 'post', array('parent_id'=>11, 'type'=>$page.'_2', 'url_en' => $value));
                }
            }
        // delete old
            if (isset($arrBannerHome_1VN_del) && count($arrBannerHome_1VN_del)>0) {
                $this->deleteDB($connection, 'post', 'url', $arrBannerHome_1VN_del);
            }
            if (isset($arrBannerHome_1EN_del) && count($arrBannerHome_1EN_del)>0) {
                $this->deleteDB($connection, 'post', 'url_en', $arrBannerHome_1EN_del);
            }
            if (isset($arrBannerHome_2VN_del) && count($arrBannerHome_2VN_del)>0) {
                $this->deleteDB($connection, 'post', 'url', $arrBannerHome_2VN_del);
            }
            if (isset($arrBannerHome_2EN_del) && count($arrBannerHome_2EN_del)>0) {
                $this->deleteDB($connection, 'post', 'url_en', $arrBannerHome_2EN_del);
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

    function insertBanner($connection, $page, $arrBanner)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $this->connection->trans_begin();

        $record = $this->getDB($connection, 'post', array('url'), array('parent_id'=>11, 'type'=>$page));
        if ($record == FALSE || count($record)==0) {
            $this->insertDB($connection, 'post', array('parent_id'=>11, 'type'=>$page, 'url' => $arrBanner['vn'], 'url_en' => $arrBanner['en']));
        }
        else {
            $this->updateDB($connection, 'post', array('url' => $arrBanner['vn'], 'url_en' => $arrBanner['en']), array('parent_id'=>11, 'type'=>$page));
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
}
