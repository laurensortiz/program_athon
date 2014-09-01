'use strict';

angular.module('programApp')
  .directive('pagination', [function(){
    return{
      restrict:'A',
      link: function(scope, element,attr){

        console.log(scope)
      }
    };
  }]);