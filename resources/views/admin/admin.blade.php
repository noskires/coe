<div class="main-content-inner">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-ml-12">
            <div class="row">
                <!-- Textual inputs start -->
                <div class="col-3 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Assign role to users</h4>
                            <div class="form-group">
                                <label class="col-form-label">Employee</label>
                                <select class="form-control select2" style="width:95%" > </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Role</label>
                                <select class="form-control coe-type-selection" ng-model="AdminsCtrl.adminDetails.admin_type" ng-change="AdminsCtrl.selectAdminType(AdminsCtrl.adminDetails.admin_type)" required>
                                <option value=''>- - - select role - - - </option> 
                                    <option value="1">Fulfiller</option>
                                    <option value="2">Admin</option>
                                </select>
                            </div> 
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" ng-click="AdminsCtrl.assignAsAdminBtn(AdminsCtrl.adminDetails)">Submit</button>
                        </div>
                    </div>
                </div>
                <!-- Textual inputs end -->
                <div class="col-9 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive data-tables datatable-dark">
                                <table id="dataTable3" class="text-center" datatable="ng">
                                    <thead class="text-capitalize">
                                        <tr> 
                                            <th>Pers No</th>
                                            <th>Name</th> 
                                            <th>Roles</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="admin in AdminsCtrl.admins"> 
                                            <td ng-bind="admin.id"> </td>
                                            <td> <%admin.last_name | uppercase%>, <%admin.first_name | uppercase%> <%admin.middle_name | uppercase%> </td> 
                                            <td> 
                                                <table width="80%"> 
                                                    <tr ng-repeat="role in admin.roles">
                                                        <td width="80%"><%role.name | uppercase%></td>
                                                        <td><a href="#" title="delete" ng-click="AdminsCtrl.revokeAsAdminBtn(admin.id, role.name)"> <i class="fa fa-trash"></i> </a></td>
                                                    </tr>
                                                </table>
                                            </td> 
                                            <!-- <td valign="middle"> <a href="#" title="delete" ng-click="AdminsCtrl.revokeAsAdminBtn(admin)"> <i class="fa fa-trash"></i> </a> </td> -->
                                        </tr> 
                                    </tbody>
                                </table>
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
                url: "api/v2/employees?employment_status=Active",
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



 