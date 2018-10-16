<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        // 讀取語系檔
        $this->lang->load('back', LANG);
        // 讀取產品 Model
        $this->load->model('product_md');
        // 讀取訂單 Model
        $this->load->model('order_md');
    }
    
    // 訂單列表
    public function index(){
        $this->load->view('admin/order');
    }
    
    // 新增訂單
    public function order_add(){
        $data = array(
            'products'     => $this->product_md->get_product(null, 1)->result_array(),
            'pay_types'    => $this->order_md->get_pay_type()->result_array(),
            'form_error'   => false,
            'form_success' => $this->session->flashdata('form_success')
        );
        $rules = array(
            array(
                'field' => 'm_name',
                'label' => $this->lang->line('member_name'),
                'rules' => 'required'
            ),
            array(
                'field' => 'm_id',
                'label' => $this->lang->line('member_id'),
                'rules' => 'required|integer'
            ),
            array(
                'field' => 'product_id',
                'label' => $this->lang->line('order_product'),
                'rules' => 'required|integer'
            ),
            array(
                'field' => 'pay_type',
                'label' => $this->lang->line('order_pay_type'),
                'rules' => 'required'
            ),
            array(
                'field' => 'pay_date',
                'label' => $this->lang->line('order_pay_date'),
                'rules' => 'required'
            ),
            array(
                'field' => 'status',
                'label' => $this->lang->line('order_status'),
                'rules' => 'required|integer'
            )
        );
        $this->form_validation->set_rules($rules);
        if(!$this->form_validation->run()){
            $data['form_error'] = !empty(validation_errors()) ? validation_errors() : '';
            $this->load->view('admin/order_add', $data);
        }else{
            $ins = array(
                'member_id'     => $this->input->post('m_id'),
                'product_id'    => $this->input->post('product_id'),
                'pay_type'      => $this->input->post('pay_type'),
                'pay_date'      => $this->input->post('pay_date'),
                'status'        => $this->input->post('status'),
                'sys_member_id' => $_SESSION['admin']['admin_id']
            );
            if($this->order_md->add_order($ins)){
                $this->session->set_flashdata('form_success', $this->lang->line('order_add_success_msg'));
                redirect(current_url());
            }else{
                $data['form_error'] = $this->lang->line('order_add_failed_msg');
                $this->load->view('admin/order_add', $data);
            }
        }
    }
    
    // 編輯訂單頁
    public function order_upd($id = null){
        $data = array(
            'id'           => $id,
            'products'     => $this->product_md->get_product(null, 1)->result_array(),
            'pay_types'    => $this->order_md->get_pay_type()->result_array(),
            'form_error'   => false,
            'form_success' => $this->session->flashdata('form_success')
        );
        $res = $this->order_md->get_order($id);
        $data = array_merge($data, $res->row_array());
        $rules = array(
            array(
                'field' => 'pay_type',
                'label' => $this->lang->line('order_pay_type'),
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($rules);
        if(!$this->form_validation->run()){
            $data['form_error'] = !empty(validation_errors()) ? validation_errors() : '';
            $this->load->view('admin/order_upd', $data);
        }else{
            $upd = array(
                'id'       => $id,
                'pay_type' => $this->input->post('pay_type')
            );
            if($this->order_md->update_order($upd)){
                $this->session->set_flashdata('form_success', $this->lang->line('order_upd_success_msg'));
                redirect(current_url());
            }else{
                $data['form_error'] = $this->lang->line('order_upd_failed_msg');
                $this->load->view('admin/team_upd', $data);
            }
        }
    }
    
}

?>