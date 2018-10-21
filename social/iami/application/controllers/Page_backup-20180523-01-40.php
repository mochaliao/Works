<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('member_model');
        $this->load->model('post_model');
        $this->load->model('like_model');
        $this->load->model('trace_model');
        $this->load->model('live_model');
        $this->load->model('member_model');
        $this->load->model('member_company_model');
        $this->load->model('member_school_model');
        $this->load->model('language_model');
        $this->load->model('country_model');
        $this->load->library('form_validation');
        $this->load->library('email');
/*
        $this->load->model('Notice_Model','NM');
        $this->load->model('Inviter_Model','IM');
        $this->load->model('Money_Model','MM');
        $this->load->model('Chat_Model','CM');

*/
    }

    //==================================================================================================================
    //顯示首頁
    //==================================================================================================================
    public function main($show_type = NULL)
    {
        /*$member_id = $this->session->userdata("member_id");
        if (!isset($member_id)) {
            redirect('/member/doLogin');
        }*/
        isLogin();
        $member_id = $this->session->userdata("member_id");
        $member = $this->member_model->getMember($member_id)->row_array();
        $postCount = $this -> post_model -> getPostCount($member_id);
        $traceCount = $this -> trace_model -> getTraceByMember($member_id) -> num_rows();
        $fansCount = $this -> trace_model -> getMemberByTrace($member_id) -> num_rows();


        $data = array(
            'member_id' => $member_id,
            'email' => $member["email"],
            'nickname' => $member["nickname"],
            'language_id' => $member["language_id"],
            'avatar' => $member["avatar"],
            'banner' => $member["banner"],
            'status' => $member["status"],
            'level' => $member["level"],
            'money' => $member["money"],
            "is_myself" => true,
            "postCount" => $postCount,
            "traceCount" => $traceCount,
            "fansCount" => $fansCount,
            "show_type" => $show_type,
            "isFriend" => true
        );
/*
        $data['getInviters'] = array();// $this->IM->getInviters(2);
        $data['countInviters'] = 0;// count($data['getInviters']);
        $data['getNotice'] = array();// $this->NM->getNotice(2, 6, 1);
        $data['countNotice'] = 0;// count($data['getNotice']->result());
        $data['getMoney'] = $this->MM->getMoney(1);// $this->MM->getMoney($data['sess']['id']);
        $data['getMoneyPoints'] = $data['getMoney']->result();
        $data['getChatContent'] = $this->CM->getChatContent(1, 2, 2, 6);
        $data['countChatContent'] = count($data['getChatContent']->result());
*/
        $this->load->model('label_model');
        $data['getLabel1'] = $this-> label_model ->getLabel($member_id)->result();
        $this->load->view('main_view', $data);
    }

    //==================================================================================================================
    //顯示基本資料編輯頁
    //==================================================================================================================
    public function info($showType = ""){

        $member_id = $this->session->userdata("member_id");
        if (!isset($member_id)) {
            redirect('/member/doLogin');
        }

        $myself = false;
        $info_id = $this -> input -> get("i");
        if(is_null($info_id)){
            $info_id = $member_id;
            $myself = true;
        }
        else if($info_id == $member_id){
            $myself = true;
        }

        $member = $this->member_model->getMember($info_id)->row_array();

        $postCount = $this -> post_model -> getPostCount($info_id);
        $collectCount = $this -> post_model -> getCollectionCount($info_id);
        $traceCount = $this -> trace_model -> getTraceByMember($info_id) -> num_rows();
        $fansCount = $this -> trace_model -> getMemberByTrace($info_id) -> num_rows();

        $isTrace = $this -> like_model -> isTrace($member_id, $info_id);
        $isInvite = $this -> like_model -> isInvite($member_id, $info_id);
        $isRequest = $this -> like_model -> isRequest($member_id, $info_id);
        $isFriend = $this -> like_model -> isFriend($member_id, $info_id);

        $data = array(
            'member_id' => $info_id,
            'email' => $member["email"],
            'nickname' => $member["nickname"],
            'language_id' => $this->session->userdata("language_id"),
            'avatar' => $member["avatar"],
            'banner' => $member["banner"],
            'status' => $this->session->userdata("status"),
            "is_myself" => $myself,
            'level' => $member["level"],
            'money' => $member["money"],
            "postCount" => $postCount,
            "collectCount" => $collectCount,
            "traceCount" => $traceCount,
            "fansCount" => $fansCount,
            "isTrace" => $isTrace,
            "isFriend" => $isFriend,
            "isRequest" => $isRequest,
            "isInvite" => $isInvite
        );
        $info_show =  json_decode($member["info_show"]);
        if($info_show  == ""){
            $info_show = array();
        }

        $member = $this->member_model->getMember($member_id)->row_array();
        $data['member'] = $member;
        $member_companys = $this->member_company_model->getMemberCompany($member_id)->result_array();
        $data['member_companys'] = $member_companys;
        $member_schools = $this->member_school_model->getMemberSchool($member_id)->result_array();
        $data['member_schools'] = $member_schools;
        $countrys = $this->country_model->getCountry()->result_array();
        $data['countrys'] = $countrys;
        $languages = $this->language_model->getLanguage()->result_array();
        $data['languages'] = $languages;
        $data['info_show'] = $info_show;
        $data['show_type'] = $showType;

        $this->load->model('label_model');
        $data['getLabel1'] = $this-> label_model ->getLabel($info_id)->result();
        $data['getLabel2'] = $this-> label_model ->getLabel($info_id)->result();
        $data['getLabel3'] = $this-> label_model ->getLabel($info_id)->result();
        $data['getLabel4'] = $this-> label_model ->getLabelSelf($member_id)->result();
        $data['getLabelALL'] = $this-> label_model ->getLabelALL($member_id)->result();

        $this->load->view('info_view', $data);

    }

    public function notifies(){

        // 暫用
        $this -> readNotifies();

        $memberID = $this->session->userdata("member_id");
        $datas = $this -> like_model -> getNotifies($memberID , 100);

        foreach($datas["data"] as $key => $data){
            $member = $this -> member_model -> getMember($data -> member_id) -> row_array();
            $datas["data"][$key] -> member = $member;

        }
        $this -> load -> view("notice2_view", array(
            "member_id" => $memberID,
            "datas" => $datas["data"]
        ));
    }

    public function invite_notifies(){

        $invitee_id = $this->session->userdata('member_id');
        if (is_null($this->input->get_post('status'))){
            $status = 2;
        }else{
            $status = $this->input->get_post('status');
        }
        $start_row = $this->input->get_post('start_row');
        $return_rows = $this->input->get_post('return_rows');
        $this->load->model('invite_model');
        $members = $this->invite_model->getMemberByInvitee($invitee_id, $status, $start_row, $return_rows)->result_array();


        $this -> load -> view("invite_notice_view", array(
            "member_id" => $invitee_id,
            "datas" => $members
        ));
    }

    public function message_notifies(){

        $master = $this->session->userdata('member_id');

        // $master = '1';
        // $client = '2';
        // $group = $this->input->get('group');
        $this->load->model('Chat_Model','CM');
        $msg = $this->CM->getChat2($master);
        $array = array();
        foreach ($msg->result() as $row)
        {
            $array[] = $row;
        }

        $this -> load -> view("message_notice_view", array(
            "member_id" => $master,
            "datas" => $array
        ));
    }

    //==================================================================================================================
    //進行修改基本資料
    //==================================================================================================================
    public function doEdit()
    {
        isLogin();
        $this->load->library('form_validation');
        //帳號規則
        //$this->form_validation->set_rules('memberid', $this->lang->line('member_field_memberid'), 'trim|required|min_length[2]|max_length[32]|alpha_dash|regex_match[/^[A-Za-z]/]|is_unique[member.memberid]');
        //密碼規則
        //$this->form_validation->set_rules('password', $this->lang->line('member_field_password'), 'trim|required|min_length[6]|max_length[32]');
        //確認密碼規則
        //$this->form_validation->set_rules('repassword', $this->lang->line('member_field_repassword'), 'trim|required|min_length[6]|max_length[32]|matches[password]');
        //電子信箱規則
        //$this->form_validation->set_rules('email', $this->lang->line('member_field_email'), 'trim|required|valid_email|is_unique[member.email]');
        //匿稱規則
        $this->form_validation->set_rules('nickname', $this->lang->line('member_field_nickname'), 'trim|required|max_length[100]|gb_max_length[20]|sensitive');
        //個人簡歷規則
        $this->form_validation->set_rules('resume', $this->lang->line('member_field_resume'), 'trim|max_length[1024]');
        //手機規則
        $this->form_validation->set_rules('mobile', $this->lang->line('member_field_mobile'), 'trim|required|max_length[20]|regex_match[/^[0-9\+-]+$/]');
        //生日規則
        $this->form_validation->set_rules('birth', $this->lang->line('member_field_birth'), 'trim|required|min_length[10]|max_length[10]|regex_match[/^[0-9]{4}-[01][0-9]-[0-3][0-9]$/]');
        //居住城市
        $this->form_validation->set_rules('city', $this->lang->line('member_field_city'), 'trim|max_length[32]');

        if ($this->form_validation->run() == FALSE || $this->banModifyNickname()){
            $this->info("edit");
        }else{
            $modifyNickname = false;
            if($this->session->userdata('nickname')!=$this->input->post("nickname")){
                 $modifyNickname=true;
            }
            $member = $this->input->post();


            $this->session->set_userdata(array('nickname'=>$member['nickname']));

            $member['member_id'] = $this->session->userdata('member_id');
            $companys = array();
            for ($i = 0 ; $i < sizeof($member['company']); $i++){
                if (trim($member['company'][$i]) != '' || trim($member['position'][$i])){
                    $company['member_id'] = $member['member_id'];
                    $company['company'] = $member['company'][$i];
                    $company['position'] = $member['position'][$i];
                    $company['create_time'] = date('Y-m-d H:i:s');
                    array_push($companys, $company);
                }
            }

            $schools = array();
            for ($i = 0 ; $i < sizeof($member['school']); $i++){
                if (trim($member['school'][$i]) != '' || trim($member['department'][$i])) {
                    $school['member_id'] = $member['member_id'];
                    $school['school'] = $member['school'][$i];
                    $school['department'] = $member['department'][$i];
                    $school['create_time'] = date('Y-m-d H:i:s');
                    array_push($schools, $school);
                }
            }

            //進行交易
            $this->db->trans_start();
            //更新任職公司、職稱
            $result = $this->member_company_model->editMemberCompany($member['member_id'], $companys);
            if ($result['status'] == 'failed'){
                $this->db->trans_rollback();
                die($result);
            }
            unset($member['company']);
            unset($member['position']);
            //更新學校、科系
            $result = $this->member_school_model->editMemberSchool($member['member_id'], $schools);
            if ($result['status'] == 'failed'){
                $this->db->trans_rollback();
                die($result);
            }
            unset($member['school']);
            unset($member['department']);
            //更新會員

            foreach($member as $key => $value){
                if ((is_array($value) || trim($value) == '') && $key != "resume" && $key != "city" && $key != "info_show"){
                    unset($member[$key]);
                }
            }

            $member['modify_time'] = date('Y-m-d H:i:s');

           if($modifyNickname){
               $member['last_nickname_time'] = date('Y-m-d H:i:s');
           }

            $member["info_show"] = json_encode($member["info_show"]);


            $result = $this->member_model->editMember($member);
            if ($result['status'] == 'failed'){
                $this->db->trans_rollback();
                die($result);
            }
            $member_id = $this->input->get_post('member_id');
            $id = $this->input->get_post('label');

            for($i=0;$i<count($id);$i++){
                $label = array('member_id' => $member_id, 'label' => $id[$i]);
                $this->db->insert('member_labels', $label);
            }

            $this->db->trans_complete();
            switchLanguage($member['language_id']);
            //redirect('/page/info/field_invaild', 'refresh');
            redirect('/page/main', 'refresh');
        }
    }

    public  function  banModifyNickname(){
        $member = $this->member_model->getMember($this->session->userdata('member_id'))->row_array();
        if(isset($member['last_nickname_time']))
        {
            $strtime = strtotime("{$member['last_nickname_time']} +7 day");
            if($member['nickname']!=$this->input->post("nickname") && strtotime(date("Y-m-d H:i:s")) < $strtime){
                $this->form_validation->set_error_message("ban_modify_nickname","nickname",$this->lang->line('member_field_nickname'),date("Y-m-d H:i:s",$strtime));
               return true;
            }
        }
        return false;
    }

    //==================================================================================================================
    //顯示我就是我影片專區
    //==================================================================================================================
    public function videoshow(){
        /*$member_id = $this->session->userdata("member_id");
        if (!isset($member_id)) {
            redirect('/member/doLogin');
        }

        $member = $this->member_model->getMember($member_id)->row_array();
        $data = array(
            'member_id' => $member_id,
            'email' => $member["email"],
            'nickname' => $member["nickname"],
            'language_id' => $this->session->userdata("language_id"),
            'avatar' => $member["avatar"],
            'banner' => $member["banner"],
            'status' => $this->session->userdata("status"),
            'level' => $member["level"],
            'money' => $member["money"],

        );

        $this->load->view('video_show_view', $data);*/
        $this->load->model('fivesec_model');
        $datas["movies"] = $this -> fivesec_model -> getMovieList();
        $this->load->view('video_show2_view', $datas);
    }

    public function message(){
        $member_id = $this->session->userdata("member_id");
        if (!isset($member_id)) {
            redirect('/member/doLogin');
        }

        $member = $this->member_model->getMember($member_id)->row_array();
        $data = array(
            'member_id' => $member_id,
            'email' => $member["email"],
            'nickname' => $member["nickname"],
            'language_id' => $this->session->userdata("language_id"),
            'avatar' => $member["avatar"],
            'banner' => $member["banner"],
            'status' => $this->session->userdata("status"),
            'level' => $member["level"],
            'money' => $member["money"],

        );

        $this->load->view('message_view', $data);
    }

    public function pageNotFound(){

        $member_id = $this->session->userdata("member_id");
        if (!isset($member_id)) {
            redirect('/member/doLogin');
        }

        $member = $this->member_model->getMember($member_id)->row_array();
        $data = array(
            'member_id' => $member_id,
            'email' => $member["email"],
            'nickname' => $member["nickname"],
            'language_id' => $this->session->userdata("language_id"),
            'avatar' => $member["avatar"],
            'banner' => $member["banner"],
            'status' => $this->session->userdata("status"),
            'level' => $member["level"],
            'money' => $member["money"],
            "is_myself" => true

        );

        $this->load->view('404_view', $data);

    }

    //==================================================================================================================
    //進行密碼修改
    //==================================================================================================================
    public function doChangePassword()
    {
        isLogin();
        $this->load->library('form_validation');
        //原密碼規則
        $this->form_validation->set_rules('old_password', $this->lang->line('member_field_old_password'), 'trim|required|min_length[6]|max_length[32]|callback_check_old_password');
        //新密碼規則
        $this->form_validation->set_rules('new_password', $this->lang->line('member_field_new_password'), 'trim|required|min_length[6]|max_length[12]|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,32}$/]');
        //確認新密碼規則
        $this->form_validation->set_rules('confirm_new_password', $this->lang->line('member_field_confirm_new_password'), 'trim|required|min_length[6]|max_length[12]|matches[new_password]|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,32}$/]');

        if ($this->form_validation->run() == FALSE){
            $this->main('change_password');
        }else {
            $member = $this->input->post();
            $m['member_id'] = $this->session->userdata('member_id');
            $m['password'] = $member['new_password'];
            $m['modify_time'] = date('Y-m-d H:i:s');
            $result = $this->member_model->editMember($m);
            if (strtolower($result['status']) == 'success'){
                redirect('/page/main');
            }else{
                //$this->showChangePassword($this->lang->line('member_edit_password_failed_message'));
                $this->main('change_password');
            }
        }
    }

    //==================================================================================================================
    //檢查原密碼是否正確
    //==================================================================================================================
    public function check_old_password($old_password)
    {
        isLogin();
        $member_id = $this->session->userdata('member_id');
        $old_password = trim($old_password);
        $member = $this->member_model->getMember($member_id)->row_array();
        if ( ! empty($member)) {
            if (md5($old_password) !== $member['password']) {
                $this->form_validation->set_message('check_old_password', $this->lang->line('member_password_incorrect'));
                return FALSE;
            } else {
                return TRUE;
            }

        } else {
            return TRUE;
        }
    }

    //==================================================================================================================
    //顯示我的媒體
    //==================================================================================================================
    public function media()
    {
        isLogin();
        $member_id = $this->session->userdata("member_id");
        $myself = false;
        $info_id = $this -> input -> get("i");
        if(is_null($info_id)){
            $info_id = $member_id;
            $myself = true;
        }
        else if($info_id == $member_id){
            $myself = true;
        }

        $member = $this->member_model->getMember($info_id)->row_array();

        $postCount = $this -> post_model -> getPostCount($info_id);
        $collectCount = $this -> post_model -> getCollectionCount($info_id);
        $traceCount = $this -> trace_model -> getTraceCount($info_id);
        $fansCount = $this -> trace_model -> getFansCount($info_id);

        $this->load->view('media_view', array(
            'member_id' => $info_id,
            'email' => $member["email"],
            'nickname' => $member["nickname"],
            'language_id' => $member["language_id"],
            'avatar' => $member["avatar"],
            'banner' => $member["banner"],
            'status' => $member["status"],
            'level' => $member["level"],
            'money' => $member["money"],
            "is_myself" => $myself,
            "postCount" => $postCount,
            "collectCount" => $collectCount,
            "traceCount" => $traceCount,
            "fansCount" => $fansCount
        ));
    }

    //==================================================================================================================
    //顯示直播專區
    //==================================================================================================================
    public function live()
    {
        redirect('/live/syncLive/'.'page/showLive');
    }

    public function showLive()
    {
        isLogin();
        $member_id = $this->session->userdata("member_id");
        $member = $this->member_model->getMember($member_id)->row_array();
        $postCount = $this -> post_model -> getPostCount($member_id);
        $traceCount = $this -> trace_model -> getTraceByMember($member_id) -> num_rows();
        $fansCount = $this -> trace_model -> getMemberByTrace($member_id) -> num_rows();
        $lives = $this->live_model->getLiveByStatus('connected')->result_array();
        $member['is_myself'] = TRUE;
        $member['postCount'] = $postCount;
        $member['traceCount'] = $traceCount;
        $member['fansCount'] = $fansCount;
        $data['member'] = $member;
        $data['lives'] = $lives;

        $this->load->view('live_view', $data);
    }

    public function memberQuery(){
        $keyword = $this -> input -> post("keyword");

        if($keyword == ""){
            return json_encode(array());
        }

        $res = $this -> like_model -> memberQuery($keyword);

        echo json_encode($res);

    }

    public function recommendMembers(){
        $memberID = $this->session->userdata("member_id");
        $res = $this -> like_model -> recommendMembers($memberID);
        echo json_encode($res);
    }

    public function getNotifies(){
        $memberID = $this->session->userdata("member_id");
        $res = $this -> like_model -> getNotifies($memberID);
        $notices = $res["data"];

        foreach($notices as $key => $notice){
            $member = $this->member_model->getMember($notice -> member_id)->row_array();
            $notices[$key] -> avatar = $member["avatar"];
            $notices[$key] -> nickname = $member["nickname"];
        }
        $res["data"] = $notices;
        echo json_encode($res);
    }


    public function readNotifies(){
        $memberID = $this->session->userdata("member_id");
        $res = $this -> like_model -> readNotifies($memberID);
//        echo json_encode($res);
    }


    public function doLabel()
    {
        $member_id = $this->input->get_post('member_id');
        $id = $this->input->get_post('label');

        for($i=0;$i<count($id);$i++){
            $label = array('member_id' => $member_id, 'label' => $id[$i]);
            $this->db->insert('member_labels', $label);
        }
        redirect('page/info');
//        $label = array('member_id'=>'13');
//        $this->db->insert('member_labels', $label);
    }
}
