<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 常用、不分類
$lang['language'] = 'zh-tw';
$lang['language_text'] = '繁體中文';
$lang['language_switch'] = '切換語系';

$lang['register'] = '註冊';
$lang['login'] = '登入';
$lang['logout'] = '登出';
$lang['logout_chk_text'] = '確定要登出嗎 ?';
$lang['login_failed_message'] = '登入失敗, 請檢查帳號密碼是否正確 !';

$lang['index'] = '首頁';

$lang['submit'] = '送出';
$lang['goback'] = '回上一頁';
$lang['ok'] = '確定';
$lang['cancel'] = '取消';
$lang['close'] = '關閉';

$lang['plz_enter'] = '請輸入';
$lang['captcha'] = '驗證圖形';
$lang['chkcode'] = '驗證碼';
$lang['chkcode_anser'] = '驗證碼答案';
$lang['send_chkcode'] = '發送驗證碼';
$lang['re_send_chkcode'] = '寄送成功';
$lang['sending_chkcode'] = '發送中';
$lang['send_chkcode_success'] = '發送驗證碼郵件成功, 請前往收件';
$lang['send_chkcode_failed'] = '發送驗證碼郵件時發生錯誤, 請重新發送';

$lang['submit'] = '送出';
$lang['goback'] = '回上一頁';
$lang['agree'] = '我同意';

$lang['email'] = '郵件地址';
$lang['account'] = '帳號';
$lang['password'] = '密碼';
$lang['re_password'] = '確認密碼';
$lang['forget_password'] = '忘記密碼';
$lang['update_password'] = '更新密碼';
$lang['copyright'] = '版權所有, 未經授權禁止使用';

$lang['used'] = '已被使用';
$lang['incorrect'] = '不正確';
$lang['mismatch'] = '不匹配';

$lang['hello'] = '您好, __NAME__';

// 菜單相關
$lang['menu_profile_mng'] = '個人資料管理';
$lang['menu_profile_assets'] = '資產';
$lang['menu_profile_upd_info'] = '實名驗證';
$lang['menu_profile_upd_pwd'] = '修改密碼';
$lang['menu_profile_upd_txn_pwd'] = '修改交易密碼';
$lang['menu_profile_wdrl_bag'] = '提現';
$lang['menu_profile_set_paypal'] = '設定 Paypal';

$lang['menu_profile_team_mng'] = '團隊管理';
$lang['menu_profile_team_tree'] = '組織樹狀圖';

$lang['menu_profile_order_mng'] = '入單系統';
$lang['menu_profile_order_add'] = '新增入單';

$lang['menu_profile_transaction'] = '交易紀錄';

// 簡訊使用語言
$lang['sms_message_empty'] = '簡訊內容是空的';
$lang['sms_api_no_response'] = '呼叫簡訊業者 API 無回應';

// Member 相關
$lang['member_id_invalid']   = '會員編號不合法';
$lang['member_id_not_found'] = '會員編號不存在';
$lang['member_upd_pwd'] = '修改密碼';
$lang['member_old_pwd'] = '舊密碼';
$lang['member_new_pwd'] = '新密碼';
$lang['member_upd_pwd_success'] = '密碼修改成功';
$lang['member_upd_pwd_failed']  = '密碼修改失敗';
$lang['member_email'] = '電子信箱';
$lang['account_plz'] = '請輸入 4-12 位數, 需為英文及數字, 首位需為英文 ( 大小寫不拘 )';
$lang['password_plz'] = '請輸入 6-12 位數密碼, 需為英文及數字並包含大小寫英文及數字';
$lang['re_password'] = '確認密碼';
$lang['re_password_plz'] = '二次輸入密碼需相同';
$lang['member_introducer'] = '推薦人';
$lang['member_introducer_account_not_found'] = '推薦人帳戶不存在';
$lang['member_introducer_plz'] = '請輸入推薦人帳號';
$lang['member_terms'] = '使用條款';
$lang['member_name'] = '姓名';
$lang['member_birthday'] = '生日';
$lang['member_add_success_msg'] = '加入會員資料完成';
$lang['member_add_failed_msg'] = '加入會員資料時發生錯誤';
$lang['member_register_chkcode'] = '會員註冊驗證碼';
$lang['member_register_chkcode_mailtext'] = '您的會員註冊驗證碼為：__CHKCODE__';
$lang['member_send_reset_pwd_mail_success'] = '已將重置密碼連結寄送至您的註冊信箱, 請前往收件, 並檢查是否被歸屬為垃圾郵件';
$lang['member_send_reset_pwd_mail_failed'] = '重置密碼連結寄送時發生錯誤';
$lang['member_certifite'] = '實名驗證';
$lang['member_certifite_txt'] = '實名後將不得變更姓名及出生日期，如需更換實名資料，請寄信至 info@phuei-century.com 申請更換';
$lang['member_certifite_upload'] = '上傳證件';
$lang['member_certifite_upload_1'] = '上傳證件正面';
$lang['member_certifite_upload_2'] = '上傳證件背面';
$lang['member_certifite_upload_note'] = '請上傳身分證正反兩面，非台灣本地人士請上傳護照正面即可';
$lang['member_certifite_upload_success'] = '上傳檔案成功, 是否回到實名驗證';
$lang['member_certifite_upload_failed'] = '上傳檔案時發生錯誤';
$lang['member_certifite_submit'] = '送審';
$lang['member_certifite_push_success'] = '實名驗證送審完成';
$lang['member_certifite_push_failed'] = '實名驗證送審存檔時發生錯誤';
$lang['member_paypal_set'] = '設定 Paypal';
$lang['member_paypal_account'] = 'Paypal 帳號';
$lang['member_paypal_set_success'] = '設定 Paypal 成功';
$lang['member_paypal_set_failed'] = '設定 Paypal 時發生錯誤';

// 資產相關
$lang['assets'] = '資產';
$lang['assets_level'] = '星級';
$lang['assets_wallet_cash'] = '現金錢包';
$lang['assets_link'] = '今日鏈接算力';
$lang['assets_block_left'] = '今日區塊算力 ( 左 ) ';
$lang['assets_block_right'] = '今日區塊算力 ( 右 ) ';

// 訂單相關
$lang['order_add'] = '新增入單';
$lang['order_product'] = '方案';
$lang['order_pay_type'] = '支付方式';
$lang['order_add_success_msg'] = '新增入單完成, 請待後台人員確認入單';
$lang['order_add_failed_msg'] = '新增入單時發生錯誤, 請重試';

// 交易記錄相關
$lang['trans'] = '交易紀錄';
$lang['trans_wallet'] = '錢包';
$lang['trans_wallet_cash'] = '現金錢包';
$lang['trans_wallet_ipoint'] = 'I 分錢包';
$lang['trans_withdrawal'] = '提現';
$lang['trans_pay'] = '支付';
$lang['trans_bonus'] = '獎金';
$lang['trans_date'] = '日期';
$lang['trans_cost'] = '金額';
$lang['trans_status'] = '狀態';
$lang['trans_status_0'] = '未處理';
$lang['trans_status_1'] = '已處理';
$lang['trans_product_name'] = '方案';
$lang['trans_pay_name'] = '支付方式';
$lang['trans_system'] = '平台';
$lang['trans_item'] = '品項';
$lang['trans_balance_cash'] = '現金錢包餘額';
$lang['trans_balance_ipoint'] = 'I 分錢包餘額';
$lang['trans_desc'] = '詳細';
$lang['trans_desc_link'] = '詳細資料';
$lang['trans_level'] = '星級';
$lang['trans_block_money'] = '區塊算力現金獎金';
$lang['trans_block_ipoint'] = '區塊算力 I 分獎金';
$lang['trans_link_cash'] = '鏈接算力現金獎金';
$lang['trans_link_ipoint'] = '鏈接算力 I 分獎金';
$lang['trans_cash'] = '現金';
$lang['trans_ipoint'] = 'I 分';

?>