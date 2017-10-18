<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends Base_model {

    public function __construct()
    {
        parent::__construct();
    }

    public function insert_order($session_cart, $arr_customer, $arr_address_main, $arr_address_delivery)
    {
        $this->db->trans_begin();

        // update customer
        $customers = $this->get_db('customer', NULL, 'phone='.$arr_customer['phone']);
        if ($customers != FALSE && count($customers)>0) {
            $customer = $customers[0];
            $customer_id = $customer['id'];
        }
        else {
            $this->insert_db('customer', array('fullname'=>$arr_customer['fullname'], 'phone'=>$arr_customer['phone'], 'email'=>$arr_customer['email']));
            $customer_id = $this->db->insert_id();
        }

        // update address
            if ($arr_address_main['address'] != "") {
                $this->insert_db('customer_address',
                    array('customer_id' => $customer_id,
                        'province_id'   => $arr_address_main['province_id'],
                        'district_id'   => $arr_address_main['district_id'],
                        'address'       => $arr_address_main['address'],
                        'status'        => $arr_address_main['status']
                    )
                );
                $address_id_delivery = $this->db->insert_id();
            }
            if (count($arr_address_delivery) > 0) {
                $this->insert_db('customer_address',
                    array('customer_id' => $customer_id,
                        'province_id'   => $arr_address_delivery['province_id'],
                        'district_id'   => $arr_address_delivery['district_id'],
                        'address'       => $arr_address_delivery['address'],
                        'status'        => $arr_address_delivery['status']
                    )
                );
                $address_id_delivery = $this->db->insert_id();
            }
            if (!isset($address_id_delivery)) {
                $address_id_delivery = NULL;
            }
        // update order
            $this->insert_db('order',
                array('customer_id'         => $customer_id,
                    'customer_address_id'   => $address_id_delivery,
                    'note'                  => $arr_customer['note'],
                    'total'                 => $session_cart['total']
                    )
            );
            $order_id = $this->db->insert_id();
        // update order detail
            foreach ($session_cart['list'] as $item) {
                $this->insert_db('order_detail',
                    array('order_id'            => $order_id,
                        'post_id'               => $item['info']['id'],
                        'quantity'              => $item['number_item'],
                        'price'                 => $item['info']['price'],
                        'price_sale'            => $item['info']['price_sale'],
                        'price_sale_percent'    => $item['info']['price_sale_percent'],
                        'sub_total'             => $item['sub_total']
                    )
                );
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