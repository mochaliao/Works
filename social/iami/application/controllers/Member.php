<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('member_model');
        $this->load->model('member_company_model');
        $this->load->model('member_school_model');
        $this->load->model('language_model');
        $this->load->model('country_model');
        $this->load->model('money_model');
        $this->load->library('form_validation');
        $this->load->model('friend_model');
        /*$this->load->library('email');
        $email_config['protocol'] = 'smtp';
        $email_config['smtp_host'] = 'ssl://smtp.gmail.com';
        $email_config['smtp_port'] = '465';
        $email_config['charset'] = 'utf-8';
        $email_config['mailtype'] = 'html';
        $email_config['validate'] = TRUE;
        $email_config['priority'] = 1;
        $this->email->initialize($email_config);*/
        /*if (empty($this->session->userdata('language_id'))){
            $language_id = get_browser_language();
            $this->config->set_item('language', $language_id);
            $this->session->set_userdata('language_id', $language_id);
        }*/
    }

    //==================================================================================================================
    //顯示登入頁
    //==================================================================================================================
    public function showLogin($data = array())
    {
        if (!empty($this->session->userdata("member_id"))) {
            redirect('/page/main');
        }
        if (empty($this->session->userdata('language_id'))) {
            $language_id = get_browser_language();
            $this->config->set_item('language', $language_id);
            $this->session->set_userdata('language_id', $language_id);
        }
        if (!isset($data["login_success"])) {
            $data["login_success"] = "";
        }
        $data['show_type'] = 'login';
        $this->load->model('fivesec_model');
        $data["movies"] = $this->fivesec_model->getMovieList();
        $this->load->view('member_login_view', $data, 'refresh');
        //沒有記得我(沒cookie)
        /*if (empty(get_cookie('member_id')) || empty(get_cookie('email'))){
            //已登入過
            if ( ! empty($this->session->userdata('member_id')) && ! empty($this->session->userdata('email')) && ! empty($this->session->userdata('language_id'))){
                redirect('/page/main');
            }
            //未登入過
            else{
                if (empty($this->session->userdata('language_id'))){
                    $language_id = get_browser_language();
                    $this->session->set_userdata('language_id', $language_id);
                }
                $data['show_type'] = 'login';
                $this->load->view('member_login_view', $data);
            }
        }
        //有記住我(有cookie)
        else{
            $this->session->userdata('member_id', get_cookie('member_id'));
            $this->session->userdata('email', get_cookie('email'));
            $this->session->userdata('nickname', get_cookie('nickname'));
            $this->session->userdata('language_id', get_cookie('language_id'));
            $this->session->userdata('avatar', get_cookie('avatar'));
            $this->session->userdata('banner', get_cookie('banner'));
            $this->session->userdata('status', get_cookie('status'));
            redirect('/page/main');
        }*/
    }

    //==================================================================================================================
    //進行登入
    //==================================================================================================================
    public function doLogin()
    {
        if (!empty($this->session->userdata("member_id"))) {
            redirect('/page/main');
        }

        $this->form_validation->set_rules('login_email', $this->lang->line('member_field_email'), 'trim|required|valid_email|callback_email_check');
        $this->form_validation->set_rules('login_password', $this->lang->line('member_field_password'), 'trim|required|callback_password_check');


        if ($this->form_validation->run() == FALSE) {
            $this->load->model('fivesec_model');
            $data["movies"] = $this->fivesec_model->getMovieList();
            $this->load->view('member_login_view', $data);
        } else {

            $email = trim($this->input->get_post('login_email'));
            $captcha = $this->input->get_post('captcha');
            $captcha2 = $this->input->get_post('captcha2');
            if ($captcha == $captcha2) {
                $member = $this->member_model->getMemberByEmail($email)->row_array();
                //會員餘額
                if ($this->money_model->getMoney($member['member_id'])->num_rows() > 0) {
                    $money = $this->money_model->getMoney($member['member_id'])->row_array();
                    $balance = $money['points'];
                } else {
                    $balance = 0;
                }
                $this->session->set_userdata(
                    array(
                        'member_id' => $member['member_id'],
                        'email' => $member['email'],
                        'nickname' => $member['nickname'],
                        'language_id' => $member['language_id'],
                        'avatar' => $member['avatar'],
                        'banner' => $member['banner'],
                        'status' => $member['status'],
                        'balance' => $balance
                    )
                );
                $m['member_id'] = $member['member_id'];
                $m['isOnline'] = 1;
                $m['last_login_time'] = date('Y-m-d H:i:s');
                $this->member_model->editMember($m);

                $friends = $this->friend_model->getFriendList($member['member_id'],NULL,NULL,1)->result_array();
                $member['isOnline']=1;
                foreach($friends as $friend){
                    push_data($friend['member_id'], array(["online"=>array($member)]));
                }

                //記住我
                $remember_me = trim($this->input->get_post('remember_me'));
                if (!empty($remember_me)) {
                    set_cookie('member_id', $this->session->userdata('member_id'));
                    set_cookie('email', $this->session->userdata('email'));
                    set_cookie('nickname', $this->session->userdata('nickname'));
                    set_cookie('language_id', $this->session->userdata('language_id'));
                    set_cookie('avatar', $this->session->userdata('avatar'));
                    set_cookie('banner', $this->session->userdata('banner'));
                    set_cookie('status', $this->session->userdata('status'));
                    set_cookie('balance', $this->session->userdata('balance'));
                }
                $this->session->set_userdata('language_id', $member['language_id']);

            }
            redirect('/page/main');
        }
    }

    //==================================================================================================================
    //email檢查
    //==================================================================================================================
    public function email_check($email)
    {
        $email = trim($email);
        $password = trim($this->input->get_post('login_password'));
        $member = $this->member_model->getMemberByEmail($email)->row_array();
        if (!empty($this->member_model->getMemberByEmail($email)->row_array())) {
            if (md5($password) === $member['password']) {
                if ($member['status'] == 1) {
                    return TRUE;
                } elseif ($member['status'] == -1) {
                    $this->form_validation->set_message('email_check', $this->lang->line('member_disabled'));
                    return FALSE;
                } elseif ($member['status'] == 2) {
                    $this->form_validation->set_message('email_check', $this->lang->line('member_not_activated'));
                    return FALSE;
                } else {
                    $this->form_validation->set_message('email_check', $this->lang->line('member_unexpected_error'));
                    return FALSE;
                }
            } else {
                return TRUE;
            }
        } elseif ($email != '') {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->form_validation->set_message('email_check', $this->lang->line('member_email_not_exists'));
                return FALSE;
            } else {
                $this->form_validation->set_message('email_check', $this->lang->line('member_email_format_error'));
                return FALSE;
            }
        } else {
            return TRUE;
        }
    }

    //==================================================================================================================
    //密碼檢查
    //==================================================================================================================
    public function password_check($password)
    {
        $email = trim($this->input->get_post('login_email'));
        $password = trim($password);
        $member = $this->member_model->getMemberByEmail($email)->row_array();
        if (!empty($member)) {
            if (md5($password) !== $member['password']) {
                $this->form_validation->set_message('password_check', $this->lang->line('member_password_incorrect'));
                return FALSE;
            } else {
                return TRUE;
            }

        } else {
            return TRUE;
        }
    }

    //==================================================================================================================
    //進行登出
    //==================================================================================================================
    public function doLogout()
    {
        $m['member_id'] =$this->session->userdata("member_id");
        $m['isOnline'] = 0;
        $this->member_model->editMember($m);

        $friends = $this->friend_model->getFriendList($m['member_id'])->result_array();
        foreach($friends as $friend){
            push_data($friend['member_id'], array(["online"=>array($m)]));
        }

        //$this->session->sess_destroy();
        $this->session->userdata = array();
        delete_cookie('member_id');
        delete_cookie('email');
        delete_cookie('nickname');
        delete_cookie('language_id');
        delete_cookie('avatar');
        delete_cookie('banner');
        delete_cookie('status');

//        $this->showLogin();
        redirect('/member/showLogin');
    }

    //==================================================================================================================
    //顯示註冊頁
    //==================================================================================================================
    public function showRegister($errorReturn=false)
    {
        $data['show_type'] = 'register';
        $languages = $this->language_model->getLanguage()->result_array();
        $data['languages'] = $languages;

        if($errorReturn){
            $data['errorTag'] = true;
        }

        $this->load->model('fivesec_model');
        $data["movies"] = $this->fivesec_model->getMovieList();
        $this->load->view('member_login_view', $data);
    }

    //==================================================================================================================
    //進行註冊
    //==================================================================================================================
    public function doRegister()
    {
        //帳號規則
        //$this->form_validation->set_rules('memberid', $this->lang->line('member_field_memberid'), 'trim|required|min_length[2]|max_length[32]|alpha_dash|regex_match[/^[A-Za-z]/]|is_unique[member.memberid]');
        //電子信箱規則
        $this->form_validation->set_rules('email', $this->lang->line('member_field_email'), 'trim|required|valid_email|is_unique[members.email]');
//        $this->form_validation->set_rules('email', $this->lang->line('member_field_email'), 'trim|required|valid_email');
//        //密碼規則
//        $this->form_validation->set_rules('password', $this->lang->line('member_field_password'), 'trim|required|min_length[6]|max_length[32]');
//        //確認密碼規則
//        $this->form_validation->set_rules('repassword', $this->lang->line('member_field_repassword'), 'trim|required|min_length[6]|max_length[32]|matches[password]');
        //密碼規則
        $this->form_validation->set_rules('password', $this->lang->line('member_field_password'), 'trim|required|min_length[6]|max_length[12]|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,32}$/]');
        //確認密碼規則
        $this->form_validation->set_rules('repassword', $this->lang->line('member_field_repassword'), 'trim|required|min_length[6]|max_length[12]|matches[password]|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,32}$/]');

        //匿稱規則
        $this->form_validation->set_rules('nickname', $this->lang->line('member_field_nickname'), 'trim|required|max_length[100]|gb_max_length[10]|sensitive['.$this->session->userdata('language_id').']');
        //性別規則
        $this->form_validation->set_rules('gender', $this->lang->line('member_field_gender'), 'trim|required|max_length[1]');
        //手機規則
        $this->form_validation->set_rules('mobile', $this->lang->line('member_field_mobile'), 'trim|required|min_length[10]|max_length[20]|regex_match[/^[0-9\+-]+$/]|is_unique[members.mobile]');
        //生日規則
        $this->form_validation->set_rules('birth', $this->lang->line('member_field_birth'), 'trim|required|min_length[10]|max_length[10]|regex_match[/^[0-9]{4}-[01][0-9]-[0-3][0-9]$/]');
        //使用語言規則
        //$this->form_validation->set_rules('language_id', $this->lang->line('member_field_language_id'), 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->showRegister(true);
        } else {

            $member = $this->input->post();


            unset($member['repassword']);
            $member['language_id'] = $this->session->userdata('language_id');
            $active_auth = generate_random_string(100);
            $member['active_auth'] = $active_auth;
            $member['status'] = 2;
            $result = $this->member_model->addMember($member);


            //add
            $member['key'] = $member['active_auth'];
            $params = array();
            $sql2 = "SELECT * FROM members WHERE email = ?";
            array_push($params, $member['email']);
            $result2 = $this->db->query($sql2, $params)->result();
            $member_id = $result2[0]->member_id;
            $active_auth = $result2[0]->active_auth;

            $sender = $member['email'];
            $subject = "註冊成功啟用信";
//            $content = $this->lang->line('member_active_text');
//            $content = "請點擊以下網址以啟動驗證  ".get_domain()."/member/RegisterSuccess?member_id=$member_id&key=$active_auth";
//            $time_token = crypt(time());
            $time_token = base64_encode(time());
            $content = "請點擊以下網址以啟動驗證  <a href="."http://" . $_SERVER['HTTP_HOST'] . "/member/RegisterSuccess?member_id=$member_id&key=$active_auth&time_token=$time_token>請點擊此連結進行認證</a>";
            send_mail($sender, $subject, $content);
//            $this->sendmail2($sender, $subject, $content);
            //add_end

            if (strtolower($result['status']) == 'success') {
                // redirect('/page/main');

                // 每個註冊進來的都要自動追蹤 Iami 官方帳號
                $this->load->model('trace_model');
                $memberID = $result['data'];
                $this->trace_model->addTrace($memberID, 1);

                $this->showLogin(array("login_success" => $this->lang->line('member_register_success')));
            } else {
                $this->form_validation->set_message('email', $result['message']);
                $this->showRegister();
            }
        }
    }

    public function RegisterSuccess()
    {
        $member_id = $this->input->get('member_id');
        $key = $this->input->get('key');
        $time_token = base64_decode($this->input->get('time_token'));
        $time_token_auth = time();

        if (($time_token_auth - $time_token) < 86400) {
            $params = array();
            $sql = "SELECT * FROM members WHERE member_id = ?";
            array_push($params, $member_id);
            $result = $this->db->query($sql, $params)->result();
            $member_id_sql = $result[0]->member_id;
            $key_sql = $result[0]->active_auth;
            if ($member_id_sql == $member_id && $key_sql == $key) {
                $data = array('status' => '1');
                $this->db->where('member_id', $member_id);
                $this->db->update('members', $data);
            }
//            redirect('/');
            $data['show_type'] = 'registersuccess';
            $this->load->model('fivesec_model');
            $data["movies"] = $this->fivesec_model->getMovieList();
            $this->load->view('member_login_view', $data);
        } else {
            //註冊失敗
            redirect('/');
        }
    }


    //===========================================================================================================
    //發驗證信
    //===========================================================================================================
//    public function sendActiveInfo()
//    {
//
//    }


    //==================================================================================================================
    //發啟用信
    //==================================================================================================================
    public function sendActiveEmail($email = 'shiefu@gmail.com')
    {
        $member = $this->member_model->getMemberByEmail($email)->row_array();
        if (!empty($member)) {
            $patterns = array();
            $patterns['site_name'] = '/{site_name}/';
            $patterns['nickname'] = '/{nickname}/';
            $patterns['link'] = '/{link}/';
            $replacements = array();
            $replacements['site_name'] = SITE_NAME;
            $replacements['nickname'] = $member['nickname'];
            $replacements['link'] = base_url() . '/member/doActive';
            $message = $this->lang->line('member_active_text');
            $message = preg_replace($patterns, $replacements, $message);
            $this->email->from('webmaster@iami.com', SITE_NAME);
            $this->email->to($email);
            $this->email->subject($this->lang->line('member_email_subject'));
            $this->email->message($message);
            if ($this->email->send()) {
                $result = array('status' => 'success', 'message' => '成功', 'code' => '');
                var_dump($result);
                return $result;
            } else {
                $result = array('status' => 'failed', 'message' => '傳送失敗', 'code' => '');
                var_dump($result);
                return $result;
            }
        } else {
            $result = array('status' => 'failed', 'message' => 'email不存在', 'code' => '');
            var_dump($result);
            return $result;
        }
    }

    //==================================================================================================================
    //啟用會員
    //==================================================================================================================
    public function doActive()
    {
        $email = strtolower(trim($this->input->post_get('email')));
        $active_auth = trim($this->input->post_get('active_auth'));
        $member = $this->member_model->getMemberByEmail($email)->row_array();
        //啟用成功
        if (strtolower($member['email']) == $email && $member['active_auth'] === $active_auth) {
            $m['member_id'] = $member['member_id'];
            $m['status'] = 1;
            $result = $this->member_model->editMember($m);
            if (strtolower($result['status']) == 'success') {

            } else {

            }
        } //啟用失敗
        else {

        }
    }

    //==================================================================================================================
    //顯示忘記密碼頁
    //==================================================================================================================
    public function showForget($data = array())
    {
        $data['show_type'] = 'forget';
        $this->load->model('fivesec_model');
        $data["movies"] = $this->fivesec_model->getMovieList();
        $this->load->view('member_login_view', $data);
    }

    //==================================================================================================================
    //顯示忘記密碼已傳送頁
    //==================================================================================================================
    public function showForgetSend()
    {
        $data['show_type'] = 'forgetsend';
        $this->load->model('fivesec_model');
        $data["movies"] = $this->fivesec_model->getMovieList();
        $this->load->view('member_login_view', $data);
    }

    //==================================================================================================================
    //進行忘記密碼
    //==================================================================================================================
    public function doForget()
    {
        $email = $this->input->get('forget_email');
        $email_error = "";
        if (trim($email) == "") {
            $email_error = $this->lang->line('member_email_not_input');
        } else {
            // 依信箱取得會員資訊
            $member = $this->member_model->getMemberByEmail($email)->row_array();
            if (is_null($member)) {
                $email_error = $this->lang->line('member_email_not_exists');
            } else {
                // 產生新密碼(隨機)
//                $new_password = generate_random_string(10);

                // 發信
//                $content = str_replace("{new_password}", $new_password, $this->lang->line('member_forget_email_content'));

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
//                if(send_mail($member["email"], $this->lang->line('member_forget_email_subject'), $content)){
//
//                    $this->member_model->editMember(array(
//                        "member_id" => $member["member_id"],
//                        "password" => $new_password
//                    ));
//
//                }
            }
        }


        if ($email_error != "") {
            $data = array();
            $data["forget_error"] = $email_error;
            $this->showForget($data);
        } else {
            $this->showForgetSend();
        }


    }

    public function forgetPassword()
    {
        $member_id_email = $this->input->get('member_id');
        $key_email = $this->input->get('key');
        $time = $this->input->get('time_token');
        $time_token = base64_decode($time);
        $time_token_auth = time();
        $data['member_id'] = $member_id_email;
        $data['key'] = $key_email;
        $data['time_token_auth'] = $time;


        if (($time_token_auth - $time_token) < 86400) {
            $params = array();
            $sql = "SELECT * FROM members WHERE member_id=?";
            array_push($params, $member_id_email);
            $result = $this->db->query($sql, $params)->result();
            $data['member_id'] = $result[0]->member_id;
            $data['active_auth'] = $result[0]->active_auth;
            if ($data['member_id'] == $member_id_email && $data['active_auth'] == $key_email) {
                $this->changeAuth($member_id_email, $key_email);
    //                $this->changeAuth($member_id_email, $key_email);
                $this->load->view('member_forget_view', $data);
            } else {
                $this->changeAuth($member_id_email, $key_email);
                redirect('/member/getPasswordFailed');
//                $this->load->view('getPasswordFailed');
            }
        } else {
            $this->changeAuth($member_id_email, $key_email);
            redirect('/member/getPasswordFailed');
            //            $this->load->view('getPasswordFailed');
        }

    }

    public function changeAuth($member_id_email, $key_email)
    {
        $active_auth = generate_random_string(100);
        $params = array();
        $sql = "UPDATE members SET active_auth = ? WHERE member_id=? AND active_auth=?";
        array_push($params, $active_auth, $member_id_email, $key_email);
        $this->db->query($sql, $params);
    }

    public function getPassword()
    {

        $member_id_password = $this->input->post('member_id_password');
        $newpassword = $this->input->post('newpassword');
        $renewpassword = $this->input->post('renewpassword');

        $member_id = $this->input->post('member_id');
        $active_auth = $this->input->post('active_auth');
        $time_token = $this->input->post('time_token');
        //密碼規則
        $this->form_validation->set_error_delimiters('<span class="error-txt">', '</span>');

        $this->form_validation->set_rules('newpassword', $this->lang->line('member_field_password'), 'trim|required|min_length[6]|max_length[12]|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,32}$/]');
        //確認密碼規則
        $this->form_validation->set_rules('renewpassword', $this->lang->line('member_field_repassword'), 'trim|required|min_length[6]|max_length[12]|matches[newpassword]|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,32}$/]');



        $this->form_validation->set_message('newpassword', '123');

        $url = "/member/forgetPassword?member_id=$member_id&key=$active_auth&time_token=$time_token";
//            echo $url;

        $data['member_id'] = $member_id;
        $data['key'] = $active_auth;
        $data['time_token_auth'] = $time_token;

        if ($this->form_validation->run() == FALSE) {
            // redirect($url);
            $this->load->view('member_forget_view', $data);
        } else {
            if ($newpassword == $renewpassword) {
                $this->member_model->editMember(array(
                    "member_id" => $member_id_password,
                    "password" => $newpassword
                ));
                redirect('/');
            }
        }




    }

    public function getPasswordFailed()
    {
        $this->load->view('getpasswordfailed');
    }

    //==================================================================================================================
    //顯示修改密碼頁
    //==================================================================================================================
    public function showEditPassword($message = NULL)
    {
        $data['show_type'] = 'member_edit_password';
        $data['message'] = $message;

        $this->load->view('member_edit_view', $data);
    }

    //==================================================================================================================
    //進行修改密碼
    //==================================================================================================================
    public function doEditPassword()
    {
        //原密碼規則
        $this->form_validation->set_rules('old_password', $this->lang->line('member_field_old_password'), 'trim|required|min_length[6]|max_length[32]|callback_check_old_password');
        //新密碼規則
        $this->form_validation->set_rules('new_password', $this->lang->line('member_field_new_password'), 'trim|required|min_length[6]|max_length[32]');
        //確認新密碼規則
        $this->form_validation->set_rules('confirm_new_password', $this->lang->line('member_field_confirm_new_password'), 'trim|required|min_length[6]|max_length[32]|matches[new_password]');

        if ($this->form_validation->run() == FALSE){
            $this->showEditPassword();
        }else {
            $member = $this->input->post();
            $m['member_id'] = $this->session->userdata('member_id');
            $m['password'] = $member['new_password'];
            $m['modify_time'] = date('Y-m-d H:i:s');
            $result = $this->member_model->editMember($m);
            if (strtolower($result['status']) == 'success'){
                redirect('/page/main');
            }else{
                $this->showEditPassword($this->lang->line('member_edit_password_failed_message'));
            }
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

    //==================================================================================================================
    //顯示修改資料頁
    //==================================================================================================================
    public function showEdit()
    {
        //$email = $this->session->userdata('email');
        $this->session->set_userdata('memberid', 1);
        $member_id = $this->session->userdata('member_id');
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
        $data['show_type'] = 'member_edit';

        //$this->load->view('member_edit_view', $data);
        //$this->load->view('info_view', $data);
        redirect('/page/info/edit_member');
    }

    //==================================================================================================================
    //進行修改資料
    //==================================================================================================================
    public function doEdit()
    {
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
        $this->form_validation->set_rules('nickname', $this->lang->line('member_field_nickname'), 'trim|required|max_length[100]');
        //個人簡歷規則
        $this->form_validation->set_rules('resume', $this->lang->line('member_field_resume'), 'trim|max_length[1024]');
        //手機規則
        $this->form_validation->set_rules('mobile', $this->lang->line('member_field_mobile'), 'trim|required|max_length[20]|regex_match[/^[0-9\+-]+$/]');
        //生日規則
        $this->form_validation->set_rules('birth', $this->lang->line('member_field_birth'), 'trim|required|min_length[10]|max_length[10]|regex_match[/^[0-9]{4}-[01][0-9]-[0-3][0-9]$/]');
        //居住城市
        $this->form_validation->set_rules('city', $this->lang->line('member_field_city'), 'trim|max_length[32]');

        if ($this->form_validation->run() == FALSE){
            $this->showEdit();

        }else{
            $member = $this->input->post();
            $this->session->set_userdata('member_id', 1);
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
            $result = $this->member_company_model->editMemberCompany(1, $companys);
            if ($result['status'] == 'failed'){
                $this->db->trans_rollback();
                die($result);
            }
            unset($member['company']);
            unset($member['position']);
            //更新學校、科系
            $result = $this->member_school_model->editMemberSchool(1, $schools);
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
            redirect('/page/main');
        }
    }

    /**
     * 依email取得會員資料
     *
     * @param string $email 會員email
     * @return json 會員資料
     */
    public function getMemberByEmail()
    {


        if (isLogin(FALSE)){
            $email = trim($this->input->get_post('email'));
            if ( ! empty($email)){
                $member = $this->member_model->getMemberByEmail($email)->row_array();
                $result = array('status'=>'success', 'message'=>'', 'code'=>'', 'data'=>$member);
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return TRUE;
            }else{
                $result = array('status'=>'failed', 'message'=>$this->lang->line('member_email_empty'), 'code'=>'M0002');
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return FALSE;
            }
        }else{
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }
    }

    /**
     * 依會員ID取得會員資料
     *
     * @param integer $member_id 會員ID
     * @return json 會員資料
     */
    public function getMember()
    {
        if (isLogin(FALSE)){
            $member_id = trim($this->input->get_post('member_id'));
            if ( ! empty($member_id)){
                $member = $this->member_model->getMember($member_id)->row_array();
                $result = array('status'=>'success', 'message'=>'', 'code'=>'', 'data'=>$member);
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return TRUE;
            }else{
                $result = array('status'=>'failed', 'message'=>$this->lang->line('member_id_empty'), 'code'=>'M0003');
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return FALSE;
            }
        }else{
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }
    }

    /**
     * 取得會員簡介
     *
     * @return json 會員簡介資料(任職公司跟就讀學校取第一筆)
     */
    public function getMemberBrief()
    {

        if (!isLogin(FALSE)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }

        if (empty($this->input->get_post('member_id'))){
            $member_id = $this->session->userdata('member_id');
        }else{
            $member_id = $this->input->get_post('member_id');
        }
        $member = $this->member_model->getMember($member_id)->row_array();
        $companies = $this->member_company_model->getMemberCompany($member_id, 1, 10)->result_array();
        $schools = $this->member_school_model->getMemberSchool($member_id, 1, 10)->result_array();

        $info_show = json_decode($member["info_show"]);
        if($info_show == ""){
            $info_show = array();
        }

        //自傳
        if ( ! empty($member['resume']) && in_array("resume", $info_show)){
            $mb['resume'] = $member['resume'];
        }else{
            $mb['resume'] = '';
        }



        //公司
        foreach($companies as $key => $company){
            $is_show = false;
            if($key == count($companies) - 1){
                $is_show = in_array("companies_" . $key , $info_show) || in_array("companies_last" , $info_show);
            }
            else{
                $is_show = in_array("companies_" . $key , $info_show);
            }
            if ( ! empty($company) && $is_show){
                if ( ! empty($company['company'])){
                    $m['company'] = $company['company'];
                }
                if ( ! empty($company['position'])){
                    //$mb['company'] .= ' '.$company['position'];
                }



                $mb["companies"][] = array(
                    "company" => trim(isset($m['company'])?$m['company']:""),
                    "position" => $company['position']
                );
                //$mb['company'] = trim(isset($mb['company'])?$mb['company']:"");
                //$mb['position'] = $company['position'];
            }else{
                $m['company'] = '';
                $m['position'] = '';
            }
        }

        foreach($schools as $key => $school){
            //學校
            $is_show = false;
            if($key == count($schools) - 1){
                $is_show = in_array("schools_" . $key , $info_show) || in_array("schools_last" , $info_show);
            }
            else{
                $is_show = in_array("schools_" . $key , $info_show);
            }
            if ( ! empty($school) && $is_show){
                if ( ! empty($school['school'])){
                    $m['school'] = $school['school'];
                }
                if ( ! empty($company['department'])){
                    //$mb['school'] .= ' '.$school['department'];
                }

                $mb["schools"][] = array(
                    "school" => trim(isset($m['school'])?$m['school']:""),
                    "department" => $school['department']
                );


                //$mb['school'] = trim(isset($mb['school'])?$mb['school']:"");
                //$mb['department'] = $school['department'];
            }else{
                $m['school'] = '';
                $m['department'] = '';
            }
        }
        //生日
        if ( ! empty($member['birth']) && in_array("birth", $info_show)){
            $mb['birth'] = $member['birth'];
        }else{
            $mb['birth'] = '';
        }
        //性別
        if ( ! empty($member['gender']) && in_array("gender", $info_show)){
            $mb['gender'] = $member['gender'];
        }else{
            $mb['gender'] = '';
        }
        //電話
        if ( ! empty($member['mobile']) && in_array("mobile", $info_show)){
            $mb['phone'] = $member['mobile'];
        }else{
            $mb['phone'] = '';
        }
        //居住地
        if ( ! empty($member['city']) && in_array("city", $info_show)){
            $mb['city'] = $member['city'];
        }else{
            $mb['city'] = '';
        }
        //國藉
        if ( ! empty($member['country_id']) && in_array("country", $info_show)){
            $mb['country'] = $member['country_name'];
        }else{
            $mb['country'] = '';
        }
        //感情狀態
        if ( ! empty($member['relationship']) && in_array("relationship", $info_show)){
            $mb['relationship'] = $this->lang->line('member_option_relationship')[$member['relationship']];
        }else{
            $mb['relationship'] = '';
        }

        echo json_encode($mb, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 取得會員所需编辑的信息
     *
     * @return json
     */
    public function getMemberInfo()
    {
        if (!isLogin(FALSE)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }

        $member_id = $this->session->userdata('member_id');
        $member = $this->member_model->getMember($member_id)->row_array();
        $companies = $this->member_company_model->getMemberCompany($member_id, 1, 10)->result_array();
        $schools = $this->member_school_model->getMemberSchool($member_id, 1, 10)->result_array();

        //公司
        foreach($companies as $key => $company){

            if ( ! empty($company)){
                if ( ! empty($company['company'])){
                    $m['company'] = $company['company'];
                }
                if ( ! empty($company['position'])){
                    //$mb['company'] .= ' '.$company['position'];
                }

                $mb["companies"][] = array(
                    "company" => trim(isset($m['company'])?$m['company']:""),
                    "position" => $company['position']
                );
            }else{
                $m['company'] = '';
                $m['position'] = '';
            }
        }

        foreach($schools as $key => $school){
            //學校

            if ( ! empty($school) ){
                if ( ! empty($school['school'])){
                    $m['school'] = $school['school'];
                }
                if ( ! empty($company['department'])){
                    //$mb['school'] .= ' '.$school['department'];
                }

                $mb["schools"][] = array(
                    "school" => trim(isset($m['school'])?$m['school']:""),
                    "department" => $school['department']
                );
            }else{
                $m['school'] = '';
                $m['department'] = '';
            }
        }

        //自傳
        $mb['resume'] = $member['resume'];
        //生日
        $mb['birth'] = $member['birth'];
        //性別
        $mb['gender'] = $member['gender'];
        //電話
        $mb['phone'] = $member['mobile'];
        //居住地
        $mb['city'] = $member['city'];
        //國藉
        $mb['country'] = $member['country_name'];
        //感情狀態
        $member['relationship'] = isset($member['relationship'])?$member['relationship']:"";
        $mb['relationship'] = empty($member['relationship'])?null: $this->lang->line('member_option_relationship')[$member['relationship']];

        echo json_encode($mb, JSON_UNESCAPED_UNICODE);
    }

    //==================================================================================================================
    //顯示隱私政策
    //==================================================================================================================
    public function showPrivacy()
    {
        $data['show_type'] = 'Privacy';

        $this->load->view('member_policy_view', $data);
    }

    //==================================================================================================================
    //顯示服務條款
    //==================================================================================================================
    public function showService()
    {
        $data['show_type'] = 'Service';

        $this->load->view('member_policy_view', $data);
    }

    //==================================================================================================================
    //會員離線
    //==================================================================================================================
    public function offLine()
    {
        $member_id = $this->input->get_post('member_id');
        $member['member_id'] = $member_id;
        $member['isOnline'] = 0;
        $result = $this->member_model->editMember($member);
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function test()
    {
        //$this->load->view('test_view');
        //echo strtok($_SERVER['HTTP_ACCEPT_LANGUAGE'], ',');
        //echo $this->lang->line('member_relationship')['married'];
        //$member = $this->member_model->getMember(1)->row_array();
        //var_dump($member);
        //$auth = generate_random_string(100);
        //echo $auth;
        //echo '<br>';
        //echo md5($auth);
        //echo get_active_content();
        //echo get_time_from_now('2018-01-20 21:16:10');
        /*$date1 = new DateTime("2015-01-15 12:22:32");
        $date2 = new DateTime(date('Y-m-d H:i:s'));
        $diff=date_diff($date1,$date2);
        $year = intval($diff->format("%R%y"));
        echo $year;*/
        //echo get_domain();
        $this->load->library('email');

        $this->email->from('shiefu@yahoo.com.tw', 'Jeff');
        $this->email->to('shiefu@gmail.com');
        //$this->email->cc('another@another-example.com');
        //$this->email->bcc('them@their-example.com');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        $this->email->send();

        echo $this->email->print_debugger();
    }

    public function sendmail2($sender, $subject, $content)
    {

        include APPPATH . 'third_party/PHPMailer/src/PHPMailer.php';
        include APPPATH . 'third_party/PHPMailer/src/Exception.php';
        include APPPATH . 'third_party/PHPMailer/src/SMTP.php';

        $mail= new PHPMailer(true);
        try {
            //$mail->SMTPDebug = 2;
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";
            $mail->Host = "mail.phc-web.net";
            $mail->Port = 465;
            $mail->CharSet = "utf-8";
            $mail->Username = "puhui"; //帳號
            $mail->Password = "puhui123456"; //密碼
            $mail->From = "service@phc-web.net"; //寄件者信箱
            $mail->FromName = "普惠世紀國際"; //寄件者姓名
            $mail->Subject = $subject; //設定郵件標題
            $mail->Body = $content;
            $mail->AddAddress($sender, "Henry");
            $mail->IsHTML(true); //設定郵件內容為HTML
            $mail->SMTPOptions = array(
                'ssl' => [
                    'verify_peer' => true,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ],
            );
            $mail->send();
//            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }

    public function show_view_test()
    {
        $this->load->view('member_policy_view');
    }

    public  function validateRegister(){

        if(isset($_POST['email']))
            $this->form_validation->set_rules('email', $this->lang->line('member_field_email'), 'trim|required|valid_email|is_unique[members.email]');
        //密碼規則
        if(isset($_POST['password']))
            $this->form_validation->set_rules('password', $this->lang->line('member_field_password'), 'trim|required|min_length[6]|max_length[12]|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,32}$/]');
        //確認密碼規則
        if(isset($_POST['repassword']))
            $this->form_validation->set_rules('repassword', $this->lang->line('member_field_repassword'), 'trim|required|min_length[6]|max_length[12]|matches[password]|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,32}$/]');
        //匿稱規則
        if(isset($_POST['nickname']))
            $this->form_validation->set_rules('nickname', $this->lang->line('member_field_nickname'), 'trim|required|max_length[100]|gb_max_length[10]|sensitive['.(isset($_POST['language_id'])?$_POST['language_id']:$this->session->userdata('language_id')).']');
        //手機規則
        if(isset($_POST['mobile']))
            $this->form_validation->set_rules('mobile', $this->lang->line('member_field_mobile'), 'trim|required|min_length[10]|max_length[20]|regex_match[/^[0-9\+-]+$/]|is_unique[members.mobile]');
        if ($this->form_validation->run() === true) {
            echo json_encode(array('status'=>'success'), JSON_UNESCAPED_UNICODE);
        }else{
            $errArr = $this->form_validation->error_array();
            $errMsg=null;

            foreach($errArr as $key=>$value){
                $errMsg=$value;
            }

            echo json_encode(array('status'=>'failed', 'message'=> $errMsg),JSON_UNESCAPED_UNICODE);
        }

    }
}
