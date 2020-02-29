<div class="main">
    <div class="container-fluid">
        <section id="main-content"> 

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
                                            <th>ASSIGNED TO </th>
                                            <th>STATUS </th>
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
                                            <!-- <td><%coe.is_with_logo%></td>  -->
                                            <td ng-bind="coe.purpose_desc | uppercase"><%coe.purpose_desc | uppercase%></td> 
                                            <td ng-bind="coe.is_salary_confidential01 | uppercase"><%coe.is_salary_confidential01 | uppercase%></td> 
                                            <td ng-bind="coe.created_at | uppercase"><%coe.created_at | uppercase%></td> 
                                            <td ng-bind="coe.changed_by | uppercase"><%coe.changed_by | uppercase%></td> 
                                            <td></td> 
                                            <td>
                                                <a href="#" class="btn btn-danger btn-xs" ng-click="coeCtrl.printCoeOriginalSigBtn(coe.coe_code)" title="Print Preview" style="margin-top:12px;"> <i class="ti-printer"></i>  </a>
                                                <a href="#" class="btn btn-danger btn-xs" ng-click="coeCtrl.viewCoeOriginalSigBtn(coe.coe_code)" title="View Status" style="margin-top:12px;"> <i class="ti-eye"></i> </a>
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