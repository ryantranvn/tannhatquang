<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if (file_exists(APPPATH . 'libraries/Pusher.php')) {
    require_once(APPPATH . 'libraries/Pusher.php');
}

if (file_exists(APPPATH . 'controllers/frontend/Root.php')) {
    require_once(APPPATH . 'controllers/frontend/Root.php');
}

class Contest extends Root {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Contest_model');
    }
// Contest
    public function index()
    {   

        if ($this->session->userdata('serverFlag')==FALSE) {
            $this->session->set_userdata('serverFlag',time());
        }
        $this->data['activeNav'] = "cuocthi";

        $this->template->load($this->gate.'/template', $this->gate.'/pre_cuocthi', $this->data);
    }
// start
    public function start()
    {
        if ($this->is_authUser()==FALSE) {
            redirect(F_URL.'dang-nhap');
        }
        if ($this->session->userdata('serverFlag')==FALSE) {
            redirect(F_URL.'cuoc-thi');
        }
        $this->session->unset_userdata('serverFlag');
    // load js
        $jsBlock = array();
        $jsBlock[0] = '<script language="javascript" type="text/javascript" src="'.assetsUrl('frontend','js','jquery.countdown.min.js').'"></script>';
        $jsBlock[1] = '<script language="javascript" type="text/javascript" src="'.assetsUrl('frontend','js','jquery.playSound.js').'"></script>';
        $jsBlock[2] = '<script language="javascript" type="text/javascript" src="'.assetsUrl('frontend','js','jquery.serializejson.js').'"></script>';
        $jsBlock[3] = '<script language="javascript" type="text/javascript" src="'.assetsUrl('frontend','js','aes.js').'"></script>';
        $jsBlock[4] = '<script language="javascript" type="text/javascript" src="'.assetsUrl('frontend','js','aes-json-format.js').'"></script>';
        
        $this->data['jsBlock'] = $jsBlock;

    // create time session
        $this->session->set_userdata('serTime_start', time());

    // get data xml 
        // $arrQuestion = xml2Array(F_URL.'0e76a2fe84ac898b186cb28129b0c682dd078c8c.xml');
        // shuffle($arrQuestion);
        // $this->data['arrQuestion'] = $arrQuestion;
        // print_r("<pre>"); print_r($arrQuestion); die();
    // get data form db
        $arrQuestion = $this->Contest_model->getContest('db');
        shuffle($arrQuestion);
        $this->data['arrQuestion'] = $arrQuestion;
        // print_r("<pre>"); print_r($arrQuestion); die();
    // insert user data to start
        $idQuiz = $this->Contest_model->startContest('db', $this->data['authUser']['id']);

    // frm dangky
        $form_attr = array('name' => 'frmContest', 'id' => 'frmContest');
        $form_action = '';
        $this->data['frmContest'] = frm($form_action, $form_attr, FALSE,array('id_quiz'=>$idQuiz));

        $this->data['activeNav'] = "cuocthi";
        $this->template->load($this->gate.'/template', $this->gate.'/cuocthi', $this->data);
    }

// end
    public function end()
    {
        if ($this->is_authUser()==FALSE) {
            redirect(F_URL.'dang-nhap');
        }
        if ($this->session->userdata('serTime_start')==FALSE) {
            redirect(F_URL.'cuoc-thi');
        }
        $arrJSON = array();
        $serTime_start = $this->session->userdata('serTime_start');
        $this->session->unset_userdata('serTime_start');
        $serTime_end = time();
        $server_time = $serTime_end - $serTime_start;

        $client_time = $this->input->post('time',TRUE);
        $help1 = $this->input->post('help1',TRUE);
        $help2 = $this->input->post('help2',TRUE);
        $help3 = $this->input->post('help3',TRUE);
        $idQuiz = $this->input->post('id_quiz',TRUE);
        $answer = $this->input->post('answer',TRUE);
        $arrPost = explode("-", $answer);
        unset($arrPost[0]);

        $totalScore = 0;
        $arrData = array();
        foreach ($arrPost as $key => $post) {
        // score
            $score = substr($post, 0, 1);
            
        // get idQuestion & idOption
            $str = substr($post, 2);
            $arr_1 = explode("o", $str);
            $arrData[$key]['idQuestion'] = $arr_1[0];
            $arrData[$key]['idOption'] = $arr_1[1];
            switch ($arrData[$key]['idQuestion']) {
                case $help1:
                    $arrData[$key]['help'] = 1;
                    $arrData[$key]['score'] = $score;
                    break;
                case $help2:
                    $arrData[$key]['help'] = 2;
                    $arrData[$key]['score'] = $score*2;
                    break;
                case $help3:
                    $arrData[$key]['help'] = 3;
                    $arrData[$key]['score'] = $score*3;
                    break;
                default:
                    $arrData[$key]['help'] = 0;
                    $arrData[$key]['score'] = $score;
                    break;
            }
            $totalScore = $totalScore + $arrData[$key]['score'];
        }
    // update session
        if ($totalScore > $this->data['authUser']['score']) {
            $updateScore = TRUE;
            $this->data['authUser']['score'] = $totalScore;
            $this->session->unset_userdata('authUser');
            $this->session->set_userdata('authUser', $this->data['authUser']);
        }
        else {
            $updateScore = FALSE;
        }
    // update db
        if ($this->Contest_model->updateContest('db', $this->data['authUser']['id'], $idQuiz, $arrData, $totalScore, $server_time, $client_time, $updateScore)==FALSE) {
            $arrJSON['error'] = 1;
        }
        else {
            $arrJSON['error'] = 0;
            $arrJSON['totalScore'] = $totalScore;

            $this->messageThanggiai($totalScore);
        }
        
        echo json_encode($arrJSON);
    }

// push message
    private function messageThanggiai($score)
    {
        $options = array(
            'cluster' => 'ap1',
            'encrypted' => true
        );
        $pusher = new Pusher(PUSHER_KEY, PUSHER_SECRET, PUSHER_ID, $options);
        $pusher->trigger('thanggiai', 'notice', array('score'=>$score));
    }

    // public function test()
    // {
    //     $arr = array('1q24o96','1q85o339','1q1o4','1q185o740');
    //     print_r("<pre>"); print_r($arr);
    //     foreach ($arr as $post) {
    //         $score = substr($post, 0, 1);
    //         $totalScore = $totalScore + $score;
    //         $str = substr($post, 2);
    //         echo $str;
    //         echo "<br/>";
    //         $arr_1 = explode("o", $str);
    //         $idQuestion = $arr_1[0];
    //         $idOption = $arr_1[1];
    //     }
    //     // print_r("<pre>"); print_r($arr); die();
    // }
}