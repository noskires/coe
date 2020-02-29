(function(){
    'use strict';
    angular
        .module('coeApp')
        .factory('CoeSrvcs', CoeSrvcs)

        CoeSrvcs.$inject = ['$http'];
        function CoeSrvcs($http) {
            return {
                list: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: '/online-coe/api/v1/coe?coe_code='+data.coe_code+'&request_type='+data.request_type
                            +'&is_fulfiller='+data.is_fulfiller+'&is_all_request='+data.is_all_request
                            +'&is_encrypted='+data.is_encrypted,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                store: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/online-coe/api/v1/coe/store',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({
                        method: 'POST',
                        url: '/online-coe/api/v1/coe/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                getEncrypted: function(data) {
                    return $http({
                        method: 'GET',
                        url: '/online-coe/api/v1/get-encrypted?coe_code='+data.coe_code,
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                }, 
                load: function(data) {
                    return $http({
                        method: 'GET',
                        url: '/online-coe/print/coe/'+data.coe_code,
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                }
            };
        }
})();