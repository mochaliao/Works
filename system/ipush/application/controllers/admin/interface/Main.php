<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        // 讀取語系檔
        $this->lang->load('back', LANG);
    }
    
    // 登出
    public function logout(){
        $_SESSION['admin']['logged'] = false;
        $this->comm->login_define();
    }
    
    // 切換語系
    public function lang($lang){
        $_SESSION['lang'] = $lang;
    }
    
}

?>