<div class="main">
    <div class="container-fluid">
        <div class="row">
            <!-- <div class="col-lg-8 p-r-0 title-margin-right">
                <div class="page-header">
                    <div class="page-title">
                        <h1>Hello! <span>Welcome, Erik.</span></h1>
                    </div>
                </div>
            </div> -->
            <!-- /# column -->
            <!-- <div class="col-lg-4 p-l-0 title-margin-left">
                <div class="page-header">
                    <div class="page-title">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Locations</li>
                        </ol>
                    </div>
                </div>
            </div> -->
            <!-- /# column -->
        </div>
        <!-- /# row -->
        <section id="main-content">
      

            <div class="row">    
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-title pr">
                            <h4>Audits/Logs</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table datatable="ng" id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <!-- <th>User Type</th> -->
                                            <th>User</th>
                                            <th>Event</th>
                                            <th>Event ID</th>
                                            <th>Table</th>
                                            <th>Old Values</th>
                                            <th>New Values</th>
                                            <th>Created At</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="audit in auditCtrl.audits">
                                            <td><%audit.id%></td>
                                            <!-- <td><%audit.user_type%></td> -->
                                            <td><%audit.email%></td>
                                            <td><%audit.event%></td>
                                            <td><%audit.auditable_type%></td>
                                            <td><%audit.auditable_id%></td>
                                            <td><%audit.old_values%></td>
                                            <td><%audit.new_values%></td>
                                            <td><%audit.created_at%></td> 
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="footer">
                        <!-- <p>2018 © LawSys by <a href="http://bizlogiks.ph">Bizlogiks</a></p> -->
                    </div>
                </div>
            </div>

            <div id="search">
                <button type="button" class="close">×</button>
                <form>
                    <input type="search" value="" placeholder="type keyword(s) here" />
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </section>
    </div>
</div>

<script type="text/ng-template" id="edit-location-modal">
    <div class="modal-header">
        <h3 class="modal-title" id="modal-title"><%locationCtrl.collection.document_code%></h3>
    </div>
    <div class="modal-body" id="modal-body">
    <form ng-model="locationDetails">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Location</label>
                                <input type="text" class="form-control" placeholder="Location" ng-model="locationCtrl.collection.location_desc">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">City</label>
                                <input type="text" class="form-control" placeholder="City" ng-model="locationCtrl.collection.city">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" ng-click="locationCtrl.updateLocationBtn(locationCtrl.collection)">SUBMIT</button>
        <button type="submit" class="btn btn-warning" ng-click="locationCtrl.close()" ui-sref="documents">CANCEL</button>
    </div>
</script>

<script type="text/ng-template" id="delete-location-modal">
    <div class="modal-header">
        <h3 class="modal-title" id="modal-title"><%locationCtrl.collection.location_code%></h3>
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
                                <label for="">Location Name :</label>
                                <label for=""><%locationCtrl.collection.location_desc%></label>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">City :</label>
                                <label for=""><%locationCtrl.collection.city%></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary" ng-click="locationCtrl.deleteLocationBtn(locationCtrl.collection)">SUBMIT</a>
        <a href="#" class="btn btn-warning" ng-click="locationCtrl.close()" ui-sref="locations">CANCEL</a>
    </div>
</script>