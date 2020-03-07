(function(){
    'use strict';
    angular
        .module('coeApp')
        .controller('OriginalSignatureCertCtrl', OriginalSignatureCertCtrl) 
        .controller('OriginalSignatureStatusInstanceCertCtrl', OriginalSignatureStatusInstanceCertCtrl) 
  
        OriginalSignatureCertCtrl.$inject = ['CoeSrvcs', 'PurposesSrvcs', 'TypesSrvcs', '$state', '$stateParams', '$uibModal', '$window', '$http', '$timeout', '$scope', '$compile', 'DTOptionsBuilder', 'DTColumnBuilder', 'SweetAlert'];
        function OriginalSignatureCertCtrl(CoeSrvcs, PurposesSrvcs, TypesSrvcs, $state, $stateParams, $uibModal, $window, $http, $timeout, $scope, $compile, DTOptionsBuilder, DTColumnBuilder, sweetAlert){
            
            var vm = this;
            var data = {};
            vm.is_salary_option = 1;
 
            vm.salary_options = [
                {id:0, text:"SHOW SALARY"},
                {id:1, text:"CONFIDENTIAL"}
            ];

            TypesSrvcs.list({type_code:'', is_self_service:'NO'}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.coeTypes = response.data.data;
                    console.log(vm.coeTypes)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.render = function(data) {
                return '<a href="#" title="View status" ng-click="coeCtrl.viewCoeOriginalSigBtn1(\'' + data + '\');"> <i class="fa fa-lg fa-eye"></i> <span>View</span> </a>';
            }

            vm.coeData = {
                coe_code:'',
                request_type:'ORIGINAL SIGNATURE',
                is_fulfiller:'NO', 
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
                DTColumnBuilder.newColumn('type_desc').withTitle('Type'),
                DTColumnBuilder.newColumn('purpose_desc').withTitle('Purpose'),
                DTColumnBuilder.newColumn('is_salary_confidential01').withTitle('Salary Option'),
                DTColumnBuilder.newColumn('coe_code').withTitle('Action').renderWith(vm.render)
                .withOption('createdCell', function(cell, cellData, rowData, rowIndex, colIndex) {
                    $compile(angular.element(cell).contents())($scope);
                }), 
            ];

            vm.coeData = {
                coe_code:'',
                request_type:'ORIGINAL SIGNATURE',
                is_fulfiller:'NO', 
                is_all_request:'NO',
                is_encrypted:'NO'
            }

            CoeSrvcs.list(vm.coeData).then (function (response) {
                
                if(response.data.status == 200)
                {
                    vm.coe = response.data.data;
                    console.log(vm.coe)
                    console.log(response.data)
                }
            }, function (){ alert('Bad Request!!!') })


            if($stateParams.coe_code){ 
                 
                $uibModal.open({
                    templateUrl: 'view-status-modal',
                    controller: 'OriginalSignatureStatusInstanceCertCtrl',
                    controllerAs: 'OriginalSignatureStatusCtrl',
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
            
            vm.selectCoeType = function(type_code){
                
                PurposesSrvcs.list({purpose_code:'', type_code:type_code, request_type:"ORIGINAL SIGNATURE"}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        if(type_code=="TYP-001"){
                            vm.is_salary_option = 1;
                        }else{
                            vm.is_salary_option = 0;
                        }
                        
                        vm.purposes = response.data.data;
                        console.log(vm.purposes)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.createCoeBtn = function(data){
                
                data['is_self_service'] = 0;
                CoeSrvcs.store(data).then(function(response){
                    if (response.data.status == 200) {
                        sweetAlert.swal("Success!", "", "success");
                        $state.reload();
                    }
                    else {
                        sweetAlert.swal(response.data.type+"!", response.data.message, response.data.type);
                    }
                });
            }
            
            vm.printCoeOriginalSigBtn = function(coeCode){
                alert(coeCode)
                CoeSrvcs.getEncrypted({coe_code:coeCode}).then (function (response) {
                    if(response.data.status == 200){
                        vm.routeTo("original-signature/print/"+response.data.data)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.viewCoeOriginalSigBtn = function(coeCode){
                CoeSrvcs.getEncrypted({coe_code:coeCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.routeTo("coe-details/"+response.data.data)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.viewCoeOriginalSigBtn1 = function(coeCode){
                
                CoeSrvcs.getEncrypted({coe_code:coeCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.routeTo("original-signature/details/"+response.data.data)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.routeTo = function(route){ 
                $window.location.href = route;
            };

        }
  
        OriginalSignatureStatusInstanceCertCtrl.$inject = ['collection', 'CoeSrvcs', 'StatusItemsSrvcs', '$stateParams', '$state', '$uibModalInstance', '$window'];
        function OriginalSignatureStatusInstanceCertCtrl (collection, CoeSrvcs, StatusItemsSrvcs, $stateParams, $state, $uibModalInstance, $window) {

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
  
            vm.routeTo = function(route){
                $window.location.href = route;
            };

            vm.close = function() {
                $uibModalInstance.close();
            };
        }

})();