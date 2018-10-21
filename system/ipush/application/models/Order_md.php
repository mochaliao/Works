<?php


class Order_md extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    // 取得訂單
    function get_order($id = NULL, $member_id = NULL, $product_id = NULL, $pay_type = NULL, $begin_date = NULL, $end_date = NULL, $status = NULL)
    {
        $this->db->select('*')->from('v_order');
        // 參數 id 有值
        if ( !empty(trim($id)) ) {
            $this->db->where('id', trim($id));
        }
        // 參數 member_id 有值
        if ( !empty(trim($member_id)) ) {
            $this->db->where('member_id', trim($member_id));
        }
        // 參數 product_id 有值
        if ( !empty(trim($product_id)) ) {
            $this->db->where('product_id', trim($product_id));
        }
        // 參數 pay_type 有值
        if ( !empty(trim($pay_type)) ) {
            $this->db->where('pay_type', trim($pay_type));
        }
        // 參數 begin_date 有值
        if ( !empty(trim($begin_date)) ) {
            $where = "DATE_FORMAT(pay_date, '%Y-%m-%d') >= '".date('Y-m-d', strtotime($this->db->escape_str($begin_date)))."'";
            $this->db->where($where);
        }
        // 參數 end_date 有值
        if ( !empty(trim($end_date)) ) {
            $where = "DATE_FORMAT(pay_date, '%Y-%m-%d') <= '".date('Y-m-d', strtotime($this->db->escape_str($end_date)))."'";
            $this->db->where($where);
        }
        // 參數 status 有值
        if ( $status !== NULL ) {
            $this->db->where('status', $status);
        }

        return $this->db->get();
    }

    // 新增訂單
    function add_order($order)
    {
        $this->load->model('product_md');
        $member = $this->member_md->get_member($order['member_id'])->row_array();
        $product = $this->product_md->get_product($order['product_id'])->row_array();
        // 進行新增訂單
        $order['team_id'] = $member['team_id'];
        $order['product_name'] = $product['name'];
        $order['product_money'] = $product['money'];
        $order['product_times'] = $product['times'];
        $order['product_ipoint'] = $product['ipoint'];
        $order['product_link_percent'] = $product['link_percent'];
        $order['product_block_percent'] = $product['block_percent'];
        $order['product_tornado_percent'] = $product['tornado_percent'];
        $order['status'] = 0;
        $order['create_date'] = date('Y-m-d H:i:s');

        return $this->db->insert('order', $order);
    }

    // 訂單付款
    function pay_order($order_id, $pay_date)
    {
        $this->load->model('transaction_md');
        $order = $this->get_order($order_id)->row_array();
        $member = $this->member_md->get_member($order['member_id'])->row_array();
        // 檢查訂單是存在及態狀是否為0
        if (empty($order) || $order['status'] != 0){
            return FALSE;
        }

        $this->db->trans_begin();
        // 檢查 Bonus 是否存在
        $bonus_date = get_bonus_date();
        $this->db->select('*')->from('bonus');
        $this->db->where('member_id', $member['id']);
        $where = "DATE_FORMAT(bonus_date, '%Y-%m-%d') = '".$this->db->escape_str($bonus_date)."'";
        $this->db->where($where);
        // Link Bonus存在，更新 Bonus
        if ($this->db->get()->num_rows() > 0){
            $bonus['link_money'] = 1500;
            $bonus['link_ipoint'] = 3500;
            $bonus['link_unused'] = 1000;
            $bonus['block_money'] = 700;
            $bonus['block_ipoint'] = 300;
            $bonus['block_left_unused'] = 1000;
            $bonus['block_right_unused'] = 0;
            $this->db->update('bonus', $bonus);
            $bonus_id = $bonus['bonus_id'];
        }
        // Link Bonus不存在，新增 Bonus
        else{
            $bonus['member_id'] = $member['id'];
            $bonus['bonus_date'] = $bonus_date;
            $bonus['link_money'] = 1500;
            $bonus['link_ipoint'] = 3500;
            $bonus['link_unused'] = 1000;
            $bonus['block_money'] = floatval(700);
            $bonus['block_ipoint'] = floatval(300);
            $bonus['block_left_unused'] = floatval(1000);
            $bonus['block_right_unused'] = floatval(0);
            $bonus['create_date'] = date('Y-m-d H:i:s');
            $this->db->insert('bonus', $bonus);
            $bonus_id = $this->db->insert_id();
        }

        // 更新訂單狀態、bonus_id
        $upd_order['id'] = $order_id;
        $upd_order['status'] = 1;
        $upd_order['pay_date'] = $pay_date;
        $upd_order['bonus_id'] = $bonus_id;
        $this->update_order($upd_order);

        // 如果是第一張訂單, 才處理左右邊的問題(非最上層且未設定左右邊，更新左右邊設定值)
        $sql = 'SELECT COUNT(id) AS order_count FROM `order` WHERE member_id = '.$this->db->escape_str($member['id']).' AND `status` = 1 ';
        if ($this->db->query($sql)->row_array()['order_count'] == 0){
            if ($member['pid'] > 0 && (strtoupper($member['side']) !== 'L' || strtoupper($member['side']) !== 'R')){
                $upd_member['id'] = $member['id'];
                $upd_member['side'] = $this->member_md->get_side($upd_member['id']);
                $this->member_md->upd_member($upd_member['id'], $upd_member);
            }
        }

        // 進行新增transaction
        $transaction['member_id'] = $member['id'];
        $transaction['trans_type'] = 'Buy';
        $transaction['order_id'] = $order_id;
        $transaction['pay_type'] = $order['pay_type'];
        $transaction['money'] = $order['product_money'];
        $transaction['ipoint'] = $order['product_ipoint'];
        $this->transaction_md->add_transaction($transaction);

        //交易是否成功
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return FALSE;
        }else{
            $this->db->trans_commit();
            return TRUE;
        }
    }

    // 修改訂單
    function update_order($order)
    {
        return $this->db->where('id', $order['id'])->update('order', $order);
    }

    // 刪除訂單
    function delete_order($id)
    {
        return $this->db->delete('order', array('id'=>$id));
    }

    // 取得入金方式
    function get_pay_type($status = 1){
        $this->db->select('*')->from('pay_type')->where('status', $status);
        return $this->db->get();
    }
    
    // 取得指定會員訂單歷史最高等級資料列
    function get_top_order_by_member_id($member_id){
        $sql = 'SELECT level, product_ipoint, product_block_percent FROM v_order 
                WHERE member_id = ? AND status = ? 
                ORDER BY level DESC LIMIT 0, 1';
        return $this->db->query($sql, array($member_id, 1));
    }

}