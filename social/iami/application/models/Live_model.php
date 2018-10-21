<?php

class Live_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 取得直播
     *
     * @param varchar(64) $qiniu_id 七牛直播ID
     * @return array 新增結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function getLive($qiniu_id = NULL)
    {
        if (isset($qiniu_id)){
            return $this->db->where('qiniu_id', $qiniu_id)->get('lives');
        }else{
            return $this->db->get('lives');
        }
    }

    /**
     * 新增直播
     *
     * @param array $live 直播新增內容陣列
     * @return array 新增結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function addLive($live)
    {
        $live_id = $this->db->insert('lives', $live);
        if ($this->db->affected_rows() > 0){
            return array('status'=>'success', 'message'=>$live_id, 'code'=>'');
        }else{
            return array('status'=>'failed', 'message'=>$this->lang->line('member_add_failed'), 'code'=>'L0001');
        }
    }

    /**
     * 刪除直播
     *
     * @param integer $live_id 直播ID
     * @return array 刪除結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function delLive($qiniu_id = NULL)
    {
        if ($this->db->where('qiniu_id', $qiniu_id)->delete('lives')){
            return array('status'=>'success', 'message'=>$this->lang->line('live_delete_success'), 'code'=>'');
        }else{
            return array('status'=>'failed', 'message'=>$this->lang->line('live_delete_failed'), 'code'=>'L0002');
        }
    }

    /**
     * 更新直播
     *
     * @param array $live 直播更新內容陣列
     * @return array 更新結果 (status: success|failed, message: 訊息, code: 錯誤代碼 )
     */
    function editLive($live)
    {
        if ($this->db->where('qiniu_id', $live['qiniu_id'])->update('lives', $live)){
            return array('status'=>'success', 'message'=>$this->lang->line('live_edit_success'), 'code'=>'');
        }else{
            return array('status'=>'failed', 'message'=>$this->lang->line('live_edit_failed'), 'code'=>'L0003');
        }
    }

    /**
     * 依狀態取得直播清單
     *
     * @param integer $start_row 回傳筆數/指定從第幾筆開始(有$return_rows:第幾筆開始，沒有$return_rows:回傳筆數)
     * @param integer $return_rows 回傳筆數
     * @return array of objects 被追踨者物件陣列(需用row_array或result_array轉換)
     */
    function getLiveByStatus($status = NULL, $start_row = NULL, $return_rows = NULL)
    {
        $params = array();
        $sql = "
            SELECT
                l.*,
                m.nickname,
                m.avatar,
                m.email,
                m.gender,
                m.language_id,
                m.level
                FROM lives AS l
                    INNER JOIN members AS m
                        ON l.member_id = m.member_id
                WHERE 1 = 1
        ";
        if (isset($status)){
            $sql .= "AND l.status = ? ";
            array_push($params, $status);
        }

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