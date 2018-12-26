<div class="header-area">
    <div class="row align-items-center">
        <!-- nav and search button -->
        <div class="col-md-6 col-sm-8 clearfix">
            <div class="nav-btn pull-left">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="search-box pull-left">
                <form action="#">
                    <input type="text" name="search" placeholder="Search..." required>
                    <i class="ti-search"></i>
                </form>
            </div>
        </div>
        <!-- profile info & task notification -->
        <div class="col-md-6 col-sm-4 clearfix">
            <ul class="notification-area pull-right">
                <li id="full-view"><i class="ti-fullscreen"></i></li>
                <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
            </ul>
        </div>
    </div>
</div>

<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left"><?= $page['title']?></h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="#"><?= $page['title']?></a></li>
                    <li><span><?= $page['sub_title']?></span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            <div class="user-profile pull-right">
                <?= $this->Html->image('author/avatar.png',['class' => 'avatar user-thumb', 'alt' => 'avatar'])?>
                <!-- <img class="avatar user-thumb" src="assets/image/author/avatar.png" alt="avatar"> -->
                <h4 class="user-name dropdown-toggle" data-toggle="dropdown"> 
                <?= $user['username'] ?>
                <i class="fa fa-angle-down"></i></h4>  
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Message</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'btn btn-default btn-flat dropdown-item'])?>
                    <!-- <a class="dropdown-item" href="/logout">Log Out</a> -->
                </div>
            </div>
        </div>
    </div>
</div>