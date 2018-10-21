<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="/assets/img/iami-logo-icon.png">
    <title><?= SITE_NAME ?></title>
    <link rel="stylesheet" href="/assets/css/common.css">
    <link rel="stylesheet" href="/assets/css/index-page.css">
    <link rel="stylesheet" href="/assets/css/w3.css">
    <link rel="stylesheet" href="/assets/css/share.css">
    <link rel="stylesheet" href="/assets/css/self-page.css">
    <link rel="stylesheet" href="/assets/css/reg-page.css">
    <link rel="stylesheet" href="/assets/css/hot-post.css">
    <script src="/assets/js/common.js"></script>
    <!--    <script src="/assets/js/jquery-1.8.3.min.js"></script>-->
</head>


<body>
<div class="wrapper">
    <!--pop-->
    <?php require_once(dirname(__FILE__) . "/includes/include.php"); ?>
    <?php echo form_open('', array('class' => 'post-form', 'id' => 'post-form')); ?>
    <input type="hidden" name="member_id" value="<?= $member_id ?>"/>
    <input type="hidden" id="selfid" value="<?= $this->session->userdata("member_id") ?>"/>
    </form>
    <!--header-->
    <?php require_once(dirname(__FILE__) . "/includes/top.php"); ?>


    <!--main-->
    <div id="index-page" class="main-content">
        <div class="container-mid-c">
            <div class="content-area">
                <div class="page-error">
                    <h3>抱歉! 找不到這個頁面...</h3>
                    <p class="page-error-smile"><img src="/assets/img/smile.jpg"></p>
                    <p class="page-error-back">回到<a href="javascript:history.back();">上一頁</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--    <script>-->
<!---->
<!--        //開關通知-->
<!--        $(document).ready(function () {-->
<!--            $('.flyout-box').hide();-->
<!--            $('.invite').click(function () {-->
<!--                $('.flyout-box#notify').hide();-->
<!--                $('.flyout-box#message').hide();-->
<!--                $('.flyout-box#dropdown').hide();-->
<!--                $('.flyout-box#invite').slideDown(500);-->
<!--                return false;-->
<!--            });-->
<!--            $('.notify').click(function () {-->
<!--                $('.flyout-box#invite').hide();-->
<!--                $('.flyout-box#message').hide();-->
<!--                $('.flyout-box#dropdown').hide();-->
<!--                $('.flyout-box#notify').slideDown(500);-->
<!--                return false;-->
<!--            });-->
<!--            $('.message').click(function () {-->
<!--                $('.flyout-box#invite').hide();-->
<!--                $('.flyout-box#notify').hide();-->
<!--                $('.flyout-box#dropdown').hide();-->
<!--                $('.flyout-box#message').slideDown(500);-->
<!--                return false;-->
<!--            });-->
<!--            $('.self-dropdown-img').click(function () { //20180227 modify-->
<!--                $('.flyout-box#invite').hide();-->
<!--                $('.flyout-box#notify').hide();-->
<!--                $('.flyout-box#message').hide();-->
<!--                $('.flyout-box#dropdown').slideDown(500);-->
<!--                //$('.flyout-box#dropdown').slideToggle(500);-->
<!--                return false;-->
<!--            });-->
<!--            return false;-->
<!--        });-->
<!---->
<!--        $(document).click(function () {-->
<!--            $('.flyout-box').hide();-->
<!--            $('.flyout-box2').hide();-->
<!--        });-->
<!---->
<!--        $(document).ready(function () {-->
<!--            $('.m-search-area').hide();-->
<!--            $('.search').click(function () {-->
<!--                $('.m-search-area').slideToggle(500);-->
<!--                return false;-->
<!--            });-->
<!--        });-->
<!--    </script>-->

    <script src="/assets/js/wei_common.js?v=<?= uniqid() ?>"></script>
    <script src="/assets/js/include.js"></script>
    <div><?php require_once "includes/include-js.php"; ?></div>
</body>
</html>