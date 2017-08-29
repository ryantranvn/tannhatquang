<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends Base_model {

	protected $connection;

    public function __construct()
    {
        parent::__construct();
    }

    public function insert_news($data)
    {
        $this->db->trans_begin();

        // insert post
            $sql_post = "INSERT INTO post (`category_id`, `type`, `status`, `created_datetime`, `created_by`) VALUES (?, ?, ?, ?, ?)";
            $this->db->query($sql_post, array($data['category_id'], 'news', $data['status'], $data['datetime'], $data['by']));
            $post_id = $this->db->insert_id();
        // insert news
			$sql_news = "INSERT INTO news (`post_id`,`title`, `url`, `description`, `order`) VALUES (?, ?, ?, ?, ?)";
			$this->db->query($sql_news, array($post_id, $data['title'], $data['url'], $data['description'], $data['order']));

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

    public function update_news($data)
    {
        $this->db->trans_begin();

        // update news
            $sql_news = "UPDATE news
                            SET `title`=?, `url`=?, `thumbnail`=?,
                                `description`=?, `order`=?, `detail`=?
                            WHERE `post_id` = ?
                            ";
            $this->db->query($sql_news, array($data['title'], $data['url'], $data['thumbnail'], $data['description'],$data['order'], $data['detail'], $data['id']));
        // update post
    		$sql_post = "UPDATE post
    					SET `category_id`=?, `status`=?, `modified_datetime`=?, `modified_by`=?
    					WHERE `id`= ?
    					";
    		$this->db->query($sql_post, array($data['category_id'], $data['status'], $data['datetime'], $data['by'], $data['id']));

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
