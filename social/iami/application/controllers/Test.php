<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo "This is EWei's Page aaaaa";
        //$this->load->view('test_view');
    }

    public function test1()
    {
        $this->load->view('test1_view');
    }

    public function test2()
    {
        $this->load->view('test2_view');
    }

    public function test3()
    {
        //echo '$config["base_url"]='.$this->config->item('base_url');
        //echo '<hr>';
        //echo 'platform='.get_platform();
        //echo '<hr>';
        //if (is_mobile()) echo '<h1>mobile</h1>'; else echo '<h1>not mobile</h1>';
        //$this->load->view('member_login_view2');
        //push_data('aaa', 'bbb');
        //$data['member_id'] = $member_id;
        //$this->load->view('test3_view',$data);
        //$this->load->library('../controllers/live');
        //$this->live->getLive();
        //$this->load->library('session');
        //require_once(APPPATH.'controllers/Language.php');
        //$oLanguage =  new Language();
        //$oLanguage->getLanguage();
        //$this->load->library('../controllers/live');
        //$this->live->getLive();
        $sql = 'SELECT DISTINCT p.post_id, p.content, m.nickname,n.member_id,n.for_who,n.is_read, n.id, n.text, n.createTime, n.target_path
                    FROM notices AS n
                    INNER JOIN members AS m
                        ON m.member_id = n.member_id
                    LEFT OUTER JOIN posts AS p
                        ON p.member_id = n.member_id
                        AND p.for_who = n.for_who
                    WHERE n.for_who = 6 AND n.member_id <> 27
                    ORDER BY p.post_id DESC, n.createtime ';
        $sql = 'select * from members limit 10';
        $result = $this->db->query($sql)->result_array();
        var_dump($result);
    }

    public function push_client()
    {
        $data['member_id'] = 11;
        $this->load->view('push_client_view', $data);
    }

    public function push_server()
    {
        $memberID = $this->session->userdata("member_id");//取得當前登入session

        //載入models
        $this->load->model('like_model');
        $this->load->model('invite_model');
        $this->load->model('Chat_Model');

        $push_data = array();
      
        /*$result_notice = $this -> like_model -> getNotifies($memberID);
        $data['notice'] = $result_notice;
        // $data['push_type']='notice';
        // $data['notice_count']=3;
        array_push($push_data, $data);
        
        $result_invite = $this-> invite_model ->getMemberByInvitee($memberID)->result_array();

        $data['invite'] = $result_invite;
        // $data['push_type']='invite';
        // $data['notice_count']=2;
        array_push($push_data, $data);
        
        $result_chat = $this-> Chat_Model -> getChat($memberID)->result();
        $data['chat'] = $result_chat;
        // $data['push_type']='message';
        // $data['notice_count']=1;
        array_push($push_data, $data);*/

        $sql = 'select member_id, nickname from members limit 3';
        $push_data = $this->db->query($sql)->result_array();

        $result = push_data(11, $push_data);
        echo $result;
    }
}
