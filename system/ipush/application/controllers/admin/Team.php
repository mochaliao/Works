<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        // 讀取語系檔
        $this->lang->load('back', LANG);
        // 讀取團隊 Model
        $this->load->model('team_md');
    }
    
    // 團隊列表
    public function index(){
        $this->load->view('admin/team');
    }
    
    // 新增團隊頁
    public function team_add(){
        $data = array(
            'form_error'   => false,
            'form_success' => $this->session->flashdata('form_success')
        );
        $rules = array(
            array(
                'field' => 'team_pid',
                'label' => $this->lang->line('team_pid'),
                'rules' => 'required|integer'
            ),
            array(
                'field' => 'name',
                'label' => $this->lang->line('team_name'),
                'rules' => 'required'
            ),
            array(
                'field' => 'leader_id',
                'label' => $this->lang->line('team_leader_id'),
                'rules' => 'required|integer'
            ),
            array(
                'field' => 'leader_name',
                'label' => $this->lang->line('team_leader_name'),
                'rules' => 'required'
            ),
            array(
                'field' => 'status',
                'label' => $this->lang->line('team_status'),
                'rules' => 'required|integer'
            )
        );
        $this->form_validation->set_rules($rules);
        if(!$this->form_validation->run()){
            $data['form_error'] = !empty(validation_errors()) ? validation_errors() : '';
            $this->load->view('admin/team_add', $data);
        }else{
            $ins = array(
                'pid'            => $this->input->post('team_pid'),
                'name'           => $this->input->post('name'),
                'leader_id'      => $this->input->post('leader_id'),
                'status'         => $this->input->post('status')
            );
            if($this->team_md->add_team($ins)){
                $this->session->set_flashdata('form_success', $this->lang->line('team_add_success_msg'));
                redirect(current_url());
            }else{
                $data['form_error'] = $this->lang->line('team_add_failed_msg');
                $this->load->view('admin/team_add', $data);
            }
        }
    }
    
    // 編輯團隊頁
    public function team_upd($id = null){
        $data = array(
            'id'           => $id,
            'form_error'   => false,
            'form_success' => $this->session->flashdata('form_success')
        );
        if($id === null){
            $this->load->view('admin/team_upd', $data);
        }else{
            $res = $this->team_md->get_team($id);
            $data = array_merge($data, $res->row_array());
            $rules = array(
                array(
                    'field' => 'team_id',
                    'label' => $this->lang->line('team_id'),
                    'rules' => 'required|integer'
                ),
                array(
                    'field' => 'team_pid',
                    'label' => $this->lang->line('team_pid'),
                    'rules' => 'required|integer'
                ),
                array(
                    'field' => 'name',
                    'label' => $this->lang->line('team_name'),
                    'rules' => 'required'
                ),
                array(
                    'field' => 'leader_id',
                    'label' => $this->lang->line('team_leader_id'),
                    'rules' => 'required|integer'
                ),
                array(
                    'field' => 'leader_name',
                    'label' => $this->lang->line('team_leader_name'),
                    'rules' => 'required'
                ),
                array(
                    'field' => 'status',
                    'label' => $this->lang->line('team_status'),
                    'rules' => 'required|integer'
                )
            );
            $this->form_validation->set_rules($rules);
            if(!$this->form_validation->run()){
                $data['form_error'] = !empty(validation_errors()) ? validation_errors() : '';
                $this->load->view('admin/team_upd', $data);
            }else{
                $upd = array(
                    'id'             => $this->input->post('team_id'),
                    'pid'            => $this->input->post('team_pid'),
                    'name'           => $this->input->post('name'),
                    'leader_id'      => $this->input->post('leader_id'),
                    'status'         => $this->input->post('status')
                );
                if($this->team_md->upd_team($upd)){
                    $this->session->set_flashdata('form_success', $this->lang->line('team_upd_success_msg'));
                    redirect(current_url());
                }else{
                    $data['form_error'] = $this->lang->line('team_upd_failed_msg');
                    $this->load->view('admin/team_upd', $data);
                }
            }
        }
    }
    
}

?>