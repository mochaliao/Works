<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// 輸出 Javascript Alert 訊息並轉址
function alert($msg, $url){
    echo '<script>' .
            'alert("' . $msg . '");' .
            'document.location.href = "' . $url . '";' .
         '</script>';
}

// 發送簡訊
/*================================================
回傳: associated array('status', 'message', 'code')
member_id: 訊息編號
message: 發送結果狀態
================================================*/
if ( !function_exists('sms') ) {
    function sms( $member_id, $message )
    {
        // 定義發簡訊會用到的常數
        defined('SMS_API') OR define('SMS_API', 'https://smexpress.mitake.com.tw:9601/SmSendGet.asp');
        defined('SMS_USERNAME') OR define('SMS_USERNAME', '42894327');
        defined('SMS_PASSWORD') OR define('SMS_PASSWORD', 'IAMIsmsTW@1');
        $ci =& get_instance();
        $ci->load->model('member_md');
        $ci->load->model('sms_md');
        $member = $ci->member_md->get_member($member_id)->row_array();
        // 檢查簡訊內容是否為空白
        if ( empty(trim($message)) ) {
            return array( 'status' => false, 'message' => '簡訊內容是空白', 'code' => 'SMS0001' );
        } // 檢查會員編號是否為空白或為 0
        elseif ( empty(trim($member_id)) || $member_id == 0 ) {
            return array( 'status' => false, 'message' => '會員編號是空白或為0', 'code' => 'SMS0002' );
        } // 檢查會員是否存在
        elseif ( empty($member) ) {
            return array( 'status' => false, 'message' => '會員編號(' . $member_id . ')不存在', 'code' => 'SMS0003' );
        } // 發送簡訊
        else {
            // 新增簡訊發送記錄
            $sms = array( 'member_id' => $member_id, 'phone' => trim($member['phone']), 'message' => $message );
            $result = $ci->sms_md->add_sms($sms);
            $id = $result['code'];
            // 呼叫簡訊 API
            $sms_url = SMS_API . '?username=' . SMS_USERNAME . '&password=' . SMS_PASSWORD . '&dstaddr=' . trim($member['phone']) . '&destname=' . $member_id . '&smbody=' . rawurlencode($message) . '&encoding=UTF8&clientid=' . $member_id;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 500);
            // 若是 https，需設定 CURLOPT_SSL_VERIFYPEER 為 false
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_URL, $sms_url);
            $result = curl_exec($curl);
            curl_close($curl);
            // 呼叫發送簡訊有返回值
            if ( !empty($result) ) {
                $result = explode(PHP_EOL, $result);
                $msgid = trim(explode('=', $result[1])[1]);
                $statuscode = trim(explode('=', $result[2])[1]);
                $accountpoint = trim(explode('=', $result[3])[1]);
                // 更新簡訊發送記錄
                $status = $ci->sms_md->get_statusname($statuscode)->row_array();
                $sms = array( 'id' => $id, 'mitake_msgid' => $msgid, 'mitake_statuscode' => $statuscode, 'mitake_accountpoint' => $accountpoint );
                $ci->sms_md->update_sms($sms);
                if ( $statuscode == 1 ) {
                    return array( 'status' => true, 'message' => $status['statusname'], 'code' => '' );
                } else {
                    return array( 'status' => false, 'message' => $status['statusname'], 'code' => 'SMS0005' );
                }
            } // 呼叫發送簡訊沒返回值
            else {
                return array( 'status' => false, 'message' => '呼叫簡訊業者API無回應', 'code' => 'SMS0004' );
            }
        }
    }
}

// 取得獎金計算日
if ( !function_exists('get_bonus_date') ) {
    function get_bonus_date( $order_date = NULL)
    {
        if (empty($order_date)){
            $order_date = date('Y-m-d H:i:s');
        }
        $begin_time = '00:00:00';
        $begin_date = date('Y-m-d', strtotime($order_date)).' '.$begin_time;
        $end_date = date('Y-m-d H:i:s', strtotime($begin_date. ' + 1 days'));
        if ($order_date >= $begin_date && $order_date < $end_date){
            return date('Y-m-d', strtotime($order_date));
        }else if ($order_date < $begin_date){
            return date('Y-m-d', strtotime($order_date. ' -1 days'));
        }else if ($order_date >= $end_date) {
            return date('Y-m-d', strtotime($order_date. ' +1 days'));
        }else{
            return date('Y-m-d', $order_date);
        }
    }
}

?>