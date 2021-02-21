<?php
$errorFields = explode('-', $this->input->get('errorFields'));
//dmp($pageID);
?>

<div class="container-fluid">

    <h3 class="py-4"><?= $this->lang->line('VENDOR_ADMIN_PRODUCT_EDIT_TAB_TITLE_BASIC_DATA'); ?></h3>

    <div class="row">

        <div class="col-lg-6">

            <form method="post" action="/vendor_admin/products/update_product_basic_data">

                <label for="add_product_state"><?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_LABEL_PUBLISH'); ?></label>
                <div class="form-group mb-4">
                    <input type="checkbox" name="state" data-bootstrap-switch
                           <?php if($productData['page']['state'] == 'ACTIVE') echo 'checked'; ?> id="add_product_state"
                           data-off-color="default"
                           data-on-color="success"
                           data-on-text="<?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_VALUE_PUBLISH'); ?>"
                           data-off-text="<?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_VALUE_UNPUBLISH'); ?>">
                </div>

                <div class="form-group mb-4">
                    <label for="product_edit_parentPage"><?= $this->lang->line('VENDOR_ADMIN_EDIT_PRODUCT_INPUT_LABEL_CATEGORY'); ?></label>
                    <select class="form-control select2" name="parentPage" id="product_edit_parentPage">

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

                <div class="form-group  mb-4">
                    <label for="product_edit_ean"><?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_LABEL_EAN'); ?></label>
                    <input type="text" name="ean" id="product_edit_ean" class="form-control" value="<?= $productData['product']['ean']; ?>">
                </div>

                <div class="form-group mb-4">
                    <label for="product_edit_stockAmount"><?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_LABEL_STOCK_AMOUNT'); ?></label>
                    <input type="number" name="stockAmount" id="product_edit_stockAmount" class="form-control" value="<?= $productData['product']['stockAmount']; ?>">
                </div>

                <?php /*
                <label for="product_edit_packageWeight"><?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_LABEL_PRODUCT_WEIGHT'); ?></label>
                <div class="form-group mb-4">
                    <input type="number" name="packageWeight" id="product_edit_packageWeight" class="form-control">
                </div>

                 <div class="form-group mb-4">
                    <label for="product_edit_measureUnitt"><?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_LABEL_MEASURE_UNIT'); ?></label>
                    <select type="number" name="measureUnit" id="product_edit_measureUnitt" class="form-control">
                        <option value=""></option>
                    </select>
                </div>

                <label for="add_product_productType"><?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_LABEL_PRODUCT_TYPE'); ?></label>
                <div class="form-group mb-4">
                    <input type="checkbox" name="productType" checked data-bootstrap-switch data-off-color="default" data-on-color="default"
                           data-on-text="<?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_VALUE_PHYSICAL'); ?>" data-off-text="<?= $this->lang->line('VENDOR_ADMIN_ADD_PRODUCT_INPUT_VALUE_DIGITAL'); ?>">
                </div>
                */ ?>

                <div class="form-group mb-4">
                    <input type="hidden" name="productType" value="PHYSICALAL">
                    <input type="hidden" name="pageUriOriginal" value="<?= $productData['page']['pageUri']; ?>">
                    <input type="hidden" name="language" value="<?= LANGUAGE; ?>">
                    <input type="hidden" name="pageID" value="<?= $pageID; ?>">
                    <button type="submit" class="btn btn-primary"><?= $this->lang->line('VENDOR_ADMIN_EDIT_PRODUCT_BUTTON_UPDATE_PRODUCT'); ?></button>
                </div>

            </form>

        </div>

    </div>

</div>

<?php
//dmp(array_keys ($this->data));
//dmp($productData['product']);
//dmp($productData['page']);
?>
