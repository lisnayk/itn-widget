'use strict';

/**
 * @ngdoc service
 * @name angApp.RecTimes
 * @description
 * # RecTimes
 * Service in the angApp.
 */
angular.module('angApp')
        .service('RecTimes', ['$resource', 'config', function ($resource, config) {
                var url = config.colibriApiUrl + 'customer-visit/get-all-time';
                return $resource(url, {}, {
                    'query': {
                        method: 'POST',
                       // isArray: true
                    }
                });

            }]);
