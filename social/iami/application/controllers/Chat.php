<?php
class Chat extends CI_Controller {

	// public function __construct()
	// {
	// 	parent::__construct();
	// 	$this->load->helper('form');
	// }

	public function index()
	{

		isLogin();
		$session = $this->session->userdata('member_id');
		$ChatUnit = $this->uri->segment(2);
		$ChatGroup = $this->uri->segment(3);

        // 加偉改
        $this->load->model('friend_model');

		if(!is_null($ChatUnit) && (int)$ChatUnit >= 0 && !$this -> friend_model -> isFriend($session, $ChatUnit)){
		   redirect("/page/pageNotFound");
        }
        ////////////////////////


		// echo $ChatUnit;
		// echo $ChatGroup;
		$this->load->model('Chat_Model','CM');
		$data['ChatUnit'] = $this->CM->ChatUnit($session, $ChatUnit);
		// var_dump($a);
		// die();
		$data['ChatUnitContent'] = $this->CM->ChatUnitContent($ChatUnit, $ChatGroup);		
		$data['ChatUnit'] = $this->CM->ChatUnit($session, $ChatUnit);
//		$data['ChatUnitContent'] = $this->CM->ChatUnitContent($ChatUnit, $ChatGroup);
		$data['ChatGroup'] = $this->CM->ChatGroup();
		$data['ChatGroupContent'] = $this->CM->ChatGroupContent();
		$data['ChatMember'] = $this->CM->ChatMember($session, $ChatUnit);
		$data['ChatMember2'] = $this->CM->ChatMember2();


		$data['addUnitChat_check'] = $data['ChatUnitContent']->result();
//		 var_dump($data['addUnitChat_check']);
// var_dump($data['ChatUnitContent']);
		if(empty($data['addUnitChat_check'])&&isset($ChatUnit)){
		$this->CM->addUnitChat2($session, $ChatUnit);
		}


		$this->load->model('money_model','MM');
		$data['getMoney'] = $this->MM->getMoney('1');


		$data['update_is_read'] = $this->CM->update_is_read($ChatUnit,$session);
		// $this->load->model('member_model');
		// $session_id = $this->session->userdata('member_id');
		// $member = $this->member_model->getMember($session_id)->row_array();

  //       $data = array(
  //           'money' => $member["money"],
  //       );
        $data['clickChat'] = $this->CM->clickChat($ChatUnit)->result();
        $getLastChat = $this->CM->getLastChat();

        if($getLastChat!="" && $ChatUnit == "" && $ChatUnit != $getLastChat){
            redirect("/chat/$getLastChat");
        }
        /*
        $nobody = $this->session->userdata('nobody');

        if(!isset($ChatUnit)&& $nobody != 1) {
            $this->session->set_userdata('nobody',1);
            redirect("/chat/$getLastChat");
        }
        */
//        if(!isset($ChatUnit)) {
//            redirect("/chat/1");
//        }
		$this->load->view('chat', $data);

	}

	public function ajaxFace()
	{
		$master = $this->input->post('master');
		$client = $this->input->post('client');
		$roomid = $this->input->post('roomid');
		$face = $this->input->post('face');

		$this->load->model('Chat_Model','CM');
		$result_data = $this->CM->ajaxFace($master, $client, $roomid, $face);
		echo json_encode($result_data);
	}

	public function ajaxFileUpload()
	{
		$filename = $this->input->post('filename');
		$master = $this->input->post('master');
		$client = $this->input->post('client');
		$roomid = $this->input->post('roomid');


		$this->load->model('Chat_Model','CM');
		$this->CM->ajaxFileUpload($filename, $master, $client, $roomid);
	}


	public function addUnitChat()
	{
		$master = $this->input->post('master');
		$UnitChat = $this->input->post('UnitChat');
		// $json_groupchat = json_encode($groupchat);
		$this->load->model('Chat_Model','CM');
		//$this->CM->addUnitChat($master, $UnitChat);
		header("location: /chat/" . $UnitChat);
	}


	public function addGroupChat()
	{
		$master = $this->input->post('master');
		$groupname = $this->input->post('groupname');
		$groupchat = $this->input->post('groupchat');
		$roomid = uniqid();
		$json_groupchat = json_encode($groupchat);
		$this->load->model('Chat_Model','CM');
		$this->CM->addGroupChat($groupname, $json_groupchat, $roomid);
		$this->CM->addGroupMessage($master, $roomid);
	}

	public function recv()
	{
		if (!isLogin(FALSE)){
			$result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
			echo json_encode($result, JSON_UNESCAPED_UNICODE);
			return FALSE;
		}

		$master = $this->input->get('master');
		if(empty($master)){
			$master=$this->session->userdata('member_id');
		}
		$client = $this->input->get('client');

		$Page = $this->input->get('Page');
		$perPage = $this->input->get('perPage');

		$group = $this->input->get('group');
		$this->load->model('Chat_Model','CM');
		$msg = $this->CM->recv($master, $client, $Page, $perPage, $group);


		echo json_encode(array("result"=>$msg->result()));
	}

	public function send()
	{

//		$msg = $_GET["msg"];
//	    $datetime = date("Y/m/d H:i:s");
//	    $user = $_GET["name"];
//	    $client = $_GET['client'];
//	    $roomid = $_GET["roomid"];

        $msg = $_POST["msg"];
	    $datetime = date("Y/m/d H:i:s");
	    $user = $_POST["name"];
	    $client = $_POST['client'];
	    $roomid = $_POST["roomid"];



        $this->load->model('Chat_Model', 'CM');
        $result_data = $this->CM->send($user, $client, $datetime, $msg, $roomid);

		echo json_encode($result_data);
	}


}
