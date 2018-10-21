<!--20180312 add--> 
<link rel="stylesheet" type="text/css" href="/assets/iami_chatroom/css/style-m.css">
  <!--fixMenu-->
  <div class="fixMenu">
    <ul class="fixMenu-cnt">
      <li> <a href="index.html">
        <div class="index"><img src="../../assets/iami_chatroom/img/svg_icon-44.svg"></div>
        <h7>首頁</h7>
        </a> </li>
      <li> <a href="invite.html">
        <div class="bubble-wrap">
          <p class="bubble-txt"><span>99+</span></p>
        </div>
        <div><img src="../../assets/iami_chatroom/img/svg_icon-03.svg"></div>
        <h7>邀請</h7>
        </a> </li>
      <li><a href="notice.html" >
        <div class="bubble-wrap">
          <p class="bubble-txt"><span>99+</span></p>
        </div>
        <div><img src="../../assets/iami_chatroom/img/svg_icon-07.svg"></div>
        <h7>通知</h7>
        </a></li>
      <li><a href="message.html" >
        <div class="bubble-wrap">
          <p class="bubble-txt"><span>99+</span></p>
        </div>
        <div><img src="../../assets/iami_chatroom/img/svg_icon-06.svg"></div>
        <h7>訊息</h7>
        </a></li>
      <li> <a href="info.html">
        <div> <img class="self-pic-m" src="../../assets/iami_chatroom/img/userpic-self.jpg"> </div>
        <h7>主頁</h7>
        </a> </li>
    </ul>
  </div>
  
  <!--header-m-->
  <div class="header-m">
    <div class="header-container-m clearfix"> 
      <!--header-left-->
      <div class="header-left-m"> <a href="#" class="live-icon-m"><img src="img/icon-live-white.svg"></a> <a href="video-show.html" class="video-icon-m" ><img src="img/header-icon-5sVideo-white.svg"></a> </div>
      
      <!--header-middle-->
      <div class="header-middle-m"> <a href="index.html" class="header-logo-m"><img src="img/iami-logo-login.svg"></a> </div>
      
      <!--header-right-->
      <div class="header-right-m"> <a class="search"><img src="img/icon-search-white-b.svg"></a> 
        
        <!--mobile-ham-btn-->
        <div class="m-header-menu mobile"><a id="menu-trigger" href="#"><span class="menu-icon"></span></a></div>
      </div>
    </div>
    <div class="m-search-area"> <a class="m-search-btn"></a>
      <input type="text" placeholder="在iami搜尋">
    </div>
  </div>
  
  <!--subHeader-m-->
  <div class="subHeader-m">
    <ul>
      <li><a href="hot-post.html" class="active">熱門話題</a></li>
      <li><a href="hot-video.html">熱門視頻</a></li>
      <li><a href="#">abcde</a></li>
      <li><a href="#">123456</a></li>
      <li><a href="#">淒淒魯加巧克力</a></li>
      <li><a href="#">熱門時段</a></li>
      <li><a href="#">bbbbbb</a></li>
      <li><a href="#">yyyyyy</a></li>
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
                <div class="video-ac-area" style="display: none">
                    <a href="/page/videoshow">
                        <span class="video-icon">
                            <img src="/assets/img/5s-video-icon.svg">
                        </span>
                        <span class="video-txt"><?=$this->lang->line('top_video_zone')?></span>
                    </a>
                </div>
            </div>
            <!--header-middle-->
            <div class="header-middle">
                <div class="header-search">
                    <a></a>
                    <input type="text" name="main_search" placeholder="<?=$this->lang->line('top_search')?>">
                    <!--
                    <button><img src="/assets/img/svg_icon-01.svg"></button>
                    -->
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
                                <span><?=$this->lang->line('top_invite')?></span>
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
                                <span><?=$this->lang->line('top_notice')?></span>
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
                                <span><?=$this->lang->line('top_message')?></span>
                            </div>
                        </a>
                    </li>
                </ul>
                <!--頭像及匿稱-->
                <ul class="self-dropdown">
                    <li class="self-dropdown-img">
                        <img src="<?=$this->session->userdata("avatar")?>" onerror="this.src='/assets/img/self-user-pic.jpg'">
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
                    <!--
                    <h6><a href="#">顯示全部</a></h6>
                    -->
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
                    <!--
                    <h6><a href="notice.html">顯示全部</a></h6>
                    -->
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
<!--                    <h6><a href="message.html">顯示全部</a></h6>-->
                </div>

                <!--self-dropdown-內容-->
                <div class="flyout-box" id="dropdown">
                    <div class="flyout-triangle">
                        <span class="bot"></span>
                        <span class="top"></span>
                    </div>
                    <div class="flyout-drop-cnt">
                        <ul>
	                        <li class="self-dropdown-cnt">
                        <a href="/page/info">
                            <h5><?= $this->session->userdata("nickname") ?></h5>
                        </a>
                    </li>
                            <li class="i-money h6">
                                <a><img src="/assets/img/money-icon.png"></a>:<span><?= number_format($this->session->userdata('balance')) ?></span>
                                <div class="btn-gold-gra i-money-btn"><?=$this->lang->line('menu_deposit')?></div>
                            </li>

                            <li><a href="/page/media"><?=$this->lang->line('menu_media')?></a></li>
                            <li><a href="/chat"><?=$this->lang->line('menu_message')?></a></li>
                            <li><a href="/page/info/friend_list"><?=$this->lang->line('menu_friend')?></a></li>
                            <li><a href="/page/info/collection_list"><?=$this->lang->line('menu_collection')?></a></li>
                            <li><a href="/page/info/edit"><?=$this->lang->line('menu_edit_member')?></a></li>
                            <li><a class="modify-ps"><?=$this->lang->line('menu_change_password')?></a></li>
                            <li><a href="/member/showPrivacy"><?=$this->lang->line('menu_privacy')?></a></li>
                            <li><a href="/member/showService"><?=$this->lang->line('menu_service')?></a></li>
                        </ul>
                        <button onclick="location.href='/member/doLogout'"><?=$this->lang->line('member_btn_logout')?></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-search-area">
            <a class="m-search-btn"></a>
            <input type="text" id="mobile_search" name="mobile_search" placeholder="<?=$this->lang->line('top_search')?>">
        </div>
    </div>
</div>

<!--<script src="/assets/js/sfs2zji.js"></script>-->
<script src="https://use.typekit.net/sfs2zji.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
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
            $('.m-search-area').slideToggle(500);
            return false;
        });
        $('.invite').click(function () {
            $('.m-search-area').hide();
            $('.flyout-box#notify').hide();
            $('.flyout-box#message').hide();
            $('.flyout-box#dropdown').hide();
            if($(".flyout-box#invite li").length==0){
                $('.flyout-box#invite').removeClass("disable");
                $('.flyout-box#invite ul').append("<li><div style='text-align: center'>目前沒有邀請</div></li>");
            }
            $('.flyout-box#invite').slideToggle(500);
            return false;
        });
        $('.notify').click(function () {
            $('.m-search-area').hide();
            $('.flyout-box#invite').hide();
            $('.flyout-box#message').hide();
            $('.flyout-box#dropdown').hide();
            if($(".flyout-box#notify li").length==0){
                $('.flyout-box#notify').removeClass("disable");
                $('.flyout-box#notify ul').append("<li><div style='text-align: center'>目前沒有通知</div></li>");
            }
            $('.flyout-box#notify').slideToggle(500);
            return false;
        });
        $('.message').click(function () {
            $('.m-search-area').hide();
            $('.flyout-box#invite').hide();
            $('.flyout-box#notify').hide();
            $('.flyout-box#dropdown').hide();
            if($(".flyout-box#message li").length==0){
                $('.flyout-box#message').removeClass("disable");
                $('.flyout-box#message ul').append("<li><div style='text-align: center'>目前沒有訊息</div></li>");
            }
            $('.flyout-box#message').slideToggle(500);
            return false;
        });
        $('.self-dropdown-img').click(function () {
            $('.m-search-area').hide();
            $('.flyout-box#invite').hide();
            $('.flyout-box#notify').hide();
            $('.flyout-box#message').hide();
            $('.flyout-box#dropdown').slideDown(500);
            // $('.flyout-box#dropdown').slideToggle(500);
            return false;
        });
        return false;
    });

    //收合邀請/通知/訊息
    $(document).click(function () {

        $('.flyout-box').slideUp(500);
        // $('.m-search-area').slideUp(500);
    });

</script>
