<?php
$blocks['dropdown_language']     = $this->load->view('theme/'. CURRENT_THEME .'/snippets/dropdown_language', array(), true);
$blocks['dropdown_currency']     = $this->load->view('theme/'. CURRENT_THEME .'/snippets/dropdown_currency', array(), true);
$blocks['dropdown_login']        = $this->load->view('theme/'. CURRENT_THEME .'/snippets/dropdown_login', array(), true);
$blocks['dropdown_registration'] = $this->load->view('theme/'. CURRENT_THEME .'/snippets/dropdown_registration', array(), true);
$blocks['dropdown_cart']         = $this->load->view('theme/'. CURRENT_THEME .'/snippets/dropdown_cart', array(), true);
$blocks['dropdown_user']         = $this->load->view('theme/'. CURRENT_THEME .'/snippets/dropdown_user', array(), true);

//dmp($seoTexts);
    if(!isset($seoTexts)){
        $seoTexts = array(
            'metaDescription' => '',
            'metaTitle' => SITE_NAME,
        );
    }
?><!doctype html>
<html lang="<?= LANGUAGE; ?>" dir="<?= strtolower(ACTIVE_LANGUAGES[LANGUAGE]["textDirection"]); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?= $seoTexts['metaDescription']; ?>">
    <meta name="author" content="<?= AUTHOR; ?>">
    <meta name="generator" content="<?= GENERATOR; ?>">

    <link href="/theme/<?= CURRENT_THEME; ?>/assets/bootstrap/css/bootstrap.css<?= kc(); ?>" rel="stylesheet">
    <link href="/theme/<?= CURRENT_THEME; ?>/assets/fontawesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/theme/<?= CURRENT_THEME; ?>/css/style.css<?= kc(); ?>" rel="stylesheet">

    <title><?= $seoTexts['metaTitle']; ?></title>

<?php /*
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/4.5/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon.ico">
    <meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@getbootstrap">
    <meta name="twitter:creator" content="@getbootstrap">
    <meta name="twitter:title" content="Download">
    <meta name="twitter:description" content="Download Bootstrap to get the compiled CSS and JavaScript, source code, or include it with your favorite package managers like npm, RubyGems, and more.">
    <meta name="twitter:image" content="https://getbootstrap.com/docs/4.5/assets/brand/bootstrap-social-logo.png">

    <!-- Facebook -->
    <meta property="og:url" content="https://getbootstrap.com/docs/4.5/getting-started/download/">
    <meta property="og:title" content="Download">
    <meta property="og:description" content="Download Bootstrap to get the compiled CSS and JavaScript, source code, or include it with your favorite package managers like npm, RubyGems, and more.">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://getbootstrap.com/docs/4.5/assets/brand/bootstrap-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
*/ ?>
</head>

<body>

<div id="top-bar">
    <div class="container">
        <?= $blocks['dropdown_language'] ?>
        <?= $blocks['dropdown_currency'] ?>
        <?php if (!$this->ion_auth->logged_in()): ?>
        <?= $blocks['dropdown_registration'] ?>
        <?= $blocks['dropdown_login'] ?>
        <?php else: ?>
        <?= $blocks['dropdown_user'] ?>
        <?php endif; ?>
    </div>
</div>

<header>
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-4 order-1 order-md-1">
                <a href="/" id="logo"><img src="/theme/<?= CURRENT_THEME; ?>/images/logo-header.png" alt="<?= SITE_NAME; ?> logo"></a>
            </div>
            <div class="col-12 col-md-5 order-3 order-md-2">

                <form action="#" class="search" id="search-form">
                    <div class="input-group w-100">
                        <input type="text" class="form-control" placeholder="<?= $this->lang->line('HEADER_SEARCH_PLPACEHOLDER'); ?>">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="col-6 col-md-3 order-2 order-md-3">
                <?= $blocks['dropdown_cart'] ?>
            </div>
        </div>
<!--        <nav aria-label="breadcrumb" id="breadcrumb">-->
<!--            <ol class="breadcrumb">-->
<!--                <li class="breadcrumb-item"><a href="#">Home</a></li>-->
<!--                <li class="breadcrumb-item"><a href="#">Library</a></li>-->
<!--                <li class="breadcrumb-item active" aria-current="page">Data</li>-->
<!--            </ol>-->
<!--        </nav>-->
    </div>
</header>

<?php $this->load->view('theme/'. CURRENT_THEME .'/snippets/main_navigation', array()); ?>




<div id="content">
    <div class="container">
