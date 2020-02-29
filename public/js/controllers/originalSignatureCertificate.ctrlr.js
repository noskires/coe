(function(){
    'use strict';
    angular
        .module('coeApp')
        .controller('OriginalSignatureCertCtrl', OriginalSignatureCertCtrl) 
        .controller('OriginalSignatureCertViewModalInsatanceCtrl', OriginalSignatureCertViewModalInsatanceCtrl) 

        OriginalSignatureCertCtrl.$inject = ['CoeSrvcs', 'PurposesSrvcs', 'TypesSrvcs', '$state', '$stateParams', '$uibModal', '$window', '$http', '$timeout'];
        function OriginalSignatureCertCtrl(CoeSrvcs, PurposesSrvcs, TypesSrvcs, $state, $stateParams, $uibModal, $window, $http, $timeout){
            var vm = this;
            var data = {}; 
            vm.is_salary_option = 1;
 

            TypesSrvcs.list({type_code:'', is_self_service:'NO'}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.coeTypes = response.data.data;
                    console.log(vm.coeTypes)
                }
            }, function (){ alert('Bad Request!!!') })
            
            vm.salary_options = [
                {id:0, text:"SHOW SALARY"},
                {id:1, text:"CONFIDENTIAL"}
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
 
                vm.coeData = {
                    coe_code:$stateParams.coe_code, 
                    request_type:'ORIGINAL SIGNATURE',
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
                            controller: 'OriginalSignatureCertViewModalInsatanceCtrl',
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

                console.log(data);

                CoeSrvcs.store(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);

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
                            }
                        }, function (){ alert('Bad Request!!!') })

                        vm.is_salary_option = 1;
                        vm.coeDetails.coe_type = '';
                        vm.coeDetails.coe_purpose = '';
                        vm.coeDetails.salary_option = '';

                        TypesSrvcs.list({type_code:'', is_self_service:'NO'}).then (function (response) {
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
            
            vm.printCoeOriginalSigBtn = function(coeCode){
                CoeSrvcs.getEncrypted({coe_code:coeCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
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

            vm.routeTo = function(route){
                $window.open(route, '_blank');
            };

        }

        OriginalSignatureCertViewModalInsatanceCtrl.$inject = ['collection', 'CoeSrvcs', '$state', '$uibModalInstance', '$window'];
        function OriginalSignatureCertViewModalInsatanceCtrl (collection, CoeSrvcs, $state, $uibModalInstance, $window) {

            var vm = this;
            vm.collection = collection.data;
            console.log(vm.collection['coe_code'])
            
       
            CoeSrvcs.load({coe_code:vm.collection['coe_code']}).then(function(response){
                if (response.data.status == 200) {
                    alert('Successfully loaded!');
                }
                else {
                    alert(response.data.message);
                }
                console.log(response.data);
            });
         

            vm.routeTo = function(route){
                $window.location.href = route;
            };

            vm.close = function() {
                $uibModalInstance.close();
            };
        }

})();