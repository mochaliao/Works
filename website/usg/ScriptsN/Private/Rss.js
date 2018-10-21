$(function () {
    if ($(document).height() <= $(window).height()) {
        $(".bottom").css("bottom", "0").css("position", "fixed");
    }
    $(".slide_toggle").click(function () { $(this).next().slideToggle(); });
})

