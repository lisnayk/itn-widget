'use strict';

/**
 * @ngdoc overview
 * @name angApp
 * @description
 * # angApp
 *
 * Main module of the application.
 */
angular
        .module('angApp', [
            'ngAnimate',
            'ngCookies',
            'ngMessages',
            'ngResource',
            'ngRoute',
            'ngSanitize',
            'ngTouch',
        ])
        .config(function ($routeProvider) {
            $routeProvider
                    .when('/', {
                        templateUrl: 'views/main.html',
                        controller: 'MainCtrl',
                        controllerAs: 'main'
                    })
                    .when('/about', {
                        templateUrl: 'views/about.html',
                        controller: 'AboutCtrl',
                        controllerAs: 'about'
                    })
                    .otherwise({
                        redirectTo: '/'
                    });
        })
        .config(function ($httpProvider) {
            //console.log("authInterceptor is added");
            
            //console.log("authInterceptor is added");
            //$httpProvider.interceptors.push('authInterceptor');
        });

