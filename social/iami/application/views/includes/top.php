<!--pop視窗 修改密碼-->
<div class="disable">
    <div class="form" id="modify-form">
        <?php echo form_open('/page/doChangePassword', array('class' => 'forget-form')); ?>
        <!-- <form class="forget-form"> -->
        <div class="cog-icon-wrap">
            <div class="cog-icon">
                <a class="pop-btn delete-btn"></a>
            </div>
        </div>
        <h2><a class="colorf8b551"><?= $this->lang->line('member_change_password_title') ?></a></h2>
        <span class="error-txt"><?php echo form_error('member_edit_password_failed_message'); ?></span>
        <ul>
            <li>
                <input type="password" name="old_password"
                       value="<?php echo set_value('old_password') ? set_value('old_password') : ''; ?>"
                       placeholder="<?= $this->lang->line('member_field_old_password') ?>">
                <span class="error-txt" style="visibility: visible"><?php echo form_error('old_password'); ?></span>
            </li>
            <li>
                <input type="password" name="new_password"
                       value="<?php echo set_value('new_password') ? set_value('new_password') : ''; ?>"
                       placeholder="<?= $this->lang->line('member_field_new_password') ?>">
                <span class="error-txt" style="visibility: visible"><?php echo form_error('new_password'); ?></span>
                <!--0514 tootltip-->
                <div class="form-tooltip-wrap">
                    <div class="form-tooltip">
                        <a class="tip-mark">
                            <span class="tooltip-p-text"><?php echo $this->lang->line('new-password-notify');?></span>
                        </a>
                    </div>
                </div>
                <!--0514***-->
            </li>
            <li>
                <input type="password" name="confirm_new_password"
                       value="<?php echo set_value('confirm_new_password') ? set_value('confirm_new_password') : ''; ?>"
                       placeholder="<?= $this->lang->line('member_field_confirm_new_password') ?>">
                <span class="error-txt"
                      style="visibility: visible"><?php echo form_error('confirm_new_password'); ?></span>
                <!--0514 tooltip-->
                <div class="form-tooltip-wrap">
                    <div class="form-tooltip">
                        <a class="tip-mark">
                            <span class="tooltip-p-text"><?php echo $this->lang->line('new-password-again-notify');?></span>
                        </a>
                    </div>
                </div>
                <!--0514***-->
            </li>
            <li>
                <button class="btn-gold-gra pop-btn"><?= $this->lang->line('member_btn_edit') ?></button>
            </li>
        </ul>
        </form>
    </div>
</div>

<!--fixMenu-->
<div class="fixMenu">
    <ul class="fixMenu-cnt">
        <li><a href="/page/main">
                <div class="index"><img src="/assets/img/svg_icon-44.svg"></div>
                <h8><?php echo $this->lang->line('index-page'); ?></h8>
            </a></li>
        <li><a href="/page/invite_notifies">
                <div class="bubble-wrap invite-bubble disable">
                    <p class="bubble-txt"><span>99+</span></p>
                </div>
                <div><img src="/assets/img/svg_icon-03.svg"></div>
                <h8><?php echo $this->lang->line('invite-page'); ?></h8>
            </a></li>
        <li><a href="/page/notifies">
                <div class="bubble-wrap notify-bubble disable">
                    <p class="bubble-txt"><span>99+</span></p>
                </div>
                <div><img src="/assets/img/svg_icon-07.svg"></div>
                <h8><?php echo $this->lang->line('notice-page'); ?></h8>
            </a></li>
        <li><a href="/page/message_notifies">
                <div class="bubble-wrap message-bubble disable">
                    <p class="bubble-txt"><span>99+</span></p>
                </div>
                <div><img src="/assets/img/svg_icon-06.svg"></div>
                <h8><?php echo $this->lang->line('message-page'); ?></h8>
            </a></li>
        <li><a href="/page/info">
                <div><img class="self-pic-m" src="<?= $this->session->userdata("avatar") ?>"
                          onerror="this.src='/assets/img/self-user-pic.jpg'"></div>
                <h8><?php echo $this->lang->line('me-page'); ?></h8>
            </a></li>
    </ul>
</div>

<!--header-m-->
<div class="header-m">
    <div class="header-container-m clearfix">
        <!--header-left-->
        <div class="header-left-m">
            <a href="/page/showLive" class="live-icon-m" style="display:none;">
                <img src="/assets/img/icon-live-white.svg">
            </a>
            <a href="/page/videoshow" class="video-icon-m"><img src="/assets/img/header-icon-5sVideo-white.svg"></a>
        </div>

        <!--header-middle-->
        <div class="header-middle-m"><a href="/page/main" class="header-logo-m"><img
                        src="/assets/img/iami-logo-login.svg"></a></div>

        <!--header-right-->
        <div class="header-right-m"><a class="search"><img src="/assets/img/icon-search-white-b.svg"></a>

            <!--mobile-ham-btn-->
            <div class="m-header-menu mobile"><a id="menu-trigger" href="#"><span class="menu-icon"></span></a></div>
        </div>
    </div>
    <div class="m-search-area"><a class="m-search-btn"></a>
        <input type="text" name="mobile_search2" placeholder="在iami搜尋">
    </div>
</div>

<!--subHeader-m-->
<div class="subHeader-m">
    <ul>
        <!--patty m-->
        <li><span><img src="/assets/img/svg_icon-67.svg"></span><a
                    href="/hot/post" <?php echo strpos($_SERVER['REQUEST_URI'], '/hot/post') !== false ? "class=\"active\"" : ""; ?>><?= $this->lang->line('hot_posts') ?></a>
        </li>
        <li><span><img src="/assets/img/svg_icon-70.svg"></span><a
                    href="/hot/video" <?php echo strpos($_SERVER['REQUEST_URI'], '/hot/video') !== false ? "class=\"active\"" : "" ?>><?= $this->lang->line('hot_videos') ?></a>
        </li>
        <li><span><img src="/assets/img/svg_icon-79.svg"></span><a
                    href="/feedback" <?php echo strpos($_SERVER['REQUEST_URI'], '/feedback') !== false ? "class=\"active\"" : "" ?>><?= $this->lang->line('feedback') ?></a>
        </li>
        <!--	    <li><span><img src="../assets/img/svg_icon-71.svg"></span><a>意見回饋</a></li>-->
    </ul>
</div>

<!--20180312 *****-->

<div class="header">
    <div class="container-wide">
        <div class="dec-line"></div>
        <div class="header-container clearfix">
            <!--header-left-->
            <div class="header-left">
                <div class="header-logo">
                    <a href="/page/main">
                        <img alt="" src="/assets/img/iami-logo-header.png">
                    </a>
                </div>
                <div class="video-ac-area">
                    <a href="/page/videoshow">
                        <span class="video-icon">
                            <img src="/assets/img/5s-video-icon.svg">
                        </span>
                        <span class="video-txt"><?= $this->lang->line('top_video_zone') ?></span>
                    </a>
                </div>
                <div class="video-ac-area header-hot"><a href="/hot/video"><span class="video-icon"><img
                                    src="/assets/img/svg_icon-70.svg"></span><span
                                class="video-txt"><?= $this->lang->line('hot_videos') ?></span></a></div>
                <div class="video-ac-area header-hot"><a href="/hot/post"><span class="video-icon"><img
                                    src="/assets/img/svg_icon-67.svg"></span><span
                                class="video-txt"><?= $this->lang->line('hot_posts') ?></span></a></div>
            </div>
            <!--header-middle-->
            <div class="header-middle">
                <div class="header-search">
                    <a></a>
                    <input type="text" name="main_search" placeholder="<?= $this->lang->line('top_search') ?>">
                    <!--
                    <button><img src="/assets/img/svg_icon-01.svg"></button>
                    -->
                </div>

            </div>

            <!--header-right-->
            <div class="header-right">
                <ul class="header-icon-g">
                    <li><a class="search"></a></li>
                    <!--邀請-->
                    <li>
                        <div class="bubble-wrap invite-bubble disable">
                            <p class="bubble-txt">
                                <span>99+</span>
                            </p>
                        </div>
                        <a href="#">
                            <div class="invite">
                                <span><?= $this->lang->line('top_invite') ?></span>
                            </div>
                        </a>
                    </li>
                    <!--通知-->
                    <li>
                        <div class="bubble-wrap notify-bubble disable">
                            <p class="bubble-txt">
                                <span>99+</span>
                            </p>
                        </div>
                        <a href="#">
                            <div class="notify">
                                <span><?= $this->lang->line('top_notice') ?></span>
                            </div>
                        </a>
                    </li>
                    <!--訊息-->
                    <li>
                        <div class="bubble-wrap message-bubble disable">
                            <p class="bubble-txt">
                                <span>99+</span>
                            </p>
                        </div>
                        <a href="#">
                            <div class="message">
                                <span><?= $this->lang->line('top_message') ?></span>
                            </div>
                        </a>
                    </li>
                </ul>
                <!--頭像及匿稱-->
                <ul class="self-dropdown">
                    <li class="self-dropdown-img">
                        <img src="<?= $this->session->userdata("avatar") ?>"
                             onerror="this.src='/assets/img/self-user-pic.jpg'">
                    </li>
                    <!--<li class="self-dropdown-cnt">
                        <a href="#">
                            <span><?= $this->session->userdata("nickname") ?></span>
                            <img src="/assets/img/self-img-arrow.png">
                        </a>
                    </li>-->
                </ul>

                <!--mobile-ham-btn-->
                <div class="m-header-menu">
                    <a id="menu-trigger" href="#">
                        <span class="menu-icon"></span>
                    </a>
                </div>

                <!--交友邀請-->
                <div class="flyout-box disable" id="invite">
                    <div class="flyout-triangle">
                        <span class="bot"></span>
                        <span class="top"></span>
                    </div>
                    <div class="flyout-cnt-wrap">
                        <ul>
                        </ul>
                    </div>

                    <h6 class="disable"><a href="/page/invite_notifies"><?= $this->lang->line('show_all') ?></a></h6>

                </div>

                <!--通知-->
                <div class="flyout-box disable" id="notify">
                    <div class="flyout-triangle">
                        <span class="bot"></span>
                        <span class="top"></span>
                    </div>
                    <div class="flyout-cnt-wrap">
                        <ul>
                            <!--                            <!--ppl-no1 未讀狀態-->
                            <!--                            <li>-->
                            <!--                                <div class="flyout-dot"><a></a></div>-->
                            <!--                                <div class="flyout-cnt">-->
                            <!--                                    <a href="friend.html">-->
                            <!--                                        <div class="user-pic-s">-->
                            <!--                                            <img src="/assets/img/userpic-1.jpg">-->
                            <!--                                        </div>-->
                            <!--                                        <div class="pic-s-info">-->
                            <!--                                            <h5>周華健 Wakin Chau</h5>-->
                            <!--                                            <h6 class="f-group-cnt">在你的貼文中留言。</h6>-->
                            <!--                                        </div>-->
                            <!--                                    </a>-->
                            <!--                                </div>-->
                            <!--                            </li>-->
                            <!--                            <!--ppl-no2 已讀狀態-->
                            <!--                            <li>-->
                            <!--                                <div class="flyout-cnt">-->
                            <!--                                    <a href="friend-2.html">-->
                            <!--                                        <div class="user-pic-s">-->
                            <!--                                            <img src="/assets/img/userpic-2.jpg">-->
                            <!--                                        </div>-->
                            <!--                                        <div class="pic-s-info">-->
                            <!--                                            <h5>吳宗憲</h5>-->
                            <!--                                            <h6 class="f-group-cnt">喜歡你的貼文。</h6>-->
                            <!--                                        </div>-->
                            <!--                                    </a>-->
                            <!--                                </div>-->
                            <!--                            </li>-->
                        </ul>
                    </div>

                    <h6 class="disable"><a href="/page/notifies"><?= $this->lang->line('show_all') ?></a></h6>


                </div>

                <!--訊息通知-->
                <div class="flyout-box disable" id="message">
                    <div class="flyout-triangle">
                        <span class="bot"></span>
                        <span class="top"></span>
                    </div>
                    <div class="flyout-cnt-wrap">
                        <ul>
                            <!--                            <!--ppl-no1 未讀狀態-->
                            <!--                            <li>-->
                            <!--                                <div class="flyout-dot"><a></a></div>-->
                            <!--                                <div class="flyout-cnt">-->
                            <!--                                    <a href="#" id="addClass">-->
                            <!--                                        <div class="user-pic-s">-->
                            <!--                                            <img src="/assets/img/userpic-1.jpg">-->
                            <!--                                        </div>-->
                            <!--                                        <div class="pic-s-info">-->
                            <!--                                            <h5>周華健 Wakin Chau</h5>-->
                            <!--                                            <h6 class="f-group-cnt">HIHI</h6>-->
                            <!--                                        </div>-->
                            <!--                                    </a>-->
                            <!--                                </div>-->
                            <!--                            </li>-->
                            <!--                            <!--ppl-no2 已讀狀態-->
                            <!--                            <li>-->
                            <!--                                <div class="flyout-cnt">-->
                            <!--                                    <a href="#">-->
                            <!--                                        <div class="user-pic-s">-->
                            <!--                                            <img src="/assets/img/userpic-2.jpg">-->
                            <!--                                        </div>-->
                            <!--                                        <div class="pic-s-info">-->
                            <!--                                            <h5>吳宗憲</h5>-->
                            <!--                                            <h6 class="f-group-cnt">HIHI</h6>-->
                            <!--                                        </div>-->
                            <!--                                    </a>-->
                            <!--                                </div>-->
                            <!--                            </li>-->
                        </ul>
                    </div>
                    <h6 class="disable"><a href="/page/message_notifies"><?= $this->lang->line('show_all') ?></a></h6>
                </div>

                <!--self-dropdown-內容-->
                <div class="flyout-box" id="dropdown">
                    <div class="flyout-triangle">
                        <span class="bot"></span>
                        <span class="top"></span>
                    </div>
                    <div class="flyout-drop-cnt">
                        <ul>
                            <li>
                                <ol>
                                    <li class="self-dropdown-cnt">
                                        <a href="/page/info">
                                            <h5><?= $this->session->userdata("nickname") ?></h5>
                                        </a>
                                    </li>
                                    <li class="i-money h6">
                                        <a><img src="/assets/img/money-icon.png"></a>:<span><?= number_format($this->session->userdata('balance')) ?></span>
                                        <div class="btn-gold-gra i-money-btn"
                                             style="display:none;"><?= $this->lang->line('menu_deposit') ?></div>
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <ol>
                                    <li class="h5"><?php echo $this->lang->line('profile'); ?></li>
                                    <li><a href="/page/media"><?= $this->lang->line('menu_media') ?></a></li>
                                    <li><a href="/chat"><?= $this->lang->line('menu_message') ?></a></li>
                                    <li><a href="/page/info/friend_list"><?= $this->lang->line('menu_friend') ?></a>
                                    </li>
                                    <li>
                                        <a href="/page/info/collection_list"><?= $this->lang->line('menu_collection') ?></a>
                                    </li>
                                </ol>
                            </li>
                            <!--                            <li>-->
                            <!--                                <ol>-->
                            <!--                                    <li class="h5"><a href="/Frontend/level_index">經驗值專區</a></li>-->
                            <!--                                    <li class="h5"><a href="/Frontend/sign_index">簽到專區</a></li>-->
                            <!--                                    <li class="h5"><a href="/Frontend/task_index">任務專區</a></li>-->
                            <!--                                    <li class="h5"><a href="/Frontend/store_index">商城</a></li>-->
                            <!--                                </ol>-->
                            <!--                            </li>-->

                            <li>
                                <ol>
                                    <li><a href="/page/info/edit"><?= $this->lang->line('menu_edit_member') ?></a></li>
                                    <li><a class="modify-ps"><?= $this->lang->line('menu_change_password') ?></a></li>
                                    <li><a href="/member/showPrivacy"><?= $this->lang->line('menu_privacy') ?></a></li>
                                    <li><a href="/member/showService"><?= $this->lang->line('menu_service') ?></a></li>
                                </ol>
                            </li>
                        </ul>
                        <button onclick="location.href='/member/doLogout'"><?= $this->lang->line('member_btn_logout') ?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-search-area">
            <a class="m-search-btn"></a>
            <input type="text" id="mobile_search" name="mobile_search"
                   placeholder="<?= $this->lang->line('top_search') ?>">
        </div>
    </div>
</div>
<div class="flyout-box2 disable" id="search-cnt">
    <div class="flyout-triangle">
        <span class="bot"></span>
        <span class="top"></span>
    </div>
    <div class="flyout-cnt-wrap">
        <ul>
            <li>
                <div class="flyout-cnt">
                    <div class="user-pic-s">
                        <img src="/assets/img/self-user-pic.jpg">
                    </div>
                    <div class="pic-s-info">
                        <h5>周華健 Wakin Chau</h5>
                    </div>
                </div>
            </li>
            <li>
                <div class="flyout-cnt">
                    <div class="user-pic-s">
                        <img src="/assets/img/self-user-pic.jpg">
                    </div>
                    <div class="pic-s-info">
                        <h5>周華健 Wakin Chau</h5>
                    </div>
                </div>
            </li>
            <li>
                <div class="flyout-cnt">
                    <div class="user-pic-s">
                        <img src="/assets/img/self-user-pic.jpg">
                    </div>
                    <div class="pic-s-info">
                        <h5>周華健 Wakin Chau</h5>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
<!--mobile nav-->
<nav id="mobile-nav">
    <div class="m-nav-wrap">
        <div class="m-nav-out">
            <div class="m-nav-inner flyout-drop-cnt">
                <ul>
                    <li>
                        <ol>
                            <li class="self-dropdown-cnt"><a href="/page/info">
                                    <h5><?= $this->session->userdata("nickname") ?></h5>
                                </a></li>
                            <li class="i-money h6">
                                <a></a>:<span><?= number_format($this->session->userdata('balance')) ?></span>
                                <div class="btn-gold-gra i-money-btn"
                                     style="display:none;"><?= $this->lang->line('menu_deposit') ?></div>
                            </li>
                        </ol>
                    </li>
                    <li>
                        <ol>
                            <li class="h5"><?php echo $this->lang->line('profile');?></li>
                            <li><a href="/page/media"><?= $this->lang->line('menu_media') ?></a></li>
                            <li><a href="/chat"><?= $this->lang->line('menu_message') ?></a></li>
                            <li><a href="/page/info/friend_list"><?= $this->lang->line('menu_friend') ?></a></li>
                            <li><a href="/page/info/collection_list"><?= $this->lang->line('menu_collection') ?></a>
                            </li>
                        </ol>
                    </li>
                    <!--                    <li>-->
                    <!--                    <ol>-->
                    <!--                    <li class="h5"><a href="/Frontend/level_index">經驗值專區</a></li>-->
                    <!--                    <li class="h5"><a href="/Frontend/sign_index">簽到專區</a></li>-->
                    <!--                    <li class="h5"><a href="/Frontend/task_index">任務專區</a></li>-->
                    <!--                    <li class="h5"><a href="/Frontend/store_index">商城</a></li>-->
                    <!--                    </ol>-->
                    <!--                    </li>-->
                    <li>
                        <ol>
                            <li><a href="/page/info/edit"><?= $this->lang->line('menu_edit_member') ?></a></li>
                            <li><a class="modify-ps"><?= $this->lang->line('menu_change_password') ?></a></li>
                            <li><a href="/member/showPrivacy"><?= $this->lang->line('menu_privacy') ?></a></li>
                            <li><a href="/member/showService"><?= $this->lang->line('menu_service') ?></a></li>
                        </ol>
                    </li>
                </ul>
                <button onclick="location.href='/member/doLogout'"><?= $this->lang->line('member_btn_logout') ?></button>
            </div>
        </div>
    </div>
</nav>

<!--<script src="/assets/js/sfs2zji.js"></script>-->
<!--<script src="https://use.typekit.net/sfs2zji.js"></script>-->
<script src="/assets/js/socket.io.js"></script>
<script src="/assets/js/beforecommon.js"></script>
<script>

    loadMessageNotify();
    loadInviterNotify();
    loadNormalNotify();
    var socket = io('<?=get_push_domain() . ':' . CLIENT_PUSH_PORT . '/';?>');

    socket.on('connect', function () {
        socket.emit('login', <?php echo $this->session->userdata("member_id");?>);
    });
    // 后端推送来消息时
    socket.on('new_msg', function (msg) {

        $(".nodata").remove();
        var jsonMsg = (JSON.parse($.parseHTML(msg)[0].data))[0];

        if (jsonMsg.notice != undefined) {
            var data = jsonMsg.notice.data;
            for (var i = 0; i < data.length; i++) {
                var notify = $(".notify-item-object").clone();
                notify.removeClass("disable");
                notify.removeClass("notify-item-object");
                notify.addClass("notify-item");
                $(".notify-time", notify).html(data[i].createTime);
                $(".flyout-cnt a", notify).attr('href', data[i].target_path);

                if (data[i].avatar == null || data[i].avatar == '' || data[i].avatar == undefined) {
                    $(".user-pic-s img", notify).attr("src", "/assets/img/self-user-pic.jpg");
                }
                else {
                    $(".user-pic-s img", notify).attr("src", data[i].avatar);
                }

                $(".pic-s-info h5", notify).html(data[i].nickname);
                switch(data[i].text){
                    case "Tag": data[i].text = "<?php echo $this->lang->line('has-tag-you');?>"; break;
                    case "Comment": data[i].text = "<?php echo $this->lang->line('has-comment');?>"; break;
                    case "Wall": data[i].text = "<?php echo $this->lang->line('has-post-on');?>"; break;
                    case "Thumb": data[i].text = "<?php echo $this->lang->line('has-thumb-on-post');?>"; break;
                    default: break;
                }
                $(".pic-s-info .f-group-cnt", notify).html(data[i].text);

                var ul = $("#notify .flyout-cnt-wrap ul");
                if ($("li", ul).length == 0) {
                    ul.append($(notify));
                } else {
                    $(notify).insertBefore($("li:first", ul));
                }
            }

            var span = $(".notify-bubble .bubble-txt span");
            if ($(".notify-bubble").hasClass("disable")) {
                $(".notify-bubble").removeClass("disable");
                span.html("1");
            } else if (span.html() != "99+") {
                var num = parseInt(span.html()) + 1;
                if (num > 99) {
                    span.html("99+");
                } else {
                    span.html(num);
                }
            }
        }
        else if (jsonMsg.chat != undefined) {
            var result = jsonMsg.chat;
            for (var i = 0; i < result.length; i++) {

                if (location.href.indexOf("/chat/") > -1) {
                    //chat page
                    if ($("#clientId").val() == result[i].master) {
                        getDateHead(result[i].time);
                        console.log($(".chat-col .chat-head img").attr("src"));
                        var client = $(".chat-ppla.chata.disable").clone();
                        client.children("img").attr("src", $(".chat-col .chat-head img").attr("src"));

                        if (result[i].msg != ":)") {
                            client.find(".chat-contenta").html(result[i].msg);
                        }

                        var nowTime = result[i].time.replace(/\-/g, "/");
                        var today = new Date(nowTime);
                        var currentDateTime = addZero(today.getHours()) + ':' + addZero(today.getMinutes());
                        client.find(".chat-time-left").html(currentDateTime);
                        $("#chat").append(client.removeClass("disable"));
                    }

                    renderLstLeftMsg("chatunit", result[i]);
                    renderLstLeftMsg("chatunit2", result[i]);

                    if ($("#clientId").val() == result[i].master) {
                        break;
                    }
                }

                var img = "";
                if (result[i].avatar == null || result[i].avatar == '' || result[i].avatar == undefined) {
                    img = "/assets/img/self-user-pic.jpg";
                }
                else {
                    img = result[i].avatar;
                }

                var lstMsg = result[i].msg != ":)" ? result[i].msg : ":)";
                var member = $("#message .flyout-cnt-wrap ul").find("[mid=" + result[i].master + "]");
                if (member.length > 0) {
                    member.find("h6.f-group-cnt").html(lstMsg);
                    if (member.find(".flyout-dot").length == 0) {
                        $("<div class=\"flyout-dot\"><a></a></div>").insertBefore(member.find(".flyout-cnt"));
                    }
                    var lstNum = parseInt(member.attr("num")) + 1;
                    member.attr("num", lstNum);
                    member.find(".bubble-txt").html(lstNum).parent().removeClass("disable");
                } else {
                    var li = " <li class='message-item' num='1' mid='" + result[i].master + "'>\n" +
                        "                                <div class=\"flyout-dot\"><a></a></div>\n" +
                        "                                <div class=\"flyout-cnt\">\n" +
                        "                                    <a href=\"../../../chat/" + result[i].master + "\">\n" +
                        "                                        <div class=\"user-pic-s\">\n" +
                        "                                           <div class=\"bubble-wrap active\">\n" +
                        "                                                <p class=\"bubble-txt\"><span>1</span></p>\n" +
                        "                                            </div>" +
                        "                                            <img src=\"" + img + "\" onerror=\"this.src='/assets/img/self-user-pic.jpg'\">\n" +
                        "                                        </div>\n" +
                        "                                        <div class=\"pic-s-info\">\n" +
                        "                                            <h5>" + result[i].nickname + "</h5>\n" +
                        "                                            <h6 class=\"f-group-cnt\">" + lstMsg + "</h6>\n" +
                        "                                        </div>\n" +
                        "                                    </a>\n" +
                        "                                </div>\n" +
                        "                            </li>";

                    var ul = $("#message .flyout-cnt-wrap ul");
                    if ($("li", ul).length == 0) {
                        ul.append($(li));
                    } else {
                        $(li).insertBefore($("li:first", ul));
                    }
                }

                if (location.href.indexOf("/chat/") == -1 || (location.href.indexOf("/chat/") > -1 && $("#clientId").val() != result[i].master)) {
                    var span = $(".message-bubble .bubble-txt span");
                    if ($(".message-bubble").hasClass("disable")) {
                        $(".message-bubble").removeClass("disable");
                        span.html("1");
                    } else if (span.html() != "99+") {
                        var num = parseInt(span.html()) + 1;
                        if (num > 99) {
                            span.html("99+");
                        } else {
                            span.html(num);
                        }
                    }
                }
            }
        }
        else if (jsonMsg.invite != undefined) {
            var data = jsonMsg.invite;
            var ul = $("#invite .flyout-cnt-wrap ul");
            var span = $(".invite-bubble .bubble-txt span");
            for (var i = 0; i < data.length; i++) {
                if (data[i].istatus == undefined) {//cancel invite
                    var removeLi = ul.find("[member-id=" + data[i].member_id + "]");
                    if (removeLi.length > 0) {
                        removeLi.remove();
                        var total = parseInt(span.attr("total")) - 1;
                        span.attr("total", total);
                        if (total < 100) {
                            span.html(total);
                        }
                        if (ul.find("li").length == 0) {
                            ul.append("<li class='nodata'><div style='text-align: center'><?=$this->lang->line('no_invite')?></div></li>");
                            $(".invite-bubble").addClass("disable");
                            $('.flyout-box#invite h6').addClass("disable");
                        }
                    }
                    if (ul.find("li").length == 0) {
                        ul.append("<li class='nodata'><div style='text-align: center'><?=$this->lang->line('no_invite')?></div></li>");
                    }

                } else {
                    var notify = $(".inviter-notify-object").clone();
                    notify.removeClass('disable');
                    notify.removeClass('inviter-notify-object');
                    notify.addClass('inviter-notify');
                    notify.attr("member-id", data[i].member_id);

                    $(".flyout-cnt a", notify).attr("href", "/page/info?i=" + data[i].member_id);

                    if (data[i].avatar == null || data[i].avatar == '' || data[i].avatar == undefined) {
                        $(".flyout-cnt .user-pic-s img", notify).attr("src", "/assets/img/self-user-pic.jpg");
                    }
                    else {
                        $(".flyout-cnt .user-pic-s img", notify).attr("src", data[i].avatar);
                    }

                    $(".pic-s-info h5", notify).html(data[i].nickname);
                    $(".pic-s-info .level", notify).html(data[i].level);

                    if ($("li", ul).length == 0) {
                        ul.append($(notify));
                    } else {
                        $(notify).insertBefore($("li:first", ul));
                    }

                    if ($(".invite-bubble").hasClass("disable")) {
                        $(".invite-bubble").removeClass("disable");
                        $('.flyout-box#invite h6').removeClass("disable");
                        span.html("1");
                    } else if (span.html() != "99+") {
                        var num = parseInt(span.html()) + 1;
                        if (num > 99) {
                            span.html("99+");
                        } else {
                            span.html(num);
                        }
                    }
                    span.attr("total", parseInt(span.attr("total")) + 1);
                }
            }
        }
    });

    function renderLstLeftMsg(chatunit, result) {
        var lclient = $("#" + chatunit).find("[cid=" + result.master + "]");

        if (lclient.length > 0) {
            lclient.find(".msg-txt").html(result.msg != ":)" ? result.msg : ":)");
            lclient.find(".msg-date").html(result.time.substring(0, 11).replace(/\-/g, "/"));

            if (result.master != $("#clientId").val()) {
                var span = lclient.find(".bubble-txt>span");
                var num = parseInt(lclient.attr("num")) + 1;
                lclient.attr("num", num);

                if (num == 1) {
                    lclient.find(".chat-bubble-wrap").removeClass("disable");
                    span.html("1");
                } else if (span.html() != "99+") {
                    if (num > 99) {
                        span.html("99+");
                    } else {
                        span.html(num);
                    }
                }

            }

            if ($(".msg-col:first", "#" + chatunit) != lclient) {
                lclient.insertBefore($(".msg-col:first", "#" + chatunit));
            }
        } else {
            lclient = getlMsg(result);
            lclient.attr("num", "1");
            lclient.find(".chat-bubble-wrap").removeClass("disable");
            lclient.find(".bubble-txt span").html("1");

            if ($(".msg-col", "#" + chatunit).length > 0) {
                lclient.insertBefore($(".msg-col:first", "#" + chatunit));
            } else {
                $("#" + chatunit).append(lclient);
            }

        }
    }

    function loadInviterNotify() {
        ajaxPost("/invite/getMemberByInvitee", {
            "start_row": 0,
            "return_rows": 5
        }, function (response) {
            var length = response.data.length;

            if (length > 0) {
                $("#invite .flyout-cnt-wrap ul li").remove();
            }
            for (var i = 0; i < length; i++) {
                var notify = $(".inviter-notify-object").clone();
                notify.removeClass('disable');
                notify.removeClass('inviter-notify-object');
                notify.addClass('inviter-notify');
                notify.attr("member-id", response.data[i].member_id);

                $(".flyout-cnt a", notify).attr("href", "/page/info?i=" + response.data[i].member_id);

                if (response.data[i].avatar == null || response.data[i].avatar == '' || response.data[i].avatar == undefined) {
                    $(".flyout-cnt .user-pic-s img", notify).attr("src", "/assets/img/self-user-pic.jpg");
                }
                else {
                    $(".flyout-cnt .user-pic-s img", notify).attr("src", response.data[i].avatar);
                }

                $(".pic-s-info h5", notify).html(response.data[i].nickname);
                $(".pic-s-info .level", notify).html(response.data[i].level);

                $("#invite .flyout-cnt-wrap ul").append(notify);
            }

            if (length == 0) {
                $(".invite-bubble").addClass("disable");
                $('.flyout-box#invite h6').addClass("disable");
            }
            else {
                $('.flyout-box#invite h6').removeClass("disable");
                $(".invite-bubble").removeClass("disable");
                $(".invite-bubble .bubble-txt span").html((length > 99) ? "99+" : length);
            }
            $(".invite-bubble .bubble-txt span").attr("total", length);

            InviteNotifyListener();
        });
    }

    function InviteNotifyListener() {

        $("#invite").on("click", ".f-check-btn", function () {
            var self = $(this).attr("disabled", "disabled");
            var removeLi = self.closest(".inviter-notify");
            var inviter_id = removeLi.attr("member-id");

            ajaxPost("/invite/setInviteStatus", {
                "invitee_id": inviter_id,
                "status": "1"
            }, function (response) {
                if (response.status == "success") {
                    delInvite(removeLi);
                }
            });
        });

        $("#invite").on("click", ".f-delete-btn", function () {
            var self = $(this).attr("disabled", "disabled");
            var removeLi = self.closest(".inviter-notify");
            var inviter_id = removeLi.attr("member-id");

            ajaxPost("/invite/setInviteStatus", {
                "invitee_id": inviter_id,
                "status": "0"
            }, function (response) {
                delInvite(removeLi);
            });
        });
    }

    function delInvite(removeLi) {
        removeLi.remove();
        var ul = $("#invite .flyout-cnt-wrap ul");
        var span = $(".invite-bubble .bubble-txt span");
        var total = parseInt(span.attr("total")) - 1;
        span.attr("total", total);

        if (total < 100) {
            span.html(total);
        }
        if (ul.find("li").length == 0) {
            ul.append("<li class='nodata'><div style='text-align: center'>" + descriArr["no_invite"] + "</div></li>");
            $(".invite-bubble").addClass("disable");
            $('.flyout-box#invite h6').addClass("disable");
        }
    }

    function loadNormalNotify() {

        ajaxPost("/page/getNotifies", {}, function (response) {
            //console.log(response);
            var length = response.data.length;
            var unread_count = 0;
            $('.flyout-box#notify h6').addClass("disable");
            if (length > 0) {
                $('.flyout-box#notify h6').removeClass("disable");
                $("#notify .flyout-cnt-wrap ul li").remove();
                $("#notify").removeClass("disable");
            }
            for (var i = 0; i < length; i++) {
                var notify = $(".notify-item-object").clone();
                notify.removeClass("disable");
                notify.removeClass("notify-item-object");
                notify.addClass("notify-item");
                $(".notify-time", notify).html(response.data[i].createTime);
                // $(".flyout-cnt a", notify).attr('href', "/page/main?post_id=" + response.data[i].post_id);
                $(".flyout-cnt a", notify).attr('href', response.data[i].target_path);

                if (response.data[i].avatar == null || response.data[i].avatar == '' || response.data[i].avatar == undefined) {
                    $(".user-pic-s img", notify).attr("src", "/assets/img/self-user-pic.jpg");
                }
                else {
                    $(".user-pic-s img", notify).attr("src", response.data[i].avatar);
                }

                $(".pic-s-info h5", notify).html(response.data[i].nickname);

                switch(response.data[i].text){
                    case "Tag": response.data[i].text = "<?php echo $this->lang->line('has-tag-you');?>"; break;
                    case "Comment": response.data[i].text = "<?php echo $this->lang->line('has-comment');?>"; break;
                    case "Wall": response.data[i].text = "<?php echo $this->lang->line('has-post-on');?>"; break;
                    case "Thumb": response.data[i].text = "<?php echo $this->lang->line('has-thumb-on-post');?>"; break;
                    default: break;
                }
                $(".pic-s-info .f-group-cnt", notify).html(response.data[i].text);
                $("#notify .flyout-cnt-wrap ul").append(notify);

                unread_count += (response.data[i].is_read == 0) ? 1 : 0;
            }

            if (unread_count == 0) {
                $(".notify-bubble").addClass("disable");
            }
            else {
                $(".notify-bubble").removeClass("disable");
                $(".notify-bubble .bubble-txt span").html((unread_count > 99) ? "99+" : unread_count);
            }

            notifyListener();
        });

    }

    function notifyListener() {
        // return;
        // $(".notify").unbind("click");
        $(".notify").click(function () {

            ajaxPost("/page/readNotifies", {}, function (response) {
                if (response.status == "success") {
                    $(".notify-bubble").addClass("disable");
                }
            });

        });
    }

    function loadMessageNotify() {
        ajaxPost("/chat_pop/getChat", {}, function (response) {
            //console.log(response);
            var length = response.result.length;
            var unread_count = 0;
            $('.flyout-box#message h6').addClass("disable");
            if (length > 0) {
                $('.flyout-box#message h6').removeClass("disable");
                $("#message .flyout-cnt-wrap ul li").remove();
                $("#message").removeClass("disable");
            }

            for (var i = 0; i < length; i++) {
                var img = "";
                if (response.result[i].avatar == null || response.result[i].avatar == '' || response.result[i].avatar == undefined) {
                    img = "/assets/img/self-user-pic.jpg";
                }
                else {
                    img = response.result[i].avatar;
                }
                if (response.result[i].is_read == 0) {
                    var li = " <li class='message-item' num='" + response.result[i].count + "' mid='" + response.result[i].master + "'>\n" +
                        "                                <div class=\"flyout-dot\"><a></a></div>\n" +
                        "                                <div class=\"flyout-cnt\">\n" +
                        "                                    <a href=\"../../../chat/" + response.result[i].master + "\">\n" +
                        "                                        <div class=\"user-pic-s\">\n" +
                        "                                           <div class=\"bubble-wrap active\">\n" +
                        "                                                <p class=\"bubble-txt\"><span>" + response.result[i].count + "</span></p>\n" +
                        "                                            </div>" +
                        "                                            <img src=\"" + img + "\" onerror=\"this.src='/assets/img/self-user-pic.jpg'\">\n" +
                        "                                        </div>\n" +
                        "                                        <div class=\"pic-s-info\">\n" +
                        "                                            <h5>" + response.result[i].nickname + "</h5>\n" +
                        "                                            <h6 class=\"f-group-cnt\">" + response.result[i].msg + "</h6>\n" +
                        "                                        </div>\n" +
                        "                                    </a>\n" +
                        "                                </div>\n" +
                        "                            </li>";

                    unread_count += parseInt(response.result[i].count);
                } else if (response.result[i].is_read == 1) {
                    var li = " <li class='message-item' num='0' mid='" + response.result[i].master + "'>\n" +
                        "                                <div class=\"flyout-cnt\">\n" +
                        "                                    <a href=\"../../../chat/" + response.result[i].master + "\">\n" +
                        "                                        <div class=\"user-pic-s\">\n" +
                        "                                           <div class=\"bubble-wrap disable\">\n" +
                        "                                                <p class=\"bubble-txt\"><span>" + response.result[i].count + "</span></p>\n" +
                        "                                            </div>" +
                        "                                            <img src=\"" + img + "\" onerror=\"this.src='/assets/img/self-user-pic.jpg'\">\n" +
                        "                                        </div>\n" +
                        "                                        <div class=\"pic-s-info\">\n" +
                        "                                            <h5>" + response.result[i].nickname + "</h5>\n" +
                        "                                            <h6 class=\"f-group-cnt\">" + response.result[i].msg + "</h6>\n" +
                        "                                        </div>\n" +
                        "                                    </a>\n" +
                        "                                </div>\n" +
                        "                            </li>";
                }

                $("#message .flyout-cnt-wrap ul").append(li);
            }

            if (unread_count == 0) {
                $(".message-bubble").addClass("disable");
            }
            else {
                $(".message-bubble").removeClass("disable");
                $(".message-bubble .bubble-txt span").html((unread_count > 99) ? "99+" : unread_count);
            }
        });
    }
</script>
<!--<script>try{Typekit.load({ async: true });}catch(e){}</script>-->
<script>
    //開關通知
    $(document).ready(function () {
        $('.m-search-area').hide();
        $('.flyout-box').hide();
        $('.search').click(function () {
            $('.flyout-box#invite').hide();
            $('.flyout-box#notify').hide();
            $('.flyout-box#message').hide();
            $('.flyout-box#dropdown').hide();
            $('.m-search-area').slideToggle(300);
            return false;
        });
        $('.invite').click(function () {
            $('.m-search-area').hide();
            $('.flyout-box#notify').hide();
            $('.flyout-box#message').hide();
            $('.flyout-box#dropdown').hide();
            $('.flyout-box#invite').removeClass("disable");

            if ($(".flyout-box#invite li").length == 0) {
                $('.flyout-box#invite ul').append("<li class='nodata'><div style='text-align: center'><?=$this->lang->line('no_invite')?></div></li>");
            }

            $('.flyout-box#invite').slideToggle(300);
            return false;
        });
        $('.notify').click(function () {
            $('.m-search-area').hide();
            $('.flyout-box#invite').hide();
            $('.flyout-box#message').hide();
            $('.flyout-box#dropdown').hide();

            if ($(".flyout-box#notify li").length == 0) {
                $('.flyout-box#notify').removeClass("disable");
                $('.flyout-box#notify ul').append("<li class='nodata'><div style='text-align: center'><?=$this->lang->line('no_notice')?></div></li>");

            }
            $('.flyout-box#notify').slideToggle(300);
            return false;
        });
        $('.message').click(function () {
            $('.m-search-area').hide();
            $('.flyout-box#invite').hide();
            $('.flyout-box#notify').hide();
            $('.flyout-box#dropdown').hide();

            if ($(".flyout-box#message li").length == 0) {
                $('.flyout-box#message').removeClass("disable");
                $('.flyout-box#message ul').append("<li class='nodata'><div style='text-align: center'><?=$this->lang->line('no_message')?></div></li>");

            }
            $('.flyout-box#message').slideToggle(300);
            return false;
        });
        $('.self-dropdown-img').click(function () {
            $('.m-search-area').hide();
            $('.flyout-box#invite').hide();
            $('.flyout-box#notify').hide();
            $('.flyout-box#message').hide();
            $('.flyout-box#dropdown').slideDown(300);
            // $('.flyout-box#dropdown').slideToggle(300);
            return false;
        });
        return false;
    });

    //收合邀請/通知/訊息
    $(document).click(function () {
        $('.flyout-box').slideUp(300);
    });
    $("#invite").on("click", ".flyout-cnt-wrap", function (event) {
        event.stopPropagation();
    })

</script>
