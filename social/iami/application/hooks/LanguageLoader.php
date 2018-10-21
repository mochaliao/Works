<?php

class LanguageLoader
{
    function initialize(){
        $ci =& get_instance();
        $language_id = $ci->session->userdata('language_id');
        if ($language_id){
            $ci->lang->load($GLOBALS['LangFiles'], $language_id);
            $ci->config->set_item('language', $language_id);
        }else{
            $language_id = get_browser_language();
            $ci->lang->load($GLOBALS['LangFiles'], $language_id);
            $ci->config->set_item('language', $language_id);
            $ci->session->set_userdata('language_id', $language_id);
        }
    }
}