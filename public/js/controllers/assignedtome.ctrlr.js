(function(){
    'use strict';
    angular
        .module('coeApp')
        .controller('AssignedToMeCtrl', AssignedToMeCtrl)
        .controller('AssignedToMeCtrlDetailsCtrl', AssignedToMeCtrlDetailsCtrl) 

        AssignedToMeCtrl.$inject = ['CoeSrvcs', 'PurposesSrvcs', 'TypesSrvcs', '$state', '$stateParams', '$uibModal', '$window', '$http', '$timeout', '$scope', '$compile', 'DTOptionsBuilder', 'DTColumnBuilder', 'SweetAlert'];
        function AssignedToMeCtrl(CoeSrvcs, PurposesSrvcs, TypesSrvcs, $state, $stateParams, $uibModal, $window, $http, $timeout, $scope, $compile, DTOptionsBuilder, DTColumnBuilder, sweetAlert){
            var vm = this;
            var data = {}; 
            vm.is_salary_option_disable = 0; 

            vm.render = function(data) {
                return '<a href="#" title="Print Preview" ng-click="AssignedToMeCtrl.printCoeOriginalSigBtn(\'' + data + '\');"> <i class="fa fa-lg fa-print"></i> </a> | <a href="#" title="View Status" ng-click="AssignedToMeCtrl.viewCoeOriginalSigBtn(\'' + data + '\');"> <i class="fa fa-lg fa-eye"></i> </a>';
            }
            
            vm.coeData = {
                coe_code:'',
                request_type:'ORIGINAL SIGNATURE',
                is_fulfiller:'YES', 
                is_all_request:'NO',
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
                DTColumnBuilder.newColumn('coe_code').withTitle('Reference'),
                DTColumnBuilder.newColumn('employee_code').withTitle('Employee Code'),
                DTColumnBuilder.newColumn('name').withTitle('Name'),
                DTColumnBuilder.newColumn('type_desc').withTitle('Type'),
                DTColumnBuilder.newColumn('purpose_desc').withTitle('Purpose'),
                DTColumnBuilder.newColumn('is_salary_confidential01').withTitle('Salary Option'),
                DTColumnBuilder.newColumn('changed_by').withTitle('Created By'),
                DTColumnBuilder.newColumn('created_at').withTitle('Changed At'),
                DTColumnBuilder.newColumn('coe_code').withTitle('Actions').renderWith(vm.render)
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
                $window.location.href = route;
            };

            if($stateParams.coe_code){  
                $uibModal.open({
                    templateUrl: 'view-status-admin-modal',
                    controller: 'AssignedToMeCtrlDetailsCtrl',
                    controllerAs: 'AssignedToMeCtrl',
                    backdrop: 'static',
                    keyboard  : false,
                    resolve :{
                        collection: function () {
                            return {
                                data:null
                            };
                        }
                    },
                    size: 'lg'
                }); 
            }

        }

        AssignedToMeCtrlDetailsCtrl.$inject = ['collection', 'CoeSrvcs', 'StatusItemsSrvcs', '$stateParams', '$state', '$uibModalInstance', '$window', 'SweetAlert'];
        function AssignedToMeCtrlDetailsCtrl (collection, CoeSrvcs, StatusItemsSrvcs, $stateParams, $state, $uibModalInstance, $window, sweetAlert) {

            var vm = this;
  
            vm.reply_statuses = [
                {code: 'STAT0002', desc:'Work in progress'},
                {code: 'STAT0003', desc:'Completed the request'},
                {code: 'STAT0005', desc:'Cancelled the request'}
            ];

            vm.coeData = {
                coe_code:$stateParams.coe_code,
                request_type:'ORIGINAL SIGNATURE',
                is_fulfiller:'YES', 
                is_all_request:'YES',
                is_encrypted:'YES'
            }
            
            CoeSrvcs.list(vm.coeData).then (function (response) {
                console.log(response)
                if(response.data.status == 200)
                {
                    vm.coe = response.data.data[0];
                    console.log(vm.coe)
                }
            }, function (){ alert('Bad Request!!!') })
            
            vm.statusItemDetails = {
                status_item_code:'',
                status_code:'',
                coe_code:$stateParams.coe_code,
                user_type:'',
                user_type_id:'',
            }

            StatusItemsSrvcs.list(vm.statusItemDetails).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.status_items = response.data.data;
                    vm.status_item = response.data.data[0];
                    console.log(vm.status_items)
                    console.log(vm.status_item)
                }
            }, function (){ alert('Bad Request!!!') })


            vm.updateCoeOriginalSigBtn = function(data){
                console.log(data)
                data['user_type'] = 'FULFILLER';
                console.log(data) 

                StatusItemsSrvcs.store(data).then(function(response){
                    if (response.data.status == 200) {

                        sweetAlert.swal("Success!", "", "success");

                        vm.statusItemDetails = {
                            status_item_code:'',
                            status_code:'',
                            coe_code:$stateParams.coe_code,
                            user_type:'',
                            user_type_id:'',
                        }

                        StatusItemsSrvcs.list(vm.statusItemDetails).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.status_items = response.data.data;
                                vm.status_item = response.data.data[0];
                                console.log(vm.status_items)
                                console.log(vm.status_item)
                            }
                        }, function (){ alert('Bad Request!!!') })
                    }
                    else {
                        sweetAlert.swal("Error!", "Bad Request!", "error");
                    }
                    console.log(response.data);
                }, function (){ sweetAlert.swal("Error!", "Bad Request!", "error"); })
            }  
         
            vm.routeTo = function(route){
                $window.location.href = route;
            };

            vm.close = function() {
                $uibModalInstance.close();
            };
        }

})();