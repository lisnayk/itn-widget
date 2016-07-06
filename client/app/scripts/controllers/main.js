'use strict';

/**
 * @ngdoc function
 * @name angApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the angApp
 */
angular.module('angApp')
        .controller('MainCtrl', ['Events', "Masters", 'Log', 'Auth', "config", function (Events, Masters, Log, Auth, config) {
                var vm = this;
                this.awesomeThings = [
                    'HTML5 Boilerplate',
                    'AngularJS',
                    'Karma'
                ];
                vm.mastersList = null;
                vm.currentMaster = 0;

                vm.currentMasterName = function () {
                    //console.log( vm.mastersList);
                    if (vm.mastersList && vm.mastersList.data) {
                        for( var i=0; i< vm.mastersList.data.length; i++) {
                            var item = vm.mastersList.data[i];
                            if (vm.currentMaster == item.id) {
                                return item.name;
                            }
                        }
                    }
                    return "";

                }
                console.log("app run");

                Auth.then(function (info) {

                    // we can create an instance as well
                    Log.addLog(3);

                    vm.mastersList = Masters.query({}, {
                        id: config.clientId
                    });

                    vm.data = Events.query();
                });




            }]);
