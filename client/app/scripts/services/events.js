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
                            Authorization: true,
                        },
                        isArray: true,
                    }
                }
                );
            }]);
