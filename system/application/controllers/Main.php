<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        // 讀取語系檔
        $this->lang->load('front', LANG);
    }

    // 首頁
    public function index(){
        $this->load->view('main');
    }
    
    // 登入 & 註冊頁
    public function login($register = null){
        $data = array(
            'register'   => ( $register === null ? false : true ),
            'form_error' => false,
            'form_success' => $this->session->flashdata('form_success')
        );
        
        if(!$register){ // 登入 -------------------------------------------------------------------------------------------------------------------------------------------------
            $rules = array(
                array(
                    'field' => 'login_account',
                    'label' => 'lang:account',
                    'rules' => 'required|min_length[4]|max_length[12]'
                ),
                array(
                    'field' => 'login_pwd',
                    'label' => 'lang:password',
                    'rules' => 'required|min_length[6]|max_length[12]'
                ),
                array(
                    'field' => 'captcha',
                    'label' => 'lang:captcha',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'login_chkcode',
                    'label' => 'lang:chkcode',
                    'rules' => 'required|matches[captcha]|exact_length[4]'
                )
            );
            $this->form_validation->set_rules($rules);
            if(!$this->form_validation->run()){
                $data['form_error'] = !empty(validation_errors()) ? validation_errors() : '';
                $this->load->view('login', $data);
            }else{
                $res = $this->member_md->get_member(null, null, null, $this->input->post('login_account'), $this->input->post('login_pwd'), null, '1');
                if($res->num_rows() > 0){ // 登入成功
                    $data = $res->row_array();
                    $_SESSION['logged'] = true;
                    $this->comm->login_define($data);
                }else{ // 登入失敗
                    $data['form_error'] = $this->lang->line('login_failed_message');
                    $this->load->view('login', $data);
                }
            }
        }else{ // 註冊 -------------------------------------------------------------------------------------------------------------------------------------------------
            $rules = array(
                array(
                    'field' => 'email',
                    'label' => $this->lang->line('email'),
                    'rules' => array(
                        'required',
                        'valid_email',
                        array(
                            'chk_email',
                            function($email){
                                $res = $this->member_md->get_member(null, null, $email);
                                if($res->num_rows() === 0) return true;
                                $this->form_validation->set_message('chk_email', '{field} ' . $this->lang->line('used'));
                                return false;
                            }
                        )
                    )
                ),
                array(
                    'field' => 'account',
                    'label' => $this->lang->line('account'),
                    'rules' => array(
                        'required',
                        'min_length[4]',
                        'max_length[12]',
                        array(
                            'chk_account',
                            function($account){
                                $res = $this->member_md->get_member(null, null, null, $account);
                                if($res->num_rows() === 0) return true;
                                $this->form_validation->set_message('chk_account', '{field} ' . $this->lang->line('used'));
                                return false;
                            }
                        ),
                        array(
                            'chk_account_string',
                            function($account){
                                if(preg_match('/^[a-zA-Z][a-zA-Z0-9]{4,12}$/', $account)) return true;
                                $this->form_validation->set_message('chk_account_string', '{field} ' . $this->lang->line('account_plz'));
                                return false;
                            }
                        )
                    )
                ),
                array(
                    'field' => 'paccount',
                    'label' => $this->lang->line('paccount'),
                    'rules' => array(
                        'required',
                        'min_length[4]',
                        'max_length[12]',
                        array(
                            'chk_paccount',
                            function($account){
                                $res = $this->member_md->get_member(null, null, null, $account);
                                if($res->num_rows() === 1) return true;
                                $this->form_validation->set_message('chk_paccount', $this->lang->line('member_introducer_account_not_found'));
                                return false;
                            }
                        )
                    )
                ),
                array(
                    'field' => 'name',
                    'label' => 'lang:member_name',
                    'rules' => 'required|min_length[2]|max_length[40]'
                ),
                array(
                    'field' => 'chkcode1',
                    'label' => 'lang:chkcode',
                    'rules' => 'required|matches[chkcode2]|exact_length[4]'
                ),
                array(
                    'field' => 'chkcode2',
                    'label' => 'lang:chkcode_anser',
                    'rules' => 'required|exact_length[4]'
                ),
                array(
                    'field' => 'pwd',
                    'label' => 'lang:password',
                    'rules' => array(
                        'required',
                        'min_length[6]',
                        'max_length[12]',
                        'matches[re_pwd]',
                        array(
                            'chk_password',
                            function($password){
                                $chk = preg_match('/[0-9]/', $password);
                                $chk = !$chk ? $chk : preg_match('/[A-Z]/', $password);
                                $chk = !$chk ? $chk : preg_match('/[a-z]/', $password);
                                $chk = !$chk ? $chk : preg_match('/^[a-zA-Z0-9][a-zA-Z0-9]{6,12}$/', $password);
                                if($chk) return true;
                                $this->form_validation->set_message('chk_password', $this->lang->line('password_plz'));
                                return false;
                            }
                        )
                    )
                ),
                array(
                    'field' => 're_pwd',
                    'label' => 'lang:re_password',
                    'rules' => 'required|min_length[6]|max_length[12]'
                )
            );
            $this->form_validation->set_rules($rules);
            if(!$this->form_validation->run()){
                $data['form_error'] = !empty(validation_errors()) ? validation_errors() : '';
                $this->load->view('login', $data);
            }else{
                $parent = $this->member_md->get_member(null, null, null, $this->input->post('paccount'))->row_array();
                
                $ins = array(
                    'pid'            => $parent['id'],
                    'team_id'        => $parent['team_id'],
                    'name'           => $this->input->post('name'),
                    'email'          => $this->input->post('email'),
                    'account'        => $this->input->post('account'),
                    'pwd'            => $this->input->post('pwd'),
                    'status'         => 1,
                    'is_certified'   => 0
                );
                if($this->member_md->add_member($ins)){ // 新增成功
                    $this->session->set_flashdata('form_success', $this->lang->line('member_add_success_msg'));
                    redirect(base_url('main/login'));
                }else{ // 寫入失敗
                    $data['form_error'] = $this->lang->line('member_add_failed_msg');
                    $this->load->view('login', $data);
                }
            }
        }
    }
    
    // 首頁新聞
    public function news($file_name){
        $this->load->view('news/' . LANG . '/' . $file_name);
    }
    
    // 服務條款
    public function terms(){
        $this->load->view('terms/' . LANG . '/terms');
    }
    
}

?>