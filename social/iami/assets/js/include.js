$(document).ready(function () {
    //貼文預覽圖片(all)
    $('.post-pic').hide();
    $('.photo').click(function () {
        // $('.post-pic').slideToggle(300);
    });

    //開關貼文訊息
    $('.items-dropdown-wrap#mes1').hide();
    $('.tool-message#mes1').click(function () {
        $('.items-dropdown-wrap#mes1').slideToggle(500);
        return false;
    });

    $('.items-dropdown-wrap#mes2').hide();
    $('.tool-message#mes2').click(function () {
        $('.items-dropdown-wrap#mes2').slideToggle(500);
        return false;
    });

    //手機版搜尋
    $('.m-search-area').hide();
    $('.search').click(function () {
        // $('.m-search-area').slideToggle(500);
        $('.m-search-area').slideDown();
        return false;
    });
});

// $(document).ready(function() {
//     //header通知＋下拉選單(all)
//     $('.flyout-box').hide();
//     $('.invite').click(function() {
//         $('.flyout-box#notify').hide();
//         $('.flyout-box#message').hide();
//         $('.flyout-box#dropdown').hide();
//         $('.flyout-box#invite').slideToggle(500);
//         return false;
//     });
//     $('.notify').click(function() {
//         $('.flyout-box#invite').hide();
//         $('.flyout-box#message').hide();
//         $('.flyout-box#dropdown').hide();
//         $('.flyout-box#notify').slideToggle(500);
//         return false;
//     });
//     $('.message').click(function() {
//         $('.flyout-box#invite').hide();
//         $('.flyout-box#notify').hide();
//         $('.flyout-box#dropdown').hide();
//         $('.flyout-box#message').slideToggle(500);
//         return false;
//     });
//     $('.self-dropdown-cnt').click(function() {
//         $('.flyout-box#invite').hide();
//         $('.flyout-box#notify').hide();
//         $('.flyout-box#message').hide();
//         $('.flyout-box#dropdown').slideToggle(500);
//         return false;
//     });
//     return false;
// });
//
// $(document).click(function() {
//     $('.flyout-box').hide();
// });


$(function () {
    //Chat Popup(all)
    $("#addClass").click(function () {
        $('#qnimate').addClass('popup-box-on');
    });

    $("#removeClass").click(function () {
        $('#qnimate').removeClass('popup-box-on');
    });
})


$(document).ready(function () {
    //分享(all)
    $(".tool-share").click(function (event) {
        // event.preventDefault();
        $.colorbox({
            inline: true,
            width: "auto",
            height: "auto",
            overlayClose: true,
            closeButton: false,
            escKey: false,
            href: '#share-post'
            //scalePhotos: true
        });
    });

    //按讚的人(all)
    $(".items-like-txt a").click(function (event) {
        $.colorbox({
            inline: true,
            width: "auto",
            height: "auto",
            overlayClose: true,
            closeButton: false,
            escKey: false,
            href: '#like-list',
            //scalePhotos: true
            onComplete: function (e) {

            }
        });


    });

    //修改密碼(all)
    $(".modify-ps").click(function (event) {
        $.colorbox({
            inline: true,
            width: "auto",
            height: "auto",
            overlayClose: true,
            closeButton: false,
            escKey: true,
            href: '#modify-form'
        });
    });

    //編輯個人大頭照(info)
    $(".del_picture").click(function (event) {
        // event.preventDefault();
        $.colorbox({
            inline: true,
            width: "auto",
            height: "auto",
            overlayClose: true,
            closeButton: false,
            escKey: false,
            href: '#edit-self-pic'
        });
    });
    //編輯大頭照-剪裁(info)
    $(".edit-self-pic-btn").click(function (event) {
        // event.preventDefault();
        $.colorbox({
            inline: true,
            width: "auto",
            height: "auto",
            overlayClose: true,
            closeButton: false,
            escKey: false,
            href: '#scale-self-pic'
            //scalePhotos: true
        });
    });

    // $(".picture_group").colorbox({rel:'picture_group'});
    // $(".picture_group2").colorbox({rel:'picture_group2'});
    // $(".picture_group3").colorbox({rel:'picture_group3'});
    // $(".picture_group4").colorbox({rel:'picture_group4'});
});

$(".pop-btn").click(function () {
    $.colorbox.close();
});

var textOriHeight;
//textarea resize height
$(function () {
    var text = document.getElementById("topCnt-textarea");
    if (text != undefined) {
        autoTextarea(text);
        textOriHeight = $(text).height();
    }

    // autoTextarea(document.getElementById("include-textarea"));
});


//tool-tip
if ($("a.tip-mark").length > 0) {
    $("a.tip-mark").click(function () {
        $(this).toggleClass('active');
        return false;
    });
}

$(".form").click(function () {
    $('a.tip-mark.active').removeClass('active');
});

$(".popup-box-p").click(function () {
    $('a.tip-mark.active').removeClass('active');
});


//
$(document).click(function () {
    $('.flyout-box').hide();
    $('.flyout-box2').hide();
    $(".edit-post-drop").slideUp(500);
    if ($(".box-wrap.top-cnt .btn-gray").length > 0) {
        $(".box-wrap.top-cnt .btn-gray").closest(".box-wrap.top-cnt").addClass("disable");
        $(".box-wrap.top-cnt .post-edit-publish").removeClass("post-edit-publish").addClass("post-publish").siblings().remove();
        $(".edit-post-text").val("");
        $(".tool-icon-g").css({'visibility': 'visible'});
        $(".post-edit-publish").closest(".box-wrap.top-cnt").addClass("disable");
    }
});
$("body").on("click", "#cboxWrapper", function (event) {
    event.stopPropagation();
});

