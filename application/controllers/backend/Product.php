<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/backend/Root.php')) {
    require_once(APPPATH . 'controllers/backend/Root.php');
}

class Product extends Root {

	private $module = 'product';
    private $idCategory = 7;

    public function __construct()
    {
        parent::__construct();

    // load
        $this->load->model($this->module.'_model', 'model');

        $this->data['activeModule'] = $this->module;
        $this->data['activeNav'] = $this->module;
        $this->data['breadcrumb'][0] = array('name'=>ucfirst($this->module), 'url' => B_URL . $this->module);
    }

// index
    public function index()
    {
    // check not access
        $this->noAccess($this->data['permissionsMember'], $this->module, 1);

        $this->data['breadcrumb'][1] = array('name'=>'List', 'url' => B_URL . $this->router->fetch_method());

        // frm
            $this->data['frmTopButtons'] = frm(B_URL.$this->module.'/delete', array('id' => "frmTopButtons"), FALSE);
            // $this->data['frmImport'] = frm(B_URL.$this->module.'/import_db', array('id' => "frmImport"), TRUE);
            $this->data['frmAdd'] = frm(B_URL.$this->module.'/add_db', array('id' => 'frmAdd'), TRUE);

        $this->template->load('backend/template', 'backend/'.$this->module.'/list', $this->data);
    }

//  Ajax List
    public function ajax_list()
    {
        $arrJSON = array();
        $page = $_GET['page']; // get the requested page
        $limit = $_GET['rows']; // get how many rows we want to have into the grid
        $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
        $sord = $_GET['sord']; // get the direction
        if(!$sidx) $sidx=1;
        // add where in string
            $where = 'category.parent_id=2';
        // get filter if have
            // $search = $_GET['_search'];
            $like = "";
            if (isset($_GET['filters'])) {
                $filters = $_GET['filters'];
                $filters = json_decode($filters);

                foreach($filters->rules as $rule) { // filter is active
                    $field = $rule->field;
                    $value = $rule->data;
                    if ($field == "categoryName") {
                        $field = 'category.name';
                    }
                    else {
                        $field = 'post.'.$field;
                    }
                    $like .= $field." LIKE '%".$value."%'";
                }
            }

        // get total row => total page
            $count = $this->model->total_Rows('db', $where, $like);
            if( $count>0 ) {
                $total_pages = ceil($count/$limit);
            } else {
                $total_pages = 0;
            }
            if ($page > $total_pages) $page=$total_pages;
            $start = $limit*$page - $limit;
            if ($start <= 0) $start=0;
        // query database
            $list = $this->model->get_List('db', $where, $like, $sidx, $sord, $start, $limit);

        // arrange result
            $arrJSON['sidx'] = $sidx;
            $arrJSON['page'] = $page;
            $arrJSON['total'] = $total_pages;
            $arrJSON['records'] = $count;
            $arrJSON['rows'] = $list;


            // foreach ($list as $key => $item) {
            // }


        // return json
            echo json_encode($arrJSON);
    }

// Add
    public function add()
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->module, 2);

            $this->data['breadcrumb'][1] = array('name'=>'Add', 'url' => B_URL . $this->module .'/'. $this->router->fetch_method());

        // get category list
            $arrCategory = $this->Base_model->getDB('db', 'category', NULL, NULL, array('path'=>'0-2-'), array('path','order','name'), array('asc','asc','asc'));
            foreach ($arrCategory as $key => $category) {
                $indent = count(explode('-', $category['path']));
                $arrCategory[$key]['indent'] = $indent-1;
            }
            $this->data['categories'] = $arrCategory;

        // create form
            $this->data['frmAdd'] = frm(B_URL.$this->module.'/add_db', array('id' => 'frmAdd'), TRUE);
            $this->data['frmProductCategory'] = frm('', array('id' => 'frmProductCategory'), TRUE);

        $this->template->load('backend/template', 'backend/'.$this->module.'/add', $this->data);
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
