<?php
class Inviter extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Notice_Model','NM');
		$this->load->model('Inviter_Model','IM');
		$this->load->model('Money_Model','MM');
		$this->load->model('Chat_Model','CM');
    }

	public function index()
	{
		// $this->load->model('Inviter_Model','NM');

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


		$data['getInviters'] = $this->IM->getInviters(2);
		$data['countInviters'] = count($data['getInviters']);
		$data['getNotice'] = $this->NM->getNotice(2, 6, 1);
		$data['countNotice'] = count($data['getNotice']->result());
		$data['getMoney'] = $this->MM->getMoney($data['sess']['id']);
		$data['getMoneyPoints'] = $data['getMoney']->result();
		$data['getChatContent'] = $this->CM->getChatContent(1, 2, 2, 6);
		$data['countChatContent'] = count($data['getChatContent']->result());

		$this->load->view('includes/header', $data);
		$this->load->view('iami/inviter', $data);
	}

	public function addInviter()
	{
		$id = $this->input->post('id');
		$add = $this->input->post('add');

		$this->load->model('Inviter_Model', 'IM');
		$this->IM->addInviter($id, $add);
	}

	public function delInviter()
	{
		$id = $this->input->post('id');
		$del = $this->input->post('del');

		$this->load->model('Inviter_Model', 'IM');
		$this->IM->addInviter($id, $del);
	}


}
