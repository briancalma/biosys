<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> BUSIO </title>
    <?= $this->Html->meta('icon') ?>

     <!-- amchart css -->
     <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->

    <!-- Load CSS -->
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('font-awesome.min.css') ?>
    <?= $this->Html->css('themify-icons.css') ?>
    <?= $this->Html->css('metisMenu.css') ?>
    <?= $this->Html->css('owl.carousel.min.css') ?>
    <?= $this->Html->css('slicknav.min.css') ?>
    <?= $this->Html->css('typography.css') ?>
    <?= $this->Html->css('default-css.css') ?>
    <?= $this->Html->css('styles.css') ?>
    <?= $this->Html->css('responsive.css') ?>
    
    <?= $this->Html->script('vendor/modernizr-2.8.3.min.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    
    <div id="preloader">
        <div class="loader"></div>
    </div>

    <div class="login-area">
        <div class="container">

            <div class="row">
                <div class="col-3"></div>
                <div class="col-6" style="margin-top:2.2rem;">
                    <?= $this->Flash->render() ?>
                </div>
                <div class="col-3"></div>
            </div>

            <div class="login-box ptb--100">
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </div>



    <?= $this->Html->script('vendor/jquery-2.2.4.min.js') ?>
    <?= $this->Html->script('popper.min.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('owl.carousel.min.js') ?>
    <?= $this->Html->script('metisMenu.min.js') ?>
    <?= $this->Html->script('jquery.slimscroll.min.js') ?>
    <?= $this->Html->script('jquery.slicknav.min.js') ?>
    <?= $this->Html->script('plugins.js') ?>
    <?= $this->Html->script('scripts.js') ?>

</body>
</html>
