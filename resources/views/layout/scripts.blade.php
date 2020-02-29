<!-- jquery latest version -->
<script src="{{URL::to('assets/js/vendor/jquery-2.2.4.min.js')}}"></script>
<!-- <script src="{{URL::to('assets/js/jquery.min.js')}}"></script> -->
<!-- bootstrap 4 js -->
<script src="{{URL::to('assets/js/popper.min.js')}}"></script>
<script src="{{URL::to('assets/js/bootstrap.min.js')}}"></script>
<!-- <script src="{{URL::to('assets/js/owl.carousel.min.js')}}"></script> -->
<script src="{{URL::to('assets/js/metisMenu.min.js')}}"></script>
<script src="{{URL::to('assets/js/jquery.slimscroll.min.js')}}"></script>
<script src="{{URL::to('assets/js/jquery.slicknav.min.js')}}"></script>
<!-- Start datatable js -->
<script src="assets/js/jquery.dataTables.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>
<!-- others plugins -->
<script src="assets/js/plugins.js"></script>
<script src="assets/js/scripts.js"></script>

<!-- Angularjs -->
<script type="text/javascript" src="{{URL::to('node_modules/angular/angular.min.js')}}"></script>

<!-- Router -->
<script type="text/javascript" src="{{URL::to('node_modules/angular-ui-router/release/angular-ui-router.min.js')}}"></script>

<!-- Sanitize -->
<script type="text/javascript" src="{{URL::to('node_modules/angular-sanitize/angular-sanitize.min.js')}}"></script>

<!-- angular-ui -->
<script type="text/javascript" src="{{URL::to('node_modules/angular-ui-bootstrap/dist/ui-bootstrap-tpls.js')}}"></script>

<!-- DataTables -->
<script type="text/javascript" src="{{URL::to('node_modules/angular-datatables/dist/angular-datatables.min.js')}}"></script>

<!-- Main App -->
<script src="{{URL::to('js/coeApp.js')}}"></script>

<!-- Controllers --> 
<script src="{{URL::to('js/controllers/audits.ctrlr.js')}}"></script>
<script src="{{URL::to('js/controllers/coe.ctrlr.js')}}"></script>
<script src="{{URL::to('js/controllers/coeDetails.ctrlr.js')}}"></script>
<script src="{{URL::to('js/controllers/originalSignatureCertificate.ctrlr.js')}}"></script>
<script src="{{URL::to('js/controllers/fulfillers.ctrlr.js')}}"></script>
<script src="{{URL::to('js/controllers/walkin.ctrlr.js')}}"></script>
<script src="{{URL::to('js/controllers/allRequests.ctrlr.js')}}"></script>
<script src="{{URL::to('js/controllers/purposes.ctrlr.js')}}"></script>
<script src="{{URL::to('js/controllers/types.ctrlr.js')}}"></script>
<script src="{{URL::to('js/controllers/otp.ctrlr.js')}}"></script>

<!-- Services --> 
<script src="{{URL::to('js/services/audits.srvcs.js')}}"></script>
<script src="{{URL::to('js/services/coe.srvcs.js')}}"></script>
<script src="{{URL::to('js/services/purposes.srvcs.js')}}"></script>
<script src="{{URL::to('js/services/types.srvcs.js')}}"></script>
<script src="{{URL::to('js/services/otp.srvcs.js')}}"></script>
<script src="{{URL::to('js/services/status_items.srvcs.js')}}"></script>

@yield('additionalScripts')