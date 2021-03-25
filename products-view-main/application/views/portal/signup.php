<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= $page_title ?></title>
        <link rel="icon" href="<?= base_url('assets') ?>/images/favicon.png" sizes="32x32" />
        <link rel="icon" href="<?= base_url('assets') ?>/images/favicon.png" sizes="192x192" />
        <link rel="apple-touch-icon-precomposed" href="<?= base_url('assets') ?>/images/favicon.png" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('assets') ?>/styles/css/style.css">
        <link rel="stylesheet" href="<?= base_url('assets') ?>/styles/css/custom.css">
    </head>

    <body>
        <div class="auth-layout-wrap"  style="background:#f7f7f7;">
            <div class="auth-content" style="width: 100%; max-width: 70%">
                <div class="card o-hidden text-center" style="background:none; box-shadow:none">
                    <div class="row" style="background:#f7f7f7;">
                        <div class="col-md-2"></div>
                        <div class="col-md-8" style="background:#f7f7f7;">
                            <div class="p-4">
                                <div class="auth-logo text-center mb-4">
                                    <img src="<?= base_url('assets') ?>/images/logo.png">
                                </div>
                                <h1 class=" text-18">Sign Up</h1>
                                <p class="text-muted text-small">You can change this information from your account settings</p>
                                <?php if ($this->session->flashdata('no_user_access')) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= $this->session->flashdata('no_user_access') ?>
                                    </div>
                                <?php } ?>
                                <?php if ($this->session->flashdata('signup_success')) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= $this->session->flashdata('signup_success') ?>
                                    </div>
                                <?php } ?>
                                <?php //echo validation_errors(); ?>
                                <form method="post" action="<?= base_url('signup') ?>"  enctype="multipart/form-data">
                                    <input type="hidden" name="user_role_id" value="2">
                                    <input type="hidden" name="active" value="1">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">First Name</label> <span class="text-danger">*</span>
                                                <input id="first_name" name="first_name" value="<?= set_value('first_name'); ?>" required="" class="form-control form-control-rounded" type="text">
                                                <?php echo form_error('first_name', '<div class="text-danger">', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Last Name</label> <span class="text-danger">*</span>
                                                <input id="last_name" name="last_name" value="<?= set_value('last_name'); ?>" required="" class="form-control  form-control-rounded" type="text">
                                                <?php echo form_error('last_name', '<div class="text-danger">', '</div>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label> <span class="text-danger">*</span>
                                        <input id="email" name="email" required="" value="<?= set_value('email'); ?>" class="form-control form-control-rounded" type="email">
                                        <?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password">Password</label> <span class="text-danger">*</span>
                                                <input id="password" name="password" required="" class="form-control form-control-rounded" type="password">
                                                <?php echo form_error('password', '<div class="text-danger">', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password">Confirm Password</label> <span class="text-danger">*</span>
                                                <input id="passconf" name="passconf" required="" class="form-control form-control-rounded" type="password">
                                                <?php echo form_error('passconf', '<div class="text-danger">', '</div>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-rounded btn-primary btn-block mt-2" style="    background: linear-gradient(to bottom, #6ff0fd, #43aee3) !important;
">Sign Up</button>

                                </form>

                                <div class="mt-3 text-center">
                                    <a href="<?= base_url('signin') ?>" class="text-muted"><u>Sign in</u></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .pt-5{
                padding-top: 6rem !important;
            }
            .pb-5{
                padding-bottom: 6rem !important;
            }
        </style>
        <script src="<?= base_url('assets') ?>/js/vendor/jquery-3.3.1.min.js"></script>
        <script src="<?= base_url('assets') ?>/js/vendor/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url('assets') ?>/js/es5/script.min.js"></script>
    </body>

</html>