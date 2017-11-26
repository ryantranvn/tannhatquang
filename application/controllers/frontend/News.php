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
        $this->load->library('pagination');
        $this->load->model('News_model');
        $this->load->model('Category_model');

        $this->params = $this->input->get();
        $this->segs = $this->uri->segment_array();
    }
// NEWS
    public function index()
    {
        $params = $this->params;

        if (count($params) == 0) {
            $this->news_detail();
        }
        else {
            $this->news_list();
        }
    }
// list
    private function news_list()
    {
        $params = $this->params;
        $segs = $this->segs;
        $category_url = '';
        if (isset($params['cat']) && $params['cat']=="tt" && count($segs)>0) {
            if (count($segs)>1) {
                $category_url = $segs[2];
            }
        }
        $search_val = "";
        if (isset($params['search']) && $params['search']!="") {
            $search_val = filter_var($params['search'], FILTER_SANITIZE_STRING);
            $this->data['search_val'] = $search_val;
        }
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
                        ,news.title
                        ,news.url
                        ,news.description
                        ,news.order
                        ,news.thumbnail
                    FROM post
                    INNER JOIN news ON news.post_id = post.id
            ";
        $where = " WHERE post.type = 'news' AND post.del_flg=0";
        $sql .= $where;
        $total = $this->Base_model->table_total_rows($sql);

        $config = config_paging($this->params, $total, 3);
        $offset = $config['per_page'] * $page - $config['per_page'];
        if ($offset <= 0) $offset=0;
        $sql .= " LIMIT ". $offset . ', ' . $config['per_page'];
        $this->data['arr_news'] = $this->Base_model->table_get_list($sql);
        $this->pagination->initialize($config);
        $this->data['paging'] =  $this->pagination->create_links();

        $this->template->load($this->gate.'/template', $this->gate.'/tintuc', $this->data);
    }
// detail
    private function news_detail()
    {
        $url = $this->uri->segment(2,0);
        $arr_news = $this->News_model->get_one($url);
        if ($arr_news == FALSE || count($arr_news)==0) {
            $this->template->load('frontend/template', 'frontend/maintain/page404', $this->data);
        }
        else {
            $this->data['news'] = $arr_news[0];
            // get related_news
            $related_news = $this->News_model->get_related($arr_news[0]['id'], $arr_news[0]['category_id']);
            $this->data['related_news'] = array();
            if ($related_news != FALSE && count($related_news)>0) {
                $this->data['related_news'] = $related_news;
            }
        }
        $this->template->load($this->gate.'/template', $this->gate.'/tintuc_chitiet', $this->data);
    }
}
