<?php
$name = $first_name . ' ' . $last_name;
$link = 'https://' . $_SERVER["HTTP_HOST"] . '/user/activate/'. $userID .'/'. $activation_code;
?>

    <h1><?= $this->lang->line('USER_REGISTRATION_FINISHED_REGISTRATION_EMAIL_SUBJECT'); ?></h1>
    <p><strong><?= $name; ?></strong></p>
    <p><?= sprintf($this->lang->line('USER_REGISTRATION_FINISHED_REGISTRATION_EMAIL_TEXT'), SITE_NAME, $link); ?></p>

    <div style="width: 308px; height: 58px; margin: 100px auto; background-image: url(<?= 'https://' . $_SERVER["HTTP_HOST"] . '/images/email/activate-user-account-button.png'; ?>)">
        <a href="<?= $link; ?>"
            style="width: 300px; height: 50px; line-height: 50px; margin: 4px; text-align: center; color: #6699FF;
            display: block; font-size: 15px; font-weight: bold; padding-top: 6px; text-shadow: 1px 1px 2px #333;">
            <?=  strtoupper($this->lang->line('USER_REGISTRATION_FINISHED_SUCCESSFULLY_EMAIL_ACTIVATE_BUTTON')); ?>
        </a>
    </div>



