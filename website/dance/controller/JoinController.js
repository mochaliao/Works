(function()
{
	angular
		.module('VipApp')
		.controller('JoinController', JoinController);

	JoinController.$inject = ['$scope', '$state', 'UserData', 'LanMgr', 'HttpService', 'Upload'];

	function JoinController($scope, $state, UserData, LanMgr, HttpService, Upload)
	{
		var self = this;

		$scope.albumTitle = "甄選報名";

		$( 'html, body').animate({
		   scrollTop: 0}, 0);

		self.dataInit = function () 
		{
			
		}

		self.uiInit = function ()
		{
			
		}
		$scope.clickSex = function(sex) {
			$scope.male = false;
			$scope.female = false;
			if(sex == 0)
				$scope.male = true;
			else 
				$scope.female = true;
			$scope.sex = sex;
		}

		$scope.checkCount = function () {
			if($scope.pLifePics.length > 5) {
				var pTempLifePics = [];
				for(var i = 0; i < 5; i++) {
					pTempLifePics.push($scope.pLifePics[i]);
				}
				$scope.pLifePics = pTempLifePics;
			}
		}

		$scope.testPImage = function(file) {
			if(file != null)
			{
				$scope.pImageInfoShow = "hide";
			}
			else 
			{
				$scope.pImageInfoShow = "";	
			}
		}

		$scope.uploadPersonal = function (memberID, file) { 
			var DataObj = {
				memberID : memberID
			}
			var file = file;
			HttpService.UploadFile(SOCKET_DEF.URL , SERVICE_TYPE.JOIN , ACTION_TYPE.JOIN_PERSONAL_PIC, DataObj, file)
		};
		$scope.uploadLife = function (memberID, file, index) { 
			var DataObj = {
				memberID : memberID,
				index : index
			}
			var file = file;
			HttpService.UploadFile(SOCKET_DEF.URL , SERVICE_TYPE.JOIN , ACTION_TYPE.JOIN_LIFE_PIC, DataObj, file)
		};

		self.initJoinForm = function (){
			$scope.name = "";
			$scope.sex = 0;
			$scope.male = true;
			$scope.female = false;
			$scope.borthYear = "";
			$scope.borthMonth = "";
			$scope.borthDay = "";
			$scope.identify = "";
			$scope.phone = "";
			$scope.email = "";
			$scope.showhistory = "";

			$scope.pImage = null;
			$scope.pImageInfoShow = "";
			$scope.pLifePics = [];
		}

		self.checkInputField = function () {
			var flag = true;
			if($scope.name == "")
			{
				alert("請填寫姓名");
				flag = false;
			}
			else if($scope.borthYear == "" || $scope.borthMonth == "" || $scope.borthDay == "")
			{
				alert("請填寫出生年月日");
				flag = false;
			}
			else if($scope.identify == "")
			{
				alert("請填寫身份證字號");
				flag = false;
			}
			else if($scope.phone == "")
			{
				alert("請填寫電話號碼");
				flag = false;
			}
			else if($scope.email == "")
			{
				alert("請填寫E-mail");
				flag = false;
			}
			else if($scope.pImage == null)
			{
				alert("請放上個人照片");
				flag = false;
			}
			else if($scope.pLifePics.length == 0)
			{
				alert("請放上至少一張生活照片");
				flag = false;
			}
			return flag;
		}

		$scope.joinComplete = function () {
			if(!self.checkInputField()) return;
			var DataObj = 
			{
				name : $scope.name,
				sex : $scope.sex,
				borthYear : $scope.borthYear,
				borthMonth : $scope.borthMonth,
				borthDay : $scope.borthDay,
				identify : $scope.identify,
				phone : $scope.phone,
				address : $scope.address,
				email : $scope.email,
				company : $scope.company,
				school : $scope.school,
				research : $scope.research,
				danceYear : $scope.danceYear,
				graudeYear : $scope.graudeYear,
				showhistory : $scope.showhistory,
				picNum : $scope.pLifePics.length,
			};
			HttpService.HttpPost(SOCKET_DEF.URL , SERVICE_TYPE.JOIN , ACTION_TYPE.JOIN_COMPLETE, DataObj)
			.then(function(result) 
	        {
	        	if(result.Ret == ResultMsg.LoginReply.Success)
	        	{
	        		$scope.memberID = result.Data.memberID;
	        		if($scope.pImage != null)
	        		{
	        			$scope.uploadPersonal(result.Data.memberID, $scope.pImage);
	        		}
	        		if($scope.pLifePics.length > 0)
	        		{
	        			for(var i = 0; i < $scope.pLifePics.length; i++) {
							$scope.uploadLife(result.Data.memberID, $scope.pLifePics[i], i);
						}
	        		}
	        		alert("報名成功");
	        		self.initJoinForm();
	        	}
	        	else if(result.Ret == -1)
	        	{
	        		alert("報名失敗");
	        		self.initJoinForm();
	        	}
	        	else if(result.Ret == -2)
	        	{
	        		alert("此身份證字號己報名過, 請重新輸入");
	        	}
	        });
		}

		
		self.uiInit();
	    self.dataInit();
	    self.initJoinForm();
	}

	

})();