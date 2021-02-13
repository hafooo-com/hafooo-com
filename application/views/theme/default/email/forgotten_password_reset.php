
<?php
$link = 'https://' . $_SERVER["HTTP_HOST"] . '/user/password_reset/'. $forgotten_password_selector ;
?>
<h1><?= $this->lang->line('USER_FORGOTTEN_PASSWORD_RESET_EMAIL_SUBJECT'); ?></h1>
<?= nl2br(sprintf( $this->lang->line('USER_FORGOTTEN_PASSWORD_RESET_EMAIL_MESSAGE'), $link )); ?>


<div style="width: 308px; height: 58px; margin: 100px auto; background-image: url(<?= 'https://' . $_SERVER["HTTP_HOST"] . '/images/email/activate-user-account-button.png'; ?>)">
    <a href="<?= $link; ?>"
       style="width: 300px; height: 50px; line-height: 50px; margin: 4px; text-align: center; color: #6699FF;
            display: block; font-size: 15px; font-weight: bold; padding-top: 6px; text-shadow: 1px 1px 2px #333;">
        <?=  mb_strtoupper($this->lang->line('USER_FORGOTTEN_PASSWORD_RESET_EMAIL_BUTTON'), 'UTF-8'); ?>
    </a>
</div>

