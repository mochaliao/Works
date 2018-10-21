<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        // 讀取語系檔
        $this->lang->load('back', LANG);
    }

    // 首頁
    public function index(){
        $this->load->model('order_md');
        $data = array(
            'certificate_need' => $this->member_md->get_member(null, null, null, null, null, null, null, 2)->num_rows(),
            'orders_need'      => $this->order_md->get_order(null, null, null, null, date('Y-m-d'), date('Y-m-d'), 0)->num_rows()
        );
        $this->load->view('admin/main', $data);
    }
    
    // 登入頁
    public function login(){
        $data = array(
            'form_error'   => false
        );
        $rules = array(
            array(
                'field' => 'account',
                'label' => 'lang:account',
                'rules' => 'required|min_length[5]|max_length[12]'
            ),
            array(
                'field' => 'pwd',
                'label' => 'lang:password',
                'rules' => 'required|min_length[6]|max_length[12]'
            ),
            array(
                'field' => 'captcha',
                'label' => 'lang:captcha',
                'rules' => 'required'
            ),
            array(
                'field' => 'chkcode',
                'label' => 'lang:chkcode',
                'rules' => 'required|matches[captcha]|exact_length[4]'
            )
        );
        $this->form_validation->set_rules($rules);
        if(!$this->form_validation->run()){
            $data['form_error'] = !empty(validation_errors()) ? validation_errors() : '';
            $this->load->view('admin/login', $data);
        }else{
            $res = $this->member_md->sys_get_member(null, $this->input->post('account'), $this->input->post('pwd'), '1');
            if($res->num_rows() > 0){ // 登入成功
                $data = $res->row_array();
                $_SESSION['admin']['logged'] = true;
                $this->comm->login_define($data);
            }else{ // 登入失敗
                $data['form_error'] = $this->lang->line('login_failed_message');
                $this->load->view('admin/login', $data);
            }
        }
    }
    
}

?>