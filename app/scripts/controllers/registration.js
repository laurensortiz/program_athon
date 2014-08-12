'use strict';

angular.module('programApp')
  .controller('RegistrationCtrl', function ($scope,$rootScope,$location) {
  //Validate if user answered correctly the answer
    $location.url('/registration_form');
  if(!$rootScope.userOk){
    //$location.url('/registration');
  }else{
    $location.url('/registration_form');
  }
  var QUESTIONS = [
    {
      title: 'Question 1?',
      options:{
        option1:'option1 for Question 1',
        option2:'option2 for Question 1',
        option3:'option3 for Question 1',
        option4:'option4 for Question 1'
      },
      ca:1
      
    },
    {
      title: 'Question 2?',
      options:{
        option1:'option1 for Question 2',
        option2:'option2 for Question 2',
        option3:'option3 for Question 2',
        option4:'option4 for Question 2'
      },
      ca:1

    },
    {
      title: 'Question 3?',
      options:{
        option1:'option1 for Question 3',
        option2:'option2 for Question 3',
        option3:'option3 for Question 3',
        option4:'option4 for Question 3'
      },
      ca:1
    },
    {
      title: 'Question 4?',
      options:{
        option1:'option1 for Question 4',
        option2:'option2 for Question 4',
        option3:'option3 for Question 4',
        option4:'option4 for Question 4'
      },
      ca:1
    },
    {
      title: 'Question 5?',
      options:{
        option1:'option1 for Question 5',
        option2:'option2 for Question 5',
        option3:'option3 for Question 5',
        option4:'option4 for Question 5'
      },
      ca:1
    }
  ];


  var getRandom = function(){
    return parseInt(Math.random() * (5 - 1) + 1);
  };

  $scope.getQuestion = QUESTIONS[getRandom()];

  $scope.userAnswer = [];
  $scope.validateAnswer = function(userAnswer){
    var userAnswer = parseInt(userAnswer)+ 1,
        correctAnswer = $scope.getQuestion.ca;
    if(userAnswer === correctAnswer){
      $rootScope.userOk = true;
      $location.url('/registration_form');
    }else{
      $rootScope.userOk = false;
      $scope.userAnswer = [];
      $rootScope.modal = true;
    }
  };

  //Registration Form

  $scope.groupMembers = [{name:''}];

  $scope.addInput = function(){
    console.log($scope.groupMembers.length+1)
    $scope.groupMembers.push({name:''});
  };


});
