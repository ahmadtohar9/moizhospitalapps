<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.0
  </div>
  <strong>Copyright &copy; 2025 <a href="http://almsaeedstudio.com">MoizApps</a>.</strong> All rights
  reserved.
</footer>
</div>

<!-- Bootstrap -->
<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/bower_components/fastclick/lib/fastclick.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.min.js'); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js'); ?>"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'); ?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
<script
  src="<?php echo base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'); ?>"></script>
<!-- ChartJS -->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/dist/js/demo.js'); ?>"></script>
<script src="<?= base_url('assets/js/sweetalert.js'); ?>"></script>

<?php if ($this->session->flashdata('notif')): ?>
  <script>
    Swal.fire({
      icon: '<?= $this->session->flashdata('notif')['type']; ?>',
      title: '<?= $this->session->flashdata('notif')['message']; ?>',
      timer: 3000,
      showConfirmButton: false
    });
  </script>
<?php endif; ?>


<!-- Custom Script -->
<script>
  $(document).ready(function () {
    // Only initialize if not already initialized
    if (!$.fn.DataTable.isDataTable('#MoizTable')) {
      $('#MoizTable').DataTable({
        paging: true,
        searching: true,
        responsive: true,
        autoWidth: false
      });
    }
  });
</script>

</body>

</html>