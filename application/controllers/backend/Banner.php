<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (file_exists(APPPATH . 'controllers/backend/Root.php')) {
    require_once(APPPATH . 'controllers/backend/Root.php');
}

class Banner extends Root {

	private $module = 'banner';
    private $idCategory = 11;

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
        $this->noAccess($this->data['permissionsMember'], $this->module, 2);

    // get banner
        $arrBanner = $this->Base_model->getDB('db', 'post', array('id' ,'url', 'url_en', 'desc', 'desc_en','type'), array('parent_id'=>11));
        $bannerHome_1VN = $bannerHome_1EN = $bannerHome_2VN = $bannerHome_2EN = array();
        $bannerServiceIntroductionVN = $bannerServiceIntroductionEN = "";
        $bannerServiceServiceVN = $bannerServiceServiceEN = "";
        $bannerServiceCertificationVN = $bannerServiceCertificationEN = "";
        $bannerBookingVN = $bannerBookingEN = "";
        $bannerGalleryBeforeafterVN = $bannerGalleryBeforeafterEN = "";
        $bannerGalleryEventVN = $bannerGalleryEventEN = "";
        $bannerNewsVN = $bannerNewsEN = "";
        $bannerNewsDetailVN = $bannerNewsDetailEN = "";
        $bannerContactVN = $bannerContactEN = "";
        foreach ($arrBanner as $item) {
            if ($item['type'] == 'home_1') {
                if ($item['url'] != "") { array_push($bannerHome_1VN, array('id'=>$item['id'], 'url' => $item['url'], 'desc' => $item['desc'])); }
                else if ($item['url_en'] !== "") { array_push($bannerHome_1EN, array('id'=>$item['id'], 'url' => $item['url_en'], 'desc' => $item['desc_en'])); }
            } else if ($item['type'] == 'home_2') { 
                if ($item['url'] != "") { array_push($bannerHome_2VN, array('id'=>$item['id'], 'url' => $item['url'], 'desc' => $item['desc'])); }
                else if ($item['url_en'] !== "") { array_push($bannerHome_2EN, array('id'=>$item['id'], 'url' => $item['url_en'], 'desc' => $item['desc_en'])); }
            } else if ($item['type'] == 'service-introduction') { 
                $bannerServiceIntroductionVN = array('id'=>$item['id'],'url'=>$item['url'], 'desc' => $item['desc']);
                $bannerServiceIntroductionEN = array('id'=>$item['id'],'url'=>$item['url_en'], 'desc' => $item['desc_en']);
            } else if ($item['type'] == 'service-service') { 
                $bannerServiceServiceVN = array('id'=>$item['id'],'url'=>$item['url'], 'desc' => $item['desc']);
                $bannerServiceServiceEN = array('id'=>$item['id'],'url'=>$item['url_en'], 'desc' => $item['desc_en']);
            } else if ($item['type'] == 'service-certification') { 
                $bannerServiceCertificationVN = array('id'=>$item['id'],'url'=>$item['url'], 'desc' => $item['desc']);
                $bannerServiceCertificationEN = array('id'=>$item['id'],'url'=>$item['url_en'], 'desc' => $item['desc_en']);
            } else if ($item['type'] == 'booking') { 
                $bannerBookingVN = array('id'=>$item['id'],'url'=>$item['url'], 'desc' => $item['desc']);
                $bannerBookingEN = array('id'=>$item['id'],'url'=>$item['url_en'], 'desc' => $item['desc_en']);
            } else if ($item['type'] == 'gallery-beforeafter') { 
                $bannerGalleryBeforeafterVN = array('id'=>$item['id'],'url'=>$item['url'], 'desc' => $item['desc']);
                $bannerGalleryBeforeafterEN = array('id'=>$item['id'],'url'=>$item['url_en'], 'desc' => $item['desc_en']);
            } else if ($item['type'] == 'gallery-event') { 
                $bannerGalleryEventVN = array('id'=>$item['id'],'url'=>$item['url'], 'desc' => $item['desc']);
                $bannerGalleryEventEN = array('id'=>$item['id'],'url'=>$item['url_en'], 'desc' => $item['desc_en']);
            } else if ($item['type'] == 'news') { 
                $bannerNewsVN = array('id'=>$item['id'],'url'=>$item['url'], 'desc' => $item['desc']);
                $bannerNewsEN = array('id'=>$item['id'],'url'=>$item['url_en'], 'desc' => $item['desc_en']);
            } else if ($item['type'] == 'news-detail') { 
                $bannerNewsDetailVN = array('id'=>$item['id'],'url'=>$item['url'], 'desc' => $item['desc']);
                $bannerNewsDetailEN = array('id'=>$item['id'],'url'=>$item['url_en'], 'desc' => $item['desc_en']);
            } else if ($item['type'] == 'contact') { 
                $bannerContactVN = array('id'=>$item['id'],'url'=>$item['url'], 'desc' => $item['desc']);
                $bannerContactEN = array('id'=>$item['id'],'url'=>$item['url_en'], 'desc' => $item['desc_en']);
            }
        }
        $this->data['banner'] = array('bannerHome_1VN' => $bannerHome_1VN,
                                      'bannerHome_1EN' => $bannerHome_1EN,
                                      'bannerHome_2VN' => $bannerHome_2VN,
                                      'bannerHome_2EN' => $bannerHome_2EN,
                                      'bannerServiceIntroductionVN' => $bannerServiceIntroductionVN,
                                      'bannerServiceIntroductionEN' => $bannerServiceIntroductionEN,
                                      'bannerServiceServiceVN' => $bannerServiceServiceVN,
                                      'bannerServiceServiceEN' => $bannerServiceServiceEN,
                                      'bannerServiceCertificationVN' => $bannerServiceCertificationVN,
                                      'bannerServiceCertificationEN' => $bannerServiceCertificationEN,
                                      'bannerBookingVN' => $bannerBookingVN,
                                      'bannerBookingEN' => $bannerBookingEN,
                                      'bannerGalleryBeforeafterVN' => $bannerGalleryBeforeafterVN,
                                      'bannerGalleryBeforeafterEN' => $bannerGalleryBeforeafterEN,
                                      'bannerGalleryEventVN' => $bannerGalleryEventVN,
                                      'bannerGalleryEventEN' => $bannerGalleryEventEN,
                                      'bannerNewsVN' => $bannerNewsVN,
                                      'bannerNewsEN' => $bannerNewsEN,
                                      'bannerNewsDetailVN' => $bannerNewsDetailVN,
                                      'bannerNewsDetailEN' => $bannerNewsDetailEN,
                                      'bannerContactVN' => $bannerContactVN,
                                      'bannerContactEN' => $bannerContactEN
                                );
        // print_r("<pre>"); print_r($this->data['banner']['bannerHome_1VN']); die();
    // create form
        $this->data['frmAdd'] = frm(B_URL.$this->module.'/submit', array('id' => 'frmAdd'), TRUE);

        $this->template->load('backend/template', 'backend/'.$this->module.'/banner', $this->data);
    }

// Submit
    public function submit()
    {
        // check permission
            $this->noAccess($this->data['permissionsMember'], $this->module, 2);  

            $page = $this->input->post('page',TRUE);
            if ($page=="home") {
                $bannerHome_1VN = $this->input->post('bannerHome_1VN',TRUE);
                $bannerHome_1EN = $this->input->post('bannerHome_1EN',TRUE);
                $bannerHome_2VN = $this->input->post('bannerHome_2VN',TRUE);
                $bannerHome_2EN = $this->input->post('bannerHome_2EN',TRUE);

                $bannerHome_1VN_del = $this->input->post('bannerHome_1VN_del',TRUE);
                $bannerHome_1EN_del = $this->input->post('bannerHome_1EN_del',TRUE);
                $bannerHome_2VN_del = $this->input->post('bannerHome_2VN_del',TRUE);
                $bannerHome_2EN_del = $this->input->post('bannerHome_2EN_del',TRUE);

                $bannerHome_1VN_id = $this->input->post('bannerHome_1VN_id',TRUE);
                $bannerHome_1VN_link = $this->input->post('bannerHome_1VN_link',TRUE);

                $bannerHome_1EN_id = $this->input->post('bannerHome_1EN_id',TRUE);
                $bannerHome_1EN_link = $this->input->post('bannerHome_1EN_link',TRUE);

                $bannerHome_2VN_id = $this->input->post('bannerHome_2VN_id',TRUE);
                $bannerHome_2VN_link = $this->input->post('bannerHome_2VN_link',TRUE);

                $bannerHome_2EN_id = $this->input->post('bannerHome_2EN_id',TRUE);
                $bannerHome_2EN_link = $this->input->post('bannerHome_2EN_link',TRUE);

                $arrBannerHome_1VN = json_decode($bannerHome_1VN[0]);
                $arrBannerHome_1EN = json_decode($bannerHome_1EN[0]);
                $arrBannerHome_2VN = json_decode($bannerHome_2VN[0]);
                $arrBannerHome_2EN = json_decode($bannerHome_2EN[0]);

                $arrBannerHome_1VN_del = json_decode($bannerHome_1VN_del[0]);
                $arrBannerHome_1EN_del = json_decode($bannerHome_1EN_del[0]);
                $arrBannerHome_2VN_del = json_decode($bannerHome_2VN_del[0]);
                $arrBannerHome_2EN_del = json_decode($bannerHome_2EN_del[0]);

                
                $insertLinkHome_1VN = $insertLinkHome_1EN = $insertLinkHome_2VN = $insertLinkHome_2EN = array();
                $updateLinkHome_1VN = $updateLinkHome_1EN = $updateLinkHome_2VN = $updateLinkHome_2EN = array();
                foreach ($bannerHome_1VN_link as $key => $item) {
                    if (isset($bannerHome_1VN_id[$key])) {
                        array_push($updateLinkHome_1VN, array('id'=>$bannerHome_1VN_id[$key], 'link'=> $bannerHome_1VN_link[$key]));
                    }
                    else {
                        array_push($insertLinkHome_1VN, array('link'=> $bannerHome_1VN_link[$key]));   
                    }
                }
                foreach ($bannerHome_1EN_link as $key => $item) {
                    if (isset($bannerHome_1EN_id[$key])) {
                        array_push($updateLinkHome_1EN, array('id'=>$bannerHome_1EN_id[$key], 'link'=> $bannerHome_1EN_link[$key]));
                    }
                    else {
                        array_push($insertLinkHome_1EN, array('link'=> $bannerHome_1EN_link[$key]));   
                    }
                }
                foreach ($bannerHome_2VN_link as $key => $item) {
                    if (isset($bannerHome_2VN_id[$key])) {
                        array_push($updateLinkHome_2VN, array('id'=>$bannerHome_2VN_id[$key], 'link'=> $bannerHome_2VN_link[$key]));
                    }
                    else {
                        array_push($insertLinkHome_2VN, array('link'=> $bannerHome_2VN_link[$key]));   
                    }
                }
                foreach ($bannerHome_2EN_link as $key => $item) {
                    if (isset($bannerHome_2EN_id[$key])) {
                        array_push($updateLinkHome_2EN, array('id'=>$bannerHome_2EN_id[$key], 'link'=> $bannerHome_2EN_link[$key]));
                    }
                    else {
                        array_push($insertLinkHome_2EN, array('link'=> $bannerHome_2EN_link[$key]));   
                    }
                }

                // print_r("<pre>");
                // print_r("bannerHome_1VN_id<br/>"); 
                // print_r($bannerHome_1VN_id);
                // print_r("bannerHome_1VN_link<br/>");
                // print_r($bannerHome_1VN_link);
                // print_r("arrBannerHome_1VN<br/>");
                // print_r($arrBannerHome_1VN);
                // print_r("arrBannerHome_1VN_del<br/>");
                // print_r($arrBannerHome_1VN_del);
                // print_r("insertLinkHome_1VN<br/>");
                // print_r($insertLinkHome_1VN);
                // print_r("updateLinkHome_1VN<br/>");
                // print_r($updateLinkHome_1VN);
                // die();

                if ( $this->model->insertBannerHome('db', $page, $arrBannerHome_1VN, $arrBannerHome_1EN, $arrBannerHome_2VN, $arrBannerHome_2EN, $arrBannerHome_1VN_del, $arrBannerHome_1EN_del, $arrBannerHome_2VN_del, $arrBannerHome_2EN_del, $insertLinkHome_1VN, $insertLinkHome_1EN, $insertLinkHome_2VN, $insertLinkHome_2EN, $updateLinkHome_1VN, $updateLinkHome_1EN, $updateLinkHome_2VN, $updateLinkHome_2EN) === FALSE ) {
                    $this->session->set_userdata('invalid', "Error insert new data.");
                    redirect($_SERVER['HTTP_REFERER']);
                }
                $this->session->set_userdata('valid', "Insert new data successful.");

                redirect(B_URL.$this->router->fetch_class());
            }
            else {
                switch ($page)
                {
                    case 'service-introduction':
                        $bannerVN = $this->input->post('serviceIntroductionVN', TRUE);
                        $bannerEN = $this->input->post('serviceIntroductionEN', TRUE);
                        // $id = $this->input->post('serviceIntroductionVN_id', TRUE);
                        $linkVN = $this->input->post('serviceIntroductionVN_link', TRUE);
                        $linkEN = $this->input->post('serviceIntroductionEN_link', TRUE);
                        break;
                    case 'service-service':
                        $bannerVN = $this->input->post('serviceServiceVN', TRUE);
                        $bannerEN = $this->input->post('serviceServiceEN', TRUE);
                        $linkVN = $this->input->post('serviceServiceVN_link', TRUE);
                        $linkEN = $this->input->post('serviceServiceEN_link', TRUE);
                        break;
                    case 'service-certification':
                        $bannerVN = $this->input->post('serviceCertificationVN', TRUE);
                        $bannerEN = $this->input->post('serviceCertificationEN', TRUE);
                        $linkVN = $this->input->post('serviceCertificationVN_link', TRUE);
                        $linkEN = $this->input->post('serviceCertificationEN_link', TRUE);
                        break;
                    case 'booking':
                        $bannerVN = $this->input->post('bookingVN', TRUE);
                        $bannerEN = $this->input->post('bookingEN', TRUE);
                        $linkVN = $this->input->post('bookingVN_link', TRUE);
                        $linkEN = $this->input->post('bookingEN_link', TRUE);
                        break;
                    case 'gallery-beforeafter':
                        $bannerVN = $this->input->post('galleryBeforeVN', TRUE);
                        $bannerEN = $this->input->post('galleryBeforeEN', TRUE);
                        $linkVN = $this->input->post('galleryBeforeVN_link', TRUE);
                        $linkEN = $this->input->post('galleryBeforeEN_link', TRUE);
                        break;
                    case 'gallery-event':
                        $bannerVN = $this->input->post('galleryEventVN', TRUE);
                        $bannerEN = $this->input->post('galleryEventEN', TRUE);
                        $linkVN = $this->input->post('galleryEventVN_link', TRUE);
                        $linkEN = $this->input->post('galleryEventEN_link', TRUE);
                        break;
                    case 'news':
                        $bannerVN = $this->input->post('newsVN', TRUE);
                        $bannerEN = $this->input->post('newsEN', TRUE);
                        $linkVN = $this->input->post('newsVN_link', TRUE);
                        $linkEN = $this->input->post('newsEN_link', TRUE);
                        break;
                    case 'news-detail':
                        $bannerVN = $this->input->post('newsDetailVN', TRUE);
                        $bannerEN = $this->input->post('newsDetailEN', TRUE);
                        $linkVN = $this->input->post('newsDetailVN_link', TRUE);
                        $linkEN = $this->input->post('newsDetailEN_link', TRUE);
                        break;
                    case 'contact':
                        $bannerVN = $this->input->post('contactVN', TRUE);
                        $bannerEN = $this->input->post('contactEN', TRUE);
                        $linkVN = $this->input->post('contactVN_link', TRUE);
                        $linkEN = $this->input->post('contactEN_link', TRUE);
                        break;
                    default:
                        break;
                }
                $arrBanner = array('vn' => $bannerVN, 'en' => $bannerEN, 'linkVN' => $linkVN, 'linkEN' => $linkEN);
                // print_r("<pre>"); print_r($arrBanner); die();
                if ( $this->model->insertBanner('db', $page, $arrBanner) === FALSE ) {
                $this->session->set_userdata('invalid', "Error insert new data.");
                redirect($_SERVER['HTTP_REFERER']);
            }
            $this->session->set_userdata('valid', "Insert new data successful.");

            redirect(B_URL.$this->router->fetch_class());
            }
    }
}