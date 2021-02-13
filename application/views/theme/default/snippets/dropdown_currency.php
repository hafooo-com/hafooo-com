
<div class="float-left dropdown">
    <a class="dropdown-toggle" id="dropdownLogin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <strong><?= CURRENCY; ?></strong> <span class="d-none d-md-inline-block"> <?php echo $this->lang->line('TOPBAR_DROPDOWN_CURRENCY_TITLE'); ?></span>
    </a>
    <div class="dropdown-menu" id="dropdown-currency" aria-labelledby="dropdownLogin">

        <div class="col">
            <ul class="">
                <?php foreach($this->currencyTable as $currency): ?>
                <li class="currency-select">
                    <a href="?currency=<?= $currency['currencyCode']; ?>">
                        <strong class="text-monospace"><?= $currency['currencyCode']; ?></strong> (<?= $currency['currencyNameNative']; ?>)
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>
</div>
