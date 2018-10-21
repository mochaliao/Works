<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="/assets/img/iami-logo-icon.png">
    <title><?= SITE_NAME ?></title>
    <link rel="stylesheet" href="/assets/css/common.css?v=<?php echo getVersion(); ?>">
    <link rel="stylesheet" href="/assets/css/index-page.css?v=<?php echo getVersion(); ?>">
    <link rel="stylesheet" href="/assets/css/w3.css?v=<?php echo getVersion(); ?>">
    <link rel="stylesheet" href="/assets/css/share.css?v=<?php echo getVersion(); ?>">
    <link rel="stylesheet" href="/assets/css/self-page.css?v=<?php echo getVersion(); ?>">
    <link rel="stylesheet" href="/assets/css/reg-page.css?v=<?php echo getVersion(); ?>">
    <link rel="stylesheet" href="/assets/css/message.css?v=<?php echo getVersion(); ?>">
    <link rel="stylesheet" href="/assets/css/dist/build.css?v=<?php echo getVersion(); ?>">
    <link rel="stylesheet" href="/assets/css/dist/font-awesome.css?v=<?php echo getVersion(); ?>">
    <!--    <script src="/assets/js/jquery.1.11.0.min.js?v=--><?php //echo getVersion(); ?><!--"></script>-->
    <script src="/assets/js/common.js"></script>
    <script src="/assets/js/bootstrap.3.3.6.min.js?v=<?php echo getVersion(); ?>"></script>
</head>
<style>
    html, body {height: 100%; overflow: auto; }
    body {margin: 0; }
    /* 去除設置div 高度100% 浏覽器右側產生滾動條 */
</style>
<body class="<?php echo $this->session->userdata('language_id');?>">
<div class="wrapper">
    <input type="hidden" id="clientId" value="<?php echo $this->uri->segment(2); ?>">
    <!--    --><?php //echo pathinfo('cat.jpg', PATHINFO_EXTENSION);?><!-- -->
    <!-- <input type="hidden" name="--><?php //echo $this->security->get_csrf_token_name();?><!--" value="-->
    <?php //echo $this->security->get_csrf_hash();?><!--" />-->
    <?php echo $this->security->get_csrf_token_name(); ?>
    <?php echo $this->security->get_csrf_hash(); ?>
    <? //=$this->security->get_csrf_token_name()?><!-- -->

    <?php $client_id = empty($this->uri->segment(2)) ? "0" : $this->uri->segment(2);
    $group_id = $this->uri->segment(3); ?>


    <?php $session_id = $this->session->userdata('member_id');
    // echo $session_id;?>

    <!--pop-->
    <?php require_once(dirname(__FILE__) . "/includes/include.php"); ?>
    <!--top-->
    <?php require_once(dirname(__FILE__) . "/includes/top.php"); ?>

    <!--Inner Content-->
    <!--Side Content-->
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="chat-left-side-box mobileside">
            <h3 class="msg-title" style="float:left">Message</h3>
            <div style="display:block;float:right">
                <button class="btn openModal triggerbtn" value="mobile"></button>
                <!--找人聊天按鈕-->
            </div>
            <div class="chat-left-side-box mobileside">
                <div style="clear:both"></div>
                <hr class="mbars">
                <div class="m-msg-box">
                    <div id="chatunit2"></div>
                </div>
            </div>
        </div>
    </div>

    <span class="opentab" onclick="openNav()"> <img src="/assets/img/tab-arrow.png" class="tab-arrow"> </span>

    <!--創立新聊天POPUP視窗-->
    <div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <h3 class="mtitle">Message</h3>
                <span class="close-button nml-btn" data-dismiss="modal"><img src="/assets/img/svg_icon-53.svg" alt="X"></span>
                <hr class="mbar">
                <!--新聊天POPUP視窗頁籤-->
                <div class="w3-bar w3-grey">
                    <button class="w3-bar-item w3-button tablink w3-red" onclick="openCity(event,'London')"><img
                                src="/assets/img/talk01.png"><?= $this->lang->line('chat_with_friend') ?>
                    </button>
                    <!--                    <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'Paris')"><img src="/assets/img/talk02.png">一起聊天</button>-->
                </div>
                <!--找人聊天-->
                <form action="<?php echo base_url(); ?>Chat/addUnitChat" method="POST" id="unitchatform">
                    <!--csrf token-->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                           value="<?php echo $this->security->get_csrf_hash(); ?>"/>

                    <!--0201 modify-->
                    <!-- <div class="header-search" style="margin-top:10px"> <a></a>
                      <input type="text" placeholder="在iami搜尋要加入的人">
                    </div> -->
                    <!--/0201 modify-->
                    <hr class="main-hr">

                    <!--找人聊天 左側 好友列表 一側最多六個-->
                    <div id="London" class="w3-container w3-border">
                        <?php foreach ($ChatMember->result() as $ChatMember) { ?>
                            <div class="fnd-left">
                                <!--第1好友-->
                                <input type="hidden" value="<?php echo $session_id; ?>" name="master">
                                <!-- <input type="radio" value="<?php echo $ChatMember->member_id; ?>" id="UnitChat_id" name="UnitChat"> -->
                                <input type="radio" value="<?php echo $ChatMember->member_id; ?>" name="UnitChat">
                                <div class="look4fnds">
                                    <?php if (isset($ChatMember->avatar)) { ?>
                                        <p class="msg-head"><img src="<?php echo $ChatMember->avatar; ?>"
                                                                 onerror="this.src='<?php echo base_url(); ?>//assets/img/default.png'"
                                                                 alt="大頭像"></p>
                                    <?php } else { ?>
                                        <p class="msg-head"><img src="<?php echo base_url(); ?>assets/img/default.png"
                                                                 alt="大頭像"></p>
                                    <?php } ?>
                                    <p class="msg-name"><?php echo $ChatMember->nickname; ?></p>
                                </div>
                            </div>
                            <!--找人聊天 右側 好友列表 一側最多六個-->
                        <?php } ?>

                        <!-- <div id="myDIV">
                          <button class="btn">1</button>
                          <button class="btn active">2</button>
                          <button class="btn">3</button>
                          <button class="btn">4</button>
                          <button class="btn">5</button>
                        </div> -->
                        <!--  <script>
      // Add active class to the current button (highlight it)
      var header = document.getElementsByClassName("fnd-left");
      var btns = header.getElementsByClassName("look4fnds");
      for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
          var current = document.getElementsByClassName("active");
          current[0].className = current[0].className.replace(" active", "");
          this.className += " active";  });
      }
      </script> -->
                        <div style="clear:both"></div>
                        <div>
                            <hr class="main-hr"/>
                        </div>
                        <div class="chatbox-icon-g icon-pofix"><a class="newchat-send-btn"
                                                                  onclick="document.getElementById('unitchatform').submit();"><?= $this->lang->line('start-chat') ?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="message-wrapper-col">
        <div class="msg-left fullbox">
            <h3 class="msg-title" style="float:left">Message</h3>
            <div style="display:block; float:right">
                <!--popup new chat-->
                <button class="btn openModal triggerbtn" value="main"></button>
            </div>

            <div id="search1"></div>
            <!--ajaxSearch-->
            <!-- <script>
            $.post('server.php',{data:'cart'},function(data){
                     $("#sMember").html("");
                     var obj = eval("("+data+")");
                     var array = obj.result;
                     for(var i=0;i<array.length;i++){
                           var obj2 = eval("("+array[i]+")");
                           var time = "<span class = time>"+obj2.time+"</span>";

                           $("#sMember").append($("<p>"+"  "+msg+"</p>"))
                      }
                });
            </script> -->
            <!--ajaxSearch_end-->
            <!-- /popup new chat-->
            <div class="chat-clear"></div>
            <!--單則訊息-->
            <div class="chat-left-box">
                <div id="chatunit"></div>
            </div>
        </div>
    </div>

    <!--msg-center-->
    <div class="msg-center divfull">
        <?php if($ChatUnitContent->num_rows()==0){?>
            <?php $ClientObj=0; ?>
            <div class="chat-col">
                <div class="clefta">
                    <p class="chat-head">
                        <?php if(isset($clickChat[0]->avatar)){?>
                            <img src="<?php echo $clickChat[0]->avatar;?>" onerror="this.src='<?php echo base_url();?>assets/img/default.png'" alt="大頭像">
                        <?php }else{ ?>
                            <img src="/assets/img/default.png">
                        <?php } ?>
                    </p>
                </div>

                <div class="cleftb">
                    <?php if(isset($clickChat[0]->nickname)){?>
                        <!--                        <input type="hidden" id="clientId" value="--><?php //echo $clickChat[0]->client;?><!--"/>-->
                        <p class="chat-name"><?php echo $clickChat[0]->nickname;?></p>
                        <p class="cmedal"><a class="medalsvg"></a></p>
                        <p class="clvl">lv.1</p>
                        <div class="chat-span">你們是iami上面的好友</div>
                    <?php }else{ ?>
                        <p class="chat-name">請選擇朋友開始聊天</p>
                    <?php } ?>

                    <!-- <div class="chat-txt">李四端是全方位媒體人 但他最喜歡的稱呼是... 「說故事的新聞人」</div> -->
                </div>
            </div>
            <div class="chatbox" id="chatbox">
                <!-- <div class="chat-ppla chata"><img src="<?php echo base_url();?>assets/iami_chatroom/img/head-img2.jpg" class="chata">
          <div class="chat-contenta chata">嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨！我就是喜歡嗨！</div>
        </div> -->
                <div id="chat"></div>
                <!-- <div class="chat-pplb chatb"><img src="img/head-img.jpg" class="chatb">
          <div class="chat-contentb chatb">嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨！！！！我也是喜歡嗨～～～</div>
        </div>
        <div class="chat-ppla chata"><img src="<?php echo base_url();?>assets/iami_chatroom/img/head-img2.jpg" class="chata">
          <div class="chat-contenta chata">我的自拍帥不帥！！？？</div>
        </div>
        <div class="chat-ppla chata"><img src="<?php echo base_url();?>assets/iami_chatroom/img/head-img2.jpg" class="chata">
          <div class="chat-contenta chata chatfix"><img src="img/chat-img.jpg"></div>
        </div>
        <div class="chat-pplb chatb"><img src="<?php echo base_url();?>assets/iami_chatroom/img/head-img.jpg" class="chatb">
          <div class="chat-contentb chatb">帥帥帥帥帥帥帥帥帥帥帥</div>
        </div>
        <div class="chat-ppla chata"><img src="<?php echo base_url();?>assets/iami_chatroom/img/head-img2.jpg" class="chata">
          <div class="chat-contenta chata">我也覺得很帥～就是帥就是帥就是帥就是帥就是帥就是帥</div>
        </div>
        <div class="chat-pplb chatb"><img src="<?php echo base_url();?>assets/iami_chatroom/img/head-img.jpg" class="chatb">
          <div class="chat-contentb chatb">：）））））））））</div>
        </div>
        <div class="chat-pplb chatb"><img src="<?php echo base_url();?>assets/iami_chatroom/img/head-img.jpg" class="chatb">
          <div class="chat-contentb chatb">嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖</div>
        </div> -->
            </div>

            <div class="replybox">
                <!--reply box-->
                <?php $hideChat = $this->uri->segment(2);?>
                <?php if(count($ClientObj)>=0):?>
                    <div class="box-wrap">
                        <!--csrf token-->
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                        <!-- <textarea placeholder="輸入訊息" class="textbox-type2 textareabox"></textarea> -->
                        <?php if(isset($hideChat)){?>
                            <input id="txtmsg" class="textbox-type2 textareabox" type="text" name="msg" placeholder="<?php echo $this->lang->line('msg_placeholder');?>" maxlength="250"/>

                            <div class="feed-top-tool textoolbox">
                                <div class="chatbox-icon-g icon-pofix">
                                    <a id="face" class="msgface chatbox-iconsz"></a>


                                    <!--ajaxFaceUpload_end-->



                                    <a id="btn" class="msg-btn"><?=$this->lang->line('send')?></a>
                                    <!-- <button id="btn" class="msg-btn">發送</button> -->
                                </div>
                            </div>
                        <?php }else{ ?>
                            <input id="txtmsg" class="textbox-type2 textareabox" type="hidden" name="msg" placeholder="<?php echo $this->lang->line('msg_placeholder');?>" maxlength="250"/>
                        <?php } ?>
                        <span class="name"></span><input id="txtname" type="hidden" maxlength="15" value="8" />

                    </div>
                <?php endif;?>
            </div>


        <?php }else{ ?>

        <?php $ClientObj = $ChatUnitContent->result();?>

        <?php foreach($ClientObj as $ChatUnitContent){ ?>
            <?php // var_dump($ClientObj); ?>
            <div class="chat-col">
                <div class="clefta">
                    <p class="chat-head">
                        <?php if(isset($ChatUnitContent->avatar)){?>
                            <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/page/info?i='.$ChatUnitContent->member_id;?>"><img src="<?php echo $ChatUnitContent->avatar;?>" onerror="this.src='<?php echo base_url();?>assets/img/default.png'" alt="大頭像"></a>
                        <?php }else{ ?>
                            <a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/page/info?i='.$ChatUnitContent->member_id;?>"><img src="/assets/img/default.png"></a>
                        <?php } ?>
                    </p>
                </div>

                <div class="cleftb">
                    <?php if(isset($ChatUnitContent->nickname)){?>
                        <input type="hidden" id="clientId" value="<?php echo $ChatUnitContent->client;?>"/>
                        <p class="chat-name"><?php echo $ChatUnitContent->nickname;?></p>
                        <p class="cmedal"><a class="medalsvg"></a></p>
                        <p class="clvl">lv.1</p>
                        <div class="chat-span"><?php echo $this->lang->line('you-are-the-friend-with');?></div><!--你們是iami上面的好友-->
                    <?php }else{ ?>
                        <p class="chat-name"><?php echo $this->lang->line('choose-friend-to-start-chat');?></p><!--請選擇朋友開始聊天-->
                    <?php } ?>

                    <!-- <div class="chat-txt">李四端是全方位媒體人 但他最喜歡的稱呼是... 「說故事的新聞人」</div> -->
                </div>
            </div>
        <?php } ?>

        <!--this block should fixed the height of full-->
        <div class="chatbox" id="chatbox">
            <!--<div class="chat-ppla chata"><img src="<?php /*echo base_url(); */?>assets/iami_chatroom/img/head-img2.jpg" class="chata">
                <div class="chat-contenta chata">
                    嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨！我就是喜歡嗨！
                </div>
            </div>-->
            <div id="chat"></div>
            <!--            <div class="chat-pplb chatb"><img src="img/head-img.jpg" class="chatb">-->
            <!--                <div class="chat-contentb chatb">-->
            <!--                    嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨！！！！我也是喜歡嗨～～～-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="chat-ppla chata"><img src="--><?php //echo base_url(); ?><!--assets/iami_chatroom/img/head-img2.jpg"-->
            <!--                                              class="chata">-->
            <!--                <div class="chat-contenta chata">我的自拍帥不帥！！？？</div>-->
            <!--            </div>-->
            <!--            <div class="chat-ppla chata"><img src="--><?php //echo base_url(); ?><!--assets/iami_chatroom/img/head-img2.jpg"-->
            <!--                                              class="chata">-->
            <!--                <div class="chat-contenta chata chatfix"><img src="img/chat-img.jpg"></div>-->
            <!--            </div>-->
            <!--            <div class="chat-pplb chatb"><img src="--><?php //echo base_url(); ?><!--assets/iami_chatroom/img/head-img.jpg"-->
            <!--                                              class="chatb">-->
            <!--                <div class="chat-contentb chatb">帥帥帥帥帥帥帥帥帥帥帥</div>-->
            <!--            </div>-->
            <!--            <div class="chat-ppla chata"><img src="--><?php //echo base_url(); ?><!--assets/iami_chatroom/img/head-img2.jpg"-->
            <!--                                              class="chata">-->
            <!--                <div class="chat-contenta chata">我也覺得很帥～就是帥就是帥就是帥就是帥就是帥就是帥</div>-->
            <!--            </div>-->
            <!--            <div class="chat-pplb chatb"><img src="--><?php //echo base_url(); ?><!--assets/iami_chatroom/img/head-img.jpg"-->
            <!--                                              class="chatb">-->
            <!--                <div class="chat-contentb chatb">：）））））））））</div>-->
            <!--            </div>-->
            <!--            <div class="chat-pplb chatb"><img src="--><?php //echo base_url(); ?><!--assets/iami_chatroom/img/head-img.jpg"-->
            <!--                                              class="chatb">-->
            <!--                <div class="chat-contentb chatb">嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖嘖</div>-->
            <!--            </div>-->
        </div>

        <!--this block should be fixed in the bottom-->
        <!-- <form action="#" method="POST" id="addMessage"> -->
        <div class="replybox">
            <!--reply box-->
            <!--          --><?php //$hideChat = $this->uri->segment(2);?>
            <?php if (count($ClientObj) >= 0): ?>
                <div class="box-wrap">
                    <!--csrf token-->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                           value="<?php echo $this->security->get_csrf_hash(); ?>"/>
                    <!-- <textarea placeholder="輸入訊息" class="textbox-type2 textareabox"></textarea> -->
                    <!--            --><?php //if(isset($hideChat)){?>
                    <input id="txtmsg" class="textbox-type2 textareabox" type="text" name="msg"
                           placeholder="<?php echo $this->lang->line('msg_placeholder'); ?>" maxlength="250"/>
                    <!--          --><?php //}else{ ?>
                    <!--                <input id="txtmsg" class="textbox-type2 textareabox" type="hidden" name="msg" placeholder="-->
                    <?php //echo $this->lang->line('msg_placeholder');?><!--" maxlength="250"/>-->
                    <!--            --><?php //} ?>
                    <span class="name"></span><input id="txtname" type="hidden" maxlength="15" value="8"/>
                    <div class="feed-top-tool textoolbox">
                        <div class="chatbox-icon-g icon-pofix">
                            <!-- <a href="#" class="photo chatbox-iconsz"></a>  -->


                            <!--ajaxFileUpload-->
                            <!-- <div class="image-upload"> -->
                            <!-- <label for="demo1">
                      <img src="<?php echo base_url(); ?>assets/iami_chatroom/ajaxFileUpload/svg_icon-24.svg" style="width:30px"/>
                  </label> -->

                            <!-- <input id="file-input" type="file"/> -->
                            <!-- </div> -->
                            <!-- <style>
                            .demo1 > input
                            {
                                display: none;
                            }
                            </style> -->

                            <!-- <script type="text/javascript" src="jquery-1.6.1.min.js"></script> -->
                            <!--<script
                            src="http://code.jquery.com/jquery-3.3.1.js"
                            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
                            crossorigin="anonymous"></script>-->
                            <!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/iami_chatroom/ajaxFileUpload/jquery.ajaxfileupload.js"></script>-->
                            <!--ajax-->
                            <!-- <script type="text/javascript">
                var jq=$.noConflict();
                jq(document).ready(function() {
                  jq("#demo1").AjaxFileUpload({
                    onComplete: function(filename, response) {
                      console.log(filename);
                      $.ajax({
                          url: '<?php echo base_url(); ?>Chat/ajaxFileUpload',
                          type : "POST",
                          data : 
                            {filename,
                             master: <?php echo $session_id; ?>,
                             client: <?php echo $client_id; ?>,
                             roomid: <?php echo $client_id; ?>,
                            <?= $this->security->get_csrf_token_name() ?>: '<?= $this->security->get_csrf_hash() ?>'}
                      })
                      // $("#uploads").append(
                      //  // $("<img />").attr("src", filename).attr("width", 200)
                      // );
                    }
                  });
                });

              </script> -->

                            <!--ajaxFileUpload_end-->


                            <!-- <a href="#" class="video chatbox-iconsz"></a> -->
                            <!--20180131 <a href="#" class="tag chatbox-iconsz"></a>  -->
                            <!--ajaxFaceUpload-->
                            <a id="face" class="msgface chatbox-iconsz"></a>


                            <!--ajaxFaceUpload_end-->


                            <a id="btn" class="msg-btn"><?= $this->lang->line('send') ?></a>
                            <!-- <button id="btn" class="msg-btn">發送</button> -->
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <!-- </form> -->

    </div>
<?php } ?>

    <!--modal test-->
    <div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <h3 class="mtitle">Message</h3>
                <span class="close-button nml-btn" data-dismiss="modal"><img src="/assets/img/svg_icon-53.svg" alt="X"></span>
                <hr class="mbar">
                <!--新聊天POPUP視窗頁籤-->
                <div class="w3-bar w3-grey">
                    <button class="w3-bar-item w3-button tablink w3-red" onclick="openCity(event,'London')"><img
                                src="/assets/img/talk01.png"><?= $this->lang->line('chat_with_friend') ?>
                    </button>
                    <!--                <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'Paris')"><img src="/assets/img/talk02.png">一起聊天</button>-->
                </div>
                <!--找人聊天-->
                <div id="London" class="w3-container w3-border city">
                    <!--0201 modify-->
                    <!--                <div class="header-search" style="margin-top:10px"> <a></a>-->
                    <!--                    <input type="text" placeholder="在iami搜尋要加入的人">-->
                    <!--                </div>-->
                    <!--/0201 modify-->
                    <hr class="main-hr">
                    <!--找人聊天 左側 好友列表 一側最多六個-->
                    <div class="fnd-left">
                        <!--第1好友-->
                        <div class="look4fnds">
                            <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
                            <p class="msg-name">霹靂可愛萌萌噠</p>
                        </div>

                    </div>

                    <div style="clear:both"></div>
                    <div>
                        <hr class="main-hr"/>
                    </div>
                    <div class="chatbox-icon-g icon-pofix"><a class="newchat-send-btn"><?= $this->lang->line('start-chat') ?></a></div>
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

                    <hr class="second-hr">

                    <div class="header-search"><a></a>
                        <input type="text" placeholder="在iami搜尋">
                    </div>
                    <div class="chat-fnd-left">
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
                        <div class="fnd-picked"><?php echo $this->lang->line('has-chosen');?>
                            <p>1</p>
                        </div>
                        <div class="pickedfnds">
                            <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
                            <p class="msg-name">霹靂可愛萌萌噠</p>
                        </div>
                        <div class="pickedfnds">
                            <p class="msg-head"><img src="/assets/img/head-img.jpg" alt="大頭像"></p>
                            <p class="msg-name">霹靂可愛萌萌噠</p>
                        </div>
                    </div>
                    <div style="clear:both"></div>
                    <div>
                        <hr class="main-hr"/>
                    </div>
                    <div class="chatbox-icon-g icon-pofix" style="text-align: center"><a class="newchat-send-btn"><?php echo $this->lang->line('start-chat');?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('includes/m_nav'); ?>
</div>

<!--Modal-->
<script>
    $(function(){  // RUN WHEN THE PAGE LOADS
        $('.openModal').on('click',function(){   // LISTEN FOR A CLICK WHEN THE CLASS CONTAINS openModal
            var btnValue = $(this).val();  //GRAB THE VALUE OF THE BUTTON (315_abc)
            var modalText ='The value you clicked is <span class="text-danger">'+btnValue+'</span>.'; // BUILD THE TEXT OF THE MODAL
            $('#modalContent').html(modalText); // INJECT THE VALUE OF var modalText TO #modalContent
            $('#myModal').modal('show'); // OPEN THE MODAL
        });
    });
</script>

<!--Tabs inside Modal-->
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

<!--<script src="/assets/js/mMenu.js"></script>-->
<script src="/assets/js/wei_common.js?v=<?= uniqid() ?>"></script>

<script src="/assets/js/include.js"></script>
<div><?php require_once "includes/include-js.php"; ?></div>

<script>
    $(document).ready(function(){

        $("#face").click(function(){
            // console.log("test");
            var self = $(this);
            self.attr("disabled","disabled");

            $.post("<?php echo base_url();?>Chat/ajaxFace",
                {
                    master: <?php echo $session_id;?>,
                    client: <?php echo $client_id;?>,
                    roomid: <?php echo $client_id;?>,
                    face:":)",
            <?=$this->security->get_csrf_token_name()?>: '<?=$this->security->get_csrf_hash()?>'
        },
            function(data){
                var time=data[0].time;
                debug(time);
                getDateHead(time);
                renderMsgAfterSend(undefined,time);
                self.removeAttr("disabled");
            },"json");
        });
    });
</script>

<!--chat_ajax-->
<script>

    function getFileExtension(filename) {
        return filename.split('.').pop();
    }
    function addZero(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }

    get_chat_msg();
    var nextGo=false;
    $("#chatbox").scroll(function(){
        if(nextGo){
            nextGo=false;
            return;
        }
        if($(this).scrollTop()==0 && page!=pageTotal && pageTotal!=0){
            $(this).scrollTop(20);
            nextGo=true;
            return;
        }

        $(".sjjz").remove();
        $(".guang").remove();
        if ($("#chatbox").scrollTop()-60 <=0) {
            if(!cpost){
                $("<div class='sjjz' style=\"text-align: center;\"><?=$this->lang->line('post_loading')?></div>").insertBefore($("#chat>div:first"));
                return false;
            }
            if(isLast){
                $("<div class='guang' style=\"text-align: center;\"><?=$this->lang->line('post_full_load')?></div>").insertBefore($("#chat>div:first"));
                return false;
            }

            if(page<pageTotal){
                get_chat_msg();
            }
        }
    });

    var msgDate=undefined;
    var lstMsgDate=undefined;
    var msgNo =undefined;
    function get_chat_msg() {
        cpost=false;
        isLast=false;
        page=page+1;

        $.get("/Chat/recv",{
            // "name":strname,
            "master" : <?php echo $session_id;?>,
            "client" : <?php echo $client_id;?>,
            "perPage" : 15,
            "Page"  : page,
        <?=$this->security->get_csrf_token_name()?>: '<?=$this->security->get_csrf_hash()?>'
    },function(data){

            var array = data.result.reverse();
            if(page==1 && array.length>0){
                for(var i=0;i<array.length;i++){
                    var jsonData = array[i];
                    var subTime = jsonData.time.substring(0,10);
                    if(i==0){
                        msgDate = subTime;
                        lstMsgDate = subTime;
                    }else{
                        if(msgDate!=subTime){
                            msgDate=subTime;
                            var prevData=array[i-1];
                            prevData["isHead"]=true;
                            array[i-1]=prevData;
                        }
                    }
                }

                array=array.reverse();

                if(array.length>0){
                    pageTotal=array[0].TotalPage;
                }

                for(var i=0;i<array.length;i++){
                    var jsonData = array[i];
                    if(page == pageTotal && i==0){

                        $("#chat").append("<div class=\"chats-date\">"+getChatDate(jsonData.time)+"</div>");
                    }
                    if(jsonData.isHead){
                        $("#chat").append("<div class=\"chats-date\">"+getChatDate(jsonData.time)+"</div>");
                    }

                    var newMsg =  $(renderOriginMsg(jsonData));
                    if(i==0){
                        newMsg.attr("no",jsonData.No);
                    }
                    -                $("#chat").append(newMsg);
                }


                pullMsg();
            }

            if(page>1){
                for(var i=0;i<array.length;i++){
                    var jsonData = array[i];
                    var subTime = jsonData.time.substring(0,10);
                    if(msgDate!=subTime){
                        if(i==0){
                            $("<div class=\"chats-date\">"+getChatDate(msgDate)+"</div>").insertBefore($("#chat [no="+msgNo+"]"));
                        }else{
                            var prevData=array[i-1];
                            prevData["isHead"]=true;
                            array[i-1]=prevData;
                        }
                        msgDate=subTime;
                    }
                }

                array=array.reverse();
                var chats="";

                for(var i=0;i<array.length;i++){

                    var jsonData=array[i];

                    if(page == pageTotal && i==0){
                        chats+="<div class=\"chats-date\">"+getChatDate(jsonData.time)+"</div>";
                    }

                    var head="";
                    if(jsonData.isHead){
                        head="<div class=\"chats-date\">"+getChatDate(jsonData.time)+"</div>";
                    }
                    chats+=head+(i==0 && page!=pageTotal ?$(renderOriginMsg(jsonData)).attr("no",jsonData.No).prop("outerHTML"):renderOriginMsg(jsonData));


                }

                $(chats).insertBefore($("#chat>div:eq(0)"));
            }


            if(array.length==0 || page==pageTotal){
                isLast=true;
            }

            $(".sjjz").remove();
            cpost=true;
        },"json")
    }

    function  getChatDate(dataTime) {
        var lstTime ="";
        var time = new Date(dataTime);

        if("<?php echo $this->session->userdata("language_id");?>"=="english"){
            var timeArr = time.toString().split(" ");
            lstTime = timeArr[1]+" "+timeArr[2]+" "+timeArr[3]+" ("+timeArr[0]+")";
        }else{
            var week = ['日','一','二','三','四','五','六'];
            lstTime = time.toLocaleDateString().replace(/\//,"年").replace(/\//,"月")+"日 ("+week[time.getDay()]+")";
        }
        return lstTime;
    }
    function pullMsg() {
        var lstChild=$("#chat").children(":last");
        if(lstChild.length>0){
            var positon =lstChild.position();
            if($("#chat").children(":first").position().top<0){
                $("#chatbox").scrollTop(positon.top-$("#chat").children(":first").position().top,0 );
            }else{
                $("#chatbox").scrollTop(positon.top,0 );
            }
        }
    }

    function renderOriginMsg(obj2) {
        var time = "<span class = time>"+obj2.time+"</span>";
        // if(obj2.username=='1' && obj2.room==1){


        if(getFileExtension(obj2.msg)=='jpg'){
            obj2.msg = "<img src='/assets/ajaxFileUpload/uploads/"+ obj2.msg+ "' onerror='/assets/img/default.png' style='width:300px'>";
        }

        if(obj2.msg==':)'){
            obj2.msg = "<img src='/assets/img/svg_icon-15.svg' style='width:30px'>";
        }
        else if(isValidURL2(obj2.msg)){
            obj2.msg = "<a href="+obj2.msg+" target='_blank'>"+obj2.msg;
        }
        else if(isValidURL(obj2.msg)){
            obj2.msg = "<a href=//"+obj2.msg+" target='_blank'>"+obj2.msg;
        }

        var nowTime = obj2.time;
        nowTime = nowTime.replace(/\-/g, "/");
        var today = new Date(nowTime);

        var currentDateTime = addZero(today.getHours())+':'+addZero(today.getMinutes());

        if(obj2.is_group=='0'){

            if(obj2.master=="<?php echo $session_id;?>"){
                var msg = "<div class='chat-pplb chatb'><a href='/page/info?i=<?php echo $session_id;?>'><img src='"+obj2.avatar+"' onerror='this.src=\"/assets/img/default.png\"' class='chatb'></a><div class='chat-contentb chatb'>"+obj2.msg+"</div><div class='chat-time-right'>"+currentDateTime+"</div></div>";<!--<div class='chat-time-left'>10:34</div>-->
            }else{
                var msg = "<div class='chat-ppla chata'><a href='/page/info?i=<?php echo $client_id;?>'><img src='"+obj2.avatar+"' onerror='this.src=\"/assets/img/default.png\"' class='chata'></a><div class='chat-contenta chata'>"+obj2.msg+"</div><div class='chat-time-left'>"+currentDateTime+"</div></div>";<!--<div class='chat-time-right'>10:34</div>-->
            }
        }
        // if(obj2.msg=='face_icon.png'){
        //    var msg=="<img src='/assets/iami_chatroom/img/face_icon.png' />";
        // }
        // }
        // if(typeof obj2.avatar !== 'undefined'){
        // var avatar = "<img src='<?php echo base_url();?>/assets/img/self-user-pic.jpg'" >;
        // }
        return msg;
    }

    function isValidURL(url){
        // var RegExp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
        var RegExp = /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/gi;
        if(RegExp.test(url)){
            return true;
        }else{
            return false;
        }
    }

    function isValidURL2(url){
        // var RegExp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
        var RegExp = /https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/;
        if(RegExp.test(url)){
            return true;
        }else{
            return false;
        }
    }

    get_chatunit_msg();
    function get_chatunit_msg() {
        $.get("/Chat_pop/recv_chatunit",{
            // "name":strname,
            "master" : <?php echo $session_id;?>,
        <?=$this->security->get_csrf_token_name()?>: '<?=$this->security->get_csrf_hash()?>'
    },function(data){

            $("#chatunit").html("");
            var obj = eval("("+data+")");
            var array = obj.result;
            for(var i=0;i<array.length;i++){
                var obj2 = eval("("+array[i]+")");
                if(obj2.master == null){continue;}
                var leftMsg=getlMsg(obj2);
                $("#chatunit").append(leftMsg);
                $("#chatunit2").append(leftMsg.clone(true));
            }

        })
    }

    function getlMsg(result) {

        if(result.master=="<?php echo $session_id;?>"){
            result.master = result.client;
        }

        var lmsg = result.msg!=":)" && result.msg!=undefined ?result.msg:":)"
        var lclient=$(".msg-col.disable").clone();
        lclient.attr("cid",result.master);
        lclient.attr("onclick","location.href='/chat/"+result.master+"'");

        if (result.avatar != null && result.avatar != undefined && result.avatar != '') {
            lclient.find(".msg-head img").attr("src",result.avatar);
        }

        if(result.count>0){
            lclient.attr("num",result.count);
            lclient.find(".chat-bubble-wrap").removeClass("disable");
            lclient.find(".bubble-txt span").html(result.count>99?"99+":result.count);
        }

        lclient.find(".msg-name").html(result.nickname);
        lclient.find(".msg-date").html(result.time.substring(0,11).replace(/\-/g, "/"));
        lclient.find(".msg-txt").html(lmsg);
        return lclient.removeClass("disable");


    }

    $("#btn").bind("click",function(){
        set_chat_msg();
    });

    $("#txtmsg").keydown(function(event){
        if(event.keyCode == 13){
            set_chat_msg();
        }
    });

    function set_chat_msg() {
        var url = "/Chat/send";
        if($.trim($("#txtname").val())=="" || $.trim($("#txtmsg").val()) == ""){
            tip("<?=$this->lang->line('chat_content_not_empty')?>");
            return  false;
        }

        if ($("#txtname").val()!= "")
        {
            $("#btn").attr("disabled","disabled");
            strname = $("#txtname").val();
            document.getElementById("txtname").readOnly=true;
            strmsg = $("#txtmsg").val();
            $.post(url,{
                // "name":strname,
                "name"   : <?php echo $session_id;?>,//session_id
                "msg"    : strmsg,
                "roomid" : <?php echo $client_id;?>,
                "client" : <?php echo $client_id;?>,
            <?=$this->security->get_csrf_token_name()?>: '<?=$this->security->get_csrf_hash()?>'
        },function(msg){
            var time=msg[0].time;
            $("#txtmsg").val("");
            getDateHead(time);//新的一天，获取时间头
            renderMsgAfterSend(strmsg,time);
            $("#btn").removeAttr("disabled");
        },"json");
        }
    }

    var strmsg = "";

    function getDateHead(time) {
        var date=time.substring(0,10);

        if(lstMsgDate!=date){
            lstMsgDate=date;
            $("#chat").append("<div class=\"chats-date\">"+getChatDate(lstMsgDate)+"</div>");
        }
    }

    function renderMsgAfterSend(strmsg,time) {

        renderLeftMsg("chatunit",time);
        renderLeftMsg("chatunit2",time);
        var masterMsg = $(".chat-pplb.chatb.disable").clone();

        if(strmsg!=undefined)
        {
            masterMsg.find(".chat-contentb.chatb").html(strmsg);
        }

        var nowTime = time.replace(/\-/g, "/");
        var today = new Date(nowTime);
        var currentDateTime = addZero(today.getHours())+':'+addZero(today.getMinutes());
        masterMsg.removeClass("disable").find(".chat-time-right").html(currentDateTime);
        $("#chat").append(masterMsg);
        pullMsg();
    }

    function  renderLeftMsg(chatunit,time) {
        var client = $("#"+chatunit).find("[cid=<?php echo $client_id;?>]");
        var ltime=time.substring(0,11).replace(/\-/g, "/");
        if(client.length>0){

            if(strmsg != undefined){
                client.find(".msg-txt").html(strmsg);
            }
            else{
                client.find(".msg-txt").html(":)");
            }
            client.find(".msg-date").html(ltime);

            if($(".msg-col:first","#"+chatunit)!=client){
                client.insertBefore($(".msg-col:first","#"+chatunit));
            }
        }
        else{
            client =getlMsg({master:$("#clientId").val(),avatar:$(".chat-col .chat-head>img").attr("src"),nickname:$(".chat-col .chat-name").html(),msg:strmsg,time:ltime});

            if($(".msg-col","#"+chatunit).length>0){
                client.insertBefore($(".msg-col:first","#"+chatunit));
            }else{
                $("#"+chatunit).append(client);
            }
        }
    }

    function ajaxSearch() {
        var url = "/Chat/ajaxSearch";
        // if($("#txtname").val()=="" || $("#txtmsg").val() == ""){
        //      alert("發送內容不能為空值");
        // }
        if ($("#search").val()!= "")
        {
            searchword = $("#search").val();
            document.getElementById("search").readOnly=true;
            // strmsg = $("#txtmsg").val();
            $.get(url,{
                // "name":strname,
                // "name"   : <?php echo "2";?>,//session_id
                // "msg"    : strmsg,
                "searchword" : searchword
            },function(data){
                $("#search1").html("");
            });
        }
    }

    $("#clear").click(function(){
        $.get("delete.php",function(msg){
        });
    });

    $(window).resize(function(){
        if($(this).height() < 320){
            $(".fixMenu").hide();
        }
        else{

            if($(this).width() < 770){
                $(".fixMenu").show();
            }
            else{
                $(".fixMenu").hide();
            }
        }


    });
</script>

<!--<link rel="stylesheet" href="/assets/js/colorbox/colorbox.css">-->
<!--<script src="/assets/js/colorbox/jquery.colorbox-min.js"></script>-->

<!--side friend list-->
<script>
    /* Set the width of the side navigation to 100% full width */
    function openNav() {
        document.getElementById("mySidenav").style.width = "100%";
    }

    /* Set the width of the side navigation to 0 */
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>
</body>
</html>
