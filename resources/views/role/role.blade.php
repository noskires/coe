<div class="main-content-inner">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-ml-12">
            <div class="row">
                <!-- Textual inputs start -->
                <div class="col-3 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Assign new permission to role</h4> 
                            <div class="form-group">
                                <label class="col-form-label">Role</label>
                                <select class="form-control coe-type-selection" ng-model="permissionDetails.admin_type" ng-change="AdminsCtrl.selectAdminType(AdminsCtrl.adminDetails.admin_type)" required>
                                <option value=''>- - - select role - - - </option> 
                                    <option ng-value="1">Fulfiller</option>
                                    <option ng-value="2">Admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Permissions</label>
                                <select class="form-control coe-type-selection" ng-model="permissionDetails.permission_id" required>
                                    <option value=''>- - - select permission - - - </option> 
                                    <option ng-value="permission.id" ng-repeat="permission in RolesCtrl.permissions"><%permission.name%></option>
                                </select>
                            </div> 
                            <br>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" ng-click="RolesCtrl.assignPermissionToRoleBtn(permissionDetails)">Submit</button>
                        </div>
                    </div>
                </div>
                <!-- Textual inputs end -->
                <div class="col-9 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <!-- <h4 class="header-title">Table</h4> -->
                            <div class="table-responsive data-tables datatable-dark">
                                <table id="dataTable3" class="text-center" datatable="ng">
                                    <thead>
                                        <tr>  
                                            <th>Role</th> 
                                            <th>Permissions</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="role in RolesCtrl.roles">    
                                            <td><%role.name | uppercase%></td>   
                                            <td> 
                                                <table width="80%"> 
                                                    <tr ng-repeat="permission in role.permissions">
                                                        <td width="80%"><%permission.name | uppercase%></td>
                                                        <td><a href="#" title="delete" ng-click="RolesCtrl.revokePermissionBtn(permission.id, role.id)"> <i class="fa fa-trash"></i> </a></td>
                                                    </tr>
                                                </table>
                                            </td>
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
 