
<h1><?= $this->lang->line('USER_LOGIN_PAGE_NAME'); ?></h1>

<div class="row">
    <div class="col-md-4 offset-md-4">
        <form method="post">
            <div class="form-group">
                <label for="userName"><?= $this->lang->line('USER_LOGIN_INPUT_LABEL_USER_NAME'); ?></label>
                <input id="userName" name="userName" placeholder="<?= $this->lang->line('USER_LOGIN_INPUT_LABEL_USER_NAME'); ?>" type="text" required="required" class="form-control">
            </div>
            <div class="form-group">
                <label for="login_password"><?= $this->lang->line('USER_LOGIN_INPUT_LABEL_PASSWORD'); ?></label>
                <input id="login_password" name="password" placeholder="<?= $this->lang->line('USER_LOGIN_INPUT_LABEL_PASSWORD'); ?>" type="password" aria-describedby="passwordHelpBlock" required="required" class="form-control">
            </div>
            <div class="form-group">
                <input type="checkbox" id="remember" name="remember" value="remember">
                <label for="remember"><?php echo $this->lang->line('TOPBAR_DROPDOWN_LOGIN_BOX_REMEMBER_LABEL'); ?></label>
            </div>
            <div class="form-group">
                <button name="submit" type="submit" class="btn btn-primary"><?= $this->lang->line('USER_LOGIN_INPUT_LABEL_PASSWORD'); ?></button>
            </div>
            <div class="form-group">
                <a href="/user/forgotten_password"><?= $this->lang->line('USER_LOGIN_LINK_FORGOT_PASSWORD'); ?></a>
            </div>
        </form>
    </div>
</div>
