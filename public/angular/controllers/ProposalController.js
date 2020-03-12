var ProposalModule = angular.module('ProposalModule', []);


ProposalModule.controller("proposalForm", function($scope){
//	$scope.availableSMS;
	$scope.isTemredValue = false;
	$scope.coverduration = "1";
	$scope.coverDurationCondition = function(ser) {
		switch (ser) {
		case "100":
			$scope.isTemredValue = true;
			break;
		}
	}
	
})