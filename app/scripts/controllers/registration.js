'use strict';

angular.module('programApp')
  .controller('RegistrationCtrl', function ($scope,$rootScope,$location,$http) {
  //Validate if user answered correctly the answer
  if(!$rootScope.userOk){
    $location.url('/registration');
  }else{
    $location.url('/registration_form');
  }
  if($rootScope.userRegistrated === true){
    $location.url('/');
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

  $scope.groupMembers = [{name:''},{name:''}];

  $scope.addInput = function(){
    $scope.groupMembers.push({name:''});
  };

  //Save info
  $scope.msgs = [];
  $scope.errors = [];
  $scope.sendInfo = function(){
    $rootScope.loading = true;
    $scope.msgs.splice(0,$scope.msgs.length);
    $scope.errors.splice(0,$scope.errors.length);


    $http.post('save.php',{
      'group_name':$scope.groupName,
      'group_leader':$scope.groupLeader,
      'member_1':$scope.groupMembers['0'].name,
      'member_2':($scope.groupMembers['1'])?$scope.groupMembers['1'].name:'',
      'member_3':($scope.groupMembers['2'])?$scope.groupMembers['2'].name:'',
      'member_4':($scope.groupMembers['3'])?$scope.groupMembers['3'].name:'',
      'member_5':($scope.groupMembers['4'])?$scope.groupMembers['4'].name:'',
      'group_leader_id':$scope.groupLeaderId,
      'group_leader_email':$scope.groupLeaderEmail,
      'group_leader_phone':$scope.groupLeaderPhone
    }).success(function(data, status,headers,config){
      $rootScope.loading = false;
      if(data.msg != ''){
        //$scope.msgs.push(data.msg);
        $rootScope.userRegistrated = true;
      }else{
        $scope.errors.push(data.error);

      }
    }).error(function(data,status){

      $scope.errors.push(status);
    });
  };


});
