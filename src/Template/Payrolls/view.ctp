    <div class="row">
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3>Payroll Record</h3>
                    <?php if ($payroll != null) { ?>
                        <span>DATE : <span class="text-danger"> <?= $payroll->start_date?> - <?= $payroll->end_date?> </span> </span>
                    <?php } ?>
                    <!-- <a href="/payrolls/generate/<?= $seconds.".pdf"?>" class="btn btn-sm btn-info pull-right">PDF Version</a>     -->
                    <?= $this->Html->link('PDF Version',['controller' => 'payrolls','action' => 'generate',$seconds.'.pdf'],['escape' => false,'class' => 'btn btn-sm btn-info pull-right']) ?>
                    
                </div>
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
                            
                            <div class="col-md-6 mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="is_thirteen_month_pay" value="true">
                                    <label class="custom-control-label" for="customCheck1">13 Month Pay</label>
                                </div>
                            </div>

                        <?= $this->Form->submit('SAVE',['class' => 'btn btn-primary']) ?>
                            
                        <?= $this->Form->end() ?>

                    
                    <?php } else { ?>
                        <div class="table-responsive">
                            <table class="table text-center">
                                <thead class="text-uppercase bg-primary">
                                    <tr class="text-white"> 
                                        <th>#ID</th>
                                        <th>Name</th>
                                        <th>PER/HR</th>
                                        <th>TWH</th>
                                        <th>WH</th>
                                        <th>Late & Absent</th>
                                        <!-- <th>Late</th>
                                        <th>Days of Absent</th> -->
                                        <th>OT</th>
                                        <th>Total Deduction</th>
                                        <!-- <th>SSS</th>
                                        <th>PAGIBIG</th>
                                        <th>PHILHEALTH</th>  -->
                                        <th>Benefits Deduction</th> 
                                        <th>Salary</th>
                                        <?php if($payroll->is_thirteen_month_pay) { ?>
                                            <th>13 MP</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($output as $item): ?>
                                        <tr>
                                            <?php 
                                                $offset = date_create($payroll->start_date);
                                                $end = date_create($payroll->end_date);
                                                $interval = date_diff($offset, $end);
                                                $daysLapse = $interval->format('%d');
                                                $hoursPerDay = 8;

                                                $totalWorkingHours = ($daysLapse + 1 ) * $hoursPerDay;
                                                

                                                $myWorkingHours = $item['twh'] > $totalWorkingHours ? $totalWorkingHours : $item['twh'] ;
                                                // $myWorkingHours = $item['twh'];
                                                // Salary

                                                // OT 
                                                $ot = $item['twh'] - $myWorkingHours;                                

                                                $lateAndAbsentHrs = $totalWorkingHours - $myWorkingHours;

                                                $salary = $myWorkingHours * $item['user']->rate_per_hour;
                                                
                                                
                                                $benefits_deduction = 0;

                                                // BENEFITS VALUES
                                                $SSS = 150;
                                                $PAGIBIG = 50;
                                                $PHILHEALTH = 68.75;

                                                if($item['user']->sss) 
                                                    $benefits_deduction += $SSS;
                                                
                                                if($item['user']->pagibig)
                                                    $benefits_deduction += $PAGIBIG;

                                                if($item['user']->philhealth) 
                                                    $benefits_deduction += $PHILHEALTH;

                                                
                                                $total_deduction = ($totalWorkingHours * $item['user']->rate_per_hour) - $salary;

                                                // if is thirteen month pay

                                                $bonus = 0;

                                                if($payroll->is_thirteen_month_pay) { 
                                                    $user_start_date = date_create($item['user']->created);
                                                    $end_date = date_create($payroll->start_date);
                                                    
                                                    $interval = date_diff($user_start_date, $end_date);
                                                    
                                                    $employed_months = $interval->format('%m');
    
                                                    $bonus = ( ($item['user']->rate_per_hour  * 8 * 30) * $employed_months )/ 12;
                                                }
                                                
                                                $salary -= $benefits_deduction;

                                                $ot_value = 33 * $ot;

                                                $salary += $ot_value + $bonus;
                                                
                                                // debug($interval);
                                                // $datetime2 = date_create($date_2);
                                            ?>
                                        
                                            <td>
                                                <?= $this->Html->link('EMP_'.$item['user_id'],['controller' => 'users','action' => 'view',$item['user_id']],['escape' => false]) ?>
                                            </td>
                                            
                                            <td>
                                                <?= $this->Html->link(ucwords( $item['user']->firstname ." ". $item['user']->lastname ),['controller' => 'users','action' => 'view',$item['user_id']],['escape' => false]) ?>
                                            </td>
                                            <td class="text-success"> ₱ <?= number_format((float)$item['user']->rate_per_hour, 2, '.', '') ?> </td>
                                            <td> <?= $totalWorkingHours ?> </td>
                                            <td>
                                                <?= $this->Html->link($myWorkingHours,['controller' => 'payrolls','action' => 'logs',$item['user_id'],$seconds],['escape' => false]) ?>
                                            </td>
                                            <td> <?= $lateAndAbsentHrs ?> hrs</td>
                                            <td> <?= $ot ?> hrs </td>
                                            <td> ₱<?= number_format((float)$total_deduction, 2, '.', '') ?> </td>
                                            <!-- <td> ₱ <?php if($item['user']->sss) echo number_format((float)$SSS, 2, '.', '');?></td>
                                            <td> ₱ <?php if($item['user']->pagibig) echo number_format((float)$PAGIBIG, 2, '.', '');?></td>
                                            <td> ₱ <?php if($item['user']->philhealth) echo number_format((float)$PHILHEALTH, 2, '.', '');?></td> -->
                                            <td>₱<?= $benefits_deduction?></td>
                                            <td class="text-danger"> ₱<?= number_format((float) $salary, 2, '.', '') ?> </td>

                                            <?php if($payroll->is_thirteen_month_pay) { ?>
                                                <td>₱ <?= number_format((float)$bonus, 2, '.', '') ?> </td>
                                            <?php } ?>
                                            <!-- <td><a href="#" class="btn btn-sm btn-success">Details</a></td> -->
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
