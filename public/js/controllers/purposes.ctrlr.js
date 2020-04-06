(function(){
    'use strict';
    angular
        .module('coeApp')
        .controller('PurposesCtrl', PurposesCtrl) 
        .controller('PurposeEditModalInsatanceCtrl', PurposeEditModalInsatanceCtrl) 
        .controller('PurposeDeleteModalInsatanceCtrl', PurposeDeleteModalInsatanceCtrl) 

        PurposesCtrl.$inject = ['PurposesSrvcs', 'TypesSrvcs', '$state', '$stateParams', '$uibModal', '$window', 'SweetAlert'];
        function PurposesCtrl(PurposesSrvcs, TypesSrvcs, $state, $stateParams, $uibModal, $window, sweetAlert){
            var vm = this;
            var data = {};
 
            PurposesSrvcs.list({purpose_code:'', type_code:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.purposes = response.data.data;
                    console.log(vm.purposes)
                }
            }, function (){ alert('Bad Request!!!') })

            TypesSrvcs.list({type_code:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.coeTypes = response.data.data; 
                }
            }, function (){ alert('Bad Request!!!') })

            if($stateParams.purpose_code_edit){

                vm.purposeData = {
                    purpose_code:$stateParams.purpose_code_edit,
                    type_code:''
                }
                
                PurposesSrvcs.list(vm.purposeData).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.purpose = response.data.data[0];

                        $uibModal.open({
                            templateUrl: 'edit-purpose-modal',
                            controller: 'PurposeEditModalInsatanceCtrl',
                            controllerAs: 'purposeCtrl',
                            backdrop: 'static',
                            
                            keyboard  : false,
                            resolve :{
                                collection: function () {
                                    return {
                                        data: vm.purpose
                                    };
                                }
                            }, 

                            size: 'lg'
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

        

            if($stateParams.purpose_code_delete){

                vm.purposeData = {
                    purpose_code:$stateParams.purpose_code_delete,
                    type_code:''
                }
                
                PurposesSrvcs.list(vm.purposeData).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.purpose = response.data.data[0];

                        $uibModal.open({
                            templateUrl: 'delete-purpose-modal',
                            controller: 'PurposeDeleteModalInsatanceCtrl',
                            controllerAs: 'purposeCtrl',
                            backdrop: 'static',
                            keyboard  : false,
                            resolve :{
                                collection: function () {
                                    return {
                                        data: vm.purpose
                                    };
                                }
                            },
                            size: 'lg'
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.createPurposeBtn = function(data){

                PurposesSrvcs.store(data).then(function(response){
                    if (response.data.status == 200) {
                        sweetAlert.swal("Success!", "New purpose has successfully created!", "success");
                        $state.reload();
                    }
                    else {
                        sweetAlert.swal(response.data.type+"!", response.data.message, response.data.type);
                    }
                });
            }
        }


        PurposeEditModalInsatanceCtrl.$inject = ['collection', 'PurposesSrvcs', '$state', '$uibModalInstance', '$window', 'SweetAlert'];
        function PurposeEditModalInsatanceCtrl (collection, PurposesSrvcs, $state, $uibModalInstance, $window, sweetAlert) {

            var vm = this;
            vm.collection = collection.data; 
 

            vm.updatePurposeBtn = function(data){ 
                PurposesSrvcs.update(data).then(function(response){
                    // if (response.data.status == 200) {
                    //     alert(response.data.message);
                    //     $state.go('purposes');
                    //     $uibModalInstance.close();
                    // }
                    // else {
                    //     alert(response.data.message);
                    // } 

                    console.log(response.data)
                    if (response.data.status == 200) {
                        sweetAlert.swal("Success!", "Successfully updated!", "success");
                        $state.reload();
                        $state.go('purposes');
                        $uibModalInstance.close();
                    }
                    else {
                        sweetAlert.swal(response.data.type+"!", response.data.message, response.data.type);
                    }
                });
            };

            vm.routeTo = function(route){
                $window.location.href = route;
            };

            vm.close = function() { 
                $uibModalInstance.close('testParameter');
            };
        }

        PurposeDeleteModalInsatanceCtrl.$inject = ['collection', 'PurposesSrvcs', '$state', '$uibModalInstance', '$window'];
        function PurposeDeleteModalInsatanceCtrl (collection, PurposesSrvcs, $state, $uibModalInstance, $window) {

            var vm = this;
            vm.collection = collection.data; 

            vm.deletePurposeBtn = function(data){ 
                PurposesSrvcs.remove(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        $state.go('purposes');
                        $uibModalInstance.close();
                    }
                    else {
                        alert(response.data.message);
                    } 
                });
            };

            vm.routeTo = function(route){
                $window.location.href = route;
            };

            vm.close = function() {
                $uibModalInstance.close();
            };
        }

})();