/*
	ErnestTools v1.0 - The Plugin by Ernest
    Email: ernest99168@gmail.com
 */

function ErnestTools() {

    //背景移動
    this.BackGroundImgMove = function BackGroundImgMovePub(obj) {
        for (var Items in obj) {
            BackGroundImgMovePri(obj[Items]);
        }
    }

    function BackGroundImgMovePri(ClassName) {
        var BottomOfWindows = $(window).scrollTop() + $(window).height();
        var DivStart = 0, LastDivStart = 0;

        try {
            DivStart = $('.' + ClassName).position().top;
            LastDivStart = DivStart;
        }
        catch (err) {
            DivStart = LastDivStart;
        }

        var DivEnd = DivStart + $('.' + ClassName).height();
        var DivHeight = $('.' + ClassName).height() / 100;
        var MovePxl = Math.round(($(window).scrollTop() - DivStart) / DivHeight);

        if (BottomOfWindows >= DivStart || BottomOfWindows <= DivEnd) {
            MovePx = -MovePxl;
            $("." + ClassName).css("background-position", "100% " + MovePx + "px");
        }
    }
}

function isiPad() {
    return navigator.userAgent.match(/iPad/i) != null;
}

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
            .animate({ countNum: DivItems.CountMax },
            {
                duration: Duration,
                easing: 'linear',
                step: function () {
                    $('.' + DivItems.ClassName).text(Math.floor(this.countNum));
                },
                complete: function () {
                    $('.' + DivItems.ClassName).text(this.countNum);
                }
            });
        delete Delay, Duration;
    }
}

function QQ24Live() {
    var j = document.createElement('script'), k = document.getElementsByTagName('head')[0];
    j.type = 'text/javascript';
    j.async = true;
    j.src = 'http://wpa.b.qq.com/cgi/wpa.php?key=XzkzODAwNzk0NF8zMjAyNTRfNDAwOTIwMDczOF8';
    k.insertBefore(j, k.lastChild);
}