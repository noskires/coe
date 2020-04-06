<div class="main-content-inner">
    <div class="row">
        <!-- tab start -->
        <div class="col-lg-12 col-md-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                            <a href="self-service/{{Crypt::encrypt(Auth::user()->email)}}" class="nav-link active"><i class="ti-map-alt"></i> <span>&nbsp; Self Service</span></a></a>
                        </li>
                        <li class="nav-item">
                            <a href="original-signature/{{Crypt::encrypt(Auth::user()->email)}}" class="nav-link" ><i class="ti-marker-alt"></i> <span>&nbsp; Original Signature</span></a></a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-tab1" role="tabpanel" aria-labelledby="pills-tab1-tab">

                            <div class="row">
                                <!-- Textual inputs start -->
                                <div class="col-3 mt-5">
                                    <div class="card">
                                        <div class="card-body"> 
                                            <h4 class="header-title">Self-Service</h4>
                                            <div class="form-group">
                                                <label class="col-form-label">Type of Certificate</label>
                                                <select class="form-control coe-type-selection" ng-model="CoeCtrl.coeDetails.coe_type" ng-change="CoeCtrl.selectCoeType(CoeCtrl.coeDetails.coe_type)" required>
                                                <option value=''>- - - select type - - - </option> 
                                                    <option ng-value="type.type_code" ng-repeat="type in CoeCtrl.coeTypes"><%type.type_desc%></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">Purpose</label>
                                                <select class="form-control coe-purposes-selection" ng-model="CoeCtrl.coeDetails.coe_purpose" required>
                                                <option value=''>- - - select purpose - - - </option> 
                                                    <option ng-value="purpose.purpose_code" ng-repeat="purpose in CoeCtrl.purposes"><%purpose.purpose_desc%></option>
                                                </select>
                                            </div>
                                            <div class="form-group" ng-if="CoeCtrl.is_salary_option">
                                                <label class="col-form-label">Salary Option</label>
                                                <select class="form-control" ng-model="CoeCtrl.coeDetails.salary_option">
                                                <option value=''>- - - select salary option - - - </option> 
                                                <option ng-repeat="salary_option in CoeCtrl.salary_options" ng-value="salary_option.id" ng-bind="salary_option.text | uppercase"> <%salary_option.text | uppercase%> </option>
                                                </select> 
                                            </div>
                                            <div class="form-group">
                                                <label for="example-text-input-lg" class="col-form-label">Remarks</label>
                                                <input class="form-control form-control-lg" type="text" id="example-text-input-lg" ng-model="CoeCtrl.coeDetails.remarks">
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" ng-click="CoeCtrl.createCoeBtn(CoeCtrl.coeDetails)">Submit</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Textual inputs end -->
                                <div class="col-9 mt-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <!-- <h4 class="header-title">Table</h4> -->
                                            <div class="table-responsive data-tables datatable-dark">
                                                <table datatable="" dt-options="CoeCtrl.dtOptions" dt-columns="CoeCtrl.dtColumns" dt-instance="CoeCtrl.dtInstance" class="table table-bordered table-hover table-md" ></table>
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
        $(".coe-salary-option").select2();
    });
</script>