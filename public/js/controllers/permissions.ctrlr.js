(function(){
    'use strict';
    angular
        .module('coeApp')
        .controller('PermissionsCtrl', PermissionsCtrl)

        PermissionsCtrl.$inject = ['PermissionsSrvcs', '$state', '$stateParams', '$uibModal', '$window', 'SweetAlert'];
        function PermissionsCtrl(PermissionsSrvcs, $state, $stateParams, $uibModal, $window, sweetAlert){
            var vm = this;
            var data = {};
         
            PermissionsSrvcs.list({id:'',name:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.permissions = response.data.data;
                    console.log(vm.permissions)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.createPermissionBtn = function(data){
                console.log(data); 
                PermissionsSrvcs.store(data).then(function(response){
                    if (response.data.status == 200) {
                        sweetAlert.swal("Success!", "New permission has been created!", "success");
                        $state.reload();
                    }
                    else {
                        sweetAlert.swal("Error!", "Bad request!", "error");
                    }
                });
            }

            vm.removePermissionBtn = function(id){

                data['id'] = id;

                console.log(data)
                sweetAlert.swal({
                    title: "Are you sure?",
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    closeOnConfirm: false,
                    closeOnCancel: false,
                    showLoaderOnConfirm: true           // Add this line
                }, function(isConfirm){
                    if (!isConfirm) {
                        sweetAlert.swal("Cancelled", "", "error");
                    } else {
                        PermissionsSrvcs.remove(data).then(function(response){

                            console.log(response.data)
                            if (response.data.status == 200) {
                                sweetAlert.swal("Deleted!", "Permission has been revoked!", "success");
                                $state.reload();
                            }
                            else {
                                sweetAlert.swal("Error!", "Bad request!", "error");
                            }
                        });
                    }
                });
            }
        }
})();