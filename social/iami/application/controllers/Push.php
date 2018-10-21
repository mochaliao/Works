<?php
class Push extends CI_Controller
{
	public function push_client()
    {
        $data['member_id'] = $this->session->userdata("member_id");
        $this->load->view('push_client_view', $data);
    }

    public function push_server()
    {
        $memberID = $this->session->userdata("member_id");//取得當前登入session


        //載入models
        $this->load->model('member_model');
        $this->load->model('like_model');
        $this->load->model('invite_model');
        $this->load->model('Chat_Model');

        $push_data = array();

        $res = $this -> like_model -> getNotifies($memberID);
        $notices = $res["data"];
        foreach($notices as $key => $notice){
            $member = $this->member_model->getMember($notice -> member_id)->row_array();
            $notices[$key] -> avatar = $member["avatar"];
            $notices[$key] -> nickname = $member["nickname"];
        }
        // print_r($notices);
        $data['notice'] = $notices;
        // // $data['push_type']='notice';
        // // $data['notice_count']=3;
        array_push($push_data, $data);
        
        $result_invite = $this-> invite_model ->getMemberByInvitee($memberID)->result_array();

        $data['invite'] = $result_invite;
        // // $data['push_type']='invite';
        // // $data['notice_count']=2;
        array_push($push_data, $data);
        
        $result_chat = $this-> Chat_Model -> getChat($memberID)->result();
        $data['chat'] = $result_chat;
        // // $data['push_type']='message';
        // // $data['notice_count']=1;
        array_push($push_data, $data);
        // $clientID = 2;
        // $result_chatunitcontent = $this-> Chat_Model -> ChatMsg($memberID, $clientID);
        // $data['chat'] = $result_chatunitcontent;
        // // $data['push_type']='message';
        // // $data['notice_count']=1;
        // array_push($push_data, $data);

        $result = push_data($memberID, $push_data);
        echo $result;
    }
}
?>