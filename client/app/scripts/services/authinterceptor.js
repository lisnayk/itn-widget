'use strict';

/**
 * @ngdoc service
 * @name angApp.authInterceptor
 * @description
 * # authInterceptor
 * Factory in the angApp.
 */
angular.module('angApp')
        .factory('authInterceptor', ['$q', '$window', 'config', function ($q, $window, c) {
                return {
                    request: function (config) {

                        config.headers = config.headers || {};

                        if (config.headers.Authorization) {
                            config.headers.Authorization = 'Bearer ' + c.token;
                        }
                        return config;
                    },
                    response: function (response) {
                        if (response.status === 401) {
                            // handle the case where the user is not authenticated
                        }
                        return response || $q.when(response);
                    }
                };
            }]);
