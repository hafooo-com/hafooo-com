<?php
$errorFields = explode('-', $this->input->get('errorFields'));
//dmp($errorFields);
//dmp($_GET);
?>

<div class="card card-primary card-outline">

    <div class="card-header">
        <h3 class="card-title"><?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_LABEL_PAGE_NAME'); ?></h3>
    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-xl-8">

                <form method="post" action="/vendor_admin/products/add_product">
<?php /*
                    <label for="add_product_languageCode"><?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_LABEL_LANGUAGE'); ?></label>
                    <div class="form-group mb-4">
                        <select class="form-control select2" name="language" id="add_product_languageCode">
                            <?php foreach(ACTIVE_LANGUAGES as $language): ?>

                                <option value="<?= $language['languageCode']; ?>" class="selectOptionWithFlag"<?php if($language['languageCode'] == LANGUAGE) echo ' selected'; ?>><?= $language['languageName']; ?></option>

                            <?php endforeach; ?>

                        </select>
                    </div>
*/ ?>
                    <label for="add_product_parentPage"><?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_LABEL_CATEGORY'); ?></label>
                    <div class="form-group mb-4">
                        <select class="form-control select2" name="parentPage" id="add_product_parentPage">

                            <?php foreach($productCategoriesTree as $productCategory): ?>

                                <?php if(empty($productCategory['subCategories'])): ?><option value="<?= $productCategory['allParentPageIDs']; ?>-<?= $productCategory['pageID']; ?>"><?= $productCategory['translation']['pageName']; ?></option><?php endif; ?>
                                <?php foreach($productCategory['subCategories'] as $productSubCategory): ?>

                                    <?php /*<?php if(empty($productSubCategory['subCategories'])):  ?><option value="<?= $productSubCategory['allParentPageIDs']; ?>-<?= $productSubCategory['pageID']; ?>"><?= $productCategory['translation']['pageName']; ?> / <?= $productSubCategory['translation']['pageName']; ?></option><?php endif; ?>*/ ?>
                                    <?php if(empty($productSubCategory['subCategories'])):  ?><option value="<?= $productSubCategory['allParentPageIDs']; ?>-<?= $productSubCategory['pageID']; ?>"><?= $productSubCategory['translation']['pageName']; ?></option><?php endif; ?>
                                    <?php foreach($productSubCategory['subCategories'] as $productSubCategory2): ?>

                                        <?php /*<?php if(empty($productSubCategory2['subCategories'])):  ?><option value="<?= $productSubCategory2['allParentPageIDs']; ?>-<?= $productSubCategory2['pageID']; ?>"><?= $productCategory['translation']['pageName']; ?> / <?= $productSubCategory['translation']['pageName']; ?> / <?= $productSubCategory2['translation']['pageName']; ?></option><?php endif; ?>*/ ?>
                                        <?php if(empty($productSubCategory2['subCategories'])):  ?><option value="<?= $productSubCategory2['allParentPageIDs']; ?>-<?= $productSubCategory2['pageID']; ?>"><?= $productSubCategory2['translation']['pageName']; ?></option><?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                            <option value="" selected>&nbsp;</option>
                        </select>
                    </div>

                    <label for="add_product_pageName"><?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_LABEL_PAGE_NAME'); ?></label>
                    <div class="form-group mb-4">
                        <input type="text" name="pageName" id="add_product_pageName" class="form-control" required
                               value="<?= fillInputValue($this->input->get('pageName')); ?>" data-minlength="2" maxlength="300">
                        <div class="help-block with-errors text-danger"><?php if(markErrorField($errorFields, 'pageName'))
                            echo $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_ERROR_FIRST_NAME'); ?>
                        </div>
                    </div>

                    <label for="add_product_metaTitle"><?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_LABEL_META_TITLE'); ?></label>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend lengthCounter">
                            <span class="input-group-text bg-danger" data-important-min-length="50" data-important-max-length="60">0</span>
                        </div>
                        <input type="text" name="metaTitle" id="add_product_metaTitle" class="form-control inputLengthCounter" required
                               value="<?= fillInputValue($this->input->get('metaTitle')); ?>" data-minlength="10" maxlength="300">
                    </div>

                    <label for="add_product_metaDescription"><?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_LABEL_META_DESCRIPTION'); ?></label>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend lengthCounter">
                            <span class="input-group-text bg-danger" data-important-min-length="50" data-important-max-length="160">0</span>
                        </div>
                        <textarea name="metaDescription" id="add_product_metaDescription" class="form-control inputLengthCounter" required
                                  data-minlength="10" maxlength="300"><?= fillInputValue($this->input->get('metaDescription')); ?></textarea>
                    </div>
<?php /*
                    <label for="add_product_productType"><?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_LABEL_PRODUCT_TYPE'); ?></label>
                    <div class="form-group mb-4">
                        <input type="checkbox" name="productType" checked data-bootstrap-switch data-off-color="default" data-on-color="default"
                               data-on-text="<?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_VALUE_PHYSICAL'); ?>" data-off-text="<?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_VALUE_DIGITAL'); ?>">
                    </div>
*/ ?><input type="hidden" name="productType" value="PHYSICALAL">

                    <label for="add_product_productDescription"><?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_LABEL_PRODUCT_DESCRIPTION'); ?></label>
                    <div class="form-group mb-4">
                        <textarea name="productDescription" id="add_product_productDescription" class="form-control textarea-editor"
                                  data-minlength="10" maxlength="10000"><?= fillInputValue($this->input->get('productDescription')); ?></textarea>
                    </div>

                    <div class="form-group mb-4">
                        <input type="hidden" name="language" value="<?= LANGUAGE; ?>">
                        <button type="submit" class="btn btn-primary"><?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_BUTTON_CREATE_PRODUCT'); ?></button>
                    </div>

                </form>

            </div>

        </div>

    </div>


<script>
    var errorMessages = new Array();
    errorMessages["pageName"] = "<?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_ERROR_PAGE_NAME_REQUUIRED'); ?>";
    errorMessages["metaTitle"] = "<?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_ERROR_META_TITLE_REQUUIRED'); ?>";
    errorMessages["metaDescription"] = "<?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_ERROR_META_DESCRIPTION_REQUUIRED'); ?>";
</script>



    <?php
//    dmp($languages);
//    dmp($productCategoriesTree);
    ?>
</div>