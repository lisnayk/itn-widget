'use strict';

/**
 * @ngdoc function
 * @name angApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the angApp
 */
angular.module('angApp')
        .controller('MainCtrl', ['Events', "Clients", 'config', 'Auth', '$http', function (Events, Clients, config, Auth, $http) {
                var vm = this;
                this.awesomeThings = [
                    'HTML5 Boilerplate',
                    'AngularJS',
                    'Karma'
                ];
                console.log("app run");

                Auth.then(function (info) {
                    
                    vm.clientsList = Clients.query({}, {
                        id: config.clientId
                    });
                    vm.data = Events.query();
                });




            }]);
