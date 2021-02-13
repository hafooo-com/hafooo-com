

<table id="products-list" class="table table-bordered table-striped">
    <thead class="font-weight-bold">
        <tr>
            <td>Názov produktu</td>
            <td>Kategória</td>
            <td>Cena</td>
            <td>Skladom</td>
            <td>Stav</td>
        </tr>
    </thead>
    <tbody>

    <?php foreach($productsList as $product): ?>
    <?php
        $activationDisabled = '';
        if(empty($product->pageName) || empty($product->productDescription) || empty($product->mainImage)){
            $activationDisabled = ' disabled';
        }
        ?>

    <tr id="tr-products-list-<?= $product->pageID; ?>">
        <td><a href="/vendor_admin/products/product_edit/<?= $product->pageID; ?>"><?= $product->pageName; ?></a></td>
        <td><?= $product->parentPage; ?></td>
        <td style="width: 120px">
            <div class="form-group input-group-sm">
                <select class="form-control">
                <?php  if(!empty($product->price)): foreach($product->price as $price): ?>

                    <option value="" class="text-right"><?= priceFormat($price['price'], $price['currency']); ?></option>

                <?php endforeach; endif; ?>
                </select>
            </div>
        </td>
        <td style="width: 100px">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control text-center" aria-label="" value="<?= $product->stockAmount; ?>" id="product-stock-amount-<?= $product->pageID; ?>">
                <div class="input-group-append">
                    <button class="btn btn-primary product-stock-amount-refresh" type="button" data-pageid="<?= $product->pageID; ?>"> <i class="fa fa-fw fa-sync-alt"></i> </button>
                </div>
            </div>
        </td>
        <td>
            <input type="checkbox" class="product-state" data-size="large" data-pageid="<?= $product->pageID; ?>" data-bootstrap-switch data-toggle="switch" data-off-color="danger"
                   data-on-color="success"<?php if($product->state == 'ACTIVE') echo ' checked'; ?><?= $activationDisabled; ?>>

            <button class="btn btn-sm btn-danger float-right ml-4 delete-button"
                    data-callback="deleteTableRow" data-warning-text="isto načisto?"
                    data-use-ajax="true" data-action-url="/vendor_admin/products/ajax_delete_product/<?= $product->pageID; ?>">
                <i class="fa fa-fw fa-trash"></i>
            </button>

            <a class="btn btn-sm btn-primary float-right ml-4" href="/vendor_admin/products/product_edit/<?= $product->pageID; ?>"> <i class="fa fa-fw fa-edit"></i> </a>
        </td>
    </tr>

    <?php endforeach; ?>

    </tbody>
</table>

<?php
/**
 * @todo
 * https://datatables.net/reference/option/language
 */
//dmp($productsList);
?>

