<h3><?= $date?></h3>
<h1>BIOSys 2018</h1>
<div class="row">
    <div class="col-lg-12 mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Payroll Record</h3>
                <?php if ($payroll != null) { ?>
                    <span>DATE : <span class="text-danger"> <?= $payroll->start_date?> - <?= $payroll->end_date?> </span> </span>
                <?php } ?>
            </div>
            <div class="card-body">
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
                                <th>OT</th>
                                <th>Total Deduction</th>
                                <th>SSS</th>
                                <th>PAGIBIG</th>
                                <th>PHILHEALTH</th> 
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
                                        // Salary

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
                                    <td><a href="/users/view/<?= $item['user_id']?>"> EMP_<?= $item['user_id'] ?> </a></td>
                                    <td><a href="/users/view/<?= $item['user_id']?>"> <?= ucwords( $item['user']->firstname ." ". $item['user']->lastname ) ?> </a></td>
                                    <td class="text-success"> P <?= number_format((float)$item['user']->rate_per_hour, 2, '.', '') ?> </td>
                                    <td> <?= $totalWorkingHours ?> </td>
                                    <td> <?= $myWorkingHours ?> </td>
                                    <td> <?= $lateAndAbsentHrs ?> </td>
                                    <td> <?= $ot ?> hrs </td>
                                    <td> P <?= number_format((float)$total_deduction, 2, '.', '') ?> </td>
                                    <td> P <?php if($item['user']->sss) echo $SSS;?></td>
                                    <td> P <?php if($item['user']->pagibig) echo $PAGIBIG;?></td>
                                    <td> P <?php if($item['user']->philhealth) echo $PHILHEALTH;?></td>
                                    <td> P <?= $benefits_deduction?></td>
                                    <td class="text-danger"> P<?= number_format((float) $salary, 2, '.', '') ?> </td>
                                    <?php if($payroll->is_thirteen_month_pay) { ?>
                                        <td>P <?= number_format((float)$bonus, 2, '.', '') ?> </td>
                                    <?php } ?>
                                    <!-- <td><a href="#" class="btn btn-sm btn-success">Details</a></td> -->
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
