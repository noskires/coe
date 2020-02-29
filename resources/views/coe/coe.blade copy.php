
<style type="text/css">
  #watermark {
    position: fixed;
 
    width: 100%;
    text-align: center;
    opacity: .3; 
    transform-origin: 50% 50%;
    z-index: -1000;
  }

  #watermark2 {
    position: fixed;
    top: 35%;
    font-size:50px;
    width: 100%;
    text-align: center;
    opacity: .6; 
    transform-origin: 50% 50%;
    z-index: -1000;
  }
</style>

<div class="main">

    <!-- <div id="watermark2">
        <img src="{{URL::to('assets/images/Logo PLDT.jpg')}}" style="height:700px;margin-top:-60px; margin-left:-200px;"/>
    </div> -->
    
    <!-- <div class="container-fluid"  style="background-image: url('http://svrmdbhris02/online-coe/assets/images/bg1.png');display: block;margin-left: auto;margin-right: auto;"> -->
    <div class="container-fluid">
        <section id="main-content">
            
            <div class="row">
            
                <div class="col-lg-12">
                    <div class="card">
                    
                        <!-- <div class="card-title pr">
                            <h4>Create New</h4>
                        </div> -->
                        <div class="card-body">
                            <form ng-model="employeeDetails">
                                <div class="form-row" style="border:red;">
                                    <div class="form-group col-md-4">
                                        <label for="">TYPE OF CERTIFICATE</label>
                                        <select class="form-control coe-type-selection" ng-model="coeCtrl.coeDetails.coe_type" style="width:95%" ng-change="coeCtrl.selectCoeType(coeCtrl.coeDetails.coe_type)" required>
                                            <option value=''>- - - SELECT TYPE - - - </option>   
                                            <option ng-value='coeType.type_code' ng-repeat="coeType in coeCtrl.coeTypes" ng-bind="coeType.type_desc"><%coeType.type_desc%></option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">PURPOSE</label>
                                        <select class="form-control coe-purposes-selection" ng-model="coeCtrl.coeDetails.coe_purpose" style="width:95%" required>
                                            <option value=''>- - - SELECT PURPOSE - - - </option>  
                                            <option ng-value='purpose.purpose_code' ng-repeat="purpose in coeCtrl.purposes" ng-bind="purpose.purpose_desc | uppercase"><%purpose.purpose_desc | uppercase%></option> 
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3" ng-if="coeCtrl.is_salary_option">
                                        <label for="">SALARY OPTION</label>
                                        <select class="form-control coe-purposes-selection" ng-model="coeCtrl.coeDetails.salary_option" style="width:95%" required>
                                            <option value=''>- - - SELECT SALARY OPTION- - - </option>   
                                            <option ng-value='salary_option.id' ng-repeat="salary_option in coeCtrl.salary_options" ng-bind="salary_option.text | uppercase"><%salary_option.text | uppercase%></option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <!-- <button type="submit" class="btn btn-primary" ng-click="coeCtrl.createCoeBtn(coeCtrl.coeDetails)" style="margin-top:12px;background: linear-gradient(to right, rgb(211, 73, 91) , rgb(250, 8, 8));border-color:rgb(168, 5, 52);">SUBMIT</button> -->
                                <button type="submit" class="btn btn-danger" ng-click="coeCtrl.createCoeBtn(coeCtrl.coeDetails)" style="margin-top:12px;">SUBMIT</button>
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
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" datatable="ng" dt-instance="tc.dtInstance" dt-options="tc.dtOptions" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>REFERENCE #</th>
                                            <th>TYPE</th>
                                            <th>PURPOSE</th>
                                            <th>SALARY OPTION</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="coe in coeCtrl.coe">
                                            <td ng-bind="coe.v_id"><%coe.v_id%></td>
                                            <td ng-bind="coe.coe_code"><%coe.coe_code%></td>
                                            <td ng-bind="coe.type_desc"><%coe.type_desc%></td>
                                            <td ng-bind="coe.purpose_desc | uppercase"><%coe.purpose_desc | uppercase%></td> 
                                            <td ng-bind="coe.is_salary_confidential01 | uppercase"><%coe.is_salary_confidential01 | uppercase%></td> 
                                            <td>
                                                <a href="#" ng-if="coe.is_self_service == 1" class="btn btn-danger btn-xs" ng-click="coeCtrl.printCoeBtn(coe.coe_code)" style="margin-top:12px;">PRINT PREVIEW</a>
                                                <a href="#" ng-if="coe.is_self_service == 0" class="btn btn-danger btn-xs" ng-click="coeCtrl.printCoeOriginalSigBtn(coe.coe_code)" style="margin-top:12px;">VIEW DETAILS</a>
                                                <a href="#" class="btn btn-danger btn-xs" ng-click="coeCtrl.viewCoeOriginalSigBtn(coe.coe_code)" style="margin-top:12px;">VIEW DETAILS - Admin</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <!-- /# row --> 
        </section>
    </div>
</div>

<script type="text/javascript">
    
    $(function() {
        $(".coe-type-selection").select2();
        $(".coe-purposes-selection").select2();
    });

</script>

<script type="text/ng-template" id="coe-view-modal">
    <div class="modal-header">
        <h3 class="modal-title" id="modal-title"><%coeCtrl.collection.coe_code%></h3>
    </div>
    <div class="modal-body" id="modal-body">
        
    </div>
    <div class="modal-footer">
        <!-- <button type="submit" class="btn btn-primary" ng-click="purposeCtrl.updatePurposeBtn(purposeCtrl.collection)">SUBMIT</button>
        <button type="submit" class="btn btn-warning" ng-click="purposeCtrl.close()" ui-sref="purposes">CANCEL</button> -->
    </div>
</script>
