(function(){
    'use strict';
    angular
        .module('coeApp')
        .controller('CoeDetailsCtrl', CoeDetailsCtrl)
        .controller('CoeDetailsAdminCtrl', CoeDetailsAdminCtrl)

        CoeDetailsAdminCtrl.$inject = ['CoeSrvcs', 'PurposesSrvcs', 'TypesSrvcs', '$state', 'StatusItemsSrvcs', '$stateParams', '$uibModal', '$window', '$http', '$timeout'];
        function CoeDetailsAdminCtrl(CoeSrvcs, PurposesSrvcs, TypesSrvcs, $state, StatusItemsSrvcs, $stateParams, $uibModal, $window, $http, $timeout){
            var vm = this;
            var data = {};
            
            vm.coeData = {
                coe_code:$stateParams.id,
                request_type:'ORIGINAL SIGNATURE',
                is_fulfiller:'YES', 
                is_all_request:'YES',
                is_encrypted:'YES'
            }

            vm.reply_statuses = [
                {code: 'STAT0002', desc:'Work in progress'},
                {code: 'STAT0003', desc:'Completed the request'},
                {code: 'STAT0005', desc:'Cancelled the request'}
            ];
            
            CoeSrvcs.list(vm.coeData).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.coe = response.data.data[0];
                    console.log(vm.coe)

                }
            }, function (){ alert('Bad Request!!!') })
            
            vm.statusItemDetails = {
                status_item_code:'',
                status_code:'',
                coe_code:$stateParams.id,
                user_type:'',
                user_type_id:'',
            }

            StatusItemsSrvcs.list(vm.statusItemDetails).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.status_items = response.data.data;
                    console.log(vm.status_items)
                }
            }, function (){ alert('Bad Request!!!') })

            StatusItemsSrvcs.list(vm.statusItemDetails).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.status_item = response.data.data[0];
                    console.log(vm.status_item)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.updateCoeOriginalSigBtn = function(data){
                console.log(data)
                data['user_type'] = 'FULFILLER';
                console.log(data)
                StatusItemsSrvcs.store(data).then (function (response) {
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                        vm.statusItemDetails = {
                            status_item_code:'',
                            status_code:'',
                            coe_code:$stateParams.id,
                            user_type:'',
                            user_type_id:'',
                        }
            
                        StatusItemsSrvcs.list(vm.statusItemDetails).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.status_items = response.data.data;
                                console.log(vm.status_items)
                            }
                        }, function (){ alert('Bad Request!!!') })

                        StatusItemsSrvcs.list(vm.statusItemDetails).then (function (response) {
                            if(response.data.status == 200)
                            {
                                vm.status_item = response.data.data[0];
                                console.log(vm.status_item)
                            }
                        }, function (){ alert('Bad Request!!!') })

                        
                    }
                }, function (){ alert('Bad Request!!!') })
            }  
        }

        CoeDetailsCtrl.$inject = ['CoeSrvcs', 'PurposesSrvcs', 'TypesSrvcs', '$state', 'StatusItemsSrvcs', '$stateParams', '$uibModal', '$window', '$http', '$timeout'];
        function CoeDetailsCtrl(CoeSrvcs, PurposesSrvcs, TypesSrvcs, $state, StatusItemsSrvcs, $stateParams, $uibModal, $window, $http, $timeout){
            var vm = this;
            var data = {};
            
            vm.coeData = {
                coe_code:$stateParams.id,
                request_type:'ORIGINAL SIGNATURE',
                is_fulfiller:'NO', 
                is_all_request:'NO',
                is_encrypted:'YES'
            }
            
            CoeSrvcs.list(vm.coeData).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.coe = response.data.data[0];
                    console.log(vm.coe)

                }
            }, function (){ alert('Bad Request!!!') })

            vm.statusItemDetails = {
                status_item_code:'',
                status_code:'',
                coe_code:$stateParams.id,
                user_type:'',
                user_type_id:'',
            }

            vm.reply_statuses = [ 
                {code: 'STAT0004', desc:'Closed the request'},
                {code: 'STAT0006', desc:'Cancelled the request'}
            ];
            

            StatusItemsSrvcs.list(vm.statusItemDetails).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.status_items = response.data.data;
                    console.log(vm.status_items)

                }
            }, function (){ alert('Bad Request!!!') })

            StatusItemsSrvcs.list(vm.statusItemDetails).then (function (response) {
                if(response.data.status == 200)
                {
                    vm.status_item = response.data.data[0];
                    console.log(vm.status_item)
                }
            }, function (){ alert('Bad Request!!!') })

            vm.updateCoeOriginalSigBtn = function(data){
                data['FULFILLER'] = 'EMPLOYEE';
                StatusItemsSrvcs.store(data).then (function (response) {
                    if(response.data.status == 200)
                    {
                        alert(response.data.message);
                    }
                }, function (){ alert('Bad Request!!!') })
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
 

})();