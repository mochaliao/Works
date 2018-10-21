<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

class Gmail
{

    private $_iSwitch = 0;
    private static $_oInstance = array();
    private $_aConfig = array();
    private $_oCI = null;

    static public function getInstance($params)
    {
        if (!array_key_exists($params['iSwitch'], self::$_oInstance) && null === @self::$_oInstance[$params['iSwitch']]) {
            self::$_oInstance[$params['iSwitch']] = new Gmail($params['iSwitch']);
        }
        return self::$_oInstance[$params['iSwitch']];
    }

    public function __construct($iSwitch)
    {
        set_time_limit(0);

// 		$this->_iSwitch = $iSwitch;
// 		if(!$this->_iSwitch){
// 			ini_set('display_errors', 1);
// 			error_reporting(E_ALL);
// 		}
// 		$this->_aConfig['protocol'] 		= WEB_MAIL_PROTOCOL;
// 		$this->_aConfig['smtp_host'] 	= WEB_MAIL_HOST;
// 		$this->_aConfig['smtp_user'] 	= WEB_MAIL_USER;
// 		$this->_aConfig['smtp_pass'] 	= WEB_MAIL_PAWD;
// 		$this->_aConfig['smtp_port'] 	= WEB_MAIL_PROT;
// 		$this->_aConfig['charset'] 		= 'utf-8';
// 		$this->_aConfig['wordwrap'] 	= TRUE;
// 		$this->_aConfig['mailtype'] 		= 'html';
// 		$this->_oCI =& get_instance();
// 		$this->_oCI->load->library('email');
// 		$this->_oCI->email->initialize($this->_aConfig);
// 		$this->_oCI->email->from(WEB_MAIL_USER, '海汇投资');
    }


    /**
     * 用法
     * if(SendMail('512244752@qq.com','zhiyin','邮箱激活','www.tansw.com')){
     * echo "发送邮件成功";
     * }else{
     * echo '发送邮件失败';
     * }
     * @param unknown $address
     * @param unknown $fromname
     * @param unknown $title
     * @param unknown $body
     * @return boolean
     */
    public function SendMail($address, $fromname, $title, $body)
    {
        $mail= new PHPMailer(true);
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "mail.phc-web.net";
        $mail->Port = 465;
        $mail->CharSet = "utf-8";
        $mail->Username = "puhui"; //帳號
        $mail->Password = "puhui123456"; //密碼
        $mail->From = "puhui@phc-web.net"; //寄件者信箱
        $mail->FromName = $fromname; //寄件者姓名
        $mail->Subject = $title; //設定郵件標題
        $mail->Body = $body;
        $mail->AddAddress($address);
        $mail->IsHTML(true); //設定郵件內容為HTML
        $mail->SMTPOptions = array(
            'ssl' => [
                'verify_peer' => true,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ],
        );
        return $mail->send();

        /*$mail = new PHPMailer();
        try {
            $mail->SMTPDebug = 2;
            $mail->IsHTML(true);    //设定所发送的内容是否为html格式
            $mail->IsSMTP();        // 设置PHPMailer使用SMTP服务器发送Email
            $mail->CharSet = 'UTF-8'; // 设置邮件的字符编码，若不指定，则为'UTF-8'
            $mail->Port = 465;
            $mail->Host = 'mail.phc-web.net';        // 设置SMTP服务器。    php 开启 php_openssl.dll 扩展
            $mail->SMTPAuth = true;                            // 设置为"需要验证"
            $mail->SMTPSecure = 'ssl';
            $mail->From = 'office@phuei-century.com';        // 邮件发送者email地址
            $mail->Username = 'puhui';
            $mail->Password = 'puhui123456';
            $mail->FromName = $fromname;//设置发件人名字
            $mail->Subject = $title;    //设置邮件标题
            $mail->AddAddress($address);// 添加收件人地址，可以多次使用来添加多个收件人
            $mail->Body = $body;// 设置邮件正文
            $result = $mail->Send();
            echo 'result = '.$result;
            return true;
        } catch (Exception $e) {
            echo 'result = '.$mail->ErrorInfo;
            return false;
        }*/
    }

}// End class Gmail {...}