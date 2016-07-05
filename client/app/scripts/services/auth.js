'use strict';

/**
 * @ngdoc service
 * @name angApp.Auth
 * @description
 * # Auth
 * Service in the angApp.
 */
angular.module('angApp')
        .service('Auth', ['$http', "config", '$q', function ($http, c, $q) {
                return $q(function (resolve, reject) {
                    $http
                            .get(c.itnApiUrl + 'auth?appKey=' + c.appKey)
                            .success(function (data, status, headers, config) {
                                c.token = data.access_token;
                                resolve("Auth ok! " + c.token);
                            })
                            .error(function (data, status, headers, config) {
                                c.token = null;
                                reject('Auth error: Invalid appasKey');
                            })
                });

            }]);
