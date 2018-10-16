<?php

class Preloader{
    
    function init(){
        $ci =& get_instance();
        // 修正 CI 抓取的根網址
        $ci->config->set_item('base_url', HTTP_ROOT);
        // 切換當前系統語系
        $ci->config->set_item('language', LANG);
        // 設定要載入的資料庫設定檔
        $domain = str_replace('https://', '', str_replace('http://', '', HTTP_ROOT));
        if (explode('.', $domain)[0] === 'www' || explode('.', $domain)[0] === 'ipush'){
            $ci->db = $ci->load->database('production', TRUE);
        }elseif (explode('.', $domain)[0] === 'ipush-test'){
            $ci->db = $ci->load->database('test', TRUE);
        }else{
            $ci->db = $ci->load->database('develop', TRUE);
        }
    }
    
}

?>