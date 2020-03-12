/**
 * 
 */

var ClaimsModule = angular.module('ClaimsModule', []);

ClaimsModule.controller('CustomerClaimsCondition', function($scope) {
	$scope.packages = 0;
	
	$scope.showForm = function(packages) {
		$scope.isMotor = false;
		$scope.isBondInsurance = false;
		$scope.isBuilderLiabilty = false;
		$scope.isHouseBreak = false;
		$scope.isCashInTransit = false;
		$scope.isAgric = false;
		$scope.isGeneralBusiness = false;
		$scope.isHealth = false;
		$scope.isLifeIndividual = false;
		$scope.isLifeGroup = false;
		$scope.isAviation = false;
		$scope.isBond = false;
		$scope.isBuglary = false;
		$scope.isCashInTransit = false;
		$scope.isConsequentialLoss = false;
		$scope.isContractAllRisk = false;
		$scope.isElectronicEquipment = false;
		$scope.isEmployersLiability = false;
		$scope.isErectionAllRisk = false;
		$scope.isFidelityGurantee = false;
		$scope.isFireAndBiglary = false;
		$scope.isFireAndSpecialPeril = false;
		$scope.isGoodsInTransit = false;
		$scope.isHome = false;
		$scope.isMachineryBreakdown = false;
		$scope.isMachineryLossOfProfit = false;
		$scope.isMarineCargo = false;
		$scope.isMarineHull = false;
		$scope.isOccupiersLiabilty = false;
		$scope.isPersonalAccident = false;
		$scope.isPlantAllRisk = false ;
		$scope.isProfessionlIndemnity = false;
		$scope.isPublicLiability = false;
		$scope.isTravel = false;

		switch (packages) {
		case "1": // MOtor Insurance
			$scope.isMotor = true;

			break;

		case "4": // AGRIC INSURANCE
			$scope.isAgric = true;
			break;

		case "6": // GENERAL BUSINESS INSURANCE
			$scope.isGeneralBusiness = true;
			break;

		case "7": // HEALTH INSURANCE
			$scope.isHealth = true;
			break;

		case "20": // LIFE INSURANCE (Individual)
			$scope.isLifeIndividual = true;
			break;

		case "30": // LIFE INSURANCE (GROUP)
			$scope.isLifeGroup = true
			break;

		case "40": // AVIATION
			$scope.isAviation= true;
			break;

		case "45": // BOND INSURANCE
			$scope.isBond = true;
			break;

		case "49":
			$scope.isBuilderLiabilty = true;
			break;// BUILDERS LIABILITY

		case "53": // BUGLARY AND HOUSE BREAKING INSURANCE
			$scope.isBuglary = true;
			break;

		case "57": // CASH IN TRANSIT
			$scope.isCashInTransit = true
			break;

		case "59": // CONSEQUENTIAL LOSS INSURANCE
			$scope.isConsequentialLoss = true;
			break;

		case "61": // CONSTRACT ALL RISK INSURANCE
			$scope.isContractAllRisk = true;
			break;

		case "64": // ELCTRONIC EQUIPMENT INSURANCE
			$scope.isElectronicEquipment = true;
			break;

		case "67": // EMPLOYERS LIABILITY
			$scope.isEmployersLiability = true;
			break;

		case "70": // ERECTION ALL RISK
			$scope.isErectionAllRisk = true;
			
			break;

		case "71": // FIDELITY GUARATEE INSURACE
			$scope.isFidelityGurantee = true;
			
			break;

		case "73": // FIRE AND BUGLARY INSURANCE
			$scope.isFireAndBiglary = true;
			break;

		case "75": // FIRE AND SPECIAL PERIL INSURANCE
			$scope.isFireAndSpecialPeril = true;
			
			break;

		case "77": // GOODS IN TRANSIT INSURANCE
			$scope.isGoodsInTransit = true
			
			break;

		case "79": // HOME INSURANCE
			$scope.isHome = true;
			
			break;

		case "81":// MACHINERY BREAKDOWN INSURANCE
			$scope.isMachineryBreakdown = true;
			
			break;

		case "83": // MACHINERY LOSS OF PROFIT
			$scope.isMachineryLossOfProfit =true;
			
			break;

		case "85": // MARINE CARGO INSURANCE
			$scope.isMarineCargo = true;
			
			break;

		case "87": // MANRINE HULL INSURANCE
			$scope.isMarineHull = true;
			
			break;

		case "89": // OCCUPEIRS LIABILITY INSURANCE
			$scope.isOccupiersLiabilty = true;
			
			break;

		case "90": // PERSONAL ACCIDENT INSURANCE
			$scope.isPersonalAccident =  true;
			
			break;

		case "92": // PLANT ALL RISK INSURANCE
			$scope.isPlantAllRisk = true;
			
			break;

		case "94":// PROFESSIONAL INDEMNITY INSURANCE
			$scope.isProfessionlIndemnity = true;
			
			break;

		case "97":// PUBLIC LIABILITY INSURANCE
			$scope.isPublicLiability =true;
			
			break;

		case "101": // TRAVEL INSURANCE
			$scope.isTravel = true;
			break;

		}
		$scope.totalAmount = val * $scope.packagemonths;
		$scope.taxes = ($scope.totalAmount * 5) / 100;
	}

})