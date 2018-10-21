$(function () {

    var mh = 0;
    $(".cls_h").each(function () {
        if ($(this).height() > mh) {
            mh = $(this).height();
        }
    })
    $(".cls_h").css("height", mh + 22);
})