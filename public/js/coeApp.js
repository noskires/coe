(function(){
    'use strict';
    angular
        .module('coeApp',[
          'ui.router',
          'ngSanitize',
          'ui.bootstrap',
          'datatables',
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

            // dynamicNumberStrategyProvider.addStrategy('price', {
            //     numInt: 12,
            //     numFract: 2,
            //     numSep: '.',
            //     numPos: true,
            //     numNeg: true,
            //     numRound: 'round',
            //     numThousand: true
            // });
            
            $stateProvider
            .state('main-view', main)

            //-- COE --//
            
            .state('selfservice', {
                url: '/self-service',
                controller: 'CoeCtrl as CoeCtrl',
                templateUrl: 'selfservice.view'
            })

            .state('index', {
                url: '/self-service/:id',
                controller: 'CoeCtrl as coeCtrl',
                templateUrl: 'coe.view'
            })
            
            .state('original-signature', {
                url: '/original-signature/:id',
                controller: 'OriginalSignatureCertCtrl as coeCtrl',
                templateUrl: 'coe.view'
            })

            .state('assigned-to-me', {
                url: '/assigned-to-me/:id',
                controller: 'FulfillerCtrl as coeCtrl',
                templateUrl: 'fulfiller.view'
            })

            .state('all-request', {
                url: '/all-request/:id',
                controller: 'AllRequestCtrl as coeCtrl',
                templateUrl: 'fulfiller.view'
            })

            .state('walk-in', {
                url: '/walk-in/:id',
                controller: 'WalkinCtrl as coeCtrl',
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
                controller: 'TypesCtrl as typeCtrl',
                templateUrl: 'type.view'
            }) 
            .state('type-edit', {
                url: '/type/:type_code_edit/edit',
                controller: 'TypesCtrl as typeCtrl',
                templateUrl: 'type.view'
            })
            .state('type-delete', {
                url: '/type/:type_code_delete/delete',
                controller: 'TypesCtrl as typeCtrl',
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

        MainCtrl.$inject = ['$window','$http'];
        function MainCtrl($window, $http) {
            var vm = this; 
            vm.routeTo = function(route){
                $window.location.href = route;
            };
        };


        
})();


 