<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        // 讀取語系檔
        $this->lang->load('back', LANG);
    }

    // 修改密碼頁
    public function upd_pwd(){
        $data = array(
            'form_error'   => false,
            'form_success' => $this->session->flashdata('form_success')
        );
        $rules = array(
            array(
                'field' => 'pwd',
                'label' => 'lang:member_old_pwd',
                'rules' => 'required|min_length[6]|max_length[12]'
            ),
            array(
                'field' => 'pwd_new',
                'label' => 'lang:member_new_pwd',
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
            $this->load->view('admin/upd_pwd', $data);
        }else{
            if($this->member_md->sys_upd_password($_SESSION['admin']['admin_id'], $this->input->post('pwd'), $this->input->post('pwd_new'))){
                $this->session->set_flashdata('form_success', $this->lang->line('member_upd_pwd_success'));
                redirect(current_url());
            }else{
                $data['form_error'] = $this->lang->line('member_upd_pwd_failed');
                $this->load->view('admin/upd_pwd', $data);
            }
        }
    }
    
    // 會員列表頁
    public function index(){
        $this->load->view('admin/member');
    }
    
    // 新增會員頁
    public function member_add(){
        $data = array(
            'form_error'   => false,
            'form_success' => $this->session->flashdata('form_success')
        );
        $rules = array(
            array(
                'field' => 'p_name',
                'label' => $this->lang->line('member_pname'),
                'rules' => 'required'
            ),
            array(
                'field' => 'p_id',
                'label' => $this->lang->line('member_pid'),
                'rules' => 'required|integer'
            ),
            array(
                'field' => 'name',
                'label' => $this->lang->line('member_name'),
                'rules' => 'required'
            ),
            array(
                'field' => 'account',
                'label' => $this->lang->line('member_login_account'),
                'rules' => array(
                    'required',
                    array(
                        'chk_account',
                        function($account){
                            $res = $this->member_md->get_member(null, null, null, $account);
                            if($res->num_rows() === 0) return true;
                            $this->form_validation->set_message('chk_account', '{field} ' . $this->lang->line('used'));
                            return false;
                        }
                    )
                )
            ),
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
                'field' => 'pwd',
                'label' => $this->lang->line('member_login_pwd'),
                'rules' => 'required|min_length[6]|max_length[12]'
            ),
            array(
                'field' => 'pwd',
                'label' => 'lang:member_login_pwd',
                'rules' => array(
                    'required',
                    'min_length[6]',
                    'max_length[12]',
                    array(
                        'chk_password',
                        function($password){
                            $chk = preg_match('/[0-9]/', $password);
                            $chk = !$chk ? $chk : preg_match('/[A-Z]/', $password);
                            $chk = !$chk ? $chk : preg_match('/[a-z]/', $password);
                            $chk = !$chk ? $chk : preg_match('/^[a-zA-Z0-9][a-zA-Z0-9]{6,12}$/', $password);
                            if($chk) return true;
                            $this->form_validation->set_message('chk_password', $this->lang->line('member_password_plz'));
                            return false;
                        }
                    )
                )
            ),
            array(
                'field' => 'gender',
                'label' => $this->lang->line('member_gender'),
                'rules' => 'required|exact_length[1]'
            ),
            array(
                'field' => 'status',
                'label' => $this->lang->line('member_status'),
                'rules' => 'required|integer'
            ),
            array(
                'field' => 'is_certified',
                'label' => $this->lang->line('member_certified'),
                'rules' => 'required|integer'
            )
        );
        
        // 資料庫團隊列數 > 0 的話, 團隊就設為必填
        $this->load->model('team_md');
        if($this->team_md->get_team()->num_rows() > 0){
            array_push($rules, array(
                'field' => 'team_name',
                'label' => $this->lang->line('team_name'),
                'rules' => 'required'
            ));
            array_push($rules, array(
                'field' => 'team_id',
                'label' => $this->lang->line('member_tid'),
                'rules' => 'required|integer'
            ));
        }
        
        $this->form_validation->set_rules($rules);
        if(!$this->form_validation->run()){
            $data['form_error'] = !empty(validation_errors()) ? validation_errors() : '';
            $this->load->view('admin/member_add', $data);
        }else{
            $ins = array(
                'pid'            => $this->input->post('p_id'),
                'team_id'        => $this->input->post('team_id'),
                'name'           => $this->input->post('name'),
                'email'          => $this->input->post('email'),
                'account'        => $this->input->post('account'),
                'pwd'            => $this->input->post('pwd'),
                'phone'          => $this->input->post('phone'),
                'birthday'       => $this->input->post('birthday'),
                'address'        => $this->input->post('address'),
                'gender'         => $this->input->post('gender'),
                'certificate_id' => $this->input->post('certificate_id'),
                'status'         => $this->input->post('status'),
                'is_certified'   => $this->input->post('is_certified')
            );
            if($this->member_md->add_member($ins)){
                $this->session->set_flashdata('form_success', $this->lang->line('member_add_success_msg'));
                redirect(current_url());
            }else{
                $data['form_error'] = $this->lang->line('member_add_failed_msg');
                $this->load->view('admin/member_add', $data);
            }
        }
    }
    
    // 編輯會員頁
    public function member_upd($id){
        $data = array(
            'id'           => $id,
            'form_error'   => false,
            'form_success' => $this->session->flashdata('form_success')
        );
        $res = $this->member_md->get_member($id);
        $data = array_merge($data, $res->row_array());
        
        $rules = array(
            array(
                'field' => 'name',
                'label' => $this->lang->line('member_name'),
                'rules' => 'required'
            ),
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
                            if($res->num_rows() < 2) return true;
                            $this->form_validation->set_message('chk_email', '{field} ' . $this->lang->line('used'));
                            return false;
                        }
                    )
                )
            ),
            array(
                'field' => 'gender',
                'label' => $this->lang->line('member_gender'),
                'rules' => 'required|exact_length[1]'
            ),
            array(
                'field' => 'status',
                'label' => $this->lang->line('member_status'),
                'rules' => 'required|integer'
            ),
            array(
                'field' => 'is_certified',
                'label' => $this->lang->line('member_certified'),
                'rules' => 'required|integer'
            )
        );
        $this->form_validation->set_rules($rules);
        if(!$this->form_validation->run()){
            $data['form_error'] = !empty(validation_errors()) ? validation_errors() : '';
            $this->load->view('admin/member_upd', $data);
        }else{
            $upd = array(
                'name'           => $this->input->post('name'),
                'email'          => $this->input->post('email'),
                'phone'          => $this->input->post('phone'),
                'birthday'       => $this->input->post('birthday'),
                'address'        => $this->input->post('address'),
                'gender'         => $this->input->post('gender'),
                'certificate_id' => $this->input->post('certificate_id'),
                'status'         => $this->input->post('status'),
                'is_certified'   => $this->input->post('is_certified')
            );
            if($this->member_md->upd_member($id, $upd)){
                $this->session->set_flashdata('form_success', $this->lang->line('member_upd_success_msg'));
                redirect(current_url());
            }else{
                $data['form_error'] = $this->lang->line('member_upd_failed_msg');
                $this->load->view('admin/member_upd', $data);
            }
        }
    }
    
    // 會員審核實名列表
    public function member_cert(){
        $this->load->view('admin/member_cert');
    }
    
}

?>