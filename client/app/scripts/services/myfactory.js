'use strict';

/**
 * @ngdoc service
 * @name angApp.MyFactory
 * @description
 * # MyFactory
 * Factory in the angApp.
 */
angular.module('angApp')
  .factory('MyFactory', function () {
    // Service logic
    // ...

    var meaningOfLife = 42;

    // Public API here
    return {
      someMethod: function () {
        return meaningOfLife;
      }
    };
  });
