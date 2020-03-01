<div class="main-content-inner">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-ml-12">
            <div class="row">
                <!-- Textual inputs start -->
                <div class="col-3 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Original Signature</h4>
                            <div class="form-group">
                                <label class="col-form-label">Type of Certificate</label>
                                <select class="form-control" ng-model="coeCtrl.coeDetails.coe_type" ng-change="coeCtrl.selectCoeType(coeCtrl.coeDetails.coe_type)" required>
                                <option value=''>- - - select type - - - </option> 
                                    <option ng-value="type.type_code" ng-repeat="type in coeCtrl.coeTypes"><%type.type_desc%></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Purpose</label>
                                <select class="form-control" ng-model="coeCtrl.coeDetails.coe_purpose" required>
                                <option value=''>- - - select purpose - - - </option> 
                                    <option ng-value="purpose.purpose_code" ng-repeat="purpose in coeCtrl.purposes"><%purpose.purpose_desc%></option>
                                </select>
                            </div>
                            <div class="form-group" ng-if="coeCtrl.is_salary_option">
                                <label class="col-form-label">Salary Option</label>
                                <select class="form-control" ng-model="coeCtrl.coeDetails.salary_option">
                                <option value=''>- - - select salary option - - - </option> 
                                <option ng-repeat="salary_option in coeCtrl.salary_options" ng-value="salary_option.id" ng-bind="salary_option.text | uppercase"> <%salary_option.text | uppercase%> </option>
                                </select> 
                            </div>
                            <div class="form-group">
                                <label for="example-text-input-lg" class="col-form-label">Remarks</label>
                                <input class="form-control form-control-lg" type="text" id="example-text-input-lg" ng-model="coeCtrl.coeDetails.remarks">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" ng-click="coeCtrl.createCoeBtn(coeCtrl.coeDetails)">Submit</button>
                        </div>
                    </div>
                </div>
                <!-- Textual inputs end -->
                <div class="col-9 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <!-- <h4 class="header-title">Table</h4> -->
                            <div class="table-responsive data-tables datatable-dark">
                                <table datatable="" dt-options="coeCtrl.dtOptions" dt-columns="coeCtrl.dtColumns" dt-instance="coeCtrl.dtInstance" class="table table-bordered table-hover table-md" ></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
