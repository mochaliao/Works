var VipApp = angular.module('VipApp', ['ui.router', 'ngDialog', 'ngAnimate', 'tm.pagination', 'ngSanitize', 'ngFileUpload']);

VipApp.config(['$stateProvider','$urlRouterProvider','$locationProvider', 'ngDialogProvider', '$animateProvider', ProviderInject]);

function ProviderInject($stateProvider, $urlRouterProvider, $locationProvider, ngDialogProvider, $animateProvider)
{
	$urlRouterProvider.otherwise("/index/main");

    var headerView = 
    {
        templateUrl: 'view/header.htm',
        controller: 'HeaderController',
    }

    var footerView = 
    {
        templateUrl: 'view/footer.htm',
        controller: 'FooterController',
    }

	var route = 
	[

        {
            name: 'index',
            url: '/index/:fromPage',
            views : 
            {
                'header' : headerView,
                'footer' : footerView,
                'content' : 
                {
                    templateUrl: 'view/index.htm',
                    controller: 'IndexController',
                },
            },
        },
        
        {
            name: 'activity',
            url: '/activity/:typeID',
            views : 
            {
                'header' : headerView,
                'footer' : footerView,
                'content' : 
                {
                    templateUrl: 'view/activity.htm',
                    controller: 'ActivityController',
                },
            },
        },
        {
            name: 'about',
            url: '/about',
            views : 
            {
                'header' : headerView,
                'footer' : footerView,
                'content' : 
                {
                    templateUrl: 'view/about.htm',
                    controller: 'AboutController',
                },
            },
        },
        {
            name: 'lesson',
            url: '/lesson/:typeID',
            views : 
            {
                'header' : headerView,
                'footer' : footerView,
                'content' : 
                {
                    templateUrl: 'view/lesson.htm',
                    controller: 'LessonController',
                },
            },
        },
        {
            name: 'teacher',
            url: '/teacher/:tNumber',
            views : 
            {
                'header' : headerView,
                'footer' : footerView,
                'content' : 
                {
                    templateUrl: 'view/teacher.htm',
                    controller: 'TeacherController',
                },
            },
        },
        {
            name: 'join',
            url: '/join',
            views : 
            {
                'header' : headerView,
                'footer' : footerView,
                'content' : 
                {
                    templateUrl: 'view/join.htm',
                    controller: 'JoinController',
                },
            },
        },
    ]

    angular.forEach(route, function (obj) {
        $stateProvider.state(obj);
    });

    ngDialogProvider.setDefaults({
        className: 'ngdialog-theme-default',
        plain: false,
        showClose: false,
        closeByDocument: true,
        closeByEscape: true,
        appendTo: false,
        preCloseCallback: function () {
            console.log('default pre-close callback');
        }
    });
}




