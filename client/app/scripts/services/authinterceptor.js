'use strict';

/**
 * @ngdoc service
 * @name angApp.authInterceptor
 * @description
 * # authInterceptor
 * Factory in the angApp.
 */
angular.module('angApp')
        .factory('authInterceptor', ['$q', '$window', function ($q, $window) {

                return {
                    request: function (config) {
                        
                        config.headers = config.headers || {};
                        console.log(config);
                        if (config.headers.token) {
                            config.headers.method = "GET",
                            config.headers.Authorization = 'Bearer ' + config.token;
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
