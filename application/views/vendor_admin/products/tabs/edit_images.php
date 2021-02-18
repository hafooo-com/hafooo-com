
<?php
$imagesPath = '/' . PRODUCTS_IMAGES_PATH . $productData['page']['pageID'] . '/thumbnail/';
//dmp( $productImages );
?>
<style>
    /*.productImagesSortable {height: 5000px}*/
    .productImageContainer            {display: block; float: none; background-color: #e9e9e9; border: solid 1px #ccc !important; padding: 5px; margin-bottom: 10px; list-style: none; height: 103px;}
    .productImageContainerPlaceholder {display: block; float: none; background-color: #e9e9e9; border: solid 1px #ccc !important; padding: 5px; margin-bottom: 10px; list-style: none; height: 103px;}
    .productImageWrapper {width: 90px; height: 90px; padding: 2px; background-color: #fff; float: left; margin-right: 30px; border: solid 1px #ddd; }
    .productImageWrapper img {display: block; max-width: 100%; max-height: 100%; vertical-align: middle}
    .productImageInfo {}
</style>

<h3 class="py-4"><?= $this->lang->line('VENDOR_ADMIN_PRODUCT_EDIT_TAB_TITLE_IMAGES'); ?></h3>

<div class="row">

    <section class="col-xl-5 order-xl-2 p-4">
        <div class="col">
            <form method="post" action="/vendor_admin/products/upload_image" enctype="multipart/form-data" id="upload-image-form" class="dropzone">
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" name="upload_product_images_input" class="custom-file-input" id="product-edit-upload-image-input">
                        <label class="custom-file-label" for="product-edit-upload-image-input">Choose file</label>
                        <input type="hidden" name="pageID" value="<?= $pageID; ?>">
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-primary progress-bar-striped" id="progress-bar-upload-image-input"
                         role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="col-xl-7 order-xl-1 p-4">
        <ul class="list-group list-group-sortable productImagesSortable">

            <?php foreach($productImages as $image): ?>

            <li class="productImageContainer list-group-item" draggable="true" id="productImage_<?= $image['productMediaID']; ?>">
                <div class="productImageWrapper">
                    <img src="<?= $imagesPath . $image['imgName']; ?>" class="mx-auto d-block">
                </div>

                <div class="productImageInfo">
                    <p><strong>Image file name:</strong> <?= $image['imgName']; ?></p>
                    <p>
                        <?php
                        $callbackParams = array(
                                'listItem' => 'productImage_' . $image['productMediaID'],
                                'productMediaID' => $image['productMediaID'],
                                'imgName' => $image['imgName'],
                                'pageID' => $pageID,
                        );
                        $callbackParams = base64_encode(json_encode($callbackParams, JSON_UNESCAPED_UNICODE));
                        ?>
                        <button class="btn btn-danger btn-sm py-0 delete-button delete-product-image-button"
                                data-warning-title="<?= $this->lang->line('VENDOR_ADMIN_PRODUCT_EDIT_IMAGES_DELETE_IMAGE_CONFIRM_TITLE'); ?>"
                                data-warning-text="<?= sprintf($this->lang->line('VENDOR_ADMIN_PRODUCT_EDIT_IMAGES_DELETE_IMAGE_CONFIRM_TEXT'), $image['imgName']); ?>"
                                data-callback-params="<?= $callbackParams; ?>"
                                data-callback-success="deleteProductImage"
                                data-use-ajax="true"
                                data-action-url="/vendor_admin/products/ajax_delete_product_image">
                            <i class="fa fa-trash-alt"></i>&nbsp;  Remove image
                        </button>
                    </p><!-- @@@ -->
                </div>
            </li>

            <?php endforeach; ?>

        </ul>
    </section>

</div>

<script>
    var VENDOR_ADMIN_PRODUCT_EDIT_IMAGES_DELETE_IMAGE_CONFIRM_TITLE = '<?= $this->lang->line('VENDOR_ADMIN_PRODUCT_EDIT_IMAGES_DELETE_IMAGE_CONFIRM_TITLE'); ?>';
    var VENDOR_ADMIN_PRODUCT_EDIT_IMAGES_DELETE_IMAGE_CONFIRM_TEXT = '<?= $this->lang->line('VENDOR_ADMIN_PRODUCT_EDIT_IMAGES_DELETE_IMAGE_CONFIRM_TEXT'); ?>';
</script>
<!--<div class="productImageInfo">-->
<!--    <div class="col">-->
<!--        <button class="btn btn-danger float-right"> <i class="fa fa-fw fa-trash"></i> </button>-->
<!--    </div>-->
<!--</div>-->