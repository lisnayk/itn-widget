'use strict';

/**
 * @ngdoc function
 * @name angApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the angApp
 */
angular.module('angApp')
        .controller('MainCtrl', ['$scope', 'cfpLoadingBar', 'Events', "Masters", "RecTimes", 'JobList', 'Log', 'Auth', "config", function ($scope, cfpLoadingBar, Events, Masters, RecTimes, JobList, Log, Auth, config) {
                var main = this;
                main.mastersList = [];
                main.currentMaster = {};
                
                main.checkInDate = 0;
                main.checkInTime = {};
                main.activeScreen = 0;
                main.jobsList = []
                main.clientReguest = {
                    name: "",
                    lastname: "",
                    phone: "",
                    jobs: {}

                }

                //PUBLIC METHODS
                main.nextCheckInDate = function () {
                    main.checkInDate++;
                }
                main.prevCheckInDate = function () {
                    main.checkInDate--;
                }
                main.getDate = function (days) {
                    var date = new Date();
                    date = new Date(date.setTime(date.getTime() + days * 86400000));
                    return date.getFullYear() + '-' + ('0' + (date.getMonth() + 1)).slice(-2) + '-' + ('0' + date.getDate()).slice(-2);
                }
                main.checkIn = function (item) {
                    console.log(item);
                    main.checkInTime = item;
                    main.activeScreen = 1;
                }
                main.selectJob = function (job) {
                    var index = job.length - 1;
                    console.log(job);
                    for (var key in main.jobsList.data) {
                        if (job[0] == main.jobsList.data[key][0]) {
                            main.jobsList.data[key][index] = !main.jobsList.data[key][index];
                        }
                    }
                    console.log(main.jobsList.data);

                }
                main.selectedJobs = function () {
                    var index = 3;
                    var list = [];
                    for (var key in main.jobsList.data) {
                        if (main.jobsList.data[key][index]) {
                            list.push( main.jobsList.data[key]);
                        }
                    }
                    return list;
                };
                //PRIVATE METHODS
                function loadRecTimes() {
                    cfpLoadingBar.start();
                    if (main.currentMaster) {
                        RecTimes.query({}, {
                            id: main.currentMaster.id,
                            date: main.getDate(main.checkInDate) + "T05:00:00.000Z"
                                    //"2016-07-27T05:00:00.000Z",
                        }).$promise.then(
                                handleResolve,
                                handleReject
                                ).finally(handleFinally)
                    }
                    function handleResolve(data) {
                        main.recTimes = data;
                        console.log(data);
                    }
                    function handleReject() {
                        alert("Oops, data could not be loaded.");
                    }

                }
                function loadJobList() {
                    cfpLoadingBar.start();
                    if (main.currentMaster) {
                        JobList.query({}, {
                            id: main.currentMaster.id,
                        }).$promise.then(
                                handleResolve,
                                handleReject
                                ).finally(handleFinally)
                    }
                    function handleResolve(data) {
                        console.log(data);
                        for (var key in data.data) {
                            data.data[key].push(false);
                        }
                        main.jobsList = data;
                        console.log(data);
                    }
                    function handleReject() {
                        alert("Oops, data could not be loaded.");
                    }

                }
                function handleFinally() {
                    cfpLoadingBar.complete();
                }

                // APP START
                cfpLoadingBar.start();
                Auth.then(function (info) {

                    // we can create an instance as well
                    Log.addLog(3);

                    main.mastersList = Masters.query({}, {
                        id: config.clientId
                    }).$promise.then(function (data) {

                        main.mastersList = data;
                        console.log(data);
                        if (main.mastersList && main.mastersList.data.length > 0) {
                            main.currentMaster = main.mastersList.data[0];
                        }
                    });
                    //main.data = Events.query();
                });


                // Watches
                $scope.$watch('main.currentMaster', function (newValue, oldValue) {
                    if (newValue === oldValue) {
                        return;
                    }
                    loadRecTimes();
                    loadJobList();
                });
                $scope.$watch('main.checkInDate', function (newValue, oldValue) {
                    if (newValue === oldValue) {
                        return;
                    }
                    loadRecTimes();

                });

            }]);
