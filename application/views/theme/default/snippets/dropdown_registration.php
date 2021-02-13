
<div class="float-right dropdown">
    <a class="dropdown-toggle" id="dropdownLogin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-user-plus"></i> <span class="d-none d-md-inline-block"> <?php echo $this->lang->line('TOPBAR_DROPDOWN_REGISTRATION_TITLE'); ?></span>
    </a>
    <div class="dropdown-menu dropdown-menu-right" id="dropdown-registration" aria-labelledby="dropdownLogin">

        <div class="col">
            <ul class="">
                <li class="registration-type"><a href="/user/registration"><?php echo $this->lang->line('TOPBAR_DROPDOWN_REGISTRATION_CUSTOMER'); ?></a></li>
                <li class="registration-type"><a href="/vendor/registration"><?php echo $this->lang->line('TOPBAR_DROPDOWN_REGISTRATION_VENDOR'); ?></a></li>
            </ul>
        </div>

    </div>
</div>
