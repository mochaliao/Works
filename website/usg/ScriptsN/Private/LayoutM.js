if (culture.toLowerCase() != "zh-cn") {

    //#################Alexa#####################

    //Alexa Certify Javascript
    //_atrk_opts = { atrk_acct: "1CU4h1acOh000e", domain: "usgfx.com", dynamic: true };
    //(function () { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(as, s); })();

    //#################Alexa#####################
    //#################Facebook######################
    //(function () {
    //    var _fbq = window._fbq || (window._fbq = []);
    //    if (!_fbq.loaded) {
    //        var fbds = document.createElement('script');
    //        fbds.async = true;
    //        fbds.src = '//connect.facebook.net/en_US/fbds.js';
    //        var s = document.getElementsByTagName('script')[0];
    //        s.parentNode.insertBefore(fbds, s);
    //        _fbq.loaded = true;
    //    }
    //    _fbq.push(['addPixelId', '919978771376401']);
    //})();
    //window._fbq = window._fbq || [];
    //window._fbq.push(['track', 'PixelInitialized', {}]);
    adroll_adv_id = "DYJGGKUPOJAC5PNFT5AMYJ";
    adroll_pix_id = "AUSJAB5QFNG4HD4Q4KVRGT";
    // adroll_email = "username@example.com"; // OPTIONAL: provide email to improve user identification
    (function () {
        var _onload = function () {
            if (document.readyState && !/loaded|complete/.test(document.readyState)) { setTimeout(_onload, 10); return }
            if (!window.__adroll_loaded) { __adroll_loaded = true; setTimeout(_onload, 50); return }
            var scr = document.createElement("script");
            var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
            scr.setAttribute('async', 'true');
            scr.type = "text/javascript";
            scr.src = host + "/j/roundtrip.js";
            ((document.getElementsByTagName('head') || [null])[0] ||
                document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
        };
        if (window.addEventListener) { window.addEventListener('load', _onload, false); }
        else { window.attachEvent('onload', _onload) }
    }());
    //#################Facebook######################
    //#################analytics#####################
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date(); a = s.createElement(o),
        m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-55721135-1', 'auto');
    ga('send', 'pageview');
    //#################analytics#####################
    //#################WebFont#######################
    WebFontConfig = {
        google: { families: ['Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic:greek,greek-ext,latin,vietnamese,latin-ext,cyrillic', 'Microsoft JhengHei'] }
    };
    (function () {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
    })();
    //#################WebFont#######################
    //#################Google Tag Manager############
    (function (w, d, s, l, i) {
        w[l] = w[l] || []; w[l].push({
            'gtm.start':
                new Date().getTime(), event: 'gtm.js'
        }); var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
        '//www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-NJ2D8M');
    //#################Google Tag Manager############
    //#################google的pixel#################
    //(function (a, e, c, f, g, b, d) {
    //    var h = { ak: "1004452191", cl: "R5sLCOjPtVoQ3_L63gM" };
    //    a[c] = a[c] || function () { (a[c].q = a[c].q || []).push(arguments) }; a[f] || (a[f] = h.ak); b = e.createElement(g); b.async = 1; b.src = "//www.gstatic.com/wcm/loader.js"; d = e.getElementsByTagName(g)[0]; d.parentNode.insertBefore(b, d); a._googWcmGet = function (b, d, e) { a[c](2, b, h, d, null, new Date, e) }
    //})(window, document, "_googWcmImpl", "_googWcmAk", "script");
    //#################google的pixel#################
    //<!-- Google Code for All Visitors - 90 Days -->
    //<!-- Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. For instructions on adding this tag and more information on the above requirements, read the setup guide: google.com/ads/remarketingsetup -->

    //var google_conversion_id = 1004452191;
    //var google_conversion_language = "en";
    //var google_conversion_format = "3";
    //var google_conversion_color = "ffffff";
    //var google_conversion_label = "wDBECJzrkGQQ3_L63gM";
    //var google_remarketing_only = false;
    //$.getScript("//www.googleadservices.com/pagead/conversion.js");
}
function open_sitemapbox() {
    if ($('.Usg-sitemapbox-content').is(':visible')) {
        $('.Usg-sitemapbox-content').hide()
        $("#img_arrow").css({ 'transform': 'rotate(' + 0 + 'deg)' });
    } else {
        $("#img_arrow").css({ 'transform': 'rotate(' + 180 + 'deg)' });
        $('.Usg-sitemapbox-content').show()
    }
}
$(function () {

    var slider = $("#div_slider").slideReveal({
        trigger: $("#trigger"),
        width: $(window).width() * 0.8,
        push: false,
        show: function (slider, trigger) {
            $("#holycow").addClass('clickable');
        },
        hide: function (slider, trigger) {
            $("#holycow").removeClass('clickable');
        }
    });

    $("#holycow").click(function (evt) {
        if (evt.pageX > $(slider[0]).width()) {
            slider.slideReveal("hide")
        }
    });
    $(".scrollable").css("position", "absolute");
    //$('body').show();



    $("#SetCulture").change(function () {
        var CulName = $("#SetCulture").find(":selected").val();
        document.location.href = setcultureURL.replace("CultureVal", CulName);
    });
})