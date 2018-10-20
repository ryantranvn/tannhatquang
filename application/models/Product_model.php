<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends Base_model {

    public function __construct()
    {
        parent::__construct();
    }

    public function insert_product($productData)
	{
		$this->db->trans_begin();
		// insert post
			$sql_post = "INSERT INTO post (`category_id`, `category_name`, `type`, `status`, `created_by`) VALUES (?, ?, ?, ?, ?)";
	        $this->db->query($sql_post, array($productData['category_id'], $productData['category_name'], 'product', $productData['status'], $productData['by']));
			$post_id = $this->db->insert_id();
		// insert product
			$sql_product = "INSERT INTO product (`post_id`, `code`, `name`, `url`, `description`, `manufacturer_id`, `manufacturer_url`, `unit`, `detail`, `quantity`, `price`, `price_sale`, `price_sale_percent`, `order`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$this->db->query($sql_product, array($post_id, $productData['code'], $productData['name'], $productData['url'], $productData['description'], $productData['manufacturer_id'], $productData['manufacturer_url'], $productData['unit'], $productData['detail'], $productData['quantity'], $productData['price'], $productData['price_sale'], $productData['price_sale_percent'], $productData['order']));
		// insert pictures
			$sql_picture = "INSERT INTO post_picture (`post_id`, `url`) VALUES (?, ?)";
			foreach ($productData['arrPicture'] as $picture) {
				$this->db->query($sql_picture, array($post_id, $picture));
			}
        // insert url_route
            $sql_url = "INSERT INTO url_route (`url`, `category_id`, `post_id`, `type`, `created_by`) VALUES (?, ?, ?, ?, ?)";
            $this->db->query($sql_url, array($productData['url'], $productData['category_id'], $post_id, 'product', $productData['by']));
            //$this->db->query($sql_url, array($productData['url'].'-'.$productData['code'].PREFIX_CODE_PRODUCT.$post_id, $productData['category_id'], $post_id, $productData['by']));

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
                    $this->db->query($sql, array($productData['post_id'], $url));
                }
            }
		// insert new pictures
            if (isset($arr_new) && count($arr_new)>0) {
                foreach ($arr_new as $url) {
                    $sql = "INSERT INTO post_picture (`post_id`, `url`) VALUES (?, ?)";
                    if ($url != "") {
                        $this->db->query($sql, array($productData['post_id'], $url));
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
            $this->db->query($sql_product, array($productData['code'], $productData['name'], $productData['url'], $productData['description'], $productData['manufacturer'], $productData['unit'], $productData['price'], $productData['price_sale'], $productData['price_sale_percent'], $productData['quantity'], $productData['order'], $productData['detail'], $productData['post_id']));

		// update post
            $sql_post = "UPDATE post
                        SET `category_id`=?, `status`=?, `updated_by`=?
                        WHERE `id`= ?
                        ";
            $this->db->query($sql_post, array($productData['category_id'], $productData['status'], $productData['by'], $productData['post_id']));
        // update url_route
            $route_url = $productData['url'].'-'.$productData['code'].PREFIX_CODE_PRODUCT.$productData['post_id'];
            $sql_url = "UPDATE url_route
                        SET `url`=?, `category_id`=?
                        WHERE `post_id`=?
                        ";
            $this->db->query($sql_url, array($route_url ,$productData['category_id'], $productData['post_id']));
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
			$by = $this->data['authMember']['username'];
            // get category id list
            $categories = $this->Base_model->get_db('category', array('id', 'name'));
            $arr_category_id = $arr_category_name = array();
            foreach ($categories as $category) {
                array_push($arr_category_id, $category['id']);
                array_push($arr_category_name, $category['name']);
            }
            $arr_conflict = array();
			foreach ($data as $row) {
                $category_id = $row['category_id'];
            // check existed of category_id
                $search_key = array_search($category_id, $arr_category_id);
                if ($search_key===FALSE) {
                    $row['conflict'] = 'no category';
                    array_push($arr_conflict, $row);
                }
                else {
                    // find code
                    $products = $this->get_db('product', array('id', 'post_id'), array('code' => $row['code']));
                    if ($products != FALSE && count($products) > 0) { // existed code => return
                        $row['conflict'] = 'code existed';
                        array_push($arr_conflict, $row);
                        /*
                        // update
                            $post_id = $products[0]['post_id'];
                        // update post
                            $sql_post = "UPDATE post SET `category_id`=?, `updated_by`=? WHERE `id`=?";
                            $this->db->query($sql_post, array($row['category_id'], $by, $post_id));
                        // update product
                            $sql_product = "UPDATE product SET `name`=?, `url`=?, `unit`=?, `quantity`=?, `price`=?, `manufacturer`=? WHERE `code`=?";
                            $this->db->query($sql_product, array($row['name'], $row['url'], $row['unit'], $row['quantity'], $row['price'], $row['manufacturer'], $row['code']));
                        // update route_url
                            $sql_url = "UPDATE url_route SET `url`=?, `category_id`=?, `updated_by`=? WHERE `post_id`=?";
                            $this->db->query($sql_url, array($row['url'].'-'.$row['code'].PREFIX_CODE_PRODUCT.$post_id, $row['category_id'], $by, $post_id));
                        */
                    } else { // insert new
                        // insert post
                        $sql_post = "INSERT INTO post (`category_id`, `category_name`,`type`, `created_by`) VALUES (?, ?, ?, ?)";
                        $this->db->query($sql_post, array($row['category_id'], $arr_category_name[$search_key],TYPE_POST_PRODUCT, $by));
                        $post_id = $this->db->insert_id();
                        // insert product
                        $sql_product = "INSERT INTO product (`post_id`, `code`, `name`, `url`, `unit`, `quantity`, `price`, `manufacturer`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                        $this->db->query($sql_product, array($post_id, $row['code'], $row['name'], $row['url'], $row['unit'], $row['quantity'], $row['price'], $row['manufacturer']));
                        // insert route_url
                        $sql_url = "INSERT INTO url_route (`url`, `category_id`, `post_id`, `created_by`) VALUES (?, ?, ?, ?)";
                        $this->db->query($sql_url, array($row['url'] . '-' . $row['code'] . PREFIX_CODE_PRODUCT . $post_id, $row['category_id'], $post_id, $by));
                    }
                }
			}

		if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return $arr_conflict;
        }
        else
        {
            $this->db->trans_commit();
            return $arr_conflict;
        }
	}

/*
 * get product
 * */
    public function get_one($url)
    {
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
                    ,manufacturer.name AS manufacturer
                    ,product.quantity
                    ,product.price
                    ,product.price_sale
                    ,product.price_sale_percent
                    ,product.order
                    ,product.detail
                FROM post
                INNER JOIN product ON product.post_id = post.id
                INNER JOIN manufacturer ON manufacturer.id = product.manufacturer_id
            ";
        $where = " WHERE post.type = 'product' AND post.del_flg=0 AND url='".$url."'";
        $sql .= $where;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    public function get_related($post_id, $category_id)
    {
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
                    ,manufacturer.name AS manufacturer
                    ,product.quantity
                    ,product.price
                    ,product.price_sale
                    ,product.price_sale_percent
                    ,product.order
                    ,product.detail
                    , (SELECT url FROM post_picture WHERE post_id=post.id LIMIT 1) as thumbnail
                FROM post
                INNER JOIN product ON product.post_id = post.id
                INNER JOIN manufacturer ON manufacturer.id = product.manufacturer_id
            ";
        $where = " WHERE post.type = 'product' AND post.del_flg=0 AND post.category_id='".$category_id."' AND post.id<>'".$post_id."'";
        $sql .= $where;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    public function get_hot_product($number=5)
    {
        $sql = "SELECT
                        post.id
                        ,post.category_id
                        ,post.category_name
                        ,product.code
                        ,product.name
                        ,product.url
                        ,product.description
                        ,manufacturer.name AS manufacturer
                        ,product.price
                        ,product.price_sale
                        ,product.price_sale_percent
                        ,product.order
                        , (SELECT url FROM post_picture WHERE post_id=post.id LIMIT 1) as thumbnail
                    FROM post
                    INNER JOIN product ON product.post_id = post.id
                    INNER JOIN category ON category.id = post.category_id
                    INNER JOIN manufacturer ON manufacturer.id = product.manufacturer_id
            ";
        $where = " WHERE post.type = 'product' AND post.del_flg=0 AND post.hot_flg=1";
        $sql .= $where;
        $sql .= " ORDER BY post.updated_datetime DESC";
        $sql .= " LIMIT ".$number;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    public function get_sale_product($number=5)
    {
        $sql = "SELECT
                        post.id
                        ,post.category_id
                        ,post.category_name
                        ,product.code
                        ,product.name
                        ,product.url
                        ,product.description
                        ,manufacturer.name AS manufacturer
                        ,product.price
                        ,product.price_sale
                        ,product.price_sale_percent
                        ,product.order
                        , (SELECT url FROM post_picture WHERE post_id=post.id LIMIT 1) as thumbnail
                    FROM post
                    INNER JOIN product ON product.post_id = post.id
                    INNER JOIN category ON category.id = post.category_id
                    INNER JOIN manufacturer ON manufacturer.id = product.manufacturer_id
            ";
        $where = " WHERE post.type = 'product' AND post.del_flg=0 AND product.price_sale>0";
        $sql .= $where;
        $sql .= " ORDER BY post.updated_datetime DESC";
        $sql .= " LIMIT ".$number;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
}
