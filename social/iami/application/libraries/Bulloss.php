<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once (dirname(__FILE__) . "/bull/Qiniu/Config.php");
require_once (dirname(__FILE__) . "/bull/Qiniu/functions.php");
require_once (dirname(__FILE__) . "/bull/Qiniu/Auth.php");
class Bulloss
{
    public function connection(){
        echo "connection";
    }
}
