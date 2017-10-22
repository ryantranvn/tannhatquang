<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (file_exists(APPPATH . 'controllers/backend/Root.php')) {
    require_once(APPPATH . 'controllers/backend/Root.php');
}

class Customer extends Root {

	private $module = 'user';

    public function __construct()
    {
        parent::__construct();

    // load
        $this->currentModule = $this->data['modules'][ucfirst($this->router->fetch_class())];
        $this->data['varJS']['currentModule'] = $this->currentModule;
        // load
        $this->load->model($this->currentModule['control_name'].'_model', 'model');
        $this->data['activeModule'] = $this->currentModule['control_name'];
        $this->data['activeNav'] = $this->currentModule['control_name'];
        $this->data['breadcrumb'][0] = array('name'=>"Customer", 'url' => B_URL . $this->currentModule['url']);
        // block js and css
        // array_push($this->data['cssBlock'], '<link rel="stylesheet" type="text/css" href="'. ASSETS_URL . 'backend/css/category.min.css" />');
        array_push($this->data['jsBlock'], '<script language="javascript" type="text/javascript" src="'. ASSETS_URL . 'backend/js/init_height.js"></script>');
        array_push($this->data['jsBlock'], '<script language="javascript" type="text/javascript" src="'. ASSETS_URL . 'backend/js/customer.js"></script>');
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
        //$this->data['frmImport'] = frm(B_URL.$this->currentModule['url'].'/import', array('id' => "frmImport"), TRUE);

        $this->template->load('backend/template', 'backend/customer', $this->data);
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
        $sql = "SELECT
                    customer.*
                    ,customer_address.address
                    ,province.name AS province
                    ,district.name AS district
                FROM customer
                LEFT OUTER JOIN customer_address ON customer_address.customer_id = customer.id
                LEFT OUTER JOIN province ON province.id = customer_address.province_id
                LEFT OUTER JOIN district ON district.id = customer_address.district_id
                ";
        if ( $params['sidx'] == "address") {
            $params['sidx'] = "customer_address." . $params['sidx'];
        }
        else if ( $params['sidx'] == "province") {
            $params['sidx'] = "province." . $params['sidx'];
        }
        else if ( $params['sidx'] == "district") {
            $params['sidx'] = "district." . $params['sidx'];
        }
        else {
            $params['sidx'] = "customer." . $params['sidx'];
        }
        $where = " WHERE customer_address.status=1";
        if (isset($_GET['filters'])) {
            $params['filters'] = json_decode($_GET['filters']);
            if (count($params['filters']->rules)>0) {
                foreach($params['filters']->rules as $rule) {
                    if ($where == "") {$where .= "WHERE"; } else { $where .= " AND"; }
                    $field = $rule->field;
                    $value = $this->db->escape_like_str($rule->data);
                    if ($field == "status") {
                        $where .= " post.status='" . $value . "'";
                    }
                    else {
                        if ($field == "address") {
                            $where .= " customer_address.address LIKE '%" . $value . "%'";
                        }
                        else if ($field == "province") {
                            $where .= " province.name LIKE '%" . $value . "%'";
                        }
                        else if ($field == "district") {
                            $where .= " district.name LIKE '%" . $value . "%'";
                        }
                        else {
                            $where .= " customer." . $field . " LIKE '%" . $value . "%'";
                        }
                    }
                }
            }
        }
        $sql .= $where;
        $list = $this->Base_model->table_list_in_page($sql, $params);

        // return json
        echo json_encode($list);
    }

// Ajax_status
    public function ajax_status()
    {
        // check permission
        $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 3);
        // get data
        $id = $this->input->post('id',TRUE);
        $value = $this->input->post('value',TRUE);
        // update
        if ($this->Base_model->update_db('customer', array('status'=>$value), array('id' => $id)) === FALSE) {
            echo "false";
        }
        else {
            echo "true";
        }
    }
// edit
    public function edit($customer_id)
    {
        // check permission
        $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 3);
        // breadcrumb
        $this->data['breadcrumb'][1] = array('name'=>'Edit', 'url' => '');

        // creare form
        $this->data['frmCustomer'] = frm(NULL, array('id' => 'frmCustomer'), FALSE, array('customer_id'=>$customer_id));

        // get customer information
        $frmData = $this->Base_model->get_db('customer', NULL, array('id'=>$customer_id));
        if ($frmData == FALSE || count($frmData)==0) {
            $this->session->set_userdata('invalid', "Không tìm thấy dữ liệu.");
            redirect(B_URL . $this->currentModule['url']);
        }
        $this->data['frmData'] = $frmData[0];
        // get address list
        $this->data['addresses'] = $this->Base_model->get_addresses($customer_id);

        $this->template->load('backend/template', 'backend/customer/form', $this->data);
    }
//  Ajax List
    public function ajax_order_list()
    {
        // get params
        $params = array(
            'customer_id'     => $_GET['customer_id']
            ,'page'     => $_GET['page']
            ,'limit'    => $_GET['rows']
            ,'sidx'     => $_GET['sidx']
            ,'sord'     => $_GET['sord']
        );
        $sql = "SELECT  o.id
                        ,o.customer_id
                        ,o.customer_address_id
                        ,o.note
                        ,o.total
                        ,o.status
                        ,o.created_datetime
                        ,ca.address
                        ,ca.province_id
                        ,p.name AS province
                        ,ca.district_id
                        ,d.name AS district
                        ,ca.status as address_status
                        ,ca.customer_id
                    FROM `order` AS o
                    LEFT JOIN `customer_address` AS ca ON ca.id = o.customer_address_id
                    INNER JOIN `province` AS p ON p.id = ca.province_id
                    INNER JOIN `district` AS d ON d.id = ca.district_id
            ";

        if ( $params['sidx'] == "address") {
            $params['sidx'] = "ca." . $params['sidx'];
        }
        else if ( $params['sidx'] == "province") {
            $params['sidx'] = "p.name";
        }
        else if ( $params['sidx'] == "district") {
            $params['sidx'] = "d.name";
        }
        else {
            $params['sidx'] = "o." . $params['sidx'];
        }

        $where = " WHERE ca.del_flg = 0 AND o.del_flg = 0 AND o.customer_id = ".$params['customer_id'];
        if (isset($_GET['filters'])) {
            $params['filters'] = json_decode($_GET['filters']);
            if (count($params['filters']->rules)>0) {
                foreach($params['filters']->rules as $rule) {
                    if ($where == "") {$where .= "WHERE"; } else { $where .= " AND"; }
                    $field = $rule->field;
                    $value = $this->db->escape_like_str($rule->data);
                    if ($field == "status") {
                        $where .= " post.status='" . $value . "'";
                    }
                    else {
                        if ($field == "address") {
                            $where .= " customer_address.address LIKE '%" . $value . "%'";
                        }
                        else if ($field == "province") {
                            $where .= " province.name LIKE '%" . $value . "%'";
                        }
                        else if ($field == "district") {
                            $where .= " district.name LIKE '%" . $value . "%'";
                        }
                        else {
                            $where .= " customer." . $field . " LIKE '%" . $value . "%'";
                        }
                    }
                }
            }
        }
        $sql .= $where;
        $list = $this->Base_model->table_list_in_page($sql, $params);

        // return json
        echo json_encode($list);
    }

// Ajax Sub List
    public function ajax_sublist()
    {
        $arrJSON = array();
        $page = $_GET['page']; // get the requested page
        $limit = $_GET['rows']; // get how many rows we want to have into the grid
        $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
        $sord = $_GET['sord']; // get the direction
        if(!$sidx) $sidx=1;

        $idUser = $_GET['id'];
        // add where in string
            $where = "id_user=".$idUser;
        // get filter if have
            // $search = $_GET['_search'];
            $like = "";
            if (isset($_GET['filters'])) {
                $filters = $_GET['filters'];
                $filters = json_decode($filters);
                if (count($filters->rules)>0) {
                    foreach($filters->rules as $rule) { // filter is active
                        if ($rule->field != "") {
                            $field = $rule->field;
                            $value = $rule->data;
                            
                            $like .= $field." LIKE '%".$value."%'";
                        }
                    }
                }
            }
    // get total row => total page
        $count = $this->model->subTotal_Rows('db', $where, $like); 
        if( $count>0 ) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages) $page=$total_pages;
        $start = $limit*$page - $limit;
        if ($start <= 0) $start=0;
    // query database
        $list = $this->model->get_subList('db', $where, $like, $sidx, $sord, $start, $limit);
    // arrange result
        $arrJSON['sidx'] = $sidx;
        $arrJSON['page'] = $page;
        $arrJSON['total'] = $total_pages;
        $arrJSON['records'] = $count;
        $arrJSON['rows'] = $list;

        echo json_encode($arrJSON);
    }



// export DB
    public function export_db()
    {
        $objPHPExcel = new PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("VNS")
                                    ->setLastModifiedBy("VNS")
                                    ->setTitle("Office 2007 XLSX Document")
                                    ->setSubject("Office 2007 XLSX Document")
                                    ->setDescription("Document for Office 2007 XLSX, generated using PHP classes.")
                                    ->setKeywords("office 2007 openxml php")
                                    ->setCategory("Result file"); 
        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'STT')
                    ->setCellValue('B1', 'Email')
                    ->setCellValue('C1', 'Top Score')
                    ->setCellValue('D1', 'Time')
                    ->setCellValue('E1', 'Regist Datetime');
                    // ->setCellValue('F1', 'Address');
                    // ->setCellValue('G1', 'Brand')
                    // ->setCellValue('H1', 'Model')
                    // ->setCellValue('I1', 'Date')
                    // ->setCellValue('J1', 'Service')
                    // ->setCellValue('K1', 'Title')
                    // ->setCellValue('L1', 'Content')
                    // ->setCellValue('M1', 'Created Datetime')
                    // ->setCellValue('N1', 'Status');
                    // ->setCellValue('O1', 'Album')
                    // ->setCellValue('P1', 'Video')
                    // ->setCellValue('Q1', 'Selfie')
                    // ->setCellValue('R1', 'Quiz')
                    // ->setCellValue('S1', 'Share Website')
                    // ->setCellValue('T1', 'Share Post')
                    // ->setCellValue('U1', 'Like')
                    // ->setCellValue('V1', 'Download App');

        // get data
        // $data_list = $this->model->getExport('db');
        $data_list = $this->Base_model->getDB('db','user');
        // print_r("<pre>"); print_r($data_list); die();
        $i = 2;
        if ($data_list!=FALSE) {
            foreach ($data_list as $key => $item) {
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$i, $i-1)
                            ->setCellValue('B'.$i, $item['email'])
                            ->setCellValue('C'.$i, $item['score'])
                            ->setCellValue('D'.$i, $item['time'])
                            ->setCellValue('E'.$i, $item['created_datetime']);
                            // ->setCellValue('F'.$i, $item['address']);
                            // ->setCellValue('G'.$i, $item['brandcar'])
                            // ->setCellValue('H'.$i, $item['modelcar'])
                            // ->setCellValue('I'.$i, $item['date'])
                            // ->setCellValue('J'.$i, $item['service'])
                            // ->setCellValue('K'.$i, $item['title'])
                            // ->setCellValue('L'.$i, $item['content'])
                            // ->setCellValue('M'.$i, $item['created_datetime'])
                            // ->setCellValue('N'.$i, $item['status'] == "active" ? "contacted" : "");
                            // ->setCellValue('O'.$i, $item['album'])
                            // ->setCellValue('P'.$i, $item['video'])
                            // ->setCellValue('Q'.$i, $item['selfie'])
                            // ->setCellValue('R'.$i, $item['quiz_score'])
                            // ->setCellValue('S'.$i, $item['share_website'])
                            // ->setCellValue('T'.$i, $item['share_post'])
                            // ->setCellValue('U'.$i, $item['like'])
                            // ->setCellValue('V'.$i, $item['code']);

                $i++;
            }
        }
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('User List');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        
        $filename = "user_".time().".xls";
        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }


}