<div class="row">
    <div class="col-12 mt-5">

        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nostrum ratione officia libero maiores, explicabo cumque dolorem quasi rerum molestiae. Ex ut tempora odit voluptatem, libero culpa nostrum dolores enim velit magnam repellendus! Porro repudiandae mollitia odit eveniet molestias consequuntur deleniti quisquam ducimus quidem autem? Error culpa nostrum, nemo quo quisquam illo architecto id nihil pariatur esse recusandae alias quaerat voluptates iure consequuntur repellat cupiditate perferendis iste praesentium. Suscipit, molestias consequatur.</p>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nostrum ratione officia libero maiores, explicabo cumque dolorem quasi rerum molestiae. Ex ut tempora odit voluptatem, libero culpa nostrum dolores enim velit magnam repellendus! Porro repudiandae mollitia odit eveniet molestias consequuntur deleniti quisquam ducimus quidem autem? Error culpa nostrum, nemo quo quisquam illo architecto id nihil pariatur esse recusandae alias quaerat voluptates iure consequuntur repellat cupiditate perferendis iste praesentium. Suscipit, molestias consequatur.</p>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nostrum ratione officia libero maiores, explicabo cumque dolorem quasi rerum molestiae. Ex ut tempora odit voluptatem, libero culpa nostrum dolores enim velit magnam repellendus! Porro repudiandae mollitia odit eveniet molestias consequuntur deleniti quisquam ducimus quidem autem? Error culpa nostrum, nemo quo quisquam illo architecto id nihil pariatur esse recusandae alias quaerat voluptates iure consequuntur repellat cupiditate perferendis iste praesentium. Suscipit, molestias consequatur.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="products form large-9 medium-8 columns content">
    <?= $this->Form->create($product) ?>
    <fieldset>
        <legend><?= __('Add Product') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('price');
            echo $this->Form->control('location');
            echo $this->Form->control('sale_percent');
            echo $this->Form->control('sale_price');
            echo $this->Form->control('details');
            echo $this->Form->control('description');
            echo $this->Form->control('picture');
            echo $this->Form->control('category_id', ['options' => $categories]);
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('max_availability_date', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
