ObjectModule.controller('ObjectController', function($scope) {
	// This controller handles all operations in the object form
	// which include emiting information to other controller
	// About the total value of the object
	// Summing upp all available values
	
	$scope.isMotorShow = false;
	$scope.isHouseShow = false;

	var $createObject = {
		firstInfo : '',
		firstFuntion : function() {
			// this function makes sure that the just entered information is
			// included in the selectedObject
		},
	};
	
	
	$scope.onCategoryChange = function (ser){
		
		$scope.isMotorShow = false;
		$scope.isHouseShow = false;
		$scope.data_seed = ser;
		switch (ser) {
		case '1':

			$scope.isMotorShow = true;
			
			break;
		case '2':
			$scope.isHouseShow = true;
			break;
		case '4':
			$scope.thirdParty_motor = true
		}
	}

	var selectedObjects = []; // this is an array of objects inormation which
	// are objects themselves

	var objectValueTotal; // this is sumed up toal of the
	$scope.objectValue = objectValueTotal;
	$scope.selectedObjects;
	$scope.selectedObjects;
	//$scope.isMotorShow;

});