<div class="header">
    <div class="container-wide">
        <div class="dec-line"></div>
        <div class="header-container clearfix">
            <!--header-left-->
            <div class="header-left">
                <div class="header-logo"><a href="/page/main"><img alt=""
                                                                   src="/assets/img/iami-logo-header.png"></a></div>
                <div class="video-ac-area"><a href="/page/videoshow"><span class="video-icon"><img
                                src="/assets/img/5s-video-icon.png"></span><span
                            class="video-txt">我就是我影片專區</span></a></div>
            </div>
            <!--header-middle-->
            <div class="header-middle">
                <div class="header-search"> <a></a>
                    <input type="text" name="main_search" placeholder="在iami搜尋">
                    <!--
                    <button><img src="/assets/img/svg_icon-01.svg"></button>
                    -->
                </div>
                <div class="flyout-box2 disable" id="search-cnt">
                    <div class="flyout-triangle"> <span class="bot"></span> <span class="top"></span> </div>
                    <div class="flyout-cnt-wrap">
                        <ul>
                            <li>
                                <div class="flyout-cnt">
                                    <div class="user-pic-s"><img src="/assets/img/self-user-pic.jpg"></div>
                                    <div class="pic-s-info">
                                        <h5>周華健 Wakin Chau</h5>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="flyout-cnt">
                                    <div class="user-pic-s"><img src="/assets/img/self-user-pic.jpg"></div>
                                    <div class="pic-s-info">
                                        <h5>周華健 Wakin Chau</h5>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="flyout-cnt">
                                    <div class="user-pic-s"><img src="/assets/img/self-user-pic.jpg"></div>
                                    <div class="pic-s-info">
                                        <h5>周華健 Wakin Chau</h5>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--header-right-->
            <div class="header-right">
                <ul class="header-icon-g">
                    <li>
                        <div class="bubble-wrap invite-bubble disable">
                            <p class="bubble-txt"><span>99+</span></p>
                        </div>
                        <a href="#">
                            <div class="invite"><span>邀請</span></div>
                        </a></li>
                    <li>
                        <div class="bubble-wrap notify-bubble disable">
                            <p class="bubble-txt"><span>99+</span></p>
                        </div>
                        <a href="#">
                            <div class="notify"><span>通知</span></div>
                        </a></li>
                    <li>
                        <div class="bubble-wrap message-bubble disable">
                            <p class="bubble-txt"><span>99+</span></p>
                        </div>
                        <a href="#">
                            <div class="message"><span>訊息</span></div>
                        </a></li>
                </ul>
                <ul class="self-dropdown">
                    <li class="self-dropdown-img"><img src="<?=$this->session->userdata("avatar")?>" onerror="this.src='/assets/img/self-user-pic.jpg'"></li>
                    <li class="self-dropdown-cnt"><a href="#"><span><?= $this->session->userdata("nickname") ?></span><img
                                src="/assets/img/self-img-arrow.png"> </a></li>
                </ul>

                <!--mobile-ham-btn-->
                <div class="m-header-menu"><a id="menu-trigger" href="#"><span class="menu-icon"></span></a></div>

                <!--交友邀請-->
                <div class="flyout-box disable" id="invite">
                    <div class="flyout-triangle"><span class="bot"></span> <span class="top"></span></div>
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
                    <div class="flyout-triangle"><span class="bot"></span> <span class="top"></span></div>
                    <div class="flyout-cnt-wrap">
                        <ul>
                            <!--ppl-no1 未讀狀態-->
                            <li>
                                <div class="flyout-dot"><a></a></div>
                                <div class="flyout-cnt"><a href="friend.html">
                                        <div class="user-pic-s"><img src="/assets/img/userpic-1.jpg"></div>
                                        <div class="pic-s-info">
                                            <h5>周華健 Wakin Chau</h5>
                                            <h6 class="f-group-cnt">在你的貼文中留言。</h6>
                                        </div>
                                    </a></div>
                            </li>
                            <!--ppl-no2 已讀狀態-->
                            <li>
                                <div class="flyout-cnt"><a href="friend-2.html">
                                        <div class="user-pic-s"><img src="/assets/img/userpic-2.jpg"></div>
                                        <div class="pic-s-info">
                                            <h5>吳宗憲</h5>
                                            <h6 class="f-group-cnt">喜歡你的貼文。</h6>
                                        </div>
                                    </a></div>
                            </li>
                        </ul>
                    </div>
                    <!--
                    <h6><a href="notice.html">顯示全部</a></h6>
                    -->
                </div>

                <!--訊息通知-->
                <div class="flyout-box disable" id="message">
                    <div class="flyout-triangle"><span class="bot"></span> <span class="top"></span></div>
                    <div class="flyout-cnt-wrap">
                        <ul>
                            <!--ppl-no1 未讀狀態-->
                            <li>
                                <div class="flyout-dot"><a></a></div>
                                <div class="flyout-cnt"><a href="#" id="addClass">
                                        <div class="user-pic-s"><img src="/assets/img/userpic-1.jpg"></div>
                                        <div class="pic-s-info">
                                            <h5>周華健 Wakin Chau</h5>
                                            <h6 class="f-group-cnt">HIHI</h6>
                                        </div>
                                    </a></div>
                            </li>
                            <!--ppl-no2 已讀狀態-->
                            <li>
                                <div class="flyout-cnt"><a href="#">
                                        <div class="user-pic-s"><img src="/assets/img/userpic-2.jpg"></div>
                                        <div class="pic-s-info">
                                            <h5>吳宗憲</h5>
                                            <h6 class="f-group-cnt">HIHI</h6>
                                        </div>
                                    </a></div>
                            </li>
                        </ul>
                    </div>
                    <h6><a href="message.html">顯示全部</a></h6>
                </div>

                <!--self-dropdown-內容-->
                <div class="flyout-box" id="dropdown">
                    <div class="flyout-triangle"><span class="bot"></span> <span class="top"></span></div>
                    <div class="flyout-drop-cnt">
                        <ul>
                            <li class="i-money h6"><a><img
                                        src="/assets/img/money-icon.png"></a>:<span>0</span>
                                <div class="btn-gold-gra i-money-btn">儲值</div>
                            </li>
                            <li><a href="/page/media">我的媒體(相片、影片)</a></li>
                            <li><a href="/chat">我的訊息(聊天室)</a></li>
                            <li><a href="/page/info/friend_list">我的好友</a></li>
                            <li><a href="/page/info/collection_list">我的收藏</a></li>
                            <li><a href="/page/info/edit">基本資料編輯</a></li>
                            <li><a class="modify-ps">密碼修改</a></li>
                            <li><a href="/member/showPrivacy">隱私權聲明</a></li>
                            <li><a href="/member/showService">使用條款</a></li>
                        </ul>
                        <button onclick="location.href='/member/doLogout'">登出</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>