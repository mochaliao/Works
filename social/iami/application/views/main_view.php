<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="/assets/img/iami-logo-icon.png">
    <title><?= SITE_NAME ?></title>
    <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <link rel="stylesheet" href="/assets/css/common.css">
    <link rel="stylesheet" href="/assets/css/index-page.css">
    <link rel="stylesheet" href="/assets/css/w3.css">
    <link rel="stylesheet" href="/assets/css/share.css">
    <link rel="stylesheet" href="/assets/css/self-page.css">
    <link rel="stylesheet" href="/assets/css/reg-page.css">
    <script src="/assets/js/common.js"></script>
    <script src="/assets/js/jquery.media.js"></script>
    <?php require_once(dirname(__FILE__) . "/includes/getlanguage.php"); ?>
</head>
<body class="<?php echo $this->session->userdata('language_id'); ?>">


<?php echo form_open('', array('class' => 'post-form', 'id' => 'post-form')); ?>
<input type="hidden" name="member_id" value="<?= $member_id ?>"/>
<input type="hidden" id="selfid" value="<?= $this->session->userdata("member_id") ?>"/>
</form>

<div class="disable">
    <div class="form" id="change-success">
        <form class="change-success">
            <div class="cog-icon-wrap">
                <div class="cog-icon"><a class="pop-btn delete-btn"></a></div>
            </div>
            <h2><?= $this->lang->line('change_success') ?></h2>
            <h5><?= $this->lang->line('change_success_detail') ?></h5>
        </form>
    </div>
</div>

<div class="disable">
    <div class="form" id="release_page">
        <form class="release_page">
<!--            <div class="cog-icon-wrap">-->
<!--                <div class="cog-icon"><a class="pop-btn delete-btn"></a></div>-->
<!--            </div>-->

            <h2>此版本更改項目(ver.1.1)</h2>
            <h5><center>修改語系等問題</center></h5>
            <h5><center>修改註冊功能</center></h5>
            <h5><center>修改語系等問題</center></h5>
            <h5><center>修改註冊等問題</center></h5>
        </form>
    </div>
</div>
<div class="wrapper">
    <!--pop-->
    <?php require_once(dirname(__FILE__) . "/includes/include.php"); ?>

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
                                <!--完善個人資料tooltip-->
                                <div class="self-info-btn"><a href="#" class="tooltip-p"><span
                                                class="tooltip-p-text">完善個人資料</span><img
                                                src="/assets/img/svg_icon-73.svg"></a></div>
                                <!--******-->
                                <div class="self-info-cover"><img src="<?= $banner ?>"
                                                                  onerror="this.src='/assets/img/friend2-cover.jpg'">
                                </div>
                                <div class="self-info-cnt-wrap">
                                    <div class="self-info-cnt">
                                        <div class="user-pic-l"><a href="/page/info"><img src="<?= $avatar ?>"
                                                                                          onerror="this.src='/assets/img/self-user-pic.jpg'"></a>
                                        </div>
                                        <div class="info-cnt">
                                            <ul>
                                                <li>
                                                    <span class="h5"><?= $nickname ?></span>

                                                </li>
                                                <li>
                                                    <ul class="info-cnt-inner">
                                                        <li><span class="icon-m award"></span></li>
                                                        <li><a class="lev-btn purple-btn01">Lv.<?= $level ?></a>
                                                        </li>
                                                        <li class="i-money h6">
                                                            <a class="tooltip-p"><span
                                                                        class="tooltip-p-text">i盾</span></a>:<span><?= number_format($money) ?></span>
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
                                                    <h4><?= $postCount ?></h4></a>
                                            </li>
                                            <li class="edit-fans">
                                                <a href="/page/info/fans"><h6><?= $this->lang->line('fans') ?></h6>
                                                    <h4><?= $fansCount ?></h4></a>
                                            </li>
                                            <li class="edit-follower">
                                                <a href="/page/info/follower">
                                                    <h6><?= $this->lang->line('trace') ?></h6>
                                                    <h4><?= $traceCount ?></h4></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!--profile-area-->
                            <!--                            <div class="profile box-wrap">-->
                            <!--                                <div>-->
                            <!--                                    <article class="cog-title">-->
                            <!--                                        <ul>-->
                            <!--                                            <li class="cog-title-icon">-->
                            <!--                                                <span><img src="/assets/img/svg_icon-22.svg"></span>-->
                            <!--                                            </li>-->
                            <!--                                            <li>-->
                            <!--                                                <h4></h4>-->
                            <!--                                            </li>-->
                            <!--                                        </ul>-->
                            <!--                                    </article>-->
                            <!--                                    -->
                            <!--                                    <article class="cog-cnt">-->
                            <!--                                        <h5></h5>-->
                            <!--                                    </article>-->
                            <!--                                    <article class="cog-list">-->
                            <!--                                        <ul>-->
                            <!--                                            <li class="work disable"></li>-->
                            <!--                                            <li class="school disable"></li>-->
                            <!--                                            <li class="location"></li>-->
                            <!--                                            <li class="country"></li>-->
                            <!--                                            <li class="relationship"></li>-->
                            <!--                                        </ul>-->
                            <!--                                    </article>-->
                            <!--                                </div>-->
                            <!---->
                            <!--                                <div class="profile-tag">-->
                            <!--                                    --><?php //foreach($getLabel1 as $getLabel){ ?>
                            <!--                                        <article><span class="profile-tag-txt h6">-->
                            <?php //echo $this->lang->line("$getLabel->labelname");?><!--</span><span class="profile-tag-ar"><img-->
                            <!--                                                        src="/assets/img/tag-label-ar.png"></span></article>-->
                            <!--                                    --><?php //} ?>
                            <!--                                </div>-->
                            <!---->
                            <!--                            </div>-->

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

                            <!--意見回饋btn-->
                            <div class="h-tag-side box-wrap">
                                <div>
                                    <a href="/Feedback">
                                        <article class="tag-clubs">
                                            <ul>
                                                <li class="tag-clubs"><span><img
                                                                src="/assets/img/svg_icon-79.svg"></span>
                                                </li>
                                                <li>
                                                    <h4><?= $this->lang->line('feedback') ?></h4>
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
                            <!--post-->
                            <div id="post" class="active">
                                <!--主要發貼文區塊-->
                                <?php if (!isset($_GET['post_id'])): ?>
                                    <div class="box-wrap top-cnt">
                                        <div class="top-cnt-box purple-border-c01">
                                            <textarea placeholder="<?= $this->lang->line('what_is_new') ?>"
                                                      class="textbox-type1 post-text" id="topCnt-textarea"></textarea>
                                        </div>
                                        <!--上傳圖片預覽-->
                                        <div class="post-pic">
                                            <ul>
                                                <li><span class="delete-btn-up-pic"></span> <img
                                                            src="/assets/img/ga-pic_5.jpg"></li>
                                                <li><span class="delete-btn-up-pic"></span> <img
                                                            src="/assets/img/ga-pic_5.jpg"></li>
                                                <li><span class="delete-btn-up-pic"></span> <img
                                                            src="/assets/img/ga-pic_5.jpg"></li>
                                                <li><span class="delete-btn-up-pic"></span> <img
                                                            src="/assets/img/ga-pic_5.jpg"></li>
                                                <li><span class="delete-btn-up-pic"></span> <img
                                                            src="/assets/img/ga-pic_5.jpg"></li>
                                                <li><span class="delete-btn-up-pic"></span> <img
                                                            src="/assets/img/ga-pic_5.jpg"></li>
                                                <li><span class="delete-btn-up-pic"></span> <img
                                                            src="/assets/img/ga-pic_5.jpg"></li>
                                                <li><span class="delete-btn-up-pic"></span> <img
                                                            src="/assets/img/ga-pic_5.jpg"></li>
                                                <li><span class="delete-btn-up-pic"></span> <img
                                                            src="/assets/img/ga-pic_5.jpg"></li>
                                            </ul>
                                            <div class="progress-bar"
                                                 style="width:0%;height:5px;border-radius: 10px;"></div>
                                        </div>
                                        <div class="feed-top-tool">
                                            <div class="tool-icon-g">
                                                <label for="picture" style="cursor:pointer;">
                                                    <a class="photo tooltip-p">
                                                        <span class="tooltip-p-text"><?= $this->lang->line('picture') ?></span>
                                                    </a>
                                                </label>

                                                <input type="file" id="picture"
                                                       onchange="fileLength = this.files.length;" name="picture"
                                                       multiple="multiple" class="disable"
                                                       accept="image/jpeg, image/gif, image/png"/>

                                                <label for="movie" style="cursor:pointer;">
                                                    <a class="video tooltip-p">
                                                        <span class="tooltip-p-text"><?= $this->lang->line('video') ?></span>
                                                    </a>
                                                </label>
                                                <input type="file" id="movie" name="movie"
                                                       onchange="fileLength = this.files.length;" class="disable"
                                                       accept="video/mp4,video/webm,video/quicktime"/>
                                            </div>
                                            <div>
                                                <button class="btn-gold-gra publish-btn post-publish"><?= $this->lang->line('publish') ?></button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!--fans-->
                            <div id="fans">
                                <div class="box-wrap">

                                    <hr class="hr-gray">
                                    <div class="list-cnt-wrap">
                                        <ul>
                                            <!--ppl-no1-->
                                            <li class="list-cnt">
                                                <div class="list-cnt-l">
                                                    <a href="#">
                                                        <div class="user-pic-xl">
                                                            <img src="/assets/img/userpic-1.jpg">
                                                        </div>
                                                        <div class="pic-xl-info">
                                                            <h3></h3>
                                                            <span class="icon-s award"></span>
                                                            <span class="lev-btn">Lv.1</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="list-cnt-r">
                                                    <a class="friend-btn befriend"></a>
                                                    <a class="follow-btn active">已追蹤</a><a class="delete-btn"></a>
                                                </div>
                                            </li>
                                            <!--ppl-no2-->
                                            <li class="list-cnt">
                                                <div class="list-cnt-l">
                                                    <a href="#">
                                                        <div class="user-pic-xl">
                                                            <img src="/assets/img/userpic-2.jpg">
                                                        </div>
                                                        <div class="pic-xl-info">
                                                            <h3></h3>
                                                            <span class="icon-s award"></span>
                                                            <span class="lev-btn">Lv.1</span></div>
                                                    </a>
                                                </div>
                                                <div class="list-cnt-r">
                                                    <a class="friend-btn active"></a>
                                                    <a class="follow-btn">追蹤</a>
                                                    <a class="delete-btn"></a>
                                                </div>
                                            </li>
                                            <!--ppl-no3-->
                                            <li class="list-cnt">
                                                <div class="list-cnt-l">
                                                    <a href="#">
                                                        <div class="user-pic-xl">
                                                            <img src="/assets/img/ga-pic_8.jpg">
                                                        </div>
                                                        <div class="pic-xl-info">
                                                            <h3></h3>
                                                            <span class="icon-s award"></span>
                                                            <span class="lev-btn">Lv.1</span></div>
                                                    </a>
                                                </div>
                                                <div class="list-cnt-r">
                                                    <a class="friend-btn befriend"></a>
                                                    <a class="follow-btn">追蹤</a><a class="delete-btn"></a>
                                                </div>
                                            </li>
                                            <!--ppl-no4-->
                                            <li class="list-cnt">
                                                <div class="list-cnt-l">
                                                    <a href="#">
                                                        <div class="user-pic-xl">
                                                            <img src="/assets/img/userpic-1.jpg">
                                                        </div>
                                                        <div class="pic-xl-info">
                                                            <h3></h3>
                                                            <span class="icon-s award"></span>
                                                            <span class="lev-btn">Lv.1</span>
                                                        </div>
                                                    </a></div>
                                                <div class="list-cnt-r">
                                                    <a class="friend-btn"></a>
                                                    <a class="follow-btn">追蹤</a>
                                                    <a class="delete-btn"></a>
                                                </div>
                                            </li>
                                            <!--ppl-no5-->
                                            <li class="list-cnt">
                                                <div class="list-cnt-l">
                                                    <a href="#">
                                                        <div class="user-pic-xl">
                                                            <img src="/assets/img/userpic-2.jpg">
                                                        </div>
                                                        <div class="pic-xl-info">
                                                            <h3></h3>
                                                            <span class="icon-s award"></span>
                                                            <span class="lev-btn">Lv.1</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="list-cnt-r">
                                                    <a class="friend-btn active"></a>
                                                    <a class="follow-btn">追蹤</a>
                                                    <a class="delete-btn"></a>
                                                </div>
                                            </li>
                                            <!--ppl-no6-->
                                            <li class="list-cnt">
                                                <div class="list-cnt-l">
                                                    <a href="#">
                                                        <div class="user-pic-xl">
                                                            <img src="/assets/img/ga-pic_8.jpg">
                                                        </div>
                                                        <div class="pic-xl-info">
                                                            <h3></h3>
                                                            <span class="icon-s award"></span>
                                                            <span class="lev-btn">Lv.1</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="list-cnt-r">
                                                    <a class="friend-btn befriend"></a>
                                                    <a class="follow-btn">追蹤</a>
                                                    <a class="delete-btn"></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!--follower-->
                            <div id="follower">
                                <div class="box-wrap">

                                    <hr class="hr-gray">
                                    <div class="list-cnt-wrap">
                                        <ul>
                                            <!--ppl-no1-->
                                            <li class="list-cnt">
                                                <div class="list-cnt-l">
                                                    <a href="#">
                                                        <div class="user-pic-xl">
                                                            <img src="/assets/img/userpic-1.jpg">
                                                        </div>
                                                        <div class="pic-xl-info">
                                                            <h3></h3>
                                                            <span class="icon-s award"></span>
                                                            <span class="lev-btn">Lv.1</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="list-cnt-r">
                                                    <a class="friend-btn"></a>
                                                    <a class="follow-btn">追蹤</a>
                                                    <a class="delete-btn"></a>
                                                </div>
                                            </li>
                                            <!--ppl-no2-->
                                            <li class="list-cnt">
                                                <div class="list-cnt-l">
                                                    <a href="#">
                                                        <div class="user-pic-xl">
                                                            <img src="/assets/img/userpic-1.jpg">
                                                        </div>
                                                        <div class="pic-xl-info">
                                                            <h3></h3>
                                                            <span class="icon-s award"></span>
                                                            <span class="lev-btn">Lv.1</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="list-cnt-r">
                                                    <a class="friend-btn"></a>
                                                    <a class="follow-btn">追蹤</a>
                                                    <a class="delete-btn"></a>
                                                </div>
                                            </li>
                                            <!--ppl-no3-->
                                            <li class="list-cnt">
                                                <div class="list-cnt-l">
                                                    <a href="#">
                                                        <div class="user-pic-xl">
                                                            <img src="/assets/img/userpic-1.jpg">
                                                        </div>
                                                        <div class="pic-xl-info">
                                                            <h3></h3>
                                                            <span class="icon-s award"></span>
                                                            <span class="lev-btn">Lv.1</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="list-cnt-r">
                                                    <a class="friend-btn"></a>
                                                    <a class="follow-btn">追蹤</a>
                                                    <a class="delete-btn"></a>
                                                </div>
                                            </li>
                                            <!--ppl-no4-->
                                            <li class="list-cnt">
                                                <div class="list-cnt-l">
                                                    <a href="#">
                                                        <div class="user-pic-xl">
                                                            <img src="/assets/img/userpic-1.jpg">
                                                        </div>
                                                        <div class="pic-xl-info">
                                                            <h3></h3>
                                                            <span class="icon-s award"></span>
                                                            <span class="lev-btn">Lv.1</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="list-cnt-r">
                                                    <a class="friend-btn"></a>
                                                    <a class="follow-btn">追蹤</a>
                                                    <a class="delete-btn"></a>
                                                </div>
                                            </li>
                                            <!--ppl-no5-->
                                            <li class="list-cnt">
                                                <div class="list-cnt-l">
                                                    <a href="#">
                                                        <div class="user-pic-xl">
                                                            <img src="/assets/img/userpic-1.jpg">
                                                        </div>
                                                        <div class="pic-xl-info">
                                                            <h3></h3>
                                                            <span class="icon-s award"></span>
                                                            <span class="lev-btn">Lv.1</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="list-cnt-r">
                                                    <a class="friend-btn"></a>
                                                    <a class="follow-btn">追蹤</a>
                                                    <a class="delete-btn"></a>
                                                </div>
                                            </li>
                                            <!--ppl-no6-->
                                            <li class="list-cnt">
                                                <div class="list-cnt-l">
                                                    <a href="#">
                                                        <div class="user-pic-xl">
                                                            <img src="/assets/img/userpic-1.jpg">
                                                        </div>
                                                        <div class="pic-xl-info">
                                                            <h3></h3>
                                                            <span class="icon-s award"></span>
                                                            <span class="lev-btn">Lv.1</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="list-cnt-r">
                                                    <a class="friend-btn"></a>
                                                    <a class="follow-btn">追蹤</a>
                                                    <a class="delete-btn"></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!--storage-->
                            <div id="storage">
                                <!--貼文款式1 純文字-->
                                <article class="ctn-items clearfix">
                                    <div class="cnt-photo-wrap">
                                        <a href="#" class="cnt-photo">
                                            <img src="/assets/img/userpic-self.jpg">
                                        </a>
                                    </div>
                                    <div class="cnt-arrow">
                                        <img src="/assets/img/cnt-items-arrow.png">
                                    </div>
                                    <div class="box-wrap items-wrap">
                                        <div class="items-cnt">
                                            <div class="cog-icon-wrap">
                                                <div class="cog-icon delete">
                                                    <a href="#"><img src="/assets/img/items-delete-btn.png"></a>
                                                </div>
                                            </div>
                                            <ul class="items-name-wrap">
                                                <li class="items-name"><a href="#"></a></li>
                                                <li class="items-min"></li>
                                            </ul>
                                            <p class="items-txt"></p>
                                        </div>
                                        <div class="items-like-wrap">
                                            <div class="items-like-fd">
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                            </div>
                                            <div class="items-like-txt h7">與其他<a href="#">99人</a>Like</div>
                                        </div>
                                        <hr class="hr-gray">
                                        <div class="items-tool">
                                            <ul>
                                                <li><a class="tool-like"><span class="tool-num"></span></a></li>
                                                <li><a class="tool-message" id="mes1"><span class="tool-num"></span></a>
                                                </li>
                                                <li><a class="tool-share"><span class="tool-num"></span></a></li>
                                                <li><a class="tool-storage active"><span
                                                                class="tool-num"><?= $this->lang->line('collect') ?></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!--留言展開-->
                                        <div class="items-dropdown-wrap" id="mes1">
                                            <div class="items-dropdown">
                                                <div class="cog-btn">
                                                    <a class="btn-gold-gra show-btn">顯示更多留言</a>
                                                </div>
                                                <ul class="dropdown-list">
                                                    <!--留言數1-->
                                                    <li>
                                                        <div class="user-pic-s">
                                                            <a href="#"><img src="/assets/img/ga-pic_10.jpg"></a>
                                                        </div>
                                                        <div>
                                                            <ul>
                                                                <li class="items-name"><a href="#"></a></li>
                                                                <li><span class="icon-s award"></span></li>
                                                                <li><span><a class="lev-btn">Lv.1</a></span></li>
                                                                <li class="items-min"></li>
                                                            </ul>
                                                            <p class="items-txt h6"></p>
                                                        </div>
                                                    </li>
                                                    <!--留言數2-->
                                                    <li>
                                                        <div class="user-pic-s">
                                                            <a href="#"><img src="/assets/img/userpic-2.jpg"></a>
                                                        </div>
                                                        <div>
                                                            <ul>
                                                                <li class="items-name">
                                                                    <a href="#"></a>
                                                                </li>
                                                                <li>
                                                                    <span class="icon-s award"></span>
                                                                </li>
                                                                <li><span><a class="lev-btn">Lv.1</a></span></li>
                                                                <li class="items-min"></li>
                                                            </ul>
                                                            <p class="items-txt h6"></p>
                                                        </div>
                                                    </li>
                                                    <!--留言數3-->
                                                    <li>
                                                        <div class="user-pic-s">
                                                            <a href="#"><img src="/assets/img/ga-pic_2.jpg"></a>
                                                        </div>
                                                        <div>
                                                            <ul>
                                                                <li class="items-name"><a href="#"></a></li>
                                                                <li><span class="icon-s award"></span></li>
                                                                <li><span><a class="lev-btn">Lv.1</a></span></li>
                                                                <li class="items-min"></li>
                                                            </ul>
                                                            <p class="items-txt h6">
                                                            </p>
                                                        </div>
                                                    </li>
                                                </ul>
	                                            <div class="dropdown-respond">
		                                            <form  id="mes-form">
			                                            <input placeholder="<?= $this->lang->line('share_want_say') ?>?"
					                                            class="input-type1 comment-content">
			                                            <button class="btn-gold-gra publish-btn comment-publish"><?= $this->lang->line('publish') ?></button>
		                                            </form>
	                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>

                                <!--貼文款式2 相片1張 & 影片-->
                                <article class="ctn-items clearfix">
                                    <div class="cnt-photo-wrap">
                                        <a href="#" class="cnt-photo"><img src="/assets/img/userpic-self.jpg"></a>
                                    </div>
                                    <div class="cnt-arrow">
                                        <img src="/assets/img/cnt-items-arrow.png">
                                    </div>
                                    <div class="box-wrap items-wrap">
                                        <div class="items-cnt">
                                            <div class="cog-icon-wrap">
                                                <div class="cog-icon delete">
                                                    <a href="#"><img src="/assets/img/items-delete-btn.png"></a>
                                                </div>
                                            </div>
                                            <ul class="items-name-wrap">
                                                <li class="items-name"><a href="#"></a></li>
                                                <li class="items-min"></li>
                                            </ul>
                                            <p class="items-txt"></p>
                                            <!--照片-->
                                            <div class="items-photo-wrap">
                                                <ul>
                                                    <li><a href="#"><img src="/assets/img/ga-pic_5.jpg"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="items-like-wrap">
                                            <div class="items-like-fd">
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                            </div>
                                            <div class="items-like-txt h7">與其他<a href="#">99人</a>Like</div>
                                        </div>
                                        <hr class="hr-gray">
                                        <div class="items-tool">
                                            <ul>
                                                <li><a class="tool-like"><span class="tool-num"></span></a></li>
                                                <li><a class="tool-message" id="mes2"><span class="tool-num"></span></a>
                                                </li>
                                                <li><a class="tool-share"><span class="tool-num"></span></a></li>
                                                <li><a class="tool-storage active"><span
                                                                class="tool-num"><?= $this->lang->line('collect') ?></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!--留言展開-->
                                        <div class="items-dropdown-wrap" id="mes2">
                                            <div class="items-dropdown">
                                                <div class="cog-btn"><a class="btn-gold-gra show-btn">顯示更多留言</a>
                                                </div>
                                                <ul class="dropdown-list">
                                                    <!--留言數1-->
                                                    <li>
                                                        <div class="user-pic-s">
                                                            <a href="#"><img src="/assets/img/ga-pic_10.jpg"></a>
                                                        </div>
                                                        <div>
                                                            <ul>
                                                                <li class="items-name"><a href="#"></a></li>
                                                                <li><span class="icon-s award"></span></li>
                                                                <li><span><a class="lev-btn">Lv.1</a></span></li>
                                                                <li class="items-min"></li>
                                                            </ul>
                                                            <p class="items-txt h6"></p>
                                                        </div>
                                                    </li>
                                                    <!--留言數2-->
                                                    <li>
                                                        <div class="user-pic-s">
                                                            <a href="#"><img src="/assets/img/userpic-2.jpg"></a>
                                                        </div>
                                                        <div>
                                                            <ul>
                                                                <li class="items-name"><a href="#"></a></li>
                                                                <li><span class="icon-s award"></span></li>
                                                                <li><span><a class="lev-btn">Lv.1</a></span></li>
                                                                <li class="items-min"></li>
                                                            </ul>
                                                            <p class="items-txt h6"></p>
                                                        </div>
                                                    </li>
                                                    <!--留言數3-->
                                                    <li>
                                                        <div class="user-pic-s">
                                                            <a href="#"><img src="/assets/img/ga-pic_2.jpg"></a>
                                                        </div>
                                                        <div>
                                                            <ul>
                                                                <li class="items-name"><a href="#"></a></li>
                                                                <li><span class="icon-s award"></span></li>
                                                                <li><span><a class="lev-btn">Lv.1</a></span></li>
                                                                <li class="items-min"></li>
                                                            </ul>
                                                            <p class="items-txt h6">
                                                            </p>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="dropdown-respond">
                                                    <div>
                                                        <input placeholder="你想說甚麼?" class="input-type1">
                                                    </div>
                                                    <div>
                                                        <button class="btn-gold-gra publish-btn">發佈</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>

                                <!--貼文款式3 相片9張-->
                                <article class="ctn-items clearfix">
                                    <div class="cnt-photo-wrap">
                                        <a href="#" class="cnt-photo"><img src="/assets/img/userpic-self.jpg"></a>
                                    </div>
                                    <div class="cnt-arrow">
                                        <img src="/assets/img/cnt-items-arrow.png">
                                    </div>
                                    <div class="box-wrap items-wrap">
                                        <div class="items-cnt">
                                            <div class="cog-icon-wrap">
                                                <div class="cog-icon delete">
                                                    <a href="#"><img src="/assets/img/items-delete-btn.png"></a>
                                                </div>
                                            </div>
                                            <ul class="items-name-wrap">
                                                <li class="items-name"><a href="#"></a></li>
                                                <li class="items-min"></li>
                                            </ul>
                                            <p class="items-txt"></p>
                                            <!--照片-->
                                            <div class="items-photo-wrap">
                                                <ul class="items-photo clearfix">
                                                    <li><a href="#"><img src="/assets/img/ga-pic_5.jpg"></a></li>
                                                    <li><a href="#"><img src="/assets/img/ga-pic_3.jpg"></a></li>
                                                    <li><a href="#"><img src="/assets/img/ga-pic_2.jpg"></a></li>
                                                    <li><a href="#"><img src="/assets/img/ga-pic_3.jpg"></a></li>
                                                    <li><a href="#"><img src="/assets/img/ga-pic_5.jpg"></a></li>
                                                    <li><a href="#"><img src="/assets/img/ga-pic_1.jpg"></a></li>
                                                    <li><a href="#"><img src="/assets/img/ga-pic_5.jpg"></a></li>
                                                    <li><a href="#"><img src="/assets/img/ga-pic_3.jpg"></a></li>
                                                    <li><a href="#"><img src="/assets/img/ga-pic_1.jpg"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="items-like-wrap">
                                            <div class="items-like-fd">
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                            </div>
                                            <div class="items-like-txt h7">與其他<a href="#">99人</a>Like</div>
                                        </div>
                                        <hr class="hr-gray">
                                        <div class="items-tool">
                                            <ul>
                                                <li><a class="tool-like"><span class="tool-num"></span></a></li>
                                                <li><a class="tool-message"><span class="tool-num"></span></a></li>
                                                <li><a class="tool-share"><span class="tool-num"></span></a></li>
                                                <li><a class="tool-storage active"><span
                                                                class="tool-num"><?= $this->lang->line('collect') ?></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </article>

                                <!--貼文款式4 分享-->
                                <article class="ctn-items clearfix">
                                    <div class="cnt-photo-wrap">
                                        <a href="#" class="cnt-photo"><img src="/assets/img/userpic-self.jpg"></a>
                                    </div>
                                    <div class="cnt-arrow"><img src="/assets/img/cnt-items-arrow.png"></div>
                                    <div class="box-wrap items-wrap">
                                        <div class="items-cnt">
                                            <div class="cog-icon-wrap">
                                                <div class="cog-icon delete">
                                                    <a href="#"><img src="/assets/img/items-delete-btn.png"></a>
                                                </div>
                                            </div>
                                            <ul class="items-name-wrap">
                                                <li class="items-name"><a href="#"></a></li>
                                                <li class="itmes-share">分享了一則貼文</li>
                                                <li class="items-min"></li>
                                            </ul>
                                            <p class="items-txt"></p>
                                        </div>
                                        <!--分享內容-->
                                        <div class="share-cnt-wrap clearfix">
                                            <hr class="hr-gray">
                                            <div class="share-cnt">
                                                <div class="cnt-photo-wrap">
                                                    <a href="#" class="cnt-photo"><img
                                                                src="/assets/img/userpic-self.jpg"></a>
                                                </div>
                                                <div class="box-wrap items-wrap">
                                                    <div class="items-cnt">
                                                        <ul>
                                                            <li class="items-name"><a href="#"></a></li>
                                                            <li class="itmes-live"><img
                                                                        src="/assets/img/live-btn.png">
                                                            </li>
                                                            <li class="itmes-share">分享了一則貼文</li>
                                                            <li class="items-min"></li>
                                                        </ul>
                                                        <p class="items-txt"></p>
                                                        <div class="items-photo-wrap">
                                                            <ul>
                                                                <li><a href="#"><img src="/assets/img/ga-pic_5.jpg"></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="items-like-wrap">
                                            <div class="items-like-fd">
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                            </div>
                                            <div class="items-like-txt h7">與其他<a href="#">99人</a>Like</div>
                                        </div>
                                        <hr class="hr-gray">
                                        <div class="items-tool">
                                            <ul>
                                                <li><a class="tool-like"><span class="tool-num">1000</span></a></li>
                                                <li><a class="tool-message"><span class="tool-num">0</span></a></li>
                                                <li><a class="tool-share"><span class="tool-num">1000</span></a>
                                                </li>
                                                <li><a class="tool-storage active"><span
                                                                class="tool-num"><?= $this->lang->line('collect') ?></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </article>

                                <!--貼文款式6 在他人塗鴉牆留言-->
                                <article class="ctn-items clearfix">
                                    <div class="cnt-photo-wrap">
                                        <a href="#" class="cnt-photo"><img src="/assets/img/userpic-self.jpg"></a>
                                    </div>
                                    <div class="cnt-arrow"><img src="/assets/img/cnt-items-arrow.png"></div>
                                    <div class="box-wrap items-wrap">
                                        <div class="items-cnt">
                                            <div class="cog-icon-wrap">
                                                <div class="cog-icon delete">
                                                    <a href="#"><img src="/assets/img/items-delete-btn.png"></a>
                                                </div>
                                            </div>
                                            <ul class="items-name-wrap">
                                                <li class="items-name"><a href="#"></a></li>
                                                <li class="items-name other-page"><a href="#"></a></li>
                                                <li class="items-min"></li>
                                            </ul>
                                            <p class="items-txt"></p>
                                        </div>
                                        <div class="items-like-wrap">
                                            <div class="items-like-fd">
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                                <a href="friend.html"><img src="/assets/img/userpic-1.jpg"></a>
                                            </div>
                                            <div class="items-like-txt h7">與其他<a href="#">99人</a>Like</div>
                                        </div>
                                        <hr class="hr-gray">
                                        <div class="items-tool">
                                            <ul>
                                                <li><a class="tool-like"><span class="tool-num">1000</span></a></li>
                                                <li><a class="tool-message"><span class="tool-num">0</span></a></li>
                                                <li><a class="tool-share"><span class="tool-num">1000</span></a>
                                                </li>
                                                <li><a class="tool-storage active"><span
                                                                class="tool-num"><?= $this->lang->line('collect') ?></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </article>
                            </div>

                            <!--friend-list-->
                            <div id="friend-list">
                                <div class="box-wrap">

                                </div>
                                <hr class="hr-gray">
                                <div class="list-cnt-wrap">
                                    <ul>
                                        <!--ppl-no1-->
                                        <li class="list-cnt">
                                            <div class="list-cnt-l">
                                                <a href="friend.html">
                                                    <div class="user-pic-xl"><img src="/assets/img/userpic-1.jpg">
                                                    </div>
                                                    <div class="pic-xl-info">
                                                        <h3></h3>
                                                        <span class="icon-s award"></span>
                                                        <span class="lev-btn">Lv.1</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="list-cnt-r">
                                                <a class="chat-btn">聊天</a>
                                                <a class="delete-btn"></a>
                                            </div>
                                        </li>
                                        <!--ppl-no2-->
                                        <li class="list-cnt">
                                            <div class="list-cnt-l">
                                                <a href="friend.html">
                                                    <div class="user-pic-xl"><img src="/assets/img/userpic-1.jpg">
                                                    </div>
                                                    <div class="pic-xl-info">
                                                        <h3></h3>
                                                        <span class="icon-s award"></span>
                                                        <span class="lev-btn">Lv.1</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="list-cnt-r">
                                                <a class="chat-btn">聊天</a>
                                                <a class="delete-btn"></a>
                                            </div>
                                        </li>
                                        <!--ppl-no3-->
                                        <li class="list-cnt">
                                            <div class="list-cnt-l">
                                                <a href="friend.html">
                                                    <div class="user-pic-xl"><img src="/assets/img/userpic-1.jpg">
                                                    </div>
                                                    <div class="pic-xl-info">
                                                        <h3></h3>
                                                        <span class="icon-s award"></span>
                                                        <span class="lev-btn">Lv.1</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="list-cnt-r">
                                                <a class="chat-btn">聊天</a>
                                                <a class="delete-btn"></a>
                                            </div>
                                        </li>
                                        <!--ppl-no4-->
                                        <li class="list-cnt">
                                            <div class="list-cnt-l">
                                                <a href="friend.html">
                                                    <div class="user-pic-xl"><img src="/assets/img/userpic-1.jpg">
                                                    </div>
                                                    <div class="pic-xl-info">
                                                        <h3></h3>
                                                        <span class="icon-s award"></span>
                                                        <span class="lev-btn">Lv.1</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="list-cnt-r">
                                                <a class="chat-btn">聊天</a>
                                                <a class="delete-btn"></a>
                                            </div>
                                        </li>
                                        <!--ppl-no5-->
                                        <li class="list-cnt">
                                            <div class="list-cnt-l">
                                                <a href="friend.html">
                                                    <div class="user-pic-xl"><img src="/assets/img/userpic-1.jpg">
                                                    </div>
                                                    <div class="pic-xl-info">
                                                        <h3></h3>
                                                        <span class="icon-s award"></span>
                                                        <span class="lev-btn">Lv.1</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="list-cnt-r">
                                                <a class="chat-btn">聊天</a>
                                                <a class="delete-btn"></a>
                                            </div>
                                        </li>
                                        <!--ppl-no6-->
                                        <li class="list-cnt">
                                            <div class="list-cnt-l">
                                                <a href="friend.html">
                                                    <div class="user-pic-xl"><img src="/assets/img/userpic-1.jpg">
                                                    </div>
                                                    <div class="pic-xl-info">
                                                        <h3></h3>
                                                        <span class="icon-s award"></span>
                                                        <span class="lev-btn">Lv.1</span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="list-cnt-r">
                                                <a class="chat-btn">聊天</a>
                                                <a class="delete-btn"></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!--info-list-->
                            <div id="info-edit-list">
                                <div class="box-wrap">
                                    <div class="search-area">
                                        <div class="h3"><?= $this->lang->line('member_edit_title') ?></div>
                                        <!--<div class="info-show-icon"><img src="/assets/img/icon-eye.png"></div>-->
                                    </div>
                                    <div class="info-edit-cnt">
                                        <ul class="self-infom-inner">
                                            <!--個人簡歷-->
                                            <li class="self-info">
                                                <div class="info-edit-icon">
                                                    <img src="/assets/img/svg_icon-03.svg">
                                                </div>
                                                <div>
                                                <textarea placeholder="<?= $this->lang->line('member_field_resume') ?>"
                                                          class="textbox-type2 h5"></textarea>
                                                </div>
                                                <div>
                                                    <label class="checkbox-wrap">
                                                        <input type="checkbox">
                                                        <span class="checkbox-txt"></span>
                                                    </label>
                                                </div>
                                            </li>
                                            <!--生日-->
                                            <li>
                                                <div class="info-edit-icon">
                                                    <img src="/assets/img/svg_icon-03.svg">
                                                </div>
                                                <div>
                                                    <input type="text"
                                                           placeholder="<?= $this->lang->line('member_field_birth') ?>"
                                                           class="self-list-one input-type2">
                                                </div>
                                                <div>
                                                    <label class="checkbox-wrap">
                                                        <input type="checkbox">
                                                        <span class="checkbox-txt"></span>
                                                    </label>
                                                </div>
                                            </li>
                                            <!--性別-->
                                            <li>
                                                <div class="info-edit-icon"><img src="/assets/img/svg_icon-03.svg">
                                                </div>
                                                <div>
                                                    <div class="select-type1">
                                                        <select class="self-list-one">
                                                            <option value="0">請選擇性別</option>
                                                            <option value="1">男生</option>
                                                            <option value="2">女生</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="checkbox-wrap">
                                                        <input type="checkbox">
                                                        <span class="checkbox-txt"></span>
                                                    </label>
                                                </div>
                                            </li>
                                            <!--公司-->
                                            <li>
                                                <div class="info-edit-icon"><img src="/assets/img/svg_icon-03.svg">
                                                </div>
                                                <div>
                                                    <div>
                                                        <ul class="self-list-two">
                                                            <li>
                                                                <input type="text"
                                                                       placeholder="<?= $this->lang->line('member_field_company') ?>"
                                                                       class="input-type2">
                                                                <input type="text"
                                                                       placeholder="<?= $this->lang->line('member_field_position') ?>"
                                                                       class="input-type2">
                                                            </li>
                                                        </ul>
                                                        <div class="self-list-add">
                                                            <a><img src="/assets/img/icon-add.png"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="checkbox-wrap">
                                                        <input type="checkbox">
                                                        <span class="checkbox-txt"></span>
                                                    </label>
                                                </div>
                                            </li>
                                            <!--學校-->
                                            <li>
                                                <div class="info-edit-icon"><img src="/assets/img/svg_icon-03.svg">
                                                </div>
                                                <div>
                                                    <div>
                                                        <ul class="self-list-two">
                                                            <li>
                                                                <input type="text"
                                                                       placeholder="<?= $this->lang->line('member_field_school') ?>"
                                                                       class="input-type2">
                                                                <input type="text"
                                                                       placeholder="<?= $this->lang->line('member_field_department') ?>"
                                                                       class="input-type2">
                                                            </li>
                                                        </ul>
                                                        <div class="self-list-add">
                                                            <a><img src="/assets/img/icon-add.png"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="checkbox-wrap">
                                                        <input type="checkbox">
                                                        <span class="checkbox-txt"></span>
                                                    </label>
                                                </div>
                                            </li>
                                            <!--居住地-->
                                            <li>
                                                <div class="info-edit-icon"><img src="/assets/img/svg_icon-03.svg">
                                                </div>
                                                <div>
                                                    <input type="text"
                                                           placeholder="<?= $this->lang->line('member_field_city') ?>"
                                                           class="self-list-one input-type2">
                                                </div>
                                                <div>
                                                    <label class="checkbox-wrap">
                                                        <input type="checkbox">
                                                        <span class="checkbox-txt"></span>
                                                    </label>
                                                </div>
                                            </li>
                                            <!--國籍-->
                                            <li>
                                                <div class="info-edit-icon"><img src="/assets/img/svg_icon-03.svg">
                                                </div>
                                                <div>
                                                    <input type="text"
                                                           placeholder="<?= $this->lang->line('member_field_country') ?>"
                                                           class="self-list-one input-type2">
                                                </div>
                                                <div>
                                                    <label class="checkbox-wrap">
                                                        <input type="checkbox">
                                                        <span class="checkbox-txt"></span>
                                                    </label>
                                                </div>
                                            </li>
                                            <!--感情狀況-->
                                            <li>
                                                <div class="info-edit-icon"><img src="/assets/img/svg_icon-03.svg">
                                                </div>
                                                <div>
                                                    <div class="select-type1">
                                                        <select class="self-list-one">
                                                            <option value="0"><?= $this->lang->line('member_field_relationship') ?></option>
                                                            <option value="1">單身</option>
                                                            <option value="2">穩定交往中</option>
                                                            <option value="3">結婚</option>
                                                            <option value="4">離婚</option>
                                                            <option value="5">想出軌</option>
                                                            <option value="6">想當小王</option>
                                                            <option value="4">想當小三</option>
                                                            <option value="5">想結婚</option>
                                                            <option value="6">想離婚</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="checkbox-wrap">
                                                        <input type="checkbox">
                                                        <span class="checkbox-txt"></span>
                                                    </label>
                                                </div>
                                            </li>
                                        </ul>
                                        <button class="btn-gold-gra info-edit-btn"><?= $this->lang->line('member_btn_edit') ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--cnt-right-->
                    <div class="ctn-right">
                        <div class="cnt-right-cnt">

                            <!--banner area-->
                            <div class="banner">
                                <a href="/page/info?i=2">
                                    <img src="/assets/img/banner-mama-ver1.png">
                                </a>
                            </div>

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
                                                    <div class="user-pic-m"><img src="/assets/img/userpic-1.jpg"></div>
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
                                                    <div class="user-pic-m"><img src="/assets/img/userpic-1.jpg"></div>
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
                                            <div class="follow-btn-wrap"><a href="#" class="follow-btn active">已追蹤</a>
                                            </div>
                                            <div class="follow-cnt">
                                                <a href="friend-2.html">
                                                    <div class="user-pic-m"><img src="/assets/img/userpic-2.jpg"></div>
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
                                                    <div class="user-pic-m"><img src="/assets/img/userpic-1.jpg"></div>
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
                                    <div class="cog-icon"><a href="#"><img src="/assets/img/svg_icon-18.svg"></a></div>
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
                                                    <div class="user-pic-m"><img src="/assets/img/userpic-2.jpg"></div>
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
                                                    <div class="user-pic-m"><img src="/assets/img/userpic-2.jpg"></div>
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
                                                    <div class="user-pic-m"><img src="/assets/img/userpic-2.jpg"></div>
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
                                                    <div class="user-pic-m"><img src="/assets/img/userpic-2.jpg"></div>
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
<link rel="stylesheet" href="/assets/js/colorbox/colorbox.css">
<script src="/assets/js/colorbox/jquery.colorbox-min.js"></script>

<script>
    <?php
    if (isset($show_type) || isset($release_page)) {

        if (strtolower($show_type) == 'change_success') {
            // echo '$(".forget-link").click();';
            echo "$.colorbox({
                            inline: true,
                            width: 'auto',
                            height: 'auto',
                            overlayClose: true,
                            closeButton: false,
                            escKey:false,
                            href: '#change-success'
                        });";
        }else if(strtolower($release_page == 'true')){

            echo "$.colorbox({
                            inline: true,
                            width: 'auto',
                            height: 'auto',
                            overlayClose: true,
                            closeButton: false,
                            escKey:false,
                            href: '#release_page'
                        });";
        }
    }
    ?>

</script>
<!--<link rel="stylesheet" href="/assets/js/colorbox/colorbox.css">-->
<!--<script src="/assets/js/colorbox/jquery.colorbox-min.js"></script>-->

<!--<script src="/assets/js/fileupload/vendor/jquery.ui.widget.js" type="text/javascript"></script>-->
<!--<script src="/assets/js/fileupload/jquery.iframe-transport.js" type="text/javascript"></script>-->
<!--<script src="/assets/js/fileupload/jquery.fileupload.js" type="text/javascript"></script>-->
<!--<script src="/assets/js/nailthumb/jquery.nailthumb.1.1.min.js" type="text/javascript"></script>-->
<!--<link rel="stylesheet" href="/assets/js/nailthumb/jquery.nailthumb.1.1.min.css">-->
<!--<script src="/assets/js/jquery.cookie.js"></script>-->

<!--<script src="/assets/js/jquery.caret.js"></script>-->
<!--<script src="/assets/js/at/jquery.atwho.js"></script>-->
<!--<link rel="stylesheet" href="/assets/js/at/jquery.atwho.min.css">-->


<script src="/assets/js/wei_common.js?v=<?= uniqid() ?>"></script>
<script src="/assets/js/include.js"></script>
<script src="/assets/js/column_fixed.js"></script>
<div><?php require_once "includes/include-js.php"; ?></div>

</body>
</html>