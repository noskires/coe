<div class="main-content-inner">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-ml-12">
            <div class="row">
                <!-- Textual inputs start -->
                <div class="col-3 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Self-Survice</h4>
                            <div class="form-group">
                                <label class="col-form-label">Type of Certificate</label>
                                <select class="form-control" ng-model="CoeCtrl.coeDetails.coe_type" ng-change="CoeCtrl.selectCoeType(CoeCtrl.coeDetails.coe_type)" required>
                                <option value=''>- - - select type - - - </option> 
                                    <option ng-value="type.type_code" ng-repeat="type in CoeCtrl.coeTypes"><%type.type_desc%></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Purpose</label>
                                <select class="form-control" ng-model="CoeCtrl.coeDetails.coe_purpose" required>
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

    </div>
</div>

languages
<table>
<tr ng-repeat="d in CoeCtrl.datas">
    <td> a </td>
    <td> <%d%> </td>
    <td> <a href="#" ng-click="CoeCtrl.removeLanguage(d)"> remove </a> </td>
</tr>
</table>
