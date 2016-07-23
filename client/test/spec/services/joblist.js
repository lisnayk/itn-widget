'use strict';

describe('Service: JobList', function () {

  // load the service's module
  beforeEach(module('angApp'));

  // instantiate service
  var JobList;
  beforeEach(inject(function (_JobList_) {
    JobList = _JobList_;
  }));

  it('should do something', function () {
    expect(!!JobList).toBe(true);
  });

});
