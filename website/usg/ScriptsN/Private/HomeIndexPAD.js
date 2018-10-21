function ReCompuADArea() {

    var ADAreaHeight = $(".ADArea").height();
    var BGVideoHeight = ADAreaHeight;
    var QuickRegTopVal = parseInt($(".Usg-QuickReg").css("margin-top")) - 20; //20 is upon empty of image 
    var OtherADsHeight = 0;
    var BGVideoLeftHeight = $(".Usg-Box").height() - (ADAreaHeight / 4) + 20;

    //Fix AwardADs Height
    if ($(window).width() > 1280) {
        $(".AwardADs").css({ "height": QuickRegTopVal + "px" });
        OtherADsHeight = ADAreaHeight - parseInt(QuickRegTopVal);
    }
    else {
        ADAreaHeight /= 4;
        $(".AwardADs").css({ "height": ADAreaHeight });
        OtherADsHeight = BGVideoHeight - ADAreaHeight;
    }

    //Fix OtherADs Height
    $(".OtherADs").css({ "height": OtherADsHeight });

    if (isPAD == "True") {

        Magin_Top = BGVideoLeftHeight + "px";
    }
    else {
        Magin_Top = "0px";
    }

    $("#ActivitiesAD").css({ 'margin-top': Magin_Top });
}

$(function () {

    ReCompuADArea();

    if (culture.toLowerCase() == "zh-cn") {
        $('body').css("overflow-x", "hidden");
        if (!$("#ActivitiesAD").attr("showed")) {
            setTimeout(Show5000USDInfo, 500);

            function Show5000USDInfo() {
                $("#ActivitiesAD").attr("showed", true).stop(true).animate({ 'margin-top': Magin_Top, 'margin-left': '0px' }, { duration: 800, complete: function () { $('body').css("overflow-x", "initial") } });
            }
        }

        $("#ActivitiesAD").delegate("#Activities5000USDimg", "click", function () {
            $("#Act5000USD").fadeOut();
        });
    }

    if ($("#may-news-table").length > 0) {

        if (culture.toLowerCase() == "zh-cn") {
            $("#ActivitiesAD").attr("showed", true);
        }

        var h = $(document).height();
        var phone_mobilechange = false;
        $(".overlay").css({ "height": h });

        $(".overlay").css({ 'display': 'block' }).animate({ 'opacity': '0.4' });
        $(".may-news-list").stop(true).animate({ 'margin-top': '20%', 'opacity': '0.92' }, 800);
        $(".may-news-close").click(function () {
            $(".may-news-list").stop(true).animate({ 'margin-top': '-292px', 'opacity': '0' }, 800);
            $(".overlay").css({ 'display': 'none' }).animate({ 'opacity': '0' });

            if (culture.toLowerCase() == "zh-cn") {
                $("#ActivitiesAD").stop(true).animate({ 'margin-top': Magin_Top, 'margin-left': '0px' }, { duration: 800, complete: function () { $('body').css("overflow-x", "initial") } });
            }
            return false;
        });
    }

    $(window).resize(function () {
        ReCompuADArea();
    });
});