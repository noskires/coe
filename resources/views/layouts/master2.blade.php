<!doctype html>
<html class="no-js" lang="en" ng-app="coeApp">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>COE</title>
    @include('layouts.styles')

    @if(Config::get('defaults.default.environment')==0)
    <base href="/online-coe-dev/">
    @else
    <base href="/online-coe/">
    @endif

    <style type="text/css">
    
    .fade.in {
      opacity: 1;
    }

    .modal.in .modal-dialog {
      -webkit-transform: translate(0, 0);
      -o-transform: translate(0, 0);
      transform: translate(0, 0);
    }

    .modal-backdrop.in {
      filter: alpha(opacity=50);
      opacity: .5;
    }

    @media (min-width: 768px) {
      .modal-xlg {
        width: 90%;
        max-width:1200px;
      }
    }
    
    /* timeline */
    .timeline {
        list-style: none;
        padding: 20px 0 20px;
        position: relative;
    }
    .timeline:before {
        top: 0;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 3px;
        background-color: #eeeeee;
        left: 50%;
        margin-left: -1.5px;
    }
    .timeline > li {
        margin-bottom: 20px;
        position: relative;
    }
    .timeline > li:before,
    .timeline > li:after {
        content: " ";
        display: table;
    }
    .timeline > li:after {
        clear: both;
    }
    .timeline > li:before,
    .timeline > li:after {
        content: " ";
        display: table;
    }
    .timeline > li:after {
        clear: both;
    }
    .timeline > li > .timeline-panel {
        width: 50%;
        float: left;
        border: 1px solid #d4d4d4;
        border-radius: 2px;
        padding: 20px;
        position: relative;
        -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
        box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
    }
    .timeline > li.timeline-inverted + li:not(.timeline-inverted),
    .timeline > li:not(.timeline-inverted) + li.timeline-inverted {
    margin-top: -60px;
    }
    
    .timeline > li:not(.timeline-inverted) {
    padding-right:90px;
    }
    
    .timeline > li.timeline-inverted {
    padding-left:90px;
    }
    .timeline > li > .timeline-panel:before {
        position: absolute;
        top: 26px;
        right: -15px;
        display: inline-block;
        border-top: 15px solid transparent;
        border-left: 15px solid #ccc;
        border-right: 0 solid #ccc;
        border-bottom: 15px solid transparent;
        content: " ";
    }
    .timeline > li > .timeline-panel:after {
        position: absolute;
        top: 27px;
        right: -14px;
        display: inline-block;
        border-top: 14px solid transparent;
        border-left: 14px solid #fff;
        border-right: 0 solid #fff;
        border-bottom: 14px solid transparent;
        content: " ";
    }
    .timeline > li > .timeline-badge {
        color: #fff;
        width: 50px;
        height: 50px;
        line-height: 50px;
        font-size: 1.4em;
        text-align: center;
        position: absolute;
        top: 16px;
        left: 50%;
        margin-left: -25px;
        background-color: #999999;
        z-index: 100;
        border-top-right-radius: 50%;
        border-top-left-radius: 50%;
        border-bottom-right-radius: 50%;
        border-bottom-left-radius: 50%;
    }
    .timeline > li.timeline-inverted > .timeline-panel {
        float: right;
    }
    .timeline > li.timeline-inverted > .timeline-panel:before {
        border-left-width: 0;
        border-right-width: 15px;
        left: -15px;
        right: auto;
    }
    .timeline > li.timeline-inverted > .timeline-panel:after {
        border-left-width: 0;
        border-right-width: 14px;
        left: -14px;
        right: auto;
    }
    .timeline-badge.primary {
        background-color: #2e6da4 !important;
    }
    .timeline-badge.success {
        background-color: #3f903f !important;
    }
    .timeline-badge.warning {
        background-color: #f0ad4e !important;
    }
    .timeline-badge.danger {
        background-color: #d9534f !important;
    }
    .timeline-badge.info {
        background-color: #5bc0de !important;
    }
    .timeline-title {
        margin-top: 0;
        color: inherit;
    }
    .timeline-body > p,
    .timeline-body > ul {
        margin-bottom: 0;
    }
    .timeline-body > p + p {
        margin-top: 5px;
    }
    </style>

</head>
<body>

    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->

    <!-- page container area start -->

    <div class="page-container-user">
    
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
                    <div class="col-md-6 col-sm-4">
                        <ul class="notification-area pull-right">
                            <li class="settings-btn">
                                <a href="logout">
                                <i class="ti-power-off"></i>
                                </a>
                            </li>
                        </ul>
                        <div> <h4 class="page-user pull-right">Hi, {{Auth::user()->name}}</h4> </div>
                    </div>
                </div>
            </div>
            <!-- header area end --> 

            @yield('content')

            <div ui-view></div>

            <!-- footer area start-->
            <!-- <footer>
                <div class="footer-area">
                    <p>© Copyright 2020.</p>
                </div>
            </footer> -->
            <!-- footer area end-->
        </div>
    </div>

@include('layouts.scripts')

</body>
</html>

