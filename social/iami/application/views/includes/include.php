<!--pop視窗 編輯大頭照-->
<div class="disable">
    <div class="popup-box-p " id="edit-self-pic">
        <div class="popup-box-p-cnt">
            <ul>
                <li class="h3 title colorf8b551"><?= $this->lang->line('member_edit_avatar') ?></li>
                <li class="up-pic-btn-wrap">
                    <label for="edit_pic"
                           class="btn-gold-gra up-pic-btn"><?= $this->lang->line('upload_from_device') ?></label>
                    <input type="file" id="edit_pic" onchange="fileLength = this.files.length;" name="picture"
                           class="disable" accept="image/jpeg, image/gif, image/png"/>
                </li>
                <li class="up-pic-wrap clearfix">
                    <div class="progress-bar"
                         style="width:0;height:5px;background-color:#8361c2;border-radius: 10px;"></div>
                    <br/>

                    <article class="up-pic-cnt">
                        <div>
                            <label class="checkbox-wrap">
                                <input type="checkbox">
                                <span class="checkbox-txt"></span> </label>
                        </div>
                        <div><img src=""></div>
                    </article>
                    <article class="up-pic-cnt">
                        <div>
                            <label class="checkbox-wrap">
                                <input type="checkbox">
                                <span class="checkbox-txt"></span> </label>
                        </div>
                        <div><img src=""></div>
                    </article>
                    <article class="up-pic-cnt">
                        <div>
                            <label class="checkbox-wrap">
                                <input type="checkbox">
                                <span class="checkbox-txt"></span> </label>
                        </div>
                        <div><img src=""></div>
                    </article>
                    <article class="up-pic-cnt">
                        <div>
                            <label class="checkbox-wrap">
                                <input type="checkbox">
                                <span class="checkbox-txt"></span> </label>
                        </div>
                        <div><img src=""></div>
                    </article>
                    <article class="up-pic-cnt">
                        <div>
                            <label class="checkbox-wrap">
                                <input type="checkbox">
                                <span class="checkbox-txt"></span> </label>
                        </div>
                        <div><img src=""></div>
                    </article>
                    <article class="up-pic-cnt">
                        <div>
                            <label class="checkbox-wrap">
                                <input type="checkbox">
                                <span class="checkbox-txt"></span> </label>
                        </div>
                        <div><img src=""></div>
                    </article>
                    <article class="up-pic-cnt">
                        <div>
                            <label class="checkbox-wrap">
                                <input type="checkbox">
                                <span class="checkbox-txt"></span> </label>
                        </div>
                        <div><img src=""></div>
                    </article>
                    <article class="up-pic-cnt">
                        <div>
                            <label class="checkbox-wrap">
                                <input type="checkbox">
                                <span class="checkbox-txt"></span> </label>
                        </div>
                        <div><img src=""></div>
                    </article>
                    <article class="up-pic-cnt">
                        <div>
                            <label class="checkbox-wrap">
                                <input type="checkbox">
                                <span class="checkbox-txt"></span> </label>
                        </div>
                        <div><img src=""></div>
                    </article>
                </li>
                <li class="btn-area">
                    <button class="btn-gold-gra pop-btn ok"><?= $this->lang->line('confirm') ?></button>
                </li>
            </ul>
        </div>
    </div>
</div>

<!--pop確定刪除視窗-->
<div class="disable">
    <div class="popup-box-p" id="confirm-delete-dialog">
        <div class="popup-box-p-cnt">
            <ul>
                <li class="h2"><?= $this->lang->line('confirm_delete') ?>?</li>
                <li class="h5"><?= $this->lang->line('no_recover_after_del') ?></li>
                <li class="btn-area two">
                    <button class="btn-gold-gra pop-btn ok"><?= $this->lang->line('confirm') ?></button>
                    <button class="btn-gray pop-btn cancel"><?= $this->lang->line('cancel') ?></button>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="disable">
    <div class="popup-box-p" id="tip-dialog">
        <div class="popup-box-p-cnt">
            <ul>
                <li class="h5 tip"></li>
            </ul>
        </div>
    </div>
</div>

<!--pop檔案格式不符-->
<div class="disable">
    <div class="popup-box-p" id="file-format-dialog">
        <div class="popup-box-p-cnt">
            <ul>
                <li class="h2">檔案格式錯誤</li>
                <li class="h5">檔案格式不符合</li>
                <li class="btn-area two">
                    <button class="btn-gold-gra pop-btn ok">確認</button>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Chat POPUP -->
<div class="popup-box chat-popup disable" id="qnimate">
    <div class="popup-head">
        <div class="popup-head-left pull-left"></div>
        <div class="popup-head-right pull-right">
            <button data-widget="remove" id="removeClass" class="chat-header-button pull-right" type="button"><img
                        src="/assets/img/cross.png"></button>
        </div>
    </div>
    <div class="popup-messages">
        <div class="direct-chat-messages">
            <div class="chat-box-single-line"><abbr class="timestamp">October 8th, 2015</abbr></div>
            <!-- Message. Default to the left -->
            <div class="chatbox">
                <div class="chat-ppla chata"><img src="/assets/img/head-img2.jpg" class="chata">
                    <div class="chat-popup-contenta chata">
                        嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨！我就是喜歡嗨！
                    </div>
                    <div class="chat-a-time">11:11</div>
                </div>
                <!-- /.direct-chat-msg -->
                <div class="chat-box-single-line" style="clear:both"><abbr class="timestamp">October 9th, 2015</abbr>
                </div>
                <!-- Message. Default to the left -->
                <div class="chat-pplb chatb"><img src="/assets/img/head-img.jpg" class="chatb img-responsive">
                    <div class="chat-popup-contentb chatb">
                        嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨嗨！！！！我也是喜歡嗨～～～
                    </div>
                    <div class="chat-b-time">11:11</div>
                </div>
                <div class="chat-ppla chata"><img src="/assets/img/head-img2.jpg" class="chata">
                    <div class="chat-popup-contenta chata">我的自拍帥吧！</div>
                    <div class="chat-a-time">11:11</div>
                </div>
                <div class="chat-ppla chata"><img src="/assets/img/head-img2.jpg" class="chata">
                    <div class="chat-popup-contenta chata chatfix"><img src="/assets/img/chat-img.jpg"></div>
                    <div class="chat-a-time">11:11</div>
                </div>
                <div class="chat-pplb chatb"><img src="/assets/img/head-img.jpg" class="chatb">
                    <div class="chat-popup-contentb chatb chatfix"><img src="/assets/img/show-img.jpg"></div>
                    <div class="chat-b-time">11:11</div>
                </div>
                <div class="chat-pplb chatb"><img src="/assets/img/head-img.jpg" class="chatb">
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
                    <div class="popupbox-icon-g icon-pofix"><a href="#" class="photo popupbox-iconsz"></a> <a href="#"
                                                                                                              class="video popupbox-iconsz"></a>
                        <a href="#" class="msgface popupbox-iconsz"></a> <a class="popup-send">發送</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--pop視窗 按讚的人-->
<div class="disable">
    <div class="popup-box-p " id="like-list">
        <div class="popup-box-p-cnt">
            <ul>
                <li class="h3 colorf8b551"><?= $this->lang->line('liked_people') ?></li>
                <li class="like-list-cnt">
                    <ul>
                        <!--ppl-no1-->
                        <li class="list-cnt" style="display: none">
                            <div class="list-cnt-l"><a href="#">
                                    <div class="user-pic-s"><img src="/assets/img/userpic-1.jpg"></div>
                                    <div class="pic-s-info">
                                        <h5></h5>
                                        <span class="icon-s award"></span><span
                                                class="lev-btn">Lv.1</span></div>
                                </a></div>
                            <div class="list-cnt-r" member-id=""><a
                                        class="friend-btn"><?= $this->lang->line('friend_invite') ?></a><a
                                        class="follow-btn"><?= $this->lang->line('trace') ?></a>
                            </div>
                        </li>
                        <li class="list-cnt">
                            <div class="list-cnt-l"><a href="#">
                                    <div class="user-pic-s"><img src="/assets/img/userpic-1.jpg"></div>
                                    <div class="pic-s-info">
                                        <h5></h5>
                                        <span class="icon-s award"></span><span
                                                class="lev-btn">Lv.1</span></div>
                                </a></div>
                            <div class="list-cnt-r"><a class="friend-btn befriend"></a><a
                                        class="follow-btn active">已追蹤</a>
                            </div>
                        </li>
                        <li class="list-cnt">
                            <div class="list-cnt-l"><a href="#">
                                    <div class="user-pic-s"><img src="/assets/img/userpic-1.jpg"></div>
                                    <div class="pic-s-info">
                                        <h5></h5>
                                        <span class="icon-s award"></span><span
                                                class="lev-btn">Lv.1</span></div>
                                </a></div>
                            <div class="list-cnt-r"><a class="friend-btn befriend"></a><a
                                        class="follow-btn active">已追蹤</a>
                            </div>
                        </li>
                        <li class="list-cnt">
                            <div class="list-cnt-l"><a href="#">
                                    <div class="user-pic-s"><img src="/assets/img/userpic-1.jpg"></div>
                                    <div class="pic-s-info">
                                        <h5></h5>
                                        <span class="icon-s award"></span><span
                                                class="lev-btn">Lv.1</span></div>
                                </a></div>
                            <div class="list-cnt-r"><a class="friend-btn befriend"></a><a
                                        class="follow-btn active">已追蹤</a>
                            </div>
                        </li>
                        <li class="list-cnt">
                            <div class="list-cnt-l"><a href="#">
                                    <div class="user-pic-s"><img src="/assets/img/userpic-1.jpg"></div>
                                    <div class="pic-s-info">
                                        <h5></h5>
                                        <span class="icon-s award"></span><span
                                                class="lev-btn">Lv.1</span></div>
                                </a></div>
                            <div class="list-cnt-r"><a class="friend-btn befriend"></a><a
                                        class="follow-btn active">已追蹤</a>
                            </div>
                        </li>
                        <li class="list-cnt">
                            <div class="list-cnt-l"><a href="#">
                                    <div class="user-pic-s"><img src="/assets/img/userpic-1.jpg"></div>
                                    <div class="pic-s-info">
                                        <h5></h5>
                                        <span class="icon-s award"></span><span
                                                class="lev-btn">Lv.1</span></div>
                                </a></div>
                            <div class="list-cnt-r"><a class="friend-btn befriend"></a><a
                                        class="follow-btn active">已追蹤</a>
                            </div>
                        </li>
                    </ul>

                </li>
            </ul>
        </div>
    </div>
</div>

<!--pop視窗 分享貼文-->
<div class="disable">
    <div class="popup-box-p" id="share-post">
        <div class="popup-box-p-cnt" style="width:300px;">
            <div style="padding:12px;">
                <div class="top-cnt-box purple-border-c01" style="margin-bottom: 12px;">
                    <textarea placeholder="<?= $this->lang->line('share_want_say') ?>?"
                              class="textbox-type1 share-content"></textarea>
                </div>
                <div style="padding:0 12px 12px;" class="feed-top-tool">
                    <div class="h6 color959595"><?= $this->lang->line('share_already') ?><span
                                class="shareCount">999</span><?= $this->lang->line('share_posts') ?></div>
                    <div>
                        <button class="btn-gold-gra publish-btn share-publish"><?= $this->lang->line('share') ?></button>
                    </div>
                </div>

                <div class="share-list-cnt">
                    <ul class="dropdown-list">

                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- 貼文圖片上傳預覽圖-->
<li class="disable post-picture"><img src=""></li>

<!-- 貼文影片上傳預覽圖-->
<li class="disable post-movie lzyy" style="width:100%;">
    <video class="preview_movie" src="" width="100%" controls></video>
</li>

<div class="disable">
    <div id="mediamovie">
        <video src="" width="100%" controls></video>
    </div>
</div>

<style>
	.center-cropped-one,
	.center-cropped-nine,
	.center-cropped-share-one,
	.center-cropped-share-nine,
	.center-cropped-media,
	.center-cropped-media-widget,
	.center-cropped-media-lightbox{
		object-fit: cover; /* Do not scale the image */
		object-position: center; /* Center the image within the element */
		width: 100%;
	}
	
    .center-cropped-one {
        /*height: 300px;*/
	    height: 616px;
    }

    .center-cropped-nine {
	    /*height: 150px;*/
	    height: calc(604px / 3);
	    height: -webkit-calc(604px / 3);/*for safari 6*/
	    height: -moz-calc(604px / 3);/*for firefox 4.0*/
    }

    .center-cropped-share-one {
        /*height: 250px;*/
	    height: calc(616px - 24px);
	    height: 592px;
    }

    .center-cropped-share-nine {
        /*height: 100px;*/
	    height: calc((604px - 24px) / 3);
	    height: 193px;
    }

    .center-cropped-media {
        height: 200px;
    }

    .center-cropped-media-widget {
        height: 67px;
    }

    .center-cropped-media-lightbox {
        height: 180px;
        cursor: pointer;
    }

    .center-cropped-media-lightbox-unselected {
        border: 5px solid white;
    }

    .center-cropped-media-lightbox-selected {
        border: 5px solid #fcd282;
    }

	@media screen and (max-width: 1200px){
		.center-cropped-one {
			height: calc(100vw - 584px);/*left&right's width: 270px+ middle margin+padding*/
		}

		.center-cropped-nine {
			height: calc( (100vw - 584px - 12px) / 3);
		}

		.center-cropped-share-one {
			height: calc(100vw - 584px - 24px);
		}

		.center-cropped-share-nine {
			height: calc( (100vw - 584px - 12px - 24px) / 3);
		}
	}

	@media screen and (max-width: 900px){
		.center-cropped-one {
			height: calc(100vw - 44px);
		}

		.center-cropped-nine {
			height: calc( (100vw - 44px - 12px) / 3);
		}

		.center-cropped-share-one {
			height: calc(100vw - 44px - 24px);
		}

		.center-cropped-share-nine {
			height: calc( (100vw - 44px - 12px - 24px) / 3);
		}
	}
</style>

<!--貼文款式2 相片1張 & 影片-->
<article class="ctn-items clearfix disable post-block-object">
    <div class="box-wrap items-wrap">
        <div class="items-cnt">
            <!--編輯區塊-->
            <?php if ($is_myself): ?>
                <div class="cog-icon-wrap">
                    <div class="cog-icon"><a class="edit-post-btn"></a></div>
                    <div style="display: none" class="edit-post-drop">
                        <div class="flyout-triangle"><span class="bot"></span> <span class="top"></span></div>
                        <div class="post-drop-cnt"><a
                                    class="editpost edit-post-link"><?= $this->lang->line('edit_posts'); ?></a> <a
                                    class="delete-post-link post-delete"><?= $this->lang->line('del_posts'); ?></a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!--大頭照-->
            <div class="cnt-photo-wrap post-photo">
<!--                <span class="lv-wrap"><img src="img/lev/lv1-1.png"></span>-->
                <a href="#" class="cnt-photo">
                    <img src="/assets/img/userpic-self.jpg" onerror="this.src='/assets/img/self-user-pic.jpg'">
                </a>
            </div>

            <!--使用者資料-->
            <div class="cnt-info-wrap">
            <ul>
                <!--使用者暱稱-->
                <li class="items-name">
                    <a href="javascript:void(0);"></a>
                </li>

                <li class="items-name other-page disable">
                    <a href="#"></a>
                </li>

                <!--直播icon-->
                <li class="itmes-live disable"><img src="img/icon-live-gold.svg"></li>

                <!--使用者獎牌-->
                <li><span class="icon-s award"></span></li>

                <!--使用者等級-->
                <li><span><a class="lev-btn">Lv.1</a></span></li>

                <!--分享時呈現文字-->
                <li class="itmes-share disable"></li>
                <!--發表時間-->
                <li class="items-min"></li>
            </ul>
            </div>

            <!--發布文字-->
            <div class="items-txt"></div>

            <!--照片-->
            <div class="items-photo-wrap one disable">
                <ul>
                    <li>
                        <a class="picture_group" href="/assets/img/ga-pic_5.jpg">
                            <img class="center-cropped-one" src="">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="items-photo-wrap nine disable">
                <ul class="items-photo clearfix">
                    <li>
                        <a class="picture_group" href="/assets/img/ga-pic_5.jpg">
                            <img class="center-cropped-nine" src="">
                        </a>
                    </li>
                    <li>
                        <a class="picture_group" href="/assets/img/ga-pic_5.jpg">
                            <img class="center-cropped-nine" src="">
                        </a>
                    </li>
                    <li>
                        <a class="picture_group" href="/assets/img/ga-pic_5.jpg">
                            <img class="center-cropped-nine" src="">
                        </a>
                    </li>
                    <li>
                        <a class="picture_group" href="/assets/img/ga-pic_5.jpg">
                            <img class="center-cropped-nine" src="">
                        </a>
                    </li>
                    <li>
                        <a class="picture_group" href="/assets/img/ga-pic_5.jpg">
                            <img class="center-cropped-nine" src="">
                        </a>
                    </li>
                    <li>
                        <a class="picture_group" href="/assets/img/ga-pic_5.jpg">
                            <img class="center-cropped-nine" src="">
                        </a>
                    </li>
                    <li>
                        <a class="picture_group" href="/assets/img/ga-pic_5.jpg">
                            <img class="center-cropped-nine" src="">
                        </a>
                    </li>
                    <li>
                        <a class="picture_group" href="/assets/img/ga-pic_5.jpg">
                            <img class="center-cropped-nine" src="">
                        </a>
                    </li>
                    <li>
                        <a class="picture_group" href="/assets/img/ga-pic_5.jpg">
                            <img class="center-cropped-nine" src="">
                        </a>
                    </li>

                </ul>
            </div>

        </div>

        <!--分享內容-->
        <div class="share-cnt-wrap clearfix disable">
            <hr class="hr-gray">
            <div class="share-cnt">
                <div class="box-wrap items-wrap">
                    <div class="items-cnt">

                        <div class="cnt-photo-wrap post-photo">
                            <a href="#" class="cnt-photo">
                                <img src="/assets/img/userpic-self.jpg" onerror="this.src='/assets/img/self-user-pic.jpg'">
                            </a>
                        </div>

                        <div class="cnt-info-wrap">
                            <ul>
                                <li class="items-name">
                                    <a href="#"></a>
                                </li>
                                <li class="items-min"></li>
                            </ul>
                        </div>

                        <div class="items-txt"></div>
                        <div class="items-photo-wrap">
                            <ul class="items-photo clearfix">
                                <li>
                                    <a class="picture_group" href="/assets/img/ga-pic_5.jpg">
                                        <img src="">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 讚清單 -->
        <div class="items-like-wrap disable">
            <div class="items-like-fd">
                <a href="friend.html">
                    <img src="/assets/img/userpic-1.jpg" onerror="this.src='/assets/img/self-user-pic.jpg'">
                </a>

            </div>
            <div class="items-like-txt h7 disable"><?= $this->lang->line('with_other') ?><a href="javascript:void(0);">99</a><?= $this->lang->line('people') ?>
                Like
            </div>
        </div>
        <hr class="hr-gray">

        <!-- 貼文功能列 -->
        <div class="items-tool">
            <ul>
                <li>
                    <a class="tool-like">
                        <span class="tool-num"></span>
                    </a>
                </li>
                <li>
                    <a class="tool-message" id="mes2">
                        <span class="tool-num"></span>
                    </a>
                </li>
                <li>
                    <a class="tool-share">
                        <span class="tool-num"></span>
                    </a>
                </li>
                <li>
                    <a class="tool-storage">
                        <span class="tool-num"><?= $this->lang->line('collect') ?></span>
                    </a>
                </li>
            </ul>
        </div>
        <!--留言展開-->
        <div class="items-dropdown-wrap" id="mes2">
            <div class="items-dropdown">
                <!--
                <div class="cog-btn"><a class="btn-gold-gra show-btn">顯示更多留言</a></div>
                -->
                <ul class="dropdown-list  mes cm-list">
                    <!--留言數1-->

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

<!--人氣視頻 2-->
<article class="ctn-items clearfix disable hot-video-block">
    <div class="box-wrap items-wrap">
	    <div class="items-cnt">
        <div class="cog-icon-wrap">
            <div class="cog-icon"><a class="edit-post-btn"></a></div>
            <div style="display: none" class="edit-post-drop">
                <div class="flyout-triangle"><span class="bot"></span> <span class="top"></span></div>
                <div class="post-drop-cnt"><a
                            class="editpost edit-post-link"><?= $this->lang->line('edit_posts'); ?></a> <a
                            class="delete-post-link post-delete"><?= $this->lang->line('del_posts'); ?></a></div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="h-video-clip movie">
            <!--            <video width="100%" height="auto" controls><source src="-->
            <?php //echo base_url();?><!--assets/img/v1.mp4" type="video/mp4"></video>-->
            <a style="cursor: pointer;" width="100%" height="auto" vhref="">
                <img src="/assets/img/default_movie.jpg"/>
            </a>
        </div>
        <div class="items-cnt clearfix">
            <div class="hv-photo-wrap">
                <div class="cnt-photo-wrap"><a href="#" class="cnt-photo"><img
                                src="<?php echo base_url(); ?>assets/img/userpic-self.jpg"></a></div>
            </div>
            <div class="hv-item-wrap">
                <ul class="items-name-wrap h-video-item-name">
                    <li class="items-name"><a href="#">周子瑜</a></li>
                </ul>
                <ul class="items-name-wrap h-video-item-min">
                    <li class="items-min">1分鐘前</li>
                    <!--
                    <li class="items-min">觀看人數：<span>999,999,999</span></li>
                    -->
                </ul>
                <p class="items-txt">今天天氣不錯，有人要一起喝杯咖啡嗎?<br>今天天氣不錯，有人要一起喝杯咖啡嗎?<br>今天天氣不錯，有人要一起喝杯咖啡嗎?<br>今天天氣不錯，有人要一起喝杯咖啡嗎?
                </p>
            </div>
        </div>
	    </div>
        <div class="items-like-wrap">
            <div class="items-like-fd"></div>
            <div class="items-like-txt h7 disable"><?= $this->lang->line('with_other') ?><a href="javascript:void(0);">99</a><?= $this->lang->line('people') ?>
                Like
            </div>
        </div>
        <hr class="hr-gray">
        <div class="items-tool">
            <ul>
                <li><a class="tool-like"><span class="tool-num">1000</span></a></li>
                <li><a class="tool-message" id="mes2"><span class="tool-num">1000</span></a></li>
                <li><a class="tool-share"><span class="tool-num">1000</span></a></li>
                <li><a class="tool-storage"> <span class="tool-num"><?= $this->lang->line('collect') ?></span></a></li>
            </ul>
        </div>
        <!--留言展開-->
        <div class="items-dropdown-wrap" id="mes2">
            <div class="items-dropdown">
                <!--                <div class="cog-btn"> <a class="btn-gold-gra show-btn">顯示更多留言</a> </div>-->
                <ul class="dropdown-list cm-list">

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

<!--貼文款式5 直播中-->
<article class="ctn-items clearfix disable player">
    <div class="cnt-photo-wrap"><a href="#" class="cnt-photo"><img
                    src="/assets/img/userpic-self.jpg"></a></div>
    <div class="cnt-arrow"><img src="/assets/img/cnt-items-arrow.png"></div>
    <div class="box-wrap items-wrap">
        <div class="items-cnt">
            <ul class="items-name-wrap">
                <li class="items-name"><a href="#"></a></li>
                <li class="itmes-live"><img src="/assets/img/live-btn.png"></li>
                <li class="items-min"></li>
            </ul>
            <p class="items-txt"></p>
            <!--直播-->
            <div class="live-mode">
                <div class="items-live-cnt">
                    <div class="items-live-pic">
                        <div class="edit-pic"><a href="#"><img alt=""
                                                               src="/assets/img/userpic-self.jpg"></a>
                        </div>
                    </div>
                    <div>
                        <h1><?= $this->lang->line('live_stream') ?></h1>
                        <button class="btn-gold-gra live-btn"><?= $this->lang->line('go_watch') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>

<!-- 貼文內照片 -->
<li class="disable picture-in-post">
    <a class="picture_group" href="/assets/img/ga-pic_5.jpg">
        <img src="">
    </a>
</li>

<!-- 貼文內影片 -->
<li class="disable video-in-post movie" style="max-width:100%">
    <a class="media" style="cursor: pointer;" vhref="">
        <img src="/assets/img/default_movie.jpg"/>
    </a>
</li>

<!-- 分享貼文內容 -->
<li class="disable share-post">
    <div class="user-pic-s">
        <a href="#">
            <img src="/assets/img/ga-pic_10.jpg" onerror="this.src='/assets/img/self-user-pic.jpg'">
        </a>
    </div>
    <div>
        <ul>
            <li class="items-name">
                <a href="#"></a>
            </li>
            <li>
                <span class="icon-s award"></span>
            </li>
            <li>
                <span>
                    <a class="lev-btn"></a>
                </span>
            </li>
            <li class="items-min"></li>
        </ul>
        <p class="items-txt h6">
        </p>
    </div>
</li>

<!-- 貼文留言內容 -->
<li class="disable post-comment">
    <div class="cog-icon-wrap">
        <div class="cog-icon"><a class="edit-post-btn"></a></div>
        <div class="edit-post-drop">
            <div class="flyout-triangle"><span class="bot"></span> <span class="top"></span></div>
            <div class="post-drop-cnt"><a
                        class="edit-post-link edit-comment"><?= $this->lang->line('edit_comment'); ?></a> <a
                        class="delete-post-link"><?= $this->lang->line('del_comment'); ?></a></div>
        </div>
    </div>
    <div class="user-pic-s">
        <a href="#">
            <img src="/assets/img/ga-pic_10.jpg" onerror="this.src='/assets/img/self-user-pic.jpg'">
        </a>
    </div>
    <div>
        <ul>
            <li class="items-name">
                <a href="#"></a>
            </li>
            <li>
                <span class="icon-s award"></span>
            </li>
            <li>
                <span>
                    <a class="lev-btn">Lv.1</a>
                </span>
            </li>
            <li class="items-min"></li>
<!--            <li style="float:right"><a class="tool-like comment-like" sn="">-->
<!--                    <span class="tool-num">1</span>-->
<!--                </a></li>-->
        </ul>

        <p>
            <span class="items-txt h6"></span>
            <a class="tool-like comment-like" sn="">
                <span class="tool-num">1</span>
            </a>
        </p>


                </div>
            </li>

            <!-- 讚的會員大頭照 -->
<a class="like-member disable" href="friend.html">
    <img src="/assets/img/userpic-1.jpg" onerror="this.src='/assets/img/self-user-pic.jpg'">
</a>

<!-- 照片區 -->
<article class="media-picture-object disable" picture-id="0">
    <a class="picture_group" href="javascript:void(0);">
        <img class="center-cropped-media" src="">
    </a>
    <span class="del_picture"></span>
</article>

<!-- 左側媒體專區照片 -->
<article class="media-widget-picture-object disable">
    <a class="picture_group" href="/assets/img/pic-1.jpg">
        <img class="center-cropped-media-widget" src="/assets/img/pic-1.jpg">
    </a>
</article>

<!-- Popup中的圖片-->
<article class="up-pic-cnt-object disable center-cropped-media-lightbox-unselected">
    <!--
    <div>
        <label class="checkbox-wrap">
            <input type="checkbox">
            <span class="checkbox-txt"></span> </label>
    </div>
    -->
    <div><img class="center-cropped-media-lightbox" src=""></div>
</article>

<!-- 搜尋結果 -->
<li class="search-item disable">
    <div class="flyout-cnt">
        <a href="#">
            <div class="user-pic-s">
                <img src="/assets/img/self-user-pic.jpg" onerror="this.src='/assets/img/self-user-pic.jpg'"></div>
            <div class="pic-s-info">
                <h5></h5>
                <h7></h7>
            </div>
        </a>
    </div>
</li>

<!-- 推薦追蹤 -->
<li class="follow-ppl follow-item disable">
    <div class="follow-cnt">
        <a href="friend.html">
            <div class="user-pic-m">
                <img src="/assets/img/userpic-1.jpg" onerror="this.src='/assets/img/self-user-pic.jpg'">
            </div>
            <div class="pic-m-info">
                <h5></h5>
                <span class="icon-s award"></span>
                <span>
                    <a class="lev-btn">Lv.<span class="level">1</span></a>
                </span>
            </div>
        </a>
    </div>

    <div class="follow-btn-wrap">
        <a href="javascript:void(0);" class="friend-btn"><?= $this->lang->line('friend_invite'); ?></a>
    </div>
</li>

<!-- 個人主頁追蹤 -->
<li class="list-cnt info-follow-item disable">
    <div class="list-cnt-l">
        <a href="#">
            <div class="user-pic-xl">
                <img src="/assets/img/userpic-1.jpg" onerror="this.src='/assets/img/self-user-pic.jpg'">
            </div>
            <div class="pic-xl-info">
                <h3>
                </h3>
                <span class="icon-s award"></span>
                <span class="lev-btn">Lv.<span class="level">1</span></span></div>
        </a>
    </div>
    <?php if ($is_myself): ?>
        <div class="list-cnt-r">
            <a class="friend-btn"><?= $this->lang->line('friend_invite'); ?></a>
            <a class="follow-btn"><?= $this->lang->line('trace'); ?></a>
            <!-- <a class="delete-btn"></a> -->
        </div>
    <?php endif; ?>
</li>

<!-- 個人主頁粉絲 -->
<li class="list-cnt info-fans-item disable">
    <div class="list-cnt-l">
        <a href="#">
            <div class="user-pic-xl">
                <img src="/assets/img/userpic-1.jpg" onerror="this.src='/assets/img/self-user-pic.jpg'">
            </div>
            <div class="pic-xl-info">
                <h3></h3>
                <span class="icon-s award"></span>
                <span class="lev-btn">Lv.<span class="level">1</span></span></div>
        </a>
    </div>
    <?php if ($is_myself): ?>
        <div class="list-cnt-r">
            <a class="friend-btn"><?= $this->lang->line('friend_invite'); ?></a>
            <a class="follow-btn"><?= $this->lang->line('trace'); ?></a>
            <!-- <a class="delete-btn"></a> -->
        </div>
    <?php endif; ?>
</li>

<!-- 邀請通知訊息 -->
<li class="inviter-notify-object disable">
    <div class="flyout-btn">
        <a href="javascript:void(0);" class="f-check-btn"><?= $this->lang->line('confirm'); ?></a>
        <a href="javascript:void(0);" class="f-delete-btn"><?= $this->lang->line('delete'); ?></a>
    </div>
    <div class="flyout-cnt">
        <a href="friend.html">
            <div class="user-pic-s">
                <img src="/assets/img/userpic-1.jpg" onerror="this.src='/assets/img/self-user-pic.jpg'">
            </div>
            <div class="pic-s-info">
                <h5></h5>
                <span class="icon-s award"></span>
                <span>
                    <a class="lev-btn">Lv.<span class="level">1</span></a>
                </span>
            </div>
        </a>
    </div>
</li>

<!-- 好友清單左側 -->
<article class="friend-item-object disable">
    <a href="friend.html">
        <img src="/assets/img/userpic-1.jpg" onerror="this.src='/assets/img/self-user-pic.jpg'">
    </a>
</article>

<!-- 好友清單 -->
<li class="list-cnt friend-list-item-object disable">
    <div class="list-cnt-l">
        <a href="friend.html">
            <div class="user-pic-xl">
                <img src="/assets/img/userpic-1.jpg" onerror="this.src='/assets/img/self-user-pic.jpg'">
            </div>
            <div class="pic-xl-info">
                <h3></h3>
                <span class="icon-s award"></span>
                <span class="lev-btn">Lv.<span class="level">1</span></span>
            </div>
        </a>
    </div>
    <div class="list-cnt-r">
        <a class="chat-btn"><?= $this->lang->line('chat') ?></a>
        <!--
        <aclass="delete-btn"></a>
        -->
    </div>
</li>

<!-- 通知訊息 -->
<li class="notify-item-object disable">
    <!--
    <div class="flyout-dot">
        <a></a>
    </div>
    -->
    <div class="flyout-cnt">
        <a href="friend.html">
            <div class="user-pic-s">
                <img src="/assets/img/userpic-1.jpg" onerror="this.src='/assets/img/self-user-pic.jpg'">
            </div>
            <div class="pic-s-info">
                <h5></h5>
                <h6 class="f-group-cnt"><?= $this->lang->line('comment_in_post') ?>。</h6>
                <!--0515-->
                <h7 class="coloraaa notify-time">5分鐘前</h7>
            </div>
        </a>
    </div>
</li>

<div class="box-wrap top-cnt disable">
    <div class="top-cnt-box purple-border-c01 top-cnt-pop">
        <textarea placeholder="<?= $this->lang->line('what_is_new') ?>" class="textbox-type1 edit-post-text"
                  id="include-textarea"></textarea>
    </div>
    <!--上傳圖片預覽-->
    <div class="post-pic">
        <ul>
        </ul>
        <div class="progress-bar" style="width:0;height:5px;background-color:#8361c2;border-radius: 10px;"></div>
    </div>
    <div class="feed-top-tool">
        <div class="tool-icon-g">
            <label for="picture" style="cursor:pointer;">
                <a class="photo tooltip-p">
                    <span class="tooltip-p-text"><?= $this->lang->line('picture') ?></span>
                </a>
            </label>

            <input type="file" onchange="fileLength = this.files.length;" name="picture" multiple="multiple"
                   class="disable" accept="image/jpeg, image/gif, image/png"/>

            <label for="movie" style="cursor:pointer;">
                <a class="video tooltip-p">
                    <span class="tooltip-p-text"><?= $this->lang->line('video') ?></span>
                </a>
            </label>
            <input type="file" name="movie" onchange="fileLength = this.files.length;" class="disable"
                   accept="video/mp4,video/webm,video/quicktime"/>
        </div>
        <div>
            <button class="btn-gold-gra publish-btn post-publish"><?= $this->lang->line('publish') ?></button>
        </div>
    </div>
</div>

<div class="chat-ppla chata disable">
    <img src="" onerror="this.src='/assets/img/default.png'" class="chata">
    <div class="chat-contenta chata">
        <img src="/assets/img/svg_icon-15.svg" style="width:30px">
    </div>
    <div class="chat-time-left">15:10</div>
</div>

<div class="chat-pplb chatb disable">
    <img src="<?= $this->session->userdata("avatar") ?>" onerror="this.src='/assets/img/default.png'" class="chatb">
    <div class="chat-contentb chatb">
        <img src="/assets/img/svg_icon-15.svg" style="width:30px">
    </div>
    <div class="chat-time-right">09:45</div>
</div>

<div class="msg-col disable" num="0" style="cursor: pointer">
    <div class="chat-bubble-wrap disable">
        <p class="bubble-txt"><span>0</span></p>
    </div>
    <div class="lefta">
        <p class="msg-head">
            <img src="/assets/img/default.png" onerror="this.src='/assets/img/default.png'" style="width:60px">
        </p>
    </div>
    <div class="leftb">
        <a><p class="msg-name">cc</p></a>

        <p class="medal">
            <a class="medalsvg"></a>
        </p>
        <p class="lvl">Lv.1</p>
        <p class="msg-date">2018-03-28 16:49:32</p>
        <div class="msg-txt">是的范德萨</div>
    </div>
</div>

<!--pop視窗 編輯個性化標籤-->
<div class="disable">
    <div class="popup-box-p " id="edit-self-label">
        <ul class="popup-box-p-cnt">
            <li class="up-label-title h3 colorf8b551"><?php echo $this->lang->line('personal-label'); ?></li>
            <li class="up-label-choose">
                <h6 class="color959595"><?php echo $this->lang->line('has-chosen'); ?>&nbsp<span
                            id="selNum"><?php echo count($getLabel3); ?></span>&nbsp<?php echo $this->lang->line('piece'); ?>
                </h6>
                <div class="info-label">
                    <div id="add-label"></div>
                    <?php foreach ($getLabel3 as $getLabel) { ?>
                        <?php $lang = $this->lang->line("$getLabel->labelname"); ?>
                        <?php if (!empty($lang)) { ?>
                            <article
                                    lid="<?php echo $getLabel->id; ?>"><?php echo $this->lang->line("$getLabel->labelname"); ?>
                                <span><img src="/assets/img/svg_icon-38-w.svg"></span></article>
                        <?php } else { ?>
                            <article lid="<?php echo $getLabel->id; ?>"><?php echo $getLabel->labelname; ?>
                                <span><img src="/assets/img/svg_icon-38-w.svg"></span></article>
                        <?php } ?>
                    <?php } ?>
                </div>
            </li>

            <!--                    <form action="/page/doLabel" method="POST">-->

            <input type="hidden" name="member_id" value="<?php echo $member_id; ?>"/>
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                   value="<?php echo $this->security->get_csrf_hash(); ?>"/>
            <li class="up-label-wrap clearfix">
                <div>
                    <article class="up-label-cnt self-add">
<!--                        <label class="checkbox-wrap">-->
<!--                            <input type="checkbox">-->
<!--                            <span class="checkbox-txt"></span> </label>-->
                        <input class="up-label-input" type="text" id="text"
                               placeholder="<?php echo $this->lang->line('self-input'); ?>" maxlength="20">
	                    <div class="form-tooltip-wrap">
		                    <div class="form-tooltip">
			                    <a class="tip-mark">
				                    <span class="tooltip-p-text"><?php echo $this->lang->line('label-limit');?></span>
			                    </a>
		                    </div>
	                    </div>
                    </article>
                    <a class="info-edit-label-btn self-add-btn"><img src="/assets/img/svg_icon-61.svg"></a>
                </div>

                <?php foreach ($getLabelALL as $getLabelALL) { ?>
                    <article class="up-label-cnt">
                        <label class="checkbox-wrap">
                            <input type="checkbox" <?php echo $getLabelALL->id; ?>
                                   value="<?php echo $getLabelALL->id; ?>" name="label[]">
                            <!--                                <p>-->
                            <?php //echo $getLabelALL->id;?><!--</p>-->
                            <span class="checkbox-txt"></span> </label>
                        <h4><?php echo $this->lang->line("$getLabelALL->labelname"); ?></h4>
                    </article>
                <?php } ?>
<!--                --><?php //foreach ($getLabel4 as $getLabel4) { ?>
<!--                    <article class="up-label-cnt">-->
<!--                        <label class="checkbox-wrap">-->
<!--                            <input type="checkbox" --><?php //echo $getLabel4->id; ?>
<!--                                   value="--><?php //echo $getLabel4->id; ?><!--" name="label[]">-->
<!--                            -->
<!--                            <span class="checkbox-txt"></span> </label>-->
<!--                        <h4>--><?php //echo $getLabel4->labelname; ?><!--</h4>-->
<!--                    </article>-->
<!--                --><?php //} ?>
<!--                <article class="up-label-cnt self-add">-->
<!--                    <label class="checkbox-wrap">-->
<!--                        <input type="checkbox">-->
<!--                        <span class="checkbox-txt"></span> </label>-->
<!--                    <input class="up-label-input" type="text" id="text"-->
<!--                           placeholder="--><?php //echo $this->lang->line('self-input'); ?><!--" maxlength="12">-->
<!--                </article>-->
<!---->
<!--                <a class="info-edit-label-btn self-add-btn"><img src="/assets/img/svg_icon-61.svg"></a>-->


            </li>

            <li class="btn-area">
                <button class="btn-gold-gra pop-btn"><?php echo $this->lang->line('create-label'); ?></button>
            </li>
            <!--                    </form>-->
        </ul>
    </div>
</div>
<li class="follow-ppl online-friobj disable">
    <div class="follow-btn-wrap"><a href="#"
                                    class="follow-btn"><?= $this->lang->line('chat') ?></a>
    </div>
    <div class="follow-cnt">
        <a href="#">
            <div class="user-pic-m"><img src="/assets/img/userpic-2.jpg" onerror="this.src='/assets/img/default.png'"></div>
            <div class="pic-m-info">
                <h5></h5>
                <span class="icon-s award"></span>
                <span><a class="lev-btn">Lv.1</a></span>
            </div>
        </a>
    </div>
</li>