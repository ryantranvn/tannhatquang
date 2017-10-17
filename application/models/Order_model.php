<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends Base_model {

    public function __construct()
    {
        parent::__construct();
    }

    public function insert_order($session_cart, $arr_customer, $arr_address)
    {
        $this->db->trans_begin();

        // update customer
            $this->insert_db('customer', array('fullname'=>$arr_customer['fullname'], 'phone'=>$arr_customer['phone'], 'email'=>$arr_customer['email']));
            $customer_id = $this->db->insert_id();
        // update address
            foreach ($arr_address as $key => $address) {
                $this->insert_db('customer_address',
                    array('customer_id'=>$customer_id,
                        'province_id'=>$address['province_id'],
                        'district_id'=>$address['district_id'],
                        'address'=>$address['address'],
                        'status'=>$address['status']
                    )
                );
                if ($address['status'] == 0) { // delivery address
                    $address_id = $this->db->insert_id();
                }
            }
        // update order
            

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