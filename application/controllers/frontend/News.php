<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/frontend/Root.php')) {
    require_once(APPPATH . 'controllers/frontend/Root.php');
}

class News extends Root {

    private $params = array();

    public function __construct()
    {
        parent::__construct();

    }
// NEWS
    public function index()
    {
        $this->params = $this->input->get();
        if (isset($params['page']) && $params['page']>1) {
            $page = $params['page'];
        }
        else {
            $page = 1;
        }

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
                        ,product.price
                        ,product.price_sale
                        ,product.price_sale_percent
                        ,product.order
                        ,product.detail
                        , (SELECT url FROM post_picture WHERE post_id=post.id LIMIT 1) as thumbnail
                    FROM post
                    INNER JOIN product ON product.post_id = post.id
                    INNER JOIN category ON category.id = post.category_id
            ";
        $where = " WHERE post.type = 'product' AND post.del_flg=0";
        $sql .= $where;
        $total = $this->Base_model->table_total_rows($sql);

        $config['base_url'] = paging_base_url($this->params);
        $config['first_url'] = paging_base_url($this->params) . '&page=1';
        $config['query_string_segment'] = 'page';
        $config['total_rows'] = $total;
        $config['per_page'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['num_links'] = 5;
        $config['first_link'] = "<<";
        $config['last_link'] = ">>";

        $offset = $config['per_page'] * $page - $config['per_page'];
        if ($offset <= 0) $offset=0;
        $sql .= " LIMIT ". $offset . ', ' . $config['per_page'];
        $this->data['products'] = $this->Base_model->table_get_list($sql);

        $this->pagination->initialize($config);
        $this->data['paging'] =  $this->pagination->create_links();

        $this->template->load($this->gate.'/template', $this->gate.'/tintuc', $this->data);
    }


}
