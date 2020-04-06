<!doctype html>
<html class="no-js" lang="en" ng-app="coeApp">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>500 Error</title>
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
    <div class="error-area ptb--100 text-center" ng-controller="MainCtrl as MainCtrl">
        <div class="container">
            <div class="error-content">
                <h2>500</h2>
                <p>Internal Server Error!</p>
                <a href="#" ng-click="MainCtrl.menu('self-service')">Back to Home</a>
            </div>
        </div>
    </div>
    @include('layouts.scripts')
</body>

</html>