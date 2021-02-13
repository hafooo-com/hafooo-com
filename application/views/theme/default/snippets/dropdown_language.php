<?php
//$allowedLanguages = json_decode(ALLOWED_LANGUAGES, true);
//dmp(ACTIVE_LANGUAGES);
?>

<div class="float-left dropdown">
    <a class="dropdown-toggle" id="dropdownLogin" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="/images/flags/<?=  ACTIVE_LANGUAGES[LANGUAGE]['flagCode']; ?>.svg" alt="" class="current-language-flag">
        <span class="d-none d-md-inline-block"> <?php echo $this->lang->line('TOPBAR_DROPDOWN_LANGUAGE_TITLE'); ?></span>
    </a>
    <div class="dropdown-menu" id="dropdown-language" aria-labelledby="dropdownLogin">

        <div class="col">
            <ul>
                <?php foreach(ACTIVE_LANGUAGES as $lang): ?>
                <li class="language-flag">
                    <a href="?language=<?= $lang['languageCode']; ?>">
                        <img src="/images/flags/<?= $lang['flagCode']; ?>.svg" alt="<?= $lang['languageNameNative']; ?>">
                        <p><?= $lang['languageNameNative']; ?></p>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>
</div>


