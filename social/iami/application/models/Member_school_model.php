<?php

class Member_school_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getMemberSchool($member_id, $start_row = NULL, $return_rows = NULL)
    {
        $params = array();
        $sql = 'SELECT * FROM member_schools WHERE member_id = ? ORDER BY sn ';
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

    function editMemberSchool($member_id, $schools)
    {
        $this->db->where('member_id', $member_id);
        if ($this->db->delete('member_schools')){
            if (! empty($schools)){
                if ($this->db->insert_batch('member_schools', $schools)){
                    return array('status' => 'success', 'message' => $this->lang->line('member_school_edit_success'), 'code' => '');
                }else{
                    return array('status' => 'failed', 'message' => $this->lang->line('member_school_edit_failed'), 'code' => 'M2001');
                }
            }
        }else{
            return array('status' => 'failed', 'message' => '', 'code' => '');
        }
    }
}