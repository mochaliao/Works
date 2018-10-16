(function()
{
	angular
		.module('VipApp')
		.controller('ContactController', ContactController);

	ContactController.$inject = ['$scope', '$state', 'UserData', 'LanMgr'];

	function ContactController($scope, $state, UserData, LanMgr)
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