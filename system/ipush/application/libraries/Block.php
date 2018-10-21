<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
**  [ 對碰結算物件 ]
**      撈取左右邊所有的子會員, 加總其計算區間內的業績值後
**      取左右邊較小的業績值, 乘以此會員購買最高歷史記錄的區塊算力百分比
**/

require_once(dirname(__FILE__) . '/Checkout.php');

class Block extends Checkout{
    
    // 最高訂單等級 ( level )
    private $level = 0;
    // 最高獎金容量 ( product_ipoint )
    private $container = 0;
    // 區塊算力百分比 ( product_block_percent )
    private $block_percent = 0;
    
    // 上次區塊算力左側未用到獎金
    private $block_left_unused = 0;
    // 上次區塊算力右側未用到獎金
    private $block_right_unused = 0;
    
    // 直屬下線全展會員, 分左右邊
    private $members = array(
        'left'  => array(),
        'right' => array()
    );
    
    // 設置初始參數
    public function set_param($param){
        parent::set_param($param);
        
        // 設定最高訂單參數
        $top_order = $this->ci->order_md->get_top_order_by_member_id($this->member['id'])->row_array();
        if($top_order !== null){
            $this->level         = $top_order['level'];
            $this->container     = $top_order['product_ipoint'];
            $this->block_percent = $top_order['product_block_percent'];
        }else{
            $this->level         = 0;
            $this->container     = 0;
            $this->block_percent = 0;
        }
        
        // 設定上一次區塊算力未用到的獎金參數
        $bonus = $this->ci->db->query('SELECT * FROM bonus WHERE member_id = ? AND bonus_date = ?', array( $this->member['id'], substr(date('Y-m-d', strtotime('-1 day', strtotime($this->time['start']))), 0, 10) ))->row_array();
        if($bonus !== null){
            $this->block_left_unused  = $bonus['block_left_unused'];
            $this->block_right_unused = $bonus['block_right_unused'];
        }else{
            $this->block_left_unused  = 0;
            $this->block_right_unused = 0;
        }
        
        // 取得直屬下線全展會員, 並分為左右兩邊加入陣列待處理
        $this->set_childrens();
        
        // 設定傳回的結果集
        $this->set_result();
    }
    
    // 取得直屬下線全展會員
    private function get_childrens($member_id = null){
        if($member_id === null) $member_id = $this->member['id'];
        $members = $this->ci->member_md->get_member_by_pid($member_id)->result_array();
        foreach($members as $k => $v){
            $members[$k] = array(
                'member_id'   => $v['id'],
                'member_name' => $v['name'],
                'side'        => $v['side'],
                'orders'      => array(),
                'childrens' => $this->get_childrens($v['id'])
            );
            // 逐項取得下線會員的計算日訂單
            $orders = $this->ci->order_md->get_order(null, $v['id'], null, null, $this->time['start'], $this->time['end'], 1)->result_array();
            foreach($orders as $kk => $vv){
                array_push($members[$k]['orders'], array(
                    'order_id'           => $vv['id'],
                    'order_price'        => $vv['product_money']
                ));
            }
        }
        return $members;
    }
    
    // 取得直屬下線全展會員, 並分為左右兩邊加入陣列待處理
    private function set_childrens(){
        $members = $this->get_childrens();
        foreach($members as $k => $v){
            if($v['side'] == 'L') array_push($this->members['left'] , $v);
            if($v['side'] == 'R') array_push($this->members['right'], $v);
        }
    }
    
    // 開始計算對碰獎金並返回結果集
    protected function set_result(){
        $response = array(
            'member_id'          => $this->member['id'],       // 會員 ID
            'member_name'        => $this->member['name'],     // 會員名稱
            'left_sales_volume'  => $this->block_left_unused,  // 左側業績總額
            'right_sales_volume' => $this->block_right_unused, // 右側業績總額
            'sales_bonus'        => 0,                         // 業績獎金 ( 實得, 未拆帳 )
            'bonus_container'    => $this->container,          // 獎金最高限額
            'bonus_total'        => 0,                         // 業績獎金 ( 總額, 不考慮上限問題 )
            'bonus_unused'       => 0,                         // 業績獎金未使用部份 ( 即超出上限部份 )
            'block_left_unused'  => 0,                         // 左側對碰後未使用獎金 ( 下次計算時使用 )
            'block_right_unused' => 0,                         // 右側對碰後未使用獎金 ( 下次計算時使用 )
            'members'            => $this->members             // 下屬所有會員 ( 遞迴全展 )
        );
        // 先算左邊
        $response = $this->loop_l_result($this->members['left'],  $response);
        // 再算右邊
        $response = $this->loop_r_result($this->members['right'], $response);
        // 結算左右對碰
        $response['bonus_total']  = min($response['left_sales_volume'], $response['right_sales_volume']);
        $response['sales_bonus']  = $response['bonus_total'] - $response['bonus_container'] > 0 ? $response['bonus_container'] : $response['bonus_total'];
        $response['bonus_unused'] = $response['bonus_total'] - $response['bonus_container'] > 0 ? $response['bonus_total'] - $response['bonus_container'] : 0;
        if($response['left_sales_volume'] > $response['right_sales_volume']){ // 左大於右
            $response['block_left_unused'] = $response['left_sales_volume'] - $response['right_sales_volume'];
        }else{
            $response['block_right_unused'] = $response['right_sales_volume'] - $response['left_sales_volume'];
        }
        
        parent::set_result($response);
    }
    
    // 遞迴算獎金 - 左
    protected function loop_l_result($members, $response){
        foreach($members as $k => $v){
            foreach($v['orders'] as $kk => $vv){
                $response['left_sales_volume'] += $vv['order_price'];
            }
            if(count($v['childrens']) > 0) $response = $this->loop_l_result($v['childrens'], $response);
        }
        return $response;
    }
    
    // 遞迴算獎金 - 右
    protected function loop_r_result($members, $response){
        foreach($members as $k => $v){
            foreach($v['orders'] as $kk => $vv){
                $response['right_sales_volume'] += $vv['order_price'];
            }
            if(count($v['childrens']) > 0) $response = $this->loop_r_result($v['childrens'], $response);
        }
        return $response;
    }
    
}

?>