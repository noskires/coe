(function(){
    'use strict';
    angular
        .module('coeApp')
        .factory('RolesSrvcs', RolesSrvcs)

        RolesSrvcs.$inject = ['$http'];
        function RolesSrvcs($http) {
            return {
                list: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/roles?id='+data.id+'&name='+data.name,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                store: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/role/assign-permission',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                remove: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/role/revoke-permission',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                }

            };
        }
})();