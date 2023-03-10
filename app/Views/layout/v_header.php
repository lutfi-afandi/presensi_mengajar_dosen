<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header  navbar navbar-expand  navbar-danger navbar-dark">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                </li>
            </ul>


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <?php if (session()->get('nama_user') == true) { ?>
                    <li class="nav-item">
                    <li class="nav-link text-white"><?= session()->get('nama_user'); ?> </li>
                    </li>
                <?php } ?>

                <li class="nav-item ">
                    <a class="nav-link" href="<?= base_url('login/logout'); ?>" title="Logout">
                        <i class="fa fa-sign-out-alt"></i>
                    </a>

                </li>

                <li class="nav-item">
                    <img src="<?= base_url(); ?>/template/dist/img/avatar5.png" class="img-circle elevation-2" width="3 0px" alt="">
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->