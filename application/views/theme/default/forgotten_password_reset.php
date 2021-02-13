
<h1><?= $this->lang->line('USER_FORGOTTEN_PASSWORD_PAGE_NAME');; ?></h1>

<div class="hold-transition login-page">
    <div class="login-box" style="margin-bottom: 15%; width: 360px; margin: auto">
        <div class="card">
            <div class="card-body login-card-body">

                <form action="/user/forgotten_password_reset" method="post" id="forgotten-password-reset-form" data-toggle="validator">
                    <?php if($this->input->get('email') == 'false'): ?>
                        <div class="form-group text-danger">
                            <?= $this->lang->line('USER_FORGOTTEN_PASSWORD_EMAIL_NOT_EXIST'); ?>
                        </div>
                    <?php endif; ?>

                    <label for="forgotten-password-form-password"><?= $this->lang->line('USER_FORGOTTEN_PASSWORD_FORM_INPUT_LABEL_NEW_PASSWORD'); ?></label>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="password"  required="required" maxlength="256" data-minlength="8"
                                   data-error="<?= $this->lang->line('USER_FORGOTTEN_PASSWORD_FORM_ERROR_INVALID_PASSWORD'); ?>"
                                   pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{8,256}$" <?php // ^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*()_+,.\\\/;':-]).{8,256}$ ?>
                                   id="forgotten-password-form-password" placeholder="<?= $this->lang->line('USER_FORGOTTEN_PASSWORD_FORM_INPUT_LABEL_NEW_PASSWORD'); ?>">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fa fa-key"></span></div>
                            </div>
                        </div>
                        <div class="help-block with-errors text-danger"></div>
                    </div>

                    <label for="forgotten-password-form-password-again"><?= $this->lang->line('USER_FORGOTTEN_PASSWORD_FORM_INPUT_LABEL_NEW_PASSWORD_AGAIN'); ?></label>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="password-again" required="required"
                                   data-match="#forgotten-password-form-password" data-match-error="<?= $this->lang->line('USER_FORGOTTEN_PASSWORD_FORM_ERROR_PASSWORD_AGAIN_NOT_MATCH'); ?>"
                                   id="forgotten-password-form-password-again" placeholder="<?= $this->lang->line('USER_FORGOTTEN_PASSWORD_FORM_INPUT_LABEL_NEW_PASSWORD_AGAIN'); ?>">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fa fa-repeat"></span></div>
                            </div>
                        </div>
                        <div class="help-block with-errors text-danger"></div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            &nbsp;
                        </div>
                        <div class="col-6">
                            <input type="hidden" name="id" value="<?= $forgotten_password_selector; ?>">
                            <button type="submit" class="btn btn-primary btn-block"><?= $this->lang->line('USER_FORGOTTEN_PASSWORD_FORM_SUBMIT_BUTTON'); ?></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
