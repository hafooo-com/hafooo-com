<?php if($this->input->get('alert')): ?>
<div class="alert alert-<?= $this->input->get('alert'); ?>" role="alert">
    <?= urldecode($this->input->get('message')); ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif; ?>

<nav class="navbar-expand-md navbar-light" id="user-account-menu">

    <strong><a class="navbar-brand d-md-none" href="#"><?= $pageName; ?></a></strong>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#user-account-collapse" aria-controls="user-account-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="user-account-collapse">
        <ul class="navbar-nav"><!--  mr-auto -->

            <li class="nav-item active"><!-- active -->
                <a class="nav-link" href="/user_account"><i class="fa fa-fw fa-user-circle-o"></i><?= $this->lang->line('USER_ACCOUNT_BUTTON_PROFILE'); ?></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/user_account/password"><i class="fa fa-fw fa-key"></i><?= $this->lang->line('USER_ACCOUNT_BUTTON_CHANGE_PASSWORD'); ?></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/user_account/address_book"><i class="fa fa-fw fa-address-book-o"></i><?= $this->lang->line('USER_ACCOUNT_ADDRESS_BOOK_PAGE_NAME'); ?></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/user_account/orders"><i class="fa fa-fw fa-list"></i><?= $this->lang->line('USER_ACCOUNT_BUTTON_ORDERS'); ?></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/user_account/purchased_goods"><i class="fa fa-fw fa-list-alt"></i><?= $this->lang->line('USER_ACCOUNT_BUTTON_PURCHASED_GOODS'); ?></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/user_account/complaints"><i class="fa fa-fw fa-file-text"></i><?= $this->lang->line('USER_ACCOUNT_BUTTON_COMPLAINTS'); ?></a>
            </li>

        </ul>
    </div>

</nav>


