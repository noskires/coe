(function(){
    'use strict';
    angular
        .module('coeApp')
        .factory('OtpSrvcs', OtpSrvcs)

        OtpSrvcs.$inject = ['$http'];
        function OtpSrvcs($http) {
            return {
                getRemainingTime: function(data) {
                    return $http({
                        method: 'GET',
                        url: '/online-coe/api/v1/get-remaining-time',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                }

            };
        }
})();