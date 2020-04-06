<!-- jquery latest version -->
<script src="{{URL::to('public/assets/js/vendor/jquery-2.2.4.min.js')}}"></script>
<!-- <script src="{{URL::to('public/assets/js/jquery-3.2.1.min.js')}}"></script> -->
<!-- <script src="{{URL::to('public/assets/js/jquery.min.js')}}"></script> -->
<!-- bootstrap 4 js -->
<script src="{{URL::to('public/assets/js/popper.min.js')}}"></script>
<script src="{{URL::to('public/assets/js/bootstrap.min.js')}}"></script>
<!-- <script src="{{URL::to('public/assets/js/owl.carousel.min.js')}}"></script> -->
<script src="{{URL::to('public/assets/js/metisMenu.min.js')}}"></script>
<script src="{{URL::to('public/assets/js/jquery.slimscroll.min.js')}}"></script>
<script src="{{URL::to('public/assets/js/jquery.slicknav.min.js')}}"></script>
<!-- Start datatable js -->
<script src="{{URL::to('public/assets/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::to('public/assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::to('public/assets/js/dataTables.bootstrap4.min.js')}}"></script>
<!-- others plugins -->
<script src="{{URL::to('public/assets/js/plugins.js')}}"></script>
<script src="{{URL::to('public/assets/js/scripts.js')}}"></script>

<!-- Angularjs -->
<script type="text/javascript" src="{{URL::to('public/node_modules/angular/angular.min.js')}}"></script>

<!-- Router -->
<script type="text/javascript" src="{{URL::to('public/node_modules/angular-ui-router/release/angular-ui-router.min.js')}}"></script>

<!-- Sanitize -->
<script type="text/javascript" src="{{URL::to('public/node_modules/angular-sanitize/angular-sanitize.min.js')}}"></script>

<!-- angular-ui -->
<script type="text/javascript" src="{{URL::to('public/node_modules/angular-ui-bootstrap/dist/ui-bootstrap-tpls.js')}}"></script>

<!-- DataTables -->
<script type="text/javascript" src="{{URL::to('public/node_modules/angular-datatables/dist/angular-datatables.min.js')}}"></script>

<!-- Sweet Alert -->
<script type="text/javascript" src="{{URL::to('public/node_modules/angular-sweetalert/SweetAlert.min.js')}}"></script>
<script type="text/javascript" src="{{URL::to('public/node_modules/sweetalert/dist/sweetalert.min.js')}}"></script> 

<!-- Datepicker -->
<script type="text/javascript" src="{{URL::to('public/node_modules/ui-date/dist/date.js')}}"></script>

<!-- Timer -->
<script src="{{URL::to('public/node_modules/angular-timer/dist/assets/js/angular-timer-all.min.js')}}"></script> 
<script src="{{URL::to('public/node_modules/moment.js')}}"></script> 

<!-- Select2 -->
<script type="text/javascript" src="{{URL::to('public/node_modules/select2/dist/js/select2.full.js')}}"></script>
<script type="text/javascript" src="{{URL::to('public/node_modules/angular-select2/dist/angular-select2.js')}}"></script>

<!-- for otp page -->
<script src="{{URL::to('public/assets/js/cleave.min.js')}}"></script>
<script type="text/javascript">
    var cleave = new Cleave('.input-otp', {
        delimiter: '·',
        blocks: [1, 1, 1, 1, 1, 1],
        uppercase: false
    });
</script>

<!-- Main App -->
<script src="{{URL::to('public/js/coeApp.js')}}"></script>

<!-- Controllers --> 
<script src="{{URL::to('public/js/controllers/audits.ctrlr.js')}}"></script>
<script src="{{URL::to('public/js/controllers/coe.ctrlr.js')}}"></script> 
<script src="{{URL::to('public/js/controllers/originalSignatureCertificate.ctrlr.js')}}"></script>
<script src="{{URL::to('public/js/controllers/assignedtome.ctrlr.js')}}"></script>
<script src="{{URL::to('public/js/controllers/walkin.ctrlr.js')}}"></script>
<script src="{{URL::to('public/js/controllers/allRequests.ctrlr.js')}}"></script>
<script src="{{URL::to('public/js/controllers/purposes.ctrlr.js')}}"></script>
<script src="{{URL::to('public/js/controllers/types.ctrlr.js')}}"></script>
<script src="{{URL::to('public/js/controllers/otp.ctrlr.js')}}"></script>
<script src="{{URL::to('public/js/controllers/admin.ctrlr.js')}}"></script>
<script src="{{URL::to('public/js/controllers/roles.ctrlr.js')}}"></script>
<script src="{{URL::to('public/js/controllers/permissions.ctrlr.js')}}"></script>

<!-- Services --> 
<script src="{{URL::to('public/js/services/audits.srvcs.js')}}"></script>
<script src="{{URL::to('public/js/services/coe.srvcs.js')}}"></script>
<script src="{{URL::to('public/js/services/purposes.srvcs.js')}}"></script>
<script src="{{URL::to('public/js/services/types.srvcs.js')}}"></script>
<script src="{{URL::to('public/js/services/otp.srvcs.js')}}"></script>
<script src="{{URL::to('public/js/services/status_items.srvcs.js')}}"></script>
<script src="{{URL::to('public/js/services/admin.srvcs.js')}}"></script>
<script src="{{URL::to('public/js/services/roles.srvcs.js')}}"></script>
<script src="{{URL::to('public/js/services/permissions.srvcs.js')}}"></script>

@yield('additionalScripts')