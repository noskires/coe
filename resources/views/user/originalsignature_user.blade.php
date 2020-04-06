<div class="main-content-inner">
    <div class="row">
        <!-- tab start -->
        <div class="col-lg-12 col-md-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item">
                            <a href="self-service/{{Crypt::encrypt(Auth::user()->email)}}" class="nav-link"><i class="ti-map-alt"></i> <span>&nbsp; Self Service</span></a></a>
                        </li>
                        <li class="nav-item">
                            <a href="original-signature/{{Crypt::encrypt(Auth::user()->email)}}" class="nav-link active" ><i class="ti-marker-alt"></i> <span>&nbsp; Original Signature</span></a></a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-tab1" role="tabpanel" aria-labelledby="pills-tab1-tab">

                        <div class="row">
                            <!-- Textual inputs start -->
                            <div class="col-3 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Original Signature</h4>
                                        <div class="form-group">
                                            <label class="col-form-label">Type of Certificate</label>
                                            <select class="form-control coe-type-selection" ng-model="OriginalSignatureCertCtrl.coeDetails.coe_type" ng-change="OriginalSignatureCertCtrl.selectCoeType(OriginalSignatureCertCtrl.coeDetails.coe_type)" required>
                                            <option value=''>- - - select type - - - </option> 
                                                <option ng-value="type.type_code" ng-repeat="type in OriginalSignatureCertCtrl.coeTypes"><%type.type_desc%></option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Purpose</label>
                                            <select class="form-control coe-purposes-selection" ng-model="OriginalSignatureCertCtrl.coeDetails.coe_purpose" required>
                                            <option value=''>- - - select purpose - - - </option> 
                                                <option ng-value="purpose.purpose_code" ng-repeat="purpose in OriginalSignatureCertCtrl.purposes"><%purpose.purpose_desc%></option>
                                            </select>
                                        </div>
                                        <div class="form-group" ng-if="OriginalSignatureCertCtrl.is_salary_option">
                                            <label class="col-form-label">Salary Option</label>
                                            <select class="form-control" ng-model="OriginalSignatureCertCtrl.coeDetails.salary_option">
                                            <option value=''>- - - select salary option - - - </option> 
                                            <option ng-repeat="salary_option in OriginalSignatureCertCtrl.salary_options" ng-value="salary_option.id" ng-bind="salary_option.text | uppercase"> <%salary_option.text | uppercase%> </option>
                                            </select> 
                                        </div>
                                        <div class="form-group">
                                            <label for="remarks" class="col-form-label">Remarks</label>
                                            <input class="form-control form-control-lg" type="text" id="remarks" ng-model="OriginalSignatureCertCtrl.coeDetails.remarks">
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" ng-click="OriginalSignatureCertCtrl.createCoeBtn(OriginalSignatureCertCtrl.coeDetails)">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Textual inputs end -->
                            <div class="col-9 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <h4 class="header-title">Table</h4> -->
                                        <div class="table-responsive data-tables datatable-dark">
                                            <table datatable="" dt-options="OriginalSignatureCertCtrl.dtOptions" dt-columns="OriginalSignatureCertCtrl.dtColumns" dt-instance="OriginalSignatureCertCtrl.dtInstance" class="table table-bordered table-hover table-md" ></table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="tab-pane fade" id="pills-tab2" role="tabpanel" aria-labelledby="pills-tab2-tab">
                            <br> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- tab end --> 
    </div>
</div>

<script type="text/javascript">

    $(function() { 
        $(".coe-type-selection").select2();
        $(".coe-purposes-selection").select2(); 
    });
</script>

<script type="text/ng-template" id="view-status-modal"> 
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">REFERENCE#: <%OriginalSignatureStatusCtrl.coe.coe_code%></h5>
            <a href="original-signature/{{Crypt::encrypt(Auth::user()->email)}}" class="close" ng-click="OriginalSignatureStatusCtrl.close()"><span>&times;</span></a>
        </div>
        <div class="modal-body">
            <div class="form-row"> 
                <div class="col-md-6 mb-3">
                    <label for="validationCustom02">TYPE</label>
                    <input type="text" class="form-control" disabled="true" ng-model="OriginalSignatureStatusCtrl.coe.type_desc">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationCustom02">PURPOSE</label>
                    <input type="text" class="form-control" disabled="true" ng-model="OriginalSignatureStatusCtrl.coe.purpose_desc">
                </div>
            </div>
            <div class="form-row">
            <div class="col-md-6 mb-3">
                    <label for="validationCustom02">ASSIGNED TO</label>
                    <input type="text" class="form-control" disabled="true" ng-model="OriginalSignatureStatusCtrl.coe.changed_by">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationCustom02">STATUS</label>
                    <input type="text" class="form-control" disabled="true" ng-model="OriginalSignatureStatusCtrl.status_item.short_desc">
                </div>
            </div> 
 
            <ul class="timeline" ng-repeat="status_item in OriginalSignatureStatusCtrl.status_items">
                <li class="" ng-if="status_item.user_type=='FULFILLER'">
                    <div class="timeline-badge info"><i class="fa fa-lg fa-comment"></i></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                        <h5 class="timeline-title"><%status_item.short_desc%></h5><p>( <%status_item.user_type%> <small class="text-muted"><i class="glyphicon glyphicon-time"></i> <%status_item.created_at%></small>)</p>
                        </div>
                        <div class="timeline-body">
                        <p><%status_item.remarks%></p>
                        </div>
                    </div>
                </li> 
                <li class="timeline-inverted" ng-if="status_item.user_type=='EMPLOYEE'">
                    <div class="timeline-badge"><i class="fa fa-lg fa-comment"></i></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                        <h5 class="timeline-title"><%status_item.short_desc%></h5><p>( <%status_item.user_type%> <small class="text-muted"><i class="glyphicon glyphicon-time"></i> <%status_item.created_at%></small> )</p>
                        </div>
                        <div class="timeline-body">
                        <p><%status_item.remarks%></p>
                        </div>
                    </div>
                </li> 
            </ul>
        </div> 
    </div> 
</script>