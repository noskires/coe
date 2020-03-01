<div class="main">
    <div class="container-fluid">
        <!-- /# row -->
        <section id="main-content"> 
            <div class="row">    
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-title pr">
                            <h4>Create New Purpose Type</h4>
                        </div>
                        <div class="card-body">
                            <form ng-model="employeeDetails">
                                
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="">Type</label>
                                        <select class="form-control coe-type-selection" ng-model="purposeDetails.type_code" style="width:95%" >
                                            <option value=''>- - - SELECT TYPE - - - </option>  
                                            <option ng-value='coeType.type_code' ng-repeat="coeType in purposeCtrl.coeTypes"><%coeType.type_desc%></option> 
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">Purpose Name</label>
                                        <input type="text" class="form-control" placeholder="Purpose Name" ng-model="purposeDetails.purpose_desc">
                                    </div>
                                </div>
                                <br> 
                                <button type="submit" class="btn btn-primary" ng-click="purposeCtrl.createPurposeBtn(purposeDetails)" style="margin-top:12px;">SUBMIT</button>
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
                            <h4>COE Purposes</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table datatable="ng" id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Purpose Code</th>
                                            <th>COE Type</th>
                                            <th>Purpose Type</th>
                                            <th>Show in self service</th>
                                            <th>Show in original signature</th>
                                            <th>Created By</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="purpose in purposeCtrl.purposes">
                                            <td><%purpose.purpose_code%></td>
                                            <td><%purpose.type_desc%></td>
                                            <td><%purpose.purpose_desc%></td>
                                            <td><%purpose.self_service%></td>
                                            <td><%purpose.original_signature%></td>
                                            <td><%purpose.created_by%></td> 
                                            <td>
                                                <a href="#" class="btn btn-primary btn-xs" ui-sref="purpose-edit({purpose_code_edit:purpose.purpose_code})">Edit</a>
                                                <a href="#" class="btn btn-danger btn-xs" ui-sref="purpose-delete({purpose_code_delete:purpose.purpose_code})">Remove</a>
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

<script type="text/ng-template" id="edit-purpose-modal">
 
    <div class="modal-header">
        <h3 class="modal-title" id="modal-title"><%purposeCtrl.collection.purpose_code%></h3>
    </div>
    <div class="modal-body" id="modal-body">
    <form ng-model="purposeDetails">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="">Purpose Type</label>
                                <input type="text" class="form-control" placeholder="Purpose Type" ng-model="purposeCtrl.collection.purpose_desc">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Show in self service</label>
                                <select class="form-control" ng-model="purposeCtrl.collection.self_service" style="width:95%" >
                                    <option value=''>- - - SELECT - - - </option>  
                                    <option value='1'>Yes</option> 
                                    <option value='0'>No</option> 
                                </select> 
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Show in original signature</label>
                                <select class="form-control" ng-model="purposeCtrl.collection.original_signature" style="width:95%" >
                                    <option value=''>- - - SELECT - - - </option>  
                                    <option value='1'>Yes</option> 
                                    <option value='0'>No</option> 
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" ng-click="purposeCtrl.updatePurposeBtn(purposeCtrl.collection)">SUBMIT</button>
        <button type="submit" class="btn btn-warning" ng-click="purposeCtrl.close()" ui-sref="purposes">CANCEL</button>
    </div>
</script>

<script type="text/ng-template" id="delete-purpose-modal">
    <div class="modal-header">
        <h3 class="modal-title" id="modal-title"><%purposeCtrl.collection.purpose_code%></h3>
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
                                <label for="">Purpose Type :</label>
                                <label for=""><%purposeCtrl.collection.purpose_desc%></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" ng-click="purposeCtrl.deletePurposeBtn(purposeCtrl.collection)">SUBMIT</a>
        <a href="#" class="btn btn-warning" ng-click="purposeCtrl.close()" ui-sref="purposes">CANCEL</a>
    </div>
</script>