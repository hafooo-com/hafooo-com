
<div class="float-right dropdown">
    <a class="dropdown-toggle" id="dropdownLogin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-user-circle-o"></i> <span class="d-none d-md-inline-block"> <?php echo $this->lang->line('TOPBAR_DROPDOWN_LOGIN_TITLE'); ?></span>
    </a>
    <div class="dropdown-menu dropdown-menu-right" id="dropdown-login" aria-labelledby="dropdownLogin">

        <div class="col">
            <form method="post">
                <div class="form-group">
                    <label for="userName_topBar"><?php echo $this->lang->line('TOPBAR_DROPDOWN_LOGIN_BOX_USERNAME_LABEL'); ?></label>
                    <input id="userName_topBar" name="userName" placeholder="<?php echo $this->lang->line('TOPBAR_DROPDOWN_LOGIN_BOX_USERNAME_LABEL'); ?>" type="text" required="required" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password_topBar"><?php echo $this->lang->line('TOPBAR_DROPDOWN_LOGIN_BOX_PASSWORD_LABEL'); ?></label>
                    <input id="password_topBar" name="password" placeholder="<?php echo $this->lang->line('TOPBAR_DROPDOWN_LOGIN_BOX_PASSWORD_LABEL'); ?>" type="password" aria-describedby="passwordHelpBlock" required="required" class="form-control">
                </div>
                <div class="form-group">
                    <label for="remember"><?php echo $this->lang->line('TOPBAR_DROPDOWN_LOGIN_BOX_REMEMBER_LABEL'); ?></label>
                    <input type="checkbox" id="remember" name="remember" value="remember">
                </div>
                <div class="form-group">
                    <button name="submit" type="submit" class="btn btn-primary"><?php echo $this->lang->line('TOPBAR_DROPDOWN_LOGIN_BOX_SUBMIT_BUTTON'); ?></button>
                </div>
                <div class="form-group">
                    <a href="/user/forgotten_password"><?= $this->lang->line('TOPBAR_DROPDOWN_LOGIN_BOX_FORGOT_LOGIN_DETAILS'); ?></a>
                </div>
            </form>
        </div>

    </div>
</div>
