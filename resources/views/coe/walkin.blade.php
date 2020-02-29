<div class="main">
    <div class="container-fluid">
        <section id="main-content"> 
            <div class="row">    
                <div class="col-lg-12">
                    <div class="card">
                        <!-- <div class="card-title pr">
                            <h4>Create New</h4>
                        </div> -->
                        <div class="card-body">
                            <form ng-model="employeeDetails">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="">SELECT EMPLOYEE</label>
                                        <select class="form-control select2" style="width:95%" > </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">TYPE OF CERTIFICATE</label>
                                        <select class="form-control coe-type-selection" ng-model="coeCtrl.coeDetails.coe_type" style="width:95%" ng-change="coeCtrl.selectCoeType(coeCtrl.coeDetails.coe_type)" required>
                                            <option value=''>- - - SELECT TYPE - - - </option>   
                                            <option ng-value='coeType.type_code' ng-repeat="coeType in coeCtrl.coeTypes" ng-bind="coeType.type_desc"><%coeType.type_desc%></option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">PURPOSE</label>
                                        <select class="form-control coe-purposes-selection" ng-model="coeCtrl.coeDetails.coe_purpose" style="width:95%" required>
                                            <option value=''>- - - SELECT PURPOSE - - - </option>  
                                            <option ng-value='purpose.purpose_code' ng-repeat="purpose in coeCtrl.purposes" ng-bind="purpose.purpose_desc | uppercase"><%purpose.purpose_desc | uppercase%></option> 
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3" ng-if="coeCtrl.is_salary_option">
                                        <label for="">SALARY OPTION</label>
                                        <select class="form-control coe-purposes-selection" ng-model="coeCtrl.coeDetails.salary_option" style="width:95%" required>
                                            <option value=''>- - - SELECT SALARY OPTION- - - </option>   
                                            <option ng-value='salary_option.id' ng-repeat="salary_option in coeCtrl.salary_options" ng-bind="salary_option.text | uppercase"><%salary_option.text | uppercase%></option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                    <button type="submit" class="btn btn-danger" ng-click="coeCtrl.createCoeBtn(coeCtrl.coeDetails)" style="margin-top:12px;">SUBMIT</button>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <br>
                            </form>
                            <br>
                        </div>
                    </div>
                </div> 
                <!-- /# column -->
            </div>

            <div class="row">    
                <div class="col-lg-12">
                    <div class="card">
                        <!-- <div class="card-title pr">
                            <h4>COE Requests</h4>
                        </div> -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" datatable="ng" dt-instance="tc.dtInstance" dt-options="tc.dtOptions" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>REFERENCE #</th>
                                            <th>PERS NO</th>
                                            <th>EE NAME</th>
                                            <th>TYPE</th>
                                            <th>PURPOSE</th>
                                            <th>SALARY OPTION</th>
                                            <th>CREATED AT</th>
                                            <th>CREATED BY </th> 
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="coe in coeCtrl.coe">
                                            <td ng-bind="coe.v_id"><%coe.v_id%></td>
                                            <td ng-bind="coe.coe_code"><%coe.coe_code%></td>
                                            <td ng-bind="coe.employee_code"><%coe.employee_code%></td>
                                            <td ng-bind="coe.name"><%coe.name%></td>
                                            <td ng-bind="coe.type_desc"><%coe.type_desc%></td>
                                            <td ng-bind="coe.purpose_desc | uppercase"><%coe.purpose_desc | uppercase%></td> 
                                            <td ng-bind="coe.is_salary_confidential01 | uppercase"><%coe.is_salary_confidential01 | uppercase%></td> 
                                            <td ng-bind="coe.created_at | uppercase"><%coe.created_at | uppercase%></td> 
                                            <td ng-bind="coe.created_by | uppercase"><%coe.created_by | uppercase%></td> 
                                            <
                                            <td>
                                                <a href="#" class="btn btn-danger btn-xs" ng-click="coeCtrl.printCoeBtn(coe.coe_code)" style="margin-top:12px;">PRINT PREVIEW</a>
                                             </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
            </div>
            <!-- /# row --> 
        </section>
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

        });
        
</script>
