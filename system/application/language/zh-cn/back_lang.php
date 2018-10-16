<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 常用、不分類
$lang['language'] = 'zh-cn';
$lang['language_text'] = '简体中文';
$lang['language_switch'] = '切换语系';

$lang['login'] = '登入';
$lang['logout'] = '登出';
$lang['login_failed_message'] = '登入失败, 请检查帐号密码是否正确 !';

$lang['index'] = '首页';
$lang['back_system'] = '后台管理系统';
$lang['back_system_news'] = '后台系统公告';
$lang['back_system_news_tmp'] = '请注意本页面的通知, 避免遗漏系统重大讯息 ..';

$lang['plz_enter'] = '请输入';
$lang['captcha'] = '验证图形';
$lang['chkcode'] = '验证码';

$lang['submit'] = '送出';
$lang['goback'] = '回上一页';
$lang['ok'] = '确定';
$lang['cancel'] = '取消';
$lang['expand'] = '展开';
$lang['edit'] = '编辑';
$lang['action'] = '操作';

$lang['email'] = '邮件地址';
$lang['account'] = '帐号';
$lang['password'] = '密码';

$lang['male'] = '男';
$lang['female'] = '女';

$lang['activated'] = '已启用';
$lang['inactivated'] = '未启用';
$lang['certified'] = '已通过审核';
$lang['un_certified'] = '未提交审核';
$lang['wait_certified'] ='待审核';
$lang['certified_failed'] = '未通过审核';

$lang['create_date'] = '建立日期';

$lang['used'] = '已被使用';

// DataTables
$lang['datatables_lengthMenu'] = '每页显示&nbsp;&nbsp;_MENU_&nbsp;&nbsp;笔记录';
$lang['datatables_search'] = '搜寻 : ';
$lang['datatables_zeroRecords'] = '没有符合搜寻条件的资料';
$lang['datatables_info'] = '第 _PAGE_ 页, 共 _PAGES_ 页';
$lang['datatables_infoEmpty'] = '没有符合搜寻条件的资料';
$lang['datatables_paginate_previous'] = '上一页';
$lang['datatables_paginate_next'] = '下一页';

// 菜單
$lang['menu_account'] = '帳號管理';
$lang['menu_business'] = '业务功能';
$lang['menu_team_list'] = '团队管理';
$lang['menu_team_add'] = '新增团队';
$lang['menu_team_upd'] = '编辑团队';
$lang['menu_member_list'] = '会员列表';
$lang['menu_member_add'] = '新增会员';
$lang['menu_member_upd'] = '编辑会员';
$lang['menu_member_cert'] = '实名验证审核';
$lang['menu_order_list'] = '订单列表';
$lang['menu_order_add'] = '新增订单';
$lang['menu_order_upd'] = '编辑订单';

// Team 相关
$lang['team_list'] = '团队列表';
$lang['team_add'] = '新增团队';
$lang['team_upd'] = '编辑团队';
$lang['team_id'] = '团队 ID';
$lang['team_name'] = '团队名称';
$lang['team_leader'] = '团队领导者';
$lang['team_leader_id'] = '团队领导者 ID';
$lang['team_leader_name'] = '团队领导者姓名';
$lang['team_pid'] = '上层团队 ID';
$lang['team_pname'] = '上层团队';
$lang['team_status'] = '团队状态';
$lang['team_leader_plz'] = '请选择该团队最上层领导者';
$lang['team_pid_plz'] = '请选择上层团队';
$lang['team_name_plz'] = '请输入团队名称';
$lang['team_add_success_msg'] = '新增团队资料完成';
$lang['team_add_failed_msg'] = '新增团队资料时发生错误';
$lang['team_upd_success_msg'] = '编辑团队资料完成';
$lang['team_upd_failed_msg'] = '编辑团队资料时发生错误';
$lang['team_top_team'] = '最上层团队';
$lang['team_tool_text'] = '< 展开 → 回最上层　│　确定 → 设为最上层 >';

// Member 相关
$lang['member'] = '会员';
$lang['member_mng'] = '会员管理';
$lang['member_upd_pwd'] = '修改密码';
$lang['member_old_pwd'] = '旧密码';
$lang['member_new_pwd'] = '新密码';
$lang['member_upd_pwd_success'] = '密码修改成功';
$lang['member_upd_pwd_failed'] = '密码修改失败';
$lang['member_id'] = '会员 ID';
$lang['member_name'] = '会员姓名';
$lang['member_pid'] = '介绍人 ID';
$lang['member_pname'] = '介绍人姓名';
$lang['member_tid'] = '团队 ID';
$lang['member_team'] = '团队';
$lang['member_tname'] = '团队名称';
$lang['member_side'] = '所属方向';
$lang['member_certified'] = '实名验证';
$lang['member_email'] = '信箱';
$lang['member_phone'] = '手机号码';
$lang['member_gender'] = '性别';
$lang['member_birthday'] = '生日';
$lang['member_address'] = '地址';
$lang['member_certificate_id'] = '证件号码';
$lang['member_status'] = '帐号状态';
$lang['member_create_date'] = '加入时间';
$lang['member_introducer'] = '介绍人';
$lang['member_introducer_plz'] = '请选择介绍人';
$lang['member_member_plz'] = '请选择会员';
$lang['member_team'] = '团队';
$lang['member_team_plz'] = '请选择团队';
$lang['member_login_pwd'] = '登入密码';
$lang['member_name_plz'] = '请输入姓名';
$lang['member_email_plz'] = '请输入电子邮件地址';
$lang['member_login_pwd_plz'] = '请输入登入密码';
$lang['member_phone_plz'] = '请输入手机号码';
$lang['member_birthday_plz'] = '请选择出生年月日';
$lang['member_address_plz'] = '请输入通讯地址';
$lang['member_certificate_id_plz'] = '请输入证照号码';
$lang['member_login_account'] = '登入帐号';
$lang['member_login_account_plz'] = '请输入登入帐号';
$lang['member_add_success_msg'] = '新增会员资料完成';
$lang['member_add_failed_msg'] = '新增会员资料时发生错误';
$lang['member_upd_success_msg'] = '编辑会员资料完成';
$lang['member_upd_failed_msg'] = '编辑会员资料时发生错误';
$lang['member_password_plz'] = '请输入 6-12 位数密码, 需为英文及数字并包含大小写英文及数字';
$lang['member_certificate_num_rows'] = '等待审核会员数';

// Order 相关
$lang['order_mng'] = '订单管理';
$lang['order_product'] = '产品方案';
$lang['order_pay_type'] = '入金方式';
$lang['order_pay_date'] = '入金日期';
$lang['order_create_date'] = '订单日期';
$lang['order_status'] = '订单状态';
$lang['order_product_plz'] = '产品方案';
$lang['order_pay_type_plz'] = '入金方式';
$lang['order_pay_date_plz'] = '入金日期';
$lang['order_status_activated'] = '已生效';
$lang['order_status_inactivated'] = '未生效';
$lang['order_status_invalid'] = '作废';
$lang['order_product_amount'] = '金额';
$lang['order_product_times'] = '倍数';
$lang['order_product_iami_score'] = 'IAMI 分';
$lang['order_sys_member_name'] = '后台入单人员';
$lang['order_add_success_msg'] = '新增订单完成';
$lang['order_add_failed_msg'] = '新增订单时发生错误';
$lang['order_upd_success_msg'] = '编辑订单完成';
$lang['order_upd_failed_msg'] = '编辑订单时发生错误';
$lang['order_today_un_chk'] = '今日未确认订单';

?>