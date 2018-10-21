<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invite extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('invite_model');
        $this->load->model('friend_model');
        $this->load->model('trace_model');
        $this->load->model('like_model');
    }

    /**
     * 新增邀請
     *
     * @param integer $member_id 會員ID
     * @param integer $invitee_id 被邀請者會員ID
     * @return json 結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    public function addInvite()
    {
        if (isLogin(FALSE)){
            $member_id = $this->session->userdata('member_id');
            $invitee_id = $this->input->get_post('invitee_id');
            if ( ! empty($invitee_id)){
                $result = $this->invite_model->addInvite($member_id, $invitee_id);
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return TRUE;
            }else{
                $result = array('status'=>'failed', 'message'=>$this->lang->line('invite_id_empty'), 'code'=>'I0001');
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
     * 是否已经邀请好友
     *
     * @param integer $member_id 會員ID
     * @return json 結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    public function isInvite()
    {
        if (isLogin(FALSE)){
            $member_id=$this->input->get_post('member_id');
            if ( ! empty($member_id)){
                $isInvite = $this -> like_model -> isInvite($this->session->userdata('member_id'), $member_id);
                $result = array('status'=>'success', 'message'=>'', 'code'=>'', 'data'=> $isInvite?"Y":"N");
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
     * 刪除邀請
     *
     * @param integer $member_id 會員ID
     * @param integer $invitee_id 被邀請者會員ID
     * @return json 結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    public function delInvite()
    {
        if (isLogin(FALSE)){
            $member_id = $this->session->userdata('member_id');
            $invitee_id = $this->input->get_post('invitee_id');
            if ( ! empty($invitee_id)){
                $result = $this->invite_model->delInvite($member_id, $invitee_id);
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                return TRUE;
            }else{
                $result = array('status'=>'failed', 'message'=>$this->lang->line('invite_id_empty'), 'code'=>'I0001');
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
     * 同意或不同意邀請
     *
     * @param integer $member_id 會員ID
     * @param integer $invitee_id 被邀請者會員ID
     * @param integer $status 狀態(0.不同意 1.同意 2.未決定)
     * @return json 結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    public function setInviteStatus()
    {
        if (isLogin(FALSE)){
            $member_id = $this->input->get_post('invitee_id');
            $invitee_id = $this->session->userdata('member_id');
            $status = $this->input->get_post('status');
            if ( ! empty($member_id) && ! is_null($status)){
                //接受加好友邀請(新增好友)
                //$this->db->trans_start();
                $result = $this->invite_model->setInviteStatus($member_id, $invitee_id, $status);
                if ($result['status'] == 'success' && $status == 1){
                    if ($this->friend_model->getFriend($member_id, $invitee_id)->num_rows == 0){
                        $result = $this->trace_model->addTrace($invitee_id, $member_id);
                        $result = $this->trace_model->addTrace($member_id, $invitee_id);
                        $result = $this->friend_model->addFriend($member_id, $invitee_id);
                        if ($result['status'] == 'success'){
                            $this->db->trans_commit();
                            $this->trace_model->addTrace($member_id, $invitee_id);
                            $this->trace_model->addTrace($invitee_id, $member_id);
                            echo json_encode($result, JSON_UNESCAPED_UNICODE);
                            return TRUE;
                        }else{
                            // 已經是好友了，那邀請的狀態還是讓他能成功
                            if($result['code'] == "F0002"){
                                $this->db->trans_commit();
                                $this->trace_model->addTrace($member_id, $invitee_id);
                                $this->trace_model->addTrace($invitee_id, $member_id);
                            }
                            else{
                                $this->db->trans_rollback();
                            }
                            echo json_encode($result, JSON_UNESCAPED_UNICODE);
                            return FALSE;
                        }
                    }else{
                        $this->db->trans_commit();
                        $this->trace_model->addTrace($member_id, $invitee_id);
                        $this->trace_model->addTrace($invitee_id, $member_id);
                        echo json_encode($result, JSON_UNESCAPED_UNICODE);
                        return TRUE;
                    }
                }else{
                    $this->db->trans_rollback();
                    echo json_encode($result, JSON_UNESCAPED_UNICODE);
                    return FALSE;
                }
            }else{
                if (empty($member_id)){
                    $result = array('status'=>'failed', 'message'=>$this->lang->line('invite_id_empty'), 'code'=>'I0001');
                    echo json_encode($result, JSON_UNESCAPED_UNICODE);
                    return FALSE;
                }
                if (is_null($status)){
                    $result = array('status'=>'failed', 'message'=>$this->lang->line('invite_status_empty'), 'code'=>'I0002');
                    echo json_encode($result, JSON_UNESCAPED_UNICODE);
                    return FALSE;
                }
            }
        }else{
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }
    }

    /**
     * 依會員ID取得被邀請者
     *
     * @param integer $member_id 會員ID
     * @param integer $status 狀態(0.不同意 1.同意 2.未決定)
     * @param integer $start_row 回傳筆數/指定從第幾筆開始(有$return_rows:第幾筆開始，沒有$return_rows:回傳筆數)
     * @param integer $return_rows 回傳筆數
     * @return json 被邀請者資料
     */
    public function getInviteeByMember()
    {
        if (isLogin(FALSE)){
            $member_id = $this->session->userdata('member_id');
            if (is_null($this->input->get_post('status'))){
                $status = 2;
            }else{
                $status = $this->input->get_post('status');
            }
            $start_row = $this->input->get_post('start_row');
            $return_rows = $this->input->get_post('return_rows');
            $invites = $this->invite_model->getInviteeByMember($member_id, $status, $start_row, $return_rows)->result_array();
            $result = array('status'=>'success', 'message'=>'', 'code'=>'', 'data'=>$invites);
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return TRUE;
        }else{
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }
    }

    /**=================================================================================================================
     * 依被邀請者ID取得會員
     ***================================================================================================================
     * @param integer $member_id 會員ID
     * @param integer $status 狀態(0.不同意 1.同意 2.未決定)
     * @param integer $start_row 回傳筆數/指定從第幾筆開始(有$return_rows:第幾筆開始，沒有$return_rows:回傳筆數)
     * @param integer $return_rows 回傳筆數
     * @return json 會員資料
     */
    public function getMemberByInvitee()
    {
        if (isLogin(FALSE)){
            $invitee_id = $this->session->userdata('member_id');
            if (is_null($this->input->get_post('status'))){
                $status = 2;
            }else{
                $status = $this->input->get_post('status');
            }
            $start_row = $this->input->get_post('start_row');
            $return_rows = $this->input->get_post('return_rows');
            $members = $this->invite_model->getMemberByInvitee($invitee_id, $status, $start_row, $return_rows)->result_array();
            $result = array('status'=>'success', 'message'=>'', 'code'=>'', 'data'=>$members);
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return TRUE;
        }else{
            $result = array('status'=>'failed', 'message'=>$this->lang->line('member_not_login_error'), 'code'=>'M0001');
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            return FALSE;
        }
    }
}