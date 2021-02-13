<?php
$errorFields = explode('-', $this->input->get('errorFields'));
//dmp($pageID);
?>

<div class="container-fluid">

    <h3 class="py-4"><?= $this->lang->line('VENDOR_ADMIN_PRODUCT_EDIT_TAB_TITLE_BASIC_DATA'); ?></h3>

    <div class="row">

        <div class="col-xl-8">

            <form method="post" action="/vendor_admin/products/update_product_basic_data">

                <label for="add_product_parentPage"><?= $this->lang->line('VENDOR_ADMIN_EDIT_PRODUCT_INPUT_LABEL_CATEGORY'); ?></label>
                <div class="form-group mb-4">
                    <select class="form-control select2" name="parentPage" id="add_product_parentPage">

                        <?php foreach($productCategoriesTree as $productCategory): ?>

                            <?php if(empty($productCategory['subCategories'])): ?><option value="<?= $productCategory['allParentPageIDs']; ?>-<?= $productCategory['pageID']; ?>"<?php if($productCategory['pageID'] == $productData['page']['parentPageID']) echo ' selected'; ?>><?= $productCategory['translation']['pageName']; ?></option><?php endif; ?>
                            <?php foreach($productCategory['subCategories'] as $productSubCategory): ?>

                                <?php /*<?php if(empty($productSubCategory['subCategories'])):  ?><option value="<?= $productSubCategory['allParentPageIDs']; ?>-<?= $productSubCategory['pageID']; ?>"><?= $productCategory['translation']['pageName']; ?> / <?= $productSubCategory['translation']['pageName']; ?></option><?php endif; ?>*/ ?>
                                <?php if(empty($productSubCategory['subCategories'])):  ?><option value="<?= $productSubCategory['allParentPageIDs']; ?>-<?= $productSubCategory['pageID']; ?>"<?php if($productSubCategory['pageID'] == $productData['page']['parentPageID']) echo ' selected'; ?>><?= $productSubCategory['translation']['pageName']; ?></option><?php endif; ?>
                                <?php foreach($productSubCategory['subCategories'] as $productSubCategory2): ?>

                                    <?php /*<?php if(empty($productSubCategory2['subCategories'])):  ?><option value="<?= $productSubCategory2['allParentPageIDs']; ?>-<?= $productSubCategory2['pageID']; ?>"><?= $productCategory['translation']['pageName']; ?> / <?= $productSubCategory['translation']['pageName']; ?> / <?= $productSubCategory2['translation']['pageName']; ?></option><?php endif; ?>*/ ?>
                                    <?php if(empty($productSubCategory2['subCategories'])):  ?><option value="<?= $productSubCategory2['allParentPageIDs']; ?>-<?= $productSubCategory2['pageID']; ?>"<?php if($productSubCategory2['pageID'] == $productData['page']['parentPageID']) echo ' selected'; ?>><?= $productSubCategory2['translation']['pageName']; ?></option><?php endif; ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <label for="add_product_pageName"><?= $this->lang->line('VENDOR_ADMIN_EDIT_PRODUCT_INPUT_LABEL_PAGE_NAME'); ?></label>
                <div class="form-group mb-4">
                    <input type="text" name="pageName" id="add_product_pageName" class="form-control" required
                           value="<?= fillInputValue($this->input->get('pageName'), current($productData['page_translation'])['pageName']); ?>" data-minlength="2" maxlength="300">
                    <div class="help-block with-errors text-danger"><?php if(markErrorField($errorFields, 'pageName'))
                            echo $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_ERROR_FIRST_NAME'); ?>
                    </div>
                </div>

                <label for="add_product_metaTitle"><?= $this->lang->line('VENDOR_ADMIN_EDIT_PRODUCT_INPUT_LABEL_META_TITLE'); ?></label>
                <div class="input-group mb-4">
                    <div class="input-group-prepend lengthCounter">
                        <span class="input-group-text bg-danger" data-important-min-length="50" data-important-max-length="60">0</span>
                    </div>
                    <input type="text" name="metaTitle" id="add_product_metaTitle" class="form-control inputLengthCounter" required
                           value="<?= fillInputValue($this->input->get('metaTitle'), current($productData['page_translation'])['metaTitle']); ?>" data-minlength="10" maxlength="300">
                </div>

                <label for="add_product_metaDescription"><?= $this->lang->line('VENDOR_ADMIN_EDIT_PRODUCT_INPUT_LABEL_META_DESCRIPTION'); ?></label>
                <div class="input-group mb-4">
                    <div class="input-group-prepend lengthCounter">
                        <span class="input-group-text bg-danger" data-important-min-length="50" data-important-max-length="160">0</span>
                    </div>
                    <textarea name="metaDescription" id="add_product_metaDescription" class="form-control inputLengthCounter" required
                              data-minlength="10" maxlength="300"></textarea>
                </div>
<?php /*
                    <label for="add_product_productType"><?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_LABEL_PRODUCT_TYPE'); ?></label>
                    <div class="form-group mb-4">
                        <input type="checkbox" name="productType" checked data-bootstrap-switch data-off-color="default" data-on-color="default"
                               data-on-text="<?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_VALUE_PHYSICAL'); ?>" data-off-text="<?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_VALUE_DIGITAL'); ?>">
                    </div>
*/ ?><input type="hidden" name="productType" value="PHYSICALAL">

                <label for="add_product_productDescription"><?= $this->lang->line('VENDOR_ADMIN_EDIT_PRODUCT_INPUT_LABEL_PRODUCT_DESCRIPTION'); ?></label>
                <div class="form-group mb-4">
                        <textarea name="productDescription" id="add_product_productDescription" class="form-control textarea-editor"
                                  data-minlength="10" maxlength="10000"><?= fillInputValue($this->input->get('productDescription'), $productData['product_translation'][0]['productDescription']); ?></textarea>
                </div>

                <div class="form-group mb-4">
                    <input type="hidden" name="language" value="<?= LANGUAGE; ?>">
                    <input type="hidden" name="pageID" value="<?= $pageID; ?>">
                    <button type="submit" class="btn btn-primary"><?= $this->lang->line('VENDOR_ADMIN_EDIT_PRODUCT_BUTTON_UPDATE_PRODUCT'); ?></button>
                </div>

            </form>

        </div>

    </div>

</div>
