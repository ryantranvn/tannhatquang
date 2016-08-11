<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/backend/Root.php')) {
    require_once(APPPATH . 'controllers/backend/Root.php');
}

class Gallery extends Root {

	private $module = 'gallery';
    private $idCategory = 6;

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
            $this->data['frmTopButtons'] = frm(B_URL.$this->module.'/multi_delete', array('id' => "frmTopButtons"), FALSE);
            // $this->data['frmImport'] = frm(B_URL.$this->module.'/import_db', array('id' => "frmImport"), TRUE);

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
            $where = 'category.parent_id=6';
        // get filter if have
            // $search = $_GET['_search'];
            $like = array();
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
                    $like[$field] = $value;
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

        // return json 
            echo json_encode($arrJSON);
    }

// Add
    public function add()
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->module, 2);
        
            $this->data['breadcrumb'][1] = array('name'=>'Add', 'url' => B_URL . $this->router->fetch_method());

        // get news category list
            $this->data['arrGallery'] = $this->Base_model->getDB('db', 'category', NULL, array('parent_id' => $this->idCategory), NULL, array('id','order','name','name_en'), array('asc','asc','asc','asc'));
        // create form
            $this->data['frmAdd'] = frm(B_URL.$this->module.'/add_db', array('id' => 'frmAdd'), TRUE);

        $this->template->load('backend/template', 'backend/'.$this->module.'/add', $this->data);
    }
    public function add_db()
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->module, 2);    
        // valid form
            $this->form_validation->set_rules('title', 'Title VN', 'trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('carInformation', 'Car Information VN', 'trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('service', 'Service VN', 'trim|required|max_length[1000]|xss_clean');
            $this->form_validation->set_rules('titleEN', 'Title EN', 'trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('carInformationEN', 'Car Information EN', 'trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('serviceEN', 'Service EN', 'trim|required|max_length[1000]|xss_clean');
            $this->form_validation->set_message('required', '%s is not empty');
            $this->form_validation->set_message('max_length', '%s is over characters');
            if ( $this->form_validation->run() == FALSE) {
                if ( validation_errors() != "" ) {
                    $this->session->set_userdata('invalid', validation_errors());
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
        $category = $this->input->post('category',TRUE);
        $type = $this->input->post('type',TRUE);

        $inputGallery = $this->input->post('inputGallery',TRUE);

        if ($category == 9) { // before after
            $postAdd = array('title' => $this->input->post('carInformation', TRUE),
                             'title_en' => $this->input->post('carInformationEN', TRUE),
                             'desc' => $this->input->post('service', TRUE),
                             'desc_en' => $this->input->post('serviceEN', TRUE),
                             'parent_id' => $category,
                             'order' => $this->input->post('order', TRUE),
                             'status' => $this->input->post('status', TRUE),
                             'created_datetime' => date('Y-m-d H:i:s'),
                             'created_by' => $this->data['authMember']['username']
                            );
            $arrDetail = array('before' => $this->input->post('before', TRUE),
                                'after' => $this->input->post('after', TRUE)
                                );
        }
        else if ($category == 10) { // event
            if ($type=="album") {
                if (count($inputGallery[0])>0) {
                    $arrDetail = json_decode($inputGallery[0]);
                    $thumbnail = $arrDetail[0];
                }
            }
            else if ($type=="video") {
                $arrDetail = array($this->input->post('inputVideo', TRUE));

                // $video = $this->input->post('inputVideo', TRUE);
                // $cmd = "ffmpeg -i $video 2>&1";
                // $second = 1;
                // if (preg_match('/Duration: ((\d+):(\d+):(\d+))/s', `$cmd`, $time)) {
                //     $total = ($time[2] * 3600) + ($time[3] * 60) + $time[4];
                //     $second = rand(1, ($total - 1));
                // }
                // $image  = './upload/random_name.jpg';
                // $cmd = "ffmpeg -i $video -deinterlace -an -ss $second -t 00:00:01 -r 1 -y -vcodec mjpeg -f mjpeg $image 2>&1";
                // $do = `$cmd`;
                $thumbnail = "";
            }
            $postAdd = array('title' => $this->input->post('title', TRUE),
                             'title_en' => $this->input->post('titleEN', TRUE),
                             'parent_id' => $category,
                             'thumbnail' => $thumbnail,
                             'order' => $this->input->post('order', TRUE),
                             'status' => $this->input->post('status', TRUE),
                             'created_datetime' => date('Y-m-d H:i:s'),
                             'created_by' => $this->data['authMember']['username']
                            );
            
        }

        // insert database
            if ( $this->model->insertPost('db', $postAdd, $type, $arrDetail) === FALSE ) {
                $this->session->set_userdata('invalid', "Error insert new data.");
                redirect($_SERVER['HTTP_REFERER']);
            }
            $this->session->set_userdata('valid', "Insert new data successful.");

            redirect(B_URL.$this->router->fetch_class());
    }

// Delete
    public function delete($id)
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->module, 4);

        if ($id === FALSE) {
            $this->session->set_userdata('invalid', "Data does not exist.");
            redirect($_SERVER['HTTP_REFERER']);
        }
        if ($this->model->deleteGallery('db', array($id)) === FALSE) {
            $this->session->set_userdata('invalid', "Error delete data");
        }
        else {
            $this->session->set_userdata('valid', "Delete data successful.");
        }
        redirect(B_URL.$this->router->fetch_class());
    }    
}