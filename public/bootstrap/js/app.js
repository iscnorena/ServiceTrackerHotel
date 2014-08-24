'use strict';

var ServiceTrackerApp = angular.module('ServiceTrackerApp', []);

ServiceTrackerApp.controller ('SearchCtrl', function ($scope, $http) {
	$scope.search = function (){

		$http.get('res',{
			params: {name: $scope.searchInput }
		}).success(function (data) {
			$scope.users = data;
		});

	};

});