(function(){
    'use strict';
    angular
        .module('coeApp')
        .controller('AdminsCtrl', AdminsCtrl)  

        AdminsCtrl.$inject = ['AdminsSrvcs', 'TypesSrvcs', '$state', '$stateParams', '$uibModal', '$window', 'SweetAlert', '$timeout'];
        function AdminsCtrl(AdminsSrvcs, TypesSrvcs, $state, $stateParams, $uibModal, $window, sweetAlert, $timeout){
            var vm = this;
            var data = {}; 
 
            AdminsSrvcs.list({admin_code:''}).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.admins = response.data.data;
                    console.log(vm.admins)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.assignAsAdminBtn = function(data){
                data['employee_code'] = angular.element('.select2-selection__rendered').attr('addressee_code');
                console.log(data);

                AdminsSrvcs.store(data).then(function(response){

                    console.log(response.data)
                    if (response.data.status == 200) {
                        sweetAlert.swal("Success!", "New user has been assigned as admin!", "success");
                        $state.reload();
                    }
                    else {
                        sweetAlert.swal("Error!", "Bad request!", "error");
                    }
                });
            }

            vm.revokeAsAdminBtn = function(id, role){
                // alert('revoke');

                data['id'] = id;
                data['role'] = role;
                
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
                        AdminsSrvcs.remove(data).then(function(response){

                            console.log(response.data)
                            if (response.data.status == 200) {
                                sweetAlert.swal("Deleted!", "User has been revoked as admin!", "success");
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