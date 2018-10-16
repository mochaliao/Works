(function()
{
	angular
		.module('VipApp')
		.controller('MapController', MapController);

	MapController.$inject = ['$scope', '$state', 'UserData', 'LanMgr'];

	function MapController($scope, $state, UserData, LanMgr)
	{
		var self = this;
		
		$scope.isTaiwan = '0';
		$scope.isSzJn = '0';
		$scope.isEng = '0';
		$scope.isMacau = '0';
		$scope.isItaly = '0';
		$scope.isZuSea = '0';


		self.dataInit = function () 
		{
			
		}

		self.uiInit = function ()
		{
			
		}

		self.effectInit = function() {
			$scope.fEffect = "";
			$scope.tEffect = "";
			$scope.eEffect = "";
			$scope.iEffect = "";
			$scope.dEffect = "";
			$scope.pEffect = "";

			$scope.isTaiwan = '0';
			$scope.isSzJn = '0';
			$scope.isEng = '0';
			$scope.isMacau = '0';
			$scope.isItaly = '0';
			$scope.isZuSea = '0';
		}

		$scope.click_financial = function() {
			self.effectInit();
			$scope.fEffect = "light";
			$scope.isSzJn = "1";
			$scope.isTaiwan = "1";
			$scope.isEng = "1";
		}

		$scope.click_trip = function() {
			self.effectInit();
			$scope.tEffect = "light";
			$scope.isZuSea = "1";
			$scope.isTaiwan = "1";
			$scope.isItaly = "1";
		}

		$scope.click_education = function() {
			self.effectInit();
			$scope.eEffect = "light";
			$scope.isSzJn = "1";
			$scope.isTaiwan = "1";
		}

		$scope.click_insurance = function() {
			self.effectInit();
			$scope.iEffect = "light";
			$scope.isTaiwan = "1";
		}

		$scope.click_dance = function() {
			self.effectInit();
			$scope.dEffect = "light";
			$scope.isTaiwan = "1";
		}

		$scope.click_poker= function() {
			self.effectInit();
			$scope.pEffect = "light";
			$scope.isMacau = "1";
		}
		
		self.uiInit();
		self.dataInit();
		$scope.click_financial();
	}
})();