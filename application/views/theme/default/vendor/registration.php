
<h1><?= $this->lang->line('VENDOR_REGISTRATION_PAGE_NAME'); ?></h1>
<?php
if(isset($_SESSION['alert'])){
    echo '<p>'. $_SESSION['alert'] .'</p>';
}
if(isset($_SESSION['errors'])){
    echo '<p>'. $_SESSION['errors'] .'</p>';
}
//dmp( substr(convertToUrlFriendly(base64_encode(random_bytes(255)), true), 0, 255) );
?>
<form method="post" id="registration-form" action="/vendor/registration">
    <h2><?= $this->lang->line('VENDOR_REGISTRATION_SUBTITLE_VENDOR_BASIC_DATA'); ?></h2>
    <div class="form-group row">
        <label for="vendor_name" class="col-md-4 col-form-label"><?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_VENDOR_NAME'); ?></label>
        <div class="col-md-8">
            <input id="vendor_name" name="vendor_name" placeholder="<?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_VENDOR_NAME'); ?>" type="text" required="required" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="vendor_address_line_1" class="col-md-4 col-form-label"><?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_ADDRESS_LINE_1'); ?></label>
        <div class="col-md-8">
            <input id="vendor_address_line_1" name="vendor_address_line_1" placeholder="<?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_ADDRESS_LINE_1'); ?>" type="text" required="required" class="form-control">
        </div>
    </div>
    <?php /*
    <div class="form-group row">
        <label for="vendor_address_line_2" class="col-md-4 col-form-label"><?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_ADDRESS_LINE_2'); ?></label>
        <div class="col-md-8">
            <input id="vendor_address_line_2" name="vendor_address_line_2" placeholder="<?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_ADDRESS_LINE_2'); ?>" type="text" required="required" class="form-control">
        </div>
    </div>
 */ ?>
    <div class="form-group row">
        <label for="vendor_city" class="col-md-4 col-form-label"><?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_ADDRESS_CITY'); ?></label>
        <div class="col-md-8">
            <input id="vendor_city" name="vendor_city" placeholder="<?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_ADDRESS_CITY'); ?>" type="text" required="required" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="vendor_zip" class="col-md-4 col-form-label"><?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_ADDRESS_ZIP'); ?></label>
        <div class="col-md-8">
            <input id="vendor_zip" name="vendor_zip" placeholder="<?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_ADDRESS_ZIP'); ?>" type="text" required="required" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="vendor_country" class="col-md-4 col-form-label"><?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_ADDRESS_COUNTRY'); ?></label>
        <div class="col-md-8">
            <select id="vendor_country" name="vendor_country" placeholder="<?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_ADDRESS_COUNTRY'); ?>" required="required" class="form-control">
                <option value=""><?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_ADDRESS_COUNTRY'); ?></option>
                <option value="cz">Czech republic</option>
                <option value="sk">Slovakia</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="vendor_state" class="col-md-4 col-form-label"><?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_ADDRESS_STATE'); ?></label>
        <div class="col-md-8">
            <select id="vendor_state" name="vendor_state" placeholder="<?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_ADDRESS_STATE'); ?>" required="required" class="form-control">
                <option value="xx"><?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_ADDRESS_STATE'); ?></option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        &nbsp;
    </div>
    <h2><?= $this->lang->line('VENDOR_REGISTRATION_SUBTITLE_VENDOR_CONTACT_PERSON'); ?></h2>
    <div class="form-group row">
        <label for="first_name" class="col-md-4 col-form-label"><?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_FIRST_NAME'); ?></label>
        <div class="col-md-8">
            <input id="first_name" name="first_name" placeholder="<?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_FIRST_NAME'); ?>" type="text" required="required" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="last_name" class="col-md-4 col-form-label"><?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_LAST_NAME'); ?></label>
        <div class="col-md-8">
            <input id="last_name" name="last_name" placeholder="<?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_LAST_NAME'); ?>" type="text" required="required" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="phone" class="col-md-4 col-form-label"><?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_PHONE'); ?></label>
        <div class="col-md-8">
            <input id="phone" name="phone" placeholder="<?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_PHONE'); ?>" type="text" class="form-control" required="required">
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label"><?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_EMAIL'); ?></label>
        <div class="col-md-8">
            <input id="email" name="email" placeholder="<?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_EMAIL'); ?>" type="text" class="form-control" required="required">
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label"><?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_PASSWORD'); ?></label>
        <div class="col-md-8">
            <input id="password" name="password" placeholder="<?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_PASSWORD'); ?>" type="password" class="form-control" required="required">
        </div>
    </div>
    <div class="form-group row">
        <label for="password_again" class="col-md-4 col-form-label"><?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_PASSWORD_AGAIN'); ?></label>
        <div class="col-md-8">
            <input id="password_again" name="password_again" placeholder="<?= $this->lang->line('VENDOR_REGISTRATION_INPUT_PLACEHOLDER_PASSWORD_AGAIN'); ?>" type="password" class="form-control" required="required">
        </div>
    </div>
    <div class="form-group row">
        &nbsp;
    </div>
    <div class="form-group row">
        <label class="col-md-4"><?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_AGREE_WITH_TERMS'); ?></label>
        <div class="col-md-8">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input name="terms_and_conditions" id="terms_and_conditions" type="checkbox" required="required" class="custom-control-input" value="agree">
                <label for="terms_and_conditions" class="custom-control-label"><?= $this->lang->line('VENDOR_REGISTRATION_INPUT_NOTE_AGREE_WITH_TERMS'); ?></label>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-4"><?= $this->lang->line('VENDOR_REGISTRATION_INPUT_LABEL_AGREE_WITH_PRIVACY_POLICY'); ?></label>
        <div class="col-md-8">
            <div class="custom-control custom-checkbox custom-control-inline">
                <input name="privacy_policy" id="privacy_policy" type="checkbox" required="required" class="custom-control-input" value="agree">
                <label for="privacy_policy" class="custom-control-label"><?= $this->lang->line('VENDOR_REGISTRATION_INPUT_NOTE_AGREE_WITH_PRIVACY_POLICY'); ?></label>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-4 col-md-8">
            <input type="hidden" name="vendor-registration" value="">
            <button name="submit" type="submit" class="btn btn-primary"><?= $this->lang->line('VENDOR_REGISTRATION_SUBMIT_BUTTON'); ?></button>
        </div>
    </div>
</form>


<div class="row">
    &nbsp;
</div>