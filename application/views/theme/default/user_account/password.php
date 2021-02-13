
<h1 class="d-none d-md-block"><?= $pageName; ?></h1>

<?= $userAccountMenu; ?>

<div class="col-lg-8 offset-lg-2">

    <form method="post" id="password-form" action="/user_account/update_password" class="user-account-form">

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label"><?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_LABEL_PASSWORD'); ?></label>
            <div class="col-md-8">
                <input id="password" name="password" placeholder="<?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_LABEL_PASSWORD'); ?>" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$"
                       data-error="<?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_ERROR_PASSWORD'); ?>" type="password" requuired="requuired" class="form-control">
                <!--                       ^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$-->
                <div class="help-block with-errors text-danger"><?php if(markErrorField($errorFields, 'password')) echo $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_ERROR_PASSWORD'); ?></div>
            </div>
        </div>

        <div class="form-group row">
            <label for="password_again" class="col-md-4 col-form-label"><?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_LABEL_PASSWORD_AGAIN'); ?></label>
            <div class="col-md-8">
                <input id="password_again" name="password_again" placeholder="<?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_LABEL_PASSWORD_AGAIN'); ?>" data-match="#password"
                       data-error="<?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_ERROR_PASSWORD_AGAIN'); ?>"  type="password" requuired="requuired" class="form-control">
                <div class="help-block with-errors text-danger"><?php if(markErrorField($errorFields, 'password_again')) echo $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_ERROR_PASSWORD_AGAIN'); ?></div>
            </div>
        </div>

        <div class="form-group row">
            <div class="offset-4 col-8">
                <input type="hidden" name="id" value="<?= $user->id; ?>">
                <button name="submit" type="submit" class="btn btn-primary"><?= $this->lang->line('USER_ACCOUNT_PASSWORD_SUBMIT_BUTTON'); ?></button>
            </div>
        </div>

    </form>

</div>


