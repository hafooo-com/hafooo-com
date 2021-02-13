
<h1><?= $this->lang->line('USER_FORGOTTEN_PASSWORD_PAGE_NAME'); ?></h1>
<?php
//dmp();
?>
<div class="hold-transition login-page">
    <div class="login-box" style="margin-bottom: 15%; width: 360px; margin: auto">
        <div class="card">
            <div class="card-body login-card-body">

                <form action="/user/forgotten_password" method="post" id="forgotten-password-form" data-toggle="validator">
                    <?php if($this->input->get('email') == 'false'): ?>
                    <div class="form-group text-danger">
                        <?= $this->lang->line('USER_FORGOTTEN_PASSWORD_EMAIL_NOT_EXIST'); ?>
                    </div>
                    <?php endif; ?>
                    <label for="forgotten-password-form-email"><?= $this->lang->line('USER_FORGOTTEN_PASSWORD_FORM_INPUT_LABEL_EMAIL'); ?></label>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" name="email" data-error="<?= $this->lang->line('USER_FORGOTTEN_PASSWORD_FORM_ERROR_INVALID_EMAIL'); ?>" required="required"
                                   id="forgotten-password-form-email" placeholder="<?= $this->lang->line('USER_FORGOTTEN_PASSWORD_FORM_INPUT_LABEL_EMAIL'); ?>">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fa fa-envelope"></span></div>
                            </div>
                        </div>
                        <div class="help-block with-errors text-danger"></div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            &nbsp;
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block"><?= $this->lang->line('USER_FORGOTTEN_PASSWORD_FORM_SUBMIT_BUTTON'); ?></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
