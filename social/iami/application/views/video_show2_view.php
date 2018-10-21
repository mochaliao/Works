<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="/assets/img/iami-logo-icon.png">
    <title><?= SITE_NAME ?></title>
    <link rel="stylesheet" href="/assets/css/common.css">
    <link rel="stylesheet" href="/assets/css/self-page.css">
    <link rel="stylesheet" href="/assets/css/share.css">
    <link rel="stylesheet" href="/assets/css/video-show.css">
    <link rel="stylesheet" href="/assets/css/reg-page.css">
    <script src="/assets/js/common.js"></script>

    <!-- slider JS files -->
    <script src="/assets/js/jquery-1.8.3.min.js"></script>
    <script src="/assets/js/jquery.royalslider.min.js"></script>
    <link rel="stylesheet" href="/assets/css/royalslider.css">

    <!-- slider stylesheets -->
    <link rel="stylesheet" href="/assets/css/rs-default.css">


</head>

<body class="<?php echo $this->session->userdata('language_id'); ?>">
<div class="wrapper">
    <!--pop-->
    <?php require_once(dirname(__FILE__) . "/includes/include.php"); ?>
    <?php echo form_open('', array('class' => 'post-form', 'id' => 'post-form')); ?>
    <input type="hidden" name="member_id" value="<?= $this->session->userdata('member_id') ?>"/>
    </form>

    <!--header-->
    <?php
    if (isLogin(FALSE)) {
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
                                    <span class="video-txt">' . $this->lang->line('top_video_zone') . '</span>
                                </a>
                            </div>
                        </div>
                        <!--header-middle-->
                        <!--header-right-->
                        <div class="login-btn-bar">
                            <a href="/member/showLogin" class="button login-btn">' . $this->lang->line('member_btn_login') . '</a>
                            <a href="/member/showRegister" class="button login-btn">' . $this->lang->line('member_btn_register') . '</a>
                        </div>
                    </div>
                </div>
            </div>
        ';
    }
    ?>


    <div class="main-content">
        <!-- Banner -->
        <div class="videobanner">
            <img src="/assets/img/banner-5s.jpg" class="videobanner-web">
            <img src="/assets/img/banner-5s-m.jpg" class="videobanner-m">
        </div>


        <!--Inner Content-->
        <div class="video-wall">
            <div class="col-md-12 footerfix">
                <!--
              <div class="item">
                <div class="well">
                   <!--0310 包影片黑色 overlay-->
                <!--<div class="overlay-relative"><!--parent set relative 前一個標籤要加上這個class-->
                <!--    <a href="#"><div class="overlay-arrow"><img src="/assets/img/svg_icon-60.svg"></div><div class="play-overlay"></div></a>
                    <img src="/assets/img/videodemo.png">
                  </div>
                  <!--0310 包影片黑色 overlay end-->
                <!--   <div class="video-title">孫小美，來自美索不達米亞</div>
                 </div>
               </div>
             -->
                <?php foreach ($movies as $movie): ?>
                    <?php //for($i=0;$i<9;$i++):?>
                    <div class="item grid_item">
                        <div class="well">
                            <div class="video-container">
                                <img width="100%" height="auto" style="cursor: pointer"
                                     src="/assets/img/default_movie.jpg" vpath="<?php echo $movie->path; ?>"/>
                            </div>
                            <div class="video-title"><?php echo $movie->title; ?></div>
                        </div>
                    </div>

                    <?php //endfor;?>
                <?php endforeach; ?>
                <!--
              <div class="item">
                <div class="well"> <img src="/assets/img/videodemo.png">
                  <div class="video-title">許唇美，來自澳大利亞</div>
                </div>
              </div>
              <div class="item">
                <div class="well"> <img src="/assets/img/videodemo.png">
                  <div class="video-title">孫小美，來自美索不達米亞</div>
                </div>
              </div>
              <div class="item">
                <div class="well"> <img src="/assets/img/videodemo.png">
                  <div class="video-title">飯冰冰，來自中國湖南</div>
                </div>
              </div>
              <div class="item">
                <div class="well"> <img src="/assets/img/videodemo.png">
                  <div class="video-title">許唇美，來自澳大利亞</div>
                </div>
              </div>
              <div class="item">
                <div class="well"> <img src="/assets/img/videodemo.png">
                  <div class="video-title">孫小美，來自美索不達米亞</div>
                </div>
              </div>
              <div class="item">
                <div class="well"> <img src="/assets/img/videodemo.png">
                  <div class="video-title">飯冰冰，來自中國湖南</div>
                </div>
              </div>
              <div class="item">
                <div class="well"> <img src="/assets/img/videodemo.png">
                  <div class="video-title">許唇美，來自澳大利亞</div>
                </div>
              </div>
              <div class="item">
                <div class="well"> <img src="/assets/img/videodemo.png">
                  <div class="video-title">孫小美，來自美索不達米亞</div>
                </div>
              </div>
              <div class="item">
                <div class="well"> <img src="/assets/img/videodemo.png">
                  <div class="video-title">飯冰冰，來自中國湖南</div>
                </div>
              </div>
              <div class="item">
                <div class="well"> <img src="/assets/img/videodemo.png">
                  <div class="video-title">許唇美，來自澳大利亞</div>
                </div>
              </div>
              -->
            </div>
        </div>

        <div class="clearfix mobilefix">
            <br>
            <br>
        </div>
    </div>

    <!--mobile nav-->
    <?php require_once(dirname(__FILE__) . "/includes/m_nav.php"); ?>

    <!--form-footer-->
    <div class="form-footer">
        <ul class="form-footer-cnt-wrap container-mid-c">
            <li><a href="/member/showService"><?= $this->lang->line('member_service_term') ?> </a><a
                        href="/member/showPrivacy"><?= $this->lang->line('member_privacy_policy') ?></a></li>
            <li>Copyright © 2018 iami. All rights reserved</li>
            <li><a href="/language/doSwitchLanguage/zh-TW">繁體中文 </a><a
                        href="/language/doSwitchLanguage/zh-CN">简体中文</a><a href="/language/doSwitchLanguage/english">English</a>
            </li>
        </ul>
    </div>
</div>

    <!-- tabs & footer end /// -->
    <script id="addJS">
        jQuery(document).ready(function ($) {
            $('#video-gallery').royalSlider({
                arrowsNav: false,
                fadeinLoadedSlide: true,
                controlNavigationSpacing: 0,
                controlNavigation: 'thumbnails',

                thumbs: {
                    autoCenter: false,
                    fitInViewport: true,
                    orientation: 'vertical',
                    spacing: 0,
                    paddingBottom: 0
                },
                keyboardNavEnabled: true,
                imageScaleMode: 'fill',
                imageAlignCenter: true,
                slidesSpacing: 0,
                loop: false,
                loopRewind: true,
                numImagesToPreload: 3,
                video: {
                    autoHideArrows: true,
                    autoHideControlNav: true,
                    autoHideBlocks: true
                },
                autoScaleSlider: false,
                autoScaleSliderWidth: 960,
                autoScaleSliderHeight: 450,

                /* size of all images http://help.dimsemenov.com/kb/royalslider-jquery-plugin-faq/adding-width-and-height-properties-to-images */
                imgWidth: 640,
                imgHeight: 360

            });
        });
    </script>

    <script>
        $(function () {
            $(".video-container>img").click(function () {
                var vpath = $(this).attr("vpath");
                var video = $("<video width=\"100%\" height=\"auto\" src=\"" + vpath + "\" controls autoplay></video>");
                $(this).after(video);
                $(this).remove();

                videoDom = video.get(0);
                videoDom.addEventListener("play", function () {
                    $(".video-container>video").each(function () {
                        if (this != videoDom) {
                            this.pause();
                        }
                    })
                }, false)

                return false;
            })
        })
    </script>

    <script src="/assets/js/wei_common.js?v=<?= uniqid() ?>"></script>
    <script src="/assets/js/include.js"></script>
    <div><?php require_once "includes/include-js.php"; ?></div>

    <script>
        $(document).ready(function () {
            // $('.pgwSlider').pgwSlider();
        });
    </script>
    <!-- /jQuery for 瀑布牆 Masonry -->


</body>
</html>