(function(){
    'use strict';
    angular
        .module('coeApp')
        .controller('OtpCtrl', OtpCtrl)

        OtpCtrl.$inject = ['OtpSrvcs', '$state', '$stateParams', '$uibModal', '$window', '$timeout', 'SweetAlert'];
        function OtpCtrl(OtpSrvcs, $state, $stateParams, $uibModal, $window, $timeout, sweetAlert){
            var vm = this;
            var data = {};

            vm.myCallbackFunction = function() {
                $timeout(function() {
                    // sweetAlert.swal("Click on either the button or outside the modal.",'','')
                    // .then((value) => {
                    //     vm.routeTo("/online-coe-dev/logout"); 
                    // });
                    // sweetAlert.swal("Your One Time Passcode has expired!111", '', "error");
                    alert('Your One Time Passcode has expired!')
                    vm.routeTo("/online-coe-dev/logout"); 
                });
            }
 

            OtpSrvcs.getRemainingTime().then (function (response) {
                
                if(response.data.status == 200)
                {
                    vm.remaining_time = response.data.data.remaining_time; 

                    if(vm.remaining_time<0){
 
                        alert('Your One Time Passcode has expired!')
                        // sweetAlert.swal("Your One Time Passcode has expired!", '', "error");
                        // sweetAlert.swal("Click on either the button or outside the modal.",'','')
                        // .then((value) => {
                        //     vm.routeTo("/online-coe-dev/logout"); 
                        // });
                        vm.routeTo("/online-coe-dev/logout"); 
                    }
                }
            }, function (){ alert('Bad Request!!!') })

            vm.routeTo = function(route){
                $window.open(route, "_self");
            };
 
        }

})();