<?php

require_once APPPATH.'third_party'.DIRECTORY_SEPARATOR.'bull'.DIRECTORY_SEPARATOR.'Qiniu'.DIRECTORY_SEPARATOR.'autoload.php';

use Qiniu\Auth;
use Qiniu\Processing\PersistentFop;

class Jeff extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function test()
    {
        $key = get_key();
        $accessKey = $key['AccessKey'];
        $secretKey = $key['SecretKey'];
        $bucket = 'iamiweb-oss-dev';
        $auth = new Auth($accessKey, $secretKey);
        $key = 'IMG_2719.mov';
        $pipeline = 'sdktest';
        $force = false;
        $notifyUrl = 'http://375dec79.ngrok.com/notify.php';
        $config = new \Qiniu\Config();
        $pfop = new PersistentFop($auth, $config);
    }
}
