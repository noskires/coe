(function(){
    'use strict';
    angular
        .module('coeApp')
        .controller('AuditsCtrl', AuditsCtrl) 

        AuditsCtrl.$inject = ['AuditsSrvcs', '$state', '$stateParams', '$uibModal', '$window', '$scope', '$compile', 'DTOptionsBuilder', 'DTColumnBuilder', 'SweetAlert'];
        function AuditsCtrl(AuditsSrvcs, $state, $stateParams, $uibModal, $window, $scope, $compile, DTOptionsBuilder, DTColumnBuilder, sweetAlert){
            var vm = this;
            var data = {}; 
           
            // vm.dtOptions = DTOptionsBuilder.newOptions()
            //     .withOption('ajax', {
            //     url: 'api/v2/audits',
            //     type: 'GET'
            // }) 
            // .withDataProp('data')
            //     .withOption('processing', true)
            //     .withOption('serverSide', true)
            //     .withOption('responsive', true)
            //     .withPaginationType('full_numbers');
            // vm.dtColumns = [
            //     DTColumnBuilder.newColumn('id').withTitle('#'),
            //     DTColumnBuilder.newColumn('user_type').withTitle('User Type'),
            //     DTColumnBuilder.newColumn('email').withTitle('Email'),
            //     DTColumnBuilder.newColumn('event').withTitle('Event'),
            //     DTColumnBuilder.newColumn('auditable_type').withTitle('Auditable Type'),
            //     DTColumnBuilder.newColumn('auditable_id').withTitle('Auditable ID'),
            //     DTColumnBuilder.newColumn('old_values').withTitle('Old Values'),
            //     DTColumnBuilder.newColumn('new_va1lues').withTitle('New Values'), 
            //     DTColumnBuilder.newColumn('created_at').withTitle('Changed At')
            // ];

            AuditsSrvcs.list({id:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.audits = response.data.data;
                    console.log(vm.audits)
                }
            }, function (){ alert('Bad Request!!!') })
 
        }

})();