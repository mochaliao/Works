<?php
class Chatroom extends CI_Controller
{
    public function index()
    {
        $this->load->view('chatroom');
    }

    public function compare()
    {
        isLogin();
        $session = $this->session->userdata('member_id');
        $ChatUnit = $this->uri->segment(2);
        $ChatGroup = $this->uri->segment(3);
        // echo $ChatUnit;
        // echo $ChatGroup;
        $this->load->model('Chat_Model','CM');
        $data['ChatUnit'] = $this->CM->ChatUnit($session, $ChatUnit);
        // var_dump($a);
        // die();
        $data['ChatUnitContent'] = $this->CM->ChatUnitContent($ChatUnit, $ChatGroup);
        $data['ChatUnit'] = $this->CM->ChatUnit($session, $ChatUnit);
        $data['ChatUnitContent'] = $this->CM->ChatUnitContent($ChatUnit, $ChatGroup);
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
        $this->load->view('chatroom_compare', $data);
    }
}
?>