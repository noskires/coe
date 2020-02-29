(function(){
    'use strict';
    angular
        .module('coeApp')
        .controller('AuditsCtrl', AuditsCtrl) 

        AuditsCtrl.$inject = ['AuditsSrvcs', 'EmployeesSrvcs', 'DocumentsSrvcs', '$state', '$stateParams', '$uibModal', '$window'];
        function AuditsCtrl(AuditsSrvcs, EmployeesSrvcs, DocumentsSrvcs, $state, $stateParams, $uibModal, $window){
            var vm = this;
            var data = {}; 
            
            AuditsSrvcs.list({id:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.audits = response.data.data;
                    console.log(vm.audits)
                }
            }, function (){ alert('Bad Request!!!') })
 
        }

})();