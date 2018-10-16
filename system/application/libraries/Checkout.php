<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
**  [ 錢包結算物件 ]
**      將獎金拆帳後依比例記入兩種錢包
**/

class Checkout{
    
    protected $ci;
    protected $member = null;
    protected $time = array(
        'start' => '00:00:00',
        'end'   => '23:59:59'
    );
    
    // 必填參數
    private $rules = array(
        'member_id'
    );
    
    // 入錢包規則
    private $wallet_rule = array(
        'ipoint' => 0.3,
        'cash'   => 0.7
    );
    
    // 結果集
    public $response = null;
    
    // 建構子
    public function __construct(){
        
        $this->ci =& get_instance();
        $this->ci->load->model('order_md');
        
        // 計算時間設定
        $this->time_define();
    }
    
    // 設置初始參數
    public function set_param($param){
        foreach($this->rules as $value){
            if(!isset($param[$value]) || $param[$value] == '') $this->say('缺少參數 -- [ ' . $value . ' ]', 'exit');
            ${$value} = $param[$value]; // 宣告為同名變數
        }
        // 取得代入會員資料
        $this->member = $this->ci->member_md->get_member($member_id)->row_array();
        if($this->member === null) $this->say('找不到這個會員 ID -- [ '. $member_id . ' ]', 'exit');
    }
    
    // 設定回傳結果集
    protected function set_result($response){
        $this->response = array_merge(array(
            'wallet_ipoint_add' => round( $response['sales_bonus'] * $this->wallet_rule['ipoint'], 2 ),
            'wallet_cash_add'   => round( $response['sales_bonus'] * $this->wallet_rule['cash'], 2 )
        ), $response);
    }
    
    // 計算時間設定
    protected function time_define(){
        $date = get_bonus_date();
        $this->time = array(
            'start' => $date . ' ' . $this->time['start'],
            'end'   => $date . ' ' . $this->time['end']
        );
    }
    
    // 輸出訊息用函式
    protected function say($string, $exit = false){
        echo $string . "\r\n";
        if($exit) exit();
    }
    
}

?>