(function(){
    'use strict';
    angular
        .module('coeApp')
        .controller('OtpCtrl', OtpCtrl)

        OtpCtrl.$inject = ['OtpSrvcs', '$state', '$stateParams', '$uibModal', '$window', '$timeout'];
        function OtpCtrl(OtpSrvcs, $state, $stateParams, $uibModal, $window, $timeout){
            var vm = this;
            var data = {};
            
            vm.myCallbackFunction = function() {
                $timeout(function() {
                    alert('Your One Time Passcode has expired!') 
                    vm.routeTo("/online-coe/logout"); 
                });
            }

            OtpSrvcs.getRemainingTime().then (function (response) {
                if(response.data.status == 200)
                {
                    vm.remaining_time = response.data.data.remaining_time;
                    if(vm.remaining_time<0){
                        alert('Your One Time Passcode has expired!')
                        vm.routeTo("/online-coe/logout"); 
                    }
                }
            }, function (){ alert('Bad Request!!!') })

            vm.routeTo = function(route){
                $window.open(route, "_self");
            };
 
        }

})();