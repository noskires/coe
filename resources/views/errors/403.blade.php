<!doctype html>
<html class="no-js" lang="en" ng-app="coeApp">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>403 Forbidden</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('layouts.styles') 
    @if(Config::get('defaults.default.environment')==0)
    <base href="/online-coe-dev/">
    @else
    <base href="/online-coe/">
    @endif
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- error area start -->
    <div class="error-area ptb--100 text-center" ng-controller="MainCtrl as MainCtrl">
        <div class="container">
            <div class="error-content">
                <h2>403</h2>
                <p>Access to this resource on the server is denied</p>
                <a href="#" ng-click="MainCtrl.menu('self-service')">Back to Home</a>
            </div>
        </div>
    </div>
    <!-- error area end -->

    <!-- jquery latest version -->
    @include('layouts.scripts')
</body>

</html>