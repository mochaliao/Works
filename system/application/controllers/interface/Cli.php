<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cli extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        if(!is_cli()){
            echo '只能透過 CLI 方式執行' . "\r\n";
            exit();
        }
    }
    
    // 直推計算
    public function link($member_id){
        $this->load->library('link');
        
        $this->link->set_param(array(
            'member_id' => $member_id
        ));
        print_r($this->link->response);
    }
    
    // 對碰計算
    public function block($member_id){
        $this->load->library('block');
        $this->block->set_param(array(
            'member_id' => $member_id
        ));
        print_r($this->block->response);
    }
    
}

?>