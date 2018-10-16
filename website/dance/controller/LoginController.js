(function()
{
	angular
		.module('VipApp')
		.controller('LoginController', LoginController);

	LoginController.$inject = ['$scope', '$state', 'UserData', 'HttpService', 'DialogService', 'LanMgr'];

	function LoginController($scope, $state, UserData, HttpService, DialogService, LanMgr)
	{
		var self = this;

	    $scope.login = function() {
	        var DataObj = {
	            acc: $scope.account,
	            pwd: $scope.password
	        };

	        HttpService.HttpPost(SOCKET_DEF.URL , SERVICE_TYPE.ACCOUNT , ACTION_TYPE.LOGIN, DataObj)
	        .then(function(result) 
	        {
	        	if(result.Ret == ResultMsg.LoginReply.Failed)
	        	{
	        		//DialogService.OpenMessage(DIALOG_MODE.ONEBTN, LanMgr.Get(CS_Login.LOGIN_FAIL), LanMgr.Get(CS_Login.RE_LOGIN_MSG), self.loginFailed);
	        	}
	        	else if(result.Ret == ResultMsg.LoginReply.Success) 
	        	{
	        		// var accData = result.Data.accountData;
	        		// UserData.setAcc(accData.acc);
	        		// UserData.setIdentify(accData.identify);
	        		// DialogService.OpenMessage(DIALOG_MODE.ONEBTN, LanMgr.Get(CS_Login.LOGIN_SUCCESS), LanMgr.Get(CS_Login.WELCOME_MSG), self.loginSuccess)
	        	}
	        });

	    };

	    $scope.register = function() {
	    	$state.go('register');
	    };

	    self.loginFailed = function() {
	    	console.log("loginFailed");
	    	self.dataInit();
	    };


	    self.loginSuccess = function() {
	    	console.log("loginSuccess");
	    };

	    self.dataInit = function() {
	    	$scope.account = "";
	    	$scope.password = "";
	    };

	    self.uiInit = function() {
	    	$scope.accountInfo = LanMgr.Get(CS_Login.ACCOUNT);
	    	$scope.passwordInfo = LanMgr.Get(CS_Login.PASSWORD);
	    	$scope.loginInfo = LanMgr.Get(CS_Login.LOGIN);
	    	$scope.registerInfo = LanMgr.Get(CS_Login.REGISTER);
	    }

	    $scope.$on(EvDef.LanChange, self.uiInit);
	    self.uiInit();
	    self.dataInit();
	}
})();