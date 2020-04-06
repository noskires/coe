<div class="main-content-inner">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-ml-12">
            <div class="row">
                <!-- Textual inputs start -->
                <div class="col-3 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Walk-in</h4>
                            <div class="form-group">
                                <label class="col-form-label">Employee</label>
                                <select class="form-control select2" style="width:95%" > </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Type of Certificate</label>
                                <select class="form-control coe-type-selection" ng-model="WalkinCtrl.coeDetails.coe_type" ng-change="WalkinCtrl.selectCoeType(WalkinCtrl.coeDetails.coe_type)" required>
                                <option value=''>- - - select type - - - </option> 
                                    <option ng-value="type.type_code" ng-repeat="type in WalkinCtrl.coeTypes"><%type.type_desc%></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Purpose</label>
                                <select class="form-control coe-purposes-selection" ng-model="WalkinCtrl.coeDetails.coe_purpose" required>
                                <option value=''>- - - select purpose - - - </option>
                                    <option ng-value="purpose.purpose_code" ng-repeat="purpose in WalkinCtrl.purposes"><%purpose.purpose_desc%></option>
                                </select>
                            </div>
                            <div class="form-group" ng-if="WalkinCtrl.is_salary_option">
                                <label class="col-form-label">Salary Option</label>
                                <select class="form-control" ng-model="WalkinCtrl.coeDetails.salary_option">
                                <option value=''>- - - select salary option - - - </option> 
                                <option ng-repeat="salary_option in WalkinCtrl.salary_options" ng-value="salary_option.id" ng-bind="salary_option.text | uppercase"> <%salary_option.text | uppercase%> </option>
                                </select> 
                            </div>
                            <div class="form-group">
                                <label for="example-text-input-lg" class="col-form-label">Remarks</label>
                                <input class="form-control form-control-lg" type="text" id="example-text-input-lg" ng-model="WalkinCtrl.coeDetails.remarks">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" ng-click="WalkinCtrl.createCoeBtn(WalkinCtrl.coeDetails)">Submit</button>
                        </div>
                    </div>
                </div>
                <!-- Textual inputs end -->
                <div class="col-9 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <!-- <h4 class="header-title">Table</h4> -->
                            <div class="table-responsive data-tables datatable-dark">
                                <table datatable="" dt-options="WalkinCtrl.dtOptions" dt-columns="WalkinCtrl.dtColumns" dt-instance="WalkinCtrl.dtInstance" class="table table-bordered table-hover table-md" ></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 

   
<script type="text/javascript">

    $(function() {

        $(".select2").select2({
            ajax: {
                url: "api/v2/employees",
                dataType: 'json',
                delay: 100,
                data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
                },
                processResults: function (data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                return {
                    results: data.items,
                    pagination: {
                    more: (params.page * 30) < data.total_count
                    }
                };
                },
                cache: true
            }
            });

            $(".coe-type-selection").select2();
            $(".coe-purposes-selection").select2();
            $(".coe-salary-option").select2();
        });
        
</script>
