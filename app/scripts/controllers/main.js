'use strict';

angular.module('programApp')
  .controller('MainCtrl', function ($scope,$rootScope,$location,$route) {
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
      $location.path('/registration');
      $route.reload();
      $rootScope.modal = false;
    };

    $('#menuMobile').sidr({
      side: 'right'
    });
    $('.sidr a').on('click',function(){
      $.sidr('close', 'sidr');

    });

    $('.pagination a').on('click',function(e){
      e.preventDefault();
      if(e.currentTarget.className !=='active'){
        $('.pagination a.active,.page.active').removeClass('active');
        $(this).addClass('active');
        $('.page-'+parseInt(e.currentTarget.innerHTML)).addClass('active');

      }
    });
  });
