<div class="main-content-inner">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-ml-12">
            <div class="row">
                <!-- Textual inputs start -->
                <div class="col-3 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Create New Purpose Type</h4>
                            <div class="form-group">
                                <label class="col-form-label">Type of Certificate</label>
                                <select class="form-control" ng-model="purposeDetails.type_code" style="width:95%" >
                                    <option value=''>- - - SELECT TYPE - - - </option>  
                                    <option ng-value='coeType.type_code' ng-repeat="coeType in purposeCtrl.coeTypes"><%coeType.type_desc%></option> 
                                </select>
                            </div> 
                            <div class="form-group">
                                <label class="col-form-label">Purpose Name</label>
                                <input class="form-control form-control-md" ng-model="purposeDetails.purpose_desc" type="text">
                            </div>
                            <b class="text-muted mb-3 mt-4 d-block">Show in self survice</b>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" checked id="selfservice_yes" name="selfservice" class="custom-control-input" value=1 ng-model="purposeDetails.self_service">
                                <label class="custom-control-label" for="selfservice_yes">YES</label>
                            </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="selfservice_no" name="selfservice" class="custom-control-input" value=0 ng-model="purposeDetails.self_service">
                                <label class="custom-control-label" for="selfservice_no">NO</label>
                            </div>
                                
                            <b class="text-muted mb-3 mt-4 d-block">Show in original signature</b>

                            <input type="radio" id="general<%general.id%>" name="general" class="custom-control-input" ng-value="general.id" 
                            ng-init="classificationsCtrl.collection.general=classificationsCtrl.collection.general||1" ng-model="classificationsCtrl.collection.general">

                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" checked id="originalsignature_yes" name="originalsignature" class="custom-control-input" value=1 ng-model="purposeDetails.original_signature">
                                <label class="custom-control-label" for="originalsignature_yes">YES</label>
                            </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" checked id="originalsignature_no" name="originalsignature" class="custom-control-input" value=0 ng-model="purposeDetails.original_signature">
                                <label class="custom-control-label" for="originalsignature_no">NO</label>
                            </div>	 	
                            <BR>	
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" ng-click="purposeCtrl.createPurposeBtn(purposeDetails)">Submit</button>
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
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>Purpose Code</th>
                                            <th>COE Type</th>
                                            <th>Purpose Type</th>
                                            <th>Show in self survice</th>
                                            <th>Show in original signature</th>
                                            <th>Created by</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="purpose in purposeCtrl.purposes">
                                            <td ng-bind="purpose.purpose_code"> </td>
                                            <td ng-bind="purpose.type_desc"> </td>
                                            <td ng-bind="purpose.purpose_desc"> </td>
                                            <td ng-bind="purpose.self_service"> </td>
                                            <td ng-bind="purpose.original_signature"> </td>
                                            <td ng-bind="purpose.created_by"> </td> 
                                            <td valign="middle"> <a href="#" title="edit" ui-sref="purpose-edit({purpose_code_edit:purpose.purpose_code})"> <i class="ti-pencil"></i> </a> | 
                                                <a href="#" title="delete" ui-sref="purpose-delete({purpose_code_delete:purpose.purpose_code})"> <i class="ti-trash"></i> </a> </td>
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
                                    <option ng-value='1'>Yes</option> 
                                    <option ng-value='0'>No</option> 
                                </select> 
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Show in original signature</label>
                                <select class="form-control" ng-model="purposeCtrl.collection.original_signature" style="width:95%" >
                                    <option value=''>- - - SELECT - - - </option>  
                                    <option ng-value='1'>Yes</option> 
                                    <option ng-value='0'>No</option> 
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
        <button type="submit" class="btn btn-xs btn-primary" ng-click="purposeCtrl.updatePurposeBtn(purposeCtrl.collection)">SUBMIT</button>
        <button type="submit" class="btn btn-xs btn-warning" ng-click="purposeCtrl.close()" ui-sref="purposes">CANCEL</button>
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