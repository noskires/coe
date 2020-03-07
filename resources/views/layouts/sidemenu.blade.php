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
                <ul class="metismenu" id="menu">
                    <li><a href="self-service/{{Crypt::encrypt(Auth::user()->email)}}"><i class="ti-map-alt"></i> <span>Self Service</span></a></li>
                    <li><a href="original-signature/{{Crypt::encrypt(Auth::user()->email)}}"><i class="ti-marker-alt"></i> <span>Original Signature</span></a></li>
                    @if(Auth::user()->is_admin==1)
                    <li><a href="walk-in/{{Crypt::encrypt(Auth::user()->email)}}"><i class="ti-flag"></i> <span>Request-Walk-in</span></a></li>
                    <li><a href="assigned-to-me/{{Crypt::encrypt(Auth::user()->email)}}"><i class="ti-flag-alt"></i> <span>Request-Assigned to me</span></a></li>
                    <li><a href="all-request/{{Crypt::encrypt(Auth::user()->email)}}"><i class="ti-flag-alt-2"></i> <span>Request-All</span></a></li>
                    
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i><span>Setup</span></a>
                        <ul class="collapse">
                            <li ui-sref="types"><a href="#"><i class="ti-layers"></i> <span>Types</span></a></li>
                            <li ui-sref="purposes"><a href="#"><i class="ti-check-box"></i> <span>Purpose</span></a></li>
                            <li ui-sref="admins"><a href="#"><i class="ti-thumb-up"></i> <span>Admins</span></a></li>
                            <li ui-sref="fulfillers"><a href="#"><i class="ti-thumb-up"></i> <span>Fulfillers</span></a></li>
                            <li ui-sref="audits"><a href="#"><i class="ti-menu-alt"></i> <span>Audit Logs</span></a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->