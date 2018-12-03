<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="index.html">
                <!-- <img src="assets/image/icon/logo.png" alt="logo"> -->
                <h3>BUSIO</h3>
            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="active"><a href="#"><i class="ti-home"></i><span>Home</span></a></li>
                    <li><a href="#"><i class="ti-user"></i> <span>Profile</span></a></li>
                    <li><a href="#"><i class="ti-truck"></i> <span>Products</span></a></li>
                    <li><a href="#"><button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#addNewProductModal">SELL IN BUSIO</button></a></li>
                    <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>


<div class="modal fade" id="addNewProductModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sell something in BUSIO</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <?= $this->Form->create(null,['url' => ['controller' => 'Products', 'action' => 'add']]) ?>
                <div class="form-group">
                    <label for="name" class="col-form-label">What are you selling?</label>
                    <?= $this->Form->control('',['name'=>'name','class' => 'form-control', 'id' => 'name', 'placeholder' => '* Enter Product title/name'])?> 
                </div>

                <div class="form-group">
                    <label for="price" class="col-form-label">How much is this?</label>
                    <?= $this->Form->control('',['name'=>'price','class' => 'form-control', 'id' => 'price', 'placeholder' => '* Enter Product Price'])?> 
                </div>

                <div class="form-group">
                    <label for="sale_percent" class="col-form-label">Sale Percent?</label>
                    <?= $this->Form->control('',['name'=>'sale_percent','type' => 'number','class' => 'form-control', 'id' => 'sale_percent', 'placeholder' => '* Enter Product Sale Percent'])?> 
                </div>

                <div class="form-group">
                    <label for="location" class="col-form-label">LOCATION</label>
                    <?= $this->Form->control('',['name'=>'location','class' => 'form-control', 'id' => 'location', 'placeholder' => '* Enter LOCATION'])?> 
                </div>

                <div class="form-group">
                    <label for="category" class="col-form-label">Category</label>
                    <select name="category" id="category" class="form-control">
                        <option value=""></option>
                        <?php foreach($categories as $category): ?>
                            <option value="<?= $category->id?>"> <?= $category->name ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description" class="col-form-label">Description</label>
                    <?= $this->Form->control('',['name'=>'description','class' => 'form-control', 'id' => 'location', 'placeholder' => '* Enter description', 'rows' => '3'])?> 
                </div>

            </div>
            <div class="modal-footer">  
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                <?= $this->Form->submit('Save Changes', ['class' => 'btn btn-primary']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
