var SmsModule = angular.module('SmsModule', []);


SmsModule.controller("buySms", function($scope){
//	$scope.availableSMS;
	$scope.topup = 2000;
	var lolo = $scope.topup * 3;
	$scope.sumPayable = lolo + (lolo*5/100);
	
	$scope.onChangeSmsUnit = function(unit){
		
		
//		$scope.topup = unit;
		$scope.totalSMS = $scope.topup + unit;
		var lolo = $scope.topup * 3;
		$scope.sumPayable = lolo + (lolo*5/100);
	}
	
	
	
	
})