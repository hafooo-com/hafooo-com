<?php
$errorFields = explode('-', $this->input->get('errorFields'));
?>

<h1 class="d-none d-md-block"><?= $pageName; ?></h1>

<?= $userAccountMenu; ?>

<div class="col-lg-8 offset-lg-2">
    <form method="post" id="user-details-form" action="/user_account/update_details" class="user-account-form">

        <div class="form-group row">
            <label for="first_name" class="col-md-4 col-form-label"><?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_LABEL_FIRST_NAME'); ?></label>
            <div class="col-md-8">
                <input id="first_name" name="first_name" placeholder="<?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_LABEL_FIRST_NAME'); ?>"
                       value="<?= fillInputValue($this->input->get('first_name'), $user->first_name); ?>" data-minlength="2"
                       data-error="<?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_ERROR_FIRST_NAME'); ?>" type="text" required="required" class="form-control">
                <div class="help-block with-errors text-danger"><?php if(markErrorField($errorFields, 'first_name')) echo $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_ERROR_FIRST_NAME'); ?></div>
            </div>
        </div>

        <div class="form-group row">
            <label for="last_name" class="col-md-4 col-form-label"><?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_LABEL_LAST_NAME'); ?></label>
            <div class="col-md-8">
                <input id="last_name" name="last_name" placeholder="<?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_LABEL_LAST_NAME'); ?>"
                       value="<?= fillInputValue($this->input->get('last_name'), $user->last_name); ?>" data-minlength="2"
                       data-error="<?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_ERROR_LAST_NAME'); ?>"  type="text" required="required" class="form-control">
                <div class="help-block with-errors text-danger"><?php if(markErrorField($errorFields, 'last_name')) echo $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_ERROR_LAST_NAME'); ?></div>
            </div>
        </div>

        <div class="form-group row">
            <label for="phone" class="col-md-4 col-form-label"><?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_LABEL_PHONE'); ?></label>
            <div class="col-md-8">
                <input id="phone" name="phone" placeholder="<?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_LABEL_PHONE'); ?>" pattern="^\+[0-9- ]{9,18}$"
                       value="<?= fillInputValue($this->input->get('phone'), $user->phone); ?>"
                       data-error="<?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_ERROR_PHONE'); ?>" type="text" class="form-control" required="required">
                <div class="help-block with-errors text-danger"><?php if(markErrorField($errorFields, 'phone')) echo $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_ERROR_PHONE'); ?></div>
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label"><?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_LABEL_EMAIL'); ?></label>
            <div class="col-md-8">
                <input id="email" name="email" placeholder="<?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_LABEL_EMAIL'); ?>"
                       value="<?= fillInputValue($this->input->get('email'), $user->email); ?>"
                       data-error="<?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_ERRORL_EMAIL'); ?>" type="email" class="form-control" required="required">
                <div class="help-block with-errors text-danger">
                    <?php if(markErrorField($errorFields, 'valid_email')) echo $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_ERRORL_EMAIL'); ?>
                    <?php if(markErrorField($errorFields, 'email_unique')) echo $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_ERRORL_EMAIL_UNIQUE'); ?>
                </div>
            </div>
        </div>


        <div class="form-group row">
            <label class="col-md-4"><?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_LABEL_AGREE_WITH_TERMS'); ?></label>
            <div class="col-md-8">
                <div class="custom-control custom-checkbox custom-control-inline">
                    <input name="terms_consent" id="terms_consent" type="checkbox" required="required" class="custom-control-input"
                        <?php if($user->terms_consent == 'Y' && !in_array('terms_consent', $errorFields)) echo 'checked'; ?>
                           data-error="<?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_ERROR_AGREE_WITH_TERMS'); ?>" value="Y">
                    <label for="terms_consent" class="custom-control-label"><?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_NOTE_AGREE_WITH_TERMS'); ?></label>
                </div>
                <div class="help-block with-errors text-danger"><?php if(markErrorField($errorFields, 'terms_consent')) echo $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_ERROR_AGREE_WITH_TERMS'); ?></div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4"><?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_LABEL_AGREE_WITH_PRIVACY_POLICY'); ?></label>
            <div class="col-md-8">
                <div class="custom-control custom-checkbox custom-control-inline">
                    <input name="privacy_policy_consent" id="privacy_policy_consent" type="checkbox" required="required" class="custom-control-input"
                        <?php if($user->privacy_policy_consent == 'Y' && !in_array('privacy_policy_consent', $errorFields)) echo 'checked'; ?>
                           data-error="<?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_ERROR_AGREE_WITH_PRIVACY_POLICY'); ?>" value="Y">
                    <label for="privacy_policy_consent" class="custom-control-label"><?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_NOTE_AGREE_WITH_PRIVACY_POLICY'); ?></label>
                </div>
                <div class="help-block with-errors text-danger"><?php if(markErrorField($errorFields, 'privacy_policy_consent')) echo $this->lang->line('USER_ACCOUNT_USER_DETAILS_INPUT_ERROR_AGREE_WITH_PRIVACY_POLICY'); ?></div>
            </div>
        </div>

        <div class="form-group row">
            <div class="offset-4 col-8">
                <input type="hidden" name="id" value="<?= $user->id; ?>">
                <button name="submit" type="submit" class="btn btn-primary"><?= $this->lang->line('USER_ACCOUNT_USER_DETAILS_SUBMIT_BUTTON'); ?></button>
            </div>
        </div>

    </form>

</div>

