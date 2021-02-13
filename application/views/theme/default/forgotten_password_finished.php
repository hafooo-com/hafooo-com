<?php
//dmp($userData->email);
$email = maskEmail($userData->email);
?>

<h1><?= $this->lang->line('USER_FORGOTTEN_PASSWORD_FINISHED_PAGE_NAME'); ?></h1>

<div class="text-center">
    <?= sprintf($this->lang->line('USER_FORGOTTEN_PASSWORD_FINISHED_TEXT'), $email); ?>
    <?php // dmp($userData); ?>
</div>
