<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Member_md extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // 取得系統後台會員資料
    public function sys_get_member($id = null, $account = null, $pwd = null, $status = null){
        $this->db->select('*')->from('sys_member');
        if ( !empty($id) ) {
            $this->db->where('id', $id);
        }
        if ( !empty($account) ) {
            $this->db->where('account', $account);
        }
        if ( !empty($pwd) ) {
            $this->db->where('pwd', md5($pwd));
        }
        if ( $status !== null ) {
            $this->db->where('status', $status);
        }
        return $this->db->get();
    }
    
    // 修改系統後台會員密碼
    public function sys_upd_password($id, $old, $new){
        $res = $this->sys_get_member($id, null, $old);
        if(!$res->num_rows() > 0) return false;
        $data  = array( 'pwd' => md5($new) );
        $where = array(
            'id'  => $id,
            'pwd' => md5($old)
        );
        return $this->db->update('sys_member', $data, $where);
    }

    // 依條件取得會員資料
    public function get_member( $id = null, $name = null, $email = null, $account = null, $pwd = null, $phone = null, $status = null, $is_certified = null )
    {
        $this->db->select('*')->from('v_member');
        if ( !empty($id) ) {
            $this->db->where('id', $id);
        }
        if ( !empty($name) ) {
            $this->db->like('name', $name);
        }
        if ( !empty($account) ) {
            $this->db->where('account', $account);
        }
        if ( !empty($email) ) {
            $this->db->where('email', $email);
        }
        if ( !empty($pwd) ) {
            $this->db->where('pwd', md5($pwd));
        }
        if ( !empty($phone) ) {
            $this->db->where('phone', $phone);
        }
        if ( $status !== null ) {
            $this->db->where('status', $status);
        }
        if ( $is_certified !== null ) {
            $this->db->where('is_certified', $is_certified);
        }
        return $this->db->get();
    }

    // 依 pid 查找會員資料
    public function get_member_by_pid($pid){
        $this->db->select('*')->from('v_member')->where('pid', $pid);
        return $this->db->get();
    }
    
    // 修改會員密碼
    public function upd_password($id, $old, $new){
        $res = $this->get_member($id, null, null, null, $old);
        if(!$res->num_rows() > 0) return false;
        $data  = array( 'pwd' => md5($new) );
        $where = array(
            'id'  => $id,
            'pwd' => md5($old)
        );
        return $this->db->update('member', $data, $where);
    }
    
    // 新增會員資料
    public function add_member($data){
        foreach($data as $k => $v) if(trim($v) === '') $data[$k] = null;
        $data['pwd'] = md5($data['pwd']);
        $data['create_date'] = date('Y-m-d H:i:s');
        return $this->db->insert('member', $data);
    }
    
    // 修改會員資料
    public function upd_member($id, $data){
        foreach($data as $k => $v) if(trim($v) === '') $data[$k] = null;
        if(isset($data['pwd'])) $data['pwd'] = md5($data['pwd']);
        $where = array( 'id' => $id );
        return $this->db->update('member', $data, $where);
    }

    // 取得會員左右邊
    public function get_side($member_id){
        $left_sum = 0;
        $right_sum = 0;
        $sql = "
        SELECT side, SUM(product_money) AS `sum`
            FROM (SELECT * FROM `v_order`
                ORDER BY pid, member_id) order_sorted,
                (SELECT @pv := ?) initialisation
            WHERE   FIND_IN_SET(pid, @pv)
                AND LENGTH(@pv := CONCAT(@pv, ',', member_id))
                AND (side = 'L' OR side = 'R')
            GROUP BY side
        ";
        $member = $this->get_member($member_id)->row_array();
        $sides = $this->db->query($sql, $member['pid'])->result_array();
        if (!empty($sides)){
            foreach ($sides as $side){
                if (trim($side['side']) == 'L'){
                    $left_sum .= $side['sum'];
                }else if (trim($side['side']) == 'R'){
                    $right_sum .= $side['sum'];
                }
            }
        }

        return ($left_sum <= $right_sum) ? 'L' : 'R';
    }
    
    // 取得會員星級
    public function get_level($member_id){
        $sql = 'SELECT CASE WHEN MAX(level) IS NULL THEN 0 ELSE MAX(level) END AS level FROM v_order WHERE member_id = ?';
        $row = $this->db->query($sql, array($member_id))->row_array();
        return current($row);
    }

    // 取得所有下線及其層級(0為全部)
    function get_all_children($member_id = 0, $orderby = 'ASC')
    {
        $param = array();
        $sql = '
            SELECT
                m.id,
                pid,
                `level`
                FROM (
                    SELECT
                        get_member_level_pid() AS id,
                        @level AS `level`
                        FROM
                            (SELECT @start_with := ?, @id := @start_with, @level := 0) vars,
                            member
                        WHERE
                            @id IS NOT NULL
                ) pm
                JOIN v_member m ON m.id = pm.id
                ORDER BY pm.level '.$this->db->escape_str($orderby).', m.id '.$this->db->escape_str($orderby).'
        ';
        array_push($param, $member_id);

        return $this->db->query($sql, $param);
    }
}


?>