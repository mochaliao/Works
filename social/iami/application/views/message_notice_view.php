<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="/assets/img/iami-logo-icon.png">
    <title><?= SITE_NAME ?></title>
    <link rel="stylesheet" href="/assets/css/common.css">
    <link rel="stylesheet" href="/assets/css/self-page.css">
    <link rel="stylesheet" href="/assets/css/notice.css">
    <script src="/assets/js/common.js"></script>
</head>

<body class="<?php echo $this->session->userdata('language_id') ?>">
<div class="wrapper">
    <!--pop-->
    <?php include(dirname(__FILE__) . "/includes/include.php"); ?>
    <!--header-->
    <?php include(dirname(__FILE__) . "/includes/top.php"); ?>

    <?php echo form_open('', array('class' => 'post-form', 'id' => 'post-form')); ?>
    <input type="hidden" name="member_id" value="<?= $member_id ?>"/>
    <input type="hidden" id="selfid" value="<?= $this->session->userdata("member_id") ?>"/>
    </form>
    <!-- Main -->
    <div class="noticebox main-content">
        <h4 class="message-subtitle"><?php echo $this->lang->line('Chat-message');?></h4>

        <?php foreach ($datas as $data): ?>

            <div class="notice-wrapper " style="cursor:pointer;"
                 onclick="location.href='/chat/<?php echo $data->member_id; ?>';">
                <div class="notice-head">
                    <a href="/page/info?i=<?php echo $data->member_id; ?>">
                        <img src="<?php echo $data->avatar; ?>" onerror="this.src='/assets/img/self-user-pic.jpg'">
                    </a>
                </div>

                <div class="notice-txt">
                    <a href="/page/info?i=<?php echo $data->member_id; ?>"><?php echo $data->nickname; ?></a>
                    <!--、<a href="#">徐老師</a>和其他 219 人最近都說<a href="#">家政富</a>-->
                    <?php echo $this->lang->line('talk-to-you');?>「<?php echo $data->msg; ?>」
                </div>
                <div class="notice-icon">
                    <!-- <p class="icon-heart page-icons"></p> -->
                    <p class="notice-time"><?php echo $data->time . "  ";
                        echo get_time_from_now($data->create_time) ?></p>
                </div>
            </div>

        <?php endforeach; ?>

        <!--
      <div class="notice-wrapper wrapper-unread">
        <div class="notice-head"><img src="/assets/img/ga-pic_7.jpg"></div>
        <div class="notice-txt"><a href="#">蕭敬騰</a>、<a href="#">李四端</a>和其他 219 人最近都最近都收藏了你的貼文：「兩點之間最短的距離不是一
          條直線而是一條障礙最小的曲線⋯⋯」</div>
        <div class="notice-icon">
          <p class="icon-star page-icons"></p>
          <p class="notice-time">11分鐘前</p>
        </div>
      </div>
      <div class="notice-wrapper">
        <div class="notice-head"><img src="/assets/img/ga-pic_7.jpg"></div>
        <div class="notice-txt"><a href="#">蕭敬騰</a>分享了你的貼文。</div>
        <div class="notice-icon">
          <p class="icon-share page-icons"></p>
          <p class="notice-time">11分鐘前</p>
        </div>
      </div>
      <div class="notice-wrapper">
        <div class="notice-head"><img src="/assets/img/ga-pic_14.jpg"></div>
        <div class="notice-txt"><a href="#">趙傳</a>和<a href="#">徐佳微</a>也回應了你的貼文。</div>
        <div class="notice-icon">
          <p class="icon-reply page-icons"></p>
          <p class="notice-time">11分鐘前</p>
        </div>
      </div>
      <div class="notice-wrapper">
        <div class="notice-head"><img src="/assets/img/ga-pic_7.jpg"></div>
        <div class="notice-txt"><a href="#">蕭敬騰</a>、<a href="#">李四端</a>和其他 219 人最近都最近都收藏了你的貼文：「兩點之間最短的距離不是一
          條直線而是一條障礙最小的曲線⋯⋯」</div>
        <div class="notice-icon">
          <p class="icon-star page-icons"></p>
          <p class="notice-time">11分鐘前</p>
        </div>
      </div>
      <div class="notice-wrapper">
        <div class="notice-head"><img src="/assets/img/ga-pic_7.jpg"></div>
        <div class="notice-txt"><a href="#">蕭敬騰</a>分享了你的貼文。</div>
        <div class="notice-icon">
          <p class="icon-share page-icons"></p>
          <p class="notice-time">11分鐘前</p>
        </div>
      </div>
      <div class="notice-wrapper">
        <div class="notice-head"><img src="/assets/img/ga-pic_14.jpg"></div>
        <div class="notice-txt"><a href="#">趙傳</a>和<a href="#">徐佳微</a>也回應了你的貼文。</div>
        <div class="notice-icon">
          <p class="icon-reply page-icons"></p>
          <p class="notice-time">11分鐘前</p>
        </div>
      </div>
        -->
    </div>
</div>

<!-- jQuery for 訊息管理 Setting Panel -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
    function DropDown(el) {
        this.dd = el;
        this.placeholder = this.dd.children('span');
        this.opts = this.dd.find('ul.dropdown > li');
        this.val = '';
        this.index = -1;
        this.initEvents();
    }

    DropDown.prototype = {
        initEvents: function () {
            var obj = this;

            obj.dd.on('click', function (event) {
                $(this).toggleClass('active');
                return false;
            });

            obj.opts.on('click', function () {
                var opt = $(this);
                obj.val = opt.text();
                obj.index = opt.index();
                obj.placeholder.text(obj.val);
            });
        },
        getValue: function () {
            return this.val;
        },
        getIndex: function () {
            return this.index;
        }
    }

    $(function () {
        var dd = new DropDown($('#dd'));
        $(document).click(function () {
            // all dropdowns
            $('.wrapper-dropdown-3').removeClass('active');
        });
    });
</script>
<script src="/assets/js/wei_common.js?v=<?= uniqid() ?>"></script>
<script src="/assets/js/include.js"></script>
<div><?php require_once "includes/include-js.php"; ?></div>
</body>
</html>