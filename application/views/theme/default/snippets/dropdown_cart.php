<?php
$totalPrice = 0;
if(!empty($this->cart)){
    foreach($this->cart['item'] as $cartItem){
        $totalPrice += ($cartItem['productQuantity'] * $cartItem['price']);
    }
}
?>

<div class="dropdown float-right" id="dropdown-cart-container">
    <a <?php if(!empty($this->cart)): ?>class="dropdown-toggle"<?php endif; ?> id="dropdown-cart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-shopping-cart"></i> &nbsp;
            <?= $this->lang->line('HEADER_DROPDOWN_CART_TITLqE'); ?>(<small><?= priceFormat( $totalPrice, CURRENCY ); ?>)</small>
        &nbsp;
    </a>
    <?php if(!empty($this->cart)): ?>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownCart">
        <div class="container">
            <div class="shopping-cart">
                <?php /*
                <div class="shopping-cart-header">
                    <?php if(!empty($this->cart)): ?>
<!--                        <i class="fa fa-shopping-cart cart-icon"></i><span class="badge">3</span>-->
                        <div class="shopping-cart-total">
<!--                            <div class="lighter-text">Total:</div>-->
<!--                            <div class="main-color-text">$2,229.97</div>-->
                        </div>
                    <?php else: ?>
                        <?= $this->lang->line('HEADER_DROPDOWN_CART_SUBTITLE_EMPTY'); ?>
                    <?php endif; ?>
                </div>
*/ ?>
                <div class="shopping-cart-items">
                    <?php foreach($this->cart['item'] as $cartItem): ?>

                    <div class="clearfix cart-item">
                        <div class="cart-item-image">
                            <img src="<?= $cartItem['mainImage']; ?>" alt="<?= $cartItem['pageName']; ?>">
                        </div>
                        <div class="cart-item-name"><?= $cartItem['pageName']; ?></div>
                        <div class="cart-item-price"><?= priceFormat( $cartItem['price'] * $cartItem['productQuantity'] , CURRENCY ); ?></div>
                        <div class="cart-item-quantity"><?= $cartItem['productQuantity']; ?>x</div>
                    </div>

                    <?php endforeach; ?>

                    <div class="clearfix cart-total">
                        <div class="cart-total-title"><?= $this->lang->line('HEADER_DROPDOWN_CART_TOTAL_PRICE'); ?></div>
                        <div class="cart-total-price"><?= priceFormat( $totalPrice, CURRENCY ); ?></div>
                    </div>

                </div>

                <div class="shopping-cart-buttons clearfix">
                    <a href="/cart" class="btn btn-success pull-left"><?= $this->lang->line('HEADER_DROPDOWN_CART_BUTTON_CART'); ?></a>
                    <a href="/checkout" class="btn btn-primary pull-right"><?= $this->lang->line('HEADER_DROPDOWN_CART_BUTTON_CHECKOUT'); ?></a>
                </div>

            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
