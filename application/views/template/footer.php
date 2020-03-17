    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 0.0.1 <b>BETA</b>
    </div>
    <strong>Copyright &copy; 2018 ACS</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

  <script src="<?= base_url('assets/bower_components/jquery/dist/jquery.min.js');?>"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?= base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
  <script src="<?= base_url('assets/bower_components/PACE/pace.min.js');?>"></script>

  <!-- SlimScroll -->
  <script src="<?= base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js');?>"></script>
  <!-- FastClick -->
  <script src="<?= base_url('assets/bower_components/fastclick/lib/fastclick.js');?>"></script>
  <script src="<?= base_url('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');?>"></script>
  <script src="<?= base_url('assets/plugins/iCheck/icheck.min.js');?>"></script>


  <!-- AdminLTE App -->
  <!-- DataTables -->
  <script src="<?= base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js');?>"></script>
  <script src="<?= base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');?>"></script>
  <script src="<?= base_url('assets/bower_components/datatables/dataTables.checkboxes.js');?>"></script>
  <script src="<?= base_url('assets/dist/js/adminlte.min.js');?>"></script>
  <script src="<?= base_url('assets/plugins/jquery-nestable/jquery.nestable.js');?>"></script>
  <script src="<?= base_url('assets/plugins/alertify/alertify.js');?>"></script>
  <script src="<?= base_url('assets/plugins/bootstrap-show-password/bootstrap-show-password.min.js');?>"></script>

  <!-- Select2 -->
  <script src="<?= base_url('assets/bower_components/bootstrap-select/js/bootstrap-select.js');?>"></script>
  <!-- menu funct -->
  <script src="<?= base_url('assets/dist/js/menu.js');?>"></script>
  <script type="text/javascript">
      // To make Pace works on Ajax calls
    $(document).ajaxStart(function () {
      Pace.restart()
    });
    <?php 
      if(isset($this->session->message)){ ?>
        alertify.set('notifier','position', 'top-right');
        alertify.success('<a style="color:white"><?= $this->session->message;?></a>');
    
    <?php } ?>
  </script>
  <?php (isset($code_js)?$this->load->view($code_js):""); ?>
</body>
</html>
