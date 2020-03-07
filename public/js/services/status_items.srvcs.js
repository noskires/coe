(function(){
    'use strict';
    angular
        .module('coeApp')
        .factory('StatusItemsSrvcs', StatusItemsSrvcs)

        StatusItemsSrvcs.$inject = ['$http'];
        function StatusItemsSrvcs($http) {
            return {
                list: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/status-items?status_item_code='+data.status_item_code+
                        '&status_code='+data.status_code+'&coe_code='+data.coe_code+'&user_type='+
                        data.user_type+'&user_type_id='+data.user_type_id,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                store: function(data) {
                    return $http({
                        method: 'POST',
                        url: 'api/v1/status-item/store',
                        data: data,
                        headers: {'Content-Type': 'application/json'}
                    })
                },
                // update: function(data) {
                //     return $http({
                //         method: 'POST',
                //         url: 'api/v1/status-item/update',
                //         data: data,
                //         headers: {'Content-Type': 'application/json'}
                //     })
                // },
                // remove: function(data) {
                //     return $http({
                //         method: 'POST',
                //         url: 'api/v1/status-item/remove',
                //         data: data,
                //         headers: {'Content-Type': 'application/json'}
                //     })
                // }

            };
        }
})();