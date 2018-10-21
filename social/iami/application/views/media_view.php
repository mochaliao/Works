<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="/assets/img/iami-logo-icon.png">
    <title><?= SITE_NAME ?></title>
    <link rel="stylesheet" href="/assets/css/common.css">
    <link rel="stylesheet" href="/assets/css/self-page.css">
    <link rel="stylesheet" href="/assets/css/media-page.css">
    <link rel="stylesheet" href="/assets/css/w3.css">
    <link rel="stylesheet" href="/assets/css/share.css">
    <link rel="stylesheet" href="/assets/css/reg-page.css">
    <script src="/assets/jquery-ui-1.12.1/external/jquery/jquery.js"></script>
    <script src="/assets/js/common.js"></script>
    <?php require_once(dirname(__FILE__) . "/includes/getlanguage.php"); ?>
</head>
<body class="<?php echo $this->session->userdata('language_id');?>">
<div class="wrapper">
    <!--pop-->
    <?php require_once(dirname(__FILE__) . "/includes/include.php"); ?>

    <?php echo form_open('', array('class' => 'media-form', 'id' => 'media-form')); ?>
    <input type="hidden" name="member_id" value="<?= $member_id ?>"/>
    </form>

    <!--header-->
    <?php require_once(dirname(__FILE__) . "/includes/top.php"); ?>

    <!--main-->
    <div id="inner-page" class="main-content">
        <div class="container-mid-c">
            <div>
                <div class="content-area">
                    <div class="inner-header">
                        <div class="inner-header-container">
                            <div class="edit-pic-wrap">
                                <div class="edit-pic-cnt">
                                    <div class="live-icon live-mode disable">
                                        <img src="/assets/img/svg_icon-21.svg">
                                    </div>
                                    <div class="edit-pic">
                                        <a href="/page/info?i=<?=$member_id?>">
                                            <img alt="" src="<?= $avatar ?>" onerror="this.src='/assets/img/self-user-pic.jpg'"">
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!--cover-edit-->
                            <div class="inner-header-cover">
                                <img alt="" src="<?= $banner ?>" onerror="this.src='/assets/img/friend2-cover.jpg'">
                            </div>
                        </div>
                        <div class="edit-container clearfix">
                            <ul>
                                <li class="edit-name">
                                    <ul>
                                        <li><?= $nickname ?></li>
                                        <li><span class="icon-m"><img src="/assets/img/svg_icon-17.svg"></span></li>
                                        <li>
                                            <div class="lev-btn">Lv.<?= $level ?></div>
                                        </li>
                                    </ul>
                                </li>
                                <?php if($is_myself || $isFriend || $isTrace): ?>
                                <li class="edit-cnt">
                                    <ul>
                                        <li class="edit-post">
                                            <a href="info/post<?php echo empty($_SERVER['QUERY_STRING'])?'':'?'.$_SERVER['QUERY_STRING'];?>">
                                                <h5><?=$this->lang->line('post')?></h5>
                                                <h4><?= $postCount ?></h4>
                                            </a>
                                        </li>
                                        <li class="edit-fans">
                                            <a href="info/fans<?php echo empty($_SERVER['QUERY_STRING'])?'':'?'.$_SERVER['QUERY_STRING'];?>">
                                                <h5><?=$this->lang->line('fans')?></h5>
                                                <h4><?= $fansCount ?></h4>
                                            </a>
                                        </li>
                                        <li class="edit-follower">
                                            <a href="info/follower<?php echo empty($_SERVER['QUERY_STRING'])?'':'?'.$_SERVER['QUERY_STRING'];?>">
                                                <h5><?=$this->lang->line('trace')?></h5>
                                                <h4><?= $traceCount ?></h4>
                                            </a>
                                        </li>
                                        <?php if ($is_myself): ?>
                                        <li class="edit-storage">
                                            <a href="info/collection_list<?php echo empty($_SERVER['QUERY_STRING'])?'':'?'.$_SERVER['QUERY_STRING'];?>">
                                                <h5><?=$this->lang->line('collect')?></h5>
                                                <h4><?= $collectCount ?></h4>
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <?php endif;?>
                                <!--edit-profile-->
                                <li class="edit-profile">
                                    <div>
                                        <h5>大家好我是周子瑜!!</h5>
                                        <ul class="cog-list">
                                            <li class="work disable">在普惠世紀擔任吉祥物</li>
                                            <li class="school disable">曾就讀英國劍橋大學</li>
                                            <li class="location">現居開羅市</li>
                                            <li class="country">來自剛果共和國</li>
                                            <li class="relationship">單身</li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php if (!$is_myself && !$isFriend && !$isTrace): ?>
                        <div class="notFd-wrapper">
                            <div class="notFd"><?= $this->lang->line('need_add_friend_1') ?><br><?= $this->lang->line('need_add_friend_2') ?></div>
                        </div>
                    <?php else: ?>
                    <div class="ctn-wrap">
                        <!--媒體、相片-->
                        <div class="media-wrap clearfix">
                            <div class="progress-bar"
                                 style="width:0%;height:5px;background-color:#8361c2;border-radius: 10px;"></div>
                            <br/>
                                <article class="add-btn" <?php  echo $is_myself===true?"":"style=\"visibility:hidden\"";?>>
                                    <label for="media" style="cursor:pointer;">
                                        <a class="media-add-btn"><img src="/assets/img/media-add-btn.png"></a>
                                    </label>
                                    <input type="file" id="media" onchange="fileLength = this.files.length;" name="media" multiple="multiple" class="disable"  accept="image/jpeg, image/gif, image/png,audio/mpeg, video/mpeg,audio/mp4, video/mp4,video/mpeg, video/webm,video/quicktime"/>
                                </article>
                        </div>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>

    <!--mobile nav-->
    <?php require_once(dirname(__FILE__) . "/includes/m_nav.php"); ?>
</div>


<!--<link rel="stylesheet" href="/assets/js/colorbox/colorbox.css">-->
<!--<script src="/assets/js/colorbox/jquery.colorbox-min.js"></script>-->
<script>
    //$(document).ready(function () {
    //    <?php //if (!$is_myself): ?>
    //    $(".del_picture").remove();
    //    <?php //endif; ?>
    //
    //    $(".modify-ps").click(function (event) {
    //        // event.preventDefault();
    //        $.colorbox({
    //            inline: true,
    //            width: "auto",
    //            height: "auto",
    //            overlayClose: true,
    //            closeButton: false,
    //            escKey: false,
    //            href: '#modify-form'
    //            //scalePhotos: true
    //        });
    //    });
    //});
    //$(".pop-btn").click(function () {
    //    $.colorbox.close();
    //});
</script>

<!--<script type="text/javascript">-->
<!--    //Chat Popup-->
<!--    $(function () {-->
<!--        $("#addClass").click(function () {-->
<!--            $('#qnimate').addClass('popup-box-on');-->
<!--        });-->
<!---->
<!--        $("#removeClass").click(function () {-->
<!--            $('#qnimate').removeClass('popup-box-on');-->
<!--        });-->
<!---->
<!---->
<!--    });-->
<!--    $(document).ready(function(){-->
<!--        $(document).click(function(){-->
<!--            $('.flyout-box').hide();-->
<!--            $('.flyout-box2').hide();-->
<!--        });-->
<!--    });-->
<!--</script>-->

<!--<script src="/assets/js/fileupload/vendor/jquery.ui.widget.js"></script>-->
<!--<script src="/assets/js/fileupload/jquery.iframe-transport.js"></script>-->
<!--<script src="/assets/js/fileupload/jquery.fileupload.js"></script>-->
<!--<script src="/assets/js/nailthumb/jquery.nailthumb.1.1.min.js"></script>-->
<!--<link rel="stylesheet" href="/assets/js/nailthumb/jquery.nailthumb.1.1.min.css">-->
<!--<script src="/assets/js/jquery.cookie.js"></script>-->
<script src="/assets/js/wei_common.js?v=<?= uniqid() ?>"></script>
<script src="/assets/js/include.js"></script>
<div><?php require_once "includes/include-js.php"; ?></div>

</body>
</html>