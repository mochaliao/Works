<?php

class Invite_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 新增邀請
     *
     * @param integer $member_id 會員ID
     * @param integer $invitee_id 被邀請者會員ID
     * @return array 新增結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function addInvite($member_id, $invitee_id)
    {
        $invite['member_id'] = $member_id;
        $invite['invitee_id'] = $invitee_id;
            $this->load->model('like_model');
        

        if ($this->db->where('member_id', $invite['member_id'])->where('invitee_id', $invite['invitee_id'])->count_all_results('invites') == 0) {
            $this->db->insert('invites', $invite);
            $push_data = array();
      
        $result_invite = $this-> invite_model ->getMemberByInviteeLimit($member_id, $invitee_id, 1, 1)->result();
        $data['invite'] = $result_invite;
        array_push($push_data, $data);
        push_data($invitee_id, $push_data);
            if ($this->db->affected_rows() > 0){
                return array('status'=>'success', 'message'=>$this->lang->line('invite_add_success'), 'code'=>'', 'member_id'=>$member_id,'data'=>$push_data);
            }else{
                return array('status'=>'failed', 'message'=>$this->lang->line('invite_add_failed'), 'code'=>'I0001');
            }
        }else{
            return array('status'=>'failed', 'message'=>$this->lang->line('invite_already_exists'), 'code'=>'I0002');
        }
    }

    /**
     * 刪除邀請
     *
     * @param integer $member_id 會員ID
     * @param integer $invitee_id 被邀請者會員ID
     * @return array 刪除結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function delInvite($member_id = NULL, $invitee_id = NULL)
    {
		$this->load->model('invite_model');
        if ( ! empty($member_id) || ! empty($invitee_id)){
            if ( ! empty($member_id)) {
				$push_data = array();
				$result_invite = $this-> invite_model ->getMemberByInviteeLimit($member_id, $invitee_id, 1, 0)->result();
				$data['invite'] = $result_invite;
				array_push($push_data, $data);
				push_data($invitee_id, $push_data);
                $this->db->where('member_id', $member_id);
            }
            if ( ! empty($invitee_id)) {
                $this->db->where('invitee_id', $invitee_id);
            }
            if ($this->db->delete('invites')){
                return array('status'=>'success', 'message'=>$this->lang->line('invite_delete_success'), 'code'=>'');
            }else{
                return array('status'=>'failed', 'message'=>$this->lang->line('invite_delete_failed'), 'code'=>'I0001');
            }
        } else {
            return array('status'=>'failed', 'message'=>$this->lang->line('invite_delete_empty'), 'code'=>'I0002');
        }
    }

    /**
     * 同意或不同意邀請
     *
     * @param integer $member_id 會員ID
     * @param integer $invitee_id 被邀請者會員ID
     * @param integer $status 狀態(0.不同意 1.同意 2.未決定)
     * @return array 新增結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function setInviteStatus($member_id, $invitee_id, $status)
    {
        $invite['member_id'] = $member_id;
        $invite['invitee_id'] = $invitee_id;
        $invite['status'] = $status;
        $invite['modify_time'] = date('Y-m-d H:i:s');

        $data = array(
            'member_id'=>$member_id,
            'invitee_id'=>$invitee_id,
            'status'=>$status,
        );

        if ($this->db->where('member_id', $invite['member_id'])->where('invitee_id', $invite['invitee_id'])->update('invites', $invite)){
            $this->load->model('like_model');
            $this->like_model->addNotify($invitee_id, $member_id, "已經成為您的好友", ("/page/info?i=" . $invitee_id));
            return array('status'=>'success', 'message'=>$this->lang->line('invite_set_status_success'), 'code'=>'');
        }else{
            return array('status'=>'failed', 'message'=>$this->lang->line('invite_set_status_failed'), 'code'=>'I0003');
        }
    }

    /**
     * 依會員ID取得被邀請者
     *
     * @param integer $member_id 會員ID
     * @param integer $status 狀態(0.不同意 1.同意 2.未決定)
     * @param integer $start_row 回傳筆數/指定從第幾筆開始(有$return_rows:第幾筆開始，沒有$return_rows:回傳筆數)
     * @param integer $return_rows 回傳筆數
     * @return array of objects 被邀請者物件陣列(需用row_array或result_array轉換)
     */
    function getInviteeByMember($member_id, $status = NULL, $start_row = NULL, $return_rows = NULL)
    {
        $params = array();
        $sql = "
            SELECT i.status,m.*
            FROM invites AS i
	            INNER JOIN v_members AS m
		            ON i.invitee_id = m.member_id
            WHERE i.member_id = ?
        ";
        array_push($params, $member_id);

        //是否傳入狀態參數
        if (isset($status) && strtoupper($status) != 'NULL') {
            $sql .= 'AND i.status = ? ';
            array_push($params, $status);
        }
        $sql .= 'ORDER BY i.invitee_id ';
        //只指定傳回筆數(不指定從第幾筆開始)
        if (isset($start_row) && is_numeric($start_row) && (! isset($return_rows) || strtoupper($return_rows) == 'NULL' || ! is_numeric($return_rows))) {
            $sql .= 'LIMIT ? ';
            $start_row = ($start_row < 0 ? 0 : $start_row);
            array_push($params, intval($start_row));
        }
        //指定從那裏開始及回傳筆數
        elseif (isset($start_row) && is_numeric($start_row) && isset($return_rows) && is_numeric($return_rows)) {
            $sql .= 'LIMIT ?, ? ';
            $start_row = $start_row - 1;
            $start_row = ($start_row < 0 ? 0 : $start_row);
            $return_rows = ($return_rows < 0 ? 0 : $return_rows);
            array_push($params, intval($start_row), intval($return_rows));
        }

        return $this->db->query($sql, $params);
    }

    /**
     * 依被邀請者ID取得會員
     *
     * @param integer $invitee_id 被邀請人ID
     * @param integer $status 狀態(0.不同意 1.同意 2.未決定)
     * @param integer $start_row 回傳筆數/指定從第幾筆開始(有$return_rows:第幾筆開始，沒有$return_rows:回傳筆數)
     * @param integer $return_rows 回傳筆數
     * @return array of objects 會員物件陣列(需用row_array或result_array轉換)
     */
    function getMemberByInvitee($invitee_id, $status = NULL, $start_row = NULL, $return_rows = NULL)
    {
        $params = array();
        $sql = "
            SELECT m.*
            FROM invites AS i
	            INNER JOIN v_members AS m
		            ON i.member_id = m.member_id
            WHERE i.invitee_id = ?
        ";
        array_push($params, $invitee_id);

        //是否傳入狀能參數
        if (isset($status)) {
            $sql .= 'AND i.status = ? ';
            array_push($params, $status);
        }
        $sql .= 'ORDER BY i.member_id ';
        //只指定傳回筆數(不指定從第幾筆開始)
        if (isset($start_row) && is_numeric($start_row) && (! isset($return_rows) || strtoupper($return_rows) == 'NULL' || ! is_numeric($return_rows))) {
            $sql .= 'LIMIT ? ';
            $start_row = ($start_row < 0 ? 0 : $start_row);
            array_push($params, intval($start_row));
        }
        //指定從那裏開始及回傳筆數
        elseif (isset($start_row) && is_numeric($start_row) && isset($return_rows) && is_numeric($return_rows)) {
            $sql .= 'LIMIT ?, ? ';
            $start_row = $start_row - 1;
            $start_row = ($start_row < 0 ? 0 : $start_row);
            $return_rows = ($return_rows < 0 ? 0 : $return_rows);
            array_push($params, intval($start_row), intval($return_rows));
        }

        return $this->db->query($sql, $params);
    }

    function getMemberByInviteeLimit($member_id, $invitee_id, $limit, $status=0)
    {
        $params = array();
        if($status==0){
        $sql = "
            SELECT m.*
            FROM invites AS i
                INNER JOIN v_members AS m
                    ON i.member_id = m.member_id
            WHERE i.invitee_id = ? AND i.member_id = ? ORDER BY sn DESC LIMIT ?
        ";
        }else if($status=1){
        $sql = "
            SELECT i.status as istatus, m.*
            FROM invites AS i
                INNER JOIN v_members AS m
                    ON i.member_id = m.member_id
            WHERE i.invitee_id = ? AND i.member_id = ? ORDER BY sn DESC LIMIT ?
        ";
        }
        array_push($params, $invitee_id, $member_id ,$limit);

        return $this->db->query($sql, $params);
    }
}