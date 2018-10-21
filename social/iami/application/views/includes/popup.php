
<div class="flyout-box" id="message">
            <div class="flyout-triangle"> <span class="bot"></span> <span class="top"></span> </div>
            <div class="flyout-cnt-wrap">
              <ul>
                <!--ppl-no1 未讀狀態-->
                <li>
                  <div class="flyout-dot"><a></a></div>
                  <div class="flyout-cnt">
                    <a href="#">
                      <div class="user-pic-s"><img src="/assets/iami_chatroom/img/ga-pic_6.jpg"></div>
                      <div class="pic-s-info">
                        <a href="#" id="addClass">
                          <h5>周華健 Wakin Chau</h5>
                          <h6 class="f-group-cnt">HIHI</h6>
                        </a>
                      </div>
                    </a>
                  </div>
                </li>
                <!--ppl-no2 已讀狀態-->
                <li>
                  <div class="flyout-cnt">
                    <a href="#">
                      <div class="user-pic-s"><img src="/assets/iami_chatroom/img/ga-pic_6.jpg"></div>
                      <div class="pic-s-info">
                        <h5>周華健 Wakin Chau</h5>
                        <h6 class="f-group-cnt">HIHI</h6>
                      </div>
                    </a>
                  </div>
                </li>
              </ul>
            </div>
            <h6><a href="message.html">顯示全部</a></h6>
          </div>




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

  <!-- Chat POPUP -->
  <div class="popup-box-more">
    <div class="popup-box chat-popup" id="qnimate">
      <div class="popup-head">
        <div class="popup-head-left pull-left">周華健</div>
        <div class="popup-head-right pull-right">
          <button data-widget="remove" id="removeClass" class="chat-header-button pull-right" type="button"> <img src="img/cross.png"> </button>
        </div>
      </div>
      <div class="popup-messages">
        <div class="direct-chat-messages">
          <div class="chat-box-single-line">
            <abbr class="timestamp">October 8th, 2015</abbr>
          </div>
          <!-- Message. Default to the left -->
          <div class="chatbox">
            <div class="chat-ppla chata"><img src="img/head-img2.jpg" class="chata">
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
            <div class="chat-ppla chata"><img src="img/head-img2.jpg" class="chata">
              <div class="chat-popup-contenta chata">我的自拍帥吧！</div>
              <div class="chat-a-time">11:11</div>
            </div>
            <div class="chat-ppla chata"><img src="img/head-img2.jpg" class="chata">
              <div class="chat-popup-contenta chata chatfix"><img src="img/chat-img.jpg"></div>
              <div class="chat-a-time">11:11</div>
            </div>
            <div class="chat-pplb chatb">
              <div class="chat-popup-contentb chatb chatfix"><img src="img/show-img.jpg"></div>
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
              <div class="popupbox-icon-g icon-pofix"> <a href="#" class="photo popupbox-iconsz"></a> <a href="#" class="video popupbox-iconsz"></a> <a href="#" class="msgface popupbox-iconsz"></a> <a class="popup-send">傳送</a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--</div>20180131-->

  