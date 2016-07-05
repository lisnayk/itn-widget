'use strict';

/**
 * @ngdoc service
 * @name angApp.Auth
 * @description
 * # Auth
 * Service in the angApp.
 */
angular.module('angApp')
        .service('Auth', ['$http', "config", '$q', function ($http, config, $q) {
                return $q(function (resolve, reject) {
                    $http
                            .get(config.itnApiUrl + 'auth?appKey=' + config.appKey)
                            .success(function (data, status, headers, config) {
                                config.token = data.access_token;

                                resolve("Auth ok! " + config.token);
                            })
                            .error(function (data, status, headers, config) {
                                config.token = null;

                                reject('Auth error: Invalid appasKey');
                            })
                });

            }]);
