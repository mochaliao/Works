<?php


class Bonus_md extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_bonus($id = NULL, $member_id = NULL, $bonus_date = NULL)
    {
        $this->db->select('*')->from('bonus');
        // 獎金ID
        if ( !empty($id) ) {
            $this->db->where('id', $id);
        }
        // 會員ID
        if ( !empty($member_id) ) {
            $this->db->where('member_id', $member_id);
        }
        // 獎金計算日
        if ( !empty($bonus_date) ) {
            $where = "DATE_FORMAT(bonus_date, '%Y-%m-%d') = '".date('Y-m-d', strtotime($this->db->escape_str($bonus_date)))."'";
            $this->db->where($where);
        }

        return $this->db->get();
    }

    // 獎金結算
    function do_bonus($member_id = NULL, $bonus_date = NULL)
    {
        $param = array();
        $this->load->model('transaction_md');
        $this->load->model('order_md');
        //$this->load->library('link');
        //$this->load->library('block');

        // 沒指定獎金計算日的話，預設為昨天
        if (empty($bonus_date)){
            $bonus_date = date('Y-m-d', strtotime($bonus_date." -1 days"));
        }else{
            $bonus_date = date('Y-m-d', strtotime($bonus_date));
        }

        // 取得要被計算的客戶
        if (empty($member_id)){
            $members = $this->member_md->get_all_children(0, 'DESC')->result_array();
        }else{
            $members = $this->member_md->get_all_children($member_id, 'DESC')->result_array();
        }
        foreach ($members as $member){
            $this->db->trans_begin();
            // 檢查 Bonus 是否存在
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
                $bonus['bonus_date'] = date('Y-m-d', strtotime($this->db->escape_str($member['pay_date'])));
                $bonus['link_money'] = 1500;
                $bonus['link_ipoint'] = 3500;
                $bonus['link_unused'] = 1000;
                $bonus['block_money'] = 700;
                $bonus['block_ipoint'] = 300;
                $bonus['block_left_unused'] = 1000;
                $bonus['block_right_unused'] = 0;
                $bonus['create_date'] = date('Y-m-d H:i:s');
                $this->db->insert('bonus', $bonus);
                $bonus_id = $this->db->insert_id();
            }

            // 新增transaction
            // 使用i分兌換獎金
            $transaction['member_id'] = $bonus['member_id'];
            $transaction['bonus_id'] = $bonus_id;
            $transaction['trans_type'] = 'Cost';
            $transaction['money'] = 0;
            $transaction['ipoint'] = $bonus['ipoint'];
            $this->db->insert('transaction', $transaction);
            // 從i分錢包扣除兌換獎金的i分
            $sql = 'UPDATE member SET wallet_ipoint = wallet_ipoint - ? WHERE member_id = ? ';
            unset($param);
            array_push($param, abs($transaction['ipoint']));
            array_push($param, $transaction['member_id']);
            $this->db->query($sql);
            // 獎金發放
            $transaction['member_id'] = $bonus['member_id'];
            $transaction['bonus_id'] = $bonus_id;
            $transaction['trans_type'] = 'Bonus';
            $transaction['money'] = $bonus['money'];
            $transaction['ipoint'] = $bonus['ipoint'];
            $this->db->insert('transaction', $transaction);
            // 把獎金入到i分錢包及現金錢包
            $sql = 'UPDATE member SET wallet_ipoint = wallet_ipoint + ?, wallet_cash = wallet_cash + ? WHERE member_id = ? ';
            unset($param);
            array_push($param, abs($transaction['ipoint']));
            array_push($param, abs($transaction['money']));
            array_push($param, $transaction['member_id']);
            $this->db->query($sql);

            // 更新狀態為已結算
            $upd_bonus['id'] = $bonus_id;
            $upd_bonus['status'] = 1;
            $this->update_bonus($upd_bonus);

            // 交易是否成功
            $bonus_log['member_id'] = $bonus['member_id'];
            $bonus_log['bonus_date'] = $bonus['bonus_date'];
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                $bonus_log['bonus_status'] = 0;
                $bonus_log['message'] = '發生錯誤，獎金結算失敗 !';

            }else{
                $this->db->trans_commit();
                $bonus_log['bonus_status'] = 1;
                $bonus_log['message'] = '獎金結算成功 !';
            }
            $this->add_bonus_log($bonus_log);
        }

        return TRUE;
    }

    // 修改獎金
    function update_bonus($bonus)
    {
        return $this->db->where('id', $bonus['id'])->update('bonus', $bonus);
    }

    // 新增獎金發放結果
    function add_bonus_log($bonus_log)
    {
        return $this->db->insert('bonus_log', $bonus_log);
    }
}