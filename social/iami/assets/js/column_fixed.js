//column fixed(all)0516
$(function () {
    $(window).scroll(function () {

        //left
        lastL = $('.cnt-left-cnt').height() - $(window).height()
        midcnt = $('#index-page .cnt-mid-cnt').height() - $('#index-page .cnt-right-cnt').height()


        if ($(window).scrollTop() >= lastL) {
            $('.cnt-left-cnt').addClass('fixed').removeClass('fixedTop');
        }
        else {
            $('.cnt-left-cnt').removeClass('fixed');
        }

        if ($('.cnt-left-cnt').height() <= $(window).height()) {
            $('.cnt-left-cnt').addClass('fixedTop').removeClass('fixed');
        }
        else {
            $('.cnt-left-cnt').removeClass('fixedTop');
        }

        //right
        lastR = $('.cnt-right-cnt').height() - $(window).height()

        if ($(window).scrollTop() >= lastR) {
            $('.cnt-right-cnt').addClass('fixed');
        } else {
            $('.cnt-right-cnt').removeClass('fixed');
        }

        if ($('.cnt-right-cnt').height() <= $(window).height()) {
            $('.cnt-right-cnt').removeClass('fixed').addClass('fixedTop');
        } else {
            $('.cnt-right-cnt').removeClass('fixedTop');
        }


        // if ( midcnt <= 0 ) {
        //     $('#index-page .cnt-mid-cnt').addClass('fixedTop')
        // } else {
        //     $('#index-page  .cnt-mid-cnt').removeClass('fixedTop');
        // }



    });
});
//column fixed(info)
$(function() {
    $(window).scroll(function() {

        //left
        lastL2= $('#inner-page .cnt-left-cnt').height()+$('.inner-header').height() - $(window).height()
        cutL2 = $('#inner-page .cnt-left-cnt').height()-$('.inner-header').height()
        moreL2= $('#inner-page .cnt-left-cnt').height()- $(window).height()

        $('#inner-page .cnt-left-cnt').removeClass('fixedTop').removeClass('fixed');

        if($(window).scrollTop() >= 468 && lastL2 <= 0){
            $('#inner-page .cnt-left-cnt').addClass('fixedTop').removeClass('fixed');
        }
        else {
            $('#inner-page .cnt-left-cnt').removeClass('fixedTop');
        }


        if($(window).scrollTop() >= 468  && $(window).scrollTop() >= cutL2) {
            $('#inner-page .cnt-left-cnt').addClass('fixed').removeClass('fixedTop');
        }
        else {
            $('#inner-page .cnt-left-cnt').removeClass('fixed');
        }

        if($(window).scrollTop() >= 468  && $(window).scrollTop() >= cutL2 && moreL2 <= 0) {
            $('#inner-page .cnt-left-cnt').addClass('fixedTop').removeClass('fixed');
        }
        else {
            $('#inner-page .cnt-left-cnt').removeClass('fixedTop');
        }


        //right
        lastR2= $('#inner-page .cnt-right-cnt').height()+$('.inner-header').height() - $(window).height()
        cutR2 = $('#inner-page .cnt-right-cnt').height()-$('.inner-header').height()
        moreR2= $('#inner-page .cnt-right-cnt').height()- $(window).height()

        $('#inner-page .cnt-right-cnt').removeClass('fixedTop').removeClass('fixed');

        if($(window).scrollTop() >= 468 && lastR2 <= 0){
            $('#inner-page .cnt-right-cnt').addClass('fixedTop').removeClass('fixed');
        }
        else {
            $('#inner-page .cnt-right-cnt').removeClass('fixedTop');
        }


        if($(window).scrollTop() >= 468  && $(window).scrollTop() >= cutR2) {
            $('#inner-page .cnt-right-cnt').addClass('fixed').removeClass('fixedTop');
        }
        else {
            $('#inner-page .cnt-right-cnt').removeClass('fixed');
        }

        if($(window).scrollTop() >= 468  && $(window).scrollTop() >= cutR2 && moreR2 <= 0) {
            $('#inner-page .cnt-right-cnt').addClass('fixedTop').removeClass('fixed');
        }
        else {
            $('#inner-page .cnt-right-cnt').removeClass('fixedTop');
        }

    });
});

