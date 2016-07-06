'use strict';

/**
 * @ngdoc service
 * @name angApp.Log
 * @description
 * # Log
 * Service in the angApp.
 */
angular.module('angApp')
        .service('Log', ['$resource', "config", function ($resource, config) {
                var LogModel = $resource(config.itnApiUrl + 'logs', {}, {
                    save: {
                        method: 'POST',
                        headers: {
                            Authorization: true,
                        },
                    }
                }
                );

                this.addLog = function (id) {
                    var newLog = new LogModel({event_id: id});
                    newLog.$save();
                    return true;
                }
            }]);
