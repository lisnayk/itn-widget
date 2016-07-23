'use strict';

/**
 * @ngdoc service
 * @name angApp.JobList
 * @description
 * # JobList
 * Service in the angApp.
 */
angular.module('angApp')
  .service('JobList', ['$resource', 'config', function($resource,config) {
        var url = config.colibriApiUrl+'job-type/get-by-user';
        return $resource(url, {}, {
            'query': {
                method: 'POST',
            //isArray: true
            }
        });

    }]);
