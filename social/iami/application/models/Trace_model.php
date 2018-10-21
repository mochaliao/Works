<?php

class Trace_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 新增追踨
     *
     * @param integer $member_id 會員ID
     * @param integer $trace_id 被追踨會員ID
     * @return array 新增結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function addTrace($member_id, $trace_id)
    {
        $trace['member_id'] = $member_id;
        $trace['trace_id'] = $trace_id;
        if ($this->db->where('member_id', $trace['member_id'])->where('trace_id', $trace['trace_id'])->count_all_results('traces') == 0) {
            if ($this->db->insert('traces', $trace)){
                return array('status'=>'success', 'message'=>$this->lang->line('trace_add_success'), 'code'=>'');
            }else{
                return array('status'=>'failed', 'message'=>$this->lang->line('trace_add_failed'), 'code'=>'T0001');
            }
        }else{
            return array('status'=>'failed', 'message'=>$this->lang->line('trace_already_exists'), 'code'=>'T0002');
        }
    }

    /**
     * 刪除追踨
     *
     * @param integer $member_id 會員ID
     * @param integer $trace_id 被追踨會員ID
     * @return array 刪除結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function delTrace($member_id = NULL, $trace_id = NULL)
    {
        if ( ! empty($member_id) || ! empty($trace_id)){
            if ( ! empty($member_id)) {
                $this->db->where('member_id', $member_id);
            }
            if ( ! empty($trace_id)) {
                $this->db->where('trace_id', $trace_id);
            }
            if ($this->db->delete('traces')){
                return array('status'=>'success', 'message'=>$this->lang->line('trace_delete_success'), 'code'=>'');
            }else{
                return array('status'=>'failed', 'message'=>$this->lang->line('trace_delete_failed'), 'code'=>'T0001');
            }
        } else {
            return array('status'=>'failed', 'message'=>$this->lang->line('trace_delete_empty'), 'code'=>'T0002');
        }
    }

    /**
     * 依會員ID取得被追踨者
     *
     * @param integer $member_id 會員ID
     * @param integer $start_row 回傳筆數/指定從第幾筆開始(有$return_rows:第幾筆開始，沒有$return_rows:回傳筆數)
     * @param integer $return_rows 回傳筆數
     * @return array of objects 被追踨者物件陣列(需用row_array或result_array轉換)
     */
    function getTraceByMember($member_id, $start_row = NULL, $return_rows = NULL)
    {
        $params = array();
        $sql = "
            SELECT
                (SELECT COUNT(1) FROM friends WHERE (member_id = t.member_id AND friend_id = t.trace_id) OR (member_id = t.trace_id AND friend_id = t.member_id)) AS 'is_friend',
                1 AS 'is_trace',
                (SELECT STATUS FROM invites WHERE member_id = t.member_id AND invitee_id = t.trace_id) AS 'invite_status',
                m.*
            FROM traces AS t
	            INNER JOIN v_members AS m
		            ON t.trace_id = m.member_id
            WHERE t.member_id = ?
            ORDER BY m.member_id
        ";
        array_push($params, $member_id);

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
     * 依被追踨者ID取得會員
     *
     * @param integer $trace_id 被追踨者ID
     * @param integer $start_row 回傳筆數/指定從第幾筆開始(有$return_rows:第幾筆開始，沒有$return_rows:回傳筆數)
     * @param integer $return_rows 回傳筆數
     * @return array of objects 被追踨者物件陣列(需用row_array或result_array轉換)
     */
    function getMemberByTrace($trace_id)
    {
        $params = array();
        $sql = "
            SELECT
                (SELECT COUNT(1) FROM friends WHERE (member_id = t.member_id AND friend_id = t.trace_id) OR (member_id = t.trace_id AND friend_id = t.member_id)) AS 'is_friend',
                (SELECT COUNT(1) FROM traces WHERE member_id = t.trace_id AND trace_id = t.member_id) AS 'is_trace',
                (SELECT STATUS FROM invites WHERE member_id = t.trace_id AND invitee_id = t.member_id) AS 'invite_status',
                m.*
            FROM traces AS t
	            INNER JOIN v_members AS m
		            ON t.member_id = m.member_id
            WHERE t.trace_id = ?
            ORDER BY m.member_id
        ";
        array_push($params, $trace_id);

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
     * 取得會員的追踨數
     *
     * @param integer $member_id 會員ID
     * @return integer
     */
    function getTraceCount($member_id){
        $params = array();
        $sql = "SELECT COUNT(1) AS TraceCount FROM traces WHERE member_id = ? ";
        array_push($params, $member_id);
        $result = $this->db->query($sql, $params)->row_array();

        return $result['TraceCount'];
    }

    /**
     * 取得會員的粉絲數
     *
     * @param integer $member_id 被追踨者ID
     * @return integer
     */
    function getFansCount($trace_id){
        $params = array();
        $sql = "SELECT COUNT(1) AS FansCount FROM traces WHERE trace_id = ? ";
        array_push($params, $trace_id);
        $result = $this->db->query($sql, $params)->row_array();

        return $result['FansCount'];
    }
}