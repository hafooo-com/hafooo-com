<?php
$user = $this->ion_auth->user()->row();
$displayName = empty($user->first_name) ? $this->lang->line('TOPBAR_DROPDOWN_USER_ACCOUNT_TITLE') : $user->first_name;
?>

<div class="float-right dropdown">
    <a class="dropdown-toggle" id="dropdownUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-user-circle-o"></i> <span class="d-none d-md-inline-block"> <?= $user->first_name; ?></span>
    </a>
    <div class="dropdown-menu dropdown-menu-right" id="dropdown-user" aria-labelledby="dropdownUser">

        <div class="col">
            <ul class="">
                <li><a href="/user_account"><i class="fa fa-fw fa-user-circle-o"></i>&nbsp; <?= $this->lang->line('TOPBAR_DROPDOWN_USER_ACCOUNT_PROFILE'); ?></a></li>
                <li><a href="/user_account/orders"><i class="fa fa-fw fa-list"></i>&nbsp; <?= $this->lang->line('TOPBAR_DROPDOWN_USER_ACCOUNT_ORDERS'); ?></a></li>
                <li><a href="/user_account/purchased_goods"><i class="fa fa-fw fa-list-alt"></i>&nbsp; <?= $this->lang->line('TOPBAR_DROPDOWN_USER_ACCOUNT_PURCHASED_GOODS'); ?></a></li>
                <li><a href="/user_account/complaints"><i class="fa fa-fw fa-file-text"></i>&nbsp; <?= $this->lang->line('TOPBAR_DROPDOWN_USER_ACCOUNT_COMPLAINTS'); ?></a></li>
                <li><a href="/user/logout"><i class="fa fa-fw fa-sign-out"></i>&nbsp; <?= $this->lang->line('TOPBAR_DROPDOWN_USER_ACCOUNT_LOGOUT'); ?></a></li>
            </ul>
        </div>

    </div>
</div>
