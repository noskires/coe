<div class="main-content-inner">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-ml-12">
            <div class="row">
                <!-- Textual inputs start -->
                <div class="col-3 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Create New Permission</h4>  
                            <div class="form-group">
                                <label class="col-form-label">Permission</label>
                                <input type="text" class="form-control form-control-md" placeholder="Permission Name" ng-model="permissionDetails.name">
                            </div> 
                            <br>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" ng-click="PermissionsCtrl.createPermissionBtn(permissionDetails)">Submit</button>
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
                                            <th>Permission</th> 
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="permission in PermissionsCtrl.permissions">    
                                            <td><%permission.name%></td>  
                                            <td valign="middle"> 
                                                <a href="#" title="delete" ng-click="PermissionsCtrl.removePermissionBtn(permission.id)"> <i class="ti-trash"></i> </a> </td>
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


<!-- <script type="text/ng-template" id="edit-type-modal">
    <div class="modal-header">
        <h3 class="modal-title" id="modal-title"><%PermissionsCtrl.collection.type_code%></h3>
    </div>
    <div class="modal-body" id="modal-body">
    <form ng-model="typeDetails">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="">Type</label>
                                <input type="text" class="form-control" placeholder="Type" ng-model="PermissionsCtrl.collection.type_desc">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" ng-click="PermissionsCtrl.updateTypeBtn(PermissionsCtrl.collection)">SUBMIT</button>
        <button type="submit" class="btn btn-warning" ng-click="PermissionsCtrl.close()" ui-sref="types">CANCEL</button>
    </div>
</script> -->

<!-- <script type="text/ng-template" id="delete-type-modal">
    <div class="modal-header">
        <h3 class="modal-title" id="modal-title"><%PermissionsCtrl.collection.type_code%></h3>
    </div>
    <div class="modal-body" id="modal-body">
    <form ng-model="employeeDetails">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for=""><h5>Are you sure you want to delete this record ? </h5></label>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="">Type :</label>
                                <label for=""><%PermissionsCtrl.collection.type_desc%></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" ng-click="PermissionsCtrl.deleteTypeBtn(PermissionsCtrl.collection)">SUBMIT</a>
        <a href="#" class="btn btn-warning" ng-click="PermissionsCtrl.close()">CANCEL</a>
    </div>
</script> -->