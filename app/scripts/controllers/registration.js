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
      title: 'To reproduce a file with .MP3 extension in Java, you must:',
      options:{
        option1:'a)	Create a class to convert the file to a .Ogg format',
        option2:'b)	Use the API JavaSound (extends javasound) ',
        option3:'c)	Java includes a SPI provider named AudioClip to administrate .MP3 files',
        option4:'d)	The are no options to audio management in the actual version of the framework '
      },
      ca:2
      
    },
    {
      title: 'A Java property file is a document to store configuration properties of an application.  The correct format to store those properties is:',
      options:{
        option1:'a)	nameof_property=valueof_property',
        option2:'b)	<property name="nameof_property" value="valueof_property" />',
        option3:'c)	id_ofproperty [delimiter] valueof_property',
        option4:'d)	The format doesn’t matter and it is defined by the programmer '
      },
      ca:1

    },
    {
      title: 'A window is composed by multiple layers where the Graphics object represents:',
      options:{
        option1:'a)	A display list.',
        option2:'b)	A container of images.',
        option3:'c)	A canvas for drawing.',
        option4:'d)	A bit map.'
      },
      ca:3
    },
    {
      title: 'To identify an user activity related with a mouse click, a menu activation or an <Enter> key press  in a text box, it’s necessary to implement the following method:',
      options:{
        option1:'a)	componentAdded',
        option2:'b)	itemStateChanged',
        option3:'c)	textValueChanged',
        option4:'d)	actionPerformed'
      },
      ca:4
    },
    {
      title: 'The implementation of a drag mouse sensitive class  is achieved working with:',
      options:{
        option1:'a)	WindowFocusListener',
        option2:'b)	MouseMotionListener',
        option3:'c)	MouseListener',
        option4:'d)	WindowListener'
      },
      ca:2
    },
    {
      title: 'Which of the following code fragments can be used to pause the thread execution during a second?',
      options:{
        option1:'a)	Thread.sleep(1000);',
        option2:'b)	Thread.sleep(1);',
        option3:'c)	Thread.pause(1000);',
        option4:'d)	Thread.pause(1);'
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

  $scope.groupMembers = [{name:'',tSize:''},{name:'',tSize:''}];

  $scope.addInput = function(){
    $scope.groupMembers.push({name:'',tSize:''});
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
      'group_leader_tSize':$scope.groupLeader_tSize,
      'member_1':$scope.groupMembers['0'].name,
      'member_1_tSize':$scope.groupMembers['0'].tSize,
      'member_2':($scope.groupMembers['1'])?$scope.groupMembers['1'].name:'',
      'member_2_tSize':($scope.groupMembers['1'])?$scope.groupMembers['1'].tSize:'',
      'member_3':($scope.groupMembers['2'])?$scope.groupMembers['2'].name:'',
      'member_3_tSize':($scope.groupMembers['2'])?$scope.groupMembers['2'].tSize:'',
      'member_4':($scope.groupMembers['3'])?$scope.groupMembers['3'].name:'',
      'member_4_tSize':($scope.groupMembers['3'])?$scope.groupMembers['3'].tSize:'',
      'member_5':($scope.groupMembers['4'])?$scope.groupMembers['4'].name:'',
      'member_5_tSize':($scope.groupMembers['4'])?$scope.groupMembers['4'].tSize:'',
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
      $rootScope.loading = false;
      if(data.msg != ''){
        //$scope.msgs.push(data.msg);
        $rootScope.userRegistrated = true;
      }else{
        $scope.errors.push(data.error);

      }
    });
  };


});
