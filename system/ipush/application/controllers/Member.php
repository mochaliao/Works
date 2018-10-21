<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Member extends CI_Controller
	{
		
		public function __construct()
		{
			parent::__construct();
			// 讀取語系檔
			$this->lang->load('front', LANG);
		}
		
		// 忘記密碼頁
		public function get_pwd($inner = null)
		{
			$data = array(
				'inner' => ($inner === null ? false : true),
				'form_error' => false,
				'form_success' => $this->session->flashdata('form_success')
			);
			if (!$inner) { // 登入前 -------------------------------------------------------------------------------------------------------------------------------------------------
				$rules = array(
					array(
						'field' => 'account',
						'label' => $this->lang->line('account'),
						'rules' => array(
							'required',
							'min_length[4]',
							'max_length[12]',
							array(
								'chk_account_string',
								function ($account) {
									if (preg_match('/^[a-zA-Z][a-zA-Z0-9]{4,12}$/', $account)) return true;
									$this->form_validation->set_message('chk_account_string', '{field} ' . $this->lang->line('account_plz'));
									return false;
								}
							)
						)
					),
					array(
						'field' => 'email',
						'label' => $this->lang->line('email'),
						'rules' => 'required|valid_email'
					),
					array(
						'field' => 'mixed',
						'label' => implode(' & ', array($this->lang->line('account'), $this->lang->line('email'))),
						'rules' => array(
							'required',
							array(
								'chk_mixed_string',
								function ($str) {
									$str = explode('|', $str);
									$account = $str[0];
									$email = $str[1];
									$res = $this->member_md->get_member(null, null, $email, $account);
									if ($res->num_rows() > 0) return true;
									$this->form_validation->set_message('chk_mixed_string', '{field} ' . $this->lang->line('mismatch'));
									return false;
								}
							)
						)
					)
				);
				$this->form_validation->set_rules($rules);
				if (!$this->form_validation->run()) {
					$data['form_error'] = !empty(validation_errors()) ? validation_errors() : '';
				} else {
					$res = $this->member_md->get_member(null, null, $this->input->post('email'), $this->input->post('account'));
					$row = $res->row_array();
					// 帳號 + EMail + 密碼 + 今天日期編成 Encode
					$lre = urlencode($row['account'] . '/' . $row['email'] . '/' . base64_encode($row['account'] . $row['email'] . $row['pwd'] . date('Ymd')));
					$this->load->library('email');
					$this->email->from($this->email->smtp_user . '@' . $this->email->smtp_host, SITE_NAME);
					$this->email->to($this->input->post('email'));
					$this->email->subject('[ ' . SITE_NAME . ' ] ' . $this->lang->line('forget_password'));
					$this->email->message('<a href="' . base_url('member/reset_pwd/' . $lre) . '">請點擊前往更改您的新密碼</a>');
					if ($this->email->send()) {
						$this->session->set_flashdata('form_success', $this->lang->line('member_send_reset_pwd_mail_success'));
						redirect(current_url());
					} else {
						$data['form_error'] = $this->lang->line('member_send_reset_pwd_mail_failed');
					}
				}
			} else { // 登入後 -------------------------------------------------------------------------------------------------------------------------------------------------------
				if (!$_SESSION['logged']) @header('Location:' . HTTP_ROOT . '/main/login');
				$rules = array(
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
								function ($password) {
									$chk = preg_match('/[0-9]/', $password);
									$chk = !$chk ? $chk : preg_match('/[A-Z]/', $password);
									$chk = !$chk ? $chk : preg_match('/[a-z]/', $password);
									$chk = !$chk ? $chk : preg_match('/^[a-zA-Z0-9][a-zA-Z0-9]{6,12}$/', $password);
									if ($chk) return true;
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
				if (!$this->form_validation->run()) {
					$data['form_error'] = !empty(validation_errors()) ? validation_errors() : '';
				} else {
					if ($this->member_md->upd_member($_SESSION['member_id'], array('pwd' => $this->input->post('pwd')))) {
						$this->session->set_flashdata('form_success', $this->lang->line('member_upd_pwd_success'));
						redirect(base_url('main'));
					} else {
						$data['form_error'] = $this->lang->line('member_upd_pwd_failed');
					}
				}
			}
			$this->load->view('get_pwd', $data);
		}
		
		// 重置密碼頁
		public function reset_pwd($param)
		{
			$entry = explode('/', urldecode($param));
			$account = $entry[0];
			$email = $entry[1];
			$encode = $entry[2];
			$member = $this->member_md->get_member(null, null, $email, $account)->row_array();
			// 導入的參數與資料庫取出值相符
			if ($encode == base64_encode($member['account'] . $member['email'] . $member['pwd'] . date('Ymd'))) {
				$_SESSION['logged'] = true;
				$this->comm->login_define($member, base_url('member/get_pwd/inner'));
			} else {
				if (!$_SESSION['logged']) @header('Location:' . HTTP_ROOT . '/main/login');
			}
		}
		
		// 實名驗證頁
		public function upd_info()
		{
			$data = array(
				'member' => $this->member_md->get_member($_SESSION['member_id'])->row_array(),
				'form_error' => false,
				'form_success' => $this->session->flashdata('form_success')
			);
			$rules = array(
				array(
					'field' => 'email',
					'label' => $this->lang->line('email'),
					'rules' => 'required|valid_email'
				),
				array(
					'field' => 'name',
					'label' => $this->lang->line('member_name'),
					'rules' => 'required'
				),
				array(
					'field' => 'birthday',
					'label' => $this->lang->line('member_birthday'),
					'rules' => 'required'
				)
			);
			$this->form_validation->set_rules($rules);
			if (!$this->form_validation->run()) {
				$data['form_error'] = !empty(validation_errors()) ? validation_errors() : '';
			} else {
				$upd = array(
					'email' => $this->input->post('email'),
					'name' => $this->input->post('name'),
					'birthday' => $this->input->post('birthday'),
					'is_certified' => 2
				);
				if ($this->member_md->upd_member($_SESSION['member_id'], $upd)) {
					$this->session->set_flashdata('form_success', $this->lang->line('member_certifite_push_success'));
					redirect(current_url());
				} else {
					$data['form_error'] = $this->lang->line('member_certifite_push_failed');
				}
			}
			$this->load->view('upd_info', $data);
		}
		
		// 實名驗證上傳頁
		public function upd_info_upload()
		{
			$data = array(
				'member' => $this->member_md->get_member($_SESSION['member_id'])->row_array(),
				'form_error' => false,
				'form_success' => $this->session->flashdata('form_success'),
				'btn_ok_callback' => $this->session->flashdata('btn_ok_callback')
			);
			
			$upload_path = UPLOAD_ROOT . '/' . substr($data['member']['create_date'], 0, 10) . '/' . $data['member']['account'] . '/certificate';
			
			if ($data['member']['certificate_file1'] != null) $data['certificate_file1'] = str_replace(UPLOAD_ROOT, HTTP_UPLOAD_ROOT, $upload_path) . '/' . $data['member']['certificate_file1'];
			if ($data['member']['certificate_file2'] != null) $data['certificate_file2'] = str_replace(UPLOAD_ROOT, HTTP_UPLOAD_ROOT, $upload_path) . '/' . $data['member']['certificate_file2'];
			
			if (!is_dir($upload_path)) {
				mkdir($upload_path, 0775, true);
				chmod($upload_path, 0775);
			}
			
			$this->load->library(
				'upload', array(
				'upload_path' => $upload_path,
				'allowed_types' => 'gif|jpg|jpeg|png',
				'max_size' => 10240,
				'overwrite' => true
			));
			
			if (count($_FILES) == 0) {
			
			} else if (!$this->upload->do_upload('certificate_file1') || !$this->upload->do_upload('certificate_file2')) {
				$data['form_error'] = !empty($this->upload->display_errors()) ? $this->upload->display_errors() : '';
			} else {
				$file1 = $upload_path . '/' . $_FILES['certificate_file1']['name'];
				$file2 = $upload_path . '/' . $_FILES['certificate_file2']['name'];
				$upd = array(
					'certificate_file1' => $_FILES['certificate_file1']['name'],
					'certificate_file2' => $_FILES['certificate_file2']['name']
				);
				$this->member_md->upd_member(
					$_SESSION['member_id'], array(
					'certificate_file1' => $_FILES['certificate_file1']['name'],
					'certificate_file2' => $_FILES['certificate_file2']['name']
				));
				$this->session->set_flashdata('form_success', $this->lang->line('member_certifite_upload_success'));
				$this->session->set_flashdata('btn_ok_callback', "function btn_ok_callback(){ document.location.href = '" . base_url('member/upd_info') . "'; }");
				redirect(current_url());
			}
			
			$this->load->view('upd_info_doc', $data);
		}
		
		// 業務 QRCode 頁
		public function qrcode()
		{
			$this->load->view('qrcode');
		}
		
		// 修改密碼
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
                    'rules' => array(
                        'required',
                        'min_length[6]',
                        'max_length[12]',
                        'matches[pwd_new_check]',
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
                    'field' => 'pwd_new_check',
                    'label' => 'lang:re_password',
                    'rules' => 'required'
                )
            );
            $this->form_validation->set_rules($rules);
            if(!$this->form_validation->run()){
                $data['form_error'] = !empty(validation_errors()) ? validation_errors() : '';
            }else{
                if ($this->member_md->upd_password($_SESSION['member_id'], $this->input->post('pwd'), $this->input->post('pwd_new'))) {
					$this->session->set_flashdata('form_success', $this->lang->line('member_upd_pwd_success'));
					redirect(current_url());
				} else {
					$data['form_error'] = $this->lang->line('member_upd_pwd_failed');
				}
            }
            
			$this->load->view('upd_pwd.php', $data);
		}
		
		// 修改交易密碼
		public function upd_txn_pwd()
		{
            $data = array(
                'form_error'   => false,
                'form_success' => $this->session->flashdata('form_success'),
                'member'       => $this->member_md->get_member($_SESSION['member_id'])->row_array()
            );
			$this->load->view('upd_txn_pwd.php', $data);
		}
		
		// 提現錢包
		public function wdrl_bag()
		{
            $data = array(
                'form_error'   => false,
                'form_success' => $this->session->flashdata('form_success'),
                'member'       => $this->member_md->get_member($_SESSION['member_id'])->row_array()
            );
			$this->load->view('wdrl.php', $data);
		}
		
		// 設定Paypal
		public function set_paypal()
		{
            $data = array(
                'form_error'   => false,
                'form_success' => $this->session->flashdata('form_success'),
                'member'       => $this->member_md->get_member($_SESSION['member_id'])->row_array()
            );
            $rules = array(
                array(
                    'field' => 'paypal_account',
                    'label' => 'lang:member_paypal_account',
                    'rules' => 'required'
                )
            );
            $this->form_validation->set_rules($rules);
			if (!$this->form_validation->run()) {
				$data['form_error'] = !empty(validation_errors()) ? validation_errors() : '';
			} else {
				$upd = array(
					'paypal_account' => $this->input->post('paypal_account')
				);
				if ($this->member_md->upd_member($_SESSION['member_id'], $upd)) {
					$this->session->set_flashdata('form_success', $this->lang->line('member_paypal_set_success'));
					redirect(current_url());
				} else {
					$data['form_error'] = $this->lang->line('member_paypal_set_failed');
				}
			}
			$this->load->view('paypal.php', $data);
		}
		
		// 資產
		public function assets()
		{
            $data = array(
                'form_error'   => false,
                'form_success' => $this->session->flashdata('form_success'),
                'member'       => $this->member_md->get_member($_SESSION['member_id'])->row_array()
            );
            $data['member']['level'] = $this->member_md->get_level($_SESSION['member_id']);
            
            $this->load->library('link');
            $this->link->set_param(array(
                'member_id' => $_SESSION['member_id']
            ));
            $this->load->library('block');
            $this->block->set_param(array(
                'member_id' => $_SESSION['member_id']
            ));
            print_r($this->block->response);
            
            $data['bonus'] = array(
                'link'  => $this->link->response['sales_volume'],
                'block' => array(
                    'left'  => $this->block->response['left_sales_volume'],
                    'right' => $this->block->response['right_sales_volume']
                )
            );
            
			$this->load->view('assets.php', $data);
		}
	}

?>