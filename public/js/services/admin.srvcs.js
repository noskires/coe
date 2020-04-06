(function(){
    'use strict';
    angular
        .module('coeApp')
        .factory('AdminsSrvcs', AdminsSrvcs)

        AdminsSrvcs.$inject = ['$http'];
        function AdminsSrvcs($http) {
            return {
                list: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/admins?admin_code='+data.admin_code,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                store: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/admin/store',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                remove: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/admin/remove',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                }

            };
        }
})();