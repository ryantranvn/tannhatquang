<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/frontend/Root.php')) {
    require_once(APPPATH . 'controllers/frontend/Root.php');
}

class Home extends Root {

    public function __construct()
    {
        parent::__construct();

    }
// HOME
    public function index()
    {
        // $cssBlock = array('<link rel="stylesheet" type="text/css" href="'.assetsUrl('frontend','css','jquery.simplyscroll.css').'">');
        // $this->data['cssBlock'] = $cssBlock;

        // $jsBlock = array('<script language="javascript" type="text/javascript" src="'.ASSETS_URL.'frontend/js/compressed/sly.min.js"></script>');
    	// $this->data['jsBlock'] = $jsBlock;

        $this->data['active_nav'] = "home";
        $this->template->load($this->gate.'/template', $this->gate.'/home', $this->data);
    }

// gioithieu
    public function gioithieu()
    {
        $this->data['active_nav'] = "gioithieu";
        $this->template->load($this->gate.'/template', $this->gate.'/gioithieu', $this->data);
    }
// lienhe
    public function lienhe()
    {
        $this->data['active_nav'] = "lienhe";
        $this->template->load($this->gate.'/template', $this->gate.'/lienhe', $this->data);
    }
// banggia
    public function banggia()
    {
        $this->data['active_nav'] = "banggia";
        $this->template->load($this->gate.'/template', $this->gate.'/banggia', $this->data);
    }

// tintuc
    public function tintuc()
    {
        // $cssBlock = array('<link rel="stylesheet" type="text/css" href="'.libsUrl('jScrollPane','css','jquery.jscrollpane.css').'">');
        // $this->data['cssBlock'] = $cssBlock;
        //
        // $jsBlock[0] = '<script language="javascript" type="text/javascript" src="'.libsUrl('jScrollPane','js','jquery.jscrollpane.min.js').'"></script>';
        // $jsBlock[1] = '<script language="javascript" type="text/javascript" src="'.assetsUrl('common','js','jquery.mousewheel.min.js').'"></script>';
        // $this->data['jsBlock'] = $jsBlock;

        // get list
        // $arrTop = $this->Base_model->getDB('db','user', array('id','email','score','time'), array('status ='=>'active','id >'=>3), NULL, array('score','time','id'), array('desc','asc','asc'), 23);
        // $arrTopOut = array();
        // foreach ($arrTop as $item) {
        //     if ($item['score']>0) {
        //         array_push($arrTopOut, $item);
        //     }
        // }
        // $this->data['arrTop'] = $arrTopOut;


        $this->data['activeNav'] = "tintuc";
        $this->template->load($this->gate.'/template', $this->gate.'/tintuc', $this->data);
    }

// sanpham
    public function sanpham()
    {
        // $cssBlock = array('<link rel="stylesheet" type="text/css" href="'.libsUrl('jScrollPane','css','jquery.jscrollpane.css').'">');
        // $this->data['cssBlock'] = $cssBlock;
        //
        // $jsBlock[0] = '<script language="javascript" type="text/javascript" src="'.libsUrl('jScrollPane','js','jquery.jscrollpane.min.js').'"></script>';
        // $jsBlock[1] = '<script language="javascript" type="text/javascript" src="'.assetsUrl('common','js','jquery.mousewheel.min.js').'"></script>';
        // $this->data['jsBlock'] = $jsBlock;

        // get list
        // $arrTop = $this->Base_model->getDB('db','user', array('id','email','score','time'), array('status ='=>'active','id >'=>3), NULL, array('score','time','id'), array('desc','asc','asc'), 23);
        // $arrTopOut = array();
        // foreach ($arrTop as $item) {
        //     if ($item['score']>0) {
        //         array_push($arrTopOut, $item);
        //     }
        // }
        // $this->data['arrTop'] = $arrTopOut;


        $this->data['activeNav'] = "sanpham";
        $this->template->load($this->gate.'/template', $this->gate.'/sanpham', $this->data);
    }

// sanpham_chitiet
    public function sanpham_chitiet()
    {
        // $cssBlock = array('<link rel="stylesheet" type="text/css" href="'.libsUrl('jScrollPane','css','jquery.jscrollpane.css').'">');
        // $this->data['cssBlock'] = $cssBlock;
        //
        // $jsBlock[0] = '<script language="javascript" type="text/javascript" src="'.libsUrl('jScrollPane','js','jquery.jscrollpane.min.js').'"></script>';
        // $jsBlock[1] = '<script language="javascript" type="text/javascript" src="'.assetsUrl('common','js','jquery.mousewheel.min.js').'"></script>';
        // $this->data['jsBlock'] = $jsBlock;

        // get list
        // $arrTop = $this->Base_model->getDB('db','user', array('id','email','score','time'), array('status ='=>'active','id >'=>3), NULL, array('score','time','id'), array('desc','asc','asc'), 23);
        // $arrTopOut = array();
        // foreach ($arrTop as $item) {
        //     if ($item['score']>0) {
        //         array_push($arrTopOut, $item);
        //     }
        // }
        // $this->data['arrTop'] = $arrTopOut;


        $this->data['activeNav'] = "sanpham";
        $this->template->load($this->gate.'/template', $this->gate.'/sanpham_chitiet', $this->data);
    }

// giohang
    public function giohang()
    {
        $this->data['activeNav'] = "giohang";
        $this->template->load($this->gate.'/template', $this->gate.'/giohang', $this->data);
    }

}
