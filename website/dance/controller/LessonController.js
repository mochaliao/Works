(function()
{
	angular
		.module('VipApp')
		.controller('LessonController', LessonController);

	LessonController.$inject = ['$stateParams','$scope', '$state', 'UserData', 'LanMgr'];

	function LessonController($stateParams, $scope, $state, UserData, LanMgr)
	{
		var self = this;

		if($stateParams.typeID == "")
			$stateParams.typeID = 1;

		$( 'html, body').animate({
		   scrollTop: 0}, 0);

		$scope.typeID = $stateParams.typeID;

		$scope.lessonTitle = "";
		$scope.lessonIntro="";
		$scope.lessonSchedule="";

		$scope.typeTables = [
			{
				title : "幼兒律動",
				content : 	"透過富有創意的舞蹈動作及充滿節奏的律動音樂，啟發孩子豐富的想像力及" + 
							"提高音樂節奏感，增加肢體的靈活運用，並同時使孩子體驗群體生活，培養" + 
							"自信心。將遊戲融入舞蹈吸引孩子們的興趣，快樂的學習可以促進孩子們心" + 
							"靈上的愉悅同時啟發孩子們的創造力、思考力，也為學齡前幼兒訓練肌力及" + 
							"小肌肉群。",
			},
			{
				title : "芭蕾舞",
				content : 	"通過各種芭蕾舞基本功的訓練，對孩子的骨骼發育、形體都有好處，能夠糾" + 
							"正不良姿態和形體，無論站姿還是坐姿，都能保持挺拔端莊。學習芭蕾同時" + 
							"還可以改善氣質、增強自信，那是一種優雅、一種沉靜、一種由內而外的魅" + 
							"力。",
			},
			{
				title : "現代舞",
				content : "現代舞是為了發現人類整個肢體的無限可能。現代舞有各種各樣的面部表情" + 
							"、可以創造出千奇百怪的姿勢並且更能訓練平衡感及肢體張力。如果你喜歡" + 
							"享受身體的動作與流暢的呼吸結合在一起，來跳現代舞吧！",
			},
			{
				title : "中國舞",
				content : "中國舞講究身韻、身法、技巧，是奠基在中華五千年的文明歷史之上，可細" + 
							"分為古典舞、民俗舞及民間舞蹈。其中又透過國劇武功及身段的訓練，加強" + 
							"了肌力的訓練與穩定性，更在動作中貫穿了提、沉、沖、靠、含、腆、移、" + 
							"旁提的動律元素及手、眼、身、法、步的要求。是陽剛與柔媚並存的舞蹈訓" + 
							"練。",
			},
			{
				title : "兒童街舞",
				content : "跳街舞可使小朋友注意力集中。動作是由各種走、跑、跳组合而成，極富變" + 
							"化。街舞不僅具有一般有氧運動改善心肺功能、减少脂肪、增强肌肉彈性、" + 
							"增强韌帶柔韌性的功效，還具有協調人體各部位肌肉群，塑造優美體態，提" + 
							"高人體協調能力，陶冶美感的功能並增加全身的協調性。",
			},
			{
				title : "MV 舞蹈",
				content : "看著電視上偶像歌手又唱又跳的帥酷可愛模樣，想學又跟不上播放的速度嗎" + 
							"？MV 舞蹈課程中，會將整首舞曲的動作分解，讓你和偶像一樣有魅力、自" + 
							"信的完成一首舞蹈，歡迎大家跟著熟悉的旋律一起跳起來﹗一起動起來吧！",
			},
			{
				title : "成人瑜珈",
				content : "瑜珈是一門生理、心理和精神上的學問，瑜珈能讓你更了解自己的身體方式" + 
							"，當不同的瑜珈姿勢設計組合成一連串的動作，就能讓身體每個生理、心理" + 
							"受益，瑜珈是一個全身伸展、強化的運動，和其他運動不同的是必須有意識" + 
							"的控制呼吸，透過呼吸慢慢體會能量的連結和肌群的強化、加強核心的穩定" + 
							"性和強化，讓身心靈合而為一！",
			},
			{
				title : "成人有氧",
				content : "有氧運動的目的在於增強心肺耐力，長期堅持有氧運動能增加體內血紅蛋白" + 
							"的數量、提高機體抵抗力、抗衰老、增強大腦皮層的工作效率和心肺功能、" + 
							"增加脂肪消耗，同時防止動脈硬化、降低心腦血管疾病的發病率。快來跟我" + 
							"們一起動一動吧！",
			},
			{
				title : "成人芭蕾",
				content : "現代都市人都是坐著工作，很少運動。芭蕾的基本動作中有不少肩背和手" + 
							"臂的動作，特別適合辦公室的白領來鬆弛緊張的肩背。成人芭蕾的動作組" + 
							"合以課程的音樂編制動作，節奏簡單清楚、易於把握，還可提升音樂節奏" + 
							"感、提高身體協調能力。",
			},
			{
				title : "成人現代",
				content : "以芭蕾為基礎卻拋開芭蕾的制式化舞姿，配合呼吸及音樂節奏讓身體自由的" + 
							"舞動，讓你在忙碌的生活中放鬆思緒、愉悅心情，與自己的身體親密對話。",
			},
		]

		$scope.classTables = [
			{
				Column0: {text: "A教室", style:"className"},
				Column1: {text: "一", style:"classDate"},
				Column2: {text: "二", style:"classDate"},
				Column3: {text: "三", style:"classDate"},
				Column4: {text: "四", style:"classDate"},
				Column5: {text: "五", style:"classDate"},
				Column6: {text: "六", style:"classDate"},
				Column7: {text: "日", style:"classDate"},
			},
			{
				Column0: {text: "上<br>午", style:"classTime"},
				Column1: {text: "", style:"classNone"},
				Column2: {text: "9:00-12:00<br>舞團課程", style:"classDance"},
				Column3: {text: "9:00-12:00<br>舞團課程", style:"classDance"},
				Column4: {text: "9:00-12:00<br>舞團課程", style:"classDance"},
				Column5: {text: "9:00-12:00<br>舞團課程", style:"classDance"},
				Column6: {text: "9:00-12:00<br>兒童舞團<br>現代", style:"classChildDG"},
				Column7: {text: "9:00-12:00<br>兒童舞團<br>中國舞", style:"classChildDG"},
			},
			{
				Column0: {text: "下<br>午", style:"classTime"},
				Column1: {text: "2:00~5:00<br>舞團排練", style:"classDance"},
				Column2: {text: "2:00~5:00<br>舞團排練", style:"classDance"},
				Column3: {text: "2:00~5:00<br>舞團排練", style:"classDance"},
				Column4: {text: "2:00~5:00<br>舞團排練", style:"classDance"},
				Column5: {text: "", style:"classNone"},
				Column6: {text: "2:00-5:00<br>兒童舞團<br>芭蕾<br><a href='#/teacher/4'>青瀠</a>", style:"classChildDG"},
				Column7: {text: "", style:"classNone"},
			},
			{
				Column0: {text: "晚<br>上", style:"classTime"},
				Column1: {text: "6:00-7:30<br>兒童芭蕾<br><a href='#/teacher/8'>夢蝶</a>", style:"classDanceBL"},
				Column2: {text: "6:30-8:00<br>成人現代<br><a href='#/teacher/0'>文歆</a>", style:"classDanceAD"},
				Column3: {text: "6:30-7:30<br>兒童芭蕾<br><a href='#/teacher/0'>文歆</a>", style:"classDanceBL"},
				Column4: {text: "6:30-7:30<br>兒童中國舞<br><a href='#/teacher/0'>文歆</a>", style:"classDanceBL"},
				Column5: {text: "6:00-7:30<br>兒童中國舞<br>黃平", style:"classDanceBL"},
				Column6: {text: "", style:"classNone"},
				Column7: {text: "", style:"classNone"},
			},
			{
				Column0: {text: "晚<br>上", style:"classTime"},
				Column1: {text: "7:30-9:00<br>兒童現代<br><a href='#/teacher/6'>敏妙</a>", style:"classChildModern"},
				Column2: {text: "8:00-9:00<br>兒童MV<br><a href='#/teacher/8'>夢蝶</a>", style:"classDanceBL"},
				Column3: {text: "7:30-9:00<br>成人芭蕾<br><a href='#/teacher/0'>文歆</a>", style:"classDanceAD"},
				Column4: {text: "8:00-9:00<br>兒童芭蕾<br><a href='#/teacher/5'>彥徵</a>", style:"classDanceBL"},
				Column5: {text: "7:30-8:30<br>成人街舞<br><a href='#/teacher/1'>小七</a>", style:"classDanceAD"},
				Column6: {text: "", style:"classNone"},
				Column7: {text: "", style:"classNone"},
			},
		];

		$scope.classTables2 = [
			{
				Column0: {text: "B教室", style:"className"},
				Column1: {text: "一", style:"classDate"},
				Column2: {text: "二", style:"classDate"},
				Column3: {text: "三", style:"classDate"},
				Column4: {text: "四", style:"classDate"},
				Column5: {text: "五", style:"classDate"},
				Column6: {text: "六", style:"classDate"},
				Column7: {text: "日", style:"classDate"},
			},
			{
				Column0: {text: "上<br>午", style:"classTime"},
				Column1: {text: "10:30-11:30<br>幼兒律動<br><a href='#/teacher/5'>彥徵</a>", style:"classBaby"},
				Column2: {text: "10:30-11:30<br>幼兒律動<br><a href='#/teacher/5'>彥徵</a>", style:"classBaby"},
				Column3: {text: "", style:"classNone"},
				Column4: {text: "10:00-11:00<br>成人瑜珈<br><a href='#/teacher/0'>文歆</a>", style:"classDanceAD"},
				Column5: {text: "10:30-11:30<br>幼兒律動<br><a href='#/teacher/5'>彥徵</a>", style:"classBaby"},
				Column6: {text: "9:00-12:00<br>兒童舞團<br>中國舞", style:"classChildDG"},
				Column7: {text: "9:00-12:00<br>兒童舞團<br>芭蕾", style:"classChildDG"},
			},
			{
				Column0: {text: "下<br>午", style:"classTime"},
				Column1: {text: "2:30-3:30<br>成人瑜珈<br><a href='#/teacher/7'>彭彭</a>", style:"classDanceAD"},
				Column2: {text: "", style:"classNone"},
				Column3: {text: "", style:"classNone"},
				Column4: {text: "2:30-3:30<br>成人瑜珈<br><a href='#/teacher/7'>彭彭</a>", style:"classDanceAD"},
				Column5: {text: "", style:"classNone"},
				Column6: {text: "2:00-5:00<br>兒童舞團<br>街舞", style:"classChildDG"},
				Column7: {text: "", style:"classNone"},
			},
			{
				Column0: {text: "晚<br>上", style:"classTime"},
				Column1: {text: "6:30-7:30<br>兒童街舞<br><a href='#/teacher/1'>小七</a>", style:"classDanceBL"},
				Column2: {text: "6:30-7:00<br>兒童中國舞<br><a href='#/teacher/2'>云湘</a>", style:"classDanceBL"},
				Column3: {text: "7:00-8:00<br>成人有氧", style:"classDanceAD"},
				Column4: {text: "6:30-7:30<br>兒童街舞<br><a href='#/teacher/1'>小七</a>", style:"classDanceBL"},
				Column5: {text: "", style:"classNone"},
				Column6: {text: "", style:"classNone"},
				Column7: {text: "", style:"classNone"},
			},
			{
				Column0: {text: "晚<br>上", style:"classTime"},
				Column1: {text: "7:30-8:30<br>幼兒律動<br><a href='#/teacher/3'>旻君</a>", style:"classBaby"},
				Column2: {text: "7:30-8:30<br>幼兒律動<br><a href='#/teacher/3'>旻君</a>", style:"classBaby"},
				Column3: {text: "8:00-9:00<br>兒童MV<br><a href='#/teacher/5'>彥徵</a>", style:"classDanceBL"},
				Column4: {text: "8:00-9:00<br>成人瑜珈<br><a href='#/teacher/0'>文歆</a>", style:"classDanceAD"},
				Column5: {text: "", style:"classNone"},
				Column6: {text: "", style:"classNone"},
				Column7: {text: "", style:"classNone"},
			},
		];

		$scope.lessonIntroMouseEvent = function(mode) {
			if($scope.typeID != 1)	
			{
				if(mode == 1) $scope.lessonIntro="over";
				else if(mode == 2) $scope.lessonIntro="";
				else if(mode == 3) self.lessonChoice(1);
			}
		}
		
		$scope.lessonScheduleMouseEvent = function(mode) {
			if($scope.typeID != 2)	
			{
				if(mode == 1) $scope.lessonSchedule="over";
				else if(mode == 2) $scope.lessonSchedule="";
				else if(mode == 3) self.lessonChoice(2);
			}
		}

		self.lessonChoice = function(typeID)
		{
			if(typeID != $scope.typeID)
			{
				$scope.lessonIntro="";
				$scope.lessonSchedule="";
				$scope.typeID = typeID;
				self.dataInit();
				self.uiInit();
			}
		}

		self.dataInit = function () 
		{
			if($scope.typeID == 1)
			{
				$scope.lessonIntro = "over";
				$scope.lessonTitle = "課程介紹";
			}
			else if($scope.typeID == 2)
			{
				$scope.lessonSchedule = "over";
				$scope.lessonTitle = "舞團課表";
			}

			$scope.containerType = "type" + $scope.typeID;
			$scope.tdType = "td_type" + $scope.typeID;
		}

		self.uiInit = function ()
		{
			
		}
		
		self.dataInit();
		self.uiInit();
	}
})();