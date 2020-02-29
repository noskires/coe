(function(){
    'use strict';
    angular
        .module('coeApp')
        .controller('TypesCtrl', TypesCtrl) 
        .controller('TypeEditModalInsatanceCtrl', TypeEditModalInsatanceCtrl) 
        .controller('TypeDeleteModalInsatanceCtrl', TypeDeleteModalInsatanceCtrl) 

        TypesCtrl.$inject = ['TypesSrvcs', '$state', '$stateParams', '$uibModal', '$window'];
        function TypesCtrl(TypesSrvcs, $state, $stateParams, $uibModal, $window){
            var vm = this;
            var data = {};
         
            TypesSrvcs.list({type_code:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.types = response.data.data;
                    console.log(vm.types)
                }
            }, function (){ alert('Bad Request!!!') })

            if($stateParams.type_code_edit){
                // alert($stateParams.type_code_edit)
                vm.typeData = {
                    type_code:$stateParams.type_code_edit
                }
                
                TypesSrvcs.list(vm.typeData).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.type = response.data.data[0];

                        $uibModal.open({
                            templateUrl: 'edit-type-modal',
                            controller: 'TypeEditModalInsatanceCtrl',
                            controllerAs: 'typeCtrl',
                            backdrop: 'static',
                            keyboard  : false,
                            resolve :{
                                collection: function () {
                                    return {
                                        data: vm.type
                                    };
                                }
                            },
                            size: 'lg'
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            if($stateParams.type_code_delete){

                vm.typeData = {
                    type_code:$stateParams.type_code_delete
                }
                
                TypesSrvcs.list(vm.typeData).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.type = response.data.data[0];

                        $uibModal.open({
                            templateUrl: 'delete-type-modal',
                            controller: 'TypeDeleteModalInsatanceCtrl',
                            controllerAs: 'typeCtrl',
                            backdrop: 'static',
                            keyboard  : false,
                            resolve :{
                                collection: function () {
                                    return {
                                        data: vm.type
                                    };
                                }
                            },
                            size: 'lg'
                        });
                    }
                }, function (){ alert('Bad Request!!!') })
            }

            vm.createTypeBtn = function(data){
                console.log(data);

                TypesSrvcs.store(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);

                        TypesSrvcs.list({type_code:''}).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.types = response.data.data;
                                console.log(vm.types)
                            }
                        }, function (){ alert('Bad Request!!!') })
                    }
                    else {
                        alert(response.data.message);
                    }
                    console.log(response.data);
                });
            }
        }


        TypeEditModalInsatanceCtrl.$inject = ['collection', 'TypesSrvcs', '$state', '$uibModalInstance', '$window'];
        function TypeEditModalInsatanceCtrl (collection, TypesSrvcs, $state, $uibModalInstance, $window) {

            var vm = this;
            vm.collection = collection.data;
            console.log(vm.collection)
            
            vm.updateTypeBtn = function(data){
                console.log(data);
                TypesSrvcs.update(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        $state.go('types');
                        $uibModalInstance.close();
                    }
                    else {
                        alert(response.data.message);
                    }
                    console.log(response.data);
                });
            };

            vm.routeTo = function(route){
                $window.location.href = route;
            };

            vm.close = function() {
                $uibModalInstance.close();
            };
        }

        TypeDeleteModalInsatanceCtrl.$inject = ['collection', 'TypesSrvcs', '$state', '$uibModalInstance', '$window'];
        function TypeDeleteModalInsatanceCtrl (collection, TypesSrvcs, $state, $uibModalInstance, $window) {

            var vm = this;
            vm.collection = collection.data;
            console.log(vm.collection)

            vm.deleteTypeBtn = function(data){
                console.log(data);
                TypesSrvcs.remove(data).then(function(response){
                    if (response.data.status == 200) {
                        alert(response.data.message);
                        $state.go('types');
                        $uibModalInstance.close();
                    }
                    else {
                        alert(response.data.message);
                    }
                    console.log(response.data);
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