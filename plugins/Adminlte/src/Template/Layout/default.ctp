<!-- Main Header -->
<?= $this->element('header', array(
    'message_count' => 4,
    'notification_count' => 10,
    'task_count' => 15,
    'user_image' => $this->request->session()->read('User.Photo')
    )) ?>

<!-- =============================================== -->

<!-- Left side column. contains the logo and sidebar -->
<?= $this->element('sidebar', array(
    'user_image' => $this->request->session()->read('User.Photo')
    )) ?>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <?= $this->fetch('content') ?>
</div>
<!-- /.content-wrapper -->

<?= $this->element('footer') ?>