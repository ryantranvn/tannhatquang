<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends Base_model {

	protected $connection;

    public function __construct()
    {
        parent::__construct();
    }

    public function insert_product($productData)
	{
		$this->db->trans_begin();
		// insert post
			$sql_post = "INSERT INTO post (`category_id`, `type`, `status`, `created_datetime`, `created_by`) VALUES (?, ?, ?, ?, ?)";
	        $this->db->query($sql_post, array($productData['category_id'], 'product', $productData['status'], $productData['datetime'], $productData['by']));
			$post_id = $this->db->insert_id();
		// insert product
			$sql_product = "INSERT INTO product (`post_id`, `code`, `name`, `url`, `description`, `manufacturer`, `unit`, `detail`, `quantity`, `price`, `price_sale`, `price_sale_percent`, `order`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$this->db->query($sql_product, array($post_id, $productData['code'], $productData['name'], $productData['url'], $productData['description'], $productData['manufacturer'], $productData['unit'], $productData['detail'], $productData['quantity'], $productData['price'], $productData['price_sale'], $productData['price_sale_percent'], $productData['order']));

		// insert pictures
			$sql_picture = "INSERT INTO post_picture (`post_id`, `url`) VALUES (?, ?)";
			foreach ($productData['arrPicture'] as $picture) {
				$this->db->query($sql_picture, array($post_id, $picture));
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

	public function update_product($productData, $arr_del, $arr_new)
	{
		$this->db->trans_begin();

		// delete old pictures
		if (isset($arr_del) && count($arr_del)>0) {
			foreach ($arr_del as $url) {
				$sql = "DELETE FROM post_picture WHERE post_id = ? AND url = ?";
				$this->db->query($sql, array($productData['id'], $url));
			}
		}
		// insert new pictures
		if (isset($arr_new) && count($arr_new)>0) {
			foreach ($arr_new as $url) {
				$sql = "INSERT INTO post_picture (`post_id`, `url`) VALUES (?, ?)";
				if ($url != "") {
					$this->db->query($sql, array($productData['id'], $url));
				}
			}
		}
		// update product
		$sql_product = "UPDATE product
						SET `code`=?, `name`=?, `url`=?,
							`description`=?, `manufacturer`=?, `unit`=?,
							`price`=?, `price_sale`=?, `price_sale_percent`=?,
							`quantity`=?, `order`=?, `detail`=?
						WHERE `post_id` = ?
						";
		$this->db->query($sql_product, array($productData['code'], $productData['name'], $productData['url'], $productData['description'], $productData['manufacturer'], $productData['unit'], $productData['price'], $productData['price_sale'], $productData['price_sale_percent'], $productData['quantity'], $productData['order'], $productData['detail'], $productData['id']));

		// update post
		$sql_post = "UPDATE post
					SET `category_id`=?, `status`=?, `modified_datetime`=?, `modified_by`=?
					WHERE `id`= ?
					";
		$this->db->query($sql_post, array($productData['category_id'], $productData['status'], $productData['datetime'], $productData['by'], $productData['id']));

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

	public function import_db($data)
	{
		$this->db->trans_begin();
			$datetime = date('Y-m-d H:i:s');
			$by = $this->data['authMember']['username'];

			foreach ($data as $row) {
			// find code
				$products = $this->get_db('product', array('id','post_id'), array('code'=>$row['code']));
				if ($products != FALSE && count($products)>0) { // update
					$post_id = $products[0]['post_id'];
				// update post
					$sql_post = "UPDATE post SET `category_id`=?, `modified_datetime`=?, `modified_by`=? WHERE `id`=?";
					$this->db->query($sql_post, array($row['category_id'], $datetime, $by, $post_id));
				// update product
					$sql_product = "UPDATE product SET `name`=?, `url`=?, `unit`=?, `quantity`=?, `price`=?, `manufacturer`=? WHERE `code`=?";
					$this->db->query($sql_product, array($row['name'], $row['url'], $row['unit'], $row['quantity'], $row['price'], $row['manufacturer'], $row['code']));
				}
				else { // insert new
				// insert post
					$sql_post = "INSERT INTO post (`category_id`, `type`, `created_datetime`, `created_by`) VALUES (?, ?, ?, ?)";
			        $this->db->query($sql_post, array($row['category_id'], 'product', $datetime, $by));
					$post_id = $this->db->insert_id();
				// insert product
					$sql_product = "INSERT INTO product (`post_id`, `code`, `name`, `url`, `unit`, `quantity`, `price`, `manufacturer`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
					$this->db->query($sql_product, array($post_id, $row['code'], $row['name'], $row['url'], $row['unit'], $row['quantity'], $row['price'], $row['manufacturer']));
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
            return TRUE;
        }
	}



}
