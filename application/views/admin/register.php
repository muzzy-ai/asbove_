<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="<?= base_url('assets/landing') ?>/img/LOGOASBOVE.jpeg" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <img src="<?= base_url('assets/landing') ?>/img/LOGOASBOVE.jpeg" alt="logo" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">

                            <h4>Register Account</h4>
                            <h6 class="font-weight-light">Create your account to continue.</h6>

                            <?= $this->session->flashdata('message'); ?>
                            
                            <form class="pt-3" action="<?= base_url('Register'); ?>" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" name="username" placeholder="Username" required value="<?= set_value('username'); ?>">
                                    <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" required>
                                    <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" name="password_confirm" placeholder="Confirm Password" required>
                                    <?= form_error('password_confirm', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">REGISTER</button>
                                </div>
                                <div class="text-center mt-3">
                                    <a href="<?= base_url('Login'); ?>" class="btn btn-block btn-secondary btn-lg font-weight-medium auth-form-btn">BACK TO LOGIN</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/admin') ?>/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?= base_url('assets/admin') ?>/js/off-canvas.js"></script>
    <script src="<?= base_url('assets/admin') ?>/js/hoverable-collapse.js"></script>
    <script src="<?= base_url('assets/admin') ?>/js/template.js"></script>
    <script src="<?= base_url('assets/admin') ?>/js/settings.js"></script>
    <script src="<?= base_url('assets/admin') ?>/js/todolist.js"></script>
</body>

</html>
