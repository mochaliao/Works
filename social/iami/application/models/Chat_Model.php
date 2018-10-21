<?php
class Chat_Model extends CI_Model
{
	public function ChatUnit($session, $client)
	{

		// $this->db->distinct('members.nickname');
		// $this->db->group_by("message.roomid");
		
		// $this->db->order_by('message.time','desc');
		// $this->db->group_by("message.client");
		// $this->db->where('message.master', $session);


		// $this->db->join('members', 'members.member_id=message.client','left');
		// $query = $this->db->get('message');

		// $this->db->select('*');
		// $this->db->from('message');
		// $this->db->join('members', 'members.member_id = message.client','left');
		// $this->db->where('message.master', '1');
		// $this->db->where('message.no')
		// // $this->db->where('message.client','2');


		// // $this->db->group_by("message.client");

		// $this->db->order_by('message.time','desc');

		// $query = $this->db->get();
		$params = array();
        $sql = "SELECT * FROM message AS m left join members ON members.member_id=m.client WHERE m.master = ?  AND m.no = (SELECT MAX(m2.No) FROM message AS m2 WHERE m2.master = m.master AND m2.client = m.client) ORDER BY time DESC";
        array_push($params, $session);
//        $sql = "SELECT m.*, mb.* FROM message AS m  INNER JOIN members AS mb   ON mb.member_id = IF (m.master != ?, m.master, m.client) WHERE (m.master = ? OR m.client = ?) AND m.no = (SELECT MAX(NO) FROM message WHERE (MASTER = m.master AND CLIENT = m.client) OR (MASTER = m.client AND CLIENT = m.master))";
//        array_push($params, $session, $session, $session);

        $result = $this->db->query($sql, $params);

		return $result;
		// return $query;
		
	}

	public function ChatUnitContent_old($ChatUnit, $ChatGroup)
	{
		// if(isset($ChatGroup)){
  //   		$this->db->order_by('message.no','asc');
	 //        $this->db->where('gusers.groupname', $ChatGroup);
	 //        $this->db->join('gusers', 'gusers.roomid = message.roomid', 'left');
	 //        $this->db->join('members', 'members.member_id = message.master','left');
	 //        $query = $this->db->get('message','1');
  //   	}else{
    		$this->db->order_by('message.no','asc');
	        $this->db->where('members.member_id', $ChatUnit);
	        $this->db->join('gusers', 'gusers.roomid = message.roomid', 'left');
	        $this->db->join('members', 'members.member_id = message.master','left');
	        $query = $this->db->get('message','1');
    	// }





		// if(isset($ChatUnit)){
	 //        $this->db->order_by('message.no','asc');
	 //        $this->db->where('members.nickname', $ChatUnit);
	 //        $this->db->join('gusers', 'gusers.roomid = message.roomid', 'left');
	 //        $this->db->join('members', 'members.member_id = message.master','left');
	 //        $query = $this->db->get('message','1');
  //   	}else{
  //   		$this->db->order_by('message.no','asc');
	 //        $this->db->where('gusers.groupname', $ChatGroup);
	 //        $this->db->join('gusers', 'gusers.roomid = message.roomid', 'left');
	 //        $this->db->join('members', 'members.member_id = message.master','left');
	 //        $query = $this->db->get('message','1');
  //   	}
        return $query;
	}
	public function ChatUnitContent($ChatUnit, $ChatGroup)
	{
		// if(isset($ChatGroup)){
  //   		$this->db->order_by('message.no','asc');
	 //        $this->db->where('gusers.groupname', $ChatGroup);
	 //        $this->db->join('gusers', 'gusers.roomid = message.roomid', 'left');
	 //        $this->db->join('members', 'members.member_id = message.master','left');
	 //        $query = $this->db->get('message','1');
  //   	}else{
    		// $this->db->order_by('message.no','asc');
	     //    $this->db->where('message.client', $ChatUnit);
	     //    // $this->db->join('gusers', 'gusers.roomid = message.roomid', 'left');
	     //    $this->db->join('members', 'members.member_id = friends.friend_id','left');
	     //    $this->db->join('friends', 'message.master=friends.member_id','left')
	     //    $query = $this->db->get('message','1');
    	// }

		//ChatUnit
			// $this->db->order_by('message.time','desc');
			// $this->db->group_by("message.client");
			// $this->db->where('message.master', $session);
			// // $this->db->join('gusers', 'gusers.roomid=message.roomid','left');
			// $this->db->join('members', 'members.member_id=message.client','left');
			// $query = $this->db->get('message');


	    //version

//        $r_master=$result[0]->master;
//                         var_dump($result);
//                        var_dump($r_result);
                    if(isset($ChatUnit)) {

                        $r0 = array();

                        $session = $this->session->userdata('member_id');
////
                        $params = array();
                        $sql2 = "SELECT message.master FROM message WHERE message.client=$ChatUnit AND message.master=$session ";
                        array_push($params, $ChatUnit, $session);
//                        echo $sql2;
                        $result = $this->db->query($sql2)->result();
//                        var_dump($result);
//                        $r = $result->result();
                        @$r0 = $result[0]->master;
//                        echo $r0;
                        if(isset($r0)){
                            $params = array();
                            $sql = "SELECT * FROM message LEFT JOIN members ON members.member_id=message.client WHERE message.client=? AND message.master=? ORDER BY message.no ASC LIMIT 1";
                            array_push($params, $ChatUnit, $session);
                            $query = $this->db->query($sql, $params);
//                            $this->db->order_by('message.no', 'asc');
////                        $this->db->where('message.master', $ChatUnit);
//                            $this->db->where('message.client', $ChatUnit);
//                            // $this->db->join('gusers', 'gusers.roomid = message.roomid', 'left');
//                            $this->db->join('members', 'members.member_id = message.client', 'left');
//                            $query = $this->db->get('message', '1');
                        }else{
//                            $this->db->order_by('message.no', 'asc');
////                        $this->db->where('message.master', $ChatUnit);
//                            $this->db->where('message.client', $ChatUnit);
//                            // $this->db->join('gusers', 'gusers.roomid = message.roomid', 'left');
//                            $this->db->join('members', 'members.member_id = message.client', 'left');
//                            $query = $this->db->get('message', '1');
                        $params = array();
                        $sql = "SELECT * FROM message LEFT JOIN members ON members.member_id=message.master WHERE message.master=? AND message.client=? ORDER BY message.no ASC LIMIT 1";
                        array_push($params, $ChatUnit, $session);
                        $query = $this->db->query($sql, $params);
//                            var_dump($query);
                        }
//                        $master = $r->master;
//                        echo $master;






//                        var_dump(json_encode($query->result()));

                        //                        $params = array();
//                        $sql = "SELECT * FROM message LEFT JOIN members ON members.member_id=message.client WHERE message.client=$ChatUnit AND message.master=13 ORDER BY message.no ASC LIMIT 1";
//                        $query = $this->db->query($sql, $params);
                    }else{
//                        $this->db->where('message.client',0);
//                        $query = $this->db->get('message');
                        $params = array();
                        $sql = "SELECT * FROM message WHERE message.client=0";
                        $query = $this->db->query($sql, $params);
//                        $query = $query->num_rows();
                    }



        return $query;
		// if(isset($ChatUnit)){
	 //        $this->db->order_by('message.no','asc');
	 //        $this->db->where('members.nickname', $ChatUnit);
	 //        $this->db->join('gusers', 'gusers.roomid = message.roomid', 'left');
	 //        $this->db->join('members', 'members.member_id = message.master','left');
	 //        $query = $this->db->get('message','1');
  //   	}else{
  //   		$this->db->order_by('message.no','asc');
	 //        $this->db->where('gusers.groupname', $ChatGroup);
	 //        $this->db->join('gusers', 'gusers.roomid = message.roomid', 'left');
	 //        $this->db->join('members', 'members.member_id = message.master','left');
	 //        $query = $this->db->get('message','1');
  //   	}

	}


	// public function ChatMsg($memberID, $clientID)
	// {
	//     //version


	//     $params = array();
	//     $sql = "SELECT * FROM message INNER JOIN members ON members.member_id=message.client WHERE message.master = ? AND message.client = ? ORDER BY message.no ASC";
	//     array_push($params, $memberID, $clientID);
	//     $res = $this->db->query($sql, $params)->result();


 //        return $res;
	// }



	public function ChatGroup()
	{
		$this->db->distinct('members.nickname');
		$this->db->group_by("members.nickname");
		$this->db->order_by('message.time','desc');
		$this->db->join('members', 'members.member_id=message.master','left');
		$query = $this->db->get('message');

		return $query;
	}

	public function ChatGroupContent()
	{
        // $this->db->order_by('messages.id');
        // $this->db->where('members.id', $ChatUnit);
        $this->db->join('members', 'members.member_id = message.master','left');
        $query = $this->db->get('message');

        return $query;
	}




	public function ChatMember($session)
	{
		$params = array();
        $sql = "select * from friends inner join members ON members.member_id=friends.friend_id where friends.member_id= ? UNION select * from friends inner join members ON members.member_id=friends.member_id where friends.friend_id=?";
        array_push($params, $session, $session);

        $result = $this->db->query($sql, $params);

		return $result;
	}

	public function ChatMember2()
	{
		$query = $this->db->get('members');

		return $query;
	}

	public function ajaxFace($master, $client, $roomid, $face)
	{
		
		$data = array(
			'master' => $master,
			'client' => $client,
			'roomid' => $roomid,
			'msg'    => $face
			);
		$this->db->insert('message', $data);

		$this->load->model("Chat_Model");
		$push_data = array();
		$result_chat = $this-> Chat_Model -> getChat($client,'1')->result();
        $data['chat'] = $result_chat;
        // // $data['push_type']='message';
        // // $data['notice_count']=1;
        array_push($push_data, $data);
        push_data($client, $push_data);

        $params = array();
        $sql = "SELECT * FROM message WHERE master=? AND client=? ORDER BY time DESC LIMIT 1";
        array_push($params, $master, $client);
        $result_data = $this->db->query($sql, $params);
        return $result_data->result();

	}

	public function ajaxFileUpload($filename, $master, $client, $roomid)
	{
		$data = array(
			'msg' => $filename,
			'master' => $master,
			'client' => $client,
			'roomid' => $roomid
			);
		$this->db->insert('message', $data);
	}

	public function addUnitChat($master, $UnitChat)
	{
		$data = array(
			'master' => $master,
			'client' => $UnitChat,
			'msg'    => "HI !!"
			);
		$data2 = array(
			'master' => $UnitChat,
			'client' => $master,
			'msg'    => "HELLO !!"
		);
		//$this->db->insert('message', $data);
		//$this->db->insert('message', $data2);
		redirect('Chat');
	}

	public function addUnitChat2($master, $UnitChat)
	{
		$data = array(
			'master' => $master,
			'client' => $UnitChat,
			'msg'    => "HI !!"
			);
		$data2 = array(
			'master' => $UnitChat,
			'client' => $master,
			'msg'    => "HELLO !!"
		);
		//$this->db->insert('message', $data);
		//$this->db->insert('message', $data2);
		// redirect('Chat');
	}

	public function addGroupChat($groupname, $groupchat, $roomid)
	{
		$data = array(
			'groupname' => $groupname,
			'users'     => $groupchat,
			'roomid'    => $roomid
			);
		$this->db->insert('gusers', $data);
		
	}

	public function addGroupMessage($master, $roomid)
	{
		$data = array(
			'master' => $master,
			'client' => $roomid,
			'msg'    => "此群組現在可以開始聊天"
			);
		//$this->db->insert('message', $data);
		redirect('Chat');
	}

	public function recv($master, $client, $Page, $perPage, $group)
	{


		
		$params = array();
        $sql = "SELECT * FROM message inner join members ON members.member_id=message.master where master in (?, ?) and client in (?, ?) ORDER BY no ASC LIMIT 0, 10000";
        array_push($params, $master, $client, $master, $client);

        $result = $this->db->query($sql, $params)->result();




        /*pagination*/
//        $resultCount = count($result);
        if(!isset($perPage)){
            $perPage= '20';
        }
        $pageTotal=ceil(count($result)/$perPage);
//        $perPage=20;
        $pageTotal2 = count($result)/$perPage;

        if (!isset($Page)){ //假如$_GET["page"]未設置
            $Page=1; //則在此設定起始頁數
        }

//        $Page=7;

//        $pageTotal=7;
        $start = ($pageTotal2-$Page)*$perPage;
        if($start<0) {
            $end = ($pageTotal2-FLOOR($pageTotal2))*$perPage;
        }
        /*pagination end*/

        $param = array();
        if($start>=0) {
            $sql2 = "SELECT  CEILING((SELECT COUNT(*) FROM message inner join members ON members.member_id=message.master where master in (?, ?) and client in (?, ?) ORDER BY no ASC)/$perPage) AS TotalPage, message.*, members.*  FROM message inner join members ON members.member_id=message.master where master in (?, ?) and client in (?, ?) ORDER BY no ASC LIMIT $start, $perPage";
        }elseif($start<0){
            $sql2 = "SELECT  CEILING((SELECT COUNT(*) FROM message inner join members ON members.member_id=message.master where master in (?, ?) and client in (?, ?) ORDER BY no ASC)/$perPage) AS TotalPage, message.*, members.*  FROM message inner join members ON members.member_id=message.master where master in (?, ?) and client in (?, ?) ORDER BY no ASC LIMIT 0, $end";
        }else{
            $sql2 = "SELECT * FROM message inner join members ON members.member_id=message.master where master in (?, ?) and client in (?, ?) ORDER BY no ASC LIMIT 0, 10000";
        }
        array_push($param, $master, $client, $master, $client, $master, $client, $master, $client);
        $result_data = $this->db->query($sql2, $param);

		return $result_data;

	}

	public function recv_chatunit($session)
	{
		$params = array();
//	    $params2 = array();
//        $sql2 = "SELECT  (SELECT COUNT(*) FROM message WHERE master=m.client AND is_read=0) AS count, m.*, members.* FROM message AS m left join members ON members.member_id=m.client WHERE m.master = ?  AND m.no = (SELECT MAX(m2.No) FROM message AS m2 WHERE m2.master = m.master AND m2.client = m.client) ORDER BY time DESC";
//        array_push($params2, $session);
//        $result2 = $this->db->query($sql2, $params2)->result();

//        $sql  = "SELECT (SELECT COUNT(*) FROM message WHERE client=? AND is_read=0) AS Totalcount, (SELECT COUNT(*) FROM message WHERE client=? AND is_read=0 AND master=m.master) AS count, m.*, avatar, nickname FROM message AS m left join members ON m.master = members.member_id WHERE m.client = ? AND m.no = (SELECT MAX(m2.No) FROM message AS m2 WHERE m2.master = m.master AND m2.client = m.client) ORDER BY time DESC";
//        array_push($params, $session, $session, $session);
        //$sql = "SELECT nickname, msg, max(time) FROM (SELECT m.*, avatar, nickname FROM message AS m left join members ON m.master = members.member_id WHERE m.client = ? UNION SELECT m.*, avatar, nickname FROM message AS m left join members ON m.client = members.member_id WHERE m.master = ?) t GROUP BY nickname ORDER BY time DESC";
        //array_push($params, $session, $session);
//        $sql = "SELECT  t.* FROM (SELECT  m.*, avatar, nickname FROM message AS m left join members ON m.master = members.member_id WHERE m.client = ? UNION SELECT m2.*, avatar, nickname FROM message AS m2 left join members ON m2.client = members.member_id WHERE m2.master =? ORDER BY time DESC) t GROUP BY nickname";
        $sql = "
		SELECT  t.* FROM (SELECT  (SELECT COUNT(*) FROM message WHERE is_read=0 AND master=m.master AND client=$session) as count, m.*, avatar, nickname 
			FROM message AS m left join members ON m.master = members.member_id 
				WHERE m.client = ? 
		UNION SELECT  (SELECT COUNT(*) FROM message WHERE is_read=0 AND client=$session AND master=m2.master) as count, m2.*, avatar, nickname 
			FROM message AS m2 left join members ON m2.client = members.member_id 
				WHERE m2.master =? ORDER BY time DESC) 
		t GROUP BY nickname ORDER BY time DESC";
        array_push($params, $session, $session);

        $result = $this->db->query($sql, $params);

		return $result;
	}


	public function send($user, $client, $datetime, $msg,  $roomid)
	{


	     $data = array(
	     		'master' => $user,
	     		'client' => $client,
	     		'time' => $datetime,
	     		'msg'      => $msg,
	     		'roomid'     => $roomid
	     );

	     $result = $this->db->insert('message', $data);

	     $params = array();
	     $sql = "SELECT * FROM message WHERE master=? AND $client=? ORDER BY time DESC LIMIT 1";
	     array_push($params, $user, $client);
	     $result_data = $this->db->query($sql, $params);

	      $this->load->model("Chat_Model");
		  $push_data = array();
		  $result_chat = $this-> Chat_Model -> getChat($client,'1')->result();
          $data['chat'] = $result_chat;
          array_push($push_data, $data);
          push_data($client, $push_data);
//          push_data($master, $push_data);




	      return $result_data->result();



	}

    public function getChat($master, $count = 10, $unreadALL=0)
    {

        $params = array();
		$sql ="SELECT (SELECT COUNT(*) FROM message WHERE client=? AND is_read=0) AS Totalcount, (SELECT COUNT(*) FROM message WHERE client=? AND is_read=0 AND master=m.master) AS count, m.*, avatar, nickname FROM message AS m left join members ON m.master = members.member_id WHERE m.client = ? AND m.no = (SELECT MAX(m2.No) FROM message AS m2 WHERE m2.master = m.master AND m2.client = m.client) ORDER BY time DESC LIMIT 0," . $count;
        array_push($params, $master, $master, $master);

        $result = $this->db->query($sql, $params);

        return $result;

    }
	
    public function getChat2($master, $count=5)
    {

        $params = array();
		$sql = "SELECT * FROM message AS m left join members ON m.master = members.member_id WHERE m.client = ? AND m.no = (SELECT MAX(m2.No) FROM message AS m2 WHERE m2.master = m.master AND m2.client = m.client) ORDER BY time DESC LIMIT 0," . $count;
        array_push($params, $master);

        $result = $this->db->query($sql, $params);

        return $result;
    }

	public function getChatcount($master, $client)
	{
		$this->load->model('Chat_Model','CM');
		$data['getChatcount'] = $this->CM->getChat($master, $client);

	}

	public function update_is_read($client,$loginid)
	{
		$data = array(
               'is_read' => '1',
            );
		$this->db->where('master', $client);
		$this->db->where('client', $loginid);
		$this->db->update('message', $data);
	}

	public function getLastChat()
    {
        $session = $this->session->userdata('member_id');
        $params = array();
        $sql = "SELECT member_id FROM message AS m left join members ON members.member_id=m.client WHERE m.master = ?  AND m.no = (SELECT MAX(m2.No) FROM message AS m2 WHERE m2.master = m.master AND m2.client = m.client) ORDER BY time ASC";
        array_push($params, $session);
        $result = $this->db->query($sql, $params);
//        var_dump($result->result());
        $member_id = "";
        foreach($result->result() as $result)
        {
            $member_id = $result->member_id;
        }

        return $member_id;
    }

    public function clickChat($ChatUnit)
    {
        if(isset($ChatUnit)) {
            $params = array();
            $sql = "SELECT * FROM members WHERE member_id = $ChatUnit";
            $result = $this->db->query($sql);
        }else{
            $params = array();
            $sql = "SELECT * FROM members";
            $result = $this->db->query($sql);
        }
        return $result;
    }
}
?>