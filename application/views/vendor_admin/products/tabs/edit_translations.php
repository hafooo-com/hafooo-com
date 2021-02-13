
<div class="container-fluid">

    <h3 class="py-4"><?= $this->lang->line('VENDOR_ADMIN_PRODUCT_EDIT_TAB_TITLE_TRANSLATIONS'); ?></h3>

    <ul class="nav nav-tabs secondLvlTabs" id="active-languages-tabs" role="tablist">
    <?php
    $i = 0;
    foreach(ACTIVE_LANGUAGES as $key => $lang):
        $selected = $i > 0 ? 'false' : 'true';
        $active = $i > 0 ? '' : ' active';
        ?>

        <li class="nav-item">
            <a class="nav-link<?= $active; ?>" id="active-languages-<?= $key; ?>" data-toggle="tab" href="#active-languages-tabs-<?= $key; ?>" role="tab" aria-controls="active-languages-tabs-<?= $key; ?>" aria-selected="<?= $selected; ?>">
                <img src="/images/flags/<?= $lang["flagCode"]; ?>.svg" class="nav-flags mb-1"> <?= $lang["languageNameNative"]; ?>
            </a>
        </li>

        <?php
    $i++;
    endforeach;
    ?>
    </ul>


    <div class="tab-content" id="active-languages-tabContent">
        <?php
        $i = 0;
        foreach(ACTIVE_LANGUAGES as $key => $lang):
            $active = $i > 0 ? '' : ' active show';
            if(!isset( $productData['page_translation'][$key]) || !isset( $productData['page_translation'][$key]['pageName']) )
                $productData['page_translation'][$key]['pageName'] = '';
            if(!isset( $productData['page_translation'][$key]) || !isset( $productData['page_translation'][$key]['metaTitle']) )
                $productData['page_translation'][$key]['metaTitle'] = '';
            if(!isset( $productData['page_translation'][$key]) || !isset( $productData['page_translation'][$key]['metaDescription']) )
                $productData['page_translation'][$key]['metaDescription'] = '';
            if(!isset( $productData['page_translation'][$key]) || !isset( $productData['page_translation'][$key]['productDescription']) )
                $productData['page_translation'][$key]['productDescription'] = '';
            $pt = $productData['page_translation'][$key];
            ?>

            <div class="tab-pane fade<?= $active; ?> p-5" id="active-languages-tabs-<?= $key; ?>" role="tabpanel" aria-labelledby="active-languages-<?= $key; ?>">


                <form method="post" id="translations-form-<?= $key; ?>" action="/vendor_admin/products/ajax_update_product_translation">

                    <label for="add_product_pageName"><?= $this->lang->line('VENDOR_ADMIN_EDIT_PRODUCT_INPUT_LABEL_PAGE_NAME'); ?></label>
                    <div class="form-group mb-4">
                        <input type="text" name="pageName" id="add_product_pageName_<?= $key; ?>" class="form-control" required
                               value="<?= htmlspecialchars_decode($pt['pageName']); ?>" data-minlength="2" maxlength="300">
                    </div>

                    <label for="add_product_metaTitle"><?= $this->lang->line('VENDOR_ADMIN_EDIT_PRODUCT_INPUT_LABEL_META_TITLE'); ?></label>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend lengthCounter">
                            <span class="input-group-text bg-danger" data-important-min-length="50" data-important-max-length="60">0</span>
                        </div>
                        <input type="text" name="metaTitle" id="add_product_metaTitle_<?= $key; ?>" class="form-control inputLengthCounter" required
                               value="<?= htmlspecialchars_decode($pt['metaTitle']); ?>" data-minlength="10" maxlength="300">
                    </div>

                    <label for="add_product_metaDescription"><?= $this->lang->line('VENDOR_ADMIN_EDIT_PRODUCT_INPUT_LABEL_META_DESCRIPTION'); ?></label>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend lengthCounter">
                            <span class="input-group-text bg-danger" data-important-min-length="50" data-important-max-length="160">0</span>
                        </div>
                        <textarea name="metaDescription" id="add_product_metaDescription_<?= $key; ?>" class="form-control inputLengthCounter" required
                                  data-minlength="10" maxlength="300"><?= htmlspecialchars_decode($pt['metaDescription']); ?></textarea>
                    </div>


                    <label for="add_product_productDescription"><?= $this->lang->line('VENDOR_ADMIN_EDIT_PRODUCT_INPUT_LABEL_PRODUCT_DESCRIPTION'); ?></label>
                    <div class="form-group mb-4">
                        <textarea name="productDescription" id="add_product_productDescription_<?= $key; ?>" class="form-control textarea-editor"
                                  data-minlength="10" maxlength="10000"><?= htmlspecialchars_decode($pt['productDescription']); ?></textarea>
                    </div>

                    <div class="form-group mb-4">
                        <input type="hidden" name="language" value="<?= $key; ?>">
                        <input type="hidden" name="pageID" value="<?= $pageID; ?>">
                        <div class="btn btn-primary submitButton">
                            <i class="fa fa-fw fa-save"></i>
                            <?= $this->lang->line('VENDOR_ADMIN_EDIT_PRODUCT_BUTTON_UPDATE_PRODUCT'); ?>
                        </div>
                    </div>

                </form>


            </div>

            <?php
            $i++;
        endforeach;
        ?>
    </div>

</div>

<?php
//dmp( $productData );
//dmp(ACTIVE_LANGUAGES);
?>