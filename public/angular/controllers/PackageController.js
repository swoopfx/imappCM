
PackageModul.controller("packageFormController", function($scope){
	$scope.power = 500;
	$scope.isMotorHidden = true;
	$scope.isBuildinHidden = true;
	$scope.isBusinessHidden = true;
	$scope.isLifeHidden = true;
	$scope.isLifeStyleHidden = true;
	$scope.isSportsHidden = true;
	$scope.isTravelHIdden = true;
	$scope.isOthersHidden = true;
	
	$scope.valueLabel = "Values";
	
	$scope.changeStatus = function (){
		$scope.isMotorHidden = true;
		$scope.isBuildinHidden = true;
		$scope.isBusinessHidden = true;
		$scope.isLifeHidden = true;
		$scope.isLifeStyleHidden = true;
		$scope.isSportsHidden = true;
		$scope.isTravelHIdden = true;
		$scope.isOthersHidden = true;
		switch($scope.packageCategory){
		case "1":
			 $scope.isMotorHidden = !scope.isMotorHidden;
			break;
			
		case"2":
			$scope.isBuildinHidden = !$scope.isBuildinHidden;
			break;
		}
	}
	
})