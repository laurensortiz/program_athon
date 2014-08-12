'use strict';

angular.module('programApp')
  .directive('menuActive', ['$location',function($location){
    return{
      restrict:'A',
      link: function(scope, element,attr){
        scope.location = $location;
        scope.$watch('location.path()', function(currentPath){

          if('/#'+currentPath === element[0].attributes.href.value){
            element.addClass('active');
          }else if(currentPath ==='/registration_form' && element[0].attributes.href.value ==='/#/registration'){
            element.addClass('active');
          }
          else{
            element.removeClass('active');
          }
        });
      }
    };
  }]);