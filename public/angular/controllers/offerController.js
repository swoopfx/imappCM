offerModule.controller('ObjectController', function($scope) {
	// This controller handles all operations in the object form
	// which include emiting information to other controller
	// About the total value of the object
	// Summing upp all available values

	var $createObject = {
		firstInfo : '',
		firstFuntion : function() {
			// this function makes sure that the just entered information is
			// included in the selectedObject
		},
	};

	var selectedObjects = []; // this is an array of objects inormation which
	// are objects themselves

	var objectValueTotal; // this is sumed up toal of the
	$scope.objectValue = objectValueTotal;
	$scope.selectedObjects
	$scope.selectedObjects;

});

offerModule.controller('offerInfoController', function($scope) {

	$scope.isHidden = false;
	$scope.isBroker = false;
	$scope.brokerForm = false;
	$serviceSelector = null;
	$scope.onlyMeDrive = false;
	$scope.ginfo = false;
	$scope.ishire = false;

	$scope.isHired = function() {
		$scope.ishire = !$scope.ishire;
	}

	$scope.thirdPartyForm = function() {
		$scope.isHidden = !$scope.isHidden;

	};

	$scope.requireBroker = function() {
		$scope.brokerForm = !$scope.brokerForm;
	};

	$scope.onlyMeDriv = function() {
		$scope.onlyMeDrive = !$scope.onlyMeDrive;
	}
	$scope.generalInfo = function() {
		$scope.ginfo = !$scope.ginfo;
	}
	$scope.onServiceTypeChange = function() {
		// This call information for the available service in db
	}

	// This is used for the selected objects
	$scope.selectService = function(ser) {
		$scope.motor_non_com_service = false; // the
		$scope.motor_com_service = false;
		$scope.thirdParty_motor = false;
		switch (ser) {
		case '1':

			$scope.motor_non_com_service = true;
			break;
		case '2':
			$scope.motor_com_service = true;
			break;
		case '4':
			$scope.thirdParty_motor = true
		}

	}

});

offerModule.controller('createObjectController', function($scope) {

	$scope.isMotorShow = false;
	$scope.isHouseShow = false;

	var $createObject = {
		firstInfo : '',
		firstFuntion : function() {
			// this function makes sure that the just entered information is
			// included in the selectedObject
		},
	};

	$scope.onCategoryChange = function(ser) {

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
	// $scope.isMotorShow;

});

offerModule.controller('selectObjectController', function($scope) {
	// This controller function selectes object from the database
	// Puts them as part of the objects that are going to be covered
	// This controller listens for an event from creatObject controller
	// For the inclusion of a created object
	$scope.hiddenService = false
	$scope.aggregatedValue = 0;
	$scope.selectedObject = [
	// {
	// id : '1',
	// name : 'Nissan Almera',
	// datecreated : '2012, 02, 10',
	// value : ' 200000',
	// status : 'Processing'
	// },
	//	
	// {
	// id : '2',
	// name : 'Nissan Almera',
	// datecreated : '2012, 02, 10',
	// value : ' 200000',
	// status : 'Processing'
	// },

	]; // This is an array of objects of all the selected information on
	// the
	$scope.searchForObject = function() {

	};

	$scope.aggregation = function() {
		// for each value in selectedobject make a summation
		// and input the vlaue in the aggregatedValue
	};

	$scope.viewSelected = function(selectedId) {
		// this gives a delated view of the selected object
	};

	$scope.deleteSelected = function(arrayId) {
		// This removes the slected object form the array list via pop
	};

	$scope.selectService = function() {
		// This function prives the logic behind the showing of the form
		// It is trigered by the ng-change event
		//

	};

});

offerModule.controller('OfferForm', function($scope) {
	$scope.isTemredValue = false;
	$scope.coverduration = "1";
	$scope.coverDurationCondition = function(ser) {
		switch (ser) {
		case "100":
			$scope.isTemredValue = true;
			break;
		}
	}
});

offerModule.controller('PremiumGeneratorController', function($scope) {

	// This function handles the premium automatic premium generated
	// From the selected insurance or insurance brokers
	// It also provides AI intelligence too
	$scope.premiumGenerated = [ {
		insuranceCompanyId : 'Mansard Insurance',
		policyPackageId : '',
		premiumVlaue : '',
		insuranceCompanyDetails : '',
		policyPackageDetails : '', // This gets the information for the package
	// selected
	} ];

	$scope.preferedBroker = '';
});