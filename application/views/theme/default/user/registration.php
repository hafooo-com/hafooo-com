
<h1><?= $this->lang->line('USER_REGISTRATION_PAGE_NAME'); ?></h1>
<?php
if(isset($_SESSION['alert'])){
    echo '<p>'. $_SESSION['alert'] .'</p>';
}
if(isset($_SESSION['errors'])){
    echo '<p>'. $_SESSION['errors'] .'</p>';
}
//dmp($this->page);
?>
<form method="post" id="registration-form" action="/user/registration">
    <?php /*
    <div class="form-group row">
        <label for="first_name" class="col-4 col-form-label"><?= $this->lang->line('USER_REGISTRATION_INPUT_LABEL_FIRST_NAME'); ?></label>
        <div class="col-8">
            <input id="first_name" name="first_name" placeholder="<?= $this->lang->line('USER_REGISTRATION_INPUT_LABEL_FIRST_NAME'); ?>" type="text" required="required" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="last_name" class="col-4 col-form-label"><?= $this->lang->line('USER_REGISTRATION_INPUT_LABEL_LAST_NAME'); ?></label>
        <div class="col-8">
            <input id="last_name" name="last_name" placeholder="<?= $this->lang->line('USER_REGISTRATION_INPUT_LABEL_LAST_NAME'); ?>" type="text" required="required" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="phone" class="col-4 col-form-label"><?= $this->lang->line('USER_REGISTRATION_INPUT_LABEL_PHONE'); ?></label>
        <div class="col-8">
            <input id="phone" name="phone" placeholder="<?= $this->lang->line('USER_REGISTRATION_INPUT_LABEL_PHONE'); ?>" type="text" class="form-control" required="required">
        </div>
    </div>
 */ ?>
    <div class="form-group row">
        <label for="email" class="col-4 col-form-label"><?= $this->lang->line('USER_REGISTRATION_INPUT_LABEL_EMAIL'); ?></label>
        <div class="col-8">
            <input id="email" name="email" placeholder="<?= $this->lang->line('USER_REGISTRATION_INPUT_LABEL_EMAIL'); ?>" type="text" class="form-control" required="required">
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-4 col-form-label"><?= $this->lang->line('USER_REGISTRATION_INPUT_LABEL_PASSWORD'); ?></label>
        <div class="col-8">
            <input id="password" name="password" placeholder="<?= $this->lang->line('USER_REGISTRATION_INPUT_LABEL_PASSWORD'); ?>" type="password" class="form-control" required="required">
        </div>
    </div>
    <div class="form-group row">
        <label for="password_again" class="col-4 col-form-label"><?= $this->lang->line('USER_REGISTRATION_INPUT_LABEL_PASSWORD_AGAIN'); ?></label>
        <div class="col-8">
            <input id="password_again" name="password_again" placeholder="<?= $this->lang->line('USER_REGISTRATION_INPUT_LABEL_PASSWORD_AGAIN'); ?>" type="password" class="form-control" required="required">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-4"><?= $this->lang->line('@@@ USER_REGISTRATION_INPUT_LABEL_AGREE_WITH_TERMS'); ?></label>
        <div class="col-8">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input name="terms_and_conditions" id="terms_and_conditions" type="checkbox" required="required" class="custom-control-input" value="agree">
                <label for="terms_and_conditions" class="custom-control-label"><?= $this->lang->line('USER_REGISTRATION_INPUT_LABEL_AGREE_WITH_TERMS'); ?></label>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-4"><?= $this->lang->line('@@@ USER_REGISTRATION_INPUT_LABEL_AGREE_WITH_PRIVACY_POLICY'); ?></label>
        <div class="col-8">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input name="privacy_policy" id="privacy_policy" type="checkbox" required="required" class="custom-control-input" value="agree">
                <label for="privacy_policy" class="custom-control-label"><?= $this->lang->line('USER_REGISTRATION_INPUT_LABEL_AGREE_WITH_PRIVACY_POLICY'); ?></label>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-4 col-8">
            <input type="hidden" name="user-registration" value="">
            <button name="submit" type="submit" class="btn btn-primary"><?= $this->lang->line('USER_REGISTRATION_SUBMIT_BUTTON'); ?></button>
        </div>
    </div>
</form>

