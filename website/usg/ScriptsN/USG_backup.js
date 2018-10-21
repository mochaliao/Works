$(function () {
    livec.init();

    //選單
    $("#MainMenu").menu({ pauseSpeed: 100 });

    //背景影片
    $('#USG-BGVideo').videoBG({
        mp4: '../video/dock3.mp4',
        ogv: '../video/dock3.ogv',
        webm: '../video/dock3.webm',
        poster: '../video/dock.jpg',
        scale: true,
        autoplay: true,
        loop: true,
        zIndex: 0
    });

    //網頁影片旁的文字
    $("#Usg-Box-Title-Marquee").marquee({ yScroll: "bottom" });

    //社群按鈕變換
    var BtnIcon = null;
    $('.LinkBtn').hover(function () {
        BtnIcon = $(this).attr("id");
        $(this).attr('src', '../ImagesN/' + BtnIcon + 'd.png');
    }, function () {
        $(this).attr('src', '../ImagesN/' + BtnIcon + '.png');
    });


});

$(window).load(function () {
    //廣告商跑馬燈
    $("#PicMarq").simplyScroll({ frameRate: 60 });
});

$(window).scroll(function () {
    $('.DivSets').each(function (i) {

        //Scroll Bar Bottom 位置
        var BottomOfWindows = ($(window).scrollTop() + $(window).height());

        //每個 Div 的 Top 位置
        var HeadOfDiv = $(this).position().top;

        //Div 位置(判別用)
        var AreaName = $(this).attr("data-Area").trim();

        //Scroll Bar Bottom 減低高度(延緩div顯示用)
        var ExtraHeight = $(this).attr("data-extra").trim();

        //Div 顯示狀況(判別是否已顯示)
        var ShowState = $(this).attr("data-st").trim();

        //依照不同的Div高度設定 Scroll Bar Bottom 判別位置(延緩div顯示用)
        if ($(this).height() < ($(window).height() / 2)) {
            BottomOfWindows *= 0.78;
        }
        else {
            BottomOfWindows *= 0.9;
        }

        //Scroll Bar Bottom 減低高度(延緩div顯示用)
        if (typeof ExtraHeight != "undefined") {
            BottomOfWindows -= ExtraHeight;
        }

        if (BottomOfWindows > HeadOfDiv) {

            if (typeof AreaName != "undefined" && typeof ShowState != "undefined") {
                if (ShowState < 1) {
                    switch (AreaName) {

                        case AreaCode.Marquee.toString():
                            $("#marq").simplyScroll({ frameRate: 80 });
                            $(".ObjVisible").removeClass("ObjVisible");
                            break;

                        case AreaCode.Digital.toString():
                            Animated([{ ClassName: "Counter", AnimatedName: "fadeInDown" }]);
                            CountToNum([
                                { ClassName: "Usg-Digital-Leverage", CountMax: 500, DurationTime: 1200 },
                                { ClassName: "Usg-Digital-Currencies", CountMax: 45, DurationTime: 1600 },
                                { ClassName: "Usg-Digital-MinDeposit", CountMax: 100, DurationTime: 1400 },
                                { ClassName: "Usg-Digital-Commissions", CountMax: 0 },
                                { ClassName: "Usg-Digital-Support", CountMax: 24, DurationTime: 1100 }
                            ]);
                            break;

                        case AreaCode.Why.toString():

                            if (!isiPad()) {
                                Animated([
                                    { ClassName: "WhyIcon", AnimatedName: "fadeInDown" },
                                    { ClassName: "WhyTitle", AnimatedName: "fadeInDown", DelayTime: "0.2" },
                                    { ClassName: "WhySubTitle", AnimatedName: "fadeInDown", DelayTime: "0.3" },
                                    { ClassName: "WhyIconD", AnimatedName: "fadeInDown", DelayTime: "0.2" },
                                    { ClassName: "WhyTitleD", AnimatedName: "fadeInDown", DelayTime: "0.3" },
                                    { ClassName: "WhySubTitleD", AnimatedName: "fadeInDown", DelayTime: "0.3" }
                                ]);
                            }
                            else {
                                Animated([
                                    { ClassName: "WhyIcon", AnimatedName: "fadeInDown" },
                                    { ClassName: "WhyTitle", AnimatedName: "fadeInDown" },
                                    { ClassName: "WhySubTitle", AnimatedName: "fadeInDown" },
                                    { ClassName: "WhyIconD", AnimatedName: "fadeInDown" },
                                    { ClassName: "WhyTitleD", AnimatedName: "fadeInDown" },
                                    { ClassName: "WhySubTitleD", AnimatedName: "fadeInDown" }
                                ]);
                            }
                            break;

                        case AreaCode.Program.toString():
                            Animated([
                                { ClassName: "Usg-Program-box", AnimatedName: "fadeInDown" },
                                { ClassName: "Usg-Program-box2", DelayTime: "0.3" }
                            ]);
                            break;

                        case AreaCode.MT4.toString():
                            Animated([
                                { ClassName: "img2" },
                                { ClassName: "img1", DelayTime: "0.1" },
                                { ClassName: "img3", DelayTime: "0.2" },
                                { ClassName: "MT4-Pc", DelayTime: "0.3" },
                                { ClassName: "MT4-Android", DelayTime: "0.4" },
                                { ClassName: "MT4-Iphone", DelayTime: "0.5" }
                            ]);
                            break;

                        case AreaCode.Market.toString():
                            Animated([
                                { ClassName: "Usg-Market-News-Content-Subtitle", AnimatedName: "fadeInDown", DelayTime: "0.2" },
                                { ClassName: "Usg-Market-News-Content-SubContent", AnimatedName: "fadeInDown", DelayTime: "0.3" },
                                { ClassName: "Usg-Market-News-box1", DelayTime: "0.3" },
                                { ClassName: "Usg-Market-News-box2", DelayTime: "0.4" },
                                { ClassName: "Usg-Market-News-box3", DelayTime: "0.4" }
                            ]);
                            break;
                        default:
                            break;
                    }
                    $(this).attr("data-st", 1);
                }
            }
        }
        delete HeadOfDiv, BottomOfWindows, AreaName, ShowState;
    });
});

var livec = {
    timer: null,
    sec: 6,
    init: function () {
        livec.timer = setInterval(function () { livec.timeup(); }, livec.sec * 1000);
    },
    timeup: function () {
        $(".Usg-LiveChat").effect("bounce", { direction: "up", times: 1, distance: 20 });
    }
}

var AreaCode = function () {
    return {
        'Header': 1,
        'Menu': 2,
        'Cover': 3,
        'Marquee': 4,
        'Digital': 5,
        'Why': 6,
        'Program': 7,
        'MT4': 8,
        'Market': 9,
        'Liquidity': 10,
        'Upgrade': 11,
        'Sitemap': 12,
    }
}();
this.GetArea = AreaCode;

function Animated(DivItems) {
    for (var Items in DivItems) {
        var AnimatedName = "fadeInUp"; // default

        $('.' + DivItems[Items].ClassName).addClass("animated");

        if (typeof DivItems[Items].DelayTime != "undefined") {
            $('.' + DivItems[Items].ClassName).attr("data-wow-delay", DivItems[Items].DelayTime + "s");
        }

        if (typeof DivItems[Items].AnimatedName != "undefined") {
            AnimatedName = DivItems[Items].AnimatedName;
        }

        var AnimateTools = new WOW({
            boxClass: DivItems[Items].ClassName,      // default
            animateClass: AnimatedName, // default
            offset: 0,          // default
            mobile: true,       // default
            live: true        // default
        })
        AnimateTools.init();
        delete AnimateTools, DivItems;
    }
}

function CountToNum(DivItems) {
    for (var Items in DivItems) {
        var TimeCount = new ErnestCounter();
        TimeCount.Count(DivItems[Items]);
    }
    delete DivItems;
}

function ErnestCounter() {
    this.Count = function (DivItems) {

        var Delay = 0;
        var Duration = 2000; // default

        if (typeof DivItems.DelayTime != "undefined") {
            Delay = DivItems.DelayTime * 1000;
        }

        if (typeof DivItems.DurationTime != "undefined") {
            Duration = DivItems.DurationTime;
        }

        $('.' + DivItems.ClassName).text("0");

        $({ countNum: $('.' + DivItems.ClassName).text() })
            .delay(Delay)
            .animate({ countNum: DivItems.CountMax + 1 },
            {
                duration: Duration,
                step: function () {
                    $('.' + DivItems.ClassName).text(Math.floor(this.countNum));
                }
            });

        delete Delay, Duration;
    }
}

function isiPad() {
    return navigator.userAgent.match(/iPad/i) != null;
}