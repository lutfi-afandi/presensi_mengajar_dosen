<?php include('layout/v_head.php') ?>

<body style="background-image: url('<?= base_url(); ?>/assets/img/cover.jpg'); background-position: center;
    background-repeat: no-repeat;
    background-size: cover; " class="hold-transition login-page">
    <div class="login-box">
        <div class="card-body bg-gray-light">

            <div class="login-logo">
                <img src="<?= base_url(); ?>/assets/img/logo.png" alt="" width="100px">
            </div>
        </div>
        <!-- /.login-logo -->
        <div class="card-body login-card-body">
            <p class="login-box-msg"><b>Silahkan Login</b></p>
            <?= form_open('Login/cek_login') ?>
            <div class="form-group has-feedback">
                <input autofocus type="text" class="form-control <?= ($validation->hasError('username')) ? "is-invalid" : ""; ?>" placeholder="Username" autocomplete="" name="username" value="<?= old('username'); ?>">
                <span class="error invalid-feedback"><?= $validation->getError('username'); ?></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control <?= ($validation->hasError('password')) ? "is-invalid" : ""; ?>" name="password" placeholder="Password" value="<?= old('password'); ?>">
                <span class="error invalid-feedback"><?= $validation->getError('password'); ?></span>
            </div>


            <div class="col-xs-12">
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-sign-in-alt"></i> Login</button>
            </div>
            <?= form_close(); ?>
        </div>
        <br><br><br>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url(); ?>/template/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- iCheck -->
    <script src="<?= base_url(); ?>/template/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
    </script>

    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            })
        }, 1500);
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if (session()->getFlashdata('swal_icon')) { ?>
            Swal.fire({
                icon: '<?= session()->getFlashdata('swal_icon'); ?>',
                title: '<?= session()->getFlashdata('swal_title'); ?>',
                text: '<?= session()->getFlashdata('swal_text'); ?>',
                showConfirmButton: false,
                timer: 1500
            })
        <?php } ?>
    </script>
</body>