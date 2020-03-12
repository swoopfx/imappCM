var SubscriptionModule = angular.module('SubModule', []);

SubscriptionModule.controller('renewController', function($scope) {

	// $scope.totalAmount = $scope.subPackageAmount * $scope.totalMonths;
	$scope.packagemonths = 6;
	$scope.taxes = 0;
	$scope.showpackageDetails = function() {
		switch ($scope.packages) {
		case "1":
		case 1:
			val = 0;
			break;

		case "2":
		case 2:
			val = 39999
			break;

		case "3":

		}
		$scope.totalAmount = val * $scope.packagemonths;
		$scope.taxes = ($scope.totalAmount * 5) / 100;
	}

})