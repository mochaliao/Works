<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
**  [ 直推結算物件 ]
**      撈取直屬下層的業績, 每位直屬下層的業績需加入鏈接算力未使用的業績數額 [ link_unused ]
**/

require_once(dirname(__FILE__) . '/Checkout.php');

class Link extends Checkout{
    
    // 最高獎金容量 ( wallet_ipoint )
    private $container;
    
    // 直屬下線會員
    private $members = array();
    
    // 設置初始參數
    public function set_param($param){
        parent::set_param($param);
        
        // 設定最高獎金容量
        $this->container = $this->member['wallet_ipoint'];
        
        // 設定直屬下線會員
        $this->members = array();
        $this->get_childrens();
        
        // 設定傳回的結果集
        $this->set_result();
    }
    
    // 取得直屬下線資訊 ( 含當日訂單與獎金計算資料 )
    private function get_childrens(){
        $members = $this->ci->member_md->get_member_by_pid($this->member['id'])->result_array();
        foreach($members as $k => $v){
            array_push($this->members, array(
                'member_id'   => $v['id'],
                'member_name' => $v['name'],
                'orders'      => array(),
                'bonus'       => array(
                    'bonus_id'    => null,
                    'bonus_date'  => null,
                    'link_unused' => 0
                )
            ));
            
            // 取得直屬下線獎金計算表
            $bonus = $this->ci->db->query('SELECT * FROM bonus WHERE member_id = ? AND bonus_date = ?', array( $v['id'], substr($this->time['start'], 0, 10) ))->row_array();
            if($bonus !== null) $this->members[$k]['bonus'] = array(
                'bonus_id'    => $bonus['id'],
                'bonus_date'  => $bonus['bonus_date'],
                'link_unused' => $bonus['link_unused']
            );
            
            // 逐項取得直屬下線的計算日訂單
            $orders = $this->ci->order_md->get_order(null, $v['id'], null, null, $this->time['start'], $this->time['end'], 1)->result_array();
            foreach($orders as $kk => $vv){
                array_push($this->members[$k]['orders'], array(
                    'order_id'           => $vv['id'],
                    'order_price'        => $vv['product_money'],
                    'order_link_percent' => $vv['product_link_percent'],
                    'order_link_bonus'   => ( $vv['product_money'] * $vv['product_link_percent'] )
                ));
            }
        }
    }
    
    // 開始計算直推獎金並返回結果集
    protected function set_result(){
        $response = array(
            'member_id'         => $this->member['id'],   // 會員 ID
            'member_name'       => $this->member['name'], // 會員名稱
            'sales_volume'      => 0,                     // 總業績
            'sales_bonus'       => 0,                     // 業績獎金 ( 實得, 未拆帳 )
            'bonus_container'   => $this->container,      // 獎金最高限額
            'bonus_from_lower'  => 0,                     // 由下層流上之獎金
            'bonus_total'       => 0,                     // 業績獎金 ( 總額, 不考慮上限問題 )
            'bonus_unused'      => 0,                     // 業績獎金未使用部份 ( 即超出上限部份 )
            'members'           => $this->members         // 下屬會員 ( 直推僅限一層 )
        );
        foreach($this->members as $k => $v){
            $response['bonus_from_lower'] += $v['bonus']['link_unused'];
            $response['bonus_total']      += $response['bonus_from_lower'];
            foreach($v['orders'] as $kk => $vv){
                $response['sales_volume']    += $vv['order_price'];
                $response['bonus_total']     += $vv['order_link_bonus'];
                $response['bonus_unused']     = $response['bonus_total'] - $response['bonus_container'] > 0 ? $response['bonus_total'] - $response['bonus_container'] : 0;
                $response['sales_bonus']      = $response['bonus_total'] - $response['bonus_container'] > 0 ? $response['bonus_container'] : $response['bonus_total'];
            }
        }
        parent::set_result($response);
    }
    
}

?>