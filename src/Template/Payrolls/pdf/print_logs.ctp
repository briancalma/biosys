<h3><?= $date?></h3>
<h1>BIOSys 2018</h1>
<div class="row">
    <div class="col-lg-12 mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Payroll Record</h3>
                <?php if ($payroll != null) { ?>
                    <span>DATE : <span class="text-danger"> <?= $payroll->start_date?> - <?= $payroll->end_date?> </span> </span>
                    <span>EMPLOYEE : <span class="text-danger"> <?= ucwords( $employee['firstname']." ".$employee['lastname'] ) ?> </span> </span>
                <?php } ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead class="text-uppercase bg-primary">
                            <tr class="text-white"> 
                                <th colspan="3">AM</th>
                                <th colspan="4">PM</th>
                            </tr>
                            <tr>
                                <th>DATE</th>
                                <th>LOGIN</th>
                                <th>LOGOUT</th>
                                <th>LOGIN</th>
                                <th>LOGOUT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $item): ?>
                                    <tr>
                                        <td><?= $item['date'] ?></td>
                                        <?php foreach($item['logs'] as $log): ?>
                                            <td><?= $log ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
