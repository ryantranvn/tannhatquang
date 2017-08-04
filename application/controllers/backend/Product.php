<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/backend/Root.php')) {
    require_once(APPPATH . 'controllers/backend/Root.php');
}

class Product extends Root {

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
        	array_push($this->data['jsBlock'], '<script language="javascript" type="text/javascript" src="'. ASSETS_URL . 'backend/js/product.min.js"></script>');
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
        // $this->template->load('backend/template', 'backend/'.$this->currentModule['url'].'/list', $this->data);
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

            $sql = "SELECT *
                    FROM post p
                    LEFT JOIN category c ON c.id=p.category_id
                ";
            if ( $params['sidx'] !== "category") {
                $params['sidx'] = "c." . $params['sidx'];
            }
            $where = "WHERE c.status='active' AND p.type='products'";
            if (isset($_GET['filters'])) {
                $params['filters'] = json_decode($_GET['filters']);
                if (count($params['filters']->rules)>0) {
                    foreach($params['filters']->rules as $rule) {
                        if ($where == "") {$where .= "WHERE"; } else { $where .= " AND"; }
                        $field = $rule->field;
                        $value = $this->db->escape_like_str($rule->data);
                        if ($field == "status") {
                            $where .= " p.status='" . $value . "'";
                        }
                        else {
                            if ($field == "category") {
                                $where .= " c.name LIKE '%" . $value . "%'";
                            }
                            else {
                                $where .= " p." . $field . " LIKE '%" . $value . "%'";
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

        // get category list
            $arrCategory = $this->Base_model->get_db('category', NULL, NULL, array('path' => '0-2-'), array('path','name','order'), array('asc','asc','asc'));
            foreach ($arrCategory as $key => $category) {
                $indent = count(explode('-', $category['path']));
                $arrCategory[$key]['indent'] = $indent-1;
            }
            $this->data['categories'] = $arrCategory;

        // creare form
            $this->data['frmProduct'] = frm('', array('id' => 'frmProduct'), TRUE, array('action'=>'add'));

        $this->template->load('backend/template', 'backend/'.$this->currentModule['url'].'/add', $this->data);
    }

// Ajax Add category
    public function ajax_addCategory()
    {
        if (file_exists(APPPATH . 'api/ApiCategory.php')) {
            require_once(APPPATH . 'api/ApiCategory.php');
        }
        $apiCategory = new ApiCategory();

        $arrData  =array('name'=>$this->input->post('name',TRUE),
                         'url'=>$this->input->post('url',TRUE),
                         'parent_id'=>$this->input->post('parent_id',TRUE)
                        );
        print_r($arrData);
        // echo $apiCategory.addCategory($arrData);
    }
}
