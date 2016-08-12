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
        $arrBanner = $this->Base_model->getDB('db', 'post', array('url', 'url_en', 'type'), array('parent_id'=>11));
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
                if ($item['url'] != "") { array_push($bannerHome_1VN, $item['url']); }
                else if ($item['url_en'] !== "") { array_push($bannerHome_1EN, $item['url_en']); }
            } else if ($item['type'] == 'home_2') { 
                if ($item['url'] != "") { array_push($bannerHome_2VN, $item['url']); }
                else if ($item['url_en'] !== "") { array_push($bannerHome_2EN, $item['url_en']); }
            } else if ($item['type'] == 'service-introduction') { 
                $bannerServiceIntroductionVN = $item['url'];
                $bannerServiceIntroductionEN = $item['url_en'];
            } else if ($item['type'] == 'service-service') { 
                $bannerServiceServiceVN = $item['url'];
                $bannerServiceServiceEN = $item['url_en'];
            } else if ($item['type'] == 'service-certification') { 
                $bannerServiceCertificationVN = $item['url'];
                $bannerServiceCertificationEN = $item['url_en'];
            } else if ($item['type'] == 'booking') { 
                $bannerBookingVN = $item['url'];
                $bannerBookingEN = $item['url_en'];
            } else if ($item['type'] == 'gallery-beforeafter') { 
                $bannerGalleryBeforeafterVN = $item['url'];
                $bannerGalleryBeforeafterEN = $item['url_en'];
            } else if ($item['type'] == 'gallery-event') { 
                $bannerGalleryEventVN = $item['url'];
                $bannerGalleryEventEN = $item['url_en'];
            } else if ($item['type'] == 'news') { 
                $bannerNewsVN = $item['url'];
                $bannerNewsEN = $item['url_en'];
            } else if ($item['type'] == 'news-detail') { 
                $bannerNewsDetailVN = $item['url'];
                $bannerNewsDetailEN = $item['url_en'];
            } else if ($item['type'] == 'contact') { 
                $bannerContactVN = $item['url'];
                $bannerContactEN = $item['url_en'];
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
        // print_r("<pre>"); print_r($this->data['banner']); die();
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

                $arrBannerHome_1VN = json_decode($bannerHome_1VN[0]);
                $arrBannerHome_1EN = json_decode($bannerHome_1EN[0]);
                $arrBannerHome_2VN = json_decode($bannerHome_2VN[0]);
                $arrBannerHome_2EN = json_decode($bannerHome_2EN[0]);

                $arrBannerHome_1VN_del = json_decode($bannerHome_1VN_del[0]);
                $arrBannerHome_1EN_del = json_decode($bannerHome_1EN_del[0]);
                $arrBannerHome_2VN_del = json_decode($bannerHome_2VN_del[0]);
                $arrBannerHome_2EN_del = json_decode($bannerHome_2EN_del[0]);

                if ( $this->model->insertBannerHome('db', $page, $arrBannerHome_1VN, $arrBannerHome_1EN, $arrBannerHome_2VN, $arrBannerHome_2EN, $arrBannerHome_1VN_del, $arrBannerHome_1EN_del, $arrBannerHome_2VN_del, $arrBannerHome_2EN_del) === FALSE ) {
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
                        break;
                    case 'service-service':
                        $bannerVN = $this->input->post('serviceServiceVN', TRUE);
                        $bannerEN = $this->input->post('serviceServiceEN', TRUE);
                        break;
                    case 'service-certification':
                        $bannerVN = $this->input->post('serviceCertificationVN', TRUE);
                        $bannerEN = $this->input->post('serviceCertificationEN', TRUE);
                        break;
                    case 'booking':
                        $bannerVN = $this->input->post('bookingVN', TRUE);
                        $bannerEN = $this->input->post('bookingEN', TRUE);
                        break;
                    case 'gallery-beforeafter':
                        $bannerVN = $this->input->post('galleryBeforeVN', TRUE);
                        $bannerEN = $this->input->post('galleryBeforeEN', TRUE);
                        break;
                    case 'gallery-event':
                        $bannerVN = $this->input->post('galleryEventVN', TRUE);
                        $bannerEN = $this->input->post('galleryEventEN', TRUE);
                        break;
                    case 'news':
                        $bannerVN = $this->input->post('newsVN', TRUE);
                        $bannerEN = $this->input->post('newsEN', TRUE);
                        break;
                    case 'news-detail':
                        $bannerVN = $this->input->post('newsDetailVN', TRUE);
                        $bannerEN = $this->input->post('newsDetailEN', TRUE);
                        break;
                    case 'contact':
                        $bannerVN = $this->input->post('contactVN', TRUE);
                        $bannerEN = $this->input->post('contactEN', TRUE);
                        break;
                    default:
                        break;
                }
                $arrBanner = array('vn' => $bannerVN, 'en' => $bannerEN);
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