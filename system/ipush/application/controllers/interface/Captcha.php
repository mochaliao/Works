<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Captcha extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->helper('captcha');
    }
    
    // 輸出 Captcha Json
    public function index(){
        $vals = array(
            'pool'        => '23456789ABCDEFGHJKLMNPQRSTUVWXYZabdeghmnpqrty',
            'img_path'    => ROOT . '/temp/captcha/',
            'img_url'     => HTTP_ROOT . '/temp/captcha/',
            'font_path'   => ROOT . '/system/fonts/texb.ttf',
            'word_length' => 4,
            'img_width'	  => '130',
            'img_height'  => 38,
            'expiration'  => 7200,
            'colors'        => array(
                'background' => array(10, 10, 10),
                'border'     => array(255, 255, 255),
                'text'       => array(240, 240, 240),
                'grid'       => array(100, 100, 100)
            )
        );

        echo json_encode(create_captcha($vals));
    }
    
}

?>