<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner_model extends Base_model {
    
	protected $connection;

    public function __construct()
    {
        parent::__construct();
    }
/*
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
*/
// insert
    function insertBannerHome($connection, $page, $arrBannerHome_1VN, $arrBannerHome_1EN, $arrBannerHome_2VN, $arrBannerHome_2EN, $arrBannerHome_1VN_del, $arrBannerHome_1EN_del, $arrBannerHome_2VN_del, $arrBannerHome_2EN_del, $insertLinkHome_1VN, $insertLinkHome_1EN, $insertLinkHome_2VN, $insertLinkHome_2EN, $updateLinkHome_1VN, $updateLinkHome_1EN, $updateLinkHome_2VN, $updateLinkHome_2EN, $mobile=NULL)
    {
        // set connection
        if ($connection===NULL) {
            $connection = 'db';
        }
        $this->connect_to($connection);

        $this->connection->trans_begin();

        // insert home
            if ($mobile===NULL) { $mobileText = ""; } else { $mobileText = "-mobile"; }
            if (isset($arrBannerHome_1VN) && count($arrBannerHome_1VN)>0) {
                foreach ($arrBannerHome_1VN as $key => $value) {
                    $this->insertDB($connection, 'post', array('parent_id'=>11, 'type'=>'home_1'.$mobileText, 'url' => $value, 'desc' => $insertLinkHome_1VN[$key]['link']));
                }
            }
            if (isset($arrBannerHome_1EN) && count($arrBannerHome_1EN)>0) {
                foreach ($arrBannerHome_1EN as $key => $value) {
                    $this->insertDB($connection, 'post', array('parent_id'=>11, 'type'=>'home_1'.$mobileText, 'url_en' => $value, 'desc_en' => $insertLinkHome_1EN[$key]['link']));
                }
            }
            if (isset($arrBannerHome_2VN) && count($arrBannerHome_2VN)>0) {
                foreach ($arrBannerHome_2VN as $key => $value) {
                    $this->insertDB($connection, 'post', array('parent_id'=>11, 'type'=>'home_2'.$mobileText, 'url' => $value, 'desc' => $insertLinkHome_2VN[$key]['link']));
                }
            }
            if (isset($arrBannerHome_2EN) && count($arrBannerHome_2EN)>0) {
                foreach ($arrBannerHome_2EN as $key => $value) {
                    $this->insertDB($connection, 'post', array('parent_id'=>11, 'type'=>'home_2'.$mobileText, 'url_en' => $value, 'desc_en' => $insertLinkHome_2EN[$key]['link']));
                }
            }
        // delete old
            if (isset($arrBannerHome_1VN_del) && count($arrBannerHome_1VN_del)>0) {
                $this->deleteDB($connection, 'post', 'id', $arrBannerHome_1VN_del);
            }
            if (isset($arrBannerHome_1EN_del) && count($arrBannerHome_1EN_del)>0) {
                $this->deleteDB($connection, 'post', 'id', $arrBannerHome_1EN_del);
            }
            if (isset($arrBannerHome_2VN_del) && count($arrBannerHome_2VN_del)>0) {
                $this->deleteDB($connection, 'post', 'id', $arrBannerHome_2VN_del);
            }
            if (isset($arrBannerHome_2EN_del) && count($arrBannerHome_2EN_del)>0) {
                $this->deleteDB($connection, 'post', 'id', $arrBannerHome_2EN_del);
            }
        // update link
            if (count($updateLinkHome_1VN)>0) {
                foreach ($updateLinkHome_1VN as $item) {
                    $this->updateDB($connection, 'post', array('desc'=>$item['link']), array('id'=>$item['id']));
                }
            }
            if (count($updateLinkHome_1EN)>0) {
                foreach ($updateLinkHome_1EN as $item) {
                    $this->updateDB($connection, 'post', array('desc_en'=>$item['link']), array('id'=>$item['id']));
                }
            }
            if (count($updateLinkHome_2VN)>0) {
                foreach ($updateLinkHome_2VN as $item) {
                    $this->updateDB($connection, 'post', array('desc'=>$item['link']), array('id'=>$item['id']));
                }
            }
            if (count($updateLinkHome_2EN)>0) {
                foreach ($updateLinkHome_2EN as $item) {
                    $this->updateDB($connection, 'post', array('desc_en'=>$item['link']), array('id'=>$item['id']));
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
            $this->insertDB($connection, 'post', array('parent_id'=>11, 'type'=>$page, 'url' => $arrBanner['vn'], 'url_en' => $arrBanner['en'], 'desc' => $arrBanner['linkVN'], 'desc_en' => $arrBanner['linkEN']));
        }
        else {
            $this->updateDB($connection, 'post', array('url' => $arrBanner['vn'], 'url_en' => $arrBanner['en'], 'desc' => $arrBanner['linkVN'], 'desc_en' => $arrBanner['linkEN']), array('parent_id'=>11, 'type'=>$page));
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
