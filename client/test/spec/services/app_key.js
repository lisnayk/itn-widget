'use strict';

describe('Service: APPKEY', function () {

  // load the service's module
  beforeEach(module('angApp'));

  // instantiate service
  var APPKEY;
  beforeEach(inject(function (_APPKEY_) {
    APPKEY = _APPKEY_;
  }));

  it('should do something', function () {
    expect(!!APPKEY).toBe(true);
  });

});
