(function(){
    'use strict';
    angular
        .module('coeApp')
        .controller('CoeCtrl', CoeCtrl) 
        // .controller('CoeViewModalInsatanceCtrl', CoeViewModalInsatanceCtrl) 
        
        CoeCtrl.$inject = ['CoeSrvcs', 'PurposesSrvcs', 'TypesSrvcs', 'StatusItemsSrvcs', '$scope', '$state', '$stateParams', '$uibModal', '$window', '$http', '$timeout', '$compile', 'DTOptionsBuilder', 'DTColumnBuilder', 'SweetAlert'];
        function CoeCtrl(CoeSrvcs, PurposesSrvcs, TypesSrvcs, StatusItemsSrvcs, $scope, $state, $stateParams, $uibModal, $window, $http, $timeout, $compile, DTOptionsBuilder, DTColumnBuilder, sweetAlert){
            var vm = this;
            var data = {};  

            vm.is_salary_option = 1;
            vm.is_hide = 0;
            
            vm.salary_options = [
                {id:0, text:"SHOW SALARY"},
                {id:1, text:"CONFIDENTIAL"}
            ];
            
            vm.render = function(data) {
                return ' <a href="#" title="Print Preview" ng-click="CoeCtrl.printCoeBtn(\'' + data + '\');"> <i class="fa fa-lg fa-print"></i> <span>Print</span></a> ';
            }

            vm.coeData = {
                coe_code:'',
                request_type:'SELF SERVICE',
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
                // DTColumnBuilder.newColumn('name').withTitle('Name'),
                // DTColumnBuilder.newColumn('created_at').withTitle('Created at'),
                DTColumnBuilder.newColumn('coe_code').withTitle('Reference'),
                DTColumnBuilder.newColumn('type_desc').withTitle('Type'),
                DTColumnBuilder.newColumn('purpose_desc').withTitle('Purpose'),
                DTColumnBuilder.newColumn('is_salary_confidential01').withTitle('Salary Option'),
                DTColumnBuilder.newColumn('coe_code').withTitle('Action').renderWith(vm.render)
                .withOption('createdCell', function(cell, cellData, rowData, rowIndex, colIndex) {
                    $compile(angular.element(cell).contents())($scope);
                }), 
            ];

            TypesSrvcs.list({type_code:'', is_self_service:'YES'}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.coeTypes = response.data.data;
                    console.log(vm.coeTypes)
                }
            }, function (){ alert('Bad Request!!!') })
 
            if($stateParams.coe_code){

                vm.coeData = {
                    coe_code:$stateParams.coe_code,
                    request_type:'SELF SERVICE',
                    is_fulfiller:'NO', 
                    is_all_request:'NO',
                    is_encrypted:'NO'
                }
                
                CoeSrvcs.list(vm.coeData).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.coe = response.data.data[0];

                        $uibModal.open({
                            templateUrl: 'coe-view-modal',
                            controller: 'CoeViewModalInsatanceCtrl',
                            controllerAs: 'coeCtrl',
                            backdrop: 'static',
                            keyboard  : false,
                            resolve :{
                                collection: function () {
                                    return {
                                        data: vm.coe
                                    };
                                }
                            },
                            size: 'lg'
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }
            
            vm.selectCoeType = function(type_code){ 

                PurposesSrvcs.list({purpose_code:'', type_code:type_code, request_type:"SELF SERVICE"}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        if(type_code=="TYP-001"){
                            vm.is_salary_option = 1; 
                        }else{
                            vm.is_salary_option = 0 
                        }
                        
                        vm.purposes = response.data.data;
                        console.log(vm.purposes)
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.createCoeBtn = function(data){
            
                data['is_self_service'] = 1;

                 CoeSrvcs.store(data).then(function(response){
                    if (response.data.status == 200) {
                        sweetAlert.swal("Success!", "You may now view and print your COE!", "success");
                        $state.reload();
                    }
                    else {
                        sweetAlert.swal(response.data.type+"!", response.data.message, response.data.type);
                    }
                    console.log(response.data);
                });

            }
 

            vm.createCoeOriginalSignatureBtn = function(data){
                console.log(data);

                data['is_self_service'] = 0;

                CoeSrvcs.store(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);

                        vm.coeData = {
                            coe_code:'',
                            request_type:'SELF SERVICE',
                            is_fulfiller:'NO', 
                            is_all_request:'NO',
                            is_encrypted:'NO'
                        }

                        CoeSrvcs.list(vm.coeData).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.coe = response.data.data;
                                console.log(vm.coe)
                            }
                        }, function (){ alert('Bad Request!!!') })

                        vm.coeDetails.coe_type = '';
                        vm.coeDetails.coe_purpose = '';
                        vm.coeDetails.salary_option = '';

                        TypesSrvcs.list({type_code:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.coeTypes = response.data.data;
                                console.log(vm.coeTypes)
                            }
                        }, function (){ alert('Bad Request!!!') })

                        PurposesSrvcs.list({purpose_code:'10000', type_code:'10000'}).then (function (response) {
                            if(response.data.status == 200)
                            { 
                                vm.purposes = response.data.data;
                                console.log(vm.purposes)
                            }
                        }, function (){ alert('Bad Request!!!') })

                        vm.salary_options = [
                            {id:0, text:"SHOW SALARY"},
                            {id:1, text:"CONFIDENTIAL"}
                        ];

                    }
                    else {
                        alert(response.data.message);
                    }
                    console.log(response.data);
                });
            }

            vm.printCoeBtn = function(coeCode){
                CoeSrvcs.getEncrypted({coe_code:coeCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.routeTo("print/coe/"+response.data.data)
                    }
                }, function (){ alert('Bad Request!!!') })
            }
 
            vm.routeTo = function(route){
                $window.open(route, '_blank');
            };
        }

        // CoeViewModalInsatanceCtrl.$inject = ['collection', 'CoeSrvcs', '$state', '$uibModalInstance', '$window'];
        // function CoeViewModalInsatanceCtrl (collection, CoeSrvcs, $state, $uibModalInstance, $window) {

        //     var vm = this;
        //     vm.collection = collection.data;
        //     console.log(vm.collection['coe_code']) 
            
       
        //     CoeSrvcs.load({coe_code:vm.collection['coe_code']}).then(function(response){
        //         if (response.data.status == 200) {
        //             alert('Successfully loaded!');
        //         }
        //         else {
        //             alert(response.data.message);
        //         }
        //         console.log(response.data);
        //     });
         
        //     vm.routeTo = function(route){
        //         $window.location.href = route;
        //     };

        //     vm.close = function() {
        //         $uibModalInstance.close();
        //     };
        // }

})();