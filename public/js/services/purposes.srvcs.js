(function(){
    'use strict';
    angular
        .module('coeApp')
        .factory('PurposesSrvcs', PurposesSrvcs)

        PurposesSrvcs.$inject = ['$http'];
        function PurposesSrvcs($http) {
            return {
                list: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/online-coe/api/v1/purposes?purpose_code='+data.purpose_code+'&type_code='+data.type_code+'&request_type='+data.request_type,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                store: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/online-coe/api/v1/purpose/store',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/online-coe/api/v1/purpose/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                remove: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/online-coe/api/v1/purpose/remove',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                }

            };
        }
})();