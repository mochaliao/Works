<?php

class Friend_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function isFriend($member_id, $friend_id){
        $where = '(member_id = '.$member_id.' AND friend_id = '.$friend_id.') OR (friend_id= '.$member_id.' AND member_id = '.$friend_id.')';
        if ($this->db->where($where)->count_all_results('friends') == 0) {
            return false;
        }
        else{
            return true;
        }
    }

    /**
     * 新增好友
     *
     * @param integer $member_id 會員ID
     * @param integer $friend_id 好友ID
     * @return array 新增結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function addFriend($member_id, $friend_id)
    {   
        $where = '(member_id = '.$member_id.' AND friend_id = '.$friend_id.') OR (friend_id= '.$member_id.' AND member_id = '.$friend_id.')';
        if ($this->db->where($where)->count_all_results('friends') == 0) {
            $friend['member_id'] = $member_id;
            $friend['friend_id'] = $friend_id;
            if ($this->db->insert('friends', $friend)){
                return array('status'=>'success', 'message'=>$this->lang->line('friend_add_success'), 'code'=>'');
            }else{
                return array('status'=>'failed', 'message'=>$this->lang->line('friend_add_failed'), 'code'=>'F0001');
            }
        }else{
            return array('status'=>'failed', 'message'=>$this->lang->line('friend_already_exists'), 'code'=>'F0002');
        }
    }

    /**
     * 刪除好友
     *
     * @param integer $member_id 會員ID
     * @param integer $friend_id 好友ID
     * @return array 刪除結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function delFriend($member_id = NULL, $friend_id = NULL)
    {
        if ( ! empty($member_id) && ! empty($friend_id)){
            $where = '(member_id = '.$member_id.' AND friend_id = '.$friend_id.') OR (friend_id= '.$member_id.' AND member_id = '.$friend_id.')';
            if ($this->db->where($where)->delete('friends')){
                return array('status'=>'success', 'message'=>$this->lang->line('friend_delete_success'), 'code'=>'');
            }else{
                return array('status'=>'failed', 'message'=>$this->lang->line('friend_delete_failed'), 'code'=>'F0001');
            }
        } else {
            return array('status'=>'failed', 'message'=>$this->lang->line('friend_delete_empty'), 'code'=>'F0002');
        }
    }

    /**
     * 依會員ID及好友ID取得好友(回傳單筆資料)
     *
     * @param integer $member_id 會員ID
     * @param integer $friend_id 好友ID
     * @return array of objects 好友物件陣列(需用row_array或result_array轉換)
     */
    function getFriend($member_id, $friend_id, $start_row = NULL, $return_rows = NULL)
    {
        $params = array();
        $sql = "
            SELECT m.*
            FROM friends AS f
	            INNER JOIN v_members AS m
		            ON f.friend_id = m.member_id
            WHERE (f.member_id = ? AND f.friend_id = ?) OR (f.friend_id = ? AND f.member_id = ?)
        ";
        array_push($params, intval($member_id));
        array_push($params, intval($friend_id));
        array_push($params, intval($member_id));
        array_push($params, intval($friend_id));

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
     * 依會員ID及好友ID取得好友(回傳單筆資料)
     *
     * @param integer $member_id 會員ID
     * @param integer $friend_id 好友ID
     * @return array of objects 好友物件陣列(需用row_array或result_array轉換)
     */
    function getNotFriend($member_id, $start_row = NULL, $return_rows = NULL)
    {
        $params = array();
        $sql = "
            SELECT *
                FROM v_members
                WHERE member_id <> ?
                    AND member_id NOT IN (SELECT friend_id FROM friends WHERE member_id = ?)
        ";
        array_push($params, intval($member_id));
        array_push($params, intval($member_id));

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
     * 依會員ID取得好友
     *
     * @param integer $member_id 會員ID
     * @param integer $start_row 回傳筆數/指定從第幾筆開始(有$return_rows:第幾筆開始，沒有$return_rows:回傳筆數)
     * @param integer $return_rows 回傳筆數
     * @return array of objects 好友物件陣列(需用row_array或result_array轉換)
     */
    function getFriendByMember($member_id, $start_row = NULL, $return_rows = NULL)
    {
        $params = array();
        $sql = "
            SELECT m.*
            FROM friends AS f
	            INNER JOIN v_members AS m
		            ON f.friend_id = m.member_id
            WHERE f.member_id = ?
            ORDER BY m.member_id
        ";
        array_push($params, intval($member_id));

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
     * 依好友ID取得會員
     *
     * @param integer $friend_id 好友ID
     * @param integer $start_row 回傳筆數/指定從第幾筆開始(有$return_rows:第幾筆開始，沒有$return_rows:回傳筆數)
     * @param integer $return_rows 回傳筆數
     * @return array of objects 會員物件陣列(需用row_array或result_array轉換)
     */
    function getMemberByFriend($friend_id, $start_row = NULL, $return_rows = NULL)
    {
        $params = array();
        $sql = "
            SELECT m.*
            FROM friends AS f
	            INNER JOIN v_members AS m
		            ON f.member_id = m.member_id
            WHERE f.friend_id = ?
            ORDER BY m.member_id
        ";
        array_push($params, $friend_id);

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
     * 取得共同好友
     *
     * @param integer $member_id 會員ID
     * @param integer $friend_id 好友ID
     * @param integer $start_row 回傳筆數/指定從第幾筆開始(有$return_rows:第幾筆開始，沒有$return_rows:回傳筆數)
     * @param integer $return_rows 回傳筆數
     * @return array of objects 會員物件陣列(需用row_array或result_array轉換)
     */
    function getMutualFriend($member_id, $friend_id, $start_row = NULL, $return_rows = NULL)
    {
        $params = array();
        $sql = "
            SELECT m.*
                FROM friends AS f1
                    INNER JOIN friends AS f2
                        ON f1.friend_id = f2.friend_id
                    INNER JOIN members AS m
                        ON f1.friend_id = m.member_id
                WHERE f1.member_id = ? AND f2.member_id = ?
        ";
        array_push($params, $member_id);
        array_push($params, $friend_id);

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
     * 取得好友名單(雙向)
     *
     * @param integer $member_id 會員ID
     * @param integer $start_row 回傳筆數/指定從第幾筆開始(有$return_rows:第幾筆開始，沒有$return_rows:回傳筆數)
     * @param integer $return_rows 回傳筆數
     * @param integer $isOnline 是否在线
     * @return array of objects 好友物件陣列(需用row_array或result_array轉換)
     */
    function getFriendList($member_id, $start_row = NULL, $return_rows = NULL, $isOnline = NULL)
    {
        $params = array();
        $sql = "
            SELECT m.* FROM
	            (SELECT friend_id FROM friends WHERE member_id = ?
	             UNION
	             SELECT member_id FROM friends WHERE friend_id = ?) AS f
		            INNER JOIN v_members AS m
			            ON m.member_id = f.friend_id
	            WHERE m.member_id <> ?
        ";
        if(isset($isOnline)){
            $sql=$sql." and m.isOnline=1 ";
        }

        array_push($params, intval($member_id));
        array_push($params, intval($member_id));
        array_push($params, intval($member_id));

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
}