(function()
{
	angular
		.module('VipApp')
		.controller('MainController', MainController);

	MainController.$inject = ['$scope', '$state', 'UserData', 'LanMgr'];

	function MainController($scope, $state, UserData, LanMgr)
	{
		var self = this;

		self.dataInit = function () 
		{
			
		}

		self.uiInit = function ()
		{
			
		}
		
		self.uiInit();
		self.dataInit();
	}
})();