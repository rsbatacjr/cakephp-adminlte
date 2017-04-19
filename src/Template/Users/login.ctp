<?php
/**
  * @var \App\View\AppView $this
  */
$this->layout = 'login';
?>
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <?= $this->Flash->render('auth') ?>
    <?= $this->Form->create() ?>
      <div class="form-group has-feedback">
        <?= $this->Form->input('email', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Email']) ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?= $this->Form->input('password', ['label' => false, 'class' => 'form-control', 'placeholder' => 'Password']) ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck" style="padding-left: 20px;">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
        <?= $this->Form->button(__('Sign In'), ['id' => 'login-btn', 'type' => 'submit', 'class' => 'btn btn-primary btn-block btn-flat']); ?>
        </div>
        <!-- /.col -->
      </div>
    <?= $this->Form->end() ?>

    <a href="forgotPassword">I forgot my password</a><br>
    <a href="register" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->