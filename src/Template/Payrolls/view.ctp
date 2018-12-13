<div class="row">
    <div class="col-lg-12 mt-5">
        <div class="card">
            <div class="card-header"><h3>Payroll Record</h3></div>
            <div class="card-body">
                <?php if($payroll == null) { ?>
                    <h5>It appears that you don't have any payroll record to this date. Add one now!</h5><br>

                    <?= $this->Form->create(null,['controller' => 'payrolls','action' => 'add', 'type' => 'file']) ?>
                        <br>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01" name="payroll_file">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-form-label">Start Date</label>
                                    <input class="form-control" type="date" value="2018-03-05" id="example-date-input" name="start_date">
                                </div>    
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="example-date-input" class="col-form-label">End Date</label>
                                    <input class="form-control" type="date" value="2018-03-05" id="example-date-input" name="end_date">
                                </div>    
                            </div>
                        </div>

                        <input type="hidden" value="<?= $date ?>" name="bill_date">

                    <?= $this->Form->submit('SAVE',['class' => 'btn btn-primary']) ?>
                        
                    <?= $this->Form->end() ?>

                  
                <?php } else { ?>
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-uppercase bg-primary">
                                <tr class="text-white">
                                    <th>ID</th>
                                    <th>EMPLOYEE ID</th>
                                    <th>Full Name</th>
                                    <th>Work Hours</th>
                                    <th>Target Work Hours</th>
                                    <th>Deduction</th>
                                    <th>SSS</th>
                                    <th>PAGIBIG</th>
                                    <th>GSIS</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
