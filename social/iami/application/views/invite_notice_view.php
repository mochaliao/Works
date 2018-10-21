<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="/assets/img/iami-logo-icon.png">
    <title><?= SITE_NAME ?></title>
    <link rel="stylesheet" href="/assets/css/common.css">
  <link rel="stylesheet" href="/assets/css/reg-page.css?v=<?php echo getVersion(); ?>">
    <link rel="stylesheet" href="/assets/css/self-page.css">
    <link rel="stylesheet" href="/assets/css/notice.css">
    <!--    <script src="/assets/js/jquery-1.8.3.min.js"></script>-->
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
    <div class="noticebox main-content" id="inviteList">
        <h4 class="invite-subtitle"><?php echo $this->lang->line('your-invite');?></h4>
        <?php foreach ($datas as $data): ?>

            <div class="notice-wrapper no-border-hover" member-id="<?php echo $data["member_id"]; ?>">
                <div class="notice-head">
                    <a href="/page/info?i=<?php echo $data["member_id"]; ?>">
                        <img src="<?php echo $data["avatar"]; ?>" onerror="this.src='/assets/img/self-user-pic.jpg'">
                    </a>
                </div>

                <div class="notice-txt">
                    <a href="/page/info?i=<?php echo $data["member_id"]; ?>"><?php echo $data["nickname"]; ?></a>
                    <!--、<a href="#">徐老師</a>和其他 219 人最近都說<a href="#">家政富</a>-->
                    <?php echo $this->lang->line('invite-you-as-friend');?>
                </div>
                <div class="notice-icon">

                    <a href="javascript:void(0);" class="invite-ok-btn floatleft"><?php echo $this->lang->line('invite-assure');?></a>
                    <a href="javascript:void(0);" class="invite-del-btn floatleft"><?php echo $this->lang->line('invite-delete');?></a>

                    <!-- <p class="icon-heart page-icons"></p> -->
                    <!-- <p class="notice-time"><?php echo get_time_from_now($data->createTime) ?></p>-->
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
<!--<script src="/assets/js/jquery-1.8.3.min.js"></script>-->
<!--<script src="/assets/js/mMenu.js"></script>-->
<!--<script>-->
<!--    //切換貼文、粉絲、追蹤-->
<!--    $(document).ready(function () {-->
<!--        $('.edit-post').click(function () {-->
<!--            $('.edit-cnt li.active').removeClass('active');-->
<!--            $('.edit-post').addClass('active');-->
<!--            $('#post').addClass('active');-->
<!--            $('#fans.active').removeClass('active');-->
<!--            $('#follower.active').removeClass('active');-->
<!--        });-->
<!--    });-->
<!--    $(document).ready(function () {-->
<!--        $('.edit-fans').click(function () {-->
<!--            $('.edit-cnt li.active').removeClass('active');-->
<!--            $('.edit-fans').addClass('active');-->
<!--            $('#fans').addClass('active');-->
<!--            $('#post.active').removeClass('active');-->
<!--            $('#follower.active').removeClass('active');-->
<!--        });-->
<!--    });-->
<!--    $(document).ready(function () {-->
<!--        $('.edit-follower').click(function () {-->
<!--            $('.edit-cnt li.active').removeClass('active');-->
<!--            $('.edit-follower').addClass('active');-->
<!--            $('#follower').addClass('active');-->
<!--            $('#post.active').removeClass('active');-->
<!--            $('#fans.active').removeClass('active');-->
<!--        });-->
<!--    });-->
<!---->
<!--    //開關貼文訊息-->
<!--    $(document).ready(function () {-->
<!--        $('.items-dropdown-wrap#mes1').hide();-->
<!--        $('.tool-message#mes1').click(function () {-->
<!--            $('.items-dropdown-wrap#mes1').slideToggle(500);-->
<!--            return false;-->
<!--        });-->
<!--    });-->
<!--    $(document).ready(function () {-->
<!--        $('.items-dropdown-wrap#mes2').hide();-->
<!--        $('.tool-message#mes2').click(function () {-->
<!--            $('.items-dropdown-wrap#mes2').slideToggle(500);-->
<!--            return false;-->
<!--        });-->
<!--    });-->
<!---->
<!--    //開關通知-->
<!--    $(document).ready(function () {-->
<!--        $('.flyout-box').hide();-->
<!--        $('.invite').click(function () {-->
<!--            $('.flyout-box#notify').hide();-->
<!--            $('.flyout-box#message').hide();-->
<!--            $('.flyout-box#dropdown').hide();-->
<!--            $('.flyout-box#invite').slideDown(500);-->
<!--            return false;-->
<!--        });-->
<!--        $('.notify').click(function () {-->
<!--            $('.flyout-box#invite').hide();-->
<!--            $('.flyout-box#message').hide();-->
<!--            $('.flyout-box#dropdown').hide();-->
<!--            $('.flyout-box#notify').slideDown(500);-->
<!--            return false;-->
<!--        });-->
<!--        $('.message').click(function () {-->
<!--            $('.flyout-box#invite').hide();-->
<!--            $('.flyout-box#notify').hide();-->
<!--            $('.flyout-box#dropdown').hide();-->
<!--            $('.flyout-box#message').slideDown(500);-->
<!--            return false;-->
<!--        });-->
<!--        $('.self-dropdown-cnt').click(function () {-->
<!--            $('.flyout-box#invite').hide();-->
<!--            $('.flyout-box#notify').hide();-->
<!--            $('.flyout-box#message').hide();-->
<!--            $('.flyout-box#dropdown').slideDown(500);-->
<!--            return false;-->
<!--        });-->
<!--        return false;-->
<!--    });-->
<!---->
<!--    $(document).click(function () {-->
<!--        $('.flyout-box').hide();-->
<!--        $('.flyout-box2').hide();-->
<!--    });-->
<!--</script>-->

<script>
    $(function () {

        $("#inviteList").on("click", ".invite-ok-btn", function () {
            var self = $(this).attr("disabled", "disabled");
            var removeLi = self.closest(".notice-wrapper");
            var inviter_id = removeLi.attr("member-id");

            ajaxPost("/invite/setInviteStatus", {
                "invitee_id": inviter_id,
                "status": "1"
            }, function (response) {
                if (response.status == "success") {
                    delViewInvite(removeLi);
                }
            });
        });

        $("#inviteList").on("click", ".invite-del-btn", function () {
            var self = $(this).attr("disabled", "disabled");
            var removeLi = self.closest(".notice-wrapper");
            var inviter_id = removeLi.attr("member-id");

            ajaxPost("/invite/setInviteStatus", {
                "invitee_id": inviter_id,
                "status": "0"
            }, function (response) {
                delViewInvite(removeLi);
            });
        });

        function delViewInvite(removeLi) {
            removeLi.remove();
            var span = $(".invite-bubble .bubble-txt span");
            var total = parseInt(span.attr("total")) - 1;
            span.attr("total", total);

            if (total < 100) {
                span.html(total);
            }
            if ($(".notice-wrapper").length == 0) {
                $(".invite-bubble").addClass("disable");
            }
        }
    })
</script>
<!-- jQuery for 訊息管理 Setting Panel -->
<script>
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