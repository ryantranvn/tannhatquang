<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_model extends CI_model {

    public function __construct()
    {
        parent::__construct();
    }

// for table list
    // TOTAL Rows
        public function table_total_rows($sql)
        {
            $query = $this->db->query($sql);
            $result = $query->result_array();

            return count($result);
        }
    // get list
        public function table_get_list($sql)
        {
            $query = $this->db->query($sql);
            $result = $query->result_array();

            return $result;
        }
    // datatable
        function table_list_in_page($sql, $params)
        {
            // json array
                $arrJSON = array();
            // get total row => total page
                $count = $this->table_total_rows($sql);
                if( $count>0 ) {
                    $total_pages = ceil($count/$params['limit']);
                } else {
                    $total_pages = 0;
                }
                if ($params['page'] > $total_pages) $params['page']=$total_pages;
                $start = $params['limit']*$params['page'] - $params['limit'];
                if ($start <= 0) $start=0;
            // query database
                $sql .= " ORDER BY " . $params['sidx'] . " " . $params['sord'];
                $sql .= " LIMIT " . $start . ", " . $params['limit'];
                $list = $this->table_get_list($sql);

            // arrange result
                $arrJSON['sidx'] = $params['sidx'];
                $arrJSON['page'] = $params['page'];
                $arrJSON['total'] = $total_pages;
                $arrJSON['records'] = $count;
                $arrJSON['rows'] = $list;

            return $arrJSON;
        }

// SELECT
    function get_db($table, $fields=NULL, $where=NULL, $like=NULL, $order=NULL, $by=NULL, $limit=NULL, $start=NULL, $group=NULL)
    {
        if ( isset($fields) && $fields != NULL ) {
            $fields_str = implode(",", $fields);
            $this->db->select($fields_str);
        }
        else {
            $this->db->select('*');
        }
        $this->db->from($table);

        if ( $where != NULL ) {
            $this->db->where($where);
        }

        if ( $like != NULL ) {
            $this->db->like($like);
        }

        if ( $order != NULL ) {
            if (is_array($order)) {
                for ($i=0; $i<count($order); $i++) {
                    $this->db->order_by($order[$i], $by[$i]);
                }
            }
            else {
                $this->db->order_by($order, $by);
            }
        }

        if ( $limit != NULL ) {
            if ( $start != NULL ) {
                $this->db->limit($limit, $start);
            }
            else {
                $this->db->limit($limit);
            }
        }
        if ( $group != NULL ) {
            $this->db->group_by($group);
        }

        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }
// UPDATE
    function update_db($table, $data, $where=NULL)
    {
        if ( $where != NULL ) {
            $this->db->where($where);
        }
        $this->db->update($table, $data);
        if ( $this->db->affected_rows() > 0 ) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
// INSERT
    function insert_db($table, $data)
    {
        $this->db->insert($table, $data);
        if ( $this->db->affected_rows() > 0 ) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
// DELETE
    function delete_db($table, $field_name, $list_value)
    {
        $this->db->where_in($field_name, $list_value);
        $this->db->delete($table);
        if ( $this->db->affected_rows() > 0 ) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
// GET POST
    function get_post($type, $id, $deleted=NULL)
    {
        if ($type=="product") {
            $sql = "SELECT
                        post.id
                        ,post.category_id
                        ,post.status
                        ,product.code
                        ,product.name
                        ,product.url
                        ,product.description
                        ,product.unit
                        ,product.manufacturer
                        ,product.quantity
                        ,product.stock_in_trade
                        ,product.price
                        ,product.price_sale
                        ,product.price_sale_percent
                        ,product.order
                        ,product.detail
                    FROM post
                    INNER JOIN product ON product.post_id = post.id
            ";
        }
        else if ($type=="news") {
            $sql = "SELECT
                        post.id
                        ,post.category_id
                        ,post.status
                        ,news.title
                        ,news.url
                        ,news.thumbnail
                        ,news.description
                        ,news.order
                        ,news.detail
                    FROM post
                    INNER JOIN news ON news.post_id = post.id
            ";
        }
        $where = " WHERE post.type = '".$type."' AND post.id = ".$id;
        if ($deleted !== NULl) {
            $where .= " AND deleted=".$deleted;
        }
        $sql .= $where;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
// INSERT POST
    function insert_post($arrPost)
    {
        $sql = "INSERT INTO post (`category_id`, `type`, `status`, `created_datetime`, `created_by`) VALUES (?, ?, ?, ?, ?)";
        $result = $this->db->query($sql, array($arrPost['category_id'], $arrPost['type'], $arrPost['status'], $arrPost['created_datetime'], $arrPost['created_by']));
        if ($result == FALSE) {
            return FALSE;
        }
        $id = $this->db->insert_id();
        return $id;
    }
// DELETE POST
    function delete_post($type, $id)
    {
        $this->db->trans_begin();

        if ($type=="product") {
        // delete product
            $sql_product = "DELETE FROM product WHERE `post_id`=?";
            $this->db->query($sql_product, array($id));
        }
        else if ($type=="news") {
        // delete news
            $sql_news = "DELETE FROM news WHERE `post_id`=?";
            $this->db->query($sql_news, array($id));
        }
        // delete picture
            $sql = "DELETE FROM post_picture WHERE `post_id`=?";
            $this->db->query($sql, array($id));

        // delete post
            $sql_post = "DELETE FROM post WHERE `id`=?";
            $this->db->query($sql_post, array($id));
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

    function insertDB_multi($connection, $table, $data)
    {
        // set connection
        $this->connect_to($connection);

        $this->connection->insert_batch($table, $data);
        if ( $this->connection->affected_rows() > 0 ) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }



// UPDATE INCREASE ONE FIELD
    function updateDB_Increase($connection, $table, $field, $increase, $whereStr="")
    {
        // set connection
        $this->connect_to($connection);
        $sql = "UPDATE $table SET $field=$field+$increase";
        if ( $whereStr != NULL ) {
            $sql .= ' '.$whereStr;
        }
        $this->connection->query($sql);
        //$this->connection->query($sql, array($table, $field, $field, $increase));
        if ($this->connection->affected_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

    function increase_Like($connection, $idContest)
    {

    }
    function increase_Share($connection, $type, $idContest)
    {
        // set connection
            if ($connection===NULL) {
                $connection = 'db';
            }
            $this->connect_to($connection);
            $this->connection->trans_begin();

            // get current share
            $shareArr = $this->Base_model->getDB($connection, $type, array('number_share'), array('id'=>$idContest));
            $number_share = $shareArr[0]['number_share'] + 1;
            $this->Base_model->updateDB($connection, $type, array('number_share' => $number_share), array('id'=>$idContest));

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
    function plusScore_Like($connection, $idUser)
    {
        // set connection
            if ($connection===NULL) {
                $connection = 'db';
            }
            $this->connect_to($connection);
            $this->connection->trans_begin();

            $increaseArr = $this->Base_model->getDB($connection, 'config', array('value'), array('type' => 'like'));
            if ($increaseArr != FALSE && count($increaseArr)>0) {
                $increaseValue = $increaseArr[0]['value'];
            }
            else {
                $increaseValue = 0;
            }
            // get current like
            $likeArr = $this->Base_model->getDB($connection, 'user_score', array('like'), array('id_user'=>$idUser));
            if ($likeArr == FALSE || count($likeArr)==0) {
                // insert new row
                $this->Base_model->insertDB($connection, 'user_score', array('id_user' => $idUser, 'like' => $increaseValue));
            }
            else {
                $number_like = $likeArr[0]['like'] + $increaseValue;
                $this->Base_model->updateDB($connection, 'user_score', array('like' => $number_like), array('id_user'=>$idUser));
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
    function plusScore_Share($connection, $idUser)
    {
        // set connection
            if ($connection===NULL) {
                $connection = 'db';
            }
            $this->connect_to($connection);
            $this->connection->trans_begin();

            $increaseArr = $this->Base_model->getDB($connection, 'config', array('value'), array('type' => 'share_post'));
            if ($increaseArr != FALSE && count($increaseArr)>0) {
                $increaseValue = $increaseArr[0]['value'];
            }
            else {
                $increaseValue = 0;
            }
            // get current like
            $shareArr = $this->Base_model->getDB($connection, 'user_score', array('share_post'), array('id_user'=>$idUser));
            if ($shareArr == FALSE || count($shareArr)==0) {
                // insert new row
                $this->Base_model->insertDB($connection, 'user_score', array('id_user' => $idUser, 'share_post' => $increaseValue));
            }
            else {
                $number_share = $shareArr[0]['share_post'] + $increaseValue;
                $this->Base_model->updateDB($connection, 'user_score', array('share_post' => $number_share), array('id_user'=>$idUser));
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
    function plusScore_ShareWebsite($connection, $idUser)
    {
        // set connection
            if ($connection===NULL) {
                $connection = 'db';
            }
            $this->connect_to($connection);
            $this->connection->trans_begin();

            $increaseArr = $this->Base_model->getDB($connection, 'config', array('value'), array('type' => 'share_website'));
            if ($increaseArr != FALSE && count($increaseArr)>0) {
                $increaseValue = $increaseArr[0]['value'];
            }
            else {
                $increaseValue = 0;
            }
            // check existed in user_score
            $shareArr = $this->Base_model->getDB($connection, 'user_score', array('share_website'), array('id_user'=>$idUser));
            if ($shareArr == FALSE || count($shareArr)==0) {
                // insert new row
                $this->Base_model->insertDB($connection, 'user_score', array('id_user' => $idUser, 'share_website' => $increaseValue));
            }
            else {
                $this->Base_model->updateDB($connection, 'user_score', array('share_website' => $increaseValue), array('id_user'=>$idUser));
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

// UPDATE SWITCH FIELD
    function update_switch($connection, $table, $field, $where)
    {
        // set connection
        $this->connect_to($connection);

        $arr = $this->getDB($connection,$table, array($field), $where);
        $item = $arr[0];
        $data = array();
        if ( $item[$field] == 0 ) {
            $data = array($field => 1);
        }
        else {
            $data = array($field => 0);
        }
        $this->connection->where($where);
        $this->connection->update($table, $data);
        if ( $this->connection->affected_rows() > 0 ) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

// UPDATE ACTVE
    function update_active($connection, $table, $where)
    {
        return $this->update_switch($connection, $table, 'active', $where);
    }

// UPDATE BLOCK
    function update_block($connection, $table, $where)
    {
        return $this->update_switch($connection, $table, 'block', $where);
    }

// DELETE
    function deleteDB($connection, $table, $field_name, $list_value)
    {
        // set connection
        $this->connect_to($connection);

        $this->connection->where_in($field_name, $list_value);
        $this->connection->delete($table);
        if ( $this->connection->affected_rows() > 0 ) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

// RUN QUERY BIND
    function queryBind($connection, $sql, $arr=NULL)
    {
        if ($arr!==NULL) {
            $query = $this->connection->query($sql, $arr);
        }
        else {
            $query = $this->connection->query($sql);
        }
        $result = $query->result_array();

        return $result;
    }

// OPTIMIZE TABLE
    function optimizeDB($connection, $table)
    {
        // set connection
        $this->connect_to($connection);
        $sql = "OPTIMIZE TABLE $table";
        $this->connection->query($sql);
    }
*/
}
