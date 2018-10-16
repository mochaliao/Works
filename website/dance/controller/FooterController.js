(function()
{
	angular
		.module('VipApp')
		.controller('FooterController', FooterController);

	FooterController.$inject = ['$scope', '$state', 'UserData', 'LanMgr'];

	function FooterController($scope, $state, UserData, LanMgr)
	{
		var self = this;

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