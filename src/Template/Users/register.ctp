<?php
/**
  * @var \App\View\AppView $this
  */
$this->layout = 'login';
?>
  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <?= $this->Flash->render('result') ?>
    <?= $this->Form->create(null, ['id' => 'registration-form']) ?>
      <div class="form-group has-feedback">
        <?= $this->Form->input('first_name', ['label' => false, 'class' => 'form-control required', 'placeholder' => 'First Name']) ?>
      </div>
      <div class="form-group has-feedback">
        <?= $this->Form->input('last_name', ['label' => false, 'class' => 'form-control required', 'placeholder' => 'Last Name']) ?>
      </div>
      <div class="form-group has-feedback">
        <?= $this->Form->input('email', ['label' => false, 'class' => 'form-control required', 'placeholder' => 'Email']) ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?= $this->Form->input('password', ['label' => false, 'class' => 'form-control required', 'placeholder' => 'Password']) ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?= $this->Form->input('retypepassword', ['type' => 'password', 'label' => false, 'class' => 'form-control', 'placeholder' => 'Retype password']) ?>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck" style="padding-left: 20px;">
            <label>
              <input type="checkbox" id="chk-agree"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <?= $this->Form->button(__('Register'), ['id' => 'register-btn', 'type' => 'button', 'class' => 'btn btn-primary btn-block btn-flat']); ?>
        </div>
        <!-- /.col -->
      </div>
    <?= $this->Form->end() ?>

    <a href="/users/login" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div>
  <!-- /.register-box -->
  <?= $this->Html->script("user_scripts/registration-script.js", ['block' => 'scripts']) ?>