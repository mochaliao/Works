(function()
{
	angular
		.module('VipApp')
		.controller('ServiceController', ServiceController)
		.animation(".service_logo",['$animate', Logo_Animatior]);

	ServiceController.$inject = ['$scope', '$state', 'UserData', 'LanMgr'];
	

	function ServiceController($scope, $state, UserData, LanMgr)
	{
		var self = this;

		$scope.direction = "MoveNone";
		$scope.selectIndex = 0;
		$scope.pathStr = "view/images/service/";
		$scope.imgsStr = ['insurance.png', 'entertainment.png', 'trip.png', 'techEducation.png', 'tech.png', 'dance.png'];
		$scope.imgs = [
			{image:$scope.pathStr+$scope.imgsStr[0]},
			{image:$scope.pathStr+$scope.imgsStr[1]},
			{image:$scope.pathStr+$scope.imgsStr[2]},
			{image:$scope.pathStr+$scope.imgsStr[3]},
			{image:$scope.pathStr+$scope.imgsStr[4]},
			{image:$scope.pathStr+$scope.imgsStr[5]},
		]

		$scope.PrevLogo = function()
		{
			$scope.direction = "MoveToRight";
			$scope.selectIndex--;
			if($scope.selectIndex < 0)
				$scope.selectIndex = 5;
		}

		$scope.NextLogo = function()
		{
			$scope.direction = "MoveToLeft";
			$scope.selectIndex++;
			if($scope.selectIndex > 5)
				$scope.selectIndex = 0;
		}

		$scope.ChangeIndex = function()
		{

		}

		self.dataInit = function () 
		{
			
		}

		self.uiInit = function ()
		{
			
		}

		self.uiInit();
		self.dataInit();
	}

	function Logo_Animatior($animate, $rootScope)
	{
		var self = this;

		var addClassFunc = function(element, className, done)
		{
			var scope = element.scope();

			var logo_indexs = [];
			scope.imgs = [];
			for(var i =0; i < 6; i++)
			{
				index = scope.selectIndex+i;
				if(index > 5) index = index % 6;
				scope.imgs.push({image:scope.pathStr+scope.imgsStr[index]});
			}
			console.log(scope.imgs);
			
			var logo_div_elements = element.find('div');
			var logo_img_elements = element.find('img');
			var location = ['0px', '179px', '410px', '640px', '870px', '1101px', '1280px'];
			var top = ['250px', '150px', '150px', '100px', '150px', '150px', '250px'];
			var width = ['0px', '224px', '224px', '308px', '224px', '224px', '0px'];
			var height = ['0px', '190px', '190px', '272px', '190px', '190px', '0px'];
			var opacity = [0, 0.4, 0.7, 1, 0.7, 0.4, 0];

			if(className == "MoveToRight")
			{
				for(var i = 1; i < logo_div_elements.length; i++)
				{
					var fromLocation = location[i-1];
					var toLocation = location[i];
					var fromTop = top[i-1];
					var toTop = top[i]
					var from = {left: fromLocation,top:fromTop};
					var to = {left: toLocation, top:toTop, onComplete:CompleteFunc(element, className, done)};
					MoveFunc(logo_div_elements[i], from, to);

					var fromWidth = width[i-1];
					var toWidth = width[i];
					var fromHeight = height[i-1];
					var toHeight = height[i];
					var fromOpacity = opacity[i-1];
					var toOpacity = opacity[i];
					var from = {width: fromWidth, height:fromHeight, opacity:fromOpacity};
					var to = {width:toWidth, height:toHeight, opacity:toOpacity, onComplete:null};
					MoveFunc(logo_img_elements[i], from, to);
				}
			}
			else if(className == "MoveToLeft")
			{
				for(var i = 0; i < logo_div_elements.length - 1; i++)
				{
					var fromLocation = location[i+1];
					var toLocation = location[i];
					var fromTop = top[i+1];
					var toTop = top[i]
					var from = {left: fromLocation,top:fromTop};
					var to = {left: toLocation, top:toTop, onComplete:CompleteFunc(element, className, done)};
					MoveFunc(logo_div_elements[i], from, to);

					var fromWidth = width[i+1];
					var toWidth = width[i];
					var fromHeight = height[i+1];
					var toHeight = height[i];
					var fromOpacity = opacity[i+1];
					var toOpacity = opacity[i];
					var from = {width: fromWidth, height:fromHeight, opacity:fromOpacity};
					var to = {width:toWidth, height:toHeight, opacity:toOpacity, onComplete:null};
					MoveFunc(logo_img_elements[i], from, to);
				}
			}
		}

		var getFrom = function(element, className, done, elementid)
		{

		}

		var removeClassFunc = function(element, className, done)
		{
			
		}

		var MoveFunc = function(element, from, to)
		{
			TweenMax.fromTo(element, 0.3, from, to);
		}

		var CompleteFunc = function(element, className, done) {
			scope = element.scope();
			done();
			setTimeout(function() 
            {
                scope.$apply(function() {
                    scope.direction= '';
                    scope.ChangeIndex();
                });
            }, 0);
		}

		return {
			addClass : addClassFunc,
			removeClass : removeClassFunc,
		}
	}

})();