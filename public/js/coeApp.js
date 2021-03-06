(function(){
    'use strict';
    angular
        .module('coeApp',[
          'ui.router',
          'ngSanitize',
          'ui.bootstrap',
          'datatables',
          'oitozero.ngSweetAlert',
          'timer',
          'rt.select2',
        ])
        .config(Config)
        .controller('MainCtrl', MainCtrl)

        Config.$inject = ['$stateProvider', '$urlRouterProvider', '$locationProvider', '$controllerProvider', '$compileProvider', '$filterProvider', '$provide', '$interpolateProvider'];
        function Config($stateProvider, $urlRouterProvider, $locationProvider, $controllerProvider, $compileProvider, $filterProvider, $provide, $interpolateProvider){
            console.log("App here!");
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
            
            $locationProvider.html5Mode(true); 
            
          

            var main = {
                url: '/id/:id',
                controller: 'CoeCtrl as coeCtrl',
                templateUrl: 'coe.view'
            };
 
            $stateProvider
            .state('main-view', main)

            //-- COE --//
            // .state('selfservice', {
            //     url: '/self-service',
            //     controller: 'CoeCtrl as CoeCtrl',
            //     templateUrl: 'selfservice.view'
            // })

            // .state('originalsignature', {
            //     url: '/orig-sig',
            //     controller: 'CoeCtrl as CoeCtrl',
            //     templateUrl: 'originalsignature.view'
            // })

            .state('admins', {
                url: '/admins',
                controller: 'AdminsCtrl as AdminsCtrl',
                templateUrl: 'admin.view'
            })

            .state('roles', {
                url: '/roles',
                controller: 'RolesCtrl as RolesCtrl',
                templateUrl: 'role.view'
            })

            .state('permissions', {
                url: '/permissions',
                controller: 'PermissionsCtrl as PermissionsCtrl',
                templateUrl: 'permission.view'
            })

            .state('user', {
                url: '/user',
                controller: 'CoeCtrl as CoeCtrl',
                templateUrl: 'user.view'
            })

            .state('index', {
                url: '/self-service/:id',
                controller: 'CoeCtrl as CoeCtrl',
                templateUrl: 'selfservice.view'
            })
            
            .state('original-signature', {
                url: '/original-signature/:id',
                controller: 'OriginalSignatureCertCtrl as OriginalSignatureCertCtrl',
                templateUrl: 'originalsignature.view'
            })

            .state('original-signature-details', {
                url: '/original-signature/details/:coe_code',
                controller: 'OriginalSignatureCertCtrl as OriginalSignatureCertCtrl',
                templateUrl: 'originalsignature.view'
            })

            .state('assigned-to-me', {
                url: '/assigned-to-me/:id',
                controller: 'AssignedToMeCtrl as AssignedToMeCtrl',
                templateUrl: 'fulfiller_assigned_to_me.view'
            })

            .state('assigned-to-me-details', {
                url: '/assigned-to-me/details/:coe_code',
                controller: 'AssignedToMeCtrl as AssignedToMeCtrl',
                templateUrl: 'fulfiller_assigned_to_me.view'
            })
 
            .state('all-request', {
                url: '/all-request/:id',
                controller: 'AllRequestCtrl as AllRequestCtrl',
                templateUrl: 'fulfiller_all_request.view'
            })

            .state('walk-in', {
                url: '/walk-in/:id',
                controller: 'WalkinCtrl as WalkinCtrl',
                templateUrl: 'walkin.view'
            })
            
            .state('coe-create', {
                url: '/coe/new',
                controller: 'CoeCtrl as coeCtrl',
                templateUrl: 'coe.view'
            })

            .state('coe-details', {
                url: '/coe-details/:id',
                controller: 'CoeDetailsCtrl as coeCtrl',
                templateUrl: 'coe.details.view'
            })

            .state('coe-details-admin', {
                url: '/coe-details-admin/:id',
                controller: 'CoeDetailsAdminCtrl as coeCtrl',
                templateUrl: 'coe.details_admin.view'
            })

            //-- documents --//

            .state('purposes', {
                url: '/purposes',
                controller: 'PurposesCtrl as purposeCtrl',
                templateUrl: 'purpose.view'
            })
            .state('purpose-edit', {
                url: '/purpose/:purpose_code_edit/edit',
                controller: 'PurposesCtrl as purposeCtrl',
                templateUrl: 'purpose.view'
            })
            .state('purpose-delete', {
                url: '/purpose/:purpose_code_delete/delete',
                controller: 'PurposesCtrl as purposeCtrl',
                templateUrl: 'purpose.view'
            })

            //-- types --//

            .state('types', {
                url: '/types',
                controller: 'TypesCtrl as TypeCtrl',
                templateUrl: 'type.view'
            }) 
            .state('type-edit', {
                url: '/type/:type_code_edit/edit',
                controller: 'TypesCtrl as TypeCtrl',
                templateUrl: 'type.view'
            })
            .state('type-delete', {
                url: '/type/:type_code_delete/delete',
                controller: 'TypesCtrl as TypeCtrl',
                templateUrl: 'type.view'
            })

            //-- otp --//

            .state('otp', {
                url: '/otp/:id',
            })
 
            //-- audits --//

            .state('audits', {
                url: '/audits',
                controller: 'AuditsCtrl as auditCtrl',
                templateUrl: 'audit.view'
            })
  
            $urlRouterProvider.otherwise('/index');

        }

        MainCtrl.$inject = ['CoeSrvcs', '$window','$http'];
        function MainCtrl(CoeSrvcs, $window, $http) {
            var vm = this; 

            vm.logout = function(){
                vm.routeTo('logout');
            }

            vm.menu = function(link){
                CoeSrvcs.encrypt().then (function (response) {
                    if(response.data.status == 200)
                    {
                        vm.routeTo(link+"/"+response.data.data)
                    }
                }, function (){ alert('Bad Request!!!') })

            }



            vm.routeTo = function(route){
                $window.location.href = route;
            };

        };
})();


 