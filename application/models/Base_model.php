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
    function get_post($type, $id, $del_flg=0)
    {
        if ($type=="product") {
            $sql = "SELECT
                        post.id
                        ,post.category_id
                        ,post.category_name
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
                        , (SELECT url FROM post_picture WHERE post_id=post.id LIMIT 1) as thumbnail
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
        $where = " WHERE post.type = '".$type."' AND post.id = ".$id." AND post.del_flg=".$del_flg;
        $sql .= $where;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
// INSERT POST
    function insert_post($arrPost)
    {
        $sql = "INSERT INTO post (`category_id`, `category_name`, `type`, `status`, `created_datetime`, `created_by`) VALUES (?, ?, ?, ?, ?, ?)";
        $result = $this->db->query($sql, array($arrPost['category_id'], $arrPost['category_name'], $arrPost['type'], $arrPost['status'], $arrPost['created_datetime'], $arrPost['created_by']));
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
// GET ALL ONE FIELD IN TABLE
    function get_field($table, $field)
    {
        $arr_return = array();
        $categories = $this->get_db($table, array($field));
        foreach ($categories as $category) {
            array_push($arr_return, $category[$field]);
        }
        return $arr_return;
    }
// GET ADDRESS
    function get_addresses($customer_id)
    {
        $sql = "SELECT ca.address
                        ,ca.province_id
                        ,p.name AS province
                        ,ca.district_id
                        ,d.name AS district
                        ,ca.status
                        ,ca.customer_id
                    FROM customer_address AS ca
                    INNER JOIN province AS p ON p.id = ca.province_id
                    INNER JOIN district AS d ON d.id = ca.district_id
            ";
        $where = " WHERE ca.del_flg = 0 AND ca.customer_id = ".$customer_id;
        $sql .= $where;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }



/*
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
