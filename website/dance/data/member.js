(function() 
{
	angular
		.module('VipApp')
		.service('UserData', member);

	member.$inject = ['$rootScope'];

	function member($rootScope) 
	{
		var self = this;
		var account = "";
		var identify = 0;
		self.setAcc = function(acc) 
		{
			account = acc;
		}
		self.getAcc = function()
		{
			return account;
		}

		self.setIdentify = function(ident)
		{
			identify = ident;
			$rootScope.$broadcast(EvDef.AccChange);
		}

		self.getIdentify = function()
		{
			var type = UserType.UnLogin;
			if(account == "")
			{
				return type;
			}
			else
			{
				if(identify == 0)
					type = UserType.User;
				else if(identify == 1)
					type = UserType.Manager;
			}
			return type;
		}
	}

})();