<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/backend/Root.php')) {
    require_once(APPPATH . 'controllers/backend/Root.php');
}

class Product_category extends Root {

    private $parent_id = '0';
    private $path = '0-1-';
    private $id = '1';
    private $name = 'Sản phẩm';

    public function __construct()
    {
        parent::__construct();

        $this->currentModule = $this->data['modules'][ucfirst($this->router->fetch_class())];
        $this->data['varJS']['currentModule'] = $this->currentModule;
        // load
        $this->load->model('Category_model');

        $this->data['activeModule'] = $this->currentModule['control_name'];
        $this->data['activeNav'] = $this->currentModule['control_name'];
        $this->data['breadcrumb'][0] = array('name'=>'Phân loại sản phẩm', 'url' => B_URL . $this->currentModule['url']);
        // block js and css
            // array_push($this->data['cssBlock'], '<link rel="stylesheet" type="text/css" href="'. ASSETS_URL . 'backend/css/category.min.css" />');
        	array_push($this->data['jsBlock'], '<script language="javascript" type="text/javascript" src="'. ASSETS_URL . 'backend/js/category.js"></script>');
            array_push($this->data['jsBlock'], '<script language="javascript" type="text/javascript" src="'. ASSETS_URL . 'backend/js/tree.js"></script>');
        // is sub
            $this->data['is_sub_category'] = 1;
    }
// index
    public function index()
    {
        // check not access
            $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 1);

        // breadcrumb
            $this->data['breadcrumb'][1] = array('name'=>'Danh sách', 'url' => B_URL . $this->currentModule['url']);

        // for tree
            $arrCategory = $this->Base_model->get_db('category', NULL, NULL, array('path'=>$this->path), array('path','order','name'), array('asc','asc','asc'));
            foreach ($arrCategory as $key => $category) {
                $indent = count(explode('-', $category['path']));
                $arrCategory[$key]['indent'] = $indent-1;
            }
            $this->data['categories'] = $arrCategory;

            $this->data['parent_id'] = 0;
            $this->data['selected_category_id'] = $this->id;
            $this->data['selected_category_name'] = $this->name;
        // create frm
        $this->data['frmTopButtons'] = frm(B_URL.'category/multi_delete', array('id' => "frmTopButtons"), FALSE);
        $this->data['frmCategory'] = frm('', array('id' => 'frmCategory'), TRUE);

        $this->template->load('backend/template', 'backend/category', $this->data);
    }
//  Ajax List
    public function ajax_list()
    {
        // get params
            $params = array(
                 'page'     => $_GET['page']
                ,'limit'    => $_GET['rows']
                ,'sidx'     => $_GET['sidx']
                ,'sord'     => $_GET['sord']
            );

            $sql = " SELECT
                         c1.id
                        , c1.name
                        , c1.url
                        , c1.desc
                        , c1.thumbnail
                        , c1.order
                        , c1.status
                        , c2.name AS parent
                    FROM category c1
                    LEFT JOIN category c2 ON c1.parent_id=c2.id
                ";
            if ( $params['sidx'] !== "parent") {
                $params['sidx'] = "c1." . $params['sidx'];
            }
            $where = "WHERE c1.path <> '".$this->path."' AND c1.path LIKE '%".$this->path."%'";
            if (isset($_GET['filters'])) {
                $params['filters'] = json_decode($_GET['filters']);
                if (count($params['filters']->rules)>0) {
                    foreach($params['filters']->rules as $rule) {
                        if ($where == "") {$where .= "WHERE"; } else { $where .= " AND"; }
                        $field = $rule->field;
                        $value = $this->db->escape_like_str($rule->data);
                        if ($field == "status") {
                            $where .= " c1.status='" . $value . "'";
                        }
                        else {
                            if ($field == "parent") {
                                $where .= " c2.name LIKE '%" . $value . "%'";
                            }
                            else {
                                $where .= " c1." . $field . " LIKE '%" . $value . "%'";
                            }
                        }
                    }
                }
            }
            $sql .= $where;

        // return json
            echo json_encode($this->Base_model->table_list_in_page($sql, $params));
    }
// Add
    public function add()
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 2);

        // breadcrumb
            $this->data['breadcrumb'][1] = array('name'=>'Thêm mới', 'url' => '');

        /*$arrCategory = $this->Base_model->get_db('category', NULL, NULL, array('path'=>$this->path), array('path','order','name'), array('asc','asc','asc'));
        foreach ($arrCategory as $key => $category) {
            $indent = count(explode('-', $category['path']));
            $arrCategory[$key]['indent'] = $indent-1;
        }
        $this->data['categories'] = $arrCategory;
        $this->data['selected_category_id'] = $this->id;
        $this->data['selected_category_name'] = $this->name;
        $this->data['parent_id'] = $this->parent_id;*/
        $this->data['categories'] = getMainCategory(1);

        // create form
            $this->data['frmCategory'] = frm('', array('id' => 'frmCategory'), FALSE);

        $this->template->load('backend/template', 'backend/category/form', $this->data);
    }
// Edit
    public function edit($id)
    {
        // check permission
        $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 3);

        $this->data['breadcrumb'][1] = array('name'=>'Edit', 'url' => '');

        // get list of category for tree
        $arrCategory = $this->Base_model->get_db('category', NULL, NULL, array('path'=>$this->path), array('path','order','name'), array('asc','asc','asc'));
        foreach ($arrCategory as $key => $category) {
            $indent = count(explode('-', $category['path']));
            $arrCategory[$key]['indent'] = $indent-1;
        }
        $this->data['categories'] = $arrCategory;

        // get edit category
        if ($id === FALSE || $id<3) {
            $this->session->set_userdata('invalid', "Data does not exist or this is default category.");
            redirect(B_URL . $this->currentModule['url']);
        }
        $arrEditCategory = $this->Base_model->get_db('category',NULL,array('id'=>$id));
        if ($arrEditCategory === FALSE || count($arrEditCategory) == 0) {
            $this->session->set_userdata('invalid', "Can not find category with this ID.");
            redirect(B_URL . $this->currentModule['url']);
        }
        $this->data['frmData'] = $arrEditCategory[0];

        /*
        $this->data['parent_id'] = $arrEditCategory[0]['parent_id'];
        $this->data['selected_category_id'] = $id;
        $this->data['selected_category_name'] = $arrEditCategory[0]['name'];*/
        $this->data['categories'] = getMainCategory(1);

        // create form
            $this->data['frmCategory'] = frm('', array('id' => 'frmCategory'), FALSE);

        $this->template->load('backend/template', 'backend/category/form', $this->data);
    }
}
