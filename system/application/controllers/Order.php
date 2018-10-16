<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Order extends CI_Controller
	{
		
		public function __construct()
		{
			parent::__construct();
			// 讀取語系檔
			$this->lang->load('front', LANG);
            // 讀取產品 Model
            $this->load->model('product_md');
            // 讀取訂單 Model
            $this->load->model('order_md');
            // 讀取訂單交易 Model
            $this->load->model('transaction_md');
		}

		// 新增入單
		public function order_add()
		{
            $data = array(
                'products'     => $this->product_md->get_product(null, 1)->result_array(),
                'pay_types'    => $this->order_md->get_pay_type()->result_array(),
                'form_error'   => false,
                'form_success' => $this->session->flashdata('form_success')
            );
            
            $rules = array(
                array(
                    'field' => 'product_id',
                    'label' => $this->lang->line('order_product'),
                    'rules' => 'required|integer'
                ),
                array(
                    'field' => 'pay_type',
                    'label' => $this->lang->line('order_pay_type'),
                    'rules' => 'required'
                )
            );
            $this->form_validation->set_rules($rules);
            if(!$this->form_validation->run()){
                $data['form_error'] = !empty(validation_errors()) ? validation_errors() : '';
            }else{
                $ins = array(
                    'member_id'     => $_SESSION['member_id'],
                    'product_id'    => $this->input->post('product_id'),
                    'pay_type'      => $this->input->post('pay_type'),
                    'pay_date'      => date('Y-m-d H:i:s'),
                    'status'        => 0
                );
                if($this->order_md->add_order($ins)){
                    $this->session->set_flashdata('form_success', $this->lang->line('order_add_success_msg'));
                    redirect(current_url());
                }else{
                    $data['form_error'] = $this->lang->line('order_add_failed_msg');
                }
            }
			$this->load->view('order_entry.php', $data);
		}
        
        // 錢包紀錄(全部紀錄）
		public function record_bag($page = 1)
		{
            // 正數 trans_type
            $plus = array('Buy', 'Bonus', 'Adjust_plus');
            
            $res = $this->transaction_md->get_transaction(null, $_SESSION['member_id']);
            
            $show_rows = 10;
            $start = $page * $show_rows - $show_rows;
            $end   = $start + $show_rows  - 1;
            $pages = ceil($res->num_rows() / $show_rows);
            
            $rows = $res->result_array();
            
            $data = array(
                'page'  => $page,
                'pages' => $pages,
                'data'  => array()
            );
            foreach($rows as $loop => $row){
                if(!in_array($row['trans_type'], $plus)){
                    $row['money']  = '-' . $row['money'];
                    $row['ipoint'] = '-' . $row['ipoint'];
                }
                if($loop > $end) break;
                if($loop >= $start && $loop <= $end) array_push($data['data'], $row);
            }
            
			$this->load->view('record_bag.php', $data);
		}
		
		// 錢包紀錄詳細(單項)
		public function record_bag_det($id)
		{
            // 正數 trans_type
            $plus = array('Buy', 'Bonus', 'Adjust_plus');
            $row = $this->transaction_md->get_transaction($id)->row_array();
            if(!in_array($row['trans_type'], $plus)){
                $row['money']  = '-' . $row['money'];
                $row['ipoint'] = '-' . $row['ipoint'];
            }
			$this->load->view('record_bag_det.php', array( 'data' => $row ));
		}
		
		// 提現紀錄
		public function record_wdrl($page = 1)
		{
            $res = $this->transaction_md->get_transaction(null, $_SESSION['member_id'], 'Withdrawal');
            
            $show_rows = 10;
            $start = $page * $show_rows - $show_rows;
            $end   = $start + $show_rows  - 1;
            $pages = ceil($res->num_rows() / $show_rows);
            
            $rows = $res->result_array();
            
            $data = array(
                'page'  => $page,
                'pages' => $pages,
                'data'  => array()
            );
            foreach($rows as $loop => $row){
                if($loop > $end) break;
                if($loop >= $start && $loop <= $end) array_push($data['data'], $row);
            }
            
            
			$this->load->view('record_wdrl.php', $data);
		}

		// 支付紀錄
		public function record_order($page = 1)
		{
            $res = $this->transaction_md->get_transaction(null, $_SESSION['member_id'], 'Buy');
            
            $show_rows = 10;
            $start = $page * $show_rows - $show_rows;
            $end   = $start + $show_rows  - 1;
            $pages = ceil($res->num_rows() / $show_rows);
            
            $rows = $res->result_array();
            
            $data = array(
                'page'  => $page,
                'pages' => $pages,
                'data'  => array()
            );
            foreach($rows as $loop => $row){
                if($loop > $end) break;
                if($loop >= $start && $loop <= $end) array_push($data['data'], $row);
            }
            
			$this->load->view('record_order.php', $data);
		}

		// 獎金紀錄
		public function record_bonus($page = 1)
		{
            $res = $this->transaction_md->get_transaction(null, $_SESSION['member_id'], 'Bonus');
            
            $show_rows = 10;
            $start = $page * $show_rows - $show_rows;
            $end   = $start + $show_rows  - 1;
            $pages = ceil($res->num_rows() / $show_rows);
            
            $rows = $res->result_array();
            
            $data = array(
                'page'  => $page,
                'pages' => $pages,
                'data'  => array()
            );
            
            $level = $this->member_md->get_level($_SESSION['member_id']);
            
            foreach($rows as $loop => $row){
                if($loop > $end) break;
                if($loop >= $start && $loop <= $end) array_push( $data['data'], array_merge($row, array( 'level' => $level )) );
            }
            
			$this->load->view('record_bonus.php', $data);
		}
		
		// 獎金紀錄明細 ( 單項 )
		public function record_bonus_det()
		{
            // 正數 trans_type
            $plus = array('Buy', 'Bonus', 'Adjust_plus');
            $row = $this->transaction_md->get_transaction($id)->row_array();
            if(!in_array($row['trans_type'], $plus)){
                $row['money']  = '-' . $row['money'];
                $row['ipoint'] = '-' . $row['ipoint'];
            }
			$this->load->view('record_bonus_det.php', array( 'data' => $row ));
		}
		
	}

?>