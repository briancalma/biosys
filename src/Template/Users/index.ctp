<div class="row">
    <div class="col-12 mt-5">
        <div class="card">

            <div class="card-body">
                <span class="header-title">EMPLOYEE RECORD</span>
                <?= $this->Html->link('<i class="ti-user"></i> Add New Employee',['controller' => 'users','action' => 'add'],['escape' => false,'class' => 'btn btn-success btn-sm pull-right']) ?>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover progress-table text-center">
                            <thead class="text-uppercase">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">FULLNAME</th>
                                    <th scope="col">POSITION</th>
                                    <th scope="col">DEPARTMENT</th>
                                    <!-- <th scope="col">status</th> -->
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($employees as $employee): ?>
                                    <tr>
                                        <th scope="row">
                                            <?= $this->Html->link('EMP_'.$employee->id,['controller' => 'users','action' => 'view',$employee->id],['escape' => false]) ?>
                                            <!-- <a href="/users/view/<?= $employee->id?>">EMP_<?= $employee->id?></a> -->
                                        </th>
                                        <td><?= $this->Html->link(ucwords($employee->firstname." ".$employee->lastname) ,['controller' => 'users','action' => 'view',$employee->id],['escape' => false]) ?></td>
                                        <td><span class="status-p bg-warning"><?= ucwords($employee->position) ?></span></td>
                                        <td><span class="status-p bg-info"><?= ucwords($employee->department) ?></span></td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <!-- <li class="mr-3"><a href="/users/edit/<?= $employee->id?>" class="btn btn-sm btn-primary"> Edit </a></li> -->

                                                <li class="mr-3"> <?= $this->Html->link('Edit',['controller' => 'users','action' => 'edit',$employee->id],['escape' => false, 'class' => "btn btn-sm btn-primary"]) ?> </li>

                                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $employee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employee->id), 'class' => 'btn btn-danger btn-sm']) ?>
                                            </ul>
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
</div>

