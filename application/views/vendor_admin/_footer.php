
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


<?php $this->load->view('vendor_admin/_modals-alerts-toasters'); ?>


<!-- jQuery -->
<script src="/assets/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="/assets/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- pace-progress -->
<script src="/assets/adminlte/plugins/pace-progress/pace.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/adminlte/dist/js/adminlte.min.js"></script>
<!-- jquery-validation -->
<script src="/assets/adminlte/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="/assets/adminlte/plugins/jquery-validation/additional-methods.min.js"></script>

<script src="/assets/adminlte/plugins/toastr/toastr.min.js"></script>

<script src="/js/vendor_admin/common.min.js<?= kc(); ?>"></script>
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