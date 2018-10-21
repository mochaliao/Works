<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- <script src="<?php echo base_url(); ?>assets/js/typeahead.min.js"></script>
    <script>
    $(document).ready(function(){
    $('input.typeahead').typeahead({
        name: 'typeahead',
        remote:'live_search?key=%QUERY',
        limit : 10
    });
});
    </script> -->


<!--header-->
<div class="header">
	<div class="container-wide">
		<div class="dec-line"></div>
		<div class="header-container clearfix">
			<!--header-left-->
			<div class="header-left">
				<div class="header-logo">
					<a href="<?php echo base_url(); ?>"><img alt="" src="<?php echo base_url(); ?>assets/img/iami-logo-header.png"></a>
				</div>
				<div class="video-ac-area">
					<a href="video-show.html"><span class="video-icon"><img src="<?php echo base_url(); ?>assets/img/5s-video-icon.png"></span><span class="video-txt">我就是我影片專區</span></a>
				</div>
			</div>
			<!--header-middle-->
			<div class="header-middle">
				<div class="header-search">
					<!-- <input type="text" placeholder="在iami搜尋"> -->
					<input type="text" name="typeahead" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="在iami搜尋">
					<button><img src="<?php echo base_url(); ?>assets/img/svg_icon-01.svg"></button>
				</div>
			</div>
			<!--header-right-->
			<div class="header-right">
				<ul class="header-icon-g">
					<li>
						<div class="bubble-wrap">
							<p class="bubble-txt"><span><?php echo $countInviters; ?></span></p>
						</div>
						<a href="#">
							<div class="invite"><span>邀請</span></div>
						</a></li>
					<li>
						<div class="bubble-wrap">
							<p class="bubble-txt"><span><?php echo $countNotice; ?></span></p>
						</div>
						<a href="#">
							<div class="notify"><span>通知</span></div>
						</a></li>
					<li>
						<div class="bubble-wrap">
							<p class="bubble-txt"><span><?php echo $countChatContent; ?></span></p>
						</div>
						<a href="#">
							<div class="message"><span>訊息</span></div>
						</a></li>
				</ul>
				<ul class="self-dropdown">
					<li class="self-dropdown-img"><img src="<?php echo base_url(); ?>assets/img/userpic-self.jpg"></li>

				</ul>

				<!--mobile-ham-btn-->
				<div class="m-header-menu"><a id="menu-trigger" href="#"><span class="menu-icon"></span></a></div>

				<!--交友邀請-->
				<div class="flyout-box" id="invite">
					<div class="flyout-triangle"><span class="bot"></span> <span class="top"></span></div>
					<div class="flyout-cnt-wrap">
						<ul>
                            <?php foreach ($getInviters->result() as $getInviters) { ?>
								<!--ppl-no1-->

								<li>
									<div class="flyout-btn">

										<form action="<?php echo base_url(); ?>inviter/inviter_check" method="POST">
											<input type="hidden" name="id" value="<?php echo $getInviters->id; ?>">
											<!-- <a href="#" class="f-check-btn" name="assure">確認</a> --><input class="f-check-btn" value="確認" name="check" type="submit">
										</form>
										<form action="<?php echo base_url(); ?>inviter/inviter_check" method="POST">
											<input type="hidden" name="id" value="<?php echo $getInviters->id; ?>">
											<!-- <a href="#" class="f-delete-btn" name="delete">刪除</a> --><input class="f-delete-btn" value="刪除" name="delete" type="submit">
										</form>
									</div>
									<div class="flyout-cnt"><a href="<?php echo base_url(); ?>friend">
											<div class="user-pic-s">
												<img src="<?php echo base_url(); ?>assets/img/default.png"></div>
											<div class="pic-s-info">
												<h5><?php echo $getInviters->nickname; ?></h5>
												<span class="icon-s"><img src="<?php echo base_url(); ?>assets/img/svg_icon-17.svg"></span>
												<span><a class="lev-btn">Lv.1</a></span></div>
										</a></div>
								</li>
								</form>
                            <?php } ?>
							<!--ppl-no2-->
							<!-- <li>
                  <div class="flyout-btn"><a href="#" class="f-check-btn">確認</a><a href="#" class="f-delete-btn">刪除</a></div>
                  <div class="flyout-cnt"><a href="friend/friend2">
                    <div class="user-pic-s"><img src="<?php echo base_url(); ?>assets/img/userpic-2.jpg"></div>
                    <div class="pic-s-info">
                      <h5>吳宗憲</h5>
                      <span class="icon-s"><img src="<?php echo base_url(); ?>assets/img/svg_icon-17.svg"></span> <span><a class="lev-btn">Lv.1</a></span> </div>
                    </a> </div>
                </li> -->
							<!--ppl-no1-->
							<!-- <li>
                  <div class="flyout-btn"><a href="#" class="f-check-btn">確認</a><a href="#" class="f-delete-btn">刪除</a></div>
                  <div class="flyout-cnt"> <a href="friend">
                    <div class="user-pic-s"><img src="<?php echo base_url(); ?>assets/img/userpic-1.jpg"></div>
                    <div class="pic-s-info">
                      <h5>周華健</h5>
                      <span class="icon-s"><img src="<?php echo base_url(); ?>assets/img/svg_icon-17.svg"></span> <span><a class="lev-btn">Lv.1</a></span> </div>
                    </a> </div>
                </li> -->
							<!--ppl-no2-->
							<!-- <li>
                  <div class="flyout-btn"><a href="#" class="f-check-btn">確認</a><a href="#" class="f-delete-btn">刪除</a></div>
                  <div class="flyout-cnt"><a href="friend/friend2">
                    <div class="user-pic-s"><img src="<?php echo base_url(); ?>assets/img/userpic-2.jpg"></div>
                    <div class="pic-s-info">
                      <h5>吳宗憲</h5>
                      <span class="icon-s"><img src="<?php echo base_url(); ?>assets/img/svg_icon-17.svg"></span> <span><a class="lev-btn">Lv.1</a></span> </div>
                    </a> </div>
                </li> -->
							<!--ppl-no1-->
							<!-- <li>
                  <div class="flyout-btn"><a href="#" class="f-check-btn">確認</a><a href="#" class="f-delete-btn">刪除</a></div>
                  <div class="flyout-cnt"> <a href="friend">
                    <div class="user-pic-s"><img src="<?php echo base_url(); ?>assets/img/userpic-1.jpg"></div>
                    <div class="pic-s-info">
                      <h5>周華健</h5>
                      <span class="icon-s"><img src="<?php echo base_url(); ?>assets/img/svg_icon-17.svg"></span> <span><a class="lev-btn">Lv.1</a></span> </div>
                    </a> </div>
                </li> -->
							<!--ppl-no2-->
							<!-- <li>
                  <div class="flyout-btn"><a href="#" class="f-check-btn">確認</a><a href="#" class="f-delete-btn">刪除</a></div>
                  <div class="flyout-cnt"><a href="friend/friend2">
                    <div class="user-pic-s"><img src="<?php echo base_url(); ?>assets/img/userpic-2.jpg"></div>
                    <div class="pic-s-info">
                      <h5>吳宗憲</h5>
                      <span class="icon-s"><img src="<?php echo base_url(); ?>assets/img/svg_icon-17.svg"></span> <span><a class="lev-btn">Lv.1</a></span> </div>
                    </a> </div>
                </li> -->
						</ul>
					</div>
					<h6><a href="<?php echo base_url(); ?>inviter">顯示全部</a></h6>
				</div>

				<!--通知-->
				<div class="flyout-box" id="notify">
					<div class="flyout-triangle"><span class="bot"></span> <span class="top"></span></div>
					<div class="flyout-cnt-wrap">
						<ul>
                            <?php foreach ($getNotice->result() as $getNotice) { ?>
								<!--ppl-no1 未讀狀態-->
								<li>
									<form actioin="<?php echo base_url(); ?>notice/notice_check" method="POST">
                                        <?php if ($getNotice->is_read == 0) { ?>
											<div class="flyout-dot"><a></a></div>
                                        <?php } ?>


										<input type="hidden" name="<?php echo $getNotice->id; ?>">
										<div class="flyout-cnt"><a href="<?php echo base_url(); ?>friend">
												<div class="user-pic-s">
													<img src="<?php echo base_url(); ?>assets/img/default.png"></div>
												<div class="pic-s-info">
													<h5><?php echo $getNotice->nickname; ?></h5>
													<h6 class="f-group-cnt">在你的貼文中留言。</h6>
                                                    <!--0515add-->
                                                    <h7>5分鐘前</h7>
												</div>
											</a></div>
									</form>
								</li>
                            <?php } ?>
							<!--ppl-no2 已讀狀態-->
							<!-- <li>
                  <div class="flyout-cnt"><a href="<?php echo base_url(); ?>friend/friend2">
                    <div class="user-pic-s"><img src="<?php echo base_url(); ?>assets/img/userpic-2.jpg"></div>
                    <div class="pic-s-info">
                      <h5>吳宗憲</h5>
                      <h6 class="f-group-cnt">喜歡你的貼文。</h6>
                    </div>
                    </a> </div>
                </li> -->
						</ul>
					</div>
					<h6><a href="<?php echo base_url(); ?>notice">顯示全部</a></h6>
				</div>

				<!--訊息通知-->
				<div class="flyout-box" id="message">
					<div class="flyout-triangle"><span class="bot"></span> <span class="top"></span></div>
					<div class="flyout-cnt-wrap">
						<ul>
                            <?php foreach ($getChatContent->result() as $getChatContent) { ?>
                                <?php $avatar = $getChatContent->avatar; ?>
                                <?php if (empty($avatar)) {
                                    $avatar = "default.png";
                                } ?>
								<!--ppl-no1 未讀狀態-->
								<li>
									<div class="flyout-dot"><a></a></div>
									<div class="flyout-cnt"><a href="#" id="addClass">
											<div class="user-pic-s">
												<img src="<?php echo base_url(); ?>assets/img/<?php echo $avatar; ?>">
											</div>
											<div class="pic-s-info">
												<h5><?php echo $getChatContent->nickname; ?></h5>
												<h6 class="f-group-cnt"><?php echo $getChatContent->message; ?></h6>
											</div>
										</a></div>
								</li>
                            <?php } ?>
							<!--ppl-no2 已讀狀態-->
							<li>
								<div class="flyout-cnt"><a href="#">
										<div class="user-pic-s">
											<img src="<?php echo base_url(); ?>assets/img/userpic-2.jpg"></div>
										<div class="pic-s-info">
											<h5>吳宗憲</h5>
											<h6 class="f-group-cnt">HIHI</h6>
										</div>
									</a></div>
							</li>
						</ul>
					</div>
					<h6><a href="<?php echo base_url(); ?>message">顯示全部</a></h6>
				</div>

				<!--self-dropdown-內容-->
				<div class="flyout-box" id="dropdown">
					<div class="flyout-triangle"><span class="bot"></span> <span class="top"></span></div>
					<div class="flyout-drop-cnt">
						<ul>
							<li class="self-dropdown-cnt"><a href="#"><h5>周子瑜</h5>
									<img src="<?php echo base_url(); ?>assets/img/self-img-arrow.png"> </a></li>
							<li class="i-money h6"><a><img src="<?php echo base_url(); ?>assets/img/money-icon.png"></a>:<span><?php echo $getMoneyPoints[0]->points; ?></span>
								<div style="display: none" class="btn-gold-gra i-money-btn">儲值</div>
							</li>
							<li><a href="media.html我的媒體(相片、影片)</a></li>
                <li><a href=" message">我的訊息(聊天室)</a></li>
							<li><a href="info.html">我的好友</a></li>
							<li><a href="info.html">我的收藏</a></li>
							<li><a href="info">基本資料編輯</a></li>
							<li><a class="modify-ps">密碼修改</a></li>
							<li><a href="policy.html">隱私權聲明</a></li>
							<li><a href="policy.html">使用條款</a></li>
						</ul>
						<button>登出</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>