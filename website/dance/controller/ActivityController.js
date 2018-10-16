(function()
{
	angular
		.module('VipApp')
		.controller('ActivityController', ActivityController);

	ActivityController.$inject = ['$stateParams','$scope', '$state', 'UserData', 'LanMgr', 'HttpService'];

	function ActivityController($stateParams, $scope, $state, UserData, LanMgr, HttpService)
	{
		var self = this;

		if($stateParams.typeID == "")
			$state.go('index');

		$( 'html, body').animate({
		   scrollTop: 0}, 0);

		self.typeID = $stateParams.typeID;
		$scope.albumDance="";
		$scope.albumAct="";
		$scope.albumTitle = "";

		self.currentPage = 2;
		self.itemsPerPage = 6;
		self.totalItems = 50; //晚點放入相簿資料後，直接取相簿的長度
		self.pagesLength = 4;

		$scope.albumDatas = []; //與Server界接的資料使用
		$scope.albumPics = []; //按下相簿後去取圖片資料用
		$scope.albumShowDatas = []; //要展示的資料
		$scope.albumShowPics = []; //要展示的圖片資料

		$scope.showAlbum = '0';
		$scope.showSlider = '0';
		self.choiceIndex = -1;
		$scope.choicePic = '';

		$scope.choiceAlbumName = "";
		$scope.choiceAlbumID = -1;

		$scope.albumDanceMouseEvent = function(mode) {
			if(self.typeID != 1)	
			{
				if(mode == 1) $scope.albumDance="over";
				else if(mode == 2) $scope.albumDance="";
				else if(mode == 3) self.albumChoice(1);
			}
		}
		
		$scope.albumActMouseEvent = function(mode) {
			if(self.typeID != 2)	
			{
				if(mode == 1) $scope.albumAct="over";
				else if(mode == 2) $scope.albumAct="";
				else if(mode == 3) self.albumChoice(2);
			}
		}

		$scope.clickAlbum = function(index) {
			$scope.choiceAlbumID = $scope.albumShowDatas[index].id;
			$scope.choiceAlbumName = $scope.albumShowDatas[index].name;

			console.log($scope.choiceAlbumID);

			$scope.albumShowPics = [];
			$scope.showAlbum= '1';
			//跟Server要這個id下所有照片的資料
			self.itemsPerPage = 16;
			self.GetPicsFromHttp($scope.choiceAlbumID);
			self.pageInit();
		}

		$scope.clickShowSlider = function(index) {
			$scope.showSlider = '1';
			self.choiceIndex = index + (self.itemsPerPage * (self.currentPage - 1));
			$scope.choicePic = $scope.albumPics[self.choiceIndex].path;
		}

		$scope.sliderClose = function () {
			$scope.showSlider='0';
		}

		$scope.sliderLeft = function () {
			self.choiceIndex--;
			if(self.choiceIndex < 0) self.choiceIndex = $scope.albumPics.length - 1;
			$scope.choicePic = $scope.albumPics[self.choiceIndex].path;
		}

		$scope.sliderRight = function () {
			self.choiceIndex++;
			if(self.choiceIndex > ($scope.albumPics.length - 1)) self.choiceIndex = 0;
			$scope.choicePic = $scope.albumPics[self.choiceIndex].path;
		}

		self.albumChoice = function(typeID)
		{
			if(typeID != self.typeID)
			{
				$scope.showAlbum = '0';
				$scope.albumDance="";
				$scope.albumAct="";
				self.typeID = typeID;
				self.dataInit();
				self.uiInit();
			}
		}

		self.pageInit = function () 
		{
			self.currentPage = 1;

			if($scope.showAlbum == '0')
				self.totalItems = $scope.albumDatas.length;
			else if($scope.showAlbum == '1')
				self.totalItems = $scope.albumPics.length;

			if(!$scope.paginationConf)
			{
				$scope.paginationConf = 
				{
		            currentPage: self.currentPage,
		            totalItems: self.totalItems,
		            itemsPerPage: self.itemsPerPage,
		            pagesLength: self.pagesLength,
		            perPageOptions: [10, 20, 30, 40, 50],
		            onChange: self.pageChange,
	            };
	        }
	        else
	        {
	        	$scope.paginationConf.currentPage = self.currentPage;
	        	$scope.paginationConf.totalItems = self.totalItems;
	        	$scope.paginationConf.itemsPerPage = self.itemsPerPage;
	        	self.pageChange();
	        }
		}

		self.pageChange = function ()
		{
			//讀取那一頁的資料，替換資料
			self.currentPage = $scope.paginationConf.currentPage;
			var startIndex = (self.currentPage - 1) * self.itemsPerPage

			if($scope.showAlbum == '0')
			{
				$scope.albumShowDatas = [];
				for(var i =0; i < self.itemsPerPage; i++)
				{
					if(startIndex + i < ($scope.albumDatas.length))
					{
						$scope.albumShowDatas.push($scope.albumDatas[startIndex + i])
					}
				}
			}
			else if($scope.showAlbum == '1')
			{
				$scope.albumShowPics = [];
				for(var i =0; i < self.itemsPerPage; i++)
				{
					if(startIndex + i < ($scope.albumPics.length))
					{
						$scope.albumShowPics.push($scope.albumPics[startIndex + i])
					}
				}
			}
		}

		self.dataInit = function () 
		{
			self.GetAlbumFromHttp();
	        self.pageInit();
		}	

		self.uiInit = function ()
		{
			
		}

		//http method;

		//獲得舞團所有相本
		self.GetAlbumFromHttp = function ()
		{
			var danceAlbumData = [];
	        var actAlbumData = [];
			//跟Server要舞團相本跟活動相本的資料
			var DataObj = {
				id:0,
			};
			HttpService.HttpPost(SOCKET_DEF.URL , SERVICE_TYPE.ALBUM , ACTION_TYPE.ALBUM_LIST, DataObj)
	        .then(function(result) 
	        {
	        	if(result.Ret == ResultMsg.LoginReply.Failed)
	        	{
	        		//DialogService.OpenMessage(DIALOG_MODE.ONEBTN, LanMgr.Get(CS_Login.LOGIN_FAIL), LanMgr.Get(CS_Login.RE_LOGIN_MSG), self.loginFailed);
	        	}
	        	else if(result.Ret == ResultMsg.LoginReply.Success) 
	        	{
	        		var albumList = result.Data.albumList;
	        		console.log(albumList.length);
					for(var i = 0; i < albumList.length; i++)
					{
						if(albumList[i].type == '0')
						{
							danceAlbumData.push(albumList[i]);	
						}
						else if(albumList[i].type == '1')
						{
							actAlbumData.push(albumList[i]);
						}
					}

			        //跟server要資料的地方
					if(self.typeID == 1)
					{
						$scope.albumDance = "over";
						$scope.albumTitle = "舞團相本";
						$scope.albumDatas = danceAlbumData;
					}
					else if(self.typeID == 2)
					{
						$scope.albumAct = "over";
						$scope.albumTitle = "活動相本";
						$scope.albumDatas = actAlbumData;
					}

					self.pageInit();
	        	}
	        });
		}

		//取得某相本內所有資料
		self.GetPicsFromHttp = function(album_id)
		{
			var DataObj = {
				albumID : album_id,
			}
			HttpService.HttpPost(SOCKET_DEF.URL , SERVICE_TYPE.ALBUM , ACTION_TYPE.ALBUM_DETAIL, DataObj)
	        .then(function(result) 
	        {
	        	if(result.Ret == ResultMsg.LoginReply.Success)
	        	{
	        		$scope.albumPics = result.Data.albumPicList;
	        		self.pageInit();
	        	}
	        });
		}



		self.dataInit();
		self.uiInit();

	}
})();