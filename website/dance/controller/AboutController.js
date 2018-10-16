(function()
{
	angular
		.module('VipApp')
		.controller('AboutController', AboutController);

	AboutController.$inject = ['$scope', '$state', 'UserData', 'LanMgr'];

	function AboutController($scope, $state, UserData, LanMgr)
	{
		var self = this;

		$scope.albumTitle = "舞團介紹";

		$( 'html, body').animate({
		   scrollTop: 0}, 0);

		self.dataInit = function () 
		{
			
		}

		self.uiInit = function ()
		{
			
		}
		
		angular.element(document).ready(function () {
	        self.uiInit();
	        self.dataInit();
        });
	}
})();