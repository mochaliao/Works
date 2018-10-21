<?php $this->form_validation->set_error_delimiters('', ''); ?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="/assets/img/iami-logo-icon.png">
    <title><?= $this->lang->line('member_login_title') . '/' . $this->lang->line('member_register_title') ?></title>
    <link rel="stylesheet" href="/assets/css/common.css">
    <link rel="stylesheet" href="/assets/css/reg-page.css">

    <!--slider captcha-->
    <link rel="stylesheet" href="/assets/css/slide-to-submit.css">
    <!--slider captcha end-->
    <script src="/assets/js/beforecommon.js"></script>
    <script src="/assets/js/common.js"></script>
    <script>
        var nicknameError = "<?=$this->lang->line('member_nickname_too_long')?>";
    </script>
    <style>
        .ui-widget-header {
            color: #000000;
        }

        .error-txt {
            visibility: visible;
        }

        /* transform自行做兼容处理 */
        input::-webkit-input-placeholder {
            font-size: 15px;
        }

        /* FireFox浏览器 可以自动垂直居中 */
        input::-moz-placeholder {
            font-size: 15px;
        }
    </style>
</head>
<body class="<?php echo $this->session->userdata('language_id'); ?>">



<div class="wrapper">
    <!--pop視窗 forget-form-->
    <div class="disable">
        <div class="form" id="forget-form">
            <form action="/member/doForget" class="forget-form" method="get">
                <div class="cog-icon-wrap">
                    <div class="cog-icon"><a class="pop-btn delete-btn"></a></div>
                </div>
                <h2><a class="colorf8b551"><?= $this->lang->line('member_forget_password') ?></a></h2>
                <h7><?= $this->lang->line('member_forget_password_note') ?></h7>
                <ul>
                    <li>
                        <input type="text" name="forget_email"
                               placeholder="<?= $this->lang->line('member_field_email') ?>">
                        <span class="error-txt">&nbsp;<?= isset($forget_error) ? $forget_error : "" ?></span>
                    </li>
                    <li>
                        <button type="submit"
                                class="btn-gold-gra"><?= $this->lang->line('member_btn_submit') ?></button>
                    </li>
                </ul>
            </form>
        </div>
    </div>

    <!--pop視窗 forget-send-form-->
    <div class="disable">
        <div class="form" id="forget-send-form">
            <form class="forget-form">
                <div class="cog-icon-wrap">
                    <div class="cog-icon"><a class="pop-btn delete-btn"></a></div>
                </div>
                <h2><?= $this->lang->line('member_password_send') ?></h2>
                <h5><?= $this->lang->line('member_password_send_text') ?></h5>
                <ul>
                    <li>
                        <button class="btn-gold-gra"
                                id="forget-send-btn"><?= $this->lang->line('member_btn_confirm') ?></button>
                    </li>
                </ul>
            </form>
        </div>
    </div>

    <!--註冊成功-->
    <div class="disable">
        <div class="form" id="register-success-form">
            <form class="forget-form">
                <div class="cog-icon-wrap">
                    <div class="cog-icon"><a class="pop-btn delete-btn"></a></div>
                </div>
                <h2><?= $this->lang->line('register_success') ?></h2>

                <h5><?= $this->lang->line('register_success_detail') ?></h5>

            </form>
        </div>
    </div>

    <!--header-->
    <div class="form-header">
        <div class="form-gra"></div>
        <div class="form-header-icon"><img src="/assets/img/login-header-logo.png"></div>
    </div>
    <!-- 加偉臨時隱藏打鉤的功能開始 -->
    <style>
        .check-mark {
            display:none;
        }
        /*patty 修改*/
        .tip-mark{
	        margin-right: 10px;
        }
        .add-tip{
           /*width:103% !important;*/
        }
    </style>
    <!-- 加偉臨時隱藏打鉤的功能結束 -->

    <!--form-area-->
    <div class="form-cnt-wrap">
        <div class="container-mid-c">
            <div class="form-col-wrap">
                <div class="form-left-col">
                    <div class="form-logo"><img src="/assets/img/iami-logo-login.svg"></div>
                </div>
                <div class="form-right-col">
                    <div class="form">
                        <!--login-->
                        <?php echo form_open('/member/doLogin', array('class' => 'login-form', 'id' => 'login-form')); ?>
                        <h1><?= $this->lang->line('member_login_title') ?><span class="login-logo"><img
                                        src="/assets/img/login-logo.png"></span></h1>
                        <h3 style="width:100%;text-align:center;color:red;"><?= isset($login_success) ? $login_success : ""; ?></h3>
                        <ul>
                            <li>
                                <input type="text" name="login_email"
                                       class="<?= empty(form_error('login_email')) ? '' : 'error' ?>"
                                       value="<?= set_value('login_email'); ?>"
                                       placeholder="<?= $this->lang->line('member_field_email') ?>" required>
                                <span class="error-txt">&nbsp;<?= form_error('login_email'); ?></span>
                            </li>

                            <li>
                                <input type="password" name="login_password"
                                       class="<?= empty(form_error('login_password')) ? '' : 'error' ?>"
                                       value="<?= set_value('login_password'); ?>"
                                       placeholder="<?= $this->lang->line('member_field_password_login') ?>">
                                <span class="error-txt">&nbsp;<?= form_error('login_password'); ?></span>
                            </li>


                            <!--                                <li>-->
                            <!--                                    <input type="text" name="captcha"  placeholder="驗證碼" required>-->
                            <!--                                </li>-->
                            <!--                                <input type="hidden" name="captcha2" value="-->
                            <?php //echo $_SESSION['captcha']['code'];?><!--">-->
                            <!--                                <p>-->
                            <!--                                    --><?php
                            //                                    print_r($_SESSION['captcha']['code']);
                            //                                    echo '<img src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA code">';
                            ////                                      echo $_SESSION['captcha']['code'];
                            //                                    ?>
                            <!---->
                            <!--                                </p>-->
                            <!--                                <br />-->
                            <li>
                            <li class="input-checkbox">
                                <label class="form-checkbox">
                                    <input type="checkbox" name="remember_me">
                                    <span></span>
                                </label>
                                <span><?= $this->lang->line('member_remember_me') ?></span>
                                <a class="forget-link"><span><?= $this->lang->line('member_forget_password') ?>?</span></a>
                            </li>
                            <!--                                    <div class="slide-submit">-->
                            <!--                                        <div class="slide-submit-text">滑動去解鎖</div>-->
                            <!--                                        <div class="slide-submit-thumb">»</div>-->
                            <!--                                    </div>-->
                            <!--                                    <br />-->
                            </li>
                            <li>
                                <button type="submit" class="btn-gold-gra">
                                    <a href="#" onclick="document.getElementById('login-form').submit();"
                                       class="color313131"><?= $this->lang->line('member_btn_login') ?></a>
                                </button>
                            </li>
                            <li class="togo"><a href="/member/showRegister"
                                                class="togo-btn"><?= $this->lang->line('member_btn_register') ?></a>
                            </li>
                        </ul>
                        </form>
                        <!--register-->
                        <?php echo form_open('/member/doRegister', array('class' => 'register-form', 'id' => 'register-form', 'onsubmit' => 'return validate();')); ?>
                        <span class="backto-login togo h7"><a
                                    href="/member/showLogin"><?= $this->lang->line('member_login_title') ?></a></span>
                        <h2><?= $this->lang->line('member_register_title') ?></h2>
                        <ul>
                            <li>
                                <!--0514 tooltip-->
                                <input type="text" class="add-tip" name="email"
                                       class="<?= empty(form_error('email')) ? '' : 'error' ?>"
                                       value="<?= set_value('email'); ?>"
                                       placeholder="<?= $this->lang->line('member_field_email') ?>">
                                <span class="error-txt">&nbsp<?= form_error('email'); ?></span>
                                <div class="form-tooltip-wrap">
                                    <div class="form-tooltip">
                                        <a class="tip-mark">
                                            <span class="tooltip-p-text">請填寫可收驗證信的信箱，切勿隨意填寫</span>
                                        </a>
                                    </div>
                                    <span <?php echo isset($errorTag)&&empty(form_error('email')) ?"style=\"background-image: url('../assets/img/svg_icon-54.svg');\"":"" ; ?> class="check-mark"></span>
                                </div>
                                <!---->
                            </li>

                            <li>
                                <!--0514 tooltip-->
                                <input type="password" class="add-tip" name="password"
                                       class="<?= empty(form_error('password')) ? '' : 'error' ?>"
                                       value="<?= set_value('password'); ?>"
                                       placeholder="<?= $this->lang->line('member_field_password') ?>">
                                <span class="error-txt">&nbsp;<?= form_error('password'); ?></span>
                                <div class="form-tooltip-wrap">
                                    <div class="form-tooltip">
                                        <a class="tip-mark">
                                            <span class="tooltip-p-text">請填寫6~12位數密碼、需含英文大小寫、數字</span>
                                        </a>
                                    </div>
                                    <span <?php echo isset($errorTag)&&empty(form_error('password')) ?"style=\"background-image: url('../assets/img/svg_icon-54.svg');\"":"" ; ?> class="check-mark"></span>
                                </div>
                                <!---->
                            </li>

                            <li>
                                <!--0514 tooltip-->
                                <input type="password" class="add-tip" name="repassword"
                                       class="<?= empty(form_error('repassword')) ? '' : 'error' ?>"
                                       value="<?= set_value('repassword'); ?>"
                                       placeholder="<?= $this->lang->line('member_field_repassword') ?>">
                                <span class="error-txt">&nbsp;<?= form_error('repassword'); ?></span>
                                <div class="form-tooltip-wrap">
                                    <div class="form-tooltip">
                                        <a class="tip-mark">
                                            <span class="tooltip-p-text">請再次確認您的密碼</span>
                                        </a>
                                    </div>
                                    <span <?php echo isset($errorTag)&&empty(form_error('repassword')) ?"style=\"background-image: url('../assets/img/svg_icon-54.svg');\"":"" ; ?> class="check-mark"></span>
                                </div>
                                <!---->
                            </li>

                            <li>
                                <!--0514 tooltip-->
                                <input type="text" class="add-tip" name="nickname"
                                       class="<?= empty(form_error('nickname')) ? '' : 'error' ?>"
                                       value="<?= set_value('nickname'); ?>"
                                       placeholder="<?= $this->lang->line('member_field_nickname') ?>">
                                <span class="error-txt">&nbsp;<?= form_error('nickname'); ?></span>
                                <div class="form-tooltip-wrap">
                                    <div class="form-tooltip">
                                        <a class="tip-mark">
                                            <span class="tooltip-p-text">暱稱的長度為10個中文字(20個字元)，不能包含不雅文字，修正後七天內不能再修正</span>
                                        </a>
                                    </div>
                                    <span <?php echo isset($errorTag)&&empty(form_error('nickname')) ?"style=\"background-image: url('../assets/img/svg_icon-54.svg');\"":"" ; ?> class="check-mark"></span>
                                </div>
                                <!---->
                            </li>

                            <li class="input-radio reg-gender"><?= $this->lang->line('member_field_gender') ?>
                                <input type="radio" name="gender"
                                       value="M" <?= (strtoupper(set_value('gender')) == 'M' || strtoupper(set_value('gender')) == '' ? 'checked' : '') ?>>
                                <label><?= $this->lang->line('member_field_gender_male') ?></label>
                                <input type="radio" name="gender"
                                       value="F" <?= (strtoupper(set_value('gender')) == 'F' ? 'checked' : '') ?>>
                                <label><?= $this->lang->line('member_field_gender_female') ?></label>
                            </li>

                            <li>
                                <input type="text" id="birth" name="birth"
                                       class="<?= empty(form_error('birth')) ? '' : 'error' ?>"
                                       value="<?= set_value('birth'); ?>"
                                       placeholder="<?= $this->lang->line('member_field_birth') ?>" readonly="true">
                                <span class="error-txt">&nbsp;<?= form_error('birth'); ?></span>
                            </li>

                            <li>
                                <!--0514 tooltip-->
                                <input type="text" class="add-tip" name="mobile"
                                       class="<?= empty(form_error('mobile')) ? '' : 'error' ?>"
                                       value="<?= set_value('mobile'); ?>"
                                       placeholder="<?= $this->lang->line('member_field_mobile') ?>">
                                <span class="error-txt">&nbsp;<?= form_error('mobile'); ?></span>
                                <div class="form-tooltip-wrap">
                                    <div class="form-tooltip">
                                        <a class="tip-mark">
                                            <span class="tooltip-p-text">請填寫您的手機號碼</span>
                                        </a>
                                    </div>
                                    <span <?php echo isset($errorTag)&&empty(form_error('mobile')) ?"style=\"background-image: url('../assets/img/svg_icon-54.svg');\"":"" ; ?> class="check-mark"></span>
                                </div>
                                <!---->
                            </li>

                            <li>
                                <button type="submit" class="btn-gold-gra">
                                    <a href="#" onclick="$(this).parent().click();"
                                       class="color313131"><?= $this->lang->line('member_btn_register') ?></a>
                                </button>
                            </li>
                        </ul>
                        <h7><?= $this->lang->line('member_register_note') ?></h7>
                        </form>
                    </div>

                    <div class="m-language">
                        <a href="/language/doSwitchLanguage/zh-TW">繁體中文 </a><a href="/language/doSwitchLanguage/zh-CN">简体中文</a><a
                                href="/language/doSwitchLanguage/english">English</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php // 加偉加入的 style 開始 ?>
    <style>
        .m-language {
            text-align: center;
            margin-top: 10px;
            display: none;
        }

        .m-language a {
            padding: 5px 10px;
            color: #313131;
        }

        @media screen and (max-width: 768px) {
            .m-language {
                display: block;
            }
        }
    </style>
    <?php // 加偉加入的 style 結束?>

    <!--5s video-->
    <div class="form-video-wrap">
        <div class="container-mid-c clearfix">
            <!--video1-->
            <?php foreach ($movies as $movie): ?>
                <article>
                    <div class="form-video">
                        <?= is_mobile() ? '' : '<video width="100%" src="' . $movie->path . '" controls></video>' ?>
                    </div>
                    <h5><?php echo $movie->title; ?></h5>
                </article>
            <?php endforeach; ?>
            <!--video2-->
            <!--<article>
                <div class="form-video">
                    <?= is_mobile() ? '' : '<video width="100%" src="/assets/img/v2.mp4" controls></video>' ?>
                </div>
                <h5>飯冰冰，來自中國湖南</h5>
            </article>
            <!--video3-->
            <!--<article>
                <div class="form-video">
                    <?= is_mobile() ? '' : '<video width="100%" src="/assets/img/v3.mp4" controls></video>' ?>
                </div>
                <h5>許唇美，來自澳大利亞</h5>
            </article>
            <!--video4-->
            <!--<article>
                <div class="form-video">
                    <?= is_mobile() ? '' : '<video width="100%" src="/assets/img/v4.mp4" controls></video>' ?>
                </div>
                <h5>謝震廷，來自阿布達比</h5>
            </article>
            <!--video1-->
            <!-- <article>
                <div class="form-video">
                    <?= is_mobile() ? '' : '<video width="100%" src="/assets/img/v1.mp4" controls></video>' ?>
                </div>
                <h5>孫小美，來自美索不達米亞</h5>
            </article>
            <!--video2-->
            <!--<article>
                <div class="form-video">
                    <?= is_mobile() ? '' : '<video width="100%" src="/assets/img/v2.mp4" controls></video>' ?>
                </div>
                <h5>飯冰冰，來自中國湖南</h5>
            </article>
            <!--video3-->
            <!--<article>
                <div class="form-video">
                    <?= is_mobile() ? '' : '<video width="100%" src="/assets/img/v3.mp4" controls></video>' ?>
                </div>
                <h5>許唇美，來自澳大利亞</h5>
            </article>
            <!--video4-->
            <!-- <article>
                <div class="form-video">
                    <?= is_mobile() ? '' : '<video width="100%" src="/assets/img/v4.mp4" controls></video>' ?>
                </div>
                <h5>謝震廷，來自阿布達比</h5>
            </article>
            <!--video1-->
            <!-- <article>
                <div class="form-video">
                    <?= is_mobile() ? '' : '<video width="100%" src="/assets/img/v1.mp4" controls></video>' ?>
                </div>
                <h5>孫小美，來自美索不達米亞</h5>
            </article>
            <!--video2-->
            <!--<article>
                <div class="form-video">
                    <?= is_mobile() ? '' : '<video width="100%" src="/assets/img/v2.mp4" controls></video>' ?>
                </div>
                <h5>飯冰冰，來自中國湖南</h5>
            </article>
            <!--video3-->
            <!-- <article>
                <div class="form-video">
                    <?= is_mobile() ? '' : '<video width="100%" src="/assets/img/v3.mp4" controls></video>' ?>
                </div>
                <h5>許唇美，來自澳大利亞</h5>
            </article>
          <!--video4-->
            <!--<article>
                <div class="form-video">
                    <?= is_mobile() ? '' : '<video width="100%" src="/assets/img/v4.mp4" controls></video>' ?>
                </div>
                <h5>謝震廷，來自阿布達比</h5>
            </article>-->
        </div>
    </div>

    <!--form-footer-->
    <div class="form-footer">
        <ul class="form-footer-cnt-wrap container-mid-c">
            <li><a href="/member/showService"><?= $this->lang->line('member_service_term') ?> </a><a
                        href="/member/showPrivacy"><?= $this->lang->line('member_privacy_policy') ?></a></li>
            <li>Copyright © 2018 iami. All rights reserved</li>
            <li><a href="/language/doSwitchLanguage/zh-TW">繁體中文 </a><a
                        href="/language/doSwitchLanguage/zh-CN">简体中文</a><a
                        href="/language/doSwitchLanguage/english">English</a></li>
        </ul>
    </div>
</div>

<script src="/assets/jquery-ui-1.12.1/external/jquery/jquery.js"></script>
<script src="/assets/jquery-ui-1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="/assets/jquery-ui-1.12.1/jquery-ui.css"/>

<script>
    // $('.togo a').click(function(){
    //    $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    // });
</script>

<link rel="stylesheet" href="/assets/js/colorbox/colorbox.css">
<script src="/assets/js/colorbox/jquery.colorbox-min.js"></script>
<?php
//載入JQueryUI的DatePicker語言檔
if ($this->session->userdata('language_id') != 'english' && !empty($this->session->userdata('language_id'))) {
    echo '<script src="/assets/jquery-ui-1.12.1/i18n/datepicker-' . $this->session->userdata('language_id') . '.js"></script>';
}
?>
<script>
    function gblen(str) {
        var len = 0;
        for (var i = 0; i < str.length; i++) {
            if (str.charCodeAt(i) > 127 || str.charCodeAt(i) == 94) {
                len += 2;
            } else {
                len++;
            }
        }
        return len;
    }

    function validate() {
        var len = gblen($("input[name=nickname]").val());
        if (len > 10) {
            $("input[name=nickname]").siblings(".error-txt").html(nicknameError);
            return false;
        }
    }

    function show_forget_send() {
        $.colorbox({
            inline: true,
            width: "auto",
            height: "auto",
            overlayClose: true,
            closeButton: false,
            escKey: false,
            href: "#forget-send-form"
        });
    }

    $(document).ready(function () {
        $(".forget-link").click(function (event) {
            $.colorbox({
                inline: true,
                width: "auto",
                height: "auto",
                overlayClose: true,
                closeButton: false,
                escKey: false,
                href: '#forget-form'
            });
        });

        $("#forget-send-btn").click(function () {
            parent.$.fn.colorbox.close();
            return false;
        });

        $('#birth').datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            changeMonth: true,
            yearRange: '-100:+0'
        });
        <?php if(isset($show_type) && strtolower($show_type) == 'register'):?>
        $(":text:not('#birth'),:password","#register-form").blur(function(){
            var self=$(this);
            var name=self.attr("name");
            var parm  = {};
            parm[name]=self.val();

            if(name=="repassword"){
                parm["password"]=$(":password:first","#register-form").val();
            }

            ajaxPost(
                "/member/validateRegister",
                parm,
                function (data){
                    if(data.status=="success"){
                        self.siblings(".error-txt").html("");
                        self.parent().find(".check-mark").css("background-image","url(../assets/img/svg_icon-54.svg)");
                    }else{
                        self.siblings(".error-txt").html("&nbsp;"+data.message);
                        self.parent().find(".check-mark").css("background-image","url(../assets/img/svg_icon-54-dis.svg)");
                    }
                }
            )
        })
        <?php endif;?>
        <?php
        if (isset($show_type)) {
            //顯示註冊
            if (strtolower($show_type) == 'register') {
                echo '$("#register-form").show();';
                echo '$("#login-form").hide();';
            } //顯示登入
            else if (strtolower($show_type) == 'login') {
                echo '$("#login-form").show();';
                echo '$("#register-form").hide();';
            } //顯示忘記密碼
            else if (strtolower($show_type) == 'forget') {
                // echo '$(".forget-link").click();';
                echo "$.colorbox({
                            inline: true,
                            width: 'auto',
                            height: 'auto',
                            overlayClose: true,
                            closeButton: false,
                            escKey:false,
                            href: '#forget-form'
                        });";
            } ////顯示忘記密碼已傳送
            else if (strtolower($show_type) == 'forgetsend') {
                echo '
                        $.colorbox({
                            inline: true,
                            width: "auto",
                            height: "auto",
                            overlayClose: true,
                            closeButton: false,
                            escKey:false,
                            href: "#forget-send-form"
                        });
                    ';
            } else if (strtolower($show_type) == 'registersuccess') {
                echo '
                        $.colorbox({
                            inline: true,
                            width: "auto",
                            height: "auto",
                            overlayClose: true,
                            closeButton: false,
                            escKey:false,
                            href: "#register-success-form"
                        });
                    ';
            }
        }
        ?>
    });

    $(".pop-btn").click(function () {
        $.colorbox.close();
    });

    //tool-tip
    if($("a.tip-mark").length > 0){
        $("a.tip-mark").click(function () {
            $(this).toggleClass('active');
             return false;
        });
    }

    $(document).click(function () {
        $('a.tip-mark.active').removeClass('active');
    });
</script>

<!--slider captcha-->
<script src="/assets/js/slide-to-submit.js"></script>
<script>
    $('.slide-submit').slideToSubmit({
        submitDelay: 1000,
        successText: '解鎖成功!!'
    });

    //Demo only
    // $("#login-form").submit(function(e) {
    //     e.preventDefault();
    //     $('#login-form').slideUp();
    // });
</script>
<!--slider captcha end-->


</body>
</html>