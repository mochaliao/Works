<div class="follow box-wrap">
                <div class="cog-icon-wrap">
                  <div class="cog-icon"><a href="#" onClick="window.location.reload()"><img src="<?php echo base_url();?>assets/img/svg_icon-18.svg"></a></div>
                </div>
                <div>
                  <article class="cog-title">
                    <h5>追蹤推薦</h5>
                  </article>
                </div>
                <div class="follow-list">
                  <ul>

                    <?php foreach($getRecommendFriend->result() as $getRecommendFriend){ ?>
                    <!--ppl-no1-->
                    <form action="<?php echo base_url();?>main/inviter_process/" method="POST" id="inviter">
                    <li class="follow-ppl">
                      <div class="follow-btn-wrap"><input type="hidden" name="id" value="<?php echo $getRecommendFriend->id;?>"><a href="#" class="follow-btn" onclick="document.getElementById('inviter').submit();">追蹤</a></div>
                      <div class="follow-cnt"><a href="<?php echo base_url();?>friend?id=<?php echo $getRecommendFriend->id;?>">
                        <div class="user-pic-m"><img src="<?php echo base_url();?>assets/img/default.png"></div>
                        <div class="pic-m-info">
                          <h5><?php echo $getRecommendFriend->nickname;?></h5>
                          <span class="icon-s"><img src="<?php echo base_url();?>assets/img/svg_icon-17.svg"></span> <span><a class="lev-btn">Lv.1</a></span> </div></a>
                      </div>
                    </li>
                    </form>
                    <?php } ?>
                    <li class="follow-ppl">
                      <div class="follow-btn-wrap"><a href="#" class="follow-btn active">已追蹤</a></div>
                      <div class="follow-cnt"><a href="friend2">
                        <div class="user-pic-m"><img src="img/userpic-2.jpg"></div>
                        <div class="pic-m-info">
                          <h5>吳宗憲</h5>
                          <span class="icon-s"><img src="img/svg_icon-17.svg"></span> <span><a class="lev-btn">Lv.1</a></span> </div></a>
                      </div>
                    </li>
                    <!--toggle purchase-->
                    <script>
                      var purchase = "已追蹤";
                       $("div a").click(function () {
                      $(this).toggleClass("follow-btn follow-btn active");
                    });
                    </script>
                    <!--ppl-no4-->
                    <!-- <li class="follow-ppl">
                      <div class="follow-btn-wrap"><a href="#" class="follow-btn">追蹤</a></div>
                      <div class="follow-cnt"><a href="friend.html">
                        <div class="user-pic-m"><img src="img/userpic-1.jpg"></div>
                        <div class="pic-m-info">
                          <h5>周華健</h5>
                          <span class="icon-s"><img src="img/svg_icon-17.svg"></span> <span><a class="lev-btn">Lv.1</a></span> </div></a>
                      </div>
                    </li> -->
                  </ul>
                </div>
              </div>
              <!--online-area-->
              <div class="online box-wrap">
                <div class="cog-icon-wrap">
                  <div class="cog-icon"><a href="#" onClick="window.location.reload()"><img src="<?php echo base_url();?>assets/img/svg_icon-18.svg"></a></div>
                </div>
                <div>
                  <article class="cog-title">
                    <h5>在線好友</h5>
                  </article>
                </div>
                <div class="follow-list">
                  <ul>
                    <!--ppl-no1-->
                    <?php foreach($is_online_friend->result() as $is_online_friend){ ?>
                    <li class="follow-ppl">
                      <div class="follow-btn-wrap"><a href="#" id="addClass" class="follow-btn">聊天</a></div>
                      <div class="follow-cnt"><a href="<?php echo base_url();?>friend">
                        <div class="user-pic-m"><img src="<?php echo base_url();?>assets/img/default.png"></div>
                        <div  class="pic-m-info">
                          <h5><?php echo $is_online_friend->nickname;?></h5>
                          <span class="icon-s"><img src="<?php echo base_url();?>assets/img/svg_icon-17.svg"></span> <span><a class="lev-btn">Lv.1</a></span> </div></a>
                      </div>
                    </li>
                    <?php } ?>
                    <!--ppl-no2-->
                    <!-- li class="follow-ppl">
                      <div class="follow-btn-wrap"><a href="#" class="follow-btn">聊天</a></div>
                      <div class="follow-cnt"><a href="friend.html">
                        <div class="user-pic-m"><img src="img/userpic-2.jpg"></div>
                        <div  class="pic-m-info">
                          <h5>吳宗憲</h5>
                          <span class="icon-s"><img src="img/svg_icon-17.svg"></span> <span><a class="lev-btn">Lv.1</a></span> </div></a>
                      </div>
                    </li> -->
                    <!--ppl-no3-->
                    <!-- <li class="follow-ppl">
                      <div class="follow-btn-wrap"><a href="#" class="follow-btn">聊天</a></div>
                      <div class="follow-cnt"><a href="friend.html">
                        <div class="user-pic-m"><img src="img/userpic-2.jpg"></div>
                        <div  class="pic-m-info">
                          <h5>吳宗憲</h5>
                          <span class="icon-s"><img src="img/svg_icon-17.svg"></span> <span><a class="lev-btn">Lv.1</a></span> </div></a>
                      </div>
                    </li> -->
                    <!--ppl-no4-->
                    <!-- <li class="follow-ppl">
                      <div class="follow-btn-wrap"><a href="#" class="follow-btn">聊天</a></div>
                      <div class="follow-cnt"><a href="friend.html">
                        <div class="user-pic-m"><img src="img/userpic-2.jpg"></div>
                        <div  class="pic-m-info">
                          <h5>吳宗憲</h5>
                          <span class="icon-s"><img src="img/svg_icon-17.svg"></span> <span><a class="lev-btn">Lv.1</a></span> </div></a>
                      </div>
                    </li> -->
                  </ul>
                </div>
              </div>