(function()
{
	angular
		.module('VipApp')
		.controller('RegisterController', RegisterController);

	RegisterController.$inject = ['$scope', '$state', 'UserData', 'HttpService', 'DialogService', 'LanMgr'];

	function RegisterController($scope, $state, UserData, HttpService, DialogService, LanMgr)
	{
		var self = this;

	    $scope.register = function() 
	    {
	        var DataObj = {
	            acc: $scope.account,
	            pwd: $scope.password,
	            name: $scope.name
	        };

	        HttpService.HttpPost(SOCKET_DEF.URL , SERVICE_TYPE.ACCOUNT , ACTION_TYPE.REGISTER, DataObj)
	        .then(function(result) 
	        {
	        	console.log(result);
	        	console.log(result.Ret);
	        	console.log(result.Data);
	        	if(result.Ret == ResultMsg.RegisterReply.Failed)
	        	{
	        		DialogService.OpenMessage(DIALOG_MODE.ONEBTN, LanMgr.Get(CS_Register.REGISTER_FAIL), LanMgr.Get(CS_Register.REGISTER_FAIL), self.registerFailed);
	        	} 
	        	else if(result.Ret == ResultMsg.RegisterReply.AccRepeat)
	        	{
	        		DialogService.OpenMessage(DIALOG_MODE.ONEBTN, LanMgr.Get(CS_Register.REGISTER_FAIL), LanMgr.Get(CS_Register.REGISTER_REPEAT), self.registerFailed);
	        	} 
	        	else if(result.Ret == ResultMsg.RegisterReply.Success) 
	        	{
	        		DialogService.OpenMessage(DIALOG_MODE.ONEBTN, LanMgr.Get(CS_Register.REGISTER_SUCCESS), LanMgr.Get(CS_Register.REGISTER_SUCCESS), self.registerSuccess);
	        	}
	        });
	    };

	    self.registerFailed = function()
	    {
	    	self.dataInit();
	    }

	    self.registerSuccess = function()
	    {
	    	$state.go('login');
	    }

	    self.dataInit = function() 
	    {
	    	$scope.account = "";
		    $scope.password = "";
		    $scope.confirmpwd = "";
		    $scope.name = "";
	    };

	    self.uiInit = function()
	    {
	    	$scope.InputName = LanMgr.Get(CS_Register.INPUTNAME);
	    	$scope.InputAccount = LanMgr.Get(CS_Register.INPUTACCOUNT);
	    	$scope.InputPassword = LanMgr.Get(CS_Register.INPUTPASSWORD);
	    	$scope.InputRePassword = LanMgr.Get(CS_Register.INPUTREPASSWORD);
	    	$scope.RegisterInfo = LanMgr.Get(CS_Register.REGISTERINFO);
	    }

	    $scope.$on(EvDef.LanChange, self.uiInit);
	    self.uiInit();
	    self.dataInit();
	}
})();