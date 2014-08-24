'use strict';

angular.module('programApp')
  .controller('MainCtrl', function ($scope,$rootScope,$location) {
    $rootScope.loading = true;
    $rootScope.pageReady = false;
    $scope.$on('$viewContentLoaded', function() {
      $rootScope.loading = false;
      $rootScope.pageReady = true;
    });
    $rootScope.loading = false;
    $rootScope.modal = false;
    if($rootScope.userRegistrated === true && $rootScope.userOk === true){
      $rootScope.userRegistrated = true;
    }
    $scope.closeModal = function(){
      $location.url('/');
      $rootScope.modal = false;
    };

    $('#menuMobile').sidr({
      side: 'right'
    });
    $('.sidr a').on('click',function(){
      $.sidr('close', 'sidr');

    });
  });
