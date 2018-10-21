<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="/assets/img/iami-logo-icon.png">
    <title><?=SITE_NAME?></title>
    <link rel="stylesheet" href="/assets/css/common.css">
    <link rel="stylesheet" href="/assets/css/self-page.css">
    <link rel="stylesheet" href="/assets/css/w3.css">
    <link rel="stylesheet" href="/assets/css/message.css">
    <link rel="stylesheet" href="/assets/css/share.css">
    <link rel="stylesheet" href="/assets/css/policy.css">
    <link rel="stylesheet" href="/assets/css/reg-page.css">
    <script src="/assets/js/common.js"></script>
    <script src="/assets/js/8dbb4cc43e.js"></script>
<!--    <script src="/assets/js/jquery-3.3.1.min.js"></script>-->
    <script src="/assets/jquery-ui-1.12.1/external/jquery/jquery.js"></script>
    <script src="/assets/bootstrap-3.3.4/dist/js/bootstrap.min.js"></script>
<!--    <link rel="stylesheet" href="/assets/js/colorbox/colorbox.css">-->
<!--    <script src="/assets/js/colorbox/jquery.colorbox-min.js"></script>-->
</head>
<style>
    .login-btn,.login-btn:hover{
        margin: 7px 0 0 10px;
    }
</style>
<body class="<?php echo $this->session->userdata('language_id');?>">
<?php require_once(dirname(__FILE__) . "/includes/include.php");?>
<?php
    if(isLogin(FALSE)) {
        require_once(dirname(__FILE__) . "/includes/top.php");
        ?>

        <?php echo form_open('', array('class' => 'post-form', 'id' => 'post-form')); ?>
<input type="hidden" name="member_id" value="<?= $this->session->userdata("member_id") ?>>"/>
<input type="hidden" id="selfid" value="<?= $this->session->userdata("member_id") ?>"/>
</form>
        <?php
    } else {
        echo '
            <!--header-->
            <div class="header">
               <div class="dec-line"></div>
                <div class="container-wide">                    
                    <div class="header-container clearfix">
                        <!--header-left-->
                        <div class="header-left">
                            <div class="header-logo">
                                <a href="/page/main"><img alt="" src="/assets/img/iami-logo-header.png"></a>
                            </div>
                            <div class="video-ac-area">
                                <a href="/page/videoshow">
                                    <span class="video-icon">
                                        <img src="/assets/img/5s-video-icon.svg">
                                    </span>
                                    <span class="video-txt">'.$this->lang->line('top_video_zone').'</span>
                                </a>
                            </div>
                        </div>
                        <!--header-middle-->
                        <!--header-right-->
                        <div class="login-btn-bar">
                            <a href="/member/showLogin" class="button login-btn">'.$this->lang->line('member_btn_login').'</a>
                            <a href="/member/showRegister" class="button login-btn">'.$this->lang->line('member_btn_register').'</a>
                        </div>
                    </div>
                </div>
            </div>
        ';
    }
?>

<!--Main Content-->
<div class="w3-container policy-wrapper-outer">
    <div class="w3-bar w3-mid-grey">
        <button id="btn-privacy" class="w3-bar-item w3-button tablink w3-purple" onclick="openTab(event, 'privacy')"><?=$this->lang->line('member_privacy_policy')?></button>
        <button id="btn-service" class="w3-bar-item w3-button tablink" onclick="openTab(event, 'service')"><?=$this->lang->line('member_service_term')?></button>
    </div>
    <div id="privacy" class="w3-container w3-border tab bg-white privacy-padding-30">
        <div class="policytxt">
            <?=$this->lang->line('member_privacy_policy_text')?>
        </div>
    </div>
    <div id="service" class="w3-container w3-border tab bg-white" style="display:none">
        <div class="service-text">
            <?=$this->lang->line('member_service_term_text')?>
        </div>
    </div>
</div>

<!--mobile nav-->
<?php require_once(dirname(__FILE__) . "/includes/m_nav.php"); ?>


<!--form-footer-->
<div class="form-footer">
    <ul class="form-footer-cnt-wrap container-mid-c">
        <li>
            <a href="/member/showService"><?=$this->lang->line('member_service_term')?> </a>
            <a href="/member/showPrivacy"><?=$this->lang->line('member_privacy_policy')?></a>
        </li>
        <li>Copyright © 2018 iami. All rights reserved</li>
        <li>
            <a href="/language/doSwitchLanguage/zh-TW">繁體中文 </a>
            <a href="/language/doSwitchLanguage/zh-CN">简体中文</a>
            <a href="/language/doSwitchLanguage/english">English</a>
        </li>
    </ul>
</div>

<!--<script>-->
<!--    //開關通知-->
<!--    $(document).ready(function() {-->
<!--        $('.flyout-box').hide();-->
<!--        $('.invite').click(function() {-->
<!--            $('.flyout-box#notify').hide();-->
<!--            $('.flyout-box#message').hide();-->
<!--            $('.flyout-box#dropdown').hide();-->
<!--            $('.flyout-box#invite').show();-->
<!--            return false;-->
<!--        });-->
<!--        $('.notify').click(function() {-->
<!--            $('.flyout-box#invite').hide();-->
<!--            $('.flyout-box#message').hide();-->
<!--            $('.flyout-box#dropdown').hide();-->
<!--            $('.flyout-box#notify').show();-->
<!--            return false;-->
<!--        });-->
<!--        $('.message').click(function() {-->
<!--            $('.flyout-box#invite').hide();-->
<!--            $('.flyout-box#notify').hide();-->
<!--            $('.flyout-box#dropdown').hide();-->
<!--            $('.flyout-box#message').show();-->
<!--            return false;-->
<!--        });-->
<!--        $('.self-dropdown-cnt').click(function() {-->
<!--            $('.flyout-box#invite').hide();-->
<!--            $('.flyout-box#notify').hide();-->
<!--            $('.flyout-box#message').hide();-->
<!--            $('.flyout-box#dropdown').show();-->
<!--            return false;-->
<!--        });-->
<!--        return false;-->
<!--    });-->
<!---->
<!--    $(document).click(function() {-->
<!--        $('.flyout-box').hide();-->
<!--        $('.flyout-box2').hide();-->
<!--    });-->
<!---->
<!--</script>-->

<!--Tabs-->
<script>
    function openTab(evt, tabName) {
        var i, x, tablinks;
        x = document.getElementsByClassName("tab");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < x.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" w3-purple", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " w3-purple";
    }

    $(document).ready(function() {
        <?php
        if (strtolower($show_type) == 'privacy'){
            echo "openTab(event, 'privacy');";
            echo "$('#btn-privacy').addClass('w3-purple');";
        }else if (strtolower($show_type) == 'service'){
            echo "openTab(event, 'service');";
            echo "$('#btn-service').addClass('w3-purple');";
        }
        ?>
    });
</script>

</body>
<script src="/assets/js/wei_common.js?v=<?= uniqid() ?>"></script>
<script src="/assets/js/include.js"></script>
<div><?php require_once "includes/include-js.php"; ?></div>
</html>