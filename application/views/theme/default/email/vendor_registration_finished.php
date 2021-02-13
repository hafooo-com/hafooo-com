<?php
$name = $first_name . ' ' . $last_name;
$link = 'https://' . $_SERVER["HTTP_HOST"] . '/vendor/activate/'. $userID .'/'. $activation_code;
?>
<?= nl2br(sprintf( $this->lang->line('VENDOR_REGISTRATION_FINISHED_SUCCESSFULLY_EMAIL_MESSAGE'), $name, $link )); ?>


<div style="width: 308px; height: 58px; margin: 100px auto; background-image: url(<?= 'https://' . $_SERVER["HTTP_HOST"] . '/images/email/activate-user-account-button.png'; ?>)">
    <a href="<?= $link; ?>"
            style="width: 300px; height: 50px; line-height: 50px; margin: 4px; text-align: center; color: #6699FF;
            display: block; font-size: 15px; font-weight: bold; padding-top: 6px; text-shadow: 1px 1px 2px #333;">
        <?=  mb_strtoupper($this->lang->line('VENDOR_REGISTRATION_FINISHED_SUCCESSFULLY_EMAIL_ACTIVATE_BUTTON'), 'UTF-8'); ?>
    </a>
</div>


Na váš e-mail ******* sme vám poslali link na obnovu hesla

