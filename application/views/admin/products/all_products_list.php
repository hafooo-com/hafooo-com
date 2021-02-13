<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Title</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">

<?php foreach($css_files as $file): ?>
<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>

<?= $output; ?>


    </div>
    <!-- /.card-body -->
    <div class="card-footer">
    &nbsp;
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->