<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('language_model');
    }

    //切換語系且返回原頁面
    public function doSwitchLanguage($language_id = NULL)
    {
        $language_id = (isset($language_id) ? $language_id : 'english');
        $this->session->set_userdata('language_id', $language_id);
        $this->config->set_item('language', $language_id);
        redirect($this->agent->referrer(), 'refresh');
    }

    //取得語系
    public function getLanguage($language_id = NULL)
    {
        $languages = $this->language_model->getLanguage($language_id)->result_array();

        echo json_encode($languages, JSON_UNESCAPED_UNICODE);
    }
}