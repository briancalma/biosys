<div class="row">
    <div class="col-lg-12 mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Payroll Records</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <th>#ID</th>
                            <th>PAYROLL DATE</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>FILE</th>
                           
                        </thead>
                        <tbody>
                            <?php foreach($records as $item): ?>
                                <tr>
                                    <?php 
                                        $bill_date = strtotime($item['bill_date']) * 1000;
                                    ?>
                                    <!-- 
                                        <td> 
                                            <a href="/payrolls/view/<?= $bill_date?>">PYRL_REC_<?= $item['id']?></a> 
                                        </td> 
                                    -->

                                    <td><?= $this->Html->link('PYRL_REC_'.$item['id'] ,['controller' => 'payrolls','action' => 'view',$bill_date],['escape' => false]) ?></td>
                                    <td><?= $item['bill_date']?></td>
                                    <td><?= $item['start_date']?></td>
                                    <td><?= $item['end_date']?></td>
                                    <td>
                                        <a href="/biosys/files/<?= $item['file']?>"><i class="ti-file"></i><?= $item['file']?></a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>