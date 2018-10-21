var fxcalendar_config = {
    host: 'https://calendar.fxstreet.com',
    css: 'mini',
    rows: 30,
    pastevents: 5,
    hoursbefore: 20,
    timezone: 'UTC',
    showcountryname: 'false',
    columns: 'date,time,country,event,consensus,previous,volatility,actual',
    isfree: 'true',
    countrycode: 'AU,CA,JP,EMU,NZ,CH,UK,US',
    culture: '@culture'
};
$(function () {
    if ($(document).height() <= $(window).height()) {
        $(".bottom").css("bottom", "0").css("position", "fixed");
    }
    $.getScript("https://calendar.fxstreet.com/scripts/mini", function () {
        $(window).load(function () {
            //remove event class
            $(".fxst-evenRow").removeClass();
            $(".fxst-oddRow").removeClass();

            //remove attr
            $(".fxst-td-event a").removeAttr("href");
        });
    });
})