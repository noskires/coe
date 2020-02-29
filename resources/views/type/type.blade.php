<div class="main">
    <div class="container-fluid">
        <!-- /# row -->
        <section id="main-content"> 
            <div class="row">    
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-title pr">
                            <h4>Create New Type</h4>
                        </div>
                        <div class="card-body">
                            <form ng-model="employeeDetails">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="">Type Name</label>
                                        <input type="text" class="form-control" placeholder="Type Name" ng-model="typeDetails.type_desc">
                                    </div>
                                </div>
                                <br> 
                                <button type="submit" class="btn btn-primary" ng-click="typeCtrl.createTypeBtn(typeDetails)" style="margin-top:12px;">SUBMIT</button>
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
                        <div class="card-title pr">
                            <h4>Types</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table datatable="ng" id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Type Code</th>
                                            <th>Type Desc</th>
                                            <th>Created By</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="type in typeCtrl.types">
                                            <td><%type.type_code%></td>
                                            <td><%type.type_desc%></td>
                                            <td><%type.created_by%></td> 
                                            <td>
                                                <a href="#" class="btn btn-primary btn-xs" ui-sref="type-edit({type_code_edit:type.type_code})">Edit</a>
                                                <a href="#" class="btn btn-danger btn-xs" ui-sref="type-delete({type_code_delete:type.type_code})">Remove</a>
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

<script type="text/ng-template" id="edit-type-modal">
    <div class="modal-header">
        <h3 class="modal-title" id="modal-title"><%typeCtrl.collection.type_code%></h3>
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
                                <input type="text" class="form-control" placeholder="Type" ng-model="typeCtrl.collection.type_desc">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" ng-click="typeCtrl.updateTypeBtn(typeCtrl.collection)">SUBMIT</button>
        <button type="submit" class="btn btn-warning" ng-click="typeCtrl.close()" ui-sref="types">CANCEL</button>
    </div>
</script>

<script type="text/ng-template" id="delete-type-modal">
    <div class="modal-header">
        <h3 class="modal-title" id="modal-title"><%typeCtrl.collection.type_code%></h3>
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
                                <label for=""><%typeCtrl.collection.type_desc%></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" ng-click="typeCtrl.deleteTypeBtn(typeCtrl.collection)">SUBMIT</a>
        <a href="#" class="btn btn-warning" ng-click="typeCtrl.close()" ui-sref="types">CANCEL</a>
    </div>
</script>