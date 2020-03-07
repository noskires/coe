<style type="text/css">
    .red{
        border:red;
        color:red;
    }

    .td1{
        color:#000000;
        padding:10px; 
    }
</style>

<div class="main">
    <div class="container-fluid">
        <section id="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <br>
                    <div class="card-body">
                        <table width="100%" border=0 class="red">
                            <tr>
                                <td align="right" class="td1">  
                                    <label for="">REFERENCE</label>
                                </td>
                                <td>
                                    <input type="text" class="form-control" ng-model="coeCtrl.coe.coe_code" disabled/> 
                                </td>
                                <td align="right" class="td1">  
                                    <label for="">ASSIGNED TO</label>
                                </td>
                                <td>    
                                    <input type="text" class="form-control" ng-model="coeCtrl.coe.changed_by" disabled/> 
                                </td>
                                <td width="10%"></td>
                            </tr>
                            <tr>
                                <td align="right" class="td1">  
                                    <label for="">EE NO</label>
                                </td>
                                <td>    
                                    <input type="text" class="form-control" ng-model="coeCtrl.coe.employee_code" disabled/> 
                                </td>
                                <td align="right" class="td1">  
                                    <label for="">TYPE</label>
                                </td>
                                <td>    
                                    <input type="text" class="form-control" ng-model="coeCtrl.coe.type_desc" disabled/> 
                                </td>
                                <td width="10%"></td>
                            <tr>
                                <td align="right" class="td1">  
                                    <label for="">EE NAME</label>
                                </td>
                                <td>    
                                    <input type="text" class="form-control" ng-model="coeCtrl.coe.name" disabled=""/> 
                                </td>
                                <td align="right" class="td1">  
                                    <label for="">PURPOSE</label>
                                </td>
                                <td>    
                                    <input type="text" class="form-control" ng-value="coeCtrl.coe.purpose_desc | uppercase" disabled/> 
                                </td>
                                <td width="10%"></td>
                            </tr>
                            <tr>
                                <td align="right" class="td1">  
                                    <label for="">EE GROUP</label>
                                </td>
                                <td>    
                                    <input type="text" class="form-control" ng-model="coeCtrl.coe.employee_group" disabled/> 
                                </td>
                                <td align="right" class="td1">  
                                    <label for="">STATUS</label>
                                </td>
                                <td> 
                                    <input type="text" class="form-control" disabled ng-value="coeCtrl.status_item.short_desc | uppercase"/> 
                                </td> 
                            </tr>
                        </table>
                    </div>
                    <!-- </div> -->
                </div> 
            </div>

            <br>
            <hr>
            <br>
            <div class="row">    
                <div class="col-lg-12">  
                        <div class="card-body"> 
                            <form ng-model="employeeDetails">
                                <div class="form-row">

                                    <div class="form-group col-md-3">
                                        <label for="">STATUS</label>
                                        <select class="form-control coe-type-selection" ng-model="coeCtrl.coe.status_code">
                                            <option value=''>- - - SELECT TYPE - - - </option>   
                                            <option ng-value='reply_status.code' ng-repeat="reply_status in coeCtrl.reply_statuses"><%reply_status.desc%></option>
                                        </select>
                                    </div> 

                                    <div class="form-group col-md-4">
                                        <label for="">ADD COMMENTS</label>
                                        <textarea class="form-control" ng-model="coeCtrl.coe.remarks">
                                        </textarea>
                                    </div> 

                                </div>
                                <br> 
                                <button type="submit" class="btn btn-danger" ng-click="coeCtrl.updateCoeOriginalSigBtn(coeCtrl.coe)" style="margin-top:12px;">SUBMIT</button>
                            </form>
                        </div> 
                </div> 
            </div>
            <br>
            <hr>
            <br>
            
            <div class="row">    
                <div class="col-lg-12">
                    <div class="card-body">
                        <table class="table" datatable="ng" dt-instance="tc.dtInstance" dt-options="tc.dtOptions" style="width:100%">
                            <thead>
                                <tr> 
                                    <td>Count</td>
                                    <td>Status Desc</td>
                                    <!-- <td>Status Desc2</td> -->
                                    <td>Status User Type</td>
                                    <td>Status User Type Id</td>
                                    <td>Status Remarks</td>
                                    <td>Date</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="status_item in coeCtrl.status_items"> 
                                    <td><%status_item.sorter%></td>
                                    <td><%status_item.short_desc%></td>
                                    <!-- <td><%status_item.long_desc%></td> -->
                                    <td><%status_item.user_type%></td>
                                    <td><%status_item.user_type_id%></td>
                                    <td><%status_item.remarks%></td>
                                    <td><%status_item.created_at%></td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                    <!-- </div> -->
                </div>
                <!-- /# column -->
            </div>


        </section>
    </div>
</div>

<script type="text/javascript">
    
    $(function() {
        $(".coe-type-selection").select2();
        $(".coe-purposes-selection").select2();
    });

</script>

 