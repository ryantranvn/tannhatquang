<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_model extends CI_model {
    
	protected $connection;

    public function __construct()
    {
        parent::__construct();
    }

    function connect_to($connection)
    {
        if ($connection=="ge") {
            $this->db_ge = $this->load->database('ge', TRUE);
            $this->connection = $this->db_ge;
        }
    	if ($connection=="db_ref") {
            $this->db_ref = $this->load->database('ref', TRUE);
            $this->connection = $this->db_ref;
        }
        if ($connection=="db") {
             $this->db = $this->load->database('default', TRUE);
             $this->connection = $this->db;
        }
    }

// SELECT
    function getDB($connection, $table, $fields=NULL, $where=NULL, $like=NULL, $order=NULL, $by=NULL, $limit=NULL, $start=NULL, $group=NULL)
    {
    	// set connection
        $this->connect_to($connection);

        if ( isset($fields) && $fields != NULL ) {
            $fields_str = implode(",", $fields);
            $this->connection->select($fields_str);
        }
        else {
            $this->connection->select('*');
        }
        $this->$connection->from($table);

        if ( $where != NULL ) {
            $this->connection->where($where);
        }

        if ( $like != NULL ) {
            $this->connection->like($like);
        }

        if ( $order != NULL ) {
            if (is_array($order)) {
                for ($i=0; $i<count($order); $i++) {
                    $this->connection->order_by($order[$i], $by[$i]);
                }
            }
            else {
                $this->connection->order_by($order, $by);
            }
        }    
        
        if ( $limit != NULL ) {
            if ( $start != NULL ) {
                $this->connection->limit($limit, $start);
            }
            else {
                $this->connection->limit($limit);
            }
        }
        if ( $group != NULL ) {
            $this->connection->group_by($group);
        }
        
        $query = $this->connection->get();
        $result = $query->result_array();
        
        return $result;
    }

// INSERT
    function insertDB($connection, $table, $data)
    {
    	// set connection
        $this->connect_to($connection);

        $this->connection->insert($table, $data);
        if ( $this->connection->affected_rows() > 0 ) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
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

// UPDATE
    function updateDB($connection, $table, $data, $where=NULL)
    {
        // set connection
        $this->connect_to($connection);

        if ( $where != NULL ) {
            $this->connection->where($where);
        }
        $this->connection->update($table, $data);
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

// TOTAL ROWS IN TABLE
    /*
    function total_rows($connection, $table, $where=NULL, $like=NULL)
    {
        $this->connect_to($connection);
        $this->connection->select('*');
        $this->$connection->from($table);
        if ( $where !== NULL ) {
            $this->connection->where($where);
        }
        if ( $like !== NULL ) {
            $this->connection->like($like);
        }
        $query = $this->connection->get();
        $result = $query->num_rows();
        
        return $result;
    }
    */

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
}