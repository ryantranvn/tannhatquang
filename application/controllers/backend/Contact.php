<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/backend/Root.php')) {
    require_once(APPPATH . 'controllers/backend/Root.php');
}

class Contact extends Root {

	private $module = 'contact';
    private $idCategory = 2;

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
            $where = "";
        // get filter if have
            // $search = $_GET['_search'];
            $like = "";
            if (isset($_GET['filters'])) {
                $filters = $_GET['filters'];
                $filters = json_decode($filters);
                
                foreach($filters->rules as $rule) { // filter is active
                    $field = $rule->field;
                    $value = $rule->data;
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

// ajax_status
    public function ajax_status()
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->module, 3);
            
        $id = $this->input->post('id',TRUE);
        $value = $this->input->post('value',TRUE);

        if ( $this->Base_model->updateDB('db', 'user_contact', array('status' => $value), array('id' => $id)) === FALSE ) {
            echo "false";
        }
        else {
            echo "true";
        }
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
                    ->setCellValue('B1', 'ID')
                    ->setCellValue('C1', 'Email')
                    ->setCellValue('D1', 'Fullname')
                    ->setCellValue('E1', 'Phone')
                    ->setCellValue('F1', 'Address')
                    ->setCellValue('G1', 'Brand')
                    ->setCellValue('H1', 'Model')
                    ->setCellValue('I1', 'Date')
                    ->setCellValue('J1', 'Service')
                    ->setCellValue('K1', 'Title')
                    ->setCellValue('L1', 'Content')
                    ->setCellValue('M1', 'Pictures');
                    // ->setCellValue('N1', 'Created Datetime');
                    // ->setCellValue('O1', 'Album')
                    // ->setCellValue('P1', 'Video')
                    // ->setCellValue('Q1', 'Selfie')
                    // ->setCellValue('R1', 'Quiz')
                    // ->setCellValue('S1', 'Share Website')
                    // ->setCellValue('T1', 'Share Post')
                    // ->setCellValue('U1', 'Like')
                    // ->setCellValue('V1', 'Download App');

        // get data
        $data_list = $this->model->getExport('db');
        // print_r("<pre>"); print_r($data_list); die();
        $i = 2;
        if ($data_list!=FALSE) {
            foreach ($data_list as $key => $item) {
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$i, $i-1)
                            ->setCellValue('B'.$i, $item['id'])
                            ->setCellValue('C'.$i, $item['email'])
                            ->setCellValue('D'.$i, $item['fullname'])
                            ->setCellValueExplicit('E'.$i, $item['phone'],PHPExcel_Cell_DataType::TYPE_STRING)
                            ->setCellValue('F'.$i, $item['address'])
                            ->setCellValue('G'.$i, $item['brandcar'])
                            ->setCellValue('H'.$i, $item['modelcar'])
                            ->setCellValue('I'.$i, $item['date'])
                            ->setCellValue('J'.$i, $item['service'])
                            ->setCellValue('K'.$i, $item['title'])
                            ->setCellValue('L'.$i, $item['content'])
                            ->setCellValue('M'.$i, '');
                            // ->setCellValue('N'.$i, $item['created_datetime'])
                            // ->setCellValue('O'.$i, $item['album'])
                            // ->setCellValue('P'.$i, $item['video'])
                            // ->setCellValue('Q'.$i, $item['selfie'])
                            // ->setCellValue('R'.$i, $item['quiz_score'])
                            // ->setCellValue('S'.$i, $item['share_website'])
                            // ->setCellValue('T'.$i, $item['share_post'])
                            // ->setCellValue('U'.$i, $item['like'])
                            // ->setCellValue('V'.$i, $item['code']);
                /*
                if (isset($item['thumbnail']) && count($item['thumbnail'])>0) {
                    foreach ($item['thumbnail'] as $filename) {
                        if(file_exists('upload/user/booking/'.$filename)) {
                            $image = 'upload/user/booking/'.$filename;
                            $gdImage = imagecreatefromjpeg($image);
                            // $objDrawing->setPath('data/contest/selfie/thumbnail/'.$item['filename']);
                            $objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
                            // $objDrawing->setName('Sample image');
                            // $objDrawing->setDescription('Sample image');
                            $objDrawing->setImageResource($gdImage);
                            // $objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
                            // $objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
                            $objDrawing->setResizeProportional(true);
                            // $objDrawing->setWidthAndHeight(100,300);
                            // $objDrawing->setWidth(75);
                            $objDrawing->setHeight(100);
                            $objDrawing->setCoordinates('I'.$i);
                            $objDrawing->setWorksheet($objPHPExcel->getActiveSheet(0));
                        }
                        else {
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$i, '');
                        }
                        $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(100);
                    }
                }
                */
                if (isset($item['thumbnail']) && count($item['thumbnail'])>0) {
                    $images = "";
                    foreach ($item['thumbnail'] as $filename) {
                        if(file_exists('upload/user/booking/'.$filename)) {
                            $image = 'upload/user/booking/'.$filename;
                            $images .= F_URL.$image."\n";
                        }
                    }
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$i, $images);
                    $objPHPExcel->getActiveSheet()->getStyle('M'.$i)->getAlignment()->setWrapText(true);
                }
                $i++;
            }
        }
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(330);
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Contact List');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        
        
        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="body_and_paint_contacts.xls"');
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