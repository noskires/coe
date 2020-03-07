(function(){
    'use strict';
    angular
        .module('coeApp')
        .factory('AuditsSrvcs', AuditsSrvcs)

        AuditsSrvcs.$inject = ['$http'];
        function AuditsSrvcs($http) {
            return {
                list: function(data) {
                    return $http({
                        method: 'GET',
                        data: data,
                        url: 'api/v1/audits?id='+data.id,
                        headers: {'Content-Type': 'application/json'}
                    })
                }

            };
        }
})();