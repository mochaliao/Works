<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 常用、不分類
$lang['language'] = 'zh-tw';
$lang['language_text'] = '繁體中文';
$lang['language_switch'] = '切換語系';

$lang['login'] = '登入';
$lang['logout'] = '登出';
$lang['login_failed_message'] = '登入失敗, 請檢查帳號密碼是否正確 !';

$lang['index'] = '首頁';
$lang['back_system'] = '後台管理系統';
$lang['back_system_news'] = '系統公告';
$lang['back_system_news_tmp'] = '請注意本頁面的通知, 避免遺漏系統重大訊息 ..';

$lang['plz_enter'] = '請輸入';
$lang['captcha'] = '驗證圖形';
$lang['chkcode'] = '驗證碼';

$lang['submit'] = '送出';
$lang['goback'] = '回上一頁';
$lang['ok'] = '確定';
$lang['cancel'] = '取消';
$lang['expand'] = '展開';
$lang['edit'] = '編輯';
$lang['action'] = '操作';

$lang['email'] = '郵件地址';
$lang['account'] = '帳號';
$lang['password'] = '密碼';

$lang['male'] = '男';
$lang['female'] = '女';

$lang['activated'] = '已啟用';
$lang['inactivated'] = '未啟用';
$lang['certified'] = '已通過審核';
$lang['un_certified'] = '未提交審核';
$lang['wait_certified'] ='待審核';
$lang['certified_failed'] = '未通過審核';

$lang['create_date'] = '建立日期';

$lang['used'] = '已被使用';

// DataTables
$lang['datatables_lengthMenu'] = '每頁顯示&nbsp;&nbsp;_MENU_&nbsp;&nbsp;筆記錄';
$lang['datatables_search'] = '搜尋 : ';
$lang['datatables_zeroRecords'] = '沒有符合搜尋條件的資料';
$lang['datatables_info'] = '第 _PAGE_ 頁, 共 _PAGES_ 頁';
$lang['datatables_infoEmpty'] = '沒有符合搜尋條件的資料';
$lang['datatables_paginate_previous'] = '上一頁';
$lang['datatables_paginate_next'] = '下一頁';

// 菜單
$lang['menu_account'] = '帳號管理';
$lang['menu_business'] = '業務功能';
$lang['menu_team_list'] = '團隊管理';
$lang['menu_team_add'] = '新增團隊';
$lang['menu_team_upd'] = '編輯團隊';
$lang['menu_member_list'] = '會員列表';
$lang['menu_member_add'] = '新增會員';
$lang['menu_member_upd'] = '編輯會員';
$lang['menu_member_cert'] = '實名驗證審核';
$lang['menu_order_list'] = '訂單列表';
$lang['menu_order_add'] = '新增訂單';
$lang['menu_order_upd'] = '編輯訂單';

// Team 相關
$lang['team_list'] = '團隊列表';
$lang['team_add'] = '新增團隊';
$lang['team_upd'] = '編輯團隊';
$lang['team_id'] = '團隊 ID';
$lang['team_name'] = '團隊名稱';
$lang['team_leader'] = '團隊領導者';
$lang['team_leader_id'] = '團隊領導者 ID';
$lang['team_leader_name'] = '團隊領導者姓名';
$lang['team_pid'] = '上層團隊 ID';
$lang['team_pname'] = '上層團隊';
$lang['team_status'] = '團隊狀態';
$lang['team_leader_plz'] = '請選擇該團隊最上層領導者';
$lang['team_pid_plz'] = '請選擇上層團隊';
$lang['team_name_plz'] = '請輸入團隊名稱';
$lang['team_add_success_msg'] = '新增團隊資料完成';
$lang['team_add_failed_msg'] = '新增團隊資料時發生錯誤';
$lang['team_upd_success_msg'] = '編輯團隊資料完成';
$lang['team_upd_failed_msg'] = '編輯團隊資料時發生錯誤';
$lang['team_top_team'] = '最上層團隊';
$lang['team_tool_text'] = '< 展開 → 回最上層　│　確定 → 設為最上層 >';

// Member 相關
$lang['member'] = '會員';
$lang['member_mng'] = '會員管理';
$lang['member_upd_pwd'] = '修改密碼';
$lang['member_old_pwd'] = '舊密碼';
$lang['member_new_pwd'] = '新密碼';
$lang['member_upd_pwd_success'] = '密碼修改成功';
$lang['member_upd_pwd_failed']  = '密碼修改失敗';
$lang['member_id'] = '會員 ID';
$lang['member_name'] = '會員姓名';
$lang['member_pid'] = '介紹人 ID';
$lang['member_pname'] = '介紹人姓名';
$lang['member_tid'] = '團隊 ID';
$lang['member_team'] = '團隊';
$lang['member_tname'] = '團隊名稱';
$lang['member_side'] = '所屬方向';
$lang['member_certified'] = '實名驗證';
$lang['member_email'] = '信箱';
$lang['member_phone'] = '手機號碼';
$lang['member_gender'] = '性別';
$lang['member_birthday'] = '生日';
$lang['member_address'] = '地址';
$lang['member_certificate_id'] = '證件號碼';
$lang['member_status'] = '帳號狀態';
$lang['member_create_date'] = '加入時間';
$lang['member_introducer'] = '介紹人';
$lang['member_introducer_plz'] = '請選擇介紹人';
$lang['member_member_plz'] = '請選擇會員';
$lang['member_team'] = '團隊';
$lang['member_team_plz'] = '請選擇團隊';
$lang['member_login_pwd'] = '登入密碼';
$lang['member_name_plz'] = '請輸入姓名';
$lang['member_email_plz'] = '請輸入電子郵件地址';
$lang['member_login_pwd_plz'] = '請輸入登入密碼';
$lang['member_phone_plz'] = '請輸入手機號碼';
$lang['member_birthday_plz'] = '請選擇出生年月日';
$lang['member_address_plz'] = '請輸入通訊地址';
$lang['member_certificate_id_plz'] = '請輸入證照號碼';
$lang['member_login_account'] = '登入帳號';
$lang['member_login_account_plz'] = '請輸入登入帳號';
$lang['member_add_success_msg'] = '新增會員資料完成';
$lang['member_add_failed_msg'] = '新增會員資料時發生錯誤';
$lang['member_upd_success_msg'] = '編輯會員資料完成';
$lang['member_upd_failed_msg'] = '編輯會員資料時發生錯誤';
$lang['member_password_plz'] = '請輸入 6-12 位數密碼, 需為英文及數字並包含大小寫英文及數字';
$lang['member_certificate_num_rows'] = '等待審核會員數';

// Order 相關
$lang['order_mng'] = '訂單管理';
$lang['order_product'] = '產品方案';
$lang['order_pay_type'] = '入金方式';
$lang['order_pay_date'] = '入金日期';
$lang['order_create_date'] = '入金日期';
$lang['order_status'] = '訂單狀態';
$lang['order_product_plz'] = '產品方案';
$lang['order_pay_type_plz'] = '入金方式';
$lang['order_pay_date_plz'] = '入金日期';
$lang['order_status_activated'] = '已生效';
$lang['order_status_inactivated'] = '未生效';
$lang['order_status_invalid'] = '作廢';
$lang['order_product_amount'] = '金額';
$lang['order_product_times'] = '倍數';
$lang['order_product_iami_score'] = 'IAMI 分';
$lang['order_sys_member_name'] = '後台入單人員';
$lang['order_add_success_msg'] = '新增訂單完成';
$lang['order_add_failed_msg'] = '新增訂單時發生錯誤';
$lang['order_upd_success_msg'] = '編輯訂單完成';
$lang['order_upd_failed_msg'] = '編輯訂單時發生錯誤';
$lang['order_today_un_chk'] = '今日未確認訂單';

?>