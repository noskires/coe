<div class="main-content-inner">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-ml-12">
            <div class="row">
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <!-- <h4 class="header-title">Table</h4> -->
                            <div class="table-responsive data-tables datatable-dark">
                                <table datatable="" dt-options="AssignedToMeCtrl.dtOptions" dt-columns="AssignedToMeCtrl.dtColumns" dt-instance="AssignedToMeCtrl.dtInstance" class="table table-bordered table-hover table-md" ></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/ng-template" id="view-status-admin-modal"> 
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">REFERENCE#: <%AssignedToMeCtrl.coe.coe_code%></h5>
            <a href="assigned-to-me/{{Crypt::encrypt(Auth::user()->email)}}" class="close" ng-click="AssignedToMeCtrl.close()"><span>&times;</span></a>
        </div>
        <div class="modal-body">
            <div class="form-row"> 
                <div class="col-md-6 mb-3">
                    <label for="validationCustom02">EE No.</label>
                    <input type="text" class="form-control" disabled="true" ng-model="AssignedToMeCtrl.coe.name | uppercase">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationCustom02">EE Name</label>
                    <input type="text" class="form-control" disabled="true" ng-model="AssignedToMeCtrl.coe.employee_code | uppercase">
                </div>
            </div>
            <div class="form-row"> 
                <div class="col-md-6 mb-3">
                    <label for="validationCustom02">EE Group</label>
                    <input type="text" class="form-control" disabled="true" ng-model="AssignedToMeCtrl.coe.employee_group | uppercase">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationCustom02">EE Subgroup</label>
                    <input type="text" class="form-control" disabled="true" ng-model="AssignedToMeCtrl.coe.employee_subgroup | uppercase">
                </div>
            </div>
            <div class="form-row"> 
                <div class="col-md-6 mb-3">
                    <label for="validationCustom02">TYPE</label>
                    <input type="text" class="form-control" disabled="true" ng-model="AssignedToMeCtrl.coe.type_desc | uppercase">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationCustom02">PURPOSE</label>
                    <input type="text" class="form-control" disabled="true" ng-model="AssignedToMeCtrl.coe.purpose_desc | uppercase">
                </div>
            </div>
            <div class="form-row">
            <div class="col-md-6 mb-3">
                    <label for="validationCustom02">ASSIGNED TO</label>
                    <input type="text" class="form-control" disabled="true" ng-model="AssignedToMeCtrl.coe.changed_by | uppercase">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationCustom02">STATUS</label>
                    <input type="text" class="form-control" disabled="true" ng-model="AssignedToMeCtrl.status_item.short_desc | uppercase" >
                </div>
            </div> 
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label class="col-form-label">STATUS</label> 
                    <select class="custom-select coe-reply_status" ng-model="AssignedToMeCtrl.coe.status_code">
                        <option value=''>- - - SELECT TYPE - - - </option>   
                        <option ng-value='reply_status.code' ng-repeat="reply_status in AssignedToMeCtrl.reply_statuses"><%reply_status.desc%></option>
                    </select>
                </div>
                <div class="col-md-8 mb-3">
                    <label for="comment" class="col-form-label">ADD COMMENTS</label>
                    <input class="form-control form-control-lg" type="text" placeholder="Comment here..." id="comment" ng-model="AssignedToMeCtrl.coe.remarks">
                </div>
                <div class="col-md-12 mb-3">
                    <button type="button" class="btn btn-primary" ng-click="AssignedToMeCtrl.updateCoeOriginalSigBtn(AssignedToMeCtrl.coe)">Submit comments</button>
                </div>
            </div> 
            
            <ul class="timeline" ng-repeat="status_item in AssignedToMeCtrl.status_items">
                <li class="timeline-inverted" ng-if="status_item.user_type=='FULFILLER'">
                    <div class="timeline-badge info"><i class="fa fa-lg fa-comment"></i></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                        <h5 class="timeline-title"><%status_item.short_desc%></h5><p>( <%status_item.user_type%> <small class="text-muted"><i class="glyphicon glyphicon-time"></i> <%status_item.created_at%> </small> )</p>
                        </div>
                        <div class="timeline-body">
                        <p><%status_item.remarks%></p>
                        </div>
                    </div>
                </li> 
                <li ng-if="status_item.user_type=='EMPLOYEE'">
                    <div class="timeline-badge"><i class="fa fa-lg fa-comment"></i></div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                        <h5 class="timeline-title"><%status_item.short_desc%></h5><p>( <%status_item.user_type%> <small class="text-muted"><i class="glyphicon glyphicon-time"></i> <%status_item.created_at%> </small> )</p>
                        </div>
                        <div class="timeline-body">
                        <p><%status_item.remarks%></p>
                        </div>
                    </div>
                </li> 
            </ul>
        </div> 
    </div> 
</script>