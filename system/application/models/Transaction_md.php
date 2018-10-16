<?php


class Transaction_md extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    // 取得交易
    function get_transaction($id = NULL, $member_id = NULL, $trans_type = NULL, $trans_date = NULL, $order_id = NULL, $bonus_id = NULL, $iami_id = NULL)
    {
        $this->db->select('*')->from('v_transaction');
        // 交易ID
        if ( !empty($id) ) {
            $this->db->where('id', $id);
        }
        // 會員ID
        if ( !empty($member_id) ) {
            $this->db->where('member_id', $member_id);
        }
        // 交易類型
        if ( !empty($trans_type) ) {
            $this->db->where('trans_type', $trans_type);
        }
        // 交易日期
        if ( !empty($trans_date) ) {
            $where = "DATE_FORMAT(create_date, '%Y-%m-%d') = '".date('Y-m-d', strtotime($this->db->escape_str($trans_date)))."'";
            $this->db->where($where);
        }
        // 訂單ID
        if ( !empty($order_id) ) {
            $this->db->where('order_id', $order_id);
        }
        // 獎金ID
        if ( !empty($bonus_id) ) {
            $this->db->where('bonus_id', $bonus_id);
        }
        // IAMI的ID
        if ( !empty($iami_id) ) {
            $this->db->where('iami_id', $iami_id);
        }
        $this->db->order_by('create_date', 'desc');
        return $this->db->get();
    }

    // 新增交易
    function add_transaction($transaction)
    {
        foreach($transaction as $k => $v) if(trim($v) === '') $transaction[$k] = null;
        $transaction['create_date'] = date('Y-m-d H:i:s');

        return $this->db->insert('transaction', $transaction);
    }

    // 取交易類型
    function get_trans_type($trans_type = NULL)
    {
        $this->db->select('*')->from('trans_type');
        if ( !empty($trans_type) ) {
            $this->db->where('trans_type', $trans_type);
        }

        return $this->db->get();
    }

}