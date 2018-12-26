<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="index.html">
                <!-- <img src="assets/image/icon/logo.png" alt="logo"> -->
                <h3>BIOSYS</h3>
            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li> <?= $this->Html->link('<i class="ti-home"></i> <span>HOME</span>',['controller' => 'pages','action' => 'home'],['escape' => false]) ?> </li>
                    <li> <?= $this->Html->link('<i class="ti-user"></i> <span>Users</span>',['controller' => 'users','action' => 'index'],['escape' => false]) ?> </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-money"></i><span>Payroll Management</span></a>
                        <ul class="collapse">
                            <li><?= $this->Html->link('CALENDAR',['controller' => 'payrolls','action' => 'index'],['escape' => false]) ?></li>
                            <li><?= $this->Html->link('RECORDS',['controller' => 'payrolls','action' => 'list'],['escape' => false]) ?></li>
                        </ul>
                    </li>
                    <li><?= $this->Html->link('<i class="fa fa-sign-out"></i> <span>Logout</span></a>',['controller' => 'users','action' => 'logout'],['escape' => false]) ?></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

