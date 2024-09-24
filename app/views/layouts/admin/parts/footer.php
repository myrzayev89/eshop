<div class="logs">
    <?php $this->getDbLogs(); ?>
</div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script>
    const PATH = '<?= PATH; ?>';
    const ADMIN = '<?= ADMIN; ?>';
</script>
<script src="<?= PATH; ?>/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= PATH; ?>/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= PATH; ?>/adminlte/dist/js/adminlte.min.js"></script>
<script src="<?= PATH; ?>/adminlte/plugins/select2/js/select2.full.min.js"></script>
<script src="<?= PATH; ?>/adminlte/app.js"></script>
</body>
</html>