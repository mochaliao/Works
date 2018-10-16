<?php
/**
 * System messages translation for CodeIgniter(tm)
 *
 * @author	CodeIgniter community
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['email_must_be_array'] = 'E-mail 验证方法必须传入一个 Array';
$lang['email_invalid_address'] = '无效的 E-mail 地址：%s';
$lang['email_attachment_missing'] = '无法找到以下的 E-mail 附件：%s';
$lang['email_attachment_unreadable'] = '无法读取以下的 E-mail 附件：%s';
$lang['email_no_from'] = '无法传送没有 "From" Header的 E-mail';
$lang['email_no_recipients'] = 'E-mail 必须包含收件人（To, Cc, or Bcc）';
$lang['email_send_failure_phpmail'] = '无法使用 PHP 的 mail() 函数 您的伺服器设定禁止使用此函数传送 E-mail';
$lang['email_send_failure_sendmail'] = '无法使用 PHP sendmail 您的伺服器设定禁止使用此方法传送 E-mail';
$lang['email_send_failure_smtp'] = '无法使用 PHP SMTP 您的伺服器设定禁止使用此方法传送 E-mail';
$lang['email_sent'] = 'E-mail 成功传送： %s';
$lang['email_no_socket'] = '无法打开 Socket 传送 E-mail，请检查设定';
$lang['email_no_hostname'] = '没有指定 SMTP 伺服器的主机名称';
$lang['email_smtp_error'] = '发生错误，SMTP 错误资讯为：%s';
$lang['email_no_smtp_unpw'] = '错误：必须指定 SMTP 的使用者名称及密码';
$lang['email_failed_smtp_login'] = '传送 AUTH LOING 命令失败，错误：%s';
$lang['email_smtp_auth_un'] = '帐号认证失败，错误：%s';
$lang['email_smtp_auth_pw'] = '密码认证失败，错误：%s';
$lang['email_smtp_data_failure'] = '无法传送资料：%s';
$lang['email_exit_status'] = '结束状态：%s';
