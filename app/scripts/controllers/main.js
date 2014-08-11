'use strict';

angular.module('programApp')
  .controller('MainCtrl', function ($scope,$rootScope,$location) {
    $rootScope.modal = false;

    $scope.closeModal = function(){
      console.log('ssss')
      $location.url('/');
      $rootScope.modal = false;
    };

});
