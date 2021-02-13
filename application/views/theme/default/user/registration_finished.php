<?php
$user = $this->ion_auth->user( $this->uri->segment(3) )->row_array();
//dmp($user);
?>

<h1><?= $this->lang->line('USER_REGISTRATION_FINISHED_PAGE_NAME'); ?></h1>

<p>
    <?= sprintf($this->lang->line('USER_REGISTRATION_FINISHED_TEXT'), maskEmail($user['email'])); ?>
</p>



<?php
//dmp($email);
//dmp(get_defined_vars(), 1);