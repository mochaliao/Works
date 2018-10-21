<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comm extends CI_Model{

    public function __construct(){
        parent::__construct();
        
        // 定義網站路徑
        $this->path_define();
        //定義網站設定參數
        $this->conf_define();
        // 定義當前語系
        $this->lang_define();
        // 定義 CSRF 基本常數
        $this->security_define();
        // 定義登入 Session 資訊
        $this->login_define();
    }
    
    // 定義網站路徑
    public function path_define(){
        // 定義網頁協定
        define('PROTOCOL', is_https() ? 'https' : 'http');
        // 定義實體根目錄
        define('ROOT', dirname(dirname(dirname(__FILE__))));
        // 應用程式資料夾 ( 如果 CI 資料夾非頂端資料夾的話, 才會有值 )
        define('APP_FOLDER', substr(str_replace($_SERVER['DOCUMENT_ROOT'], '', ROOT), 1));
        // 定義網站根目錄
        define('HTTP_ROOT', (PROTOCOL . '://' . $_SERVER['HTTP_HOST']) . (!empty(APP_FOLDER) ? '/' . APP_FOLDER : ''));
        // 定義當前 CI Controller
        define('CI_CONTROLLER', $this->router->class);
        // 定義當前 CI Method
        define('CI_METHOD', $this->router->method);
        // 定義上傳路徑實體目錄
        define('UPLOAD_ROOT', ROOT . '/upload');
        // 定義上傳路徑 HTTP 目錄
        define('HTTP_UPLOAD_ROOT', HTTP_ROOT . '/upload');
    }
    
    // 定義網站設定參數
    public function conf_define(){
        define('SITE_NAME', 'I-Push System');
    }
    
    // 定義當前語系
    public function lang_define(){
        if(!isset($_SESSION['lang'])) $_SESSION['lang'] = 'zh-tw';
        define('LANG', $_SESSION['lang']);
    }
    
    // 定義 CSRF 基本常數
    public function security_define(){
        define('CSRF_NAME', $this->security->get_csrf_token_name());
        define('CSRF_HASH', $this->security->get_csrf_hash());
    }
    
    // 定義登入 Session 資訊
    public function login_define($data = null, $url = null){
        // 定義前台 Session 結構
        if($_SESSION['logged'] === null){
            $_SESSION = array(
                'lang'   => $_SESSION['lang'],
                'logged' => false
            );
        }
        // 定義後台 Session 結構
        if($_SESSION['admin'] === null){
            $_SESSION['admin'] = array(
                'logged' => false
            );
        }
        if(!stristr(current_url(), '/admin')){ // 前台 ----------------------------------------
            if(!$_SESSION['logged']){ // 未登入處理轉向
                $white = array( // 前台不需要登入也可以訪問的白名單頁面
                    'main/login',
                    'main/lang',
                    'captcha/index',
                    'member/get_pwd',
                    'member/reset_pwd',
                    'member/send_chkcode',
                    'cli/link',
                    'cli/block'
                );
                if(!in_array($this->router->class . '/' . $this->router->method, $white)){
                    @header('Location:' . HTTP_ROOT . '/main/login');
                }
            }else{ // 已登入, 寫入 Session 資料
                $url = $url === null ? HTTP_ROOT . '/main' : $url;
                if($data != null){
                    $_SESSION['member_id'] = $data['id'];
                    $_SESSION['account']   = $data['account'];
                    $_SESSION['name']      = $data['name'];
                    $_SESSION['email']     = $data['email'];
                    @header('Location:' . $url);
                }
            }
        }else{ // 後台 ------------------------------------------------------------------------
            if(!$_SESSION['admin']['logged']){ // 未登入處理轉向
                $white = array( // 後台不需要登入也可以訪問的白名單頁面
                    'main/login',
                    'main/lang',
                    'captcha/index'
                );
                if(!in_array($this->router->class . '/' . $this->router->method, $white)){
                    @header('Location:' . HTTP_ROOT . '/admin/main/login');
                }
            }else{ // 已登入, 寫入 Session 資料
                if($data != null){
                    $_SESSION['admin']['admin_id']   = $data['id'];
                    $_SESSION['admin']['name']       = $data['name'];
                    $_SESSION['admin']['account']    = $data['account'];
                    @header('Location:' . HTTP_ROOT . '/admin/main');
                }
            }
        }
    }
    
}

?>