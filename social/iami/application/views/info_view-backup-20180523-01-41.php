<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="/assets/img/iami-logo-icon.png">
    <title><?= SITE_NAME ?></title>
    <link rel="stylesheet" href="/assets/css/common.css">
    <link rel="stylesheet" href="/assets/css/self-page.css">
    <link rel="stylesheet" href="/assets/css/w3.css">
    <link rel="stylesheet" href="/assets/css/share.css">
    <link rel="stylesheet" href="/assets/css/reg-page.css">
    <script src="/assets/js/common.js"></script>
    <?php require_once(dirname(__FILE__) . "/includes/getlanguage.php"); ?>
</head>
<body class="<?php echo $this->session->userdata('language_id'); ?>">
<!--<input class="--><?php //echo $this->session->userdata('language_id'); ?><!--">-->
<?php echo form_open('', array('class' => 'post-form', 'id' => 'post-form')); ?>
<input type="hidden" name="member_id" value="<?= $member_id ?>"/>
<input type="hidden" id="isInvite" value="<?= $isInvite ?>"/>
<input type="hidden" id="selfid" value="<?= $this->session->userdata("member_id") ?>"/>
</form>

<div class="wrapper">
    <!--header-->
    <?php require_once(dirname(__FILE__) . "/includes/top.php"); ?>
</div>

<?php echo form_open('/page/doEdit', array('id' => 'info-form', 'onsubmit' => 'return validate();')); ?>
<div class="wrapper">
    <!--pop-->
    <?php require_once(dirname(__FILE__) . "/includes/include.php"); ?>

    <!--main-->
    <div id="inner-page" class="main-content">
        <div class="container-mid-c">
                <div class="content-area">
                    <div class="inner-header">
                        <div class="inner-header-container">
                            <?php if (!$is_myself): ?>
                                <div class="edit-btn">
                                    <?php if ($isFriend): ?>
                                        <a class="chat-btn-l"
                                           href="../../../chat/<?= $member_id ?>"><?= $this->lang->line('chat') ?></a>
                                    <?php endif; ?>
                                    <?php if (!$isFriend): ?>
                                        <?php if ($isRequest): ?>
                                            <a class="friend-btn-l"
                                               id="acceptRequest"><?= $this->lang->line('friend_request_agree') ?></a>
                                            <a class="friend-btn-l"
                                               id="refuseRequest"><?= $this->lang->line('friend_request_refuse') ?></a>
                                        <?php elseif ($isInvite): ?>
                                            <a class="friend-btn-l finvite active"><?= $this->lang->line('friend_invited') ?></a>
                                        <?php else: ?>
                                            <a class="friend-btn-l finvite"><?= $this->lang->line('friend_invite') ?></a>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if ($isTrace): ?>
                                        <a class="follow-btn-l active"><?= $this->lang->line('traced') ?></a>
                                    <?php else: ?>
                                        <a class="follow-btn-l"><?= $this->lang->line('trace') ?></a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <div class="edit-pic-wrap">
                                <div class="edit-pic-cnt">
                                    <div class="live-icon live-mode disable"><img src="/assets/img/svg_icon-21.svg">
                                    </div>
                                    <?php if ($is_myself): ?>
                                        <div class="cog-icon-l userpic">
                                            <a href="#">
                                                <img src="/assets/img/svg_icon-19.svg">
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="edit-pic">
                                        <a href="#">
                                            <img alt="" src="<?= $avatar ?>"
                                                 onerror="this.src='/assets/img/self-user-pic.jpg'">
                                        </a>
                                    </div>
                                    <div class="edit-pic-btn-w userpic disable">
                                        <a class="edit-pic-btn zoomout"
                                           style="position: absolute;left: -30px;top: -100px;background: white;border-radius: 5px;color: #8361c2;font-size:16px;">
                                            - </a>
                                        <a class="edit-pic-btn zoomin"
                                           style="position: absolute;left: 174px;top: -100px;background: white;border-radius: 5px;color: #8361c2;font-size:16px;">
                                            + </a>
                                        <a class="edit-pic-btn check"><?= $this->lang->line('confirm') ?></a>
                                        <a class="edit-pic-btn cancle"><?= $this->lang->line('cancel') ?></a>
                                    </div>
                                </div>
                            </div>

                            <!--cover-edit-->
                            <?php if ($is_myself): ?>
                                <div class="cog-icon-l banner">
                                    <a href="#">
                                        <img src="/assets/img/svg_icon-19.svg">
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="inner-header-cover">
                                <img alt="" src="<?= $banner ?>" onerror="this.src='/assets/img/friend2-cover.jpg'">
                            </div>
                            <div class="edit-pic-btn-w banner disable">
                                <a class="edit-pic-btn check"><?= $this->lang->line('confirm') ?></a>
                                <a class="edit-pic-btn cancle"><?= $this->lang->line('cancel') ?></a>
                            </div>
                        </div>
                        <div class="edit-container clearfix">
                            <ul>
                                <li class="edit-name">
                                    <ul>
                                        <li><?= $nickname ?></li>
                                        <li><span class="icon-m">
                                                <img src="/assets/img/svg_icon-17.svg"></span>
                                        </li>
                                        <li>
                                            <div class="lev-btn">Lv.<?= $level ?></div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="edit-cnt">
                                    <ul>
                                        <li class="edit-post <?php echo $show_type === "" || $show_type === "post" ? "active" : ""; ?>">
                                            <a>
                                                <h5><?= $this->lang->line('post') ?></h5>
                                                <h4><?= $postCount ?></h4>
                                            </a>
                                        </li>
                                        <li class="edit-fans <?php echo $show_type === "fans" ? "active" : ""; ?>">
                                            <a>
                                                <h5><?= $this->lang->line('fans') ?></h5>
                                                <h4><?= $fansCount ?></h4>
                                            </a>
                                        </li>
                                        <li class="edit-follower <?php echo $show_type === "follower" ? "active" : ""; ?>">
                                            <a>
                                                <h5><?= $this->lang->line('trace') ?></h5>
                                                <h4><?= $traceCount ?></h4>
                                            </a>
                                        </li>
                                        <?php if ($is_myself): ?>
                                            <li class="edit-storage <?php echo $show_type === "collection_list" ? "active" : ""; ?>">
                                                <a>
                                                    <h5><?= $this->lang->line('collect') ?></h5>
                                                    <h4><?= $collectCount ?></h4>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </li>

                                <!--edit-profile-->

                                <li class="edit-profile">
                                    <div>
                                        <h5></h5>
                                        <ul class="cog-list">
                                            <li class="work disable"></li>
                                            <li class="school disable"></li>
                                            <li class="location"></li>
                                            <li class="country"></li>
                                            <li class="relationship"></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="ctn-wrap">
                        <!--cnt-left-->
                        <div class="ctn-left">
                            <div class="cnt-left-cnt">
                                <!--profile-area-->
                                <div class="profile box-wrap">
                                    <?php if ($is_myself): ?>
                                        <div class="cog-icon-wrap">
                                            <div class="cog-icon"><a><img src="/assets/img/svg_icon-20.svg"></a></div>
                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <article class="cog-title">
                                            <ul>
                                                <li class="cog-title-icon"><span><img
                                                                src="/assets/img/svg_icon-03.svg"></span></li>
                                                <li>
                                                    <h4><?= $this->lang->line('brief') ?></h4>
                                                </li>
                                            </ul>
                                        </article>

                                        <article class="cog-cnt">
                                            <h5></h5>
                                        </article>
                                        <article class="cog-list">
                                            <ul>
                                                <li class="work disable"></li>
                                                <li class="school disable"></li>
                                                <li class="location"></li>
                                                <li class="country"></li>
                                                <li class="relationship"></li>
                                            </ul>
                                        </article>
                                    </div>


                                    <!--0328 label-->
                                    <!--profile tag-->
                                    <div class="profile-tag">
                                        <?php foreach ($getLabel1 as $getLabel) { ?>
                                            <?php $lang = $this->lang->line("$getLabel->labelname"); ?>
                                            <?php if (!empty($lang)) { ?>
                                                <article><span
                                                            class="profile-tag-txt h6"><?php echo $this->lang->line("$getLabel->labelname"); ?></span><span
                                                            class="profile-tag-ar"><img
                                                                src="/assets/img/tag-label-ar.png"></span>
                                                </article>
                                            <?php } else { ?>
                                                <article><span
                                                            class="profile-tag-txt h6"><?php echo $getLabel->labelname; ?></span><span
                                                            class="profile-tag-ar"><img
                                                                src="/assets/img/tag-label-ar.png"></span>
                                                </article>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                    <!--20180328 ****-->
                                </div>

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
                                                                    src="/assets/img/svg_icon-71.svg"></span></li>
                                                    <li>
                                                        <h4><?= $this->lang->line('feedback') ?></h4>
                                                    </li>
                                                </ul>
                                            </article>
                                        </a>
                                    </div>
                                </div>
                                <!--friend-area-->
                                <div class="friend-cog box-wrap">
                                    <div>
                                        <article class="cog-title">
                                            <ul>
                                                <li class="cog-title-icon">
                                                <span>
                                                    <img src="/assets/img/svg_icon-03.svg">
                                                </span>
                                                </li>
                                                <li>
                                                    <h4><?= $this->lang->line('friend_list') ?></h4>
                                                </li>
                                            </ul>
                                        </article>
                                    </div>
                                    <div class="friend-list clearfix">
                                    </div>
                                    <div class="cog-btn">
                                        <a class="btn-gold-gra show-btn"><?= $this->lang->line('show_all') ?></a>
                                    </div>
                                </div>

                                <!--photo-area-->
                                <div class="photocog box-wrap">
                                    <div>
                                        <article class="cog-title">
                                            <ul>
                                                <li class="cog-title-icon">
                                                <span>
                                                    <img src="/assets/img/svg_icon-27.svg">
                                                </span>
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
                                    <div class="cog-btn">
                                        <a href="/page/media<?php if (!$is_myself): echo "?i=" . $member_id; endif; ?>"
                                           class="btn-gold-gra show-btn"><?= $this->lang->line('show_all') ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--cnt-middle-->
                        <div class="ctn-middle">
                            <div class="cnt-mid-cnt">
                                <!--post-->
                                <div id="post" <?php echo $show_type === "" || $show_type === "post" ? "class=\"active\"" : ""; ?>>
                                    <input type="hidden" id="isFriend"
                                           value="<?php echo $isFriend === true ? '1' : '0'; ?>"/>
                                    <input type="hidden" id="isTrace"
                                           value="<?php echo $isTrace === true ? '1' : '0'; ?>"/>
                                    <input type="hidden" id="isMyself"
                                           value="<?php echo $is_myself === true ? '1' : '0'; ?>"/>
                                    <?php if ($isFriend === true || $is_myself === true): ?>
                                        <!--主要發貼文區塊-->
                                        <div class="box-wrap top-cnt">
                                            <div class="top-cnt-box purple-border-c01">
                                            <textarea placeholder="<?= $this->lang->line('what_is_new') ?>"
                                                      class="textbox-type1 post-text" id="topCnt-textarea"></textarea>
                                            </div>
                                            <!--上傳圖片預覽-->
                                            <div class="post-pic">
                                                <ul>
                                                    <li><span class="delete-btn-up-pic"></span><img
                                                                src="/assets/img/ga-pic_5.jpg"></li>
                                                    <li><span class="delete-btn-up-pic"></span><img
                                                                src="/assets/img/ga-pic_5.jpg"></li>
                                                    <li><span class="delete-btn-up-pic"></span><img
                                                                src="/assets/img/ga-pic_5.jpg"></li>
                                                    <li><span class="delete-btn-up-pic"></span><img
                                                                src="/assets/img/ga-pic_5.jpg"></li>
                                                    <li><span class="delete-btn-up-pic"></span><img
                                                                src="/assets/img/ga-pic_5.jpg"></li>
                                                    <li><span class="delete-btn-up-pic"></span><img
                                                                src="/assets/img/ga-pic_5.jpg"></li>
                                                    <li><span class="delete-btn-up-pic"></span><img
                                                                src="/assets/img/ga-pic_5.jpg"></li>
                                                    <li><span class="delete-btn-up-pic"></span><img
                                                                src="/assets/img/ga-pic_5.jpg"></li>
                                                    <li><span class="delete-btn-up-pic"></span><img
                                                                src="/assets/img/ga-pic_5.jpg"></li>
                                                </ul>
                                                <div class="progress-bar"
                                                     style="width:0%;height:5px;background-color:#8361c2;border-radius: 10px;"></div>
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
                                                           accept="video/webm, video/mp4, video/quicktime"/>
                                                </div>
                                                <div>
                                                    <button class="btn-gold-gra publish-btn post-publish"><?= $this->lang->line('publish') ?></button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!--fans-->
                                <div id="fans" <?php echo $show_type === "fans" ? "class=\"active\"" : ""; ?>>
                                    <div class="box-wrap">
                                        <hr class="hr-gray">
                                        <div class="list-cnt-wrap">
                                            <ul>

                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!--follower-->
                                <div id="follower" <?php echo $show_type === "follower" ? "class=\"active\"" : ""; ?>>
                                    <div class="box-wrap">
                                        <hr class="hr-gray">
                                        <div class="list-cnt-wrap">
                                            <ul>

                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!--storage-->
                                <div id="storage" <?php echo $show_type === "collection_list" ? "class=\"active\"" : ""; ?>></div>

                                <!--friend-list-->
                                <div id="friend-list">
                                    <div class="box-wrap">
                                        <div class="search-area">
                                            <div class="h3"><?= $this->lang->line('friend_list') ?></div>
                                        </div>
                                        <hr class="hr-gray">
                                        <div class="list-cnt-wrap">
                                            <ul></ul>
                                        </div>
                                    </div>
                                </div>

                                <!--info-list-->
                                <div id="info-edit-list">
                                    <!--                                --><?php //echo form_open('/page/doEdit', array('id' => 'info-form','onsubmit'=>'return validate();')); ?>
                                    <div class="box-wrap">
                                        <div class="search-area">
                                            <div class="h3"><?= $this->lang->line('menu_edit_member') ?></div>
                                            <!--0515info-->
                                            <div class="info-show-icon"><?= $this->lang->line('show_or_hide') ?></div>
                                            <!--****-->
                                        </div>
                                        <div class="info-edit-cnt">
                                            <ul class="self-infom-inner">
                                                <!--暱稱-->
                                                <li>
                                                    <div class="info-edit-icon">
                                                        <img src="/assets/img/svg_icon-65.svg" alt="暱稱">
                                                    </div>
                                                    <!--0515info-->
                                                    <div class="pos-rel">
                                                        <!--***-->
                                                        <input name="nickname" type="text" maxlength="20"
                                                               value="<?= empty(form_error('nickname')) ? $member['nickname'] : set_value('nickname') ?>"
                                                               placeholder="<?= $this->lang->line('member_field_nickname') ?>"
                                                               class="self-list-one input-type2 <?= empty(form_error('nickname')) ? '' : 'error' ?>">
                                                        <span class="error-txt"><?= form_error('nickname'); ?></span>
                                                        <!--0515info-->
                                                        <div class="form-tooltip-wrap">
                                                            <div class="form-tooltip">
                                                                <a class="tip-mark">
                                                                    <span class="tooltip-p-text">暱稱的長度為10個中文字(20個字元)，不能包含不雅文字，修正後七天內不能再修正</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <!--***-->
                                                    </div>
                                                    <!--0515info-->
                                                    <div>
                                                        <!--
                                                        <label class="checkbox-wrap"> <input type="checkbox"> <span
                                                                    class="checkbox-txt"></span>
                                                        </label>
                                                        -->
                                                    </div>
                                                    <!--****--->
                                                </li>

                                                <!--Email-->
                                                <li>
                                                    <div class="info-edit-icon">
                                                        <img src="/assets/img/svg_icon-06.svg" alt="email">
                                                    </div>
                                                    <div>
                                                        <input disabled name="email" type="text"
                                                               value="<?= $member['email'] ?>"
                                                               placeholder="<?= $this->lang->line('member_field_email') ?>"
                                                               class="self-list-one input-type2">
                                                        <span class="error-txt"><?= form_error('email'); ?></span>
                                                    </div>
                                                    <!--0515info-->
                                                    <!--
                                                    <div>
                                                        <label class="checkbox-wrap"> <input type="checkbox"> <span
                                                                    class="checkbox-txt"></span>
                                                        </label>
                                                    </div>
                                                    -->
                                                    <!--****--->
                                                </li>

                                                <!--個人簡歷-->
                                                <li class="self-info">
                                                    <div class="info-edit-icon">
                                                        <img src="/assets/img/svg_icon-22.svg" alt="個人簡歷">
                                                    </div>
                                                    <div>
                                                    <textarea name="resume"
                                                              placeholder="<?= $this->lang->line('member_field_resume') ?>"
                                                              class="textbox-type2 h5 <?= empty(form_error('resume')) ? '' : 'error' ?>"><?= empty(form_error('resume')) ? $member['resume'] : set_value('resume') ?></textarea>
                                                        <span class="error-txt"><?= form_error('resume'); ?></span>
                                                    </div>
                                                    <!--0515info-->
                                                    <div>
                                                        <label class="checkbox-wrap"> <input type="checkbox" name="info_show[]" value="resume" <?php echo(in_array("resume",$info_show))?"checked":""; ?>> <span
                                                                    class="checkbox-txt"></span>
                                                        </label>
                                                    </div>
                                                    <!--****--->
                                                </li>


                                                <!--生日-->
                                                <li>
                                                    <div class="info-edit-icon">
                                                        <img src="/assets/img/svg_icon-48.svg" alt="生日">
                                                    </div>
                                                    <div>
                                                        <input name="birth" type="text" id="birth"
                                                               value="<?= empty(form_error('birth')) ? $member['birth'] : set_value('birth') ?>"
                                                               placeholder="<?= $this->lang->line('member_field_birth') ?>"
                                                               class="self-list-one input-type2 <?= empty(form_error('birth')) ? '' : 'error' ?>">
                                                        <span class="error-txt"><?= form_error('birth'); ?></span>
                                                    </div>
                                                    <!--0515info-->
                                                    <div>
                                                        <!--
                                                        <label class="checkbox-wrap"> <input type="checkbox" name="info_show[]" value="birth" <?php echo(in_array("birth",$info_show))?"checked":""; ?>> <span
                                                                    class="checkbox-txt"></span>
                                                        </label>
                                                        -->
                                                    </div>
                                                    <!--****--->
                                                </li>

                                                <!--性別-->
                                                <li>
                                                    <div class="info-edit-icon">
                                                        <img src="/assets/img/svg_icon-57.svg" alt="性別">
                                                    </div>
                                                    <div>
                                                        <div class="select-type1">
                                                            <select name="gender" class="self-list-one">
                                                                <option value="M" <?= strtoupper($member['gender']) == 'M' ? 'selected' : '' ?>><?= $this->lang->line('member_field_gender_male') ?></option>
                                                                <option value="F" <?= strtoupper($member['gender']) == 'F' ? 'selected' : '' ?>><?= $this->lang->line('member_field_gender_female') ?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--0515info-->
                                                    <div>
                                                        <!--
                                                        <label class="checkbox-wrap"> <input type="checkbox" name="info_show[]" value="gender" <?php echo(in_array("gender",$info_show))?"checked":""; ?>> <span
                                                                    class="checkbox-txt"></span>
                                                        </label>
                                                        -->
                                                    </div>
                                                    <!--****--->
                                                </li>

                                                <!--手機-->
                                                <li>
                                                    <div class="info-edit-icon">
                                                        <img src="/assets/img/svg_icon-64.svg" alt="手機">
                                                    </div>
                                                    <div>
                                                        <input name="mobile" type="text"
                                                               value="<?= empty(form_error('mobile')) ? $member['mobile'] : set_value('mobile') ?>"
                                                               placeholder="<?= $this->lang->line('member_field_mobile') ?>"
                                                               class="self-list-one input-type2 <?= empty(form_error('mobile')) ? '' : 'error' ?>">
                                                        <span class="error-txt"><?= form_error('mobile'); ?></span>
                                                    </div>
                                                    <!--0515info-->
                                                    <div>
                                                        <!--
                                                        <label class="checkbox-wrap"> <input type="checkbox" name="info_show[]" value="mobile" <?php echo(in_array("mobile",$info_show))?"checked":""; ?>> <span
                                                                    class="checkbox-txt"></span>
                                                        </label>
                                                        -->
                                                    </div>
                                                    <!--****--->
                                                </li>

                                                <!--公司-->
                                                <!--                                            <li>-->
                                                <!--                                                <div class="info-edit-icon">-->
                                                <!--                                                    <img src="/assets/img/svg_icon-43.svg" alt="公司">-->
                                                <!--                                                </div>-->
                                                <!--                                                <div>-->
                                                <!--                                                    <div>-->
                                                <!--                                                        <ul id="company_position" class="self-list-two">-->
                                                <!--                                                            --><?php
                                                //                                                            $placeholder_company = $this->lang->line('member_field_company');
                                                //                                                            $placeholder_position = $this->lang->line('member_field_position');
                                                //                                                            if (empty($member_companys)) {
                                                //                                                                echo '<li>';
                                                //                                                                echo '<input name="company[]" class="input-type2" type="text" placeholder="' . $placeholder_company . '">';
                                                //                                                                echo '<input name="position[]" class="input-type2" type="text" placeholder="' . $placeholder_position . '">';
                                                //                                                                echo '</li>';
                                                //                                                            } else {
                                                //                                                                foreach ($member_companys as $member_company) {
                                                //                                                                    echo '<li>';
                                                //                                                                    echo '<input name="company[]" class="input-type2" type="text" placeholder="' . $placeholder_company . '". value="' . $member_company['company'] . '">';
                                                //                                                                    echo '<input name="position[]" class="input-type2" type="text" placeholder="' . $placeholder_position . '". value="' . $member_company['position'] . '">';
                                                //                                                                    echo '</li>';
                                                //                                                                }
                                                //                                                            }
                                                //                                                            ?>
                                                <!--                                                        </ul>                                                        -->
                                                <!--                                                    </div>-->
                                                <!--                                                </div>-->
                                                <!--                                            </li>-->

                                                <!--0515info-->
                                                <!--公司-->

                                                <?php
                                                $placeholder_company = $this->lang->line('member_field_company');
                                                $placeholder_position = $this->lang->line('member_field_position');
                                                $company_length = count($member_companys);
                                                ?>
                                                <?php for($i=0;$i< $company_length && $i<9;$i++): ?>
                                                    <li class="info-company">
                                                        <div class="info-edit-icon"><img src="/assets/img/svg_icon-43.svg"
                                                                                         alt="company"></div>
                                                        <div>
                                                            <div>
                                                                <ul class="self-list-two">
                                                                    <li>
                                                                        <input type="text" placeholder="<?php echo $placeholder_company;?>"
                                                                               class="input-type2" name="company[]" value="<?php echo $member_companys[$i]["company"]; ?>">
                                                                        <input type="text" placeholder="<?php echo $placeholder_position; ?>"
                                                                               class="input-type2" name="position[]" value="<?php echo $member_companys[$i]["position"]; ?>">
                                                                        <div class="self-list-add company-remove">
                                                                            <a><img src="/assets/img/svg_icon-77.svg"></a>
                                                                        </div>
                                                                    </li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                        <div>
                                                            <label class="checkbox-wrap"> <input type="checkbox" name="info_show[]" value="companies_<?php echo $i;?>" <?php echo(in_array("companies_".$i,$info_show))?"checked":""; ?>> <span
                                                                        class="checkbox-txt"></span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                <?php endfor; ?>


                                                <!--公司2-->
                                                <li class="info-company">
                                                    <div class="info-edit-icon"><img src="/assets/img/svg_icon-43.svg"
                                                                                     alt="company"></div>
                                                    <div>
                                                        <div>
                                                            <ul class="self-list-two">
                                                                <li>
                                                                    <input type="text" placeholder="<?php echo $placeholder_company;?>"
                                                                           class="input-type2" name="company[]" value="<?php echo isset($member_companys[9]) ? $member_companys[9]["company"] : "";  ?>">
                                                                    <input type="text" placeholder="<?php echo $placeholder_position; ?>"
                                                                           class="input-type2" name="position[]" value="<?php echo isset($member_companys[9]) ? $member_companys[9]["position"] : "";  ?>">
                                                                    <div class="self-list-add company-clone">
                                                                        <a><img src="/assets/img/svg_icon-78.svg"></a>
                                                                    </div>
                                                                </li>
                                                            </ul>

                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label class="checkbox-wrap"> <input type="checkbox" name="info_show[]" value="companies_last" <?php echo(in_array("companies_last",$info_show))?"checked":""; ?>> <span
                                                                    class="checkbox-txt"></span>
                                                        </label>
                                                    </div>

                                                </li>
                                                <!--***-->

                                                <!--學校-->
                                                <!--                                            <li>-->
                                                <!--                                                <div class="info-edit-icon">-->
                                                <!--                                                    <img src="/assets/img/svg_icon-46.svg" alt="學校">-->
                                                <!--                                                </div>-->
                                                <!--                                                <div>-->
                                                <!--                                                    <div>-->
                                                <!--                                                        <ul id="school_department" class="self-list-two">-->
                                                <!--                                                            --><?php
                                                //                                                            $placeholder_school = $this->lang->line('member_field_school');
                                                //                                                            $placeholder_department = $this->lang->line('member_field_department');
                                                //                                                            if (empty($member_schools)) {
                                                //                                                                echo '<li>';
                                                //                                                                echo '<input name="school[]" class="input-type2" type="text" placeholder="' . $placeholder_school . '">';
                                                //                                                                echo '<input name="department[]" class="input-type2" type="text" placeholder="' . $placeholder_department . '">';
                                                //                                                                echo '</li>';
                                                //                                                            } else {
                                                //                                                                foreach ($member_schools as $member_school) {
                                                //                                                                    echo '<li>';
                                                //                                                                    echo '<input name="school[]" class="input-type2" type="text" placeholder="' . $placeholder_school . '". value="' . $member_school['school'] . '">';
                                                //                                                                    echo '<input name="department[]" class="input-type2" type="text" placeholder="' . $placeholder_department . '". value="' . $member_school['department'] . '">';
                                                //                                                                    echo '</li>';
                                                //                                                                }
                                                //                                                            }
                                                //                                                            ?>
                                                <!--                                                        </ul>-->
                                                <!--                                                        <!--<div class="self-list-add">-->
                                                <!--                                                            <a href="#" onclick="addSchoolDepartment();return false;">-->
                                                <!--                                                                <img src="/assets/img/icon-add.png">-->
                                                <!--                                                            </a>-->
                                                <!--                                                        </div>-->
                                                <!--                                                    </div>-->
                                                <!--                                                </div>-->
                                                <!--                                            </li>-->

                                                <!--0515info-->
                                                <!--學校-->
                                                <?php
                                                $placeholder_school = $this->lang->line('member_field_school');
                                                $placeholder_department = $this->lang->line('member_field_department');
                                                $school_length = count($member_schools);
                                                ?>
                                                <?php for($i=0;$i<$school_length && $i<9;$i++): ?>
                                                    <li class="info-education">
                                                        <div class="info-edit-icon"><img src="/assets/img/svg_icon-46.svg"
                                                                                         alt="Education">
                                                        </div>
                                                        <div>
                                                            <div>
                                                                <ul class="self-list-two">
                                                                    <li>
                                                                        <input type="text" placeholder="<?php echo $placeholder_school; ?>"
                                                                               class="input-type2" name="school[]" value="<?php echo $member_schools[$i]["school"]; ?>">
                                                                        <input type="text" placeholder="<?php echo $placeholder_department; ?>"
                                                                               class="input-type2" name="department[]" value="<?php echo $member_schools[$i]["department"]; ?>">
                                                                        <div class="self-list-add school-remove">
                                                                            <a><img src="/assets/img/svg_icon-77.svg"></a>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <label class="checkbox-wrap"> <input type="checkbox" name="info_show[]" value="schools_<?php echo $i;?>" <?php echo(in_array("schools_" . $i,$info_show))?"checked":""; ?>> <span
                                                                        class="checkbox-txt"></span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                <?php endfor; ?>


                                                <!--學校2-->
                                                <li class="info-education">
                                                    <div class="info-edit-icon"><img src="/assets/img/svg_icon-46.svg"
                                                                                     alt="Education">
                                                    </div>
                                                    <div>
                                                        <div>
                                                            <ul class="self-list-two">
                                                                <li>
                                                                    <input type="text" placeholder="<?php echo $placeholder_school; ?>"
                                                                           class="input-type2" name="school[]" value="<?php echo isset($member_schools[9]) ? $member_schools[9]["school"] : "";  ?>">
                                                                    <input type="text" placeholder="<?php echo $placeholder_department; ?>"
                                                                           class="input-type2" name="department[]" value="<?php echo isset($member_schools[9]) ? $member_schools[9]["department"] : "";  ?>">
                                                                    <div class="self-list-add school-clone ">
                                                                        <a><img src="/assets/img/svg_icon-78.svg"></a>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label class="checkbox-wrap"> <input type="checkbox" name="info_show[]" value="schools_last" <?php echo(in_array("schools_last",$info_show))?"checked":""; ?>> <span
                                                                    class="checkbox-txt"></span>
                                                        </label>
                                                    </div>
                                                </li>
                                                <!--****-->

                                                <!--居住地-->
                                                <li>
                                                    <div class="info-edit-icon">
                                                        <img src="/assets/img/svg_icon-44.svg" alt="居住地">
                                                    </div>
                                                    <div>
                                                        <input name="city" type="text"
                                                               value="<?= empty(form_error('city')) ? $member['city'] : set_value('city') ?>"
                                                               placeholder="<?= $this->lang->line('member_field_city') ?>"
                                                               class="self-list-one input-type2 <?= empty(form_error('city')) ? '' : 'error' ?>">
                                                        <span class="error-txt"><?= form_error('city'); ?></span>
                                                    </div>
                                                    <!--0515info-->
                                                    <div>
                                                        <label class="checkbox-wrap"> <input type="checkbox" name="info_show[]" value="city" <?php echo(in_array("city",$info_show))?"checked":""; ?>> <span
                                                                    class="checkbox-txt"></span>
                                                        </label>
                                                    </div>
                                                    <!--****--->
                                                </li>

                                                <!--國籍-->
                                                <li>
                                                    <div class="info-edit-icon">
                                                        <img src="/assets/img/svg_icon-47.svg" alt="國籍">
                                                    </div>
                                                    <div>
                                                        <div class="select-type1">
                                                            <select name="country_id" class="self-list-one">
                                                                <option value=""
                                                                        hidden><?php echo $this->lang->line('member_field_country') ?></option>
                                                                <?php
                                                                foreach ($countrys as $country) {
                                                                    $country_id = (empty(set_value('country_id')) ? $member['country_id'] : set_value('country_id'));
                                                                    $selected = ($country["country_id"] == $country_id ? 'selected' : '');
                                                                    echo '<option value="' . $country["country_id"] . '" ' . $selected . '>' . $country["name"] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--0515info-->
                                                    <div>
                                                        <label class="checkbox-wrap"> <input type="checkbox" name="info_show[]" value="country" <?php echo(in_array("country",$info_show))?"checked":""; ?>> <span
                                                                    class="checkbox-txt"></span>
                                                        </label>
                                                    </div>
                                                    <!--****--->
                                                </li>

                                                <!--感情狀況-->
                                                <li>
                                                    <div class="info-edit-icon">
                                                        <img src="/assets/img/svg_icon-45.svg" alt="感情狀況">
                                                    </div>
                                                    <div>
                                                        <div class="select-type1">
                                                            <select name="relationship" class="self-list-one">
                                                                <option value="" selected
                                                                        hidden><?php echo $this->lang->line('member_field_relationship') ?></option>
                                                                <?php
                                                                foreach ($this->lang->line('member_option_relationship') as $key => $value) {
                                                                    echo '<option value="' . $key . '"' . ($member['relationship'] == $key ? ' selected' : '') . '>' . $value . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--0515info-->
                                                    <div>
                                                        <label class="checkbox-wrap"> <input type="checkbox" name="info_show[]" value="relationship" <?php echo(in_array("relationship",$info_show))?"checked":""; ?>> <span
                                                                    class="checkbox-txt"></span>
                                                        </label>
                                                    </div>
                                                    <!--****--->
                                                </li>

                                                <!--語系-->
                                                <li>
                                                    <div class="info-edit-icon">
                                                        <img src="/assets/img/svg_icon-63.svg" alt="語系">
                                                    </div>
                                                    <div>
                                                        <div class="select-type1">
                                                            <select name="language_id" class="self-list-one">
                                                                <?php
                                                                foreach ($languages as $language) {
                                                                    $language_id = (empty(set_value('language_id')) ? $member['language_id'] : set_value('language_id'));
                                                                    $selected = ($language["language_id"] == $this->session->userdata('language_id') ? 'selected' : '');
                                                                    echo '<option value="' . $language["language_id"] . '" ' . $selected . '>' . $language["language_name"] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--0515info-->
                                                    <div>
                                                        <!--                                                    <label class="checkbox-wrap"> <input type="checkbox"> <span class="checkbox-txt"></span> </label>-->
                                                    </div>
                                                    <!--****--->
                                                </li>

                                            </ul>

                                            <!--個人化標籤-->
                                            <div class="info-edit-label">
                                                <div>
                                                    <h3 class="colorf8b551 font-bold"><?php echo $this->lang->line('personal-label'); ?></h3>
                                                    <span class="info-edit-label-btn freestyle-label-btn"><img
                                                                src="/assets/img/svg_icon-61.svg"></span>
                                                </div>
                                                <div class="info-label">
                                                    <div id="add-label-listen"></div>
                                                    <?php foreach ($getLabel2 as $getLabel) { ?>
                                                        <?php $lang = $this->lang->line("$getLabel->labelname"); ?>
                                                        <?php if (!empty($lang)) { ?>
                                                            <article
                                                                    id="<?php echo $getLabel->id; ?>"><?php echo $this->lang->line("$getLabel->labelname"); ?>
                                                                <span><img src="/assets/img/svg_icon-38-w.svg"></span>
                                                            </article>
                                                        <?php } else { ?>
                                                            <article
                                                                    id="<?php echo $getLabel->id; ?>"><?php echo $getLabel->labelname; ?>
                                                                <span><img src="/assets/img/svg_icon-38-w.svg"></span>
                                                            </article>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>

                                            </div>
                                            <button href="#" type="submit"
                                                    class="btn-gold-gra info-edit-btn"><?= $this->lang->line('member_btn_submit') ?></button>
                                        </div>
                                    </div>
                                    <!--                                </form>-->
                                </div>
                            </div>
                        </div>

                        <!--cnt-right-->
                        <div class="ctn-right">
                            <div class="cnt-right-cnt">
                                <!--follow-area-->
                                <div class="follow box-wrap">
                                    <div class="cog-icon-wrap">
                                        <div class="cog-icon">
                                            <a>
                                                <img src="/assets/img/svg_icon-18.svg">
                                            </a>
                                        </div>
                                    </div>
                                    <div>
                                        <article class="cog-title">
                                            <h5><?= $this->lang->line('friend_recommend') ?></h5>
                                        </article>
                                    </div>
                                    <div class="follow-list">
                                        <ul>

                                        </ul>
                                    </div>
                                </div>

                                <!--online-area-->
                                <div class="online box-wrap disable">
                                    <div class="cog-icon-wrap">
                                        <div class="cog-icon"><a href="#"><img src="/assets/img/svg_icon-18.svg"></a>
                                        </div>
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
                                                <div class="follow-btn-wrap"><a href="#" class="follow-btn">聊天</a></div>
                                                <div class="follow-cnt"><a href="friend.html">
                                                        <div class="user-pic-m"><img src="/assets/img/userpic-2.jpg">
                                                        </div>
                                                        <div class="pic-m-info">
                                                            <h5></h5>
                                                            <span class="icon-s award"></span><span><a
                                                                        class="lev-btn"></a></span></div>
                                                    </a>
                                                </div>
                                            </li>
                                            <!--ppl-no2-->
                                            <li class="follow-ppl">
                                                <div class="follow-btn-wrap"><a href="#" class="follow-btn">聊天</a></div>
                                                <div class="follow-cnt"><a href="friend.html">
                                                        <div class="user-pic-m"><img src="/assets/img/userpic-2.jpg">
                                                        </div>
                                                        <div class="pic-m-info">
                                                            <h5></h5>
                                                            <span class="icon-s award"></span><span><a
                                                                        class="lev-btn"></a></span></div>
                                                    </a>
                                                </div>
                                            </li>
                                            <!--ppl-no3-->
                                            <li class="follow-ppl">
                                                <div class="follow-btn-wrap"><a href="#" class="follow-btn">聊天</a></div>
                                                <div class="follow-cnt"><a href="friend.html">
                                                        <div class="user-pic-m"><img src="/assets/img/userpic-2.jpg">
                                                        </div>
                                                        <div class="pic-m-info">
                                                            <h5></h5>
                                                            <span class="icon-s award"></span><span><a
                                                                        class="lev-btn"></a></span></div>
                                                    </a>
                                                </div>
                                            </li>
                                            <!--ppl-no4-->
                                            <li class="follow-ppl">
                                                <div class="follow-btn-wrap"><a href="#" class="follow-btn">聊天</a></div>
                                                <div class="follow-cnt"><a href="friend.html">
                                                        <div class="user-pic-m"><img src="/assets/img/userpic-2.jpg">
                                                        </div>
                                                        <div class="pic-m-info">
                                                            <h5></h5>
                                                            <span class="icon-s award"></span> <span><a
                                                                        class="lev-btn"></a></span></div>
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
</form>

<input type="hidden" name="pageType" value="info"/>
<!--<link rel="stylesheet" href="--><?php //echo base_url(); ?><!--assets/js/colorbox/colorbox.css">-->
<!--<script src="--><?php //echo base_url(); ?><!--assets/js/colorbox/jquery.colorbox-min.js"></script>-->


<script>
    $("#edit-self-label .info-label article").each(function () {
        $("#edit-self-label .up-label-wrap article").find(":checkbox[value=" + $(this).attr("lid") + "]").attr("checked", "checked");
    })
    $(document).ready(function () {
        //編輯個人化標籤
        $(".freestyle-label-btn").click(function (event) {
            $.colorbox({
                inline: true,
                width: "auto",
                height: "auto",
                overlayClose: true,
                closeButton: false,
                escKey: false,
                href: '#edit-self-label'
            });
        });

        $('.up-label-input').bind('input propertychange', function () {
            $('.errortip').remove();
        });

        $("#edit-self-label").on("click", ".up-label-wrap article:not('.self-add') h4", function () {
            $(this).siblings("label").find(":checkbox").get(0).click();
        })

        $("#edit-self-label").on("click", ".up-label-wrap article:not('.self-add') :checkbox", function () {
            var self = $(this);
            self.attr("disabled", "disabled");

            if ($(this).prop("checked")) {
                if ($("#selNum").html() >= 10) {
                    $(this).prop("checked", false);
                    self.removeAttr("disabled");
                    return;
                }
                $("#selNum").html(parseInt($("#selNum").html()) + 1);
                $("#edit-self-label .info-label").append("<article lid=\"" + $(this).val() + "\">" + $(this).closest("label").siblings("h4").html() + "<span><img src=\"/assets/img/svg_icon-38-w.svg\"></span></article>");
                $(".info-edit-cnt .info-label").append("<article lid=\"" + $(this).val() + "\">" + $(this).closest("label").siblings("h4").html() + "<span><img src=\"/assets/img/svg_icon-38-w.svg\"></span></article>");
                self.removeAttr("disabled");
            } else {
                ajaxPost("/Label/delLabel", {
                    id: $(this).val()
                }, function (data) {
                    if (data.status == "success") {

                        $("#edit-self-label .info-label").find("article[lid=" + self.val() + "]").remove();
                        $(".info-edit-cnt .info-label").find("article[lid=" + self.val() + "]").remove();
                        $("#selNum").html(parseInt($("#selNum").html()) - 1);
                        self.removeAttr("disabled");
                    }
                })
            }
        })

        $("#edit-self-label .info-label").on("click", "article span img", function () {
            $("#edit-self-label .up-label-wrap article").find(":checkbox[value=" + $(this).closest("article").attr("lid") + "]").get(0).click();
        })
        $(".info-edit-label .info-label").on("click", "article span img", function () {
            $("#edit-self-label .up-label-wrap article").find(":checkbox[value=" + $(this).closest("article").attr("lid") + "]").get(0).click();
            $(this).closest("article").remove();
            return false;
        })

        $(".self-add-btn").click(function () {
            $('.errortip').remove();
            $(this).attr("disabled", "disabled");
            var input = $.trim($(".up-label-input").val());

            if (input == "") {
                $(".up-label-input").focus();
                $("<div class=\"errortip\" style=\"text-align:center;color:red\"><?=$this->lang->line('label_not_empty')?>!</div>").insertBefore($(".btn-area .pop-btn"));
                return false;
            }

            // var ExistLable = $("#edit-self-label .up-label-wrap article h4:contains(" + input + ")");
            // if (ExistLable.length > 0) {
            //     $(".up-label-input").val('');
            //     // ExistLable.closest("article").insertBefore($("#edit-self-label .self-add"));
            //     return false;
            // }

            ajaxPost("/Label/addLabel", {
                label: input
            }, function (data) {
                if (data.status == "success") {

                    $(
                        // $("<article class=\"up-label-cnt\">\n" +
                        "                <input type=\"checkbox\" checked value=\"" + data.data.id + "\" name=\"label[]\" style=\"display:none\">\n").insertBefore($("#edit-self-label .self-add"));
                    //     "            <h4>"+input+"</h4>\n" +
                    //     "            </article>").insertBefore($("#edit-self-label .self-add"));
                    $("<article lid=\"" + data.data.id + "\">" + input + "<span><img src=\"/assets/img/svg_icon-38-w.svg\"></span></article>").insertAfter($("#edit-self-label #add-label"));
                    $("<article lid=\"" + data.data.id + "\">" + input + "<span><img src=\"/assets/img/svg_icon-38-w.svg\"></span></article>").insertAfter($(".info-edit-label #add-label-listen"));

                    $(".up-label-input").val('');
                    $(".self-add-btn").removeAttr("disabled");
                }
            })
        });
    });
    $(".pop-btn").click(function () {
        $.colorbox.close();
    });
</script>
<script>
    function validate() {
        $(".l-error").remove();
        if ($("textarea[name=resume]").val().length > 255) {
            $("textarea[name=resume]").focus();
            $("<span class='l-error' style='color:red'><?=$this->lang->line('member_resume_exceed_max_len')?></span>").insertAfter($("textarea[name=resume]"));
            return false;
        }
        var flag = true;
        $("#school_department input[name=school\\[\\]]").each(function () {
            if ($(this).val().length > 10) {
                $(this).focus();
                $("<span class='l-error' style='color:red'><?=$this->lang->line('member_school_exceed_max_len')?></span>").insertAfter($(this).parent());
                flag = false;
                return false;
            }
        })
        if (!flag) {
            return false;
        }
        $("#school_department input[name=department\\[\\]]").each(function () {
            if ($(this).val().length > 10) {
                $(this).focus();
                $("<span class='l-error' style='color:red'><?=$this->lang->line('member_dpm_exceed_max_len')?></span>").insertAfter($(this).parent());
                flag = false;
                return false;
            }
        })
        if (!flag) {
            return false;
        }
        return true;
    }

</script>

<!--<script src="/assets/js/fileupload/vendor/jquery.ui.widget.js"></script>-->
<!--<script src="/assets/js/fileupload/jquery.iframe-transport.js"></script>-->
<!--<script src="/assets/js/fileupload/jquery.fileupload.js"></script>-->
<!--<script src="/assets/js/nailthumb/jquery.nailthumb.1.1.min.js"></script>-->
<!--<link rel="stylesheet" href="/assets/js/nailthumb/jquery.nailthumb.1.1.min.css">-->
<!--<script src="/assets/js/jquery.cookie.js"></script>-->
<script src="/assets/jquery-ui-1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="/assets/jquery-ui-1.12.1/jquery-ui.css">
<script src="/assets/js/jquery.mousewheel.min.js"></script>
<script src="/assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="/assets/js/wei_common.js?v=<?= uniqid() ?>"></script>

<!--<script src="/assets/js/jquery.caret.js"></script>-->
<!--<script src="/assets/js/at/jquery.atwho.js"></script>-->
<!--<link rel="stylesheet" href="/assets/js/at/jquery.atwho.min.css">-->
<script>
    var Str = {
        byteLen: function (str) {
            //正则取到中文的个数，然后len*count+原来的长度。不用replace
            str += '';
            var tmp = str.match(/[^\x00-\xff]/g) || [];
            return str.length + tmp.length;
        },
        getMaxlen: function (str, maxlen) {
            var sResult = '', L = 0, i = 0, stop = false, sChar;
            if (str.replace(/[^\x00-\xff]/g, 'xxx').length <= maxlen) {
                return str;
            }
            while (!stop) {
                sChar = str.charAt(i);
                L += sChar.match(/[^\x00-\xff]/) !== null ? 2 : 1;
                if (L > maxlen) {
                    stop = true;
                } else {
                    sResult += sChar;
                    i++;
                }
            }
            return sResult;
        }
    };
    document.querySelector('#text').addEventListener('input', function () {
        var value = this.value,
            maxlength = this.getAttribute('maxlength');
        if (Str.byteLen(value) > maxlength) {
            this.value = Str.getMaxlen(value, maxlength);
        }
    });

    $("document").ready(function(){
        // 新增任職公司
        $("div.self-list-add.company-clone").click(function(){

            if($("li.info-company").length >= 10){
                return;
            }

            var company = $(this).closest("li.info-company");
            var new_item = company.clone();
            //$("input[type='checkbox']",new_item).attr("value", "companies_" + ($("li.info-company").length - 1) );
            //$("input[type='checkbox']",company).attr("value", "companies_" + ($("li.info-company").length) );
            $("div.self-list-add", new_item).removeClass("company-clone").addClass("company-remove");
            new_item.insertBefore(company);
            $("input[name='company[]']", company).val("");
            $("input[name='position[]']", company).val("");
            $("div.self-list-add img", new_item).attr("src", "/assets/img/svg_icon-77.svg");
            $("div.self-list-add.company-remove").unbind("click");
            $("div.self-list-add.company-remove").click(deleteCompany);

            if($("li.info-company").length >= 10){
                $(this).hide();
            }

            $("li.info-company input[type='checkbox']").each(function(e){
                $(this).attr("value", "companies_" + e);
            });
        });

        // 新增學歷
        $("div.self-list-add.school-clone").click(function(){
            if($("li.info-education").length >= 10){
                return;
            }
            var school = $(this).closest("li.info-education");
            var new_item = school.clone();
            $("input[type='checkbox']",new_item).attr("value", "schools_" + ($("li.info-education").length - 1) );
            $("input[type='checkbox']",school).attr("value", "schools_" + ($("li.info-education").length) );
            $("div.self-list-add", new_item).removeClass("school-clone").addClass("school-remove");
            new_item.insertBefore(school);
            $("input[name='school[]']", school).val("");
            $("input[name='department[]']", school).val("");
            $("div.self-list-add img", new_item).attr("src", "/assets/img/svg_icon-77.svg");
            $("div.self-list-add.school-remove").unbind("click");
            $("div.self-list-add.school-remove").click(deleteSchool);
            if($("li.info-education").length >= 10){
                $(this).hide();
            }

            $("li.info-education input[type='checkbox']").each(function(e){
                $(this).attr("value", "schools_" + e);
            });
        });

        if($("li.info-company").length >= 10){
            $("div.self-list-add.company-clone").hide();
        }
        if($("li.info-education").length >= 10){
            $("div.self-list-add.school-clone").hide();
        }

        // 因為核取方塊(checkbox)是套用效果，因此畫面上有打鉤，但實際上並為有checked的行為，故送出時後端會收不到值
        // 處理核取方塊效
        $("label.checkbox-wrap").click(function(event){
            event.stopPropagation();
            var checked = $("input[type='checkbox']", $(this)).prop("checked");
            if(checked){
                $("input[type='checkbox']", $(this)).attr("checked", "checked");
            }
            else{
                $("input[type='checkbox']", $(this)).removeAttr("checked");
            }

        });

        $("li.info-company input[type='checkbox']").each(function(e){
            $(this).attr("value", "companies_" + e);
        });

        $("li.info-education input[type='checkbox']").each(function(e){
            $(this).attr("value", "schools_" + e);
        });

    });

    $("div.self-list-add.company-remove").click(deleteCompany);

    function deleteCompany(){
        var company = $(this).closest("li.info-company");
        company.remove();
        //var company = $("div.self-list-add.company-clone").closest("li.info-company");
        //$("input[type='checkbox']",school).attr("value", "companies_" + ($("li.info-company").length - 1) );
        if($("li.info-company").length < 10){
            $("div.self-list-add.company-clone").show();
        }

        $("li.info-company input[type='checkbox']").each(function(e){
            $(this).attr("value", "companies_" + e);
        });

    }

    $("div.self-list-add.school-remove").click(deleteSchool);
    function deleteSchool(){
        var school = $(this).closest("li.info-education");
        school.remove();
        //var school = $("div.self-list-add.school-clone").closest("li.info-education");
        //$("input[type='checkbox']",school).attr("value", "schools_" + ($("li.info-education").length - 1) );
        if($("li.info-education").length < 10){
            $("div.self-list-add.school-clone").show();
        }

        $("li.info-education input[type='checkbox']").each(function(e){
            $(this).attr("value", "schools_" + e);
        });
    }
</script>

<script src="/assets/js/include.js"></script>
<!--
<script src="/assets/js/column_fixed.js"></script>
-->
<div><?php require_once "includes/include-js.php"; ?></div>

</body>
</html>