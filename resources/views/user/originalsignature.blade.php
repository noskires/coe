<div class="main-content-inner">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-ml-12">
            <div class="row">
                <!-- Textual inputs start -->
                <div class="col-3 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Original Signature</h4>
                            <div class="form-group">
                                <label class="col-form-label">Type of Certificate</label>
                                <select class="form-control">
                                    <option>Select</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Purpose</label>
                                <select class="form-control">
                                    <option>Select</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Salary Option</label>
                                <select class="form-control">
                                    <option>Select</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="example-text-input-lg" class="col-form-label">Remarks</label>
                                <input class="form-control form-control-lg" type="text" id="example-text-input-lg">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
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
                                            <th>#</th>
                                            <th>Reference</th>
                                            <th>Type</th>
                                            <th>Purpose</th>
                                            <th>Salary Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="sample in CoeCtrl.samples">
                                            <td>1</td>
                                            <td>123123123</td>
                                            <td>Certificate of Employment</td>
                                            <td>Credit Card Application</td>
                                            <td>Confidential</td>
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
