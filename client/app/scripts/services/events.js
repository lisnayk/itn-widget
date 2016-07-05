'use strict';

/**
 * @ngdoc service
 * @name angApp.Events
 * @description
 * # Events
 * Service in the angApp.
 */
angular.module('angApp')
        .service('Events', ['$resource', "config", function ($resource, config) {
                return $resource(config.itnApiUrl + 'events', {}, {
                    query: {
                        method: 'GET',
                        headers: {
                            Authorization: "Bearer "+config.token,
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                        }
                    }
                }
                );
            }]);
