<div class="self-info">
    <!--20180309 add 完善個人資料-->
    <div class="self-info-btn"><a href="#" class="tooltip-p"><span class="tooltip-p-text">完善個人資料</span><img src="/assets/img/svg_icon-73.svg"></a></div>
    <!--******-->
    <div class="self-info-cover"><img src="<?= $banner ?>" onerror="this.src='/assets/img/friend2-cover.jpg'"></div>
    <div class="self-info-cnt-wrap">
        <div class="self-info-cnt">
            <div class="user-pic-l"><a href="/page/info"><img src="<?= $avatar ?>" onerror="this.src='/assets/img/self-user-pic.jpg'"></a></div>
            <div class="info-cnt">
                <ul>
                    <li>
                        <span class="h5"><?= $nickname ?></span>

                    </li>
                    <li>
                        <ul  class="info-cnt-inner">
                            <li><span class="icon-m award"></span></li>
                            <li><a class="lev-btn">Lv.<?= $level ?></a></li>
                            <li class="i-money h6">
                                <a class="tooltip-p"><span class="tooltip-p-text">i盾</span></a>:<span><?= number_format($money) ?></span>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
        <div class="self-info-list">
            <ul class="clearfix">
                <li class="edit-post ">
                    <a><h6><?=$this->lang->line('post')?></h6><h4><?=$postCount?></h4></a>
                </li>
                <li class="edit-fans">
                    <a><h6><?=$this->lang->line('fans')?></h6><h4><?=$fansCount?></h4></a>
                </li>
                <li class="edit-follower">
                    <a><h6><?=$this->lang->line('trace')?></h6><h4><?=$traceCount?></h4></a>
                </li>
            </ul>
        </div>
    </div>
</div>


<a href="<?php echo base_url();?>hot/post">
    <div class="h-tag-side box-wrap">
        <div>
            <article class="tag-hot-post">
                <ul>
                    <li class="tag-hot-post"><span><img src="<?php echo base_url();?>assets/img/svg_icon-67.svg"></span></li>
                    <li>
                        <h4><?php echo $this->lang->line('hot_posts');?></h4>
                    </li>
                </ul>
            </article>
        </div>
    </div>
</a>
<a href="<?php echo base_url();?>hot/video">
    <!--人氣視頻 Hot Video-->
    <div class="h-tag-side box-wrap">
        <div>
            <article class="tag-hot-video">
                <ul>
                    <li class="tag-hot-video"><span><img src="<?php echo base_url();?>assets/img/svg_icon-66.svg"></span></li>
                    <li>
                        <h4><?php echo $this->lang->line('hot_videos');?></h4>
                    </li>
                </ul>
            </article>
        </div>
    </div>
</a>
<div class="h-tag-side box-wrap">
    <div> <a href="#">
            <article class="tag-events">
                <ul>
                    <li class="tag-events"><span><img src="/assets/img/svg_icon-69.svg"></span></li>
                    <li>
                        <h4><?php echo $this->lang->line('activity_zone');?></h4>
                    </li>
                </ul>
            </article>
        </a> </div>
</div>
<!--社團專區 Clubs-->
<div class="h-tag-side box-wrap">
    <div> <a href="#">
            <article class="tag-clubs">
                <ul>
                    <li class="tag-clubs"><span><img src="/assets/img/svg_icon-68.svg"></span></li>
                    <li>
                        <h4><?php echo $this->lang->line('social_zone');?></h4>
                    </li>
                </ul>
            </article>
        </a> </div>
</div>

<!--好友直播 -->
<div class="h-tag-side box-wrap">
    <div> <a href="/live/live_show_friend">
            <article class="tag-clubs">
                <ul>
                    <li class="tag-clubs"><span><img src="/assets/img/icon-live-gold.svg"></span></li>
                    <li>
                        <h4><?php echo $this->lang->line('live_show_friend');?></h4>
                    </li>
                </ul>
            </article>
        </a> </div>
</div>

<!--0410-->
<div class="apply-live-side-btn">
    <a class="apply-live-side-btn active" href="/live/apply_live_show"><?php echo $this->lang->line('register-as-streamer');?></a>
</div>
<!--/0410-->