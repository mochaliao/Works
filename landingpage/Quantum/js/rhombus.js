$(function () {
    var scrolled, resized;;
    var scrollDirection = '';
    var oldscrollVal = 0;
    
    var scrollData = [
        {
            container: '.layer1',
            upPercent: 80,
            downPercent: 22,
            defaultActionType: 'upAction',
            upAction: function () {
                console.log('layer up');
                var winWidth = $(window).width();
                if (winWidth <= 414) {
                    $("#L1-Rhombus").transition({
                        top: -1 * 0.25 * $(this.container).height() + "px",
                        left: 0.35 * $(this.container).width() + "px",
                        rotate: "0deg"
                    }, 1000);
                } else if (winWidth <= 750) {
                    $("#L1-Rhombus").transition({
                        top: -1 * 0.2 * $(this.container).height() + "px",
                        left: 0.63 * $(this.container).width() + "px",
                        rotate: "0deg"
                    }, 1000);
                } else {
                    $("#L1-Rhombus").transition({
                        top: -1 * 0.324 * $(this.container).height() + "px",
                        left: 0.63 * $(this.container).width() + "px",
                        rotate: "0deg"
                    }, 1000);
                }
            },
            downAction: function () {
                console.log('layer down');
                //console.log('layer1 down');
                $("#L1-Rhombus").transition({
                    top: -1 * 0.417 * $(this.container).height() + "px",
                    left: 0.974 *  $(this.container).width() + "px",
                    rotate: "180deg"
                }, 1000);
            },
            direction: 'down'
        },
        {
            container: '.layer2',
            upPercent: 18.5,
            downPercent: 18.5,
            defaultActionType: 'upAction',
            upAction: function () {
                var winWidth = $(window).width();
                if (winWidth <= 414) {
                    $("#L2-Rhombus").transition({
                        top: 0.722 * $(this.container).position().top + "px",
                        left: -0.7 * $(this.container).width() + "px",
                        rotate: "0deg"
                    }, 1000);
                } else if (winWidth <= 1024) {
                    $("#L2-Rhombus").transition({
                        top: 0.722 * $(this.container).position().top + "px",
                        left: -0.25 * $(this.container).width() + "px",
                        rotate: "0deg"
                    }, 1000);
                } else {
                    $("#L2-Rhombus").transition({
                        top: 0.722 * $(this.container).position().top + "px",
                        //left: 0.021 * $(this.container).width() + "px",
                        left: -0.021 * $(this.container).width() + "px",
                        rotate: "0deg"
                    }, 1000);
                }
            },
            downAction: function(){
                $("#L2-Rhombus").transition({
                    top: 0.259 * $(this.container).position().top + "px",
                    //left: -1 * 0.667 * $(this.container).width() + "px",
                    left: -1 * 0.71 * $(this.container).width() + "px",
                    rotate: "-180deg"
                }, 1000);
            },
            direction: 'down'
        },
        {
            container: '.layer3',
            upPercent: 81.8,
            downPercent: 81.8,
            defaultActionType: 'downAction',
            upAction: function () {
                $("#L3-Rhombus").transition({
                    top: $(this.container).position().top + 0.755 * $(this.container).height() + "px",
                    left: 1.11 * $(this.container).width() + "px",
                    rotate: "0deg"
                }, 1000);
            },
            downAction: function () {
                $("#L3-Rhombus").transition({
                    top: $('.layer4').position().top + 0.338 * $('.layer4').height() + "px",
                    left: 0.388 * $(this.container).width() + "px",
                    rotate: "-180deg"
                }, 1000);
            },
            direction: 'down'
        },
        {
            container: '.layer4',
            upPercent: 100,
            downPercent: 81.5,
            defaultActionType: 'downAction',
            upAction: function () {
                $("#L4-Rhombus").transition({
                    top: $('.layer5').position().top + 0.444 * $(this.container).height() + "px",
                    left: -1 * 0.6875 * $(this.container).width() + "px",
                    rotate: "0deg"
                }, 1000);
            },
            downAction: function () {

                $("#L4-Rhombus").transition({
                    top: $('.layer5').position().top + 0.444 * $(this.container).height() + "px",
                    left: "0px",
                    rotate: "180deg"
                }, 1000);
            },
            direction: 'down'
        }
    ];

    $(window).resize(function () {
        resized = true;
    })

    $(window).scroll(function (e) {
        var bodyScrollTop = window.pageYOffset ? window.pageYOffset : $('body').scrollTop();
        if (bodyScrollTop > oldscrollVal) {
            scrollDirection = 'down';
        } else {
            scrollDirection = 'up';
        }
        oldscrollVal = bodyScrollTop;
        return scrolled = true;
    });
    setInterval(function () {
        if (scrolled) {
            scrolled = false;
            var WindowsWidth = $(window).width();
            if (WindowsWidth <= 1024) {
                return;
            }
            for (var i = 0, max = scrollData.length; i < max; i++) {
                var cnerHeight = $(scrollData[i].container).height();
                var cnerTop = $(scrollData[i].container).position().top;
                var bodySclTop = window.pageYOffset ? window.pageYOffset : $('body').scrollTop();
                console.log(bodySclTop);
                if (scrollDirection == 'down' && scrollDirection == scrollData[i].direction) {
                    if (bodySclTop > (cnerTop + (cnerHeight * scrollData[i].downPercent / 100))) {
                        scrollData[i].downAction();
                        scrollData[i].direction = 'up';
                    }
                } else if (scrollDirection == 'up' && scrollDirection == scrollData[i].direction) {
                    if (bodySclTop < (cnerTop + (cnerHeight * scrollData[i].upPercent / 100))) {
                        scrollData[i].upAction();
                        scrollData[i].direction = 'down';
                    }
                }
            }
        }
    }, 50);
    setInterval(function () {
        if (resized) {
            resized = false;

            for (var i = 0, max = scrollData.length; i < max; i++) {
                if (scrollData[i][scrollData[i].defaultActionType]) {
                    scrollData[i][scrollData[i].defaultActionType]();
                }
            }
        }
    }, 50);
});