<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Friend extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('friend_model');
        $this->load->model('trace_model');
        $this->load->model('invite_model');
        $this->load->model('like_model');
    }

    /**
     * 新增好友(新增好友時，同時新增追踨)
     *
     * @param integer $member_id 會員ID
     * @param integer $friend_id 好友ID
     * @return json 結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    public function addFriend()
    {
        if (isLogin(FALSE)){

            $member_id = $this->session->userdata('member_id');
            $friend_id = trim($this->input->get_post('friend_id'));

            if($member_id===$friend_id){
                $result = array('status'=>'failed', 'message'=>$this->lang->line('can_not_add_myself'));
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return FALSE;
            }

            if ( ! empty($friend_id)){
                $this->db->trans_start();
                $result = $this->friend_model->addFriend($member_id, $friend_id);
                if ($result['status'] == 'failed'){
                    $this->db->trans_rollback();
                    echo json_encode($result, JSON_UNESCAPED_UNICODE);
                    return FALSE;
                }
                $result = $this->trace_model->addTrace($friend_id, $member_id);
                $result = $this->trace_model->addTrace($member_id, $friend_id);
                if ($result['status'] == 'failed'){
                    $this->db->trans_rollback();
                    echo json_encode($result, JSON_UNESCAPED_UNICODE);
                    return FALSE;
                }
               
                $this->db->trans_complete();
                $result = array('status'=>'success', 'message'=>'', 'code'=>'');
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return TRUE;
            }else{
                $result = array('status'=>'failed', 'message'=>$this->lang->line('friend_id_empty'), 'code'=>'F0002');
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
     * 刪除好友
     *
     * @param integer $member_id 會員ID
     * @param integer $friend_id 好友ID
     * @return json 結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    public function delFriend()
    {
        if (isLogin(FALSE)){
            $member_id = $this->session->userdata('member_id');
            $friend_id = trim($this->input->get_post('friend_id'));
            if ( ! empty($friend_id)){
                $result = $this->friend_model->delFriend($member_id, $friend_id);
                if ($result['status'] == 'failed'){
                    $this->db->trans_rollback();
                    echo json_encode($result, JSON_UNESCAPED_UNICODE);
                    return FALSE;
                }
                $result = $this->trace_model->delTrace($friend_id, $member_id);
                if ($result['status'] == 'failed'){
                    $this->db->trans_rollback();
                    echo json_encode($result, JSON_UNESCAPED_UNICODE);
                    return FALSE;
                }
                $result = $this->trace_model->delTrace($member_id, $friend_id);
                if ($result['status'] == 'failed'){
                    $this->db->trans_rollback();
                    echo json_encode($result, JSON_UNESCAPED_UNICODE);
                    return FALSE;
                }
                $result = $this->invite_model->delInvite($member_id, $friend_id);
                if ($result['status'] == 'failed'){
                    $this->db->trans_rollback();
                    echo json_encode($result, JSON_UNESCAPED_UNICODE);
                    return FALSE;
                }
                $result = $this->invite_model->delInvite($friend_id, $member_id);
                if ($result['status'] == 'failed'){
                    $this->db->trans_rollback();
                    echo json_encode($result, JSON_UNESCAPED_UNICODE);
                    return FALSE;
                }
                $this->db->trans_complete();
                $result = array('status'=>'success', 'message'=>'', 'code'=>'');
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return TRUE;
            }else{
                $result = array('status'=>'failed', 'message'=>$this->lang->line('friend_id_empty'), 'code'=>'F0002');
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
     * 依會員ID取得好友
     *
     * @param integer $member_id 會員ID
     * @param integer $start_row 回傳筆數/指定從第幾筆開始(有$return_rows:第幾筆開始，沒有$return_rows:回傳筆數)
     * @param integer $return_rows 回傳筆數
     * @return json 好友資料
     */
    public function getFriendByMember()
    {
        if (isLogin(FALSE)){
            if ( ! empty($this->input->get_post('member_id'))){
                $member_id = $this->input->get_post('member_id');
            }else{
                $member_id = $this->session->userdata('member_id');
            }
            $start_row = $this->input->get_post('start_row');
            $return_rows = $this->input->get_post('return_rows');
            $friends = $this->friend_model->getFriendByMember($member_id, $start_row, $return_rows)->result_array();
            $result = array('status'=>'success', 'message'=>'', 'code'=>'', 'data'=>$friends);
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return TRUE;
        }else{
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }
    }

    /**
     * 依好友ID取得會員
     *
     * @param integer $friend_id 好友ID
     * @param integer $start_row 回傳筆數/指定從第幾筆開始(有$return_rows:第幾筆開始，沒有$return_rows:回傳筆數)
     * @param integer $return_rows 回傳筆數
     * @return json 會員資料
     */
    public function getMemberByFriend()
    {
        if (isLogin(FALSE)){
            if ( ! empty($this->input->get_post('member_id'))){
                $friend_id = $this->input->get_post('member_id');
            }else{
                $friend_id = $this->session->userdata('member_id');
            }
            $start_row = $this->input->get_post('start_row');
            $return_rows = $this->input->get_post('return_rows');
            $members = $this->friend_model->getMemberByFriend($friend_id, $start_row, $return_rows)->result_array();
            $result = array('status'=>'success', 'message'=>'', 'code'=>'', 'data'=>$members);
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return TRUE;
        }else{
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }
    }

    /**
     * 取得共同好友
     *
     * @param integer $member_id 會員ID
     * @param integer $friend_id 好友ID
     * @param integer $start_row 回傳筆數/指定從第幾筆開始(有$return_rows:第幾筆開始，沒有$return_rows:回傳筆數)
     * @param integer $return_rows 回傳筆數
     * @return json 共同好友資料
     */
    public function getMutualFriend()
    {
        if (isLogin(FALSE)){
            if (!empty($this->input->get_post('member_id'))) {
                $member_id = $this->input->get_post('member_id');
            } else {
                $member_id = $this->session->userdata('member_id');
            }
            $friend_id = $this->input->get_post('friend_id');
            $start_row = $this->input->get_post('start_row');
            $return_rows = $this->input->get_post('return_rows');
            if ( ! empty($friend_id)){
                $members = $this->friend_model->getMutualFriend($member_id, $friend_id, $start_row, $return_rows)->result_array();
                $result = array('status'=>'success', 'message'=>'', 'code'=>'', 'data'=>$members);
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return TRUE;
            }else{
                $result = array('status'=>'failed', 'message'=>$this->lang->line('friend_id_empty'), 'code'=>'F0002');
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
     * 取得尚未成為好友的會員
     *
     * @param integer $member_id 會員ID
     * @param integer $start_row 回傳筆數/指定從第幾筆開始(有$return_rows:第幾筆開始，沒有$return_rows:回傳筆數)
     * @param integer $return_rows 回傳筆數
     * @return json 會員資料
     */
    public function getNotFriend()
    {
        if (isLogin(FALSE)){
            if ( ! empty($this->input->get_post('member_id'))){
                $member_id = $this->input->get_post('member_id');
            }else{
                $member_id = $this->session->userdata('member_id');
            }
            $start_row = $this->input->get_post('start_row');
            $return_rows = $this->input->get_post('return_rows');
            if ( ! empty($member_id)){
                $members = $this->friend_model->getNotFriend($member_id, $start_row, $return_rows)->result_array();
                $result = array('status'=>'success', 'message'=>'', 'code'=>'', 'data'=>$members);
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return TRUE;
            }else{
                $result = array('status'=>'failed', 'message'=>$this->lang->line('member_id_empty'), 'code'=>'M0002');
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
     * 取得好友名單(雙向)
     *
     * @param integer $member_id 會員ID
     * @param integer $start_row 回傳筆數/指定從第幾筆開始(有$return_rows:第幾筆開始，沒有$return_rows:回傳筆數)
     * @param integer $return_rows 回傳筆數
     * @return json 會員資料
     */
    function getFriendList()
    {
        if (isLogin(FALSE)){
            if ( ! empty($this->input->get_post('member_id'))){
                $member_id = $this->input->get_post('member_id');
            }else{
                $member_id = $this->session->userdata('member_id');
            }
            $start_row = $this->input->get_post('start_row');
            $return_rows = $this->input->get_post('return_rows');
            if ( ! empty($member_id)){
                $members = $this->friend_model->getFriendList($member_id, $start_row, $return_rows)->result_array();
                foreach($members as $key => $member){
                    $members[$key]["isTrace"] = $this -> like_model -> isTrace($this->session->userdata('member_id'), $member["member_id"]);
                    $members[$key]["isFriend"] = $this -> like_model -> isFriend($this->session->userdata('member_id'), $member["member_id"]);
                }

                $result = array('status'=>'success', 'message'=>'', 'code'=>'', 'data'=>$members);
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return TRUE;
            }else{
                $result = array('status'=>'failed', 'message'=>$this->lang->line('member_id_empty'), 'code'=>'M0002');
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
     * 取得在线好友名單(雙向)
     *
     * @param integer $start_row 回傳筆數/指定從第幾筆開始(有$return_rows:第幾筆開始，沒有$return_rows:回傳筆數)
     * @param integer $return_rows 回傳筆數
     * @return json 在线好友
     */
    function getOnlineFriends()
    {
        if (isLogin(FALSE)){
            $member_id = $this->session->userdata('member_id');
            $start_row = $this->input->get_post('start_row');
            $return_rows = $this->input->get_post('return_rows');

            $members = $this->friend_model->getFriendList($member_id, $start_row, $return_rows,1)->result_array();
            $result = array('status'=>'success', 'message'=>'', 'code'=>'', 'data'=>$members);
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return TRUE;

        }else{
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }
    }

    function isFriend(){
        if (isLogin(FALSE)){

            $member_id = $this->input->get_post('member_id');


            if ( ! empty($member_id)){
                $isFriend = $this -> like_model -> isFriend($this->session->userdata('member_id'), $member_id);
                $result = array('status'=>'success', 'message'=>'', 'code'=>'', 'data'=> $isFriend?"Y":"N");
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return TRUE;
            }else{
                $result = array('status'=>'failed', 'message'=>$this->lang->line('member_id_empty'), 'code'=>'M0002');
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return FALSE;
            }
        }else{
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }
    }

}