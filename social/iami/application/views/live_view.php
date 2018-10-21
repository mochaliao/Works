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
    <link rel="stylesheet" href="/assets/css/live-show.css">
    <link rel="stylesheet" href="/assets/css/glightbox.css">
    <!--    <script src="/assets/js/jquery-1.8.3.min.js"></script>-->
    <script src="/assets/js/common.js"></script>
    <script src="/assets/js/jquery.media.js"></script>
    <script src="/assets/js/chplayer.js"></script>
</head>
<body class="<?php echo $this->session->userdata('language_id'); ?>">
<div class="wrapper">
    <?php require_once(dirname(__FILE__) . "/includes/getlanguage.php"); ?>
    <?php $is_myself = $member['is_myself']; ?>
    <!--pop-->
    <?php require_once(dirname(__FILE__) . "/includes/include.php"); ?>
    <?php echo form_open('', array('class' => 'post-form', 'id' => 'post-form')); ?>
    <input type="hidden" name="member_id" value="<?= $member['member_id'] ?>"/>
    <input type="hidden" id="selfid" value="<?= $this->session->userdata("member_id") ?>"/>
    </form>
    <!--header-->
    <?php require_once(dirname(__FILE__) . "/includes/top.php"); ?>
    <!--main-->
    <div id="index-page" class="main-content">
        <div class="container-mid-c">
            <div class="content-area">
                <div class="ctn-wrap">
                    <!--cnt-left-->
                    <div class="ctn-left">
                        <div class="cnt-left-cnt">
                            <!--self-info-area-->
                            <div class="self-info">
                                <!--完善個人資料-->
                                <div class="self-info-btn"><a href="#" class="tooltip-p"><span
                                                class="tooltip-p-text">完善個人資料</span><img
                                                src="/assets/img/svg_icon-73.svg"></a></div>
                                <div class="self-info-cover"><img src="<?= $member['banner'] ?>"
                                                                  onerror="this.src='/assets/img/friend2-cover.jpg'">
                                </div>
                                <div class="self-info-cnt-wrap">
                                    <div class="self-info-cnt">
                                        <div class="user-pic-l"><a href="/page/info"><img
                                                        src="<?= $member['avatar'] ?>"
                                                        onerror="this.src='/assets/img/self-user-pic.jpg'"></a>
                                        </div>
                                        <div class="info-cnt">
                                            <ul>
                                                <li>
                                                    <span class="h5"><?= $member['nickname'] ?></span>
                                                </li>
                                                <li>
                                                    <ul class="info-cnt-inner">
                                                        <li><span class="icon-m award"></span></li>
                                                        <li><a class="lev-btn">Lv.<?= $member['level'] ?></a></li>
                                                        <li class="i-money h6">
                                                            <a class="tooltip-p"><span
                                                                        class="tooltip-p-text">i盾</span></a>:<span><?= number_format($member['money']) ?></span>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="self-info-list">
                                        <ul class="clearfix">
                                            <li class="edit-post ">
                                                <a href="/page/info"><h6><?= $this->lang->line('post') ?></h6>
                                                    <h4><?= $member['postCount'] ?></h4></a>
                                            </li>
                                            <li class="edit-fans">
                                                <a href="/page/info/fans"><h6><?= $this->lang->line('fans') ?></h6>
                                                    <h4><?= $member['fansCount'] ?></h4></a>
                                            </li>
                                            <li class="edit-follower">
                                                <a href="/page/info/follower">
                                                    <h6><?= $this->lang->line('trace') ?></h6>
                                                    <h4><?= $member['traceCount'] ?></h4></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--profile-area-->
                            <div class="profile box-wrap">
                                <div>
                                    <article class="cog-title">
                                        <ul>
                                            <li class="cog-title-icon">
                                                <span><img src="/assets/img/svg_icon-22.svg"></span>
                                            </li>
                                            <li>
                                                <h4><?= $this->lang->line('brief') ?></h4>
                                            </li>
                                        </ul>
                                    </article>
                                    <article class="cog-cnt">
                                        <h5></h5>
                                    </article>
                                    <article class="cog-list">
                                        <ul>
                                            <li class="work"></li>
                                            <li class="school"></li>
                                            <li class="location"></li>
                                            <li class="country"></li>
                                            <li class="relationship"></li>
                                        </ul>
                                    </article>
                                </div>
                            </div>
                            <!--直播專區btn-->
                            <div class="h-tag-side box-wrap">
                                <div>
                                    <a href="/page/live">
                                        <article class="tag-clubs">
                                            <ul>
                                                <li class="tag-clubs"><span><img
                                                                src="/assets/img/icon-live-gold.svg"></span></li>
                                                <li>
                                                    <h4><?= $this->lang->line('live_area') ?></h4>
                                                </li>
                                            </ul>
                                        </article>
                                    </a>
                                </div>
                            </div>
                            <!--photo-area-->
                            <div class="photocog box-wrap">
                                <div>
                                    <article class="cog-title">
                                        <ul>
                                            <li class="cog-title-icon">
                                                <span><img src="/assets/img/svg_icon-27.svg"></span>
                                            </li>
                                            <li>
                                                <h4><?= $this->lang->line('media') ?></h4>
                                            </li>
                                        </ul>
                                    </article>
                                </div>
                                <!--max-number 9-->
                                <div class="photo-list clearfix">
                                </div>
                                <div class="cog-btn"><a href="/page/media"
                                                        class="btn-gold-gra show-btn"><?= $this->lang->line('show_all') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--cnt-middle-->
                    <div class="ctn-middle">
                        <div class="cnt-mid-cnt">
                            <div id="live" class="active">
                                <!--直播專區 title 主內容-->
                                <div class="live-show-title">
                                    <h4><?= $this->lang->line('live_area') ?></h4>
                                </div>
                                <!--直播專區列表-->
                                <?php
                                if (is_mobile()) $desc = 'description: 抱歉,若您是使用行動裝置,請您下載 APP 觀看!!'; else $desc = '';
                                foreach ($lives as $live) {
                                    echo '
                                        <article class="ctn-items clearfix">
                                            <div class="box-wrap">
                                                <div class="items-cnt liveshow-cnt clearfix">
                                                    <div class="edit-pic-cnt liveshow-pic-cnt">
                                                        <div class="live-icon live-mode liveshow-icon"></div>
                                                        <div class="cnt-photo-wrap live-photo"><a href="#" class="cnt-photo"><img src="' . $live['avatar'] . '"></a></div>
                                                    </div>
                                                    <div class="hv-item-wrap live-show-info">
                                                        <ul class="items-name-wrap">
                                                            <li class="items-name"><a href="#">' . $live['nickname'] . '</a></li>
                                                            <li><span class="icon-s award"></span></li>
                                                            <li><span><a class="lev-btn">Lv.' . $live['level'] . '</a></span></li>
                                                        </ul>
                                                        <!--<ul class="items-name-wrap">
                                                            <li class="items-min">於5分鐘前開始直播</li>
                                                        </ul>-->
                                                        <ul class="items-name-wrap">
                                                            <li class="live-show-button">
                                                                <a href="#inlineDiv" onclick="newPlayer(\'' . $live['rtmp_pull_url'] . '\');" class="glightbox2" data-glightbox="descPosition: bottom;' . $desc . ' ">' . $this->lang->line('live_view_live') . '</a>
                                                            </li>
                                                        </ul>
                                                        <div id="inlineDiv" style="display: none; height: 800px !important;">
                                                            <!--直播內容放這邊-->
                                                            <p><div id="video" style="height: 600px; width: 800px;"></div></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    ';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!--cnt-right-->
                    <div class="ctn-right">
                        <div class="cnt-right-cnt">
                            <!--follow-area-->
                            <div class="follow box-wrap disable">
                                <div class="cog-icon-wrap">
                                    <div class="cog-icon"><a href="javascript:void(0);"><img
                                                    src="/assets/img/svg_icon-18.svg"></a></div>
                                </div>
                                <div>
                                    <article class="cog-title">
                                        <h5><?= $this->lang->line('friend_recommend') ?></h5>
                                    </article>
                                </div>
                                <div class="follow-list">
                                    <ul>
                                        <!--ppl-no1-->
                                        <li class="follow-ppl">
                                            <div class="follow-btn-wrap"><a href="#"
                                                                            class="follow-btn"><?= $this->lang->line('trace') ?></a>
                                            </div>
                                            <div class="follow-cnt">
                                                <a href="friend.html">
                                                    <div class="user-pic-m"><img src="/assets/img/userpic-1.jpg">
                                                    </div>
                                                    <div class="pic-m-info">
                                                        <h5></h5>
                                                        <span class="icon-s award"></span>
                                                        <span><a class="lev-btn">Lv.1</a></span>
                                                    </div>
                                                </a>
                                            </div>
                                        </li>
                                        <!--ppl-no2-->
                                        <li class="follow-ppl">
                                            <div class="follow-btn-wrap"><a href="#"
                                                                            class="follow-btn"><?= $this->lang->line('trace') ?></a>
                                            </div>
                                            <div class="follow-cnt">
                                                <a href="friend.html">
                                                    <div class="user-pic-m"><img src="/assets/img/userpic-1.jpg">
                                                    </div>
                                                    <div class="pic-m-info">
                                                        <h5></h5>
                                                        <span class="icon-s award"></span>
                                                        <span><a class="lev-btn">Lv.1</a></span>
                                                    </div>
                                                </a>
                                            </div>
                                        </li>
                                        <!--ppl-no3-->
                                        <li class="follow-ppl">
                                            <div class="follow-btn-wrap"><a href="#"
                                                                            class="follow-btn active">已追蹤</a></div>
                                            <div class="follow-cnt">
                                                <a href="friend-2.html">
                                                    <div class="user-pic-m"><img src="/assets/img/userpic-2.jpg">
                                                    </div>
                                                    <div class="pic-m-info">
                                                        <h5></h5>
                                                        <span class="icon-s award"></span>
                                                        <span><a class="lev-btn">Lv.1</a></span>
                                                    </div>
                                                </a>
                                            </div>
                                        </li>
                                        <!--ppl-no4-->
                                        <li class="follow-ppl">
                                            <div class="follow-btn-wrap"><a href="#" class="follow-btn">追蹤</a></div>
                                            <div class="follow-cnt">
                                                <a href="friend.html">
                                                    <div class="user-pic-m"><img src="/assets/img/userpic-1.jpg">
                                                    </div>
                                                    <div class="pic-m-info">
                                                        <h5></h5>
                                                        <span class="icon-s award"></span>
                                                        <span><a class="lev-btn">Lv.1</a></span>
                                                    </div>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!--online-area-->
                            <div class="online box-wrap disable">
                                <div class="cog-icon-wrap">
                                    <div class="cog-icon"><a href="#"><img src="/assets/img/svg_icon-18.svg"></a>
                                    </div>
                                </div>
                                <div>
                                    <article class="cog-title">
                                        <h5><?= $this->lang->line('online_friend') ?></h5>
                                    </article>
                                </div>
                                <div class="follow-list">
                                    <ul>
                                        <!--ppl-no1-->
                                        <li class="follow-ppl">
                                            <div class="follow-btn-wrap"><a href="#"
                                                                            class="follow-btn"><?= $this->lang->line('chat') ?></a>
                                            </div>
                                            <div class="follow-cnt">
                                                <a href="friend.html">
                                                    <div class="user-pic-m"><img src="/assets/img/userpic-2.jpg">
                                                    </div>
                                                    <div class="pic-m-info">
                                                        <h5></h5>
                                                        <span class="icon-s award"></span>
                                                        <span><a class="lev-btn">Lv.1</a></span>
                                                    </div>
                                                </a>
                                            </div>
                                        </li>
                                        <!--ppl-no2-->
                                        <li class="follow-ppl">
                                            <div class="follow-btn-wrap"><a href="#"
                                                                            class="follow-btn"><?= $this->lang->line('chat') ?></a>
                                            </div>
                                            <div class="follow-cnt">
                                                <a href="friend.html">
                                                    <div class="user-pic-m"><img src="/assets/img/userpic-2.jpg">
                                                    </div>
                                                    <div class="pic-m-info">
                                                        <h5></h5>
                                                        <span class="icon-s award"></span>
                                                        <span><a class="lev-btn">Lv.1</a></span>
                                                    </div>
                                                </a>
                                            </div>
                                        </li>
                                        <!--ppl-no3-->
                                        <li class="follow-ppl">
                                            <div class="follow-btn-wrap"><a href="#"
                                                                            class="follow-btn"><?= $this->lang->line('chat') ?></a>
                                            </div>
                                            <div class="follow-cnt"><a href="friend.html">
                                                    <div class="user-pic-m"><img src="/assets/img/userpic-2.jpg">
                                                    </div>
                                                    <div class="pic-m-info">
                                                        <h5></h5>
                                                        <span class="icon-s award"></span>
                                                        <span><a class="lev-btn">Lv.1</a></span>
                                                    </div>
                                                </a>
                                            </div>
                                        </li>
                                        <!--ppl-no4-->
                                        <li class="follow-ppl">
                                            <div class="follow-btn-wrap"><a href="#"
                                                                            class="follow-btn"><?= $this->lang->line('chat') ?></a>
                                            </div>
                                            <div class="follow-cnt"><a href="friend.html">
                                                    <div class="user-pic-m"><img src="/assets/img/userpic-2.jpg">
                                                    </div>
                                                    <div class="pic-m-info">
                                                        <h5></h5>
                                                        <span class="icon-s award"></span>
                                                        <span><a class="lev-btn">Lv.1</a></span>
                                                    </div>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!--footer-->
                            <?php require_once(dirname(__FILE__) . "/includes/footer.php"); ?>
                        </div>
                    </div>
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
    //    var descriArr = {};
    //    descriArr["cancel"]="<?//=$this->lang->line('cancel');?>//";
    //    descriArr["trace"]="<?//=$this->lang->line('trace');?>//";
    //    descriArr["traced"]="<?//=$this->lang->line('traced');?>//";
    //    descriArr["loading"]="<?//=$this->lang->line('post_loading');?>//";
    //    descriArr["fullload"]="<?//=$this->lang->line('post_full_load');?>//";
    //    descriArr["maxuploadnum"]="<?//=$this->lang->line('upload_exceed_max_pic_num');?>//";
    //    descriArr["mv_maxuploadsize"]="<?//=$this->lang->line('upload_exceed_max_movie_size');?>//";
    //    descriArr["pic_maxuploadsize"]="<?//=$this->lang->line('upload_exceed_max_pic_zise');?>//";
    //    descriArr["edit_avatar"]="<?//=$this->lang->line('member_edit_avatar');?>//";
    //    descriArr["edit_cover"]="<?//=$this->lang->line('member_edit_cover');?>//";
</script>

<script type="text/javascript">
    function newPlayer(video) {
        isplaying = false;
        var videoObject = {
            logo: 'IAMI',
            container: '#video',
            variable: 'player',
            volume: 0.6,
            autoplay: false,
            live: true,
            video: video
        };
        player = new chplayer(videoObject);
    }
</script>

<script src="/assets/js/glightbox.min.js"></script>
<script src="/assets/js/site.js"></script>
<script>
    var lightbox = GLightbox();
    var lightboxDescription = GLightbox({
        selector: 'glightbox2',
        height: 600
    });
</script>

<!--<script src="/assets/js/fileupload/vendor/jquery.ui.widget.js" type="text/javascript"></script>-->
<!--<script src="/assets/js/fileupload/jquery.iframe-transport.js" type="text/javascript"></script>-->
<!--<script src="/assets/js/fileupload/jquery.fileupload.js" type="text/javascript"></script>-->
<!--<script src="/assets/js/nailthumb/jquery.nailthumb.1.1.min.js" type="text/javascript"></script>-->
<!--<link rel="stylesheet" href="/assets/js/nailthumb/jquery.nailthumb.1.1.min.css">-->
<!--<script src="/assets/js/jquery.cookie.js"></script>-->
<script src="/assets/js/wei_common.js?v=<?= uniqid() ?>"></script>
<script src="/assets/js/include.js"></script>
<script src="/assets/js/column_fixed.js"></script>
<div><?php require_once "includes/include-js.php"; ?></div>
</body>
</html>
