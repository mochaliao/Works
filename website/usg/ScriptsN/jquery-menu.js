(function ($) {
    $.fn.menu = function () {
        return this.each(function () {
            var TopItemPosition = 0;

            $(this)
            .children("ul")
            .children("li")
            .wrapInner("<div class='omm_menuitem'></div>")
            .children("div")
            .unwrap()        //remove <li>
            .unwrap();        //remove <ul>

            $(this)
            .find("ul")
            .addClass("omm_ul")
            .wrap("<div class='omm_submenu'></div>");

            $(this)
            .find("li")
            .addClass("omm_li")
            .each(function () {
                var outer = $(this);

                if ($(this).children("a").length > 0) {
                    outer = $(this).children("a:first");
                }

                outer.wrapInner("<div class='omm_submenuitem'></div>");
            });

            $(this).find(".omm_menuitem").on('mouseenter touchstart', function () {
                $(this)
                .addClass("omm_menuitem_hover")
                .removeClass("omm_menuitem_normal");

                TopItemPosition = $(this).position().left;

                var NewPosition = $(this).position().left;
                var SecSubMenuPosition = TopItemPosition + $(this).find(".omm_submenu:first").width();

                if (SecSubMenuPosition > $(window).width()) {
                    NewPosition = TopItemPosition - (SecSubMenuPosition - $(window).width());
                }

                //show current submenu
                $(this).children(".omm_submenu")
                .css({
                    top: $(this).position().top + $(this).outerHeight(),
                    left: NewPosition
                })
                .fadeIn();
            }).on('mouseleave touchmove', function () {
                $(this)
                .addClass("omm_menuitem_normal")
                .removeClass("omm_menuitem_hover");

                $(this).children(".omm_submenu").stop(true, true).hide();
            });

            $(this).find(".omm_submenuitem").on('mouseenter touchstart', function () {
                $(this)
                .addClass("omm_submenuitem_hover")
                .removeClass("omm_submenuitem_normal");

                var NewPosition = $(this).position().left + $(this).outerWidth();
                var SecSubMenuPosition = $(this).outerWidth() + TopItemPosition + $(this).find(".omm_submenu:first").width();

                if (SecSubMenuPosition > $(window).width()) {
                    NewPosition = $(this).position().left - $(this).find(".omm_submenu:first").width();
                }

                //show current submenu
                $(this).find(".omm_submenu:first")
                .css({
                    top: $(this).position().top,
                    left: NewPosition
                })
                .fadeIn();
            }).on('mouseleave touchmove', function () {
                $(this)
                .addClass("omm_submenuitem_normal")
                .removeClass("omm_submenuitem_hover");

                $(this).find(".omm_submenu:first").stop(true, true).hide();
            });
        });
    };
})(jQuery);
