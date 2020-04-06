(function(){
    'use strict';
    angular
        .module('coeApp')
        .factory('PermissionsSrvcs', PermissionsSrvcs)

        PermissionsSrvcs.$inject = ['$http'];
        function PermissionsSrvcs($http) {
            return {
                list: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/permissions?id='+data.id+'&name='+data.name,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                store: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/permission/store',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                update: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/permission/update',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                remove: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/permission/remove',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                }

            };
        }
})();