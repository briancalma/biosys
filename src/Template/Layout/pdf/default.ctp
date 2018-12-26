<?php
use Cake\Core\Configure;
$cakeDescription = 'CakePHP: the rapid development PHP framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>

    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css', ['fullBase' => true]) ?>
    <?= $this->Html->css('cake.css', ['fullBase' => true]) ?>
    <?= $this->Html->css('home.css', ['fullBase' => true]) ?>
    <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">
</head>
<body class="home">

<header class="row">
    <div class="header-image"><?= $this->Html->image('cake.logo.svg') ?></div>
    <div class="header-title">
        
    </div>
</header>
<div class="row">
    <div class="columns large-12">
        <?= $this->fetch('content') ?>
    </div>
</div>
</body>

</html>
