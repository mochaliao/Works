(function()
{
	angular
		.module('VipApp')
		.controller('HeaderController', HeaderController);

	HeaderController.$inject = ['$scope', '$state', 'UserData', 'LanMgr'];

	function HeaderController($scope, $state, UserData, LanMgr)
	{
		var self = this;

		$scope.TwFont="fadeIn";
		$scope.ChFont="";

		$scope.lessonMenuShow = "";
		$scope.activityMenuShow = "";
		$scope.joinMenuShow = "";

		$scope.LanguageChange = function (lanType) 
		{
			LanMgr.SetLan(lanType);
			if(lanType == 0)
			{
				$scope.TwFont="fadeIn";
				$scope.ChFont="";
			}
			else if(lanType == 2)
			{
				$scope.TwFont="";
				$scope.ChFont="fadeIn";
			}
		}

		self.onAccountChange = function () 
		{
			//$scope.userType = UserData.getIdentify();
		}

		$scope.ClickContact = function() {
			$state.go('index', {'fromPage':'contact'});
		}

		$scope.ClickJoin = function() {
			$state.go('index', {'fromPage':'join'});
		}

		$scope.activityListEnter = function() {
			$scope.activityMenuShow = "show";
		}
		$scope.activityListLeave = function() {
			$scope.activityMenuShow = "";
		}

		$scope.lessonListEnter = function() {
			$scope.lessonMenuShow = "show";
		}
		$scope.lessonListLeave = function() {
			$scope.lessonMenuShow = "";
		}

		$scope.joinListEnter = function() {
			$scope.joinMenuShow = "show";
		}
		$scope.joinListLeave = function() {
			$scope.joinMenuShow = "";
		}

		self.dataInit = function () 
		{
			//$scope.userType = UserType.UnLogin;
		}

		self.uiInit = function ()
		{
			$scope.titleInfo = LanMgr.Get(CS_Header.BOARDSYSTEM);
			$scope.queryRentInfo = LanMgr.Get(CS_Header.QUERYRENTINFO);
			$scope.boardInfo = LanMgr.Get(CS_Header.BOARDINFO);
			$scope.logoutInfo = LanMgr.Get(CS_Header.LOGOUTINFO);
			$scope.addUserInfo = LanMgr.Get(CS_Header.ADDUSERINFO);
			$scope.addBoardInfo = LanMgr.Get(CS_Header.ADDBOARDINFO);

			$scope.languageInfo = LanMgr.Get(CS_Header.LANGUAGEINFO);
			$scope.chlanguage = CS_Header.LANGUAGEINFO.CH;
			$scope.enlanguage = CS_Header.LANGUAGEINFO.EN;
			$scope.cnlanguage = CS_Header.LANGUAGEINFO.CN;
		}
		
		$scope.$on(EvDef.AccChange, self.onAccountChange);
		$scope.$on(EvDef.LanChange, self.uiInit);

		$scope.userTypeDef = UserType;

		angular.element(document).ready(function () {
	        self.uiInit();
	        self.dataInit();
        });
	}
})();