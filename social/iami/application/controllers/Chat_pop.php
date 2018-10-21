<?php
class Chat_pop extends CI_Controller
{

	public function getChat()
	{

		// $master = $this->input->get('master');
        if (!empty($this->input->get_post('member_id'))) {
            $master = $this->input->get_post('member_id');
        } else {
            $master = $this->session->userdata('member_id');
        }
		$unreadALL = $this->input->get_post('unreadALL');
		$count = 10;
		// $master = '1';
		// $client = '2';
		// $group = $this->input->get('group');
		$this->load->model('Chat_Model','CM');
		$msg = $this->CM->getChat($master, $count,$unreadALL);			
		
		$array = array("result"=>array());


		   foreach ($msg->result() as $row)
		   {
		   		array_push($array["result"], $row);
		   }
		
		   echo json_encode($array, JSON_UNESCAPED_UNICODE);
	}

	public function getChatcount()
	{
		$master = $this->input->get('master');
		$client = $this->input->get('client');
		$group = $this->input->get('group');
		$this->load->model('Chat_Model','CM');
		$msg = $this->CM->getChatcount($master, $client);
		$array = array("result"=>array());

		   foreach ($msg->result() as $row)
		   {
		   		array_push($array["result"],json_encode($row));
		   }

		   echo json_encode($array);
	}
	
	public function recv_chatunit()
	{
		$master = $this->input->get('master');
		
		$this->load->model('Chat_Model','CM');
		$msg = $this->CM->recv_chatunit($master);
		$array = array("result"=>array());

		   foreach ($msg->result() as $row)
		   {
		   		array_push($array["result"],json_encode($row));
		   }

		   echo json_encode($array);
	}

	public function test()
	{
		$this->load->view('test');
	}

	public function getChatTest()
	{
		$master = '1';
		$client = '2';
		// $group = $this->input->get('group');
		$this->load->model('Chat_Model','CM');
		$msg = $this->CM->ChatUnit($master, $client);
	}

	// public function test()
	// {
	// 	$msg = '123';
	//     $datetime = date("Y/m/d H:i:s");
	//     $user = '456';
	//     $roomid = '1';
		
	// 	$this->load->model('Chat_Model','CM');
	// 	$this->CM->send($user, $datetime, $msg, $roomid);
	// }
}