<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="/assets/img/iami-logo-icon.png">
    <title><?= SITE_NAME ?></title>
    <link rel="stylesheet" href="/assets/css/common.css">
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="/assets/css/reg-page.css">
    <!--    <script src="/assets/js/jquery-1.8.3.min.js"></script>-->
    <script src="/assets/js/common.js"></script>
</head>

<body class="<?php echo $this->session->userdata('language_id');?>">
<div class="wrapper">

    <!--pop-->
    <?php require_once(dirname(__FILE__) . "/includes/include.php"); ?>

    <!--header-->
    <?php // $this->load->view('includes/top');?>
    <?php require_once(dirname(__FILE__) . "/includes/top.php"); ?>

    <!--main-->
    <div class="main-content">
        <div id="feedback-cnt" class="container-mid-c">
            <div class="content-area">
                <div class="ps-cnt">
                    <form class="ps-cnt-form form" action="<?php echo base_url(); ?>Feedback/addFeedback" method="POST">

                        <div>
                            <h1 class="color313131"><?= $this->lang->line('feedback') ?></h1>
                            <ul class="txt-feedback txt-left">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                       value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <li>
                                    <label><?= $this->lang->line('subject') ?></label>
                                    <?php $error = isset($data["subject"]) ? "error" : ""; ?>
                                    <input type="text" placeholder=""
                                           value="<?php echo $this->input->post("subject"); ?>"
                                           class="<?php echo $error; ?>" name="subject">
                                    <?php if ($error == "error"): ?>
                                        <span class="error-txt error">＊<?php echo $data["subject"]; ?></span>
                                    <?php endif; ?>
                                </li>
                                <li>
                                    <label><?= $this->lang->line('category') ?></label>
                                    <select name="category" class="error">
                                        <option value="Other"><?= $this->lang->line('other') ?></option>
                                        <option value="Login"><?= $this->lang->line('login') ?></option>
                                        <option value="Index"><?= $this->lang->line('index') ?></option>
                                        <option value="MyPage"><?= $this->lang->line('mypage') ?></option>
                                        <option value="Post"><?= $this->lang->line('post') ?></option>
                                        <option value="Notify"><?= $this->lang->line('notify') ?></option>
                                        <option value="Setting"><?= $this->lang->line('setting') ?></option>
                                    </select>
                                    <!-- <span class="error-txt error">＊請選擇類別</span> -->
                                </li>
                                <li>
                                    <label><?= $this->lang->line('content') ?></label>
                                    <!--                                    <textarea type="text" placeholder="請輸入內容" maxlength="500"  class="error"></textarea>-->
                                    <?php $error = isset($data["content"]) ? "error" : ""; ?>
                                    <textarea maxlength="500" class="<?php echo $error; ?>"
                                              name="content"><?php echo $this->input->post("content"); ?></textarea>
                                    <?php if ($error == "error"): ?>
                                        <span class="error-txt error">＊<?php echo $data["content"]; ?></span>
                                    <?php endif; ?>
                                </li>
                                <li>
                                    <button type="submit"
                                            class="btn-gold-gra"><?= $this->lang->line('submit') ?></button>
                                </li>
                            </ul>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--footer-->
    <div>
        <div class="form-footer">
            <ul class="form-footer-cnt-wrap container-mid-c">
                <li><a href="policy.php"><?= $this->lang->line('member_service_term') ?> </a><a
                            href="policy.php"><?= $this->lang->line('member_privacy_policy') ?></a></li>
                <li>Copyright © 2018 iami. All rights reserved</li>
                <li>
                    <a href="/language/doSwitchLanguage/zh-TW">繁體中文</a>
                    <a href="/language/doSwitchLanguage/zh-CN">简体中文</a>
                    <a href="/language/doSwitchLanguage/english">English</a>
                </li>
            </ul>
        </div>
    </div>
</div>


<!--<script>-->
<!--    $(document).ready(function () {-->
<!--        //手機版下滑search-->
<!--        $('.m-search-area').hide();-->
<!--        $('.search').click(function () {-->
<!--            // $('.m-search-area').slideToggle(300);-->
<!--            $('.m-search-area').slideDown();-->
<!--            return false;-->
<!--        });-->
<!---->
<!--        //編輯貼文-->
<!--        $('.edit-post-drop').hide();-->
<!--        $('.cog-icon-wrap').click(function () {-->
<!--            $(this).children('.edit-post-drop').slideToggle(200);-->
<!--            return false;-->
<!--        });-->
<!--        $(document).click(function () {-->
<!--            $('.m-search-area').hide();-->
<!--            $('.flyout-box').hide();-->
<!--            $('.flyout-box2').hide();-->
<!--            $('.edit-post-drop').hide();-->
<!--        });-->
<!--    });-->
<!--</script>-->

<!--colorbox-->
<script src="/assets/js/colorbox/jquery.colorbox-min.js"></script>
<link rel="stylesheet" href="/assets/js/colorbox/colorbox.css">
<script src="/assets/js/wei_common.js?v=<?= uniqid() ?>"></script>
<div><?php require_once "includes/include-js.php"; ?></div>

<link rel="stylesheet" href="/assets/js/colorbox/colorbox.css">
<script src="/assets/js/colorbox/jquery.colorbox-min.js"></script>

});


<!-- Feedback ok -->
<div class="disable">
    <div class="form" id="feedback-ok">
        <form class="forget-form">
            <div class="cog-icon-wrap">
                <div class="cog-icon"><a class="delete-btn pop-btn"></a></div>
            </div>
            <h2><?= $this->lang->line('submit_success') ?></h2>
            <h5><?= $this->lang->line('thank_suggestion') ?></h5>
        </form>
    </div>
</div>

<!--意見回饋-->
<script>
    //feedback
    $(document).ready(function () {
        <?php if($this->input->get("i") == "1"): ?>
        $.colorbox({
            inline: true,
            width: "auto",
            height: "auto",
            overlayClose: true,
            closeButton: false,
            escKey: false,
            href: '#feedback-ok'
        });
        $(".pop-btn").click(function () {
            $.colorbox.close();
            location.href = "/feedback";
        });

        <?php endif; ?>
    });
</script>
</body>



</html>