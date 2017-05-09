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
                  <th style="width: 100px;">Id</th>
                  <th>Role</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($roles as $role): ?>
                <tr>
                    <td><a href="#" data-id="<?= $role->id ?>"><?= $this->Number->format($role->id) ?></a></td>
                    <td><?= $role->role ?></td>
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