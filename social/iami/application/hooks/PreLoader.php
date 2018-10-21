<?php

class PreLoader
{
    function initialize(){
        $ci =& get_instance();
        $ci->config->set_item('base_url', get_domain());
        $language_id = $ci->session->userdata('language_id');
        if(isset($_SERVER["HTTP_SET_LG"])){//api 设置语系用
            $language_id = $_SERVER["HTTP_SET_LG"];
            $language_id = in_array($language_id,["zh-TW","english","zh-CN"])?$language_id:"english";
            $ci->lang->load($GLOBALS['LangFiles'], $language_id);
            $ci->config->set_item('language',$language_id);
        }else if (!empty($language_id)){
            $ci->lang->load($GLOBALS['LangFiles'], $language_id);
            $ci->config->set_item('language', $language_id);
        }else{
            $language_id = get_browser_language();
            $ci->lang->load($GLOBALS['LangFiles'], $language_id);
            $ci->config->set_item('language', $language_id);
            $ci->session->set_userdata('language_id', $language_id);
        }
        //echo "=========".$ci->session->userdata('language_id')."==========<br>";
    }
}