<?php
class Notice extends CI_Controller
{
	public function index()
	{
		$id = $this->uri->segment(2);
		$this->load->library('session');
		$newdata = array(
						   'id'		   => $id,
		                   'username'  => 'johndoe',
		                   'email'     => 'johndoe@some-site.com',
		                   'logged_in' => TRUE
		               );

		$this->session->set_userdata($newdata);
		$data['sess'] = $this->session->all_userdata();

		$this->load->model('Notice_Model','NM');
		$this->load->model('Inviter_Model','IM');
		$this->load->model('Money_Model','MM');
		$this->load->model('Chat_Model','CM');
		$data['getInviters'] = $this->IM->getInviters(2);
		$data['countInviters'] = count($data['getInviters']);
		
		$data['getMoney'] = $this->MM->getMoney($data['sess']['id']);
		$data['getMoneyPoints'] = $data['getMoney']->result();
		$data['getChatContent'] = $this->CM->getChatContent(1, 2, 2, 6);
		$data['countChatContent'] = count($data['getChatContent']->result());

		$type = "leave";//暫時
		// $data['getNoticePost'] = $this->NM->getNoticePost(2, 6, $type);

		$data['getNotice'] = $this->NM->getNotice(2, 6, $type);
		$data['countNotice'] = count($data['getNotice']->result());

		$this->load->view('includes/header', $data);
		$this->load->view('iami/notice', $data);
	}

	public function notice_check()
	{
		$id = $this->input->post('id');
		$this->load->model('Notice_Model','NM');
		$this->NM->notice_check($id);
		// redirect('Notice');
	}
}