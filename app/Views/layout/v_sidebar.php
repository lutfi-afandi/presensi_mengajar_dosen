<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-danger elevation-4">
    <a href="#" class="brand-link">
        <img src="<?= base_url(); ?>/assets/img/logo.png" alt=" Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><strong>PR</strong>esensi</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-2 pb-2  d-flex bg-dark">
            <div class="image mt-2">
                <?php if (session()->get('level') == '2') { ?>
                    <img src="<?= base_url(); ?>/assets/uploads/foto_dosen/<?= session()->get('foto'); ?>" style="width: 45px;height: 45px;" class="img-circle elevation-2" alt="User Image">
                <?php } else { ?>
                    <img src="<?= base_url(); ?>/assets/uploads/foto_user/<?= session()->get('foto'); ?>" style="width: 45px;height: 45px;" class="img-circle elevation-2" alt="User Image">
                <?php } ?>

            </div>
            <div class="I ml-3 mt-1">
                <a href="#" class="d-block text-white"> <?= session()->get('nama_user'); ?></a>
                <small><?php if (session()->get('level') == '2') {
                            echo "Dosen";
                        } elseif (session()->get('level') == '1') {
                            echo "Admin";
                        } elseif (session()->get('level') == '3') {
                            echo "Pegawai";
                        } ?></small>
            </div>
        </div>

        <!-- Sidebar Pegawai -->
        <?php if (session()->get('level') == '3') { ?>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-compact" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <a href="<?= base_url('Pegawai/Dashboard'); ?>" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <!-- <ul class="nav nav-treeview" style="display: block;">
                            <li class="nav-item">
                                <a href="<?= base_url('Pegawai/Absensi'); ?>" class="nav-link">
                                    <i class="fa fa-chalkboard-teacher nav-icon"></i>
                                    <p>Absensi</p>
                                </a>
                            </li>
                        </ul> -->
                        <ul class="nav nav-treeview" style="display: block;">
                            <li class="nav-item">
                                <a href="<?= base_url('Pegawai/Berkas'); ?>" class="nav-link">
                                    <i class="fa fa-folder nav-icon"></i>
                                    <p>Berkas</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Kelola
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: block;">
                            <li class="nav-item">
                                <a href="<?= base_url('Pegawai/Dosen'); ?>" class="nav-link">
                                    <i class="fa fa-graduation-cap nav-icon"></i>
                                    <p>Dosen</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview" style="display: block;">
                            <li class="nav-item">
                                <a href="<?= base_url('Pegawai/Matakuliah'); ?>" class="nav-link">
                                    <i class="fab fa-leanpub nav-icon"></i>
                                    <p>Mata Kuliah</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview" style="display: block;">
                            <li class="nav-item">
                                <a href="<?= base_url('Pegawai/Kelas'); ?>" class="nav-link">
                                    <i class="fa fa-chalkboard-teacher nav-icon"></i>
                                    <p>Kelas</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview" style="display: block;">
                            <li class="nav-item">
                                <a href="<?= base_url('Pegawai/Ta'); ?>" class="nav-link">
                                    <i class="fa fa-vote-yea nav-icon"></i>
                                    <p>Tahun Akademik</p>
                                </a>
                            </li>
                        </ul>

                    <li class="nav-header">Akun</li>
                    <li class="nav-item">
                        <a href="<?= base_url('Pegawai/Akun'); ?>" class="nav-link active">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>Kelola Akun</p>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php } ?>
        <!-- Sidebar Admin -->
        <?php if (session()->get('level') == '1') { ?>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-compact" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="<?= base_url('Admin/Dashboard'); ?>" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: block;">
                            <li class="nav-item">
                                <a href="<?= base_url('Admin/Absensi'); ?>" class="nav-link">
                                    <i class="fa fa-address-book nav-icon"></i>
                                    <p>Absensi</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview" style="display: block;">
                            <li class="nav-item">
                                <a href="<?= base_url('Admin/Berkas'); ?>" class="nav-link">
                                    <i class="fa fa-folder nav-icon"></i>
                                    <p>Berkas</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Kelola
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: block;">
                            <li class="nav-item">
                                <a href="<?= base_url('Admin/Dosen'); ?>" class="nav-link">
                                    <i class="fa fa-graduation-cap nav-icon"></i>
                                    <p>Dosen</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview" style="display: block;">
                            <li class="nav-item">
                                <a href="<?= base_url('Admin/Matakuliah'); ?>" class="nav-link">
                                    <i class="fab fa-leanpub nav-icon"></i>
                                    <p>Mata Kuliah</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview" style="display: block;">
                            <li class="nav-item">
                                <a href="<?= base_url('Admin/Kelas'); ?>" class="nav-link">
                                    <i class="fa fa-chalkboard-teacher nav-icon"></i>
                                    <p>Kelas</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview" style="display: block;">
                            <li class="nav-item">
                                <a href="<?= base_url('Admin/Ta'); ?>" class="nav-link">
                                    <i class="fa fa-vote-yea nav-icon"></i>
                                    <p>Tahun Akademik</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview" style="display: block;">
                            <li class="nav-item">
                                <a href="<?= base_url('Admin/Pegawai'); ?>" class="nav-link">
                                    <i class="fa fa-users nav-icon"></i>
                                    <p>Pegawai</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-header">User</li>
                    <li class="nav-item">
                        <a href="<?= base_url('Admin/User'); ?>" class="nav-link active">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>Kelola User</p>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php } ?>
        <!-- Sidebar Dosen -->
        <?php if (session()->get('level') == '2') { ?>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-compact" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <a href="<?= base_url('Dosen/Dashboard'); ?>" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('Dosen/Dashboard'); ?>" class="nav-link active">
                            <i class="nav-icon fas fa-list"></i>
                            <p>Absensi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('Dosen/Berkas'); ?>" class="nav-link active">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>Berkas</p>
                        </a>
                    </li>

                    <li class="nav-header">Akun</li>
                    <li class="nav-item">
                        <a href="<?= base_url('Dosen/Akun'); ?>" class="nav-link active">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>Kelola akun</p>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php } ?>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">