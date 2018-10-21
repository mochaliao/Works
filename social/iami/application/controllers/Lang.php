<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('language_model');
    }

    //切換語系
    public function doSwitchLang($langID = '')
    {
        $langID = ($langID != '') ? $langID : 'english';
        $this->session->set_userdata('langID', $langID);
        //redirect($this->agent->referrer(), 'refresh');
        redirect($_SERVER['HTTP_REFERER']);
    }

    //取得所有語系
    public function getLanguage($langid = NULL)
    {
        $languages = $this->language_model->getLanguage()->result_array();

        echo json_encode($languages, JSON_UNESCAPED_UNICODE);
    }
}

