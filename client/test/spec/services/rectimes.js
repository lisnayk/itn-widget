'use strict';

describe('Service: RecTimes', function () {

  // load the service's module
  beforeEach(module('angApp'));

  // instantiate service
  var RecTimes;
  beforeEach(inject(function (_RecTimes_) {
    RecTimes = _RecTimes_;
  }));

  it('should do something', function () {
    expect(!!RecTimes).toBe(true);
  });

});
