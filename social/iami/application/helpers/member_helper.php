<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//======================================================================================================================
//註冊時檢查會員資料
//======================================================================================================================
if ( ! function_exists('check_member_register') )
{
    function check_member_register($member)
    {
        $ci =& get_instance();
        //檢查email是否為空白
        if (empty($member['email'])){
            return array('status'=>'failed', 'message'=>'電子郵件不能為空白', 'code'=>'M0001');
        }
        //檢查email格式是否正確
        if ( ! preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $member['email'])) {
            return array('status'=>'failed', 'message'=>'電子郵件格式不正確', 'code'=>'M0002');
        }
        //檢查email是否已經存在
        if ($ci->member_model->getMemberByEmail($member['email'])->num_rows() > 0){
            return array('status'=>'failed', 'message'=>'此電子郵件已經存在', 'code'=>'M0003');
        }
        //檢查密碼是否為空白
        if (empty($member['password'])){
            return array('status'=>'failed', 'message'=>'密碼不能為空白', 'code'=>'M0004');
        }
        //檢查密碼長度是否超過六碼
        if (strlen($member['password']) < 6){
            return array('status'=>'failed', 'message'=>'密碼長度不能低於六位數', 'code'=>'M0005');
        }
        //檢查確認密碼是否為空白
        if (empty($member['repassword'])){
            return array('status'=>'failed', 'message'=>'確認密碼不能為空白', 'code'=>'M0004');
        }
        //檢查確認密碼是否跟密碼相同
        if (trim($member['password']) !== trim($member['repassword'])){
            return array('status'=>'failed', 'message'=>'密碼與確認密碼不一致', 'code'=>'M0006');
        }
        //檢查匿稱是否為空白
        if (empty($member['nickname'])){
            return array('status'=>'failed', 'message'=>'匿稱不能為空白', 'code'=>'M0007');
        }
        //檢查性別是否為空白
        if (empty($member['gender'])){
            return array('status'=>'failed', 'message'=>'性別不能為空白', 'code'=>'M0007');
        }
        //檢查性別是否正確
        if (strtoupper($member['gender']) !== 'M' && strtoupper($member['gender']) !== 'F')
        {
            return array('status'=>'failed', 'message'=>'性別不正確(必須是M或F)', 'code'=>'M0008');
        }
        //檢查手機是否為空白
        if (empty($member['mobile'])){
            return array('status'=>'failed', 'message'=>'手機號不能為空白', 'code'=>'M0009');
        }
        //檢查手機是否重複
        if($ci->member_model->getMemberByMobile($member['mobile'])->num_rows() > 0){
            return array('status'=>'failed', 'message'=>'手機已經被使用', 'code'=>'M0009');
        }
        $CN_pattern = "/^(13|14|15|18)\d{9}$/";//大陸
        $TW_pattern = "/^(09)\d{8}$/";//台灣
        if ( ! preg_match($CN_pattern, $member['mobile']) && ! preg_match($TW_pattern, $member['mobile'])){
            return array('status'=>'failed', 'message'=>'手機號格式不正確', 'code'=>'M0009');
        }
        //檢查生日是否為空白
        if (empty($member['birth'])){
            return array('status'=>'failed', 'message'=>'生日不能為空白', 'code'=>'M0009');
        }
        //檢查生日是否正確
        if(DateTime::createFromFormat('Y-m-d', $member['birth']) === FALSE){
            return array('status'=>'failed', 'message'=>'生日格式錯誤，必須為日期格式(yyyy-mm-dd)', 'code'=>'M0010');
        }
        //檢查語系ID是否為空白
        if (empty($member['language_id'])){
            return array('status'=>'failed', 'message'=>'語系ID不能為空白', 'code'=>'M0011');
        }
        //資料都正確
        return array('status'=>'success', 'message'=>'', 'code'=>'');
    }
}


//======================================================================================================================
//轉換成系統有定義的language_id
//======================================================================================================================
if ( ! function_exists('get_language_id') )
{
    function get_language_id($language_id)
    {
        $language_id = strtolower($language_id);
        switch ($language_id){
            case ($language_id == 'english' || $language_id == 'en' || $language_id == 'en-us' || $language_id == 'en-uk'):
                return 'english';
                break;
            case 'zh-tw':
                return 'zh-TW';
                break;
            case 'zh-CN':
                return 'zh-CN';
                break;
            default:
                return 'zh-CN';
        }
    }
}
