Element.prototype.hasClass = function (className) {
    return this.className && new RegExp('(^|\\s)' + className + '(\\s|$)').test(this.className);
};
$(function () {


    var dropmenu = document.querySelectorAll('.dropmenu');
    var dropmenuArray = Array.prototype.slice.call(dropmenu, 0);
    var defaultHeight = screen.height;
    dropmenuArray.forEach(function (el) {
        var button = el.querySelector('a[data-toggle="dropmenu"]'), menu = el.querySelector('.dropmenu-menu'), arrow = button.querySelector('span.icon-arrow');
        button.onclick = function (event) {

            if (!menu.hasClass('show')) {

                $(this).parent().parent().children('li').children('.dropmenu-menu').removeClass('show').addClass('hide');
                $(this).parent().parent().children('li').children('a').children('span.icon-arrow').removeClass('open').addClass('cancle');

                menu.classList.add('show');
                menu.classList.remove('hide');

                arrow.classList.add('open');
                arrow.classList.remove('cancle');
                event.preventDefault();
                var menuHeight = 0;
                $('ul.Usg-mainmenu>li.dropmenu').each(function () {
                    menuHeight = menuHeight + $(this).height() + 5;
                });
                $('.menuTop').height(menuHeight > defaultHeight ? menuHeight : defaultHeight);
                $('#div_slider').height($('.menuTop').height());
            } else {
                menu.classList.remove('show');
                menu.classList.add('hide');
                arrow.classList.remove('open');
                arrow.classList.add('cancle');
                event.preventDefault();
                $('.menuTop').height('100%');
                $('#div_slider').height(defaultHeight);
            }
        };
    });


})

