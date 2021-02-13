<?php
$name = '<strong>' . $userData['first_name'] . ' ' . $userData['last_name'] . '</strong>';
$email = '<strong>' . maskEmail($userData['email']) . '</strong>';
?>

<h1><?= $this->lang->line('VENDOR_REGISTRATION_FINISHED_SUCCESSFULLY_PAGE_NAME'); ?></h1>

<article class="text-center">
    <?= nl2br( sprintf($this->lang->line('VENDOR_REGISTRATION_FINISHED_SUCCESSFULLY_MESSAGE'), $name, $email )); ?>
</article>