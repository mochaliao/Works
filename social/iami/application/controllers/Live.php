<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Live extends CI_Controller
{
    public $credentials = null;
    public $hub_name = null;
    public $hub = null;
    public $key;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('live_model');
        $this->load->model('member_model');

        require_once APPPATH . 'third_party'.DIRECTORY_SEPARATOR.'pili-sdk'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'Pili.php';
        $this->key = get_key();
        $this->credentials = new Qiniu\Credentials($this->key['AccessKey'], $this->key['SecretKey']);
        $this->hub_name = get_hub_name();
        $this->hub = new \Pili\Hub($this->credentials, $this->hub_name);
    }

    /**
     * 創建直播流
     *
     * @param int member_id (會員ID, post欄位, 必填)
     * @param varchar(64) live_name (直播流名稱, post欄位, 必填)
     * @return json 結果 (status: success|failed, message: 直播ID, code: 錯誤代碼 )
     */
    public function addLive($member_id = NULL, $live_name = NULL)
    {
        if (empty($member_id) || empty($live_name)){
            $live_name = trim($this->input->post('live_name'));
            $member_id = trim($this->input->post('member_id'));
        }

        //$live_name = 'test2';
        //$member_id = 14;
        //直播流名稱空白
        if (empty($live_name)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('live_name_empty'), 'code'=>'L0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }
        //會員ID空白
        elseif (empty($member_id)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_member_id_empty'), 'code'=>'L0002');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }
        //會員ID不存在
        elseif ($this->member_model->getMember($member_id)->num_rows() <= 0){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_member_id_not_exists'), 'code'=>'L0003');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }
        //必填資料都有傳入
        else{
            try {
                $stream = $this->hub->createStream($live_name, NULL, NULL);
                $live['member_id'] = $member_id;
                $live['qiniu_id'] = $stream->id;
                $live['live_space'] = $this->hub_name;
                $live['live_name'] = $live_name;
                $live['push_url'] = $stream->rtmpPublishUrl(PUSH_DOMAIN, $this->hub_name, $live_name, TOKEN_EXPIRE_SECONDS, $this->key['AccessKey'], $this->key['SecretKey']);
                $live['rtmp_pull_url'] = $stream->rtmpLiveUrls()['ORIGIN'];
                $live['hls_pull_url'] = $stream->hlsLiveUrls()['ORIGIN'];
                $live['create_time'] = $stream->createdAt;
                $live['update_time'] = $stream->updatedAt;
                //$live['snapshot_url'] = $stream->snapshot($live_name.'.jpg', 'jpg', NULL, NULL, NULL)['targetUrl'];
                //var_dump($stream->snapshot($live_name.'.jpg', 'jpg', NULL, NULL, NULL));
                $live['status'] = $stream->status()['status'];
                $result = $this->live_model->addLive($live);
                if ($result['status'] == 'failed'){
                    $stream->delete();
                    echo json_encode($result, JSON_UNESCAPED_UNICODE);
                    return FALSE;
                }else{
                    $result['data'] = $this->live_model->getLive($live['qiniu_id'])->row_array();
                    echo json_encode($result, JSON_UNESCAPED_UNICODE);
                    return TRUE;
                }
            } catch (Exception $e) {
                $result = array('status'=>'failed', 'message'=>'建立直播流('.$live_name.')失敗，exception: ', $e->getMessage(), 'code'=>'L0004');
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return FALSE;
            }
        }
    }

    /**
     * 刪除直播流
     *
     * @param int qiniu_id (七牛直播ID, post欄位, 必填)
     * @return json 結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    public function delLive($qiniu_id = NULL)
    {
        if (empty($qiniu_id)){
            $qiniu_id = $this->input->post('qiniu_id');
        }
        //$qiniu_id = 'z1.iami-web-me.test2';
        //七牛直播ID是空的
        if (empty($qiniu_id)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('live_id_empty'), 'code'=>'L0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }else{
            try {
                $stream = $this->hub->getStream($qiniu_id);
                $stream->delete();
                $result = $this->live_model->delLive($qiniu_id);
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return TRUE;
            } catch (Exception $e) {
                $result = array('status'=>'failed', 'message'=>$this->lang->line('live_delete_failed').'('.$qiniu_id.')'.", Caught exception: ".$e->getMessage(), 'code'=>'L0001');
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return FALSE;
            }
        }
    }

    /**
     * 同步七牛跟資料庫之間的差異
     *
     * @return json 結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    public function syncLive($callback = NULL)
    {
        $streamlist = $this->hub->listStreams(NULL, 1000, NULL, NULL);
        $streams = $streamlist['items'];
        $add_count = 0;
        $update_count = 0;
        $delete_count = 0;
        $arr_tmp = array();
        //從七牛到資料庫
        foreach ($streams as $stream){
            array_push($arr_tmp, trim($stream->id));
            $tmp['qiniu_id'] = $stream->id;
            $tmp['live_space'] = $this->hub_name;
            $tmp['live_name'] = $stream->title;
            $tmp['rtmp_pull_url'] = $stream->rtmpLiveUrls()['ORIGIN'];
            $tmp['hls_pull_url'] = $stream->hlsLiveUrls()['ORIGIN'];
            $tmp['create_time'] = $stream->createdAt;
            $tmp['update_time'] = $stream->updatedAt;
            $tmp['status'] = $stream->status()['status'];
            //不存在資料庫中，增加
            if ($this->live_model->getLive($tmp['qiniu_id'])->num_rows() == 0){
                $tmp['push_url'] = $stream->rtmpPublishUrl(PUSH_DOMAIN, $this->hub_name, $stream->title, TOKEN_EXPIRE_SECONDS, $this->key['AccessKey'], $this->key['SecretKey']);
                $this->live_model->addLive($tmp);
                $add_count = $add_count + 1;
            }
            //存在資料庫中，更新
            else{
                if ($this->live_model->getLive($tmp['qiniu_id'])->num_rows() > 0){
                    $live = $this->live_model->getLive($tmp['qiniu_id'])->row_array();
                    //如果有異動再更新
                    if (
                        ($live['live_space'] !== $tmp['live_space'])
                        || ($live['live_name'] !== $tmp['live_name'])
                        || ($live['rtmp_pull_url'] !== $tmp['rtmp_pull_url'])
                        || ($live['hls_pull_url'] !== $tmp['hls_pull_url'])
                        || ($live['create_time'] !== date('Y-m-d H:i:s',strtotime($tmp['create_time'])))
                        || ($live['update_time'] !== date('Y-m-d H:i:s',strtotime($tmp['update_time'])))
                        || ($live['status'] !== $tmp['status'])
                    ){
                        $tmp['member_id'] = $live['member_id'];
                        $this->live_model->editLive($tmp);
                        $update_count = $update_count + 1 ;
                    }
                }
            }
        }

        //資料庫到七牛(刪除已不在七牛的資料)
        $lives = $this->live_model->getLive()->result_array();
        foreach ($lives as $live){
            //如果不存在七牛中，刪除
            if ( ! in_array($live['qiniu_id'], $arr_tmp)){
                $this->live_model->delLive($live['qiniu_id']);
                $delete_count = $delete_count + 1;
            }
        }

        //$result = array('status'=>'success', 'message'=>'新增'.$add_count.'筆，更新'.$update_count.'筆，刪除'.$delete_count.'筆 !', 'code'=>'');
        //echo json_encode($result, JSON_UNESCAPED_UNICODE);
        if ( ! empty($callback)){
            redirect('/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
            return TRUE;
        }else{
            return TRUE;
        }
    }

    /**
     * 依狀態取得所有直播資料
     *
     * @param varchar(32) $status 直播狀態(connected直播中，disconnected非直播中，不傳該參數則回傳全部資料)
     * @param integer $start_row 回傳筆數/指定從第幾筆開始(有$return_rows:第幾筆開始，沒有$return_rows:回傳筆數)
     * @param integer $return_rows 回傳筆數
     * @return json 直播資料
     */
    public function getLive()
    {
        $status = $this->input->get_post('status');
        $start_row = $this->input->get_post('start_row');
        $return_rows = $this->input->get_post('return_rows');
        //$this->syncLive();
        $lives = $this->live_model->getLiveByStatus($status, $start_row, $return_rows)->result_array();
        $result = array('status'=>'success', 'message'=>'', 'code'=>'', 'data'=>$lives);
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        return TRUE;
    }

    /**
     * 重新產生推流地址(推流地址有3600秒內有效的限制)
     *
     * @param int qiniu_id (七牛直播ID, post欄位, 必填)
     * @return json 結果 (status: success|failed, message: 新推流地址, code: 錯誤代碼 )
     */
    public function getNewPushURL()
    {
        $qiniu_id = trim($this->input->post('qiniu_id'));
        //$qiniu_id = 'z1.iamiweb-test.test';
        //七牛直播流ID空白
        if (empty($qiniu_id)){
            $result = array('status'=>'failed', 'message'=>'七牛直播流ID空白', 'code'=>'L0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }else{
            try {
                $stream = $this->hub->getStream($qiniu_id);
                $new_push_url = $stream->rtmpPublishUrl(PUSH_DOMAIN, $this->hub_name, $stream->title, TOKEN_EXPIRE_SECONDS, $this->key['AccessKey'], $this->key['SecretKey']);
                $live['qiniu_id'] = $qiniu_id;
                $live['push_url'] = $new_push_url;
                $this->live_model->editLive($live);
                $result = array('status'=>'success', 'message'=>'重新產生推流地址成功', 'code'=>'', 'data'=>$new_push_url);
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return TRUE;
            } catch (Exception $e) {
                $result = array('status'=>'failed', 'message'=>'重新產生推流地址失敗, Caught exception: '.$e->getMessage(), 'code'=>'L0001');
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return FALSE;
            }
        }
    }


    public function getInfo($qiniu_id = NULL)
    {
        if (empty($qiniu_id)){
            $qiniu_id = $this->input->post('qiniu_id');
        }
        //七牛直播ID是空的
        if (empty($qiniu_id)){
            $result = array('status'=>'failed', 'message'=>$this->lang->line('live_id_empty'), 'code'=>'L0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }else{
            try {
                $stream = $this->hub->getStream($qiniu_id);
                $status = $stream->status();
                $live = $this->live_model->getLive($qiniu_id)->row_array();
                if ( ! empty($live)) {
                    $member = $this->member_model->getMember($live['member_id'])->row_array();
                    $live_info['member_id'] = $member['member_id'];
                    $live_info['email'] = $member['email'];
                    $live_info['nickname'] = $member['nickname'];
                    $live_info['avatar'] = $member['avatar'];
                    $live_info['gender'] = $member['gender'];
                    $live_info['language_id'] = $member['language_id'];
                    $live_info['level'] = $member['level'];
                    $live_info['push_url'] = $live['push_url'];
                    $live_info['rtmp_pull_url'] = $live['rtmp_pull_url'];
                    $live_info['hls_pull_url'] = $live['hls_pull_url'];
                } else {
                    $live_info['member_id'] = NULL;
                    $live_info['email'] = NULL;
                    $live_info['nickname'] = NULL;
                    $live_info['avatar'] = NULL;
                    $live_info['gender'] = NULL;
                    $live_info['language_id'] = NULL;
                    $live_info['level'] = NULL;
                    $live_info['push_url'] = NULL;
                    $live_info['rtmp_pull_url'] = NULL;
                    $live_info['hls_pull_url'] = NULL;
                }
                $live_info['qiniu_id'] = $status['streamId'];
                $live_info['reqId'] = $status['reqId'];
                $live_info['live_space'] = $status['hub'];
                $live_info['live_name'] = $status['stream'];
                $live_info['start_time'] = date('Y-m-d H:i:s',strtotime($status['startFrom']));
                $live_info['pfop_time'] = date('Y-m-d H:i:s',strtotime($status['pfopAt']));
                $live_info['updated_time'] = date('Y-m-d H:i:s',strtotime($status['updatedAt']));
                $live_info['ip'] = $status['addr'];
                $live_info['status'] = $status['status'];
                $live_info['bytes_per_second'] = $status['bytesPerSecond'];
                $live_info['frames_per_second_audio'] = $status['framesPerSecond']['audio'];
                $live_info['frames_per_second_video'] = $status['framesPerSecond']['video'];
                $live_info['frames_per_second_data'] = $status['framesPerSecond']['data'];
                $result = array('status'=>'success', 'message'=>$this->lang->line('live_get_info_success').' ('.$qiniu_id.')', 'code'=>'', 'data'=>$live_info);
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return TRUE;
            } catch (Exception $e) {
                $result = array('status'=>'failed', 'message'=>$this->lang->line('live_get_info_failed').' ('.$qiniu_id.')'.", Caught exception: ".$e->getMessage(), 'code'=>'L0001');
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return FALSE;
            }
        }
    }

    public function live_show_friend()
    {
        $this->load->model('trace_model');
        $this->load->model('post_model');
        $this->load->model('member_model');
        $this->load->model('like_model');
        $this->load->model('member_company_model');
        $this->load->model('member_school_model');
        $this->load->model('language_model');
        $this->load->model('country_model');
        $this->load->model('hot_model');
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
            "isInvite" => $isInvite
        );


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

        $page = $this->input->get_post('page');
        // $start = $this->input->get_post('start');
        $perPage = $this->input->get_post('perPage');

        // $member_id = $this->session->userdata('member_id');
        $member_id = $this->input->get_post('member_id');
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
        $data['initPost'] = $this->hot_model->initPost($member_id, $start, $perPage, $mulThumb, $mulComments, $mulShare);
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
        $this->load->view('live_show_friend_view', $data);
    }

    public function live_show()
    {
        isLogin();
        $this->load->model('trace_model');
        $this->load->model('post_model');
        $this->load->model('member_model');
        $this->load->model('like_model');
        $this->load->model('member_company_model');
        $this->load->model('member_school_model');
        $this->load->model('language_model');
        $this->load->model('country_model');
        $this->load->model('hot_model');
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
            "isInvite" => $isInvite
        );


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


        $this->load->view('live_show_view', $data);
    }

    public function apply_live_show()
    {
        isLogin();
        $this->load->model('trace_model');
        $this->load->model('post_model');
        $this->load->model('member_model');
        $this->load->model('like_model');
        $this->load->model('member_company_model');
        $this->load->model('member_school_model');
        $this->load->model('language_model');
        $this->load->model('country_model');
        $this->load->model('hot_model');
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

        //$member = $this->member_model->getMember($info_id)->row_array();
        $this->load->model('lives_model');
        $member = $this->lives_model->getStreamData($member_id)->row_array();


        $postCount = $this -> post_model -> getPostCount($info_id);
        $collectCount = $this -> post_model -> getCollectionCount($info_id);
        $traceCount = $this -> trace_model -> getTraceByMember($info_id) -> num_rows();
        $fansCount = $this -> trace_model -> getMemberByTrace($info_id) -> num_rows();

        $isTrace = $this -> like_model -> isTrace($member_id, $info_id);
        $isInvite = $this -> like_model -> isInvite($member_id, $info_id);
        $isFriend = $this -> like_model -> isFriend($member_id, $info_id);

        $data = array(
            'member_id' => $info_id,
            'email' => $member["email"],
            'nickname' => $member["nickname"],
            'gender'=> $member['gender'],
            'birth' => $member['birth'],
            'mobile'=> $member['mobile'],
            'language_id' => $this->session->userdata("language_id"),
            'avatar' => $member["avatar"],
            'banner' => $member["banner"],
            'status' => $this->session->userdata("status"),
            'streamer' => $member["streamer"],
            "is_myself" => $myself,
            'level' => $member["level"],
            'money' => $member["money"],
            "postCount" => $postCount,
            "collectCount" => $collectCount,
            "traceCount" => $traceCount,
            "fansCount" => $fansCount,
            "isTrace" => $isTrace,
            "isFriend" => $isFriend,
            "isInvite" => $isInvite
        );


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




        $this->load->view('apply_live_show_view', $data);
    }

    public function video_show()
    {
        $this->load->model('trace_model');
        $this->load->model('post_model');
        $this->load->model('member_model');
        $this->load->model('like_model');
        $this->load->model('member_company_model');
        $this->load->model('member_school_model');
        $this->load->model('language_model');
        $this->load->model('country_model');
        $this->load->model('hot_model');
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
            "isInvite" => $isInvite
        );


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


        $this->load->view('video_show_view');
    }

    public function live()
    {
        isLogin();
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
            "isInvite" => $isInvite
        );


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
        $this->load->model('hot_model');
        
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

        $this->load->view('live_view2', $data);
    }

    public function RegisterStreamer()
    {
        $member_id = $this->input->get_post('id');
        $this->load->model('Lives_model');
        $this->Lives_model->RegisterStreamer($member_id);
        redirect('live/apply_live_show');
    }
    public function test()
    {
        //$live_name = $this->input->post('live_name');
        //$member_id = $this->input->post('member_id');
        //$csrf_token_hash = $this->input->post($this->security->get_csrf_token_name());
        //echo "live_name=$live_name, member_id=$member_id, csrf_token_hash=$csrf_token_hash";
        echo get_hub_name();
    }


}