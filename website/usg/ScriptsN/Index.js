var LeverageVal = 500;
var CurrenciesVal = 60;
var MinDepositVal = 100;
var CommissionsVal = 0;
var SupportVal = 24;

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

$(function () {
    $(".PGBtn").hover(
            function () {
                switch ($(this).attr("data-PGBtn")) {
                    case "1":
                        $("#PGBtnLI1").css("opacity", "1");
                        $("#PGBtnRI1").attr('src', USGFXPath + 'ImagesN/news-1T.png');
                        break;
                    case "2":
                        $("#PGBtnLI2").css("opacity", "1");
                        $("#PGBtnRI2").attr('src', USGFXPath + 'ImagesN/news-2T.png');
                        break;
                    case "3":
                        $("#PGBtnLI3").css("opacity", "1");
                        $("#PGBtnRI3").attr('src', USGFXPath + 'ImagesN/news-3T.png');
                        break;
                }
            }, function () {
                switch ($(this).attr("data-PGBtn")) {
                    case "1":
                        $("#PGBtnLI1").css("opacity", "0.6");
                        break;
                    case "2":
                        $("#PGBtnLI2").css("opacity", "0.6");

                        break;
                    case "3":
                        $("#PGBtnLI3").css("opacity", "0.6");
                        break;
                }
                $(".PGTranImgs").attr('src', USGFXPath + 'ImagesN/PGTranWhite.png');
            });

    $(".CPBtn").hover(
        function () {
            $(".CPBtnLeft").css("background-color", "#f1d208");
            $(".CPBtnLeft").css("color", "#746200");
            $(".CPBtnRight").css("background-color", "#f6e26f");
        }, function () {
            $(".CPBtnLeft").css("background-color", "#d9bb1b");
            $(".CPBtnLeft").css("color", "#FFF");
            $(".CPBtnRight").css("background-color", "#e4d35f");
        });

    $('.DivSets').each(function (i) {
        $(this).attr("data-st", 0);

        switch ($(this).attr("id")) {
            case "Usg-Program":
                $(this).attr("data-extra", 300);
                break;
            case "Usg-Why":
                $(this).attr("data-extra", 300);
                break;
            case "Usg-MT4":
                $(this).attr("data-extra", -250);
                break;
            default:
                $(this).attr("data-extra", 0);
                break;
        }
    });
});

$(window).scroll(function () {
    if (!isiPad()) {

        new ErnestTools().BackGroundImgMove(["Usg-Program", "Usg-Market-News"]);

        $('.DivSets').each(function (i) {

            //Scroll Bar Bottom Site
            var BottomOfWindows = ($(window).scrollTop() + $(window).height());

            //Every Div's Top Site
            var HeadOfDiv = $(this).position().top;

            //Div Site
            var AreaName = $(this).attr("data-Area").trim();

            //Scroll Bar Bottom Diff Height(Delay show div)
            var ExtraHeight = 0;

            try { ExtraHeight = $(this).attr("data-extra").trim(); }
            catch (err) { }

            //State of Div Show
            var ShowState = $(this).attr("data-st");

            //According Div's Height to Setting Scroll Bar Bottom (Using for detecting and animated)
            if ($(this).height() < ($(window).height() / 2)) {
                BottomOfWindows *= 0.78;
            }
            else {
                BottomOfWindows *= 0.9;
            }

            //Scroll Bar Bottom Diff Height(Delay show div)
            if (typeof ExtraHeight != "undefined") {
                BottomOfWindows -= ExtraHeight;
            }

            if (BottomOfWindows > HeadOfDiv) {

                if (typeof AreaName != "undefined" && typeof ShowState != "undefined") {
                    if (ShowState < 1) {
                        switch (AreaName) {

                            case AreaCode.Marquee.toString():

                                $(".marqContent").removeAttr("style");
                                break;

                            case AreaCode.Digital.toString():
                                var AniCount = 0;
                                $(".DigitalWord").bind("animationend oanimationend webkitAnimationEnd MSAnimationEnd", function () {
                                    $(".DigitalWord").css("visibility", "hidden");
                                    AniCount++;
                                    if (AniCount == 6) {
                                        $(".DigitalWord").unbind("animationend oanimationend webkitAnimationEnd MSAnimationEnd");
                                        new WOW({ boxClass: "DigitalWord", animateClass: "fadeInDown" }).init();
                                    }
                                });

                                new WOW({ boxClass: "DigitalWord", animateClass: "fadeOutDown" }).init();

                                CountToNum([
                                        { ClassName: "Usg-Digital-Leverage", CountMax: LeverageVal, DurationTime: 1200 },
                                        { ClassName: "Usg-Digital-Currencies", CountMax: CurrenciesVal, DurationTime: 1600 },
                                        { ClassName: "Usg-Digital-MinDeposit", CountMax: MinDepositVal, DurationTime: 1400 },
                                        { ClassName: "Usg-Digital-Commissions", CountMax: CommissionsVal },
                                        { ClassName: "Usg-Digital-Support", CountMax: SupportVal, DurationTime: 1100 }
                                ]);
                                break;

                            case AreaCode.Why.toString():
                                Animated([
                                    { ClassName: "WhyIcon", AnimatedName: "fadeInDown" },
                                    { ClassName: "WhyTitle", AnimatedName: "fadeInDown", DelayTime: "0.2" },
                                    { ClassName: "WhySubTitle", AnimatedName: "fadeInDown", DelayTime: "0.3" },
                                    { ClassName: "WhyIconD", AnimatedName: "fadeInDown", DelayTime: "0.2" },
                                    { ClassName: "WhyTitleD", AnimatedName: "fadeInDown", DelayTime: "0.3" },
                                    { ClassName: "WhySubTitleD", AnimatedName: "fadeInDown", DelayTime: "0.3" }
                                ]);
                                break;

                            case AreaCode.Program.toString():
                                Animated([
                                    { ClassName: "Usg-Program-box", AnimatedName: "fadeInDown" },
                                    { ClassName: "CPBtn", DelayTime: "0.3" }
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
                                    { ClassName: "PGBtn1", DelayTime: "0.3" },
                                    { ClassName: "PGBtn2", DelayTime: "0.4" },
                                    { ClassName: "PGBtn3", DelayTime: "0.4" }
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
    }
});