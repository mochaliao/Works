<?php


class Sms_md extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    // 取得簡訊 Log
    function get_sms( $member_id = null, $phone = null, $message = null, $begin_date = null, $end_date = null )
    {
        $this->db->select('*');
        $this->db->from('v_sms_log');
        // 參數 member_id 有值
        if ( !empty(trim($member_id)) ) {
            $this->db->where('member_id', trim($member_id));
        }
        // 參數 phone 有值
        if ( !empty(trim($phone)) ) {
            $this->db->where('phone', trim($phone));
        }
        // 參數 message 有值
        if ( !empty(trim($message)) ) {
            $this->db->like('message', trim($message));
        }
        // 參數 begin_date 有值
        if ( !empty(trim($begin_date)) ) {
            $this->db->where('create_date >=', trim($begin_date));
        }
        // 參數 end_date 有值
        if ( !empty(trim($end_date)) ) {
            $this->db->where('create_date <=', trim($end_date));
        }

        return $this->db->get();
    }

    // 新增簡訊 Log
    function add_sms( $sms )
    {
        $sms['create_date'] = date("Y-m-d H:i:s");
        return $this->db->insert('sms_log', $sms);
    }

    // 更新簡訊 Log
    function update_sms( $sms )
    {
        return $this->db->where('id', $sms['id'])->update('sms_log', $sms);
    }

    // 取得簡訊狀態名稱
    function get_statusname( $statuscode )
    {
        $this->db->select('statusname');
        $this->db->from('sms_statuscode');
        $this->db->where('statuscode', trim($statuscode));

        return $this->db->get();
    }

}