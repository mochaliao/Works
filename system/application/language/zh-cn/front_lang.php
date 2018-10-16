<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 常用、不分類
$lang['language'] = 'zh-cn';
$lang['language_text'] = '简体中文';
$lang['language_switch'] = '切换语系';

$lang['register'] = '注册';
$lang['login'] = '登入';
$lang['logout'] = '登出';
$lang['logout_chk_text'] = '确定要登出吗 ?';
$lang['login_failed_message'] = '登入失败, 请检查帐号密码是否正确 !';

$lang['index'] = '首页';

$lang['submit'] = '送出';
$lang['goback'] = '回上一页';
$lang['ok'] = '确定';
$lang['cancel'] = '取消';
$lang['close'] = '关闭';

$lang['plz_enter'] = '请输入';
$lang['captcha'] = '验证图形';
$lang['chkcode'] = '验证码';
$lang['chkcode_anser'] = '验证码答案';
$lang['send_chkcode'] = '发送验证码';
$lang['re_send_chkcode'] = '寄送成功';
$lang['sending_chkcode'] = '发送中';
$lang['send_chkcode_success'] = '发送验证码邮件成功, 请前往收件';
$lang['send_chkcode_failed'] = '发送验证码邮件时发生错误, 请重新发送';

$lang['submit'] = '送出';
$lang['goback'] = '回上一页';
$lang['agree'] = '我同意';

$lang['email'] = '邮件地址';
$lang['account'] = '帐户';
$lang['password'] = '密码';
$lang['re_password'] = '确认密码';
$lang['forget_password'] = '忘记密码';
$lang['update_password'] = '更新密码';
$lang['copyright'] = '版权所有, 未经授权禁止使用';

$lang['used'] = '已被使用';
$lang['incorrect'] = '不正确';
$lang['mismatch'] = '不匹配';

$lang['hello'] = '您好, __NAME__';

// 菜单相关
$lang['menu_profile_mng'] = '个人资料管理';
$lang['menu_profile_assets'] = '资产';
$lang['menu_profile_upd_info'] = '实名验证';
$lang['menu_profile_upd_pwd'] = '修改密码';
$lang['menu_profile_upd_txn_pwd'] = '修改交易密码';
$lang['menu_profile_wdrl_bag'] = '提现';
$lang['menu_profile_set_paypal'] = '设定 Paypal';

$lang['menu_profile_team_mng'] = '团队管理';
$lang['menu_profile_team_tree'] = '组织树状图';

$lang['menu_profile_order_mng'] = '入单系统';
$lang['menu_profile_order_add'] = '新增入单';

$lang['menu_profile_transaction'] = '交易纪录';

// 簡訊使用語言
$lang['sms_message_empty'] = '短信内容是空的';
$lang['sms_api_no_response'] = '呼叫短信业者 API 无回应';

// Member 相關
$lang['member_id_invalid']   = '会员编号不合法';
$lang['member_id_not_found'] = '会员编号不存在';
$lang['member_upd_pwd'] = '修改密码';
$lang['member_old_pwd'] = '旧密码';
$lang['member_new_pwd'] = '新密码';
$lang['member_upd_pwd_success'] = '密码修改成功';
$lang['member_upd_pwd_failed'] = '密码修改失败';
$lang['member_email'] = '电子信箱';
$lang['account_plz'] = '请输入 4-12 位数, 需为英文及数字, 首位需为英文 ( 大小写不拘 )';
$lang['password_plz'] = '请输入 6-12 位数密码, 需为英文及数字并包含大小写英文及数字';
$lang['re_password'] = '确认密码';
$lang['re_password_plz'] = '二次输入密码需相同';
$lang['member_introducer'] = '推荐人';
$lang['member_introducer_account_not_found'] = '推荐人帐户不存在';
$lang['member_introducer_plz'] = '请输入推荐人帐号';
$lang['member_terms'] = '使用条款';
$lang['member_name'] = '姓名';
$lang['member_birthday'] = '生日';
$lang['member_add_success_msg'] = '加入会员资料完成';
$lang['member_add_failed_msg'] = '加入会员资料时发生错误';
$lang['member_register_chkcode'] = '会员注册验证码';
$lang['member_register_chkcode_mailtext'] = '您的会员注册验证码为：__CHKCODE__';
$lang['member_send_reset_pwd_mail_success'] = '已将重置密码连结寄送至您的注册信箱, 请前往收件, 並請檢查是否被歸屬為垃圾郵件';
$lang['member_send_reset_pwd_mail_failed'] = '重置密码连结寄送时发生错误';
$lang['member_certifite'] = '实名验证';
$lang['member_certifite_txt'] = '实名后将不得变更姓名及出生日期，如需更换实名资料，请寄信至 info@phuei-century.com 申请更换';
$lang['member_certifite_upload'] = '上传证件';
$lang['member_certifite_upload_1'] = '上传证件正面';
$lang['member_certifite_upload_2'] = '上传证件背面';
$lang['member_certifite_upload_note'] = '请上传身分证正反两面，非台湾本地人士请上传护照正面即可';
$lang['member_certifite_upload_success'] = '上传档案成功, 是否回到实名验证';
$lang['member_certifite_upload_failed'] = '上传档案时发生错误';
$lang['member_certifite_submit'] = '送审';
$lang['member_certifite_push_success'] = '实名验证送审完成';
$lang['member_certifite_push_failed'] = '实名验证送审存档时发生错误';
$lang['member_paypal_set'] = '设定 Paypal';
$lang['member_paypal_account'] = 'Paypal 帐号';
$lang['member_paypal_set_success'] = '设定 Paypal 成功';
$lang['member_paypal_set_failed'] = '设定 Paypal 时发生错误';

// 资产相关
$lang['assets'] = '资产';
$lang['assets_level'] = '星级';
$lang['assets_wallet_cash'] = '现金钱包';
$lang['assets_link'] = '今日链接算力';
$lang['assets_block_left'] = '今日区块算力 ( 左 ) ';
$lang['assets_block_right'] = '今日区块算力 ( 右 ) ';

// 订单相关
$lang['order_add'] = '新增入单';
$lang['order_product'] = '方案';
$lang['order_pay_type'] = '支付方式';
$lang['order_add_success_msg'] = '新增入单完成, 请待后台人员确认入单';
$lang['order_add_failed_msg'] = '新增入单时发生错误, 请重试';

// 交易记录相关
$lang['trans'] = '交易纪录';
$lang['trans_wallet'] = '钱包';
$lang['trans_wallet_cash'] = '现金钱包';
$lang['trans_wallet_ipoint'] = 'I 分钱包';
$lang['trans_withdrawal'] = '提现';
$lang['trans_pay'] = '支付';
$lang['trans_bonus'] = '奖金';
$lang['trans_date'] = '日期';
$lang['trans_cost'] = '金额';
$lang['trans_status'] = '状态';
$lang['trans_status_0'] = '未处理';
$lang['trans_status_1'] = '已处理';
$lang['trans_product_name'] = '方案';
$lang['trans_pay_name'] = '支付方式';
$lang['trans_system'] = '平台';
$lang['trans_item'] = '品项';
$lang['trans_balance_cash'] = '现金钱包余额';
$lang['trans_balance_ipoint'] = 'I 分钱包余额';
$lang['trans_desc'] = '详细';
$lang['trans_desc_link'] = '详细资料';
$lang['trans_level'] = '星级';
$lang['trans_block_money'] = '区块算力现金奖金';
$lang['trans_block_ipoint'] = '区块算力 I 分奖金';
$lang['trans_link_cash'] = '链接算力现金奖金';
$lang['trans_link_ipoint'] = '链接算力 I 分奖金';
$lang['trans_cash'] = '现金';
$lang['trans_ipoint'] = 'I 分';

?>