'use strict';

angular.module('programApp')
  .controller('RegistrationCtrl', function ($scope) {

  var QUESTIONS = [
    {
      title: 'Question 1?',
      options:{
        option1:'option1 for Question 1',
        option2:'option2 for Question 1',
        option3:'option3 for Question 1',
        option4:'option4 for Question 1'
      }
      
    },
    {
      title: 'Question 2?',
      options:{
        option1:'option1 for Question 2',
        option2:'option2 for Question 2',
        option3:'option3 for Question 2',
        option4:'option4 for Question 2'
      },
      ca:'4'

    },
    {
      title: 'Question 3?',
      options:{
        option1:'option1 for Question 3',
        option2:'option2 for Question 3',
        option3:'option3 for Question 3',
        option4:'option4 for Question 3'
      },
      ca:'3'
    },
    {
      title: 'Question 4?',
      options:{
        option1:'option1 for Question 4',
        option2:'option2 for Question 4',
        option3:'option3 for Question 4',
        option4:'option4 for Question 4'
      },
      ca:'2'
    },
    {
      title: 'Question 5?',
      options:{
        option1:'option1 for Question 5',
        option2:'option2 for Question 5',
        option3:'option3 for Question 5',
        option4:'option4 for Question 5'
      },
      ca:'2'
    }
  ];

  var getRandom = function(){
    return parseInt(Math.random() * (5 - 1) + 1);
  };

  $scope.question = QUESTIONS[getRandom()];





});
