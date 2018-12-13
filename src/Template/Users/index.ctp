<div class="row">
    <div class="col-lg-12 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-uppercase bg-primary">
                                <tr class="text-white">
                                    <th scope="col">ID</th>
                                    <th scope="col">Full Name</th>
                                    <!-- <th scope="col">Username</th> -->
                                    <!-- <th scope="col">price</th> -->
                                    <th scope="col">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= $this->Number->format($user->id) ?></td>
                                        <td><?= h($user->firstname)." ".h($user->lastname) ?></td>
                                        <td class="actions">
                                            <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="/users/add" class="btn btn-block btn-info">Add New Employee</a>
            </div>
        </div>
        
        
    </div>
</div>