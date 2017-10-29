<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends Base_model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_customer($customer_id)
    {
        $sql = "SELECT
                        c.* 
                        ,ca.province_id
                        ,IF (ca.province_id IS NOT NULL, p.name, NULL) AS province
                        ,IF (ca.province_id IS NOT NULL, p.type, NULL) AS province_type
                        ,ca.district_id
                        ,IF (ca.district_id IS NOT NULL, d.name, NULL) AS district
                        ,IF (ca.district_id IS NOT NULL, d.type, NULL) AS district_type
                        ,ca.address
                    FROM `customer` AS c
                    INNER JOIN customer_address AS ca ON c.id = ca.customer_id OR ca.customer_id IS NULL
                    LEFT JOIN province AS p ON p.id = ca.province_id
                    LEFT JOIN district AS d ON d.id = ca.district_id 
            ";
        $where = " WHERE ca.del_flg = 0 AND ca.status = 1 AND c.del_flg = 0 AND c.id = ".$customer_id;
        $sql .= $where;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
}