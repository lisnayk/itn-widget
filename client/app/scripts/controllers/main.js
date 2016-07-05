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
                $http.defaults.headers.post["Content-Type"] = "text/plain";
                $http.get('http://api.yii-itn/v1/events', {method: 'POST', headers: {
                        Authorization: "Bearer 'RSFeFH2XnEk0J1gsN9Q4iYJg-RiLPwxC'",
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                    }}).then(function (response) {
                    console.log(response)
                });
                Auth.then(function (info) {
                    console.log(info);
                    vm.clientsList = Clients.query({}, {
                        id: config.clientId
                    });
                    vm.data = Events.query();
                });




            }]);
