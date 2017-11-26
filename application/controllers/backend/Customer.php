<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (file_exists(APPPATH . 'controllers/backend/Root.php')) {
    require_once(APPPATH . 'controllers/backend/Root.php');
}

class Customer extends Root {

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
                LEFT OUTER JOIN customer_address ON customer_address.customer_id = customer.id OR customer_address.customer_id IS NULL
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
        $where = " WHERE customer_address.status=1 OR customer_address.status IS NULL";
        if (isset($_GET['filters'])) {
            $params['filters'] = json_decode($_GET['filters']);
            if (count($params['filters']->rules)>0) {
                foreach($params['filters']->rules as $rule) {
                    if ($where == "") {$where .= "WHERE"; } else { $where .= " AND"; }
                    $field = $rule->field;
                    $value = $this->db->escape_like_str($rule->data);
                    if ($field == "status") {
                        $where .= " customer.status='" . $value . "'";
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

        // create form
        $this->data['frmCustomer'] = frm(B_URL .$this->currentModule['url'] . '/update_customer', array('id' => 'frmCustomer'), FALSE, array('customer_id'=>$customer_id));
        $this->data['frmCustomerAddress'] = frm(NULL, array('id' => 'frmCustomerAddress'), FALSE, array('customer_id'=>$customer_id));

        // get customer information
        $frmData = $this->Base_model->get_db('customer', NULL, array('id'=>$customer_id));
        if ($frmData == FALSE || count($frmData)==0) {
            $this->session->set_userdata('invalid', "Không tìm thấy dữ liệu.");
            redirect(B_URL . $this->currentModule['url']);
        }
        $this->data['frmData'] = $frmData[0];
        // get address list
        $this->data['addresses'] = $this->Base_model->get_address($customer_id);

        $this->data['provinces'] = loadProvinces();
        $this->data['order_status'] = load_order_status();

        $this->template->load('backend/template', 'backend/customer/form', $this->data);
    }
// update_customer
    public function update_customer()
    {
        $customer_id = $this->input->post('customer_id',TRUE);
        $fullname = $this->input->post('fullname',TRUE);
        $phone = $this->input->post('phone',TRUE);
        $email = $this->input->post('email',TRUE);
        $status = $this->input->post('status', TRUE);
        $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 3);
        // valid form
        $this->form_validation->set_rules('fullname', 'Họ tên', 'trim|required|max_length[256]|xss_clean');
        $this->form_validation->set_rules('phone', 'Điện thoại', 'trim|required|max_length[20]|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|xss_clean');
        $this->form_validation->set_message('required', '%s bắt buộc nhập');
        $this->form_validation->set_message('max_length', '%s tối đa 255 ký tự');
        $this->form_validation->set_message('valid_email', '%s không đúng định dạng');
        if ( $this->form_validation->run() == FALSE && validation_errors() != "") {
            $this->session->set_userdata('invalid', validation_errors());
        }
        else {
            // update phone
            if ($this->Base_model->update_db('customer',array('fullname'=>$fullname, 'phone'=>$phone, 'email'=>$email, 'status'=>$status), array('id'=>$customer_id))==FALSE) {
                $this->session->set_userdata('invalid', "Update data error.");
            }
            else {
                $this->session->set_userdata('valid', "Update data successful.");
            }
        }
        redirect(B_URL . $this->currentModule['url'] . '/edit/' . $customer_id);
    }
// update_customer_address
    public function update_customer_address()
    {
        $address_id = $this->input->post('address_id',TRUE);
        $customer_id = $this->input->post('customer_id',TRUE);
        $address = $this->input->post('address',TRUE);
        $province_id = $this->input->post('province_id',TRUE);
        $district_id = $this->input->post('district_id',TRUE);
        $msg = array();

        // check permission
        if ($address_id == NULL) { // add
            $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 2);
        }
        else {
            $this->noAccess($this->data['permissionsMember'], $this->currentModule['control_name'], 3);
        }

        // valid form
        $this->form_validation->set_rules('province_id', 'Tỉnh/Thành phố', 'trim|required|xss_clean');
        $this->form_validation->set_rules('district_id', 'Quận/Huyện', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address', 'Địa chỉ', 'trim|required|max_length[512]|xss_clean');
        $this->form_validation->set_message('required', '%s bắt buộc nhập');
        $this->form_validation->set_message('max_length', '%s tối đa 255 ký tự');
        if ( $this->form_validation->run() == FALSE && validation_errors() != "") {
            $msg['err'] = 1;
            $msg['msg'] = validation_errors();
        }
        else {
            if ($address_id == NULL) {
                if ( $this->Base_model->insert_db('customer_address', array('address'=>$address, 'province_id'=>$province_id, 'district_id'=>$district_id, 'customer_id'=>$customer_id)) === FALSE ) {
                    $msg['err'] = 1;
                    $msg['msg'] = 'Error update data.';
                }
                else {
                    $msg['err'] = 0;
                    $this->session->set_userdata('valid', "Update data successful.");
                }
            }
            else { // update db
                if ( $this->Base_model->update_db('customer_address', array('address'=>$address, 'province_id'=>$province_id, 'district_id'=>$district_id), array('id'=>$address_id)) === FALSE ) {
                    $msg['err'] = 1;
                    $msg['msg'] = 'Error update data.';
                }
                else {
                    $msg['err'] = 0;
                    $this->session->set_userdata('valid', "Update data successful.");
                }
            }
        }
        echo json_encode($msg);
    }
// delete_address
    public function delete_address($address_id)
    {
        if ($address_id == FALSE) {
            $this->session->set_userdata('invalid', "Không tìm thấy dữ liệu.");
        }
        else {
            $arr_address = $this->Base_model->get_db('customer_address',NULL,array('id'=>$address_id));
            if ($arr_address != FALSE && count($arr_address)>0) {
                $address = $arr_address[0];
            }
            $customer_id = $address['customer_id'];
            if ($this->Base_model->update_db('customer_address', array('del_flg'=>1), array('id'=>$address_id))==FALSE) {
                $this->session->set_userdata('invalid', "Lỗi xóa dữ liệu");
            }
            else {
                $this->session->set_userdata('valid', "Xóa dữ liệu thành công");
            }
        }

        redirect(B_URL . $this->currentModule['url'] . '/edit/' . $customer_id);
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
                        ,IF (o.customer_address_id IS NOT NULL, ca.address, ca.address=NULL) as address
                        ,ca.province_id
                        ,p.name AS province
                        ,ca.district_id
                        ,d.name AS district
                        ,ca.status as address_status
                        ,ca.customer_id
                    FROM `order` AS o
                    LEFT OUTER JOIN `customer_address` AS ca ON ca.id = o.customer_address_id OR o.customer_address_id IS NULL
                    LEFT OUTER JOIN `province` AS p ON p.id = ca.province_id AND o.customer_address_id IS NOT NULL
                    LEFT OUTER JOIN `district` AS d ON d.id = ca.district_id AND o.customer_address_id IS NOT NULL
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