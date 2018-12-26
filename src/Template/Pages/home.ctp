<!-- <div class="row">
    <?php foreach($products as $product): ?>
        <div class="col-lg-4 col-md-6 mt-5">
            <div class="card card-bordered" style="height:400px">
                <img class="card-img-top img-fluid" src="http://www.on-click.in/images/room-e-commerce.jpg" alt="image">
                <div class="card-body">
                    <h5 class="title"><?= $product->name?></h5>
                    <p class="card-text"><?= $product->description?></p>
                    <p>Php <?= $product->price?></p>
                    <p><?= $product->location ?></p>
                    <a href="#" class="btn btn-primary">More Details</a>
                </div>
            </div>    
        </div>
    <?php endforeach; ?>
</div> -->

<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-4 mt-5 mb-3">
                <div class="card">
                    <div class="seo-fact sbg1">
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <div class="seofct-icon"><i class="ti-user"></i> Users</div>
                            <h2><?= $user_count ?></h2>
                        </div>
                        <canvas id="seolinechart1" height="50"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-md-5 mb-3">
                <div class="card">
                    <div class="seo-fact sbg2">
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <div class="seofct-icon"><i class="ti-files"></i> Payrolls</div>
                            <h2><?= $payroll_count ?></h2>
                        </div>
                        <canvas id="seolinechart2" height="50"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-md-5 mb-3">
                <div class="card">
                    <div class="seo-fact sbg3">
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <div class="seofct-icon"><i class="ti-calendar"></i> Calendar</div>
                        </div>
                        <canvas id="seolinechart3" height="50"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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