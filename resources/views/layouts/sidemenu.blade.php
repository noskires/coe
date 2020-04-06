<!-- sidebar menu area start -->
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="index.html"><img src="public/assets/images/icon/logo.png" alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu" ng-controller="MainCtrl as MainCtrl">
                    <li><a href="self-service/{{Crypt::encrypt(Auth::user()->email)}}"><i class="ti-map-alt"></i> <span>Self Service</span></a></li>
                    <li><a href="original-signature/{{Crypt::encrypt(Auth::user()->email)}}"><i class="ti-marker-alt"></i> <span>Original Signature</span></a></li>
                    @role('fulfiller|admin')
                    <li><a href="walk-in/{{Crypt::encrypt(Auth::user()->email)}}"><i class="ti-flag"></i> <span>Request-Walk-in</span></a></li>
                    <li><a href="assigned-to-me/{{Crypt::encrypt(Auth::user()->email)}}"><i class="ti-flag-alt"></i> <span>Request-Assigned to me</span></a></li>
                    <li><a href="all-request/{{Crypt::encrypt(Auth::user()->email)}}"><i class="ti-flag-alt-2"></i> <span>Request-All</span></a></li>
                    
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i><span>Setup</span></a>
                        <ul class="collapse">
                            <li><a href="#" ng-click="MainCtrl.routeTo('purposes')"><i class="ti-layers"></i> <span>Types</span></a></li>
                            <li><a href="#" ng-click="MainCtrl.routeTo('purposes')"><i class="ti-check-box"></i> <span>Purpose</span></a></li>
                            @role('admin')
                            <li><a href="#" ng-click="MainCtrl.routeTo('roles')"><i class="ti-thumb-up"></i> <span>Assign permission to roles</span></a></li>
                            <li><a href="#" ng-click="MainCtrl.routeTo('admins')"><i class="ti-thumb-up"></i> <span>Assign roles to users</span></a></li>
                            <li><a href="#" ng-click="MainCtrl.routeTo('permissions')"><i class="ti-thumb-up"></i> <span>Permissions</span></a></li>
                            @endrole
                            <li><a href="#" ng-click="MainCtrl.routeTo('audits')"><i class="ti-menu-alt"></i> <span>Audit Logs</span></a></li>
                        </ul>
                    </li>
                    @endrole 
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->