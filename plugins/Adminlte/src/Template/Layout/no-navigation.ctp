<?php
use Cake\Core\Configure;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= Configure::read('App.name') ?> | <?= $sub_page_title ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <?= $this->Html->css('bootstrap.min.css') ?>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <?= $this->Html->css('AdminLTE.min.css') ?>
  <?= $this->Html->css('skins/skin-blue.min.css') ?>
  <?= $this->Html->css('toastr.min.css') ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <?= $this->fetch('styles') ?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <?= $this->fetch('content') ?>
</div>
<!-- /.login-box -->

<!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.2.3 -->
    <?= $this->Html->script('/plugins/jQuery/jquery-2.2.3.min.js') ?>
    <!-- Bootstrap 3.3.6 -->
    <?= $this->Html->script('bootstrap.min.js') ?>
    <!-- AdminLTE App -->
    <?= $this->Html->script('app.min.js') ?>
    <?= $this->Html->script('toastr.min.js') ?>
    <?= $this->Html->script('rsb-helpers.js') ?>
    <?= $this->fetch('scripts') ?>
</body>
</html>
