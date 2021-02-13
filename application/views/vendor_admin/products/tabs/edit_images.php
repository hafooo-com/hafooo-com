
<div class="container-fluid p-4">

    <h3 class="py-4"><?= $this->lang->line('VENDOR_ADMIN_PRODUCT_EDIT_TAB_TITLE_IMAGES'); ?></h3>

    <div class="col-md-6">
        <form method="post" action="/vendor_admin/products/ajax_upload_image" enctype="multipart/form-data" id="upload-image-form" class="dropzone">
            <input type="hidden" name="pageID" value="<?= $pageID; ?>">
<!--            <input type="file" class="custom-file-input" name="upload_product_images_input" id="upload_product_images_input">-->
<!--            <input type="file" class="custom-file-input" name="upload_product_images" id="upload_product_images">-->
        </form>
    </div>

    <div class="row">

    </div>

</div>
