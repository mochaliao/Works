
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="/assets/img/iami-logo-icon.png">
    <title><?=SITE_NAME?></title>
    <!--20180201-->
    <link rel="stylesheet" href="/assets/css/common.css">
    <link rel="stylesheet" href="/assets/css/self-page.css">
    <link rel="stylesheet" href="/assets/css/message.css">
  <link rel="stylesheet" href="/assets/css/reg-page.css?v=<?php echo getVersion(); ?>">
    <link rel="stylesheet" href="/assets/css/share.css">
    <link rel="stylesheet" href="/assets/css/w3.css">
    <link rel="stylesheet" href="/assets/css/dist/build.css" />
    <link rel="stylesheet" href="/assets/css/dist/font-awesome.css" /> <!-- 一起聊天的tick用 -->
    <script src="/assets/jquery-ui-1.12.1/external/jquery/jquery.js"></script>
    <script src="/assets/bootstrap-3.3.4/dist/js/bootstrap.min.js"></script>
    <style>
        html, body {height: 100%; overflow: auto; }
        body {margin: 0; }
        /* 去除設置div 高度100% 浏覽器右側產生滾動條 */
    </style>
    <!--****20180201****-->
</head>

<body>
    <!--<div class="wrapper">20180131-->
    <?php require_once(dirname(__FILE__) . "/includes/include.php"); ?>
    <?php echo form_open('', array('class' => 'post-form', 'id' => 'post-form')); ?>
    <input type="hidden" name="member_id" value="<?= $member_id ?>"/>
    </form>

    <!--header-->
    <?php require_once(dirname(__FILE__) . "/includes/top.php"); ?>
    <!--****-->
    <!--Inner Content-->
    <!-- ********** 0201 class拿掉 main-content **********-->
    <div class="message-wrapper-col">
        <!-- /0201 拿掉 main-content-->
        <div class="msg-left fullbox">
            <h3 class="msg-title" style="float:left">Message</h3>
            <div style="display:block; float:right">
            <!--popup new chat-->
            <button class="trigger triggerbtn"></button>
            <!--找人聊天按鈕-->
            <!--創立新聊天POPUP視窗-->
            <div class="modal">
                <div class="modal-content">
                    <span class="close-button">×</span>
                    <!--新聊天POPUP視窗頁籤-->
                    <div class="w3-bar w3-grey">
                        <button class="w3-bar-item w3-button tablink w3-red" onclick="openCity(event,'London')"><img src="/assets/img/talk01.png">找人聊天</button>
                        <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'Paris')"><img src="/assets/img/talk02.png">一起聊天</button>
                    </div>
                    <!--找人聊天-->
                    <div id="London" class="w3-container w3-border city">
                    <!--0201 modify-->
                    <div class="header-search" style="margin-top:10px"> <a></a>
                        <input type="text" placeholder="在iami搜尋要加入的人">
                    </div>
                    <!--/0201 modify-->
                    <hr class="main-hr">
                    <!--找人聊天 左側 好友列表 一側最多六個-->
                    <div class="fnd-left">
                        <!--第1好友-->
                        <div class="look4fnds">
                            <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
                            <p class="msg-name">霹靂可愛萌萌噠</p>
                        </div>
                        <!--第2個好友-->
                        <div class="look4fnds">
                            <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
                            <p class="msg-name">霹靂可愛萌萌噠</p>
                        </div>
                        <!--第3個好友-->
                        <div class="look4fnds">
                            <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
                            <p class="msg-name">霹靂可愛萌萌噠</p>
                        </div>
                        <!--第4個好友-->
                        <div class="look4fnds">
                            <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
                            <p class="msg-name">霹靂可愛萌萌噠</p>
                        </div>
                        <!--第5個好友-->
                        <div class="look4fnds">
                            <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
                            <p class="msg-name">霹靂可愛萌萌噠</p>
                        </div>
                        <!--第6個好友-->
                        <div class="look4fnds">
                            <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
                            <p class="msg-name">霹靂可愛萌萌噠</p>
                        </div>
                    </div>
                    <!--找人聊天 右側 好友列表 一側最多六個-->
                    <div class="fnd-right">
                        <!--第1個好友-->
                        <div class="look4fnds highlighted">
                            <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
                            <p class="msg-name">霹靂可愛萌萌噠</p>
                        </div>
                        <!--第2個好友-->
                        <div class="look4fnds">
                            <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
                            <p class="msg-name">霹靂可愛萌萌噠</p>
                        </div>
                        <!--第3個好友-->
                        <div class="look4fnds">
                            <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
                            <p class="msg-name">霹靂可愛萌萌噠</p>
                        </div>
                        <!--第4個好友-->
                        <div class="look4fnds">
                            <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
                            <p class="msg-name">霹靂可愛萌萌噠</p>
                        </div>
                        <!--第5個好友-->
                        <div class="look4fnds">
                            <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
                            <p class="msg-name">霹靂可愛萌萌噠</p>
                        </div>
                        <!--第6個好友-->
                        <div class="look4fnds">
                            <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
                            <p class="msg-name">霹靂可愛萌萌噠</p>
                        </div>
                    </div>
                    <div style="clear:both"></div>
                    <div>
                        <hr class="main-hr" />
                    </div>
                    <div class="chatbox-icon-g icon-pofix"><a class="newchat-send-btn"><?php echo $this->lang->line('start-chat');?></a> </div>
                </div>
                    <!--一起聊天-->
                    <div id="Paris" class="w3-container w3-border city" style="display:none">
                        <div style="display:flex;">
                            <a class="add-btn"></a>
                            <div class="form-group">
                                <label for="usr"></label>
                                <input type="text" class="form-control no-border" id="usr" placeholder="為您的群組取名">
                            </div>
                        </div>
                        <hr class="main-hr">
                        <div class="chat-fnd-left">
                            <!--0201 modify-->
                            <div class="header-search"> <a></a>
                                <input type="text" placeholder="在iami搜尋">
                            </div>
                            <!--/0201 modify-->
                            <div class="checkbox checkbox-info checkbox-circle checkbox-fix">
                                <input id="checkbox1" class="styled" type="checkbox">
                                <label for="checkbox1">
                                    <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
                                    <p class="msg-name">霹靂可愛萌萌噠</p>
                                </label>
                            </div>
                            <div class="checkbox checkbox-info checkbox-circle checkbox-fix">
                                <input id="checkbox2" class="styled" type="checkbox">
                                <label for="checkbox2">
                                    <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
                                    <p class="msg-name">霹靂可愛萌萌噠</p>
                                </label>
                            </div>
                            <div class="checkbox checkbox-info checkbox-circle checkbox-fix">
                                <input id="checkbox3" class="styled" type="checkbox">
                                <label for="checkbox3">
                                    <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
                                    <p class="msg-name">霹靂可愛萌萌噠</p>
                                </label>
                            </div>
                            <div class="checkbox checkbox-info checkbox-circle checkbox-fix">
                                <input id="checkbox4" class="styled" type="checkbox">
                                <label for="checkbox4">
                                    <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
                                    <p class="msg-name">霹靂可愛萌萌噠</p>
                                </label>
                            </div>
                            <div class="checkbox checkbox-info checkbox-circle checkbox-fix">
                                <input id="checkbox5" class="styled" type="checkbox">
                                <label for="checkbox5">
                                    <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
                                    <p class="msg-name">霹靂可愛萌萌噠</p>
                                </label>
                            </div>
                        </div>
                        <div class="chat-fnd-right">
                            <div class="fnd-picked">
                                已選擇：<p>1</p>
                            </div>
                            <div class="pickedfnds">
                                <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
                                <p class="msg-name">霹靂可愛萌萌噠</p>
                            </div>
                        </div>
                        <div style="clear:both"></div>
                        <div>
                            <hr class="main-hr" />
                        </div>
                        <div class="chatbox-icon-g icon-pofix" style="text-align: center"><a class="newchat-send-btn"><?php echo $this->lang->line('start-chat');?></a> </div>
                    </div>
                </div>
                <!--/model content-->
            </div>
        </div>
          <!-- /popup new chat-->
          <div style="clear:both;margin-bottom:10px;"></div>
          <!--單則訊息-->
          <div class="msg-col">
            <div class="lefta">
              <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
            </div>
            <div class="leftb">
              <p class="msg-name">霹靂可愛萌萌噠</p>
              <p class="medal"><a class="medalsvg"></a></p>
              <p class="lvl">lv.1</p>
              <p class="msg-date">11:11</p>
              <div class="msg-txt unread">哈哈哈 不行拉 我覺得這樣太害羞了太害羞了</div>
            </div>
          </div>
          <div class="msg-col">
            <div class="lefta">
              <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
            </div>
            <div class="leftb">
              <p class="msg-name">霹靂可愛萌萌噠</p>
              <p class="medal"><a class="medalsvg"></a></p>
              <p class="lvl">lv.1</p>
              <p class="msg-date">11:11</p>
              <div class="msg-txt">哈哈哈 不行拉 我覺得這樣太害羞了太害羞了</div>
            </div>
          </div>
          <div class="msg-col">
            <div class="lefta">
              <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
            </div>
            <div class="leftb">
              <p class="msg-name">霹靂可愛萌萌噠</p>
              <p class="medal"><a class="medalsvg"></a></p>
              <p class="lvl">lv.1</p>
              <p class="msg-date">11:11</p>
              <div class="msg-txt">哈哈哈 不行拉 我覺得這樣太害羞了太害羞了</div>
            </div>
          </div>
          <div class="msg-col">
            <div class="lefta">
              <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
            </div>
            <div class="leftb">
              <p class="msg-name">霹靂可愛萌萌噠</p>
              <p class="medal"><a class="medalsvg"></a></p>
              <p class="lvl">lv.1</p>
              <p class="msg-date">11:11</p>
              <div class="msg-txt">哈哈哈 不行拉 我覺得這樣太害羞了太害羞了</div>
            </div>
          </div>
          <div class="msg-col">
            <div class="lefta">
              <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
            </div>
            <div class="leftb">
              <p class="msg-name">霹靂可愛萌萌噠</p>
              <p class="medal"><a class="medalsvg"></a></p>
              <p class="lvl">lv.1</p>
              <p class="msg-date">11:11</p>
              <div class="msg-txt">哈哈哈 不行拉 我覺得這樣太害羞了太害羞了</div>
            </div>
          </div>
          <div class="msg-col">
            <div class="lefta">
              <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
            </div>
            <div class="leftb">
              <p class="msg-name">霹靂可愛萌萌噠</p>
              <p class="medal"><a class="medalsvg"></a></p>
              <p class="lvl">lv.1</p>
              <p class="msg-date">11:11</p>
              <div class="msg-txt">哈哈哈 不行拉 我覺得這樣太害羞了太害羞了</div>
            </div>
          </div>
          <div class="msg-col">
            <div class="lefta">
              <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
            </div>
            <div class="leftb">
              <p class="msg-name">霹靂可愛萌萌噠</p>
              <p class="medal"><a class="medalsvg"></a></p>
              <p class="lvl">lv.1</p>
              <p class="msg-date">11:11</p>
              <div class="msg-txt">哈哈哈 不行拉 我覺得這樣太害羞了太害羞了</div>
            </div>
          </div>
          <div class="msg-col">
            <div class="lefta">
              <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
            </div>
            <div class="leftb">
              <p class="msg-name">霹靂可愛萌萌噠</p>
              <p class="medal"><a class="medalsvg"></a></p>
              <p class="lvl">lv.1</p>
              <p class="msg-date">11:11</p>
              <div class="msg-txt">哈哈哈 不行拉 我覺得這樣太害羞了太害羞了</div>
            </div>
          </div>
          <div class="msg-col">
            <div class="lefta">
              <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
            </div>
            <div class="leftb">
              <p class="msg-name">霹靂可愛萌萌噠</p>
              <p class="medal"><a class="medalsvg"></a></p>
              <p class="lvl">lv.1</p>
              <p class="msg-date">11:11</p>
              <div class="msg-txt">哈哈哈 不行拉 我覺得這樣太害羞了太害羞了</div>
            </div>
          </div>
          <div class="msg-col">
            <div class="lefta">
              <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
            </div>
            <div class="leftb">
              <p class="msg-name">霹靂可愛萌萌噠</p>
              <p class="medal"><a class="medalsvg"></a></p>
              <p class="lvl">lv.1</p>
              <p class="msg-date">11:11</p>
              <div class="msg-txt">哈哈哈 不行拉 我覺得這樣太害羞了太害羞了</div>
            </div>
          </div>
          <div class="msg-col">
            <div class="lefta">
              <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
            </div>
            <div class="leftb">
              <p class="msg-name">霹靂可愛萌萌噠</p>
              <p class="medal"><a class="medalsvg"></a></p>
              <p class="lvl">lv.1</p>
              <p class="msg-date">11:11</p>
              <div class="msg-txt">哈哈哈 不行拉 我覺得這樣太害羞了太害羞了</div>
            </div>
          </div>
          <div class="msg-col">
            <div class="lefta">
              <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
            </div>
            <div class="leftb">
              <p class="msg-name">霹靂可愛萌萌噠</p>
              <p class="medal"><a class="medalsvg"></a></p>
              <p class="lvl">lv.1</p>
              <p class="msg-date">11:11</p>
              <div class="msg-txt">哈哈哈 不行拉 我覺得這樣太害羞了太害羞了</div>
            </div>
          </div>
    </div>

        <!--msg-center-->
        <div class="msg-center divfull">
            <div class="chat-col">
            <div class="clefta">
                <p class="chat-head"><img src="/assets/img/head-img2.jpg" alt="大頭像"></p>
            </div>
            <div class="cleftb">
                <p class="chat-name">我是李四端盤子</p>
                <p class="medal"><a class="medalsvg"></a></p>
                <p class="clvl">lv.1</p>
                <div class="chat-span">你們是iami上面的好友</div>
                <div class="chat-txt">李四端是全方位媒體人 但他最喜歡的稱呼是... 「說故事的新聞人」</div>
            </div>
        </div>
            <div class="chatbox">
            <div class="chat-ppla chata"><img src="/assets/img/head-img2.jpg" class="chata">
                <div class="chat-contenta chata">嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨！我就是喜歡嗨！</div>
            </div>
            <div class="chat-pplb chatb"><img src="/assets/img/head-img.jpg" class="chatb">
                <div class="chat-contentb chatb">嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨！！！！我也是喜歡嗨～～～</div>
            </div>
            <div class="chat-ppla chata"><img src="/assets/img/head-img2.jpg" class="chata">
                <div class="chat-contenta chata">我的自拍帥不帥！！？？</div>
            </div>
            <div class="chat-ppla chata"><img src="/assets/img/head-img2.jpg" class="chata">
                <div class="chat-contenta chata chatfix"><img src="/assets/img/chat-img.jpg"></div>
            </div>
            <div class="chat-pplb chatb"><img src="/assets/img/head-img.jpg" class="chatb">
                <div class="chat-contentb chatb">帥帥帥帥帥帥帥帥帥帥帥</div>
            </div>
            <div class="chat-ppla chata"><img src="/assets/img/head-img2.jpg" class="chata">
                <div class="chat-contenta chata">我也覺得很帥～就是帥就是帥就是帥就是帥就是帥就是帥</div>
            </div>
            <div class="chat-pplb chatb"><img src="/assets/img/head-img.jpg" class="chatb">
                <div class="chat-contentb chatb">：）））））））））</div>
            </div>
            <div class="chat-pplb chatb"><img src="/assets/img/head-img.jpg" class="chatb">
                <div class="chat-contentb chatb">嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖</div>
            </div>
        </div>
            <!--/chatbox-->
            <div class="replybox">
                <!--reply box-->
                <div class="box-wrap">
                <textarea placeholder="輸入訊息" class="textbox-type2 textareabox"></textarea>
                <div class="feed-top-tool textoolbox">
                    <div class="chatbox-icon-g icon-pofix">
                        <a href="#" class="photo chatbox-iconsz"></a> <a href="#" class="video chatbox-iconsz"></a>
                        <!--20180131 <a href="#" class="tag chatbox-iconsz"></a>  --><a href="#" class="msgface chatbox-iconsz"></a> <a class="msg-btn">發送</a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    <!--/cnt-center-->
    </div>
    <!--/inner content-->

    <!--mobile nav-->
    <?php require_once(dirname(__FILE__) . "/includes/m_nav.php"); ?>

    <!-- Chat POPUP -->
    <div class="popup-box-more">
        <div class="popup-box chat-popup" id="qnimate">
            <div class="popup-head">
                <div class="popup-head-left pull-left">周華健</div>
                <div class="popup-head-right pull-right">
                    <button data-widget="remove" id="removeClass" class="chat-header-button pull-right" type="button"> <img src="/assets/img/cross.png"> </button>
                </div>
            </div>
            <div class="popup-messages">
                <div class="direct-chat-messages">
                    <div class="chat-box-single-line">
                        <abbr class="timestamp">October 8th, 2015</abbr>
                    </div>
                    <!-- Message. Default to the left -->
                    <div class="chatbox">
                        <div class="chat-ppla chata">
                            <img src="/assets/img/head-img2.jpg" class="chata">
                            <div class="chat-popup-contenta chata">嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨！我就是喜歡嗨！</div>
                            <div class="chat-a-time">11:11</div>
                        </div>
                        <!-- /.direct-chat-msg -->
                        <div class="chat-box-single-line" style="clear:both">
                            <abbr class="timestamp">October 9th, 2015</abbr>
                        </div>
                        <!-- Message. Default to the left -->
                        <div class="chat-pplb chatb">
                            <div class="chat-popup-contentb chatb">嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨！！！！我也是喜歡嗨～～～</div>
                            <div class="chat-b-time">11:11</div>
                        </div>
                        <div class="chat-ppla chata"><img src="/assets/img/head-img2.jpg" class="chata">
                            <div class="chat-popup-contenta chata">我的自拍帥吧！</div>
                            <div class="chat-a-time">11:11</div>
                        </div>
                        <div class="chat-ppla chata">
                            <img src="/assets/img/head-img2.jpg" class="chata">
                            <div class="chat-popup-contenta chata chatfix">
                                <img src="/assets/img/chat-img.jpg">
                            </div>
                            <div class="chat-a-time">11:11</div>
                        </div>
                        <div class="chat-pplb chatb">
                            <div class="chat-popup-contentb chatb chatfix"><img src="/assets/img/show-img.jpg"></div>
                            <div class="chat-b-time">11:11</div>
                        </div>
                        <div class="chat-pplb chatb">
                            <div class="chat-popup-contentb chatb">我的才好看，好嗎？！</div>
                            <div class="chat-b-time">11:11</div>
                        </div>
                        <!-- /.direct-chat-msg -->
                    </div>
                </div>
            </div>
            <div class="popup-messages-footer">
                <div class="replybox">
                    <!--reply box-->
                    <div class="box-wrap">
                        <textarea placeholder="輸入訊息" class="textbox-type2 popup-textareabox"></textarea>
                        <div class="feed-top-tool popup-textoolbox">
                            <div class="popupbox-icon-g icon-pofix">
                                <a href="#" class="photo popupbox-iconsz"></a>
                                <a href="#" class="video popupbox-iconsz"></a>
                                <a href="#" class="msgface popupbox-iconsz"></a>
                                <a class="popup-send">傳送</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--</div>20180131-->
    <!--0201-->
    <script src="/assets/jquery-ui-1.12.1/external/jquery/jquery.js"></script>
    <script src="/assets/js/mMenu.js"></script>

    <!--For navigation-->
    <script>
        //切換貼文、粉絲、追蹤
        $(document).ready(function() {
            $('.edit-post').click(function() {
                $('.edit-cnt li.active').removeClass('active');
                $('.edit-post').addClass('active');
                $('#post').addClass('active');
                $('#fans.active').removeClass('active');
                $('#follower.active').removeClass('active');
            });
        });

        $(document).ready(function() {
            $('.edit-fans').click(function() {
                $('.edit-cnt li.active').removeClass('active');
                $('.edit-fans').addClass('active');
                $('#fans').addClass('active');
                $('#post.active').removeClass('active');
                $('#follower.active').removeClass('active');
            });
        });

        $(document).ready(function() {
            $('.edit-follower').click(function() {
                $('.edit-cnt li.active').removeClass('active');
                $('.edit-follower').addClass('active');
                $('#follower').addClass('active');
                $('#post.active').removeClass('active');
                $('#fans.active').removeClass('active');
            });
        });

        //開關貼文訊息
        $(document).ready(function() {
            $('.items-dropdown-wrap#mes1').hide();
            $('.tool-message#mes1').click(function() {
                $('.items-dropdown-wrap#mes1').slideToggle(500);
                return false;
            });
        });

        $(document).ready(function() {
            $('.items-dropdown-wrap#mes2').hide();
            $('.tool-message#mes2').click(function() {
                $('.items-dropdown-wrap#mes2').slideToggle(500);
                return false;
            });
        });
    </script>

    <!--Tabs-->
    <script>
        function openCity(cityName) {
            var i;
            var x = document.getElementsByClassName("city");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            document.getElementById(cityName).style.display = "block";
        }
    </script>

    <!--新增聊天視窗內-->
    <script>
        var modal = document.querySelector(".modal");
        var trigger = document.querySelector(".trigger");
        var closeButton = document.querySelector(".close-button");

        function toggleModal() {
            modal.classList.toggle("show-modal");
        }

        function windowOnClick(event) {
            if (event.target === modal) {
                toggleModal();
            }
        }

        trigger.addEventListener("click", toggleModal);
        closeButton.addEventListener("click", toggleModal);
        window.addEventListener("click", windowOnClick);
    </script>

    <script>
        function openCity(evt, cityName) {
            var i, x, tablinks;
            x = document.getElementsByClassName("city");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < x.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " w3-red";
        }
  </script>

    <!--Chat Popup-->
    <script type="text/javascript">
        $(function() {
            $("#addClass").click(function() {
                $('#qnimate').addClass('popup-box-on');
            });

            $("#removeClass").click(function() {
                $('#qnimate').removeClass('popup-box-on');
            });
        })
    </script>
</body>

<script src="/assets/js/fileupload/vendor/jquery.ui.widget.js" type="text/javascript"></script>
<script src="/assets/js/fileupload/jquery.iframe-transport.js" type="text/javascript"></script>
<script src="/assets/js/fileupload/jquery.fileupload.js" type="text/javascript"></script>
<script src="/assets/js/nailthumb/jquery.nailthumb.1.1.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="/assets/js/nailthumb/jquery.nailthumb.1.1.min.css">
<script src="/assets/js/jquery.cookie.js"></script>
<script src="/assets/js/wei_common.js?v=<?=uniqid()?>"></script>
</html>