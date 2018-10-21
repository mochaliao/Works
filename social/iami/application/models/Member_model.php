<?php

class Member_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 依email取得會員資料
     *
     * @param string $email 會員email
     * @param integer $status 會員狀態(0.停用 1.已啟用 2.未啟用)
     * @return array of objects 會員物件陣列(需用row_array或result_array轉換)
     */
    function getMemberByEmail($email, $status = NULL)
    {
        $params = array();
        $sql = "SELECT * FROM v_members WHERE email = ? ";
        array_push($params, $email);

        if (isset($status)){
            $sql .= 'AND status = ? ';
            array_push($params, $status);
        }

        return $this->db->query($sql, $params);
    }

    /**
     * 依member_id取得會員資料
     *
     * @param integer $member_id 會員member_id
     * @param integer $status 會員狀態(0.停用 1.已啟用 2.未啟用)
     * @return array of objects 會員物件陣列(需用row_array或result_array轉換)
     */
    function getMember($member_id, $status = NULL)
    {
        $params = array();
        $sql = "SELECT * FROM v_members WHERE member_id = ? ";
        array_push($params, $member_id);

        if (isset($status)){
            $sql .= 'AND status = ? ';
            array_push($params, $status);
        }

        return $this->db->query($sql, $params);
    }

    /**
     * 新增會員
     *
     * @param array $member 會員資料陣列
     * @return array 新增結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function addMember($member)
    {
        $member['password'] = md5($member['password']);
        $this->db->insert('members', $member);
        if ($this->db->affected_rows() > 0){
            return array('status'=>'success', 'message'=>$this->lang->line('member_add_success'), 'code'=>'', "data" => $this->db->insert_id());
        }else{
            return array('status'=>'failed', 'message'=>$this->lang->line('member_add_failed'), 'code'=>'M0001');
        }
    }

    /**
     * 修改會員
     *
     * @param array $member 會員資料陣列
     * @return array 新增結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function editMember($member)
    {
        if (isset($member['password'])) {
            $member['password'] = md5($member['password']);
        }
        if ($this->db->where('member_id', $member['member_id'])->update('members', $member)){
            return array('status'=>'success', 'message'=>$this->lang->line('member_edit_success'), 'code'=>'');
        }else{
            return array('status'=>'failed', 'message'=>$this->lang->line('member_edit_failed'), 'code'=>'M0002');
        }
    }

    function getMemberByMobile($mobile, $status = NULL)
    {
        $params = array();
        $sql = "SELECT * FROM v_members WHERE mobile = ? ";
        array_push($params, $mobile);

        if (isset($status)){
            $sql .= 'AND status = ? ';
            array_push($params, $status);
        }

        return $this->db->query($sql, $params);
    }

}

