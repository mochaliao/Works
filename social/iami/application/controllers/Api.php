<?php

class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('member_helper');

        $this->load->model('trace_model');
        $this->load->model('post_model');
        $this->load->model('member_model');
        $this->load->model('like_model');
        $this->load->model('member_company_model');
        $this->load->model('member_school_model');
        $this->load->model('language_model');
        $this->load->model('country_model');
        $this->load->model('hot_model');
    }

    public function doLogin()
    {
//        ob_start();
//        print_r($_POST);
//        $content = ob_get_clean();

       // $content = file_get_contents("php://input");

        //file_put_contents("/var/www/html/iami/member_data/chat_files/ttt.txt", $content);

        header('Content-Type: application/json; charset=utf-8');
        $this->form_validation->set_rules('email', $this->lang->line('member_field_email'), 'trim|required|valid_email');
        $this->form_validation->set_rules('password', $this->lang->line('member_field_password'), 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $errors = explode("\r\n", strip_tags(validation_errors()));
            echo json_encode(array(
                "status" => "failed",
                "message" => strip_tags(validation_errors())
            ));
        } else {

            $email = trim($this->input->post('email'));
            $password = trim($this->input->post('password'));
            $member = $this->member_model->getMemberByEmail($email)->row_array();
            if (!empty($member)) {

                if ($member['status'] == -1) {
                    echo json_encode(array(
                        "status" => "failed",
                        "message" => $this->lang->line('member_disabled')
                    ));
                    exit;
                } elseif ($member['status'] == 2) {
                    echo json_encode(array(
                        "status" => "failed",
                        "message" => $this->lang->line('member_not_activated')
                    ));
                    exit;
                }

                if (md5($password) !== $member['password']) {
                    echo json_encode(array(
                        "status" => "failed",
                        "message" => "account or password not found"
                    ));
                } else {
                    $member["token_expired"] = date("Y-m-d H:i:s", strtotime("+1 hour"));
                    $token = $this -> getToken($member);

                    $member["token"] = $token;
                    echo json_encode(array(
                        "status" => "success",
                        "message" => "success",
                        "data" => $member
                    ));
                }

            } else {
                echo json_encode(array(
                    "status" => "failed",
                    "message" => "account or password not found"
                ));
            }
        }

    }

    public function doLogin2()
    {
        ob_start();
        print_r($_GET);
        $content = ob_get_clean();

        //file_put_contents("/var/www/html/iami/member_data/chat_files/ttt2.txt", $content);

        header('Content-Type: application/json; charset=utf-8');

        //$this->form_validation->set_rules('email', $this->lang->line('member_field_email'), 'trim|required|valid_email');
       // $this->form_validation->set_rules('password', $this->lang->line('member_field_password'), 'trim|required');

        if (false && $this->form_validation->run() == FALSE) {
            $errors = explode("\r\n", strip_tags(validation_errors()));
            echo json_encode(array(
                "status" => "failed",
                "message" => strip_tags(validation_errors())
            ));
        } else {

            $email = trim($this->input->get('email'));
            $password = trim($this->input->get('password'));
            $member = $this->member_model->getMemberByEmail($email)->row_array();
            if (!empty($member)) {
                if (md5($password) !== $member['password']) {
                    echo json_encode(array(
                        "status" => "failed",
                        "message" => "account or password not found"
                    ));
                } else {
                    $member["token_expired"] = date("Y-m-d H:i:s", strtotime("+1 hour"));
                    $token = $this -> getToken($member);

                    $member["token"] = $token;
                    echo json_encode(array(
                        "status" => "success",
                        "message" => "success",
                        "data" => $member
                    ));
                }

            } else {
                echo json_encode(array(
                    "status" => "failed",
                    "message" => "account or password not found"
                ));
            }
        }

    }

    public function isTokenExpired(){
         
    }

    public function doLogout()
    {
        $this->session->unset_userdata('__ci_last_regenerate');
        $this->session->unset_userdata('member_id');
        $this->session->unset_userdata('email');

        echo json_encode(array(
            "status" => "success",
            "message" => "success"
        ));


    }

    public function get_csrf_token()
    {
        echo json_encode(array(
            "status" => "success",
            "message" => "",
            "code" => "",
            "data" => array(
                "token" => $this->security->get_csrf_hash(),
                "name" => $this->security->get_csrf_token_name()
            )
        ));
    }

    public function getToken($member){
        $json = $member;
        if(!is_string($member)){
            $json = json_encode($member);
        }
        return base64_encode(base64_encode($json));
    }


/**
     * 註冊會員
     *
     * @param varchar(50) email (電子郵箱, post欄位, 必填)
     * @param varchar(64) password (密碼, post欄位, 必填)
     * @param varchar(64) repassword (確認密碼, post欄位, 必填)
     * @param varchar(64) nickname (匿稱, post欄位, 必填)
     * @param varchar(1) gender (確認密碼, post欄位, 必填)
     * @param varchar(20) mobile (手機號, post欄位, 必填)
     * @param date birth (生日, post欄位, 必填)
     * @param varchar(64) language_id (語系english/zh-TW/zh-CN, post欄位, 必填)
     * @return json 結果 (status: success|failed, message: 訊息, code: 錯誤代碼, data: member_id )
     */
    public function doRegister()
    {
        $member = $this->input->post();
        /*$member['email'] = 'shiefu2@gmail.com';
        $member['password'] = 'no0818';
        $member['repassword'] = 'no0818';
        $member['nickname'] = 'Jeff2';
        $member['gender'] = 'M';
        $member['mobile'] = '123456789';
        $member['birth'] = '1975-08-18';
        $member['language_id'] = 'zh-TW';*/
        $check_result = check_member_register($member);
        if ($check_result['status'] === 'success') {
            unset($member['repassword']);
            $member['gender'] = strtoupper($member['gender']);
            $member['language_id'] = get_language_id($member['language_id']);
            $active_auth = generate_random_string(100);
            $member['active_auth'] = $active_auth;
            $member['status'] = 2;

            $result = $this->member_model->addMember($member);

            $params = array();
            $sql2 = "SELECT * FROM members WHERE email = ?";
            array_push($params, $member['email']);
            $result2 = $this->db->query($sql2, $params)->result();
            $member_id = $result2[0]->member_id;

            $sender = $member['email'];
            $subject = "註冊成功啟用信";
            $time_token = base64_encode(time());
            $content = "請點擊以下網址以啟動驗證(此連結有效時間為24h)  <a href=".$_SERVER['HTTP_HOST']."/member/RegisterSuccess?member_id=$member_id&key=$active_auth&time_token=$time_token>請點擊此連結進行認證</a>";
            send_mail($sender, $subject, $content);

            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode($check_result, JSON_UNESCAPED_UNICODE);
        }
    }

    public function doForget()
    {
        $email = $this->input->get('email');
        $email_error = "";
        if(trim($email) == ""){
            $email_error = $this->lang->line('member_email_not_input');
        }
        else{
            // 依信箱取得會員資訊
            $member = $this->member_model->getMemberByEmail($email)->row_array();
            if(is_null($member)){
                $email_error = $this->lang->line('member_email_not_exists');
            }
            else{
                $params = array();
                $sql2 = "SELECT * FROM members WHERE email = ?";
                array_push($params, $email);
                $result2 = $this->db->query($sql2, $params)->result();
                $member_id = $result2[0]->member_id;
                $active_auth = $result2[0]->active_auth;
//            $content = $this->lang->line('member_active_text');
//                $time_token = crypt(time());
                $time_token = base64_encode(time());
                $content = "請點擊以下網址以啟動驗證  <a href="."http://" . $_SERVER['HTTP_HOST'] . "/member/forgetPassword?member_id=$member_id&key=$active_auth&time_token=$time_token>請點擊此連結進行認證</a>";
                send_mail($member["email"], $this->lang->line('member_forget_email_subject'), $content);
            }
        }

        if($email_error != ""){
            echo json_encode(array(
                "status" => "failed",
                "message" => $email_error
            ));
        }
        else{
            echo json_encode(array(
                "status" => "success",
                "message" => ""
            ));
        }
    }

    public function doEditPassword(){

        if (!isLogin(FALSE)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }

        //原密碼規則
        $this->form_validation->set_rules('old_password', $this->lang->line('member_field_old_password'), 'trim|required|min_length[6]|max_length[32]|callback_check_old_password');
        //新密碼規則
        $this->form_validation->set_rules('new_password', $this->lang->line('member_field_new_password'), 'trim|required|min_length[6]|max_length[32]');
        //確認新密碼規則
        $this->form_validation->set_rules('confirm_new_password', $this->lang->line('member_field_confirm_new_password'), 'trim|required|min_length[6]|max_length[32]|matches[new_password]');

        if ($this->form_validation->run() == FALSE){
            echo json_encode(array(
                "status" => "failed",
                "message" => strip_tags(validation_errors())
            ));
        }else {
            $member = $this->input->post();
            $m['member_id'] = $this->session->userdata('member_id');
            $m['password'] = $member['new_password'];
            $m['modify_time'] = date('Y-m-d H:i:s');
            $result = $this->member_model->editMember($m);
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }
    }

    public function doEditPassword2(){



        if (!isLogin(FALSE)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }

        $this->form_validation->set_data($this->input->get());

        //原密碼規則
        $this->form_validation->set_rules('old_password', $this->lang->line('member_field_old_password'), 'trim|required|min_length[6]|max_length[32]|callback_check_old_password');
        //新密碼規則
        $this->form_validation->set_rules('new_password', $this->lang->line('member_field_new_password'), 'trim|required|min_length[6]|max_length[32]');
        //確認新密碼規則
        $this->form_validation->set_rules('confirm_new_password', $this->lang->line('member_field_confirm_new_password'), 'trim|required|min_length[6]|max_length[32]|matches[new_password]');

        if (false && $this->form_validation->run() == FALSE){
            echo json_encode(array(
                "status" => "failed",
                "message" => strip_tags(validation_errors())
            ));
        }else {
            $member = $this->input->get();
            $m['member_id'] = $this->session->userdata('member_id');
            $m['password'] = $member['new_password'];
            $m['modify_time'] = date('Y-m-d H:i:s');
            $result = $this->member_model->editMember($m);
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }
    }

    //==================================================================================================================
    //檢查舊密碼是否相符
    //==================================================================================================================
    public function check_old_password($old_password)
    {
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

    public function editMember()
    {

        ob_start();
        print_r($_POST);
        $content = ob_get_clean();
        //file_put_contents("/var/www/html/iami/member_data/chat_files/editMember.txt", $content);

        if (!isLogin(FALSE)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }

        $this->load->library('form_validation');
        $this -> load -> model("member_company_model");
        $this -> load -> model("member_school_model");
        //帳號規則
        //$this->form_validation->set_rules('memberid', $this->lang->line('member_field_memberid'), 'trim|required|min_length[2]|max_length[32]|alpha_dash|regex_match[/^[A-Za-z]/]|is_unique[member.memberid]');
        //密碼規則
        //$this->form_validation->set_rules('password', $this->lang->line('member_field_password'), 'trim|required|min_length[6]|max_length[32]');
        //確認密碼規則
        //$this->form_validation->set_rules('repassword', $this->lang->line('member_field_repassword'), 'trim|required|min_length[6]|max_length[32]|matches[password]');
        //電子信箱規則
        //$this->form_validation->set_rules('email', $this->lang->line('member_field_email'), 'trim|required|valid_email|is_unique[member.email]');
        //匿稱規則
        $this->form_validation->set_rules('nickname', $this->lang->line('member_field_nickname'), 'trim|max_length[100]');
        //個人簡歷規則
        $this->form_validation->set_rules('resume', $this->lang->line('member_field_resume'), 'trim|max_length[1024]');
        //手機規則
        $this->form_validation->set_rules('mobile', $this->lang->line('member_field_mobile'), 'trim|max_length[20]|regex_match[/^[0-9\+-]+$/]');
        //生日規則
        $this->form_validation->set_rules('birth', $this->lang->line('member_field_birth'), 'trim|min_length[10]|max_length[10]|regex_match[/^[0-9]{4}-[01][0-9]-[0-3][0-9]$/]');
        //居住城市
        $this->form_validation->set_rules('city', $this->lang->line('member_field_city'), 'trim|max_length[32]');

        if ($this->form_validation->run() == FALSE){
            echo json_encode(array(
                "status" => "failed",
                "message" => strip_tags(validation_errors())
            ));
        }else{
            $member = $this->input->post();
            unset($member["token"]);
            // $this->session->set_userdata('member_id', 1);
            $member['member_id'] = $this->session->userdata('member_id');

            $companys = array();
            if(isset($member["company"]) && count($member["company"]) > 0){

                for ($i = 0 ; $i < sizeof($member['company']); $i++){
                    if (trim($member['company'][$i]) != '' || trim($member['position'][$i])){
                        $company['member_id'] = $member['member_id'];
                        $company['company'] = $member['company'][$i];
                        $company['position'] = $member['position'][$i];
                        $company['create_time'] = date('Y-m-d H:i:s');
                        array_push($companys, $company);
                    }
                }
            }

            $schools = array();
            if(isset($member["school"]) && count($member["school"]) > 0){

                for ($i = 0 ; $i < sizeof($member['school']); $i++){
                    if (trim($member['school'][$i]) != '' || trim($member['department'][$i])) {
                        $school['member_id'] = $member['member_id'];
                        $school['school'] = $member['school'][$i];
                        $school['department'] = $member['department'][$i];
                        $school['create_time'] = date('Y-m-d H:i:s');
                        array_push($schools, $school);
                    }
                }
            }

            //進行交易
            $this->db->trans_start();
            //更新任職公司、職稱
            $result = $this->member_company_model->editMemberCompany($this->session->userdata('member_id'), $companys);
            if ($result['status'] == 'failed'){
                $this->db->trans_rollback();
                die($result);
            }
            unset($member['company']);
            unset($member['position']);
            //更新學校、科系
            $result = $this->member_school_model->editMemberSchool($this->session->userdata('member_id'), $schools);
            if ($result['status'] == 'failed'){
                $this->db->trans_rollback();
                die($result);
            }
            unset($member['school']);
            unset($member['department']);
            //更新會員
            foreach($member as $key => $value){
                if (is_string($value) && trim($value) == ''){
                    unset($member[$key]);
                }
            }
            $member['modify_time'] = date('Y-m-d H:i:s');

            if(isset($member["info_show"])){
                $member["info_show"] = json_encode($member["info_show"]);
            }
            if(isset($member["relationship"])){
                if(!in_array($member["relationship"],["married","devorce","dating","single"])){//防止随意传入造成读取的时候报错
                    unset($member["relationship"]);
                }
            }

            $result = $this->member_model->editMember($member);
            if ($result['status'] == 'failed'){
                $this->db->trans_rollback();
                die($result);
            }
            $this->db->trans_complete();

            echo json_encode(array(
                "status" => "success",
                "message" => ""
            ));
        }
    }

    public function editMember2()
    {

        ob_start();
        print_r($_POST);
        $content = ob_get_clean();
        //file_put_contents("/var/www/html/iami/member_data/chat_files/editMember2.txt", $content);

        if (!isLogin(FALSE)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }

        $this->load->library('form_validation');
        $this -> load -> model("member_company_model");
        $this -> load -> model("member_school_model");

        $this->form_validation->set_data($this->input->get());
        //帳號規則
        //$this->form_validation->set_rules('memberid', $this->lang->line('member_field_memberid'), 'trim|required|min_length[2]|max_length[32]|alpha_dash|regex_match[/^[A-Za-z]/]|is_unique[member.memberid]');
        //密碼規則
        //$this->form_validation->set_rules('password', $this->lang->line('member_field_password'), 'trim|required|min_length[6]|max_length[32]');
        //確認密碼規則
        //$this->form_validation->set_rules('repassword', $this->lang->line('member_field_repassword'), 'trim|required|min_length[6]|max_length[32]|matches[password]');
        //電子信箱規則
        //$this->form_validation->set_rules('email', $this->lang->line('member_field_email'), 'trim|required|valid_email|is_unique[member.email]');
        //匿稱規則
        $this->form_validation->set_rules('nickname', $this->lang->line('member_field_nickname'), 'trim|max_length[100]');
        //個人簡歷規則
        $this->form_validation->set_rules('resume', $this->lang->line('member_field_resume'), 'trim|max_length[1024]');
        //手機規則
        $this->form_validation->set_rules('mobile', $this->lang->line('member_field_mobile'), 'trim|max_length[20]|regex_match[/^[0-9\+-]+$/]');
        //生日規則
        $this->form_validation->set_rules('birth', $this->lang->line('member_field_birth'), 'trim|min_length[10]|max_length[10]|regex_match[/^[0-9]{4}-[01][0-9]-[0-3][0-9]$/]');
        //居住城市
        $this->form_validation->set_rules('city', $this->lang->line('member_field_city'), 'trim|max_length[32]');

        if (false && $this->form_validation->run() == FALSE){
            echo json_encode(array(
                "status" => "failed",
                "message" => strip_tags(validation_errors())
            ));
        }else{
            $member = $this->input->get();
            unset($member["token"]);
            // $this->session->set_userdata('member_id', 1);
            $member['member_id'] = $this->session->userdata('member_id');

            $companys = array();
            if(isset($member["company"]) && count($member["company"]) > 0){

                for ($i = 0 ; $i < sizeof($member['company']); $i++){
                    if (trim($member['company'][$i]) != '' || trim($member['position'][$i])){
                        $company['member_id'] = $member['member_id'];
                        $company['company'] = $member['company'][$i];
                        $company['position'] = $member['position'][$i];
                        $company['create_time'] = date('Y-m-d H:i:s');
                        array_push($companys, $company);
                    }
                }
            }

            $schools = array();
            if(isset($member["school"]) && count($member["school"]) > 0){

                for ($i = 0 ; $i < sizeof($member['school']); $i++){
                    if (trim($member['school'][$i]) != '' || trim($member['department'][$i])) {
                        $school['member_id'] = $member['member_id'];
                        $school['school'] = $member['school'][$i];
                        $school['department'] = $member['department'][$i];
                        $school['create_time'] = date('Y-m-d H:i:s');
                        array_push($schools, $school);
                    }
                }
            }

            //進行交易
            $this->db->trans_start();
            //更新任職公司、職稱
            $result = $this->member_company_model->editMemberCompany($this->session->userdata('member_id'), $companys);
            if ($result['status'] == 'failed'){
                $this->db->trans_rollback();
                die($result);
            }
            unset($member['company']);
            unset($member['position']);
            //更新學校、科系
            $result = $this->member_school_model->editMemberSchool($this->session->userdata('member_id'), $schools);
            if ($result['status'] == 'failed'){
                $this->db->trans_rollback();
                die($result);
            }
            unset($member['school']);
            unset($member['department']);
            //更新會員
            foreach($member as $key => $value){
                if (trim($value) == ''){
                    unset($member[$key]);
                }
            }
            $member['modify_time'] = date('Y-m-d H:i:s');
            $result = $this->member_model->editMember($member);
            if ($result['status'] == 'failed'){
                $this->db->trans_rollback();
                die($result);
            }
            $this->db->trans_complete();

            echo json_encode(array(
                "status" => "success",
                "message" => ""
            ));
        }
    }

    public function hot_post(){

        if (!isLogin(FALSE)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }

        $member_id = $this->session->userdata("member_id");




        $page = $this->input->get_post('page');
        // $start = $this->input->get_post('start');
        $perPage = $this->input->get_post('perPage');

        // $member_id = $this->session->userdata('member_id');
        // $member_id = $this->input->get_post('member_id');
// $member_id = 2;
        /*積分點數設定*/
        $mulThumb = $this->input->get_post('mulThumb');
        $mulComments = $this->input->get_post('mulComments');
        $mulShare = $this->input->get_post('mulShare');


        if(!isset($page)){
            $page=1;
        }
        if(!isset($perPage)){
            $perPage=10;
        }

        if(!isset($mulThumb)){
            $mulThumb = 1;
        }
        if(!isset($mulComments)){
            $mulComments = 5;
        }
        if(!isset($mulShare)){
            $mulShare = 10;
        }


        if(!isset($member_id)){
            $member_id = 'NULL';
        }

        $start = ($page-1)*$perPage;


        $this->load->model('hot_model');
        $posts = $this->hot_model->getPost($member_id, $start, $perPage, $mulThumb, $mulComments, $mulShare);

        echo json_encode($posts,JSON_UNESCAPED_UNICODE);
        // $this->load->view('hot_post', $data);

    }

    public function hot_video()
    {

        if (!isLogin(FALSE)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }


        // $start = $this->input->get_post('start');
        $perPage = $this->input->get_post('perPage');
        $page = $this->input->get_post('page');
        $start = ($page-1)*$perPage;

        $member_id = $this->session->userdata('member_id');
        // $member_id = $this->input->get_post('member_id');

        /*積分點數設定*/
        $mulThumb = $this->input->get_post('mulThumb');
        $mulComments = $this->input->get_post('mulComments');
        $mulShare = $this->input->get_post('mulShare');


        if(!isset($page)){
            $page=1;
        }
        if(!isset($perPage)){
            $perPage=10;
        }

        if(!isset($mulThumb)){
            $mulThumb = 1;
        }
        if(!isset($mulComments)){
            $mulComments = 5;
        }
        if(!isset($mulShare)){
            $mulShare = 10;
        }

        if(!isset($member_id)){
            $member_id = 'NULL';
        }

        // $member_id = $this->session->userdata('member_id');
        $vedios = $this->hot_model->getVideo($member_id, $start, $perPage*1, $mulThumb, $mulComments, $mulShare);

        echo json_encode($vedios);
    }

    public function notifies(){

        if (!isLogin(FALSE)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }

        $memberID = $this->session->userdata("member_id");
        $datas = $this -> like_model -> getNotifies($memberID , 100);

        foreach($datas["data"] as $key => $data){
            $member = $this -> member_model -> getMember($data -> member_id) -> row_array();
            $datas["data"][$key] -> member = $member;

        }
        echo json_encode( $datas);
    }

    public function invite_notifies(){

        if (!isLogin(FALSE)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }

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

        echo json_encode(array(
            "status" => "success",
            "message" => "",
            "code" => "",
            "data" => $members
        ));
    }

    public function message_notifies(){

        if (!isLogin(FALSE)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }

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

        echo json_encode(array(
            "status" => "success",
            "message" => "",
            "code" => "",
            "data" => $array
        ));

    }

    public function movie5s(){
        if (!isLogin(FALSE)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }

        $this->load->model('fivesec_model');
        $movies = $this -> fivesec_model -> getMovieList();

        echo json_encode(array(
            "status" => "success",
            "message" => "",
            "code" => "",
            "data" => $movies
        ));
    }

    public function getCountries(){
        if (!isLogin(FALSE)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }

        $countrys = $this->country_model->getCountry()->result_array();

        echo json_encode(array(
            "status" => "success",
            "message" => "",
            "code" => "",
            "data" => $countrys
        ));
    }

    public function getInfo(){
        if (!isLogin(FALSE)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }

        if (!empty($this->input->get_post('member_id'))) {
            $memberID = $this->input->get_post('member_id');
        } else {
            $memberID = $this->session->userdata('member_id');
        }

        $postCount = $this -> post_model -> getPostCount($memberID);
        $collectCount = $this -> post_model -> getCollectionCount($memberID);
        $traceCount = $this -> trace_model -> getTraceCount($memberID);
        $fansCount = $this -> trace_model -> getFansCount($memberID);

        echo json_encode(array(
                'status' => 'success',
                'message' => '',
                'code' => '',
                'data' => array(
                    "postCount" => $postCount,
                    "collectCount" => $collectCount,
                    "traceCount" => $traceCount,
                    "fansCount" => $fansCount
                )
        ));
    }

    public function getLabels(){

        if (!isLogin(FALSE)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }

        if (!empty($this->input->get_post('member_id'))) {
            $memberID = $this->input->get_post('member_id');
        } else {
            $memberID = $this->session->userdata('member_id');
        }

        $this->load->model('label_model');
        $labels = $this-> label_model ->getLabel($memberID)->result();

        echo json_encode(array(
            'status' => 'success',
            'message' => '',
            'code' => '',
            'data' => $labels
        ));

    }

    public function getAllLabels(){


        if (!isLogin(FALSE)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }


        $this->load->model('label_model');
        $labels = $this-> label_model ->getLabelAll(0)->result();

        foreach($labels as $label){
            $label->labelname=$this->lang->line( $label->labelname);
        }

        echo json_encode(array(
            'status' => 'success',
            'message' => '',
            'code' => '',
            'data' => $labels
        ));

    }

    public function doLabel()
    {
        if (!isLogin(FALSE)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }

        $id = $this->input->get_post('label');
        $count=count(isset($id)?$id:[]);
        if($count>10){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('label_limit_ten'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }

        $this->db->trans_start();
        $memberID = $this->session->userdata('member_id');
        $this->load->model('label_model');

        if( !$this->label_model->delLabels($memberID)){
            $this->db->trans_rollback();
            echo json_encode(array(
                'status' => 'failed'
            ));
            exit;
        }

        for($i=0;$i<$count;$i++){
            $label = array('member_id' => $memberID, 'label' => $id[$i]);
            $this->db->insert('member_labels', $label);
        }

        $this->db->trans_complete();

        echo json_encode(array(
            'status' => 'success',
            'message' => '',
            'code' => ''
        ));

    }

    public function getLanguages(){
        $langCode = empty($this -> input -> get("lang"))?"zh-CN":$this -> input -> get("lang");

        header('Content-Type: application/json; charset=utf-8');

        $languagePath = BASEPATH . "../application/language/" . $langCode;

        if(!file_exists($languagePath)){
            echo json_encode(array(
                'status' => 'failed',
                'message' => 'Language is not found!',
                'code' => 'LG0001'
            ));
            return ;
        }

        $languageFiles = scandir($languagePath);
        foreach($languageFiles as $file){
            if(in_array($file, array(".",".."))){
                continue;
            }
            include($languagePath . "/" . $file);
        }

        echo json_encode([  'status' => 'success',
                            'message' => '',
                            'code' => '',
                            'data'=>$lang], JSON_UNESCAPED_UNICODE);
        /*
        foreach($lang as $key => $l){
            echo $key . "=" . $l . "\r\n";
        }
        */
        // print_r($lang);
    }

    public  function  readChatMsg(){

        if (!isLogin(FALSE)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }

        $ChatUnit = $this->input->get_post('member_id');
        if(empty($ChatUnit)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_id_empty'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }

        $this->load->model('Chat_Model','CM');
        $data['update_is_read'] = $this->CM->update_is_read($ChatUnit,$this->session->userdata('member_id'));

        echo json_encode(array(
            'status' => 'success',
            'message' => '',
            'code' => ''
        ));
    }
}
