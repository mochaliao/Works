<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 常用、不分類
$lang['language'] = 'english';
$lang['language_text'] = 'English';
$lang['language_switch'] = 'Switch Language';

$lang['register'] = 'Register';
$lang['login'] = 'Login';
$lang['logout'] = 'Logout';
$lang['logout_chk_text'] = 'Are you sure you want to log out ?';
$lang['login_failed_message'] = 'Login failed, Please check your email & password !';

$lang['index'] = 'INDEX';

$lang['submit'] = 'Submit';
$lang['goback'] = 'Go back';
$lang['ok'] = 'Ok';
$lang['cancel'] = 'Cancel';
$lang['close'] = 'Close';

$lang['plz_enter'] = 'Please Enter ';
$lang['captcha'] = 'Captcha';
$lang['chkcode'] = 'Check Code';
$lang['chkcode_anser'] = 'Check Code Answer';
$lang['send_chkcode'] = 'Send';
$lang['re_send_chkcode'] = 'Mailed';
$lang['sending_chkcode'] = 'Sending';
$lang['send_chkcode_success'] = 'Send check code success, please take your chkcode from email';
$lang['send_chkcode_failed'] = 'Send check code failed, please retry';

$lang['submit'] = 'Submit';
$lang['goback'] = 'Go back';
$lang['agree'] = 'I Agree ';

$lang['email'] = 'Email Address';
$lang['account'] = 'Account';
$lang['password'] = 'Password';
$lang['re_password'] = 'Confirm Password';
$lang['forget_password'] = 'Forget Password';
$lang['update_password'] = 'Change Password';
$lang['copyright'] = 'Copyright';

$lang['used'] = 'Already Used';
$lang['incorrect'] = 'Incorrect';
$lang['mismatch'] = 'Mismatch';

$lang['hello'] = 'Hello, __NAME__';

// 菜單相關
$lang['menu_profile_mng'] = 'Profile Management';
$lang['menu_profile_assets'] = 'Assets';
$lang['menu_profile_upd_info'] = 'Real name verification';
$lang['menu_profile_upd_pwd'] = 'Change Password';
$lang['menu_profile_upd_txn_pwd'] = 'Modify the transaction password';
$lang['menu_profile_wdrl_bag'] = 'Withdraw';
$lang['menu_profile_set_paypal'] = 'Set Paypal';

$lang['menu_profile_team_mng'] = 'Team Management';
$lang['menu_profile_team_tree'] = 'Organization Tree';

$lang['menu_profile_order_mng'] = 'Orders System';
$lang['menu_profile_order_add'] = 'Add Orders';

$lang['menu_profile_transaction'] = 'Transaction History';

// 簡訊使用語言
$lang['sms_message_empty'] = 'SMS content is empty';
$lang['sms_api_no_response'] = 'SMS API no reponse';

// Member 相關
$lang['member_id_invalid'] = 'Member ID is invalid';
$lang['member_id_not_found'] = 'Member ID NOT found';
$lang['member_upd_pwd'] = 'Update Password';
$lang['member_old_pwd'] = 'Old Password';
$lang['member_new_pwd'] = 'New Password';
$lang['member_upd_pwd_success'] = 'Password Update Success';
$lang['member_upd_pwd_failed'] = 'Password Update Failed';
$lang['member_email'] = 'EMail';
$lang['account_plz'] = 'Please enter 4-12 digits, English and numbers are required, and the first digit must be English (case is not limited)';
$lang['password_plz'] = 'Please enter a 6-12 digit password, which must be English and numeric and include uppercase and lowercase English and numbers';
$lang['re_password'] = 'Confirm password';
$lang['re_password_plz'] = 'Second input passwords must be the same';
$lang['member_introducer'] = 'Introducer';
$lang['member_introducer_account_not_found'] = 'Introducer account not found';
$lang['member_introducer_plz'] = 'Enter Introducer Account';
$lang['member_terms'] = 'Terms of Use';
$lang['member_name'] = 'Name';
$lang['member_birthday'] = 'Birthday';
$lang['member_add_success_msg'] = 'Join Member Success';
$lang['member_add_failed_msg'] = 'Join Member Failed';
$lang['member_register_chkcode'] = 'Member Registration Verification Code';
$lang['member_register_chkcode_mailtext'] = 'Your Member Registration Verification Code IS：__CHKCODE__';
$lang['member_send_reset_pwd_mail_success'] = 'The password has been sent to your registration email, please click on the link';
$lang['member_send_reset_pwd_mail_failed'] = 'An error occurred while resetting the password link to send';
$lang['member_certifite'] = 'Authentication';
$lang['member_certifite_txt'] = 'The name and date of birth will not be changed after the real name. If you need to change the real name information, please send a letter to info@phuei-century.com to apply for replacement';
$lang['member_certifite_upload'] = 'Upload Files';
$lang['member_certifite_upload_1'] = 'Upload credentials positive';
$lang['member_certifite_upload_2'] = 'Upload the back of the document';
$lang['member_certifite_upload_note'] = 'Please upload the identity card on both sides, non-Taiwanese locals please upload the passport to the front';
$lang['member_certifite_upload_success'] = 'Upload file successfully, go back to real name verification';
$lang['member_certifite_upload_failed'] = 'An error occurred while uploading the file';
$lang['member_certifite_submit'] = 'Submit';
$lang['member_certifite_push_success'] = 'Real name verification is completed';
$lang['member_certifite_push_failed'] = 'An error occurred while the real name verification was submitted for review';
$lang['member_paypal_set'] = 'Set Paypal';
$lang['member_paypal_account'] = 'Paypal Account';
$lang['member_paypal_set_success'] = 'Set Paypal Success';
$lang['member_paypal_set_failed'] = 'An error occurred while setting Paypal';

// 資產相關
$lang['assets'] = 'Assets';
$lang['assets_level'] = 'Stars';
$lang['assets_wallet_cash'] = 'Cash Wallet';
$lang['assets_link'] = 'Today Linking power';
$lang['assets_block_left'] = 'Today Block power (left)';
$lang['assets_block_right'] = 'Today Block power (right)';

// order related
$lang['order_add'] = 'Add Order';
$lang['order_product'] = 'Product';
$lang['order_pay_type'] = 'Payment Method';
$lang['order_add_success_msg'] = 'Additional order is completed, please wait for the background staff to confirm the order';
$lang['order_add_failed_msg'] = 'An error occurred while adding a new order, please try again';

// transaction record related
$lang['trans'] = 'Transaction History';
$lang['trans_wallet'] = 'Wallet';
$lang['trans_wallet_cash'] = 'Cash Wallet';
$lang['trans_wallet_ipoint'] = 'I Wallet';
$lang['trans_withdrawal'] = 'Withdrawal';
$lang['trans_pay'] = 'Payment';
$lang['trans_bonus'] = 'Bonus';
$lang['trans_date'] = 'Date';
$lang['trans_cost'] = 'Amount';
$lang['trans_status'] = 'Status';
$lang['trans_status_0'] = 'unprocessed';
$lang['trans_status_1'] = 'processed';
$lang['trans_product_name'] = 'Scenario';
$lang['trans_pay_name'] = 'Payment Method';
$lang['trans_system'] = 'platform';
$lang['trans_item'] = 'Item';
$lang['trans_balance_cash'] = 'Cash Wallet Balance';
$lang['trans_balance_ipoint'] = 'I Wallet Balance';
$lang['trans_desc'] = 'Detail';
$lang['trans_desc_link'] = 'Details';
$lang['trans_level'] = 'Star';
$lang['trans_block_money'] = 'Block power cash bonus';
$lang['trans_block_ipoint'] = 'Block Power I Points Bonus';
$lang['trans_link_cash'] = 'Linking Power Cash Bonus';
$lang['trans_link_ipoint'] = 'Linking Power I Points Bonus';
$lang['trans_cash'] = 'Cash';
$lang['trans_ipoint'] = 'I Point';

?>