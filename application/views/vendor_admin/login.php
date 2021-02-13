<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vendor | <?= SITE_NAME; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/assets/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="/assets/adminlte/dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box" style="margin-bottom: 15%">
    <div class="login-logo">
        <a href="/vendor">
            <img src="<?= VENDOR_LOGO; ?>">
        </a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">

            <form action="/vendor_admin" method="post">
                <label for="userName"><?= $this->lang->line('VENDOR_COMMON_LOGIN_INPUT_LABEL_USER_NAME'); ?></label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="userName" id="userName" placeholder="<?= $this->lang->line('VENDOR_COMMON_LOGIN_INPUT_LABEL_USER_NAME'); ?>" value="kukis.sk@gmail.com">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                </div>
                <label for="password"><?= $this->lang->line('VENDOR_COMMON_LOGIN_INPUT_LABEL_PASSWORD'); ?></label>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="<?= $this->lang->line('VENDOR_COMMON_LOGIN_INPUT_LABEL_PASSWORD'); ?>" value="BMW525tds">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember" value="remember">
                            <label for="remember"><?= $this->lang->line('VENDOR_COMMON_LOGIN_INPUT_LABEL_PERMANENT_LOGIN'); ?></label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block"><?= $this->lang->line('VENDOR_COMMON_LOGIN_SUBMIT_BUTTON'); ?></button>
                    </div>
                </div>
            </form>

            <p class="mb-1">
                <a href="/user/forgotten_password"><?= $this->lang->line('VENDOR_COMMON_LOGIN_LINK_FORGOT_PASSWORD'); ?></a>
            </p>
        </div>
    </div>
</div>
<!--<script src="/assets/adminlte/plugins/jquery/jquery.min.js"></script>-->
<!--<script src="/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>-->
<!--<script src="/assets/adminlte/dist/js/adminlte.min.js"></script>-->
</body>
</html>