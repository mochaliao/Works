(function()
{
	angular
		.module('VipApp')
		.controller('IndexController', IndexController)
		.animation(".index_Row3_Activity", Activity_Animatior)
		.animation(".index_Row1_Img", Row1Img_Animatior)
		.directive("scroll", ScrollFunc);

	IndexController.$inject = ['$stateParams','$scope', '$state', 'UserData', '$window', '$interval', 'HttpService'];
	Activity_Animatior.$inject = ['$animate'];
	Row1Img_Animatior.$inject = ['$animate'];
	ScrollFunc.$inject = ['$window'];

	function IndexController($stateParams, $scope, $state, UserData, $window, $interval, HttpService)
	{
		var self = this;

		if($stateParams.fromPage == "contact" || $stateParams.fromPage == "join")
		{
			$( 'html, body').animate({
			   scrollTop: 2900}, 0);
			$stateParams.fromPage = "main";
		}

		$scope.TwFont="header_Font";
		$scope.ChFont="";
		
		
		$scope.pathStr = "view/images/index/";

		$scope.Row1ImgFlag = "";
		$scope.Row1_nowShowIndex = 0;
		$scope.Row1_nowHideIndex = 4;
		$scope.Row1_imgsStr = ['PHC_06.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg'];
		$scope.Row1_imgs = [
			{image:$scope.pathStr+$scope.Row1_imgsStr[0]},
			{image:$scope.pathStr+$scope.Row1_imgsStr[1]},
			{image:$scope.pathStr+$scope.Row1_imgsStr[2]},
			{image:$scope.pathStr+$scope.Row1_imgsStr[3]},
			{image:$scope.pathStr+$scope.Row1_imgsStr[4]},
		]
		$scope.Row1ImgPoint0 = "light";
		$scope.Row1ImgPoint1 = "";
		$scope.Row1ImgPoint2 = "";
		$scope.Row1ImgPoint3 = "";
		$scope.Row1ImgPoint4 = "";



		$scope.direction = "MoveNone";
		$scope.selectIndex = 0;
		$scope.imgsStr = ['PHC_22.jpg', 'PHC_22.jpg', 'PHC_22.jpg', 'PHC_22.jpg', 'PHC_22.jpg'];
		$scope.imgsDate = ['2017.05.20', '2017.02.28', '2017.03.08', '2017.04.01', '2017.05.05']
		$scope.imgsTitle = ['520大會活動', '紀念和平', '婦女天下', '愚人愚已', '龍船舞天下'];
		$scope.imgs = [
			{image:$scope.pathStr+$scope.imgsStr[0]},
			{image:$scope.pathStr+$scope.imgsStr[1]},
			{image:$scope.pathStr+$scope.imgsStr[2]},
			{image:$scope.pathStr+$scope.imgsStr[3]},
			{image:$scope.pathStr+$scope.imgsStr[4]},
		]

		
		$scope.pointLight0 = "light";
		$scope.pointLight1 = "";
		$scope.pointLight2 = "";
		$scope.pointLight3 = "";
		$scope.pointLight4 = "";

		$scope.TopFlag = '0';

		// options
    	$scope.actions = 
    			[{key:"1",value:"幼兒律動"},
                {key:"2",value:"芭蕾舞"},
                {key:"3",value:"現代舞"},
                {key:"4",value:"中國舞"},
                {key:"5",value:"兒童街舞"},
                {key:"6",value:"MV舞蹈"},
                {key:"7",value:"成人瑜珈"},
                {key:"8",value:"成人有氧"},
                {key:"9",value:"成人芭蕾"},
                {key:"10",value:"成人現代"}]; 
       
		self.dataInit = function () 
		{
			//開啟計時器，每5秒換一張圖
			var picSlider = $interval(
				function () 
				{
					$scope.Row1_nowShowIndex++;
					if($scope.Row1_nowShowIndex > 4) $scope.Row1_nowShowIndex = $scope.Row1_nowShowIndex % 5;
					$scope.Row1_nowHideIndex++;
					if($scope.Row1_nowHideIndex > 4) $scope.Row1_nowHideIndex = $scope.Row1_nowHideIndex % 5;
					$scope.Row1ImgFlag = "ChangePic";
				},
				5000,
			)
		}

		self.uiInit = function ()
		{
			$scope.TwFont="header_Font";
			$scope.ChFont="";
		}

		$scope.ClickTop = function() {
			$( 'html, body').animate({
			   scrollTop: 0}, 0);
		}

		$scope.ClickIntroduce = function() {
			$( 'html, body').animate({
			   scrollTop: 980}, 500);
		}

		$scope.ClickActivity = function() 
		{
			$state.go("activity/1");
		}

		self.initJoinForm = function() {
			$scope.name = "";
    	    $scope.phone = "";
        	$scope.lesson = "";
        	$scope.message = "";
        	$scope.email = "";
		}

		$scope.normalJoin = function()
		{
			var DataObj = {
				name : $scope.name,
				phone : $scope.phone,
				email : $scope.email,
				lesson : $scope.lesson,
				message : $scope.message
			}
			HttpService.HttpPost(SOCKET_DEF.URL , SERVICE_TYPE.JOIN , ACTION_TYPE.JOIN_NORMAL, DataObj)
			.then(function(result) 
	        {
	        	if(result.Ret == ResultMsg.LoginReply.Success)
	        	{
	        		alert("報名成功");
	        		self.initJoinForm();
	        	}
	        	else if(result.Ret == -1)
	        	{
	        		alert("報名失敗");
	        		self.initJoinForm();
	        	}
	        });
		}

		$scope.Activity_MoveLeft = function() {
			//$scope.direction = "MoveLeft";
			// $scope.selectIndex--;
			// if($scope.selectIndex < 0)
			// 	$scope.selectIndex = 4;
		}

		$scope.Activity_MoveRight = function() {
			//$scope.direction = "MoveRight";
			// $scope.selectIndex++;
			// if($scope.selectIndex > 4)
			// 	$scope.selectIndex = 0;
		}

		$scope.ChangeRow1ImgIndex = function() {
			$scope.Row1ImgPoint0 = "";
			$scope.Row1ImgPoint1 = "";
			$scope.Row1ImgPoint2 = "";
			$scope.Row1ImgPoint3 = "";
			$scope.Row1ImgPoint4 = "";
			if($scope.Row1_nowShowIndex == 0)
				$scope.Row1ImgPoint0 = "light";
			else if($scope.Row1_nowShowIndex == 1)
				$scope.Row1ImgPoint1 = "light";
			else if($scope.Row1_nowShowIndex == 2)
				$scope.Row1ImgPoint2 = "light";
			else if($scope.Row1_nowShowIndex == 3)
				$scope.Row1ImgPoint3 = "light";
			else if($scope.Row1_nowShowIndex == 4)
				$scope.Row1ImgPoint4 = "light";
		}



		$scope.ChangeIndex = function()
		{
			$scope.pointLight0 = "";
			$scope.pointLight1 = "";
			$scope.pointLight2 = "";
			$scope.pointLight3 = "";
			$scope.pointLight4 = "";
			if($scope.selectIndex == 0)
				$scope.pointLight0 = "light";
			else if($scope.selectIndex == 1)
				$scope.pointLight1 = "light";
			else if($scope.selectIndex == 2)
				$scope.pointLight2 = "light";
			else if($scope.selectIndex == 3)
				$scope.pointLight3 = "light";
			else if($scope.selectIndex == 4)
				$scope.pointLight4 = "light";
		}

		self.initJoinForm();

		angular.element(document).ready(function () {
	        self.uiInit();
	        self.dataInit();
        });
	}

	function Activity_Animatior($animate, $rootScope)
	{
		var self = this;

		var addClassFunc = function(element, className, done)
		{
			var scope = element.scope();

			var logo_indexs = [];
			scope.imgs = [];
			for(var i =0; i < 5; i++)
			{
				index = scope.selectIndex+i;
				if(index > 4) index = index % 5;
				scope.imgs.push({image:scope.pathStr+scope.imgsStr[index]});
			}
			
			var logo_div_elements = element.find('div');
			var logo_img_elements = element.find('img');
			var location = ['25%', '20%', '30%', '50%', '70%', '80%', '75%'];
			var transform0 = 'rotateY(20deg) scale(0.5)';
			var transform1 = 'rotateY(20deg) scale(0.75)';
			var transform2 = 'rotateY(0deg) scale(1)';
			var transform3 = 'rotateY(-20deg) scale(0.75)';
			var transform4 = 'rotateY(-20deg) scale(0.5)';
			var transform = [transform0, transform1, transform1, transform2, transform3, transform3, transform4];

			if(className == "MoveLeft")
			{
				for(var i = 1; i < logo_div_elements.length; i++)
				{
					var fromLocation = location[i-1];
					var toLocation = location[i];
					var fromTransform = transform[i-1];
					var toTransform = transform[i]
					var from = {
						left: fromLocation, 
						'-webkit-transform': fromTransform,
						'-moz-transform': fromTransform,
						'-o-transform': fromTransform,
						'-ms-transform': fromTransform,
						'transform': fromTransform,
					};
					var to = {
						left: toLocation, 
						'-webkit-transform': toTransform, 
						'-moz-transform': toTransform, 
						'-o-transform': toTransform, 
						'-ms-transform': toTransform, 
						onComplete:CompleteFunc(element, className, done)
					};
					MoveFunc(logo_div_elements[i], from, to);
				}
			}
			else if(className == "MoveRight")
			{
				for(var i = 0; i < logo_div_elements.length-1; i++)
				{
					var fromLocation = location[i+1];
					var toLocation = location[i];
					var fromTransform = transform[i+1];
					var toTransform = transform[i]
					var from = {
						left: fromLocation, 
						'-webkit-transform': fromTransform,
						'-moz-transform': fromTransform,
						'-o-transform': fromTransform,
						'-ms-transform': fromTransform,
						'transform': fromTransform,
					};
					var to = {
						left: toLocation, 
						'-webkit-transform': toTransform, 
						'-moz-transform': toTransform, 
						'-o-transform': toTransform, 
						'-ms-transform': toTransform, 
						onComplete:CompleteFunc(element, className, done)
					};
					MoveFunc(logo_div_elements[i], from, to);
				}
			}
		}

		var MoveFunc = function(element, from, to)
		{
			TweenMax.fromTo(element, 0.5, from, to);
		}

		var removeClassFunc = function(element, className, done)
		{
		}

		var CompleteFunc = function(element, className, done) 
		{
			scope = element.scope();
			done();
			setTimeout(function() 
            {
                scope.$apply(function() {
                    scope.direction= 'MoveNone';
                    scope.ChangeIndex();
                });
            }, 0);
		}

		return {
			addClass : addClassFunc,
			removeClass : removeClassFunc,
		}
	}

	function Row1Img_Animatior($animate, $rootScope)
	{
		var self = this;

		var addClassFunc = function(element, className, done)
		{
			var scope = element.scope();
			if(className == "ChangePic")
			{
				var logo_img_elements = element.find('img');
				var from0 = {opacity: 0 };
				var from1 = {opacity: 1 };
				var to0 = {	opacity: 1, onComplete:CompleteFunc(element, className, done)};
				var to1 = {	opacity: 0, onComplete:null};
				MoveFunc(logo_img_elements[0], from0, to0);
				MoveFunc(logo_img_elements[1], from1, to1);
			}
		}

		var MoveFunc = function(element, from, to)
		{
			TweenMax.fromTo(element, 2, from, to);
		}

		var removeClassFunc = function(element, className, done)
		{
		}

		var CompleteFunc = function(element, className, done) 
		{
			scope = element.scope();
			done();
			setTimeout(function() 
            {
                scope.$apply(function() {
                    scope.Row1ImgFlag= '';
                    scope.ChangeRow1ImgIndex();
                });
            }, 0);
		}

		return {
			addClass : addClassFunc,
			removeClass : removeClassFunc,
		}
	}

	function ScrollFunc($window) 
	{
		var ScrollCheck = function(scope, element, attrs) 
		{
	        angular.element($window).bind("scroll", function() 
	        {
	             if (this.pageYOffset >= 100) {
	                 scope.TopFlag = '1';
	             } else {
	                 scope.TopFlag = '0';
	             }
	             scope.$apply();
	        });
	    };
	    return ScrollCheck;
	}

})();