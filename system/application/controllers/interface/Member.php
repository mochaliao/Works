<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        // 讀取語系檔
        $this->lang->load('front', LANG);
    }
    
    // 發送驗證碼
    public function send_chkcode(){
        $this->load->helper('string');
        $this->load->library('email');
        
        $words = random_string('alnum', 4);
        
        $this->email->from($this->email->smtp_user . '@' . $this->email->smtp_host, SITE_NAME);
        $this->email->to($this->input->post('email'));
        $this->email->subject('[ ' . SITE_NAME . ' ] ' . $this->lang->line('member_register_chkcode'));
        $this->email->message(str_replace('__CHKCODE__', $words, $this->lang->line('member_register_chkcode_mailtext')));
        if($this->email->send()){
            $response = array(
                'success' => true,
                'message' => $this->lang->line('send_chkcode_success'),
                'chkcode' => $words
            );
        }else{
            $response = array(
                'success' => true,
                'message' => $this->lang->line('send_chkcode_failed'),
                'chkcode' => $words
            );
        }
        echo json_encode($response);
    }
    
    // 取得介紹人
    public function get_member_by_pid(){
        $pid = $this->input->post('pid');
        $res = $this->member_md->get_member_by_pid($pid);
        echo json_encode( $res->result_array() );
    }
    
}

?>