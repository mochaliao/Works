<?php

class Member_company_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getMemberCompany($member_id, $start_row = NULL, $return_rows = NULL)
    {
        $params = array();
        $sql = 'SELECT * FROM member_companys WHERE member_id = ? ORDER BY sn ';
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

    function editMemberCompany($member_id, $companys)
    {
        $this->db->where('member_id', $member_id);
        if ($this->db->delete('member_companys')){
            if (! empty($companys)){
                if ($this->db->insert_batch('member_companys', $companys)){
                    return array('status' => 'success', 'message' => $this->lang->line('member_company_edit_success'), 'code' => '');
                }else{
                    return array('status' => 'failed', 'message' => $this->lang->line('member_company_edit_failed'), 'code' => 'M1001');
                }
            }
        }else{
            return array('status' => 'failed', 'message' => '', 'code' => '');
        }
    }
}