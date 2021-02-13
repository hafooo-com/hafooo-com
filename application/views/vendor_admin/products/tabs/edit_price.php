

<div class="container-fluid">

    <h3 class="pt-4"><?= $this->lang->line('VENDOR_ADMIN_PRODUCT_EDIT_TAB_TITLE_PRICE'); ?></h3>

    <p class="pb-4"><em><?= $this->lang->line('VENDOR_ADMIN_PRODUCT_EDIT_TAB_PRICE_ANNOTATION'); ?></em></p>

    <div class="row">

        <div class="col-xl-8">

            <table class="table table-responsive">

            <?php
            foreach($allCurrencies as $currency):
                $price = isset($productData['product_price'][$currency['currencyCode']]) ? $productData['product_price'][$currency['currencyCode']]['price'] : 0;
                $disabled = $currency['currencyCode'] == $vendor['preferredCurrency'] ? 'disabled' : '';
                ?>

                <tr>
                    <td>
                        <?= $currency['currencyCode']; ?><br>
                        <small><?= $currency['currencyNameEnglish']; ?> (<?= $currency['currencyNameNative']; ?>)</small>
                    </td>
                    <td><input type="text" value="<?= $price; ?>" id="product-price-input-<?= $currency['currencyCode']; ?>" name="price[<?= $currency['currencyCode']; ?>]" class="form-control text-right"></td>
                    <td>
                        <button class="btn btn-default product-price-button-recalc" <?= $disabled; ?> data-currency-code="<?= $currency['currencyCode']; ?>" id="product-price-button-recalc-<?= $currency['currencyCode']; ?>">
                            <i class="fas fa-fw fa-calculator"></i> <?= $this->lang->line('VENDOR_ADMIN_PRODUCT_EDIT_TAB_PRICE_BUTTON_COMPUTE_PRICE'); ?>
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-primary product-price-button-save"   data-currency-code="<?= $currency['currencyCode']; ?>" id="product-price-button-save-<?= $currency['currencyCode']; ?>">
                            <i class="fas fa-fw fa-save"></i> <?= $this->lang->line('VENDOR_ADMIN_PRODUCT_EDIT_TAB_PRICE_BUTTON_SAVE_PRICE'); ?>
                        </button>
                    </td>
                </tr>

            <?php endforeach; ?>
            </table>

        </div>

    </div>
</div>

<?php
//dmp($vendor);
//dmp($allCurrencies);
//dmp($productData['product_price']);
?>
