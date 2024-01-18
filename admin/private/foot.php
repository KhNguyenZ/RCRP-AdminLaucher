</div>
<footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
        <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>
    </div>
    

</footer>
<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>
<script src="<?= $base_url ?>public/admin/plugins/jquery/jquery.min.js"></script>
<script src="<?= $base_url ?>public/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="<?= $base_url ?>public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= $base_url ?>public/admin/plugins/chart.js/Chart.min.js"></script>
<script src="<?= $base_url ?>public/admin/plugins/sparklines/sparkline.js"></script>
<script src="<?= $base_url ?>public/admin/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= $base_url ?>public/admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="<?= $base_url ?>public/admin/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="<?= $base_url ?>public/admin/plugins/moment/moment.min.js"></script>
<script src="<?= $base_url ?>public/admin/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?= $base_url ?>public/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="<?= $base_url ?>public/admin/plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?= $base_url ?>public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?= $base_url ?>public/admin/dist/js/adminlte.js"></script>
<script src="<?= $base_url ?>public/admin/dist/js/demo.js"></script>
<script src="<?= $base_url ?>public/admin/dist/js/pages/dashboard.js"></script>
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>

<script src="<?= $base_url ?>lib/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= $base_url ?>lib/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(function() {
        // Summernote
        $('#summernote').summernote()

        // CodeMirror
        CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
            mode: "htmlmixed",
            theme: "monokai"
        });
    })
</script>
</body>

</html>