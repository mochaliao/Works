var enjoyhint_instance = new EnjoyHint({});

var iwidth = document.body.clientWidth;
if (iwidth <= 768) {
    var enjoyhint_script_steps = [
// fot desktop
        {
            'next .header-middle-m': '點擊IamI便可回到塗鴉牆',
            'nextButton': {className: "myNext", text: "下一步"},
            'skipButton': {className: "mySkip", text: "知道了"}
        },
        {
            'next .mobile': "更多選項請點擊選單",
            'shape': 'circle',
            'nextButton': {className: "myNext", text: "下一步"},
            'skipButton': {className: "mySkip", text: "知道了"}
        },
        {
            'next .fixMenu-cnt': '隨時掌握最新的通知',
            'nextButton': {className: "myNext", text: "下一步"},
            'skipButton': {className: "mySkip", text: "知道了"}
        },

        {
            'next .search': '在這裡可以搜尋到更多好友唷',
            'showSkip': false,
            'nextButton': {className: "myNext", text: "OK"},
        }
    ];
}
else {
    var enjoyhint_script_steps = [
// fot desktop
        {
            'next .header-logo': '點擊IamI便可回到塗鴉牆',
            'nextButton': {className: "myNext", text: "下一步"},
            'skipButton': {className: "mySkip", text: "知道了"}
        },
        {
            'next .guide-info': '點擊頭像進入自己的專屬頁面',
            'shape': 'circle',
            'nextButton': {className: "myNext", text: "下一步"},
            'skipButton': {className: "mySkip", text: "知道了"}
        },
        {
            'next .self-dropdown': "更多選項請點擊頭像",
            'shape': 'circle',
            'nextButton': {className: "myNext", text: "下一步"},
            'skipButton': {className: "mySkip", text: "知道了"}
        },
        {
            'next .header-icon-g': '隨時掌握最新的資訊',
            'nextButton': {className: "myNext", text: "下一步"},
            'skipButton': {className: "mySkip", text: "知道了"}
        },
        {
            'next .header-search.guide': '在這裡可以搜尋到更多好友唷',
            'showSkip': false,
            'nextButton': {className: "myNext", text: "OK"},
        }
    ];
}


enjoyhint_instance.set(enjoyhint_script_steps);
enjoyhint_instance.run();