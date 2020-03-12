SetupModule
		.controller(
				'BrokerSetupPackageController',
				function($scope, $http) {
					$scope.showDetailDiv = false;
					$scope.formShow = "true";
					$scope.num = false;
					$scope.uploadname = "/img/brokerlogo/default.jpg";
					//$scope.details = [];
					
					//$scope.loadingShow = false;
					$scope.showPaymentDiv = false;
					
					$scope.upload = function() {
						$scope.num =50;
						$scope.formShow = false;
						$scope.loadingShow = true;
						var data = $.param({
							companylogo : $scope.logo

						});

						var config = {
							headers : {
								'Content-Type' : 'application/x-www-form-urlencoded;charset=utf-8;'
							}
						}
						
						$http.post('/user/broker/upload-logo', data, config)
			            .success(function (data, status, headers, config) {
			                $scope.PostDataResponse = data;
			            })
			            .error(function (data, status, header, config) {
			                $scope.ResponseDetails = "Data: " + data +
			                    "<hr />status: " + status +
			                    "<hr />headers: " + header +
			                    "<hr />config: " + config;
			            });
					};
					
					$scope.showpackageDetails = function(ert) {
						// get information from the database
						$scope.deails = [];
						$http(
								{
									method : 'GET',
									url : '/general/ get-package-info-json',
									data : $.param({
										packageId : $scope.packageId,

									}),
									data : $scope.packageId,
									headers : {
										'Content-Type' : 'application/x-www-form-urlencoded'
									}

								}).success(function(data, status) {
							// window.location.href = "/login";
							// Set package details here
							$scope.details = [ {

								'name' : data.packageName,
								'price' : data.price,
							} ]

						}).error(function(response) {
							$scope.codeStatus = response || "Request failed";
						});

						

					}

				});