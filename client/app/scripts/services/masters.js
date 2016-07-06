'use strict';

/**
 * @ngdoc service
 * @name angApp.Clients
 * @description
 * # Clients
 * Service in the angApp.
 */
angular.module('angApp')
    .service('Masters', ['$resource', 'config', function($resource,config) {
        var url = config.colibriApiUrl+'user/get-by-employee';
        return $resource(url, {}, {
            'query': {
                method: 'POST',
            //isArray: true
            }
        });

    }]);
