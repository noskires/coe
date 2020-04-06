(function(){
    'use strict';
    angular
        .module('coeApp')
        .controller('RolesCtrl', RolesCtrl)  

        RolesCtrl.$inject = ['RolesSrvcs', 'PermissionsSrvcs', '$state', '$stateParams', '$uibModal', '$window', 'SweetAlert'];
        function RolesCtrl(RolesSrvcs, PermissionsSrvcs, $state, $stateParams, $uibModal, $window, sweetAlert){
            var vm = this;
            var data = {};

            RolesSrvcs.list({id:'',name:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.roles = response.data.data;
                    console.log(vm.roles)
                }
            }, function (){ alert('Bad Request!!!') })

            PermissionsSrvcs.list({id:'',name:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.permissions = response.data.data;
                    console.log(vm.permissions)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.assignPermissionToRoleBtn = function(data){
                console.log(data); 
                RolesSrvcs.store(data).then(function(response){
                    if (response.data.status == 200) {
                        sweetAlert.swal("Success!", "New permission has been created!", "success");
                        $state.reload();
                    }
                    else {
                        sweetAlert.swal("Error!", "Bad request!", "error");
                    }
                });
            }

            vm.revokePermissionBtn = function(permission_id, role_id){

                data['permission_id'] = permission_id;
                data['role_id'] = role_id;

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
                        RolesSrvcs.remove(data).then(function(response){

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