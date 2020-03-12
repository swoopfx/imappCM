CustomerModule.controller('customerController', function($scope) {
	$scope.isDob = false;
	$scope.isDobF = function(ser) {
		$scope.isDob = false;
		switch (ser) {
		case "0":
		case 0:
			$scope.isDob = true;
			break;
		case "1":
		case 1:
			// $scope.dob = 25;
			$scope.isDob = false;
			break;
		}

	}
})

CustomerModule.controller('manualPayment', function($scope) {
	$scope.isBankDeposit = false;
	$scope.isBankTransfer = false;
	$scope.isCash = false;
	$scope.isAmount = false;

	$scope.onPaymentChange = function(ser) {

		$scope.isBankDeposit = false;
		$scope.isBankTransfer = false;
		$scope.isCash = false;
		$scope.isAmount = false;
		
		
		switch (ser) {
		case '5':

			$scope.isBankDeposit = true;
			$scope.isAmount = true;

			break;
		case '2':
			$scope.isBankTransfer = true;
			$scope.isAmount = true;
			break;
		case '6':
			$scope.isCash = true
			$scope.isAmount = true;
			break
		default:
			$scope.isBankDeposit = false;
		$scope.isBankTransfer = false;
		$scope.isCash = false;
		$scope.isAmount = false;
			break;
		}
	}
})
