<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

//切換語系
if (!function_exists('switchLanguage')) {
    function switchLanguage($language_id)
    {
        $ci =& get_instance();
        $ci->session->set_userdata('language_id', $language_id);
        $ci->config->set_item('language', $language_id);
    }
}

//取得域名
if (!function_exists('get_domain')) {
    function get_domain()
    {
        $server_protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
        $server_name = $_SERVER['SERVER_NAME'];

        if ($server_name == "iami-web.me") {
            $server_name = "www.iami-web.me";
        }
        $server_port = $_SERVER['SERVER_PORT'];
        if ($server_port == 80 || $server_port == 443) {
            $domain = $server_protocol . $server_name;
        } else {
            $domain = $server_protocol . $server_name . ':' . $server_port;
        }
        return $domain;
    }
}

//取得流覽器的語系
if (!function_exists('get_browser_language')) {
    function get_browser_language()
    {
        $http_accept_language = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? strtok($_SERVER['HTTP_ACCEPT_LANGUAGE'], ',') : "";
        $http_accept_language = strtolower($http_accept_language);
        switch ($http_accept_language) {
            case 'en-us':
                return 'english';
                break;
            case 'en-uk':
                return 'english';
                break;
            case 'zh-tw':
                return 'zh-TW';
                break;
            case 'zh-cn':
                return 'zh-CN';
                break;
            default:
                return 'english';
            // return $http_accept_language;
        }
    }
}

//取得是否為行動裝置
if (!function_exists('is_mobile')) {
    function is_mobile()
    {
        $detect = new Mobile_Detect;

        if ($detect->isMobile()) {
            return TRUE;
        } else {
            return FALSE;
        }
        unset($detect);
    }
}

//取得目前所在平台Production/Dev/Test/Demo
if (!function_exists('get_platform')) {
    function get_platform()
    {
        $domain = get_domain();
        $domain = strtolower(str_replace('http://', '', $domain));
        $domain = strtolower(str_replace('https://', '', $domain));
        $tmp = explode('.', $domain);
        if (count($tmp) == 2 || strtolower($tmp[0]) == 'www') {
            return 'production';
        }else if (count($tmp) >= 3 && strtolower($tmp[0]) == 'test'){
            return 'test';
        }else{
            return 'dev';
        }
    }
}

//取得proxy設定
if (!function_exists('get_proxy')) {
    function get_proxy()
    {
        $platform = get_platform();
        if (strtolower($platform) == 'production') {
            $domain = get_domain();
            $domain = strtolower(str_replace('http://', '', $domain));
            $domain = strtolower(str_replace('https://', '', $domain));
            $tmp = explode('.', $domain);
            if (strtolower($tmp[0]) == 'www'){
                $domain = explode('.', $domain, 2)[1];
            }
            return PROXY_HOST.'.'.$domain;
        }else if (strtolower($platform) == 'test'){
            return '';
        }else{
            return '';
        }
    }
}

//依目前所在平台取得七牛的AK及SK
if (!function_exists('get_key')) {
    function get_key()
    {
        $platform = get_platform();

        switch ($platform) {
            case 'production':
                return array('AccessKey' => 'hmFbZ74kPW8uKn4CR-XUC1VnfOnt9kF6GCoxduO7', 'SecretKey' => 'qTbfbYiViFrKT3fuR8x36jzGkwg7sG7xdkL0C2qz');
                break;
            case 'dev':
                return array('AccessKey' => 'hmFbZ74kPW8uKn4CR-XUC1VnfOnt9kF6GCoxduO7', 'SecretKey' => 'qTbfbYiViFrKT3fuR8x36jzGkwg7sG7xdkL0C2qz');
                break;
            case 'test':
                return array('AccessKey' => 'hmFbZ74kPW8uKn4CR-XUC1VnfOnt9kF6GCoxduO7', 'SecretKey' => 'qTbfbYiViFrKT3fuR8x36jzGkwg7sG7xdkL0C2qz');
                break;
            case 'demo':
                return array('AccessKey' => 'hmFbZ74kPW8uKn4CR-XUC1VnfOnt9kF6GCoxduO7', 'SecretKey' => 'qTbfbYiViFrKT3fuR8x36jzGkwg7sG7xdkL0C2qz');
                break;
            default:
                return array('AccessKey' => 'hmFbZ74kPW8uKn4CR-XUC1VnfOnt9kF6GCoxduO7', 'SecretKey' => 'qTbfbYiViFrKT3fuR8x36jzGkwg7sG7xdkL0C2qz');
        }
    }
}

//依目前所在平台取得七牛的直播空間名稱
if (!function_exists('get_hub_name')) {
    function get_hub_name()
    {
        $platform = get_platform();

        switch ($platform) {
            case 'production':
                return 'iami-web-me';
                break;
            case 'dev':
                return 'iami-web-me';
                break;
            case 'test':
                return 'iami-web-me';
                break;
            case 'demo':
                return 'iami-web-me';
                break;
            default:
                return 'iami-web-me';
        }
    }
}

if (!function_exists('get_qiniu_oss_setting')) {
    function get_qiniu_oss_setting()
    {
        $platform = strtolower(get_platform());
        switch ($platform) {
            case 'production':
                return array("bucket" => 'iamiweb-oss' , "accessKey" => "hmFbZ74kPW8uKn4CR-XUC1VnfOnt9kF6GCoxduO7", "secretKey" => "qTbfbYiViFrKT3fuR8x36jzGkwg7sG7xdkL0C2qz", "baseUrl" => "http://p5oe5axh4.bkt.clouddn.com/");
                break;
            case 'dev':
                return array("bucket" => 'iamiweb-oss-dev' , "accessKey" => "hmFbZ74kPW8uKn4CR-XUC1VnfOnt9kF6GCoxduO7", "secretKey" => "qTbfbYiViFrKT3fuR8x36jzGkwg7sG7xdkL0C2qz", "baseUrl" => "http://p6888w4wr.bkt.clouddn.com/");
                break;
            case 'test':
                return array("bucket" => 'iamiweb-oss-dev' , "accessKey" => "hmFbZ74kPW8uKn4CR-XUC1VnfOnt9kF6GCoxduO7", "secretKey" => "qTbfbYiViFrKT3fuR8x36jzGkwg7sG7xdkL0C2qz", "baseUrl" => "http://p6888w4wr.bkt.clouddn.com/");
                break;
            case 'demo':
                return array("bucket" => 'iamiweb-oss' , "accessKey" => "hmFbZ74kPW8uKn4CR-XUC1VnfOnt9kF6GCoxduO7", "secretKey" => "qTbfbYiViFrKT3fuR8x36jzGkwg7sG7xdkL0C2qz", "baseUrl" => "http://p5oe5axh4.bkt.clouddn.com/");
                break;
            default:
                return array("bucket" => 'iamiweb-oss-dev' , "accessKey" => "hmFbZ74kPW8uKn4CR-XUC1VnfOnt9kF6GCoxduO7", "secretKey" => "qTbfbYiViFrKT3fuR8x36jzGkwg7sG7xdkL0C2qz", "baseUrl" => "http://p6888w4wr.bkt.clouddn.com/");
        }


    }
}

//是否已登入
if (!function_exists('isLogin')) {
    function isLogin($isRedirect = TRUE)
    {
        //檢查cookie(有cookie)
        if (!empty(get_cookie('member_id')) && !empty(get_cookie('email'))) {
            return TRUE;
        } else if (trim((get_instance()->input->post("token"))) != "") {
            $token = get_instance()->input->post("token");
            $member = json_decode(base64_decode(base64_decode($token)));

            // Token 解析失敗
            if ($member == "") {
                return FALSE;
            }

            // Token 時間過期
            if (strtotime($member->token_expired) < strtotime(date("Y-m-d H:i:s"))) {
                echo json_encode(array('status' => 'failed', 'message' => "token expired", 'code' => 'TK001'));
                exit;
                return FALSE;
            }

            get_instance()->session->set_userdata('member_id', $member->member_id);

            get_instance()->session->set_userdata('language_id', $member->language_id);
            if(!isset($_SERVER["HTTP_SET_LG"])){
                get_instance()->config->set_item('language', $member->language_id);
            }

            return TRUE;
        } else if (trim((get_instance()->input->get("token"))) != "") {
            $token = get_instance()->input->get("token");
            $member = json_decode(base64_decode(base64_decode($token)));

            // Token 解析失敗
            if ($member == "") {
                return FALSE;
            }

            // Token 時間過期
            if (strtotime($member->token_expired) < strtotime(date("Y-m-d H:i:s"))) {
                return FALSE;
            }

            get_instance()->session->set_userdata('member_id', $member->member_id);

            get_instance()->session->set_userdata('language_id', $member->language_id);
            if(!isset($_SERVER["HTTP_SET_LG"])){
                get_instance()->config->set_item('language', $member->language_id);
            }
            return TRUE;
        } //檢查cookie(無cookie)
        else {
            //檢查session(已登入)
            if (!empty(get_instance()->session->userdata('member_id')) && !empty(get_instance()->session->userdata('email'))) {
                return TRUE;
            } //檢查session(未登入)
            else {
                //要導到登入頁
                if ($isRedirect) {
                    redirect('/member/showLogin');
                    return FALSE;
                } else {
                    return FALSE;
                }
            }
        }
    }
}

//產生亂數
if (!function_exists('generate_random_string')) {
    function generate_random_string($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

//取得啟用信內容
if (!function_exists('get_active_content')) {
    function get_active_content()
    {
        $patterns = array();
        $patterns['site_name'] = '/{site_name}/';
        $patterns['nickname'] = '/{nickname}/';
        $patterns['link'] = '/{link}/';
        $replacements = array();
        $replacements['site_name'] = SITE_NAME;
        $replacements['nickname'] = 'Jeff';
        $replacements['link'] = 'http://www.iamiweb.com/';
        $ci =& get_instance();
        $content = $ci->lang->line('member_active_text');

        return preg_replace($patterns, $replacements, $content);
    }
}

//取得離目前的多少分鐘、小時
if (!function_exists('get_time_from_now')) {
    function get_time_from_now($mytime)
    {
        $date1 = new DateTime($mytime);
        $date2 = new DateTime(date('Y-m-d H:i:s'));
        $diff = date_diff($date1, $date2);
        $years = intval($diff->format("%R%y"));
        $months = intval($diff->format("%R%m"));
        $weeks = floor(intval($diff->format("%R%a")) / 7);
        $days = intval($diff->format("%R%a"));
        $hours = intval($diff->format("%R%h"));
        $minutes = intval($diff->format("%R%i"));
        $seconds = intval($diff->format("%R%s"));

        $ci =& get_instance();
        //年
        if ($years > 0) {
            if ($years == 1) {
                return $years . ' ' . $ci->lang->line('year') . '(' . $ci->lang->line('before') . ')';
            } else {
                return $years . ' ' . $ci->lang->line('years') . '(' . $ci->lang->line('before') . ')';
            }
        } elseif ($years < 0) {
            if ($years == -1) {
                return $years . ' ' . $ci->lang->line('year') . '(' . $ci->lang->line('after') . ')';
            } else {
                return $years . ' ' . $ci->lang->line('years') . '(' . $ci->lang->line('after') . ')';
            }
        }
        //月
        if ($months > 0) {
            if ($months == 1) {
                return $months . ' ' . $ci->lang->line('month') . '(' . $ci->lang->line('before') . ')';
            } else {
                return $months . ' ' . $ci->lang->line('months') . '(' . $ci->lang->line('before') . ')';
            }
        } elseif ($months < 0) {
            if ($months == -1) {
                return $months . ' ' . $ci->lang->line('month') . '(' . $ci->lang->line('after') . ')';
            } else {
                return $months . ' ' . $ci->lang->line('months') . '(' . $ci->lang->line('after') . ')';
            }
        }
        //週
        if ($weeks > 0) {
            if ($weeks == 1) {
                return $weeks . ' ' . $ci->lang->line('week') . '(' . $ci->lang->line('before') . ')';
            } else {
                return $weeks . ' ' . $ci->lang->line('weeks') . '(' . $ci->lang->line('before') . ')';
            }
        } elseif ($weeks < 0) {
            if ($weeks == -1) {
                return $weeks . ' ' . $ci->lang->line('week') . '(' . $ci->lang->line('after') . ')';
            } else {
                return $weeks . ' ' . $ci->lang->line('weeks') . '(' . $ci->lang->line('after') . ')';
            }
        }
        //天
        if ($days > 0) {
            if ($days == 1) {
                return $days . ' ' . $ci->lang->line('day') . '(' . $ci->lang->line('before') . ')';
            } else {
                return $days . ' ' . $ci->lang->line('days') . '(' . $ci->lang->line('before') . ')';
            }
        } elseif ($days < 0) {
            if ($days == -1) {
                return $days . ' ' . $ci->lang->line('day') . '(' . $ci->lang->line('after') . ')';
            } else {
                return $days . ' ' . $ci->lang->line('days') . '(' . $ci->lang->line('after') . ')';
            }
        }
        //時
        if ($hours > 0) {
            if ($hours == 1) {
                return $hours . ' ' . $ci->lang->line('hour') . '(' . $ci->lang->line('before') . ')';
            } else {
                return $hours . ' ' . $ci->lang->line('hours') . '(' . $ci->lang->line('before') . ')';
            }
        } elseif ($hours < 0) {
            if ($hours == -1) {
                return $hours . ' ' . $ci->lang->line('hour') . '(' . $ci->lang->line('after') . ')';
            } else {
                return $hours . ' ' . $ci->lang->line('hours') . '(' . $ci->lang->line('after') . ')';
            }
        }
        //分
        if ($minutes > 0) {
            if ($minutes == 1) {
                return $minutes . ' ' . $ci->lang->line('minute') . '(' . $ci->lang->line('before') . ')';
            } else {
                return $minutes . ' ' . $ci->lang->line('minutes') . '(' . $ci->lang->line('before') . ')';
            }
        } elseif ($minutes < 0) {
            if ($minutes == -1) {
                return $minutes . ' ' . $ci->lang->line('minute') . '(' . $ci->lang->line('after') . ')';
            } else {
                return $minutes . ' ' . $ci->lang->line('minutes') . '(' . $ci->lang->line('after') . ')';
            }
        }
        //分
        if ($seconds > 0) {
            if ($seconds == 1) {
                return $seconds . ' ' . $ci->lang->line('second') . '(' . $ci->lang->line('before') . ')';
            } else {
                return $seconds . ' ' . $ci->lang->line('seconds') . '(' . $ci->lang->line('before') . ')';
            }
        } elseif ($seconds < 0) {
            if ($seconds == -1) {
                return $seconds . ' ' . $ci->lang->line('second') . '(' . $ci->lang->line('after') . ')';
            } else {
                return $seconds . ' ' . $ci->lang->line('seconds') . '(' . $ci->lang->line('after') . ')';
            }
        }

        return  '1  ' . $ci->lang->line('second') . '(' . $ci->lang->line('before') . ')';
    }
}

//取得push server的domain
if (!function_exists('get_push_domain')) {
    function get_push_domain()
    {
        $platform = strtolower(get_platform());
        switch ($platform) {
            case 'production':
                return 'http://push.iami-web.me';
                break;
            case 'dev':
                //return 'http://dev.iamiweb.com';
                return 'http://www.iami-web.me';
                break;
            case 'test':
                //return 'http://dev.iamiweb.com';
                return 'http://push.iami-web.me';
                break;
            case 'demo':
                //return 'http://dev.iamiweb.com';
                return 'http://www.iami-web.me';
                break;
            default:
                //return 'http://dev.iamiweb.com';
                return 'http://www.iami-web.me';
        }
    }
}

//推送訊息給Browser
if (!function_exists('push_data')) {
    function push_data($member_id, $data)
    {
        $push_api_url = get_push_domain() . ':' . SERVER_PUSH_PORT . '/';
        $post_data = array(
            "type" => "publish",
            "content" => json_encode($data, JSON_UNESCAPED_UNICODE),
            "to" => $member_id,
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $push_api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Expect:"));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    function test()
    {
        require_once(APPPATH . 'controllers/' . 'Live.php');

        $live = new live();

        return $live->syncLive();
    }
}

//取得域名
if (!function_exists('send_mail')) {
    function send_mail($sender, $subject, $content)
    {
        $query["mail"] = $sender;
        $query["subject"] = $subject;
        $query["content"] = $content;
        $query["website"] = "iami";

        $ch = curl_init();
        $post_fields = (true) ? $query : http_build_query($query);

        $options = array(
            CURLOPT_URL => "http://recharge.hengruishang.com/index.php/api/sendMail",
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HEADER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1",
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $post_fields
        );

        curl_setopt_array($ch, $options);
        $output = curl_exec($ch);


        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        // $header = substr($output, 0, $header_size);
        $body = substr($output, $header_size);

        curl_close($ch);
        unset($ch);


        $result = json_decode($body);
        return ($result->status == "success");
    }
}

if (!function_exists('getVersion')) {
    function getVersion()
    {
        $version = date("Ymd");
        return $version;
    }
}

if (!function_exists('upload_to_qiniu')) {
    function upload_to_qiniu($filePath, $prefix = "")
    {


        // $filePath = dirname(BASEPATH) . "/member_data/picture/" . $fullfilename;

        include_once APPPATH . 'third_party/qiniu/io.php';
        include_once APPPATH . 'third_party/qiniu/rs.php';

        $oss_setting = get_qiniu_oss_setting();
        $bucket = $oss_setting['bucket'];
        $key = $prefix . basename($filePath);
        $accessKey = $oss_setting['accessKey'];
        $secretKey = $oss_setting['secretKey'];

        Qiniu_SetKeys($accessKey, $secretKey);

        $putPolicy = new Qiniu_RS_PutPolicy($bucket);

        $upToken = $putPolicy->Token(null);
        $putExtra = new Qiniu_PutExtra();
        $putExtra->Crc32 = 1;
        list($ret, $err) = Qiniu_PutFile($upToken, $key, $filePath, $putExtra);
        // echo "====> Qiniu_PutFile result: \n";
        /*
        if ($err !== null) {
            var_dump($err);
//            var_dump($upToken);
        } else {
            var_dump($ret);
//            var_dump($upToken);
        }
        */

    }
}

if (!function_exists('qiniu_exists')) {

    function qiniu_exists($filePath, $prefix = "")
    {

        require_once APPPATH . 'third_party/bull/Qiniu/Auth.php';
        require_once APPPATH . 'third_party/bull/Qiniu/Config.php';
        require_once APPPATH . 'third_party/bull/Qiniu/Http/Client.php';
        require_once APPPATH . 'third_party/bull/Qiniu/Http/Request.php';
        require_once APPPATH . 'third_party/bull/Qiniu/Http/Response.php';
        require_once APPPATH . 'third_party/bull/Qiniu/Http/Error.php';
        require_once APPPATH . 'third_party/bull/Qiniu/Storage/BucketManager.php';
        require_once APPPATH . 'third_party/bull/Qiniu/Config.php';
        require_once APPPATH . 'third_party/bull/Qiniu/functions.php';


        $oss_setting = get_qiniu_oss_setting();
        $bucket = $oss_setting['bucket'];
        $key = $prefix . basename($filePath);
        $accessKey = $oss_setting['accessKey'];
        $secretKey = $oss_setting['secretKey'];

        $auth = new \Qiniu\Auth($accessKey, $secretKey);
        $config = new \Qiniu\Config();
        $bucketManager = new \Qiniu\Storage\BucketManager($auth, $config);
        list($fileInfo, $err) = $bucketManager->stat($bucket, $key);
        if ($err && $err->message() == "no such file or directory") {
            return false;
        } else {
            return true;
        }
    }
}

if (!function_exists('qiniu_delete')) {
    function qiniu_delete($filePath, $prefix = "")
    {
        require_once APPPATH . 'third_party/bull/Qiniu/Auth.php';
        require_once APPPATH . 'third_party/bull/Qiniu/Config.php';
        require_once APPPATH . 'third_party/bull/Qiniu/Http/Client.php';
        require_once APPPATH . 'third_party/bull/Qiniu/Http/Request.php';
        require_once APPPATH . 'third_party/bull/Qiniu/Http/Response.php';
        require_once APPPATH . 'third_party/bull/Qiniu/Http/Error.php';
        require_once APPPATH . 'third_party/bull/Qiniu/Storage/BucketManager.php';
        require_once APPPATH . 'third_party/bull/Qiniu/Config.php';
        require_once APPPATH . 'third_party/bull/Qiniu/functions.php';


        $oss_setting = get_qiniu_oss_setting();
        $bucket = $oss_setting['bucket'];
        $key = $prefix . basename($filePath);
        $accessKey = $oss_setting['accessKey'];
        $secretKey = $oss_setting['secretKey'];

        $auth = new \Qiniu\Auth($accessKey, $secretKey);
        $config = new \Qiniu\Config();
        $bucketManager = new \Qiniu\Storage\BucketManager($auth, $config);
        $err = $bucketManager->delete($bucket, $key);
        if ($err) {
            print_r($err);
        }


    }
}

if (!function_exists('qiniu_list')) {
    function qiniu_list($prefix = '')
    {
//        $fullfilename = $this->input->post('fullfilename');
//        include FCPATH."assets/qiniu/io.php";
//        include FCPATH."assets/qiniu/rs.php";

        require_once APPPATH . 'third_party/bull/Qiniu/Auth.php';
        require_once APPPATH . 'third_party/bull/Qiniu/Config.php';
        require_once APPPATH . 'third_party/bull/Qiniu/Http/Client.php';
        require_once APPPATH . 'third_party/bull/Qiniu/Http/Request.php';
        require_once APPPATH . 'third_party/bull/Qiniu/Http/Response.php';
        require_once APPPATH . 'third_party/bull/Qiniu/Http/Error.php';
        require_once APPPATH . 'third_party/bull/Qiniu/Storage/BucketManager.php';
        require_once APPPATH . 'third_party/bull/Qiniu/Config.php';
        require_once APPPATH . 'third_party/bull/Qiniu/functions.php';


        $oss_setting = get_qiniu_oss_setting();
        $bucket = $oss_setting['bucket'];
        $accessKey = $oss_setting['accessKey'];
        $secretKey = $oss_setting['secretKey'];

        $auth = new \Qiniu\Auth($accessKey, $secretKey);
        $bucketManager = new \Qiniu\Storage\BucketManager($auth);
        // 要列取文件的公共前缀
        // 上次列举返回的位置标记，作为本次列举的起点信息。
        $marker = '';
        // 本次列举的条目数
        $limit = 1000;
        $delimiter = '';
        // 列举文件
        list($ret, $err) = $bucketManager->listFiles($bucket, $prefix, $marker, $limit, $delimiter);
        if ($err !== null) {
            //echo "\n====> list file err: \n";
            var_dump($err);
            return array();
        } else {
            if (array_key_exists('marker', $ret)) {
                echo "Marker:" . $ret["marker"] . "\n";
            }
            //echo "\nList Iterms====>\n";
            return ($ret["items"]);
        }


    }
}

if (!function_exists('image_fix_orientation')) {
    function image_fix_orientation($path)
    {

        try{
            $image = imagecreatefromjpeg($path);
            $exif = @exif_read_data($path);

            if (!empty($exif['Orientation'])) {
                switch ($exif['Orientation']) {
                    case 3:
                        $image = imagerotate($image, 180, 0);
                        break;
                    case 6:
                        $image = imagerotate($image, -90, 0);
                        break;
                    case 8:
                        $image = imagerotate($image, 90, 0);
                        break;
                }
                imagejpeg($image, $path);
            }
        }catch(Exception $exp){

        }
    }
}