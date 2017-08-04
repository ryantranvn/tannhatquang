<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/backend/Root.php')) {
    require_once(APPPATH . 'controllers/backend/Root.php');
}

class Product_category extends Root {

    public function __construct()
    {
        parent::__construct();

        $this->currentModule = $this->data['modules'][ucfirst($this->router->fetch_class())];
        $this->data['varJS']['currentModule'] = $this->currentModule;
        // load
        $this->load->model($this->currentModule['control_name'].'_model', 'model');

        $this->data['activeModule'] = $this->currentModule['control_name'];
        $this->data['activeNav'] = $this->currentModule['control_name'];
        $this->data['breadcrumb'][0] = array('name'=>$this->currentModule['control_name'], 'url' => B_URL . $this->currentModule['url']);
        // block js and css
            // array_push($this->data['cssBlock'], '<link rel="stylesheet" type="text/css" href="'. ASSETS_URL . 'backend/css/category.min.css" />');
        	array_push($this->data['jsBlock'], '<script language="javascript" type="text/javascript" src="'. ASSETS_URL . 'backend/js/category.min.js"></script>');
        // status array
            $this->data['statusArr'] = array(
                 'active' => '<button class="btn bg-color-green txt-color-white" data-value="active">Active</button>'
                ,'inactive' => '<button class="btn bg-color-blueDark txt-color-white" data-value="inactive">Inactive</button>'
                // ,'block' => '<button class="btn bg-color-red txt-color-white" data-value="block">Block</button>'
            );
    }
// index
    public function index()
    {
        // check not access
            $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 1);

        // breadcrumb
            $this->data['breadcrumb'][1] = array('name'=>'List', 'url' => B_URL . $this->currentModule['url']);

        // create frm
            $this->data['frmTopButtons'] = frm(B_URL.$this->currentModule['url'].'/multi_delete', array('id' => "frmTopButtons"), FALSE);
            // $this->data['frmImport'] = frm(B_URL.$this->currentModule['url'].'/import_db', array('id' => "frmImport"), TRUE);

        $this->template->load('backend/template', 'backend/list', $this->data);
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
            $where = "WHERE c1.path <> '0-2-' AND c1.path LIKE '%0-2-%'";
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
            $this->data['breadcrumb'][1] = array('name'=>'Add', 'url' => '');

        $arrCategory = $this->Base_model->get_db('category', NULL, NULL, array('path' => '0-2-'), array('path','order','name'), array('asc','asc','asc'));
        foreach ($arrCategory as $key => $category) {
            $indent = count(explode('-', $category['path']));
            $arrCategory[$key]['indent'] = $indent-1;
        }
        $this->data['categories'] = $arrCategory;
        $this->data['is_sub_category'] = 1;
        $this->data['default_parent_id'] = 2;

        // create form
            $this->data['frmCategory'] = frm('', array('id' => 'frmCategory'), TRUE, array('action'=>'add'));

        $this->template->load('backend/template', 'backend/category/add', $this->data);
    }
// Edit
    public function edit($id)
    {
        // check permission
        $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 3);

        $this->data['breadcrumb'][1] = array('name'=>'Edit', 'url' => '');

        // get list of category for tree
        $arrCategory = $this->Base_model->get_db('category', NULL, NULL, array('path' => '0-2-'), array('path','order','name'), array('asc','asc','asc'));
        foreach ($arrCategory as $key => $category) {
            $indent = count(explode('-', $category['path']));
            $arrCategory[$key]['indent'] = $indent-1;
        }
        $this->data['categories'] = $arrCategory;
        $this->data['is_sub_category'] = 1;
        $this->data['default_parent_id'] = 2;
        // get edit category
        if ($id === FALSE) {
            $this->session->set_userdata('invalid', "Data does not exist.");
            redirect($_SERVER['HTTP_REFERER']);
        }
        $arrEditCategory = $this->Base_model->get_db('category',NULL,array('id'=>$id));
        if ($arrEditCategory === FALSE || count($arrEditCategory) == 0) {
            $this->session->set_userdata('invalid', "Can not find category with this ID.");
            redirect($_SERVER['HTTP_REFERER']);
        }
        $this->data['frmData'] = $arrEditCategory[0];

        // create form
            $this->data['frmCategory'] = frm('', array('id' => 'frmCategory'), TRUE, array('action'=>'edit', 'id'=>$id));

        $this->template->load('backend/template', 'backend/category/edit', $this->data);
    }

}
