$(function () {


    $("#ActivitiesAD").delegate(".DeCodeValUimg", "click", function () {
        $("#DeCodeVal").fadeOut();
    });



    if ($("#may-news-table").length > 0) {
        var h = $(document).height();
        var phone_mobilechange = false;
        $(".overlay").css({ "height": h });
        $(".overlay").css({ 'display': 'block' }).animate({ 'opacity': '0.4' });
        $(".may-news-list").stop(true).animate({ 'margin-top': '20%', 'opacity': '0.92' }, 800);
        $(".may-news-close").click(function () {
            $(".may-news-list").stop(true).animate({ 'margin-top': '-292px', 'opacity': '0' }, 800);
            $(".overlay").css({ 'display': 'none' }).animate({ 'opacity': '0' });
            return false;
        });
    }

    $('.carousel').carousel({
        interval: 5000
    })
});