<?php
use Cake\Core\Configure;
$cakeDescription = 'CakePHP: the rapid development PHP framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title> BIOSYS </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css', ['fullBase' => true]) ?>
    <?= $this->Html->css('cake.css', ['fullBase' => true]) ?>
    <?= $this->Html->css('home.css', ['fullBase' => true]) ?>
    <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">
     
    <!-- Load CSS -->
    <?= $this->Html->css('bootstrap.min.css',['fullBase' => true]) ?>
    <?= $this->Html->css('font-awesome.min.css', ['fullBase' => true]) ?>
    <?= $this->Html->css('themify-icons.css' , ['fullBase' => true]) ?>
    <?= $this->Html->css('metisMenu.css', ['fullBase' => true]) ?>
    <?= $this->Html->css('owl.carousel.min.css' , ['fullBase' => true]) ?>
    <?= $this->Html->css('slicknav.min.css', ['fullBase' => true]) ?>
    <?= $this->Html->css('typography.css' , ['fullBase' => true]) ?>
    <?= $this->Html->css('default-css.css', ['fullBase' => true]) ?>
    <?= $this->Html->css('styles.css', ['fullBase' => true]) ?>
    <?= $this->Html->css('responsive.css', ['fullBase' => true]) ?>
    
</head>
<body class="home">

<header class="row">
    <!-- <div class="header-image"><?= $this->Html->image('cake.logo.svg') ?></div> -->
    <div class="header-title">

    </div>
</header>
    <div class="row">
        <div class="col-lg-12">
            <?= $this->fetch('content') ?>
        </div>
    </div>
</body>

</html>
