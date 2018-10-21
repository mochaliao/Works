<?php
class Money extends CI_Controller {

	public function index()
	{
		$this->load->model('Money_Model','MM');
		$data['money'] = $this->MM->getMoney(1);
		$this->load->view('money', $data);
	}

	public function moneyIn()
	{
		
		$data['sess'] = $this->session->all_userdata();


		$points = $_POST['points'];
		$note = $_POST['note'];
		$this->load->model('Money_Model','MM');
		$originMoney = "100";
		// $note = "test";
		
		$this->MM->moneyIn($data['sess']['id'], $points, $originMoney, $note);
	}

	public function moneyExchange()
	{

		$data['sess'] = $this->session->all_userdata();

		$points = $_POST['points'];
		$user = $_POST['user'];
		$note = $_POST['note'];



		$this->load->model('Money_Model','MM');
		$this->MM->exchangeTo($data['sess']['id'], $user, $points, $note);
	}

	public function moneySave()
	{
		$this->load->model('Money_Model','MM');
		$this->MM->moneySave(2);
	}

}
