$(function () {
            var floatArea = $('.FloatArea');
            var iHeight = floatArea.outerHeight();
            var intervals = 2500;
            var isHide = false;
            var timeOutInterval = setInterval(floatAreaShow, intervals);

            //初始設定
            floatArea.css({
                "position": "fixed",
                "left": 0, "right": 0,
                "bottom": 0,
                "z-index": 999
            }).ready(function () {
                floatAreaHide();
            });

            $(window).scroll(function () {
                clearTimeout(timeOutInterval);
                if (!isHide) { floatAreaHide(); }
                timeOutInterval = setInterval(floatAreaShow, intervals);
            });

            function floatAreaShow() {
                isHide = false;
                floatArea.show().animate({ 'bottom': '0px' }, 'slow');
            }

            function floatAreaHide() {
                isHide = true;
                floatArea.animate({ 'bottom': -iHeight }, 'slow');
            }
        });