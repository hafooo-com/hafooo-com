
</div><!-- /.container-fluid -->
</div><!-- /.row -->
</div><!-- /.col-md-12 -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->


<footer class="main-footer">

    <strong></strong>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark"><!-- Control sidebar content goes here -->
</aside><!-- /.control-sidebar -->
</div><!-- ./wrapper -->


<div class="modal fade" id="delete-confirm-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-exclamation-triangle text-warning"></i></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="delete-confirm-text"></p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="delete-confirm-button-close">Close</button>
                <button type="button" class="btn btn-primary" id="delete-confirm-button-save">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- jQuery -->
<script src="/assets/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="/js/vendor_admin/common.min.js<?= kc(); ?>"></script>
<!-- bs-custom-file-input -->
<script src="/assets/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- pace-progress -->
<script src="/assets/adminlte/plugins/pace-progress/pace.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="/assets/adminlte/dist/js/demo.js"></script>-->
<!-- jquery-validation -->
<script src="/assets/adminlte/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="/assets/adminlte/plugins/jquery-validation/additional-methods.min.js"></script>

<?php if(isset($js)): foreach($js as $script): ?>
<script src="<?= $script.kc(); ?>"></script>
<?php endforeach; endif; ?>
<script>
    $(document).ready(function(){
        $('.firstLvlTabs a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('firstLvlTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('firstLvlTab');
        if(activeTab){
            $('.firstLvlTabs a[href="' + activeTab + '"]').tab('show');
        }

        $('.secondLvlTabs a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('secondLvlTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('secondLvlTab');
        if(activeTab){
            $('.secondLvlTabs a[href="' + activeTab + '"]').tab('show');
        }
    });
</script>
</body>
</html>