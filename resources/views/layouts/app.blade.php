<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login-COE</title>
    @include('layouts.styles')
 
    <base href="/online-coe-dev/">
     
     
</head>

<body>
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    
    @yield('content')

    @include('layouts.scripts')
</body>

</html>