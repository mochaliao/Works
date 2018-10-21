function retop() {

    //if ($(window).width() <= 320) {
    //    $(".Usg-Box-Title").css("padding-top", 300)
    //} else {
    //    $(".Usg-Box-Title").css("padding-top", 300 * ($(window).width() / 270))
    //}

    //Change flexslider Height
    $(".carousel-inner .item a .fill").css({
        'width': '100%',
        'height': $(".Usg-photo").height()
    });

    $('.carousel').carousel({
        interval: 5000
    })

    //if (culture.toLowerCase() == "zh-cn") {
    if (!$("#ActivitiesAD").attr("showed")) {
        setTimeout(Show5000USDInfo, 500);
    }
    else {
        if (culture.toLowerCase() == "zh-cn") {
            $("#ActivitiesAD").css('margin-right', ReCompPosY());
        }
        else {
            $("#ActivitiesAD").css('margin-right', "0px");
        }
    }
    //}
}

function Show5000USDInfo() {
    if (culture.toLowerCase() == "zh-cn") {
        $("#ActivitiesAD").stop(true).animate({ 'margin-top': 0, 'margin-right': ReCompPosY() }, { duration: 800, complete: function () { $('body').css("overflow-x", "initial") } });
    }
    else {
        if (culture.toLowerCase() != "zh-tw") {
            $("#ActivitiesAD").stop(true).animate({ 'margin-top': 0, 'margin-right': "0px" }, { duration: 800, complete: function () { $('body').css("overflow-x", "initial") } });
        }
    }
}

function ReCompPosY() {
    return ($(window).width() - $("#Activities5000USDimg").width()) / 2;
}


$(function () {

    if ($("#may-news-table").length > 0) {

        //if (culture.toLowerCase() == "zh-cn") {
        $("#ActivitiesAD").attr("showed", true);
        //}

        var h = $(document).height();
        var phone_mobilechange = false;
        $(".overlay").css({ "height": h });

        $(".overlay").css({ 'display': 'block' }).animate({ 'opacity': '0.4' });
        $(".may-news-list").stop(true).animate({ 'margin-top': '20%', 'opacity': '0.92' }, 800);

        $(".may-news-close").click(function () {
            $(".may-news-list").stop(true).animate({ 'margin-top': '-292px', 'opacity': '0' }, 800);
            $(".overlay").css({ 'display': 'none' }).animate({ 'opacity': '0' });

            if (culture.toLowerCase() == "zh-cn") {
                Show5000USDInfo();
            }
            return false;
        });
    }

    //if (culture.toLowerCase() == "zh-cn") {
    $("#ActivitiesAD").css("margin-right", ReCompPosY());
    if (!$("#ActivitiesAD").attr("showed")) {
        $("#ActivitiesAD").attr("showed", true);
        setTimeout(Show5000USDInfo, 500);
    }
    //}

    window.addEventListener("orientationchange", retop, false);
})

$(window).load(function () {
    $.ay.marquee({ target: $('.Usg-AD.left'), direction: 'left', speed: 10000, implementation: 'css2' });
    retop();
});

$(window).resize(function () { retop() });


