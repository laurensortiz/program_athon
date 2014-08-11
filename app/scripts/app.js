'use strict';

angular
  .module('programApp', [
    'ngCookies',
    'ngResource',
    'ngSanitize',
    'ngRoute'
  ])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/home.html',
        controller: 'MainCtrl'
      })
      .when('/question_and_answer', {
        templateUrl: 'views/qa.html',
        controller: 'MainCtrl'
      })
      .when('/tournament_description', {
        templateUrl: 'views/tournament_description.html',
        controller: 'MainCtrl'
      })
      .when('/registration', {
        templateUrl: 'views/registration.html',
        controller: 'RegistrationCtrl'
      })
      .when('/terms_and_conditions', {
        templateUrl: 'views/terms_and_conditions.html',
        controller: 'MainCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
  });
