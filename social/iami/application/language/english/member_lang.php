<?php
//======================================================================================================================
//訊息
//======================================================================================================================
//新增會員成功
$lang['member_add_success'] = 'Member add successfully !!';
//新增會員失敗
$lang['member_add_failed'] = 'Member add error, please try again !!';
//修改會員成功
$lang['member_edit_success'] = 'Member update successfully !!';
//修改會員失敗
$lang['member_edit_failed'] = 'Member update failed, please try again !!';
//修改會員任職公司及職位成功
$lang['member_company_edit_success'] = 'Member company update successfully !!';
//修改會員任職公司及職位失敗
$lang['member_company_edit_failed'] = 'Member company update failed, please try again !!';
//修改會員學校及科系
$lang['member_school_edit_success'] = 'Member school update successfully !!';
//修改會員學校及科系
$lang['member_school_edit_failed'] = 'Member school update failed, please try again !!';
//會員email不存在
$lang['member_email_not_exists'] = 'Email not exists, please try again !!';
//會員email格式錯誤
$lang['member_email_format_error'] = 'Email format error，please try again !!';
// 請輸入email
$lang['member_email_not_input'] = 'Please input your email !!';
//密碼錯誤
$lang['member_password_incorrect'] = 'Password incorrect, please try again !!';
//會員尚未啟用
$lang['member_not_activated'] = 'Your account not activated yet, please check your email box, and activate your account !!';
//會員已停用
$lang['member_disabled'] = 'Your account has be disabled, please contact our help desk !!';
//非預期的錯誤
$lang['member_unexpected_error'] = 'Oops, there is an unexpected error, please call our help desk !!';
//會員ID不存在
$lang['member_member_id_not_exists'] = 'Member ID not exists !!';
//會員ID是空的
$lang['member_member_id_empty'] = 'Member ID is empty !!';
//會員註冊成功
$lang['member_register_success'] = 'Register Success !!Please verify your account in your email';
//======================================================================================================================
//頁面文字
//======================================================================================================================
//註冊頁Title
$lang['member_register_title'] = 'SignUp';
//帳號
$lang['member_field_memberid'] = 'MemberID';
//電子郵件
$lang['member_field_email'] = 'Email';
//密碼
$lang['member_field_password_login'] = 'Password';
// $lang['member_field_password'] = 'Password 6-12 (a-z, A-Z, 0-9)';
$lang['member_field_password'] = 'Password';
//確認密碼
// $lang['member_field_repassword'] = 'Password Confirm 6-12 (a-z, A-Z, 0-9)';
$lang['member_field_repassword'] = 'Password Confirm';
//暱稱
$lang['member_field_nickname'] = 'Nickname';
//性別
$lang['member_field_gender'] = 'Gender';
//男
$lang['member_field_gender_male'] = 'Male';
//女
$lang['member_field_gender_female'] = 'Female';
//手機
$lang['member_field_mobile'] = 'Mobile Phone Number';
//生日
$lang['member_field_birth'] = 'Birthday';
//大頭照
$lang['member_field_avatar'] = 'Your avatar photo';
//封面照
$lang['member_field_banner'] = 'Your cover photo';
//使用語言
$lang['member_field_language_id'] = 'Your language';
//註冊按鈕
$lang['member_btn_register'] = 'SignUp';
//註冊下面說明
$lang['member_register_note'] = 'SignUp, you agree our <a href="/member/showService">service terms</a>、<a href="/member/showPrivacy">privacy policy</a>.<br>Other members could find you by your email or phone number.';

//======================================================================================================================
//修改個人資料頁Title
$lang['member_edit_title'] = 'Edit your profile';
//修改簡歷
$lang['member_field_resume'] = 'Please input your resume';
//任職公司
$lang['member_field_company'] = 'Company';
//職務
$lang['member_field_position'] = 'Position';
//學校
$lang['member_field_school'] = 'School';
//科系
$lang['member_field_department'] = 'Department';
//居住地
$lang['member_field_city'] = 'City';
//國藉
$lang['member_field_country'] = 'Country';
//感情狀態
$lang['member_field_relationship'] = 'Relationship';
//感情狀態選項
$lang['member_option_relationship'] = array(
    'married' => 'Married',
    'devorce' => 'Devorce',
    'dating' => 'Dating',
    'single' => 'Single'
);
//修改確認按鈕
$lang['member_btn_edit'] = 'Submit';
//======================================================================================================================
//登入頁Title
$lang['member_login_title'] = 'SignIn';
//記得我
$lang['member_remember_me'] = 'Remember Me';
//忘記密碼
$lang['member_forget_password'] = 'Forget Password';
//忘記密碼說明
$lang['member_forget_password_note'] = 'If you forget password, please input your email, '.SITE_NAME.' will sent forget password link to your mailbox.';
//登入按鈕
$lang['member_btn_login'] = 'SignIn';
//登出按鈕
$lang['member_btn_logout'] = 'Logout';
//送出按鈕
$lang['member_btn_submit'] = 'Submit';
//隱私政策
$lang['member_privacy_policy'] = 'Privacy Policy';
//隱私政策內容
$lang['member_privacy_policy_text'] = '
<p> What information do we collect? </p>
<span> We collect a variety of information from or about you, depending on the services you use. </span>
<p> Your behavior and the information provided. </p>
<span> We collect what you provide while using the service and what other information we collect about it. <br>We collect a variety of information from or about you, depending on the services you use. <br>Your behavior and the information provided. <br>
We collect content and other information you provide while using the service, including registering accounts, creating or sharing content, and sending messages or communicating with other users. This can be the content you provided, or information about it, such as where the photo was taken or the date the file was created. In addition, we collect information about how you use the service, such as the type of content you view or interact with, and how often and when you post it dynamically.</span>
<p> Other users\' behavior and information provided. </p>
<span> We also collect content and information (including information about you) provided by other users while using the service, such as sharing your photos, sending you a message, or uploading, syncing or importing your contacts data. </span>
<p> Your network and relationship chain. </p>
<span> We collect information about your connected users and communities, and how you interact with them, such as the communities you most frequently interact with or are willing to share with others. <br>
If you upload, sync, or import contact information (such as address books) from your device, we may also collect this information from you.</span>
<p> Information on payment methods. </p>
<span> We collect information about purchases or trades if you use our services to conduct purchases or financial transactions (such as buying, playing in-game, or making donations on '.SITE_NAME.') This includes your payment information, such as credit card or debit card numbers and other card information, as well as other account and verification information, as well as billing, shipping and contact details. </span>
<p> Device Information. </p>
<span> We rely on the permissions you grant to collect information about the computer, phone or other device on which you install or use our services or about us. <br>
We collect information collected from different devices, which helps us provide a consistent service for your various devices. The following example shows the types of device information we collect:</span>
<p> Properties such as operating system, hardware version, device settings, file and software name and type, battery power and signal strength, and device ID. </p>
<span> Device location, including a specific geographic location targeted by GPS, Bluetooth or WiFi signals. <br>
Connection information such as mobile operator or ISP name, browser type, language setting and time zone, phone number and IP address.
</span>
<p>Information obtained from websites and applications that use our services. </p>
<span> If third party websites and applications use our services (such as providing a "Like" button or "'.SITE_NAME.' \'sign in\', or using our measurement tools and advertising services), we collect information about your browsing or Information on using these sites and applications. <br>
This information includes the websites and applications you visit, the use of our services on these websites and applications, and the information that you or us are provided by the application or website developer or publisher.</span>
<p> Information provided by third-party partners. </p>
<span> We receive information about you and your activity on '.SITE_NAME.' and other cyberspace provided by third party partners; for example, when we partner with our partners to provide services Or information provided by advertisers about your ad experience, or interactions with them. </span>
<p> '.SITE_NAME.' Businesses. </p>
<span> We receive information about you from these businesses based on the terms and policies of '.SITE_NAME.'\'s owning or operating businesses. Gain insight into these businesses and their privacy policies. </span>
';
//服務條款
$lang['member_service_term'] = 'Service Terms';
//服務條款內容
$lang['member_service_term_text'] = '
<p> Terms of Service (Declaration of Rights and Obligations) </p>
<span> These terms of use (ie, rights and obligations notices), "Agreement", "Terms" or "SRR", as defined by the '.SITE_NAME.' principle, are our Terms of Service that govern us Relationships with users and others who interact with '.SITE_NAME.' Also regulate the relationship of '.SITE_NAME.' Brands, products and services (collectively "'.SITE_NAME.' Services  or Services"). By using or logging into the '.SITE_NAME.' Service you are agreeing to this agreement and this agreement will be updated from time to time to comply with the provisions of section 13 below. In addition, you can find more information at the bottom of this document to help you understand how '.SITE_NAME.' works. Because '.SITE_NAME.' Offers a wide range of services, we may ask you to review and accept additional terms that apply to your interactions with a particular application, product, or service. If this subsidy clause conflicts with the SRR, your use of the application, product or service in connection with the supplemental clause will be governed by the Supplemental Terms and Conditions, subject to the extent of the restrictions set forth above. </span>
<p> Privacy Settings </p>
<span> Your privacy is important to us. We\'ve devised a data policy to carefully explain how you can use '.SITE_NAME.' To share with others and how we can gather and use your content and information. We encourage you to read the data policies and use this policy to help you make informed decisions. </span>
<p> Share your content & information </p>
<span> You have all the content and stuff you\'ve posted on '.SITE_NAME.' You can manage how your content is shared with privacy and apps. In addition, the intellectual property rights covered by the content, such as photos and videos (intellectual property rights content), will be based on your privacy and application settings, give us the following privileges: you give us a non-exclusive, transferable, re-authorized, royalty-free Global license to use any intellectual property (intellectual property rights) you may post on '.SITE_NAME.' Or '.SITE_NAME.'. When you delete your intellectual property or account, this intellectual property authorization ends, unless your content is shared with others and they are not deleted. <br>
When you delete the intellectual property, the situation is like clearing the recycling bin on your computer. However, you should understand that the deleted content may have a backup copy (but will not be available to others) for a reasonable period of time. <br>
When you use an application, the application may require authorization to access your content and information, as well as the content and information that others have shared with you. We require that the application respect your privacy and that your agreement with the application will control how the application uses, stores, and transfers your content and information. (For more information about an open platform, including how you control what others can share with your app, read our Data Policy and the Open Platform page.) <br>
When you post content or information in an "public" setting, you grant access to or use of the information on your behalf, including you, other than '.SITE_NAME.' (Eg, your Name and big picture). <br>
We\'re always grateful for the comments you\'ve made or for any other suggestions we have about '.SITE_NAME.' But please understand that we have no obligation to provide you compensation for the use of these comments (as you have no obligation to provide advice).
</span>
<p> Security </p>
<span> We tried our best to maintain '.SITE_NAME.' but we can not guarantee it. We need your assistance to maintain '.SITE_NAME.' security, including the following commitments: <br>
You will not post unauthorized commercial content (such as spam) on '.SITE_NAME.' <br>
You will not be able to collect user content or information or otherwise use automated means to log in to '.SITE_NAME.' (such as autotups, robots, web spiders or web crawlers) without our prior permission. <br>
You will not engage in illegal multi-level pyramid schemes such as pyramid schemes at '.SITE_NAME.' <br>
You will not upload viruses or other malicious code. <br>
You will not collect login information or intend to enter an account belonging to others. <br>
You will not bully, intimidate or harass any user. <br>
You will not post the following: Content that promotes hatred, threats, pornography, incitement to violence, or dew point or bloody violence. <br>
Without an appropriate age limit, you will not develop or operate third-party applications that include alcohol-related, social services or other adult content, including advertisements. <br>
You will not use '.SITE_NAME.' For any unlawful, misleading, malicious or discriminatory conduct. <br>
You will not do anything that will shut down, overload, or damage the normal functioning and appearance of '.SITE_NAME.' Such as blocking service attacks or disrupting page views or other '.SITE_NAME.' features. <br>
You will not assist or encourage any violation of this agreement or policy. </span>
<p> Registration and account security </p>
<span> '.SITE_NAME.' The user has their own real name and profile, and we need your cooperation to keep that pattern going. Here\'s your commitment to registering and maintaining your account\'s security: <br>
You will not provide any fake personal data on '.SITE_NAME.' Or create an account for others without your permission. <br>
You will not create more than one personal account. <br>
If we disable your account, you will not create another account without our permission. <br>
Instead of using personal dynamic times as your primary source of business monetization, you will use the '.SITE_NAME.' Fan page for this purpose. <br>
If you are under 13, you will not be using '.SITE_NAME.' <br>
If you have been convicted as a sex offender, you will not be using '.SITE_NAME.' <br>
You will provide the correct contact information and update it immediately. <br>
You will not share your password (or, as a developer, your developer key), have someone log in to your account, or do anything that could jeopardize your account\'s security. <br>
You will not transfer your account to anyone (including any fan page or application under your management) without our prior written permission. <br>
If you choose a user name or a similar logo for your account or fan page and we decide to remove it or withdraw it if it is determined to be appropriate (for example, the trademark owner complains that the user name does not match the user\'s real name) s right.
</span>
<p> Protecting the rights of others </p>
<span> We respect the rights of others and hope you can handle them accordingly. <br>
You will not post content, or any action that infringes, violates the rights of others or violates the law at '.SITE_NAME.' <br>
We reserve the right to remove content if we believe any content or material you posted on '.SITE_NAME.' Is in violation of this agreement or our policies. <br>
We provide you with tools to help you protect intellectual property. To learn more, visit How to Submit a Complaint Statement on Intellectual Property Violations. <br>
If your content is removed by us as a result of infringing someone else\'s copyright and you believe we have removed it incorrectly, we will give you an opportunity to appeal. <br>
If you repeatedly infringe the intellectual property rights of others, we will disable your account in due course. <br>
You may not use our copyrights, trademarks or any other marks likely to cause confusion unless expressly permitted by our "Brand Usage Guidelines" or obtained our written consent. <br>
If you collect user-related information, you must: Obtain user consent, specifically indicating that you, not '.SITE_NAME.' , Collect their information and publish a privacy policy describing the types of information you collect and how you will use them data. <br>
You will not post any person\'s identification or sensitive financial information on '.SITE_NAME.' <br>
You will not tag users or send e-mail invitations to non-users without the consent of others. '.SITE_NAME.' Has a community flagging tool that allows users to comment on annotations.
</span>
<p> Mobile phones and other devices </p>
<span> We currently offer free mobile services, but please note that normal rates and fees for carriers, such as SMS and data transfer charges, still apply. <br>
After changing or canceling your mobile number, please update your '.SITE_NAME.' account information within 48 hours to ensure that your message will not be sent to users using your old number. <br>
You give consent and all necessary rights to enable users to use the device to sync (including through apps) any information they see on '.SITE_NAME.'
</span>
<p> Payments </p>
<span>By using the payment function on '.SITE_NAME.', you agree to our payment agreement unless otherwise stated in the agreement. <br>
Special Provisions for Application and Website Developers / Managers <br>
<br>
If you are a developer or operator of an open platform application or website, or if you use community plugins, you must follow the '.SITE_NAME.' Open Platform Policy. <br>
About ads and other business content provided or enhanced by '.SITE_NAME.' <br>
<br>
Our goal is to provide valuable advertising and commercial or sponsorship content to our users and advertisers. To help us reach our goal, you agree to the following: <br>
You grant this Website permission to use your name, photo, content, and information in any commercial, sponsored or related content (such as your preferred brand) provided or enhanced by us. In other words, you allow businesses or other entities to pay us for the display of your name and / or photo with your content or information without any remuneration. If you choose a specific share for your content or information, we respect your choices when using the content or information. <br>
We will not provide your advertisers with your content or information without your consent. <br>
Please be considerate We do not often distinguish between paid services and such general communications.<br>
By using our self-service ad creation interface to create, submit and / or serve any ad or other commercial, sponsored event or content (collectively "SelfAdvertising Interface"), you agree to our self-service advertising terms. In addition, your ads, other business or sponsored events, or content posted via the '.SITE_NAME.' Or publisher networks, will adhere to the advertising policies. <br>
</span>
';
//變更密碼郵件已送出
$lang['member_password_send'] = 'Reset password email sent';
//變更密碼郵件已送出內容
$lang['member_password_send_text'] = 'Dear '.SITE_NAME.' member, we already sent change your password and send to your mail box, please check your mail box !';
//確認按鈕
$lang['member_btn_confirm'] = 'Confirm';
//啟用信subject
$lang['member_email_subject'] = SITE_NAME . '  account acitve mail';
//尚未登入訊息
$lang['member_not_login_error'] = 'Error access, you have to signin !!';
//修改密碼title
$lang['member_change_password_title'] = 'Change Password';
//原密碼
$lang['member_field_old_password'] = 'Original password';
//新密碼
$lang['member_field_new_password'] = 'New password';
//新密碼再次輸入
$lang['member_field_confirm_new_password'] = 'Confirm new password';
//修改密碼失數訊息
$lang['member_edit_password_failed_message'] = 'Woops, change password failed, please try again !!';
//email不能為空白
$lang['member_email_empty'] = 'Email can not be empty !!';
//member_id不能為空白
$lang['member_id_empty'] = 'Member ID can not be empty !!';
//编辑大頭照
$lang['member_edit_avatar'] = 'Edit avatar photo';
//编辑封面照
$lang['member_edit_cover'] = 'Edit cover photo';
//个人简历長度不能大於255
$lang['member_resume_exceed_max_len'] = 'The length of resume cannot be greater than 255';
//學校名稱長度不能大於10
$lang['member_school_exceed_max_len'] = 'The length of school name cannot be greater than 10';
//科系名稱長度不能大於10
$lang['member_dpm_exceed_max_len'] = 'The length of department name cannot be greater than 10';

//忘記密碼信件主旨
$lang['member_forget_email_subject'] = 'IamI forget password notification letter';
//忘記密碼信件內容
$lang['member_forget_email_content'] = 'Your new password is <b>{new_password}</b>, please keep it';

//個性化標籤
$lang['personal-label'] = 'Personal Label';
$lang['create-label'] = 'Create Label';
$lang['has-chosen'] = 'you have chosen';
$lang['piece'] = 'piece (Max: 10)';
$lang['self-input'] = 'input label';
$lang['label_not_empty'] = 'Label cannot be empty';

//忘記密碼
$lang['forget-password'] = 'Foget Password';
//輸入新密碼
$lang['input-new-password'] = 'input your new password';
//再次輸入新密碼
$lang['input-new-password-again'] = 'input password again';

$lang['confirm'] = 'check';
//昵称超长
$lang['member_nickname_too_long'] = 'Nickname is too long';

$lang['register_success'] = 'Authentication Success!!';
$lang['register_success_detail'] = '<center>Congratulations!!You have finish the registration!! <br>Please login your account to start the best social media IAMI</center>';