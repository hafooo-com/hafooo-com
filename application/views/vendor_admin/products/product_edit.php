<?php
$pageID = $productData['page']['pageID'];
?>
<div class="card card-primary card-outline">

    <div class="card-header">
        <h3 class="card-title"><?= current($productData['page_translation'])['pageName']; ?></h3>
    </div>

    <div class="card-body">

        <ul class="nav nav-tabs firstLvlTabs" id="custom-content-below-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="tabs_basic_data" data-toggle="tab" href="#basic_data" role="tab" aria-controls="basic_data" aria-selected="true">
                    <?= $this->lang->line('VENDOR_ADMIN_PRODUCT_EDIT_TABS_BASIC_DATA'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tabs_translations" data-toggle="tab" href="#translations" role="tab" aria-controls="translations" aria-selected="false">
                    <?= $this->lang->line('VENDOR_ADMIN_PRODUCT_EDIT_TABS_TRANSLATIONS'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tabs_price" data-toggle="tab" href="#price" role="tab" aria-controls="price" aria-selected="false">
                    <?= $this->lang->line('VENDOR_ADMIN_PRODUCT_EDIT_TABS_PRICE'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tabs_images" data-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="false">
                    <?= $this->lang->line('VENDOR_ADMIN_PRODUCT_EDIT_TABS_IMAGES'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tabs_attributes" data-toggle="tab" href="#attributes" role="tab" aria-controls="attributes" aria-selected="false">
                    <?= $this->lang->line('VENDOR_ADMIN_PRODUCT_EDIT_TABS_ATTRIBUTES'); ?>
                </a>
            </li>
        </ul>

        <div class="tab-content" id="custom-content-below-tabContent">

            <div class="tab-pane fade active show" id="basic_data" role="tabpanel" aria-labelledby="basic_data-tab">
                <?php require 'tabs/edit_basic_data.php'; ?>
            </div>

            <div class="tab-pane fade" id="translations" role="tabpanel" aria-labelledby="translations-tab">
                <?php require 'tabs/edit_translations.php'; ?>
            </div>

            <div class="tab-pane fade" id="price" role="tabpanel" aria-labelledby="price-tab">
                <?php require 'tabs/edit_price.php'; ?>
            </div>

            <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                <?php require 'tabs/edit_images.php'; ?>
            </div>

            <div class="tab-pane fade" id="attributes" role="tabpanel" aria-labelledby="attributes-tab">
                <?php require 'tabs/edit_attributes.php'; ?>
            </div>

        </div>

    </div>

</div>


<script>
    var pageID = '<?= $pageID; ?>';
    var vendorPreferredCurrency = '<?= $vendor['preferredCurrency']; ?>';
</script>