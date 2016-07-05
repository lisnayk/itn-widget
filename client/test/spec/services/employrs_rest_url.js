'use strict';

describe('Service: EmployrsRestUrl', function () {

  // load the service's module
  beforeEach(module('angApp'));

  // instantiate service
  var EmployrsRestUrl;
  beforeEach(inject(function (_EmployrsRestUrl_) {
    EmployrsRestUrl = _EmployrsRestUrl_;
  }));

  it('should do something', function () {
    expect(!!EmployrsRestUrl).toBe(true);
  });

});
