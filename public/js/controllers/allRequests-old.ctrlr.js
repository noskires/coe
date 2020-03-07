(function(){
    'use strict';
    angular
        .module('coeApp')
        .controller('AllRequestCtrl', AllRequestCtrl)   

        AllRequestCtrl.$inject = ['CoeSrvcs', 'PurposesSrvcs', 'TypesSrvcs', '$state', '$stateParams', '$uibModal', '$window', '$http', '$timeout'];
        function AllRequestCtrl(CoeSrvcs, PurposesSrvcs, TypesSrvcs, $state, $stateParams, $uibModal, $window, $http, $timeout){
            var vm = this;
            var data = {}; 
            vm.is_salary_option_disable = 0;
 
            vm.coeData = {
                coe_code:'', 
                request_type:'ORIGINAL SIGNATURE',
                is_fulfiller:'YES', 
                is_all_request:'YES',
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
            
            vm.printCoeOriginalSigBtn = function(coeCode){
                CoeSrvcs.getEncrypted({coe_code:coeCode}).then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.routeTo("original-signature/print/"+response.data.data)
                    }
                }, function (){ alert('Bad Request!!!') })
            }
 
            vm.routeTo = function(route){
                $window.open(route, '_blank');
            };

        }

})();