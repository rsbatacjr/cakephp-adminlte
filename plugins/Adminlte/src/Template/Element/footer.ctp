		<footer class="main-footer">
		    <div class="pull-right hidden-xs">
		      <b>Version</b> 2.3.8
		    </div>
		    <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
		    reserved.
		</footer>
	</div>
	<!-- ./wrapper -->

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
