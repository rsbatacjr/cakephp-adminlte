<?php
/**
  * @var \App\View\AppView $this
  */
?>
<?= $this->Html->CSS("Adminlte.dataTables.bootstrap.css", ['block' => 'styles']) ?>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">User's List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Active</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><a href="#" data-id="<?= $user->id ?>"><?= $this->Number->format($user->id) ?></a></td>
                    <td><?= h($user->person->fullname) ?></td>
                    <td><a href="mailto:<?= h($user->email) ?>"><?= h($user->email) ?></a></td>
                    <td><?= h($user->user_role->role) ?></td>
                    <td><?= ($user->active==1 ? 'Active': 'In-active') ?></td>
                    <td><button type="button" class="btn btn-default btn-sm delete-btn" data-id="<?= $user->id ?>"><i class="fa fa-trash-o"></i></button></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
<!-- DataTables -->
<?= $this->Html->script(["Adminlte.jquery.dataTables.min.js", "Adminlte.dataTables.bootstrap.min.js", "user-list.js"], ['block' => 'scripts']) ?>