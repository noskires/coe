(function(){
    'use strict';
    angular
        .module('coeApp')
        .controller('AllRequestCtrl', AllRequestCtrl)

        AllRequestCtrl.$inject = ['CoeSrvcs', 'PurposesSrvcs', 'TypesSrvcs', '$state', '$stateParams', '$uibModal', '$window', '$http', '$timeout', '$scope', '$compile', 'DTOptionsBuilder', 'DTColumnBuilder', 'SweetAlert'];
        function AllRequestCtrl(CoeSrvcs, PurposesSrvcs, TypesSrvcs, $state, $stateParams, $uibModal, $window, $http, $timeout, $scope, $compile, DTOptionsBuilder, DTColumnBuilder, sweetAlert){
            var vm = this;
            var data = {}; 
            vm.is_salary_option_disable = 0;
            
            vm.render = function(data) {
                return '<a href="#" title="Print Preview" ng-click="AllRequestCtrl.printCoeOriginalSigBtn(\'' + data + '\');"> <i class="fa fa-lg fa-print"></i> </a> | <a href="#" title="View Status" ng-click="AllRequestCtrl.viewCoeOriginalSigBtn(\'' + data + '\');"> <i class="fa fa-lg fa-eye"></i> </a>';
            }
            
            vm.coeData = {
                coe_code:'', 
                request_type:'ORIGINAL SIGNATURE',
                is_fulfiller:'YES', 
                is_all_request:'YES',
                is_encrypted:'NO'
            }
  
            vm.dtOptions = DTOptionsBuilder.newOptions()
                .withOption('ajax', {
                url: 'api/v2/coe?coe_code='+vm.coeData.coe_code+'&request_type='+vm.coeData.request_type+'&is_fulfiller='+vm.coeData.is_fulfiller+
                    '&is_all_request='+vm.coeData.is_all_request+'&is_encrypted='+vm.coeData.is_encrypted,
                type: 'GET'
            }) 
            .withDataProp('data')
                .withOption('processing', true)
                .withOption('serverSide', true)
                .withOption('responsive', true)
                .withPaginationType('full_numbers');
            vm.dtColumns = [
                // DTColumnBuilder.newColumn('id').withTitle('#'),
                DTColumnBuilder.newColumn('is_self_service').withTitle('Request Type'),
                DTColumnBuilder.newColumn('coe_code').withTitle('Reference'),
                DTColumnBuilder.newColumn('employee_code').withTitle('Employee Code'),
                DTColumnBuilder.newColumn('name').withTitle('Name'),
                DTColumnBuilder.newColumn('type_desc').withTitle('Type'),
                DTColumnBuilder.newColumn('purpose_desc').withTitle('Purpose'),
                DTColumnBuilder.newColumn('is_salary_confidential01').withTitle('Salary Option'),
                DTColumnBuilder.newColumn('changed_by').withTitle('Assigned To'),
                DTColumnBuilder.newColumn('created_at').withTitle('Changed At'),
                DTColumnBuilder.newColumn('coe_code').withTitle('Action').renderWith(vm.render)
                .withOption('createdCell', function(cell, cellData, rowData, rowIndex, colIndex) {
                    $compile(angular.element(cell).contents())($scope);
                }), 
            ];
  
            vm.printCoeOriginalSigBtn = function(coeCode){
                CoeSrvcs.getEncrypted({coe_code:coeCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        $window.open("original-signature/print/"+response.data.data, '_blank');
                    }
                }, function (){ alert('Bad Request!!!') })
            }
  
            vm.viewCoeOriginalSigBtn = function(coeCode){
                
                CoeSrvcs.getEncrypted({coe_code:coeCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        $window.location.href = "assigned-to-me/details/"+response.data.data;
                    }
                }, function (){ alert('Bad Request!!!') })
            }
 
            vm.routeTo = function(route){
                $window.open(route, '_blank');
            };

        }

})();