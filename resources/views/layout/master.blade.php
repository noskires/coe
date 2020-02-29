<!doctype html>
<html class="no-js" lang="en" ng-app="coeApp">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>COE</title>
    @include('layout.styles')
    <base href="/">
</head>
<body>

    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->

    <!-- page container area start -->

    
    <div class="page-container">
        
        @include('layout.sidemenu')
        
        <!-- main content area start -->
        <div class="main-content home-bg">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav button -->
                    <div class="col-md-6 col-sm-8 ">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div> <h4 class="page-title-main pull-left">Certificate of Employment</h4> </div>
                    </div>
                    <!-- logout -->
                    <div class="col-md-6 col-sm-4 ">
                        <ul class="notification-area pull-right">
                            <li class="settings-btn">
                                <i class="ti-power-off"></i>
                            </li>
                        </ul>
                        <div> <h4 class="page-user pull-right">Hi, Erikson</h4> </div>
                    </div>
                </div>
            </div>
            <!-- header area end --> 

            @yield('content')

            <div ui-view></div>

            <!-- footer area start-->
            <footer>
                <div class="footer-area">
                    <p>© Copyright 2020.</p>
                </div>
            </footer>
            <!-- footer area end-->
        </div>
    </div>



@include('layout.scripts')

</body>
</html>

