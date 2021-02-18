<?php
$url = $this->uri->uri_string();
$notice = $this->input->get('notice');
if($notice){
    $notice = urldecode($notice);
    $notice = json_decode($notice, true);
}
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vendor | <?= SITE_NAME; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- pace-progress -->
    <link rel="stylesheet" href="/assets/adminlte/plugins/pace-progress/themes/black/pace-theme-flat-top.css">
    <!-- adminlte-->
    <link rel="stylesheet" href="/assets/adminlte/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="/assets/adminlte/plugins/toastr/toastr.min.css">

    <?php if(isset($css)): foreach($css as $sheet): ?>
    <link rel="stylesheet" href="<?= $sheet.kc(); ?>">
    <?php endforeach; endif; ?>

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin/stylesheet.css">

</head>
<body class="hold-transition sidebar-mini pace-primary">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Right navbar links -->

        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    <img src="/images/flags/<?= ACTIVE_LANGUAGES[LANGUAGE]["flagCode"]; ?>.svg" class="nav-flags">
                </a>
                <div class="dropdown-menu dropdown-menu-right p-0" style="left: inherit; right: 0px;">
                    <?php foreach(ACTIVE_LANGUAGES as $key => $lang): ?>

                        <a href="?language=<?= $key; ?>" class="dropdown-item<?php if(LANGUAGE == $key) echo ' active'; ?>">
                            <img src="/images/flags/<?= $lang["flagCode"]; ?>.svg" class="nav-flags"> <?= $lang["languageName"]; ?>
                        </a>

                    <?php endforeach; ?>
                </div>
            </li>

            <!-- Notifications Dropdown Menu -->

            <li class="nav-item">
                <a class="nav-link" href="/vendor_admin/logout" role="button">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-3">
        <!-- Brand Logo -->
        <a href="/vendor_admin" class="brand-link">
            <img src="<?= VENDOR_LOGO; ?>" alt="" style="max-width: 230px">
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="/assets/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">Alexander Pierce</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library  -->
                    <li class="nav-item has-treeview">
                        <a href="/vendor_admin/dashboard" class="nav-link<?= activeLink('/vendor_admin/dashboard', $url); ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p><?= $this->lang->line('VENDOR_COMMON_MAIN_MENU_ITEM_DASHBOARD'); ?></p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview<?= menuOpen('/vendor_admin/products', $url); ?>">
                        <a href="#" class="nav-link<?= activeLink('/vendor_admin/products', $url); ?>">
                            <i class="nav-icon fas fa-boxes"></i>
                            <p><?= $this->lang->line('VENDOR_COMMON_MAIN_MENU_ITEM_PRODUCTS'); ?> <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/vendor_admin/products/products_list" class="nav-link<?= activeLink('/vendor_admin/products/products_list', $url); ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p><?= $this->lang->line('VENDOR_COMMON_MAIN_MENU_ITEM_PRODUCTS_ALL_PRODUCTS'); ?></p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/vendor_admin/products/add_product_form" class="nav-link<?= activeLink('/vendor_admin/products/add_product_form', $url); ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p><?= $this->lang->line('VENDOR_COMMON_MAIN_MENU_ITEM_PRODUCTS_ADD_PRODUCT'); ?></p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="../widgets.html" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Widgets
                                <span class="right badge badge-danger">New</span>
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <?php if($notice): ?>
                <div class="callout callout-<?= $notice['type']; ?> bg-<?= $notice['type']; ?>">
                    <h4><?= $notice['title']; ?></h4>
                    <p><?= $notice['text']; ?></p>
                </div>
            <?php endif; ?>

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><?= $this->lang->line( $pageTitle ); ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Pace</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">


                        <?php if($this->input->get('alert')): ?>
                            <div class="alert alert-<?= $this->input->get('alert'); ?>" role="alert">
                                <?= urldecode($this->input->get('message')); ?>&nbsp;
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

<?php
//dmp(ACTIVE_LANGUAGES);
//dmp(ACTIVE_LANGUAGES[LANGUAGE]["langgCode"]);