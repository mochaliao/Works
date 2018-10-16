(function()
{
	angular
		.module('VipApp')
		.controller('DialogController', DialogController);

	DialogController.$inject = ['$scope', 'ngDialog'];

	function DialogController($scope, ngDialog)
	{
		$scope.ConfirmClick = function() {

		}

		$scope.CancelClick = function() {
			
		}
	}
})();