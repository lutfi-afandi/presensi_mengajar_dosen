<div class="row">

    <div class="col-md-3">
        <a href="<?= base_url('Pegawai/Dosen'); ?>" style="text-decoration: none; color: black;">
            <div class="info-box shadow">
                <span class="info-box-icon bg-success">
                    <b class="text-white">
                        <?php
                        $db = \Config\Database::connect();
                        $no = $db->table('user')
                            ->where('level', '2')
                            ->countAllResults(); ?>
                        <?= $no; ?>
                    </b>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Data</span>
                    <span class="info-box-number">Dosen</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </a>
    </div>

    <div class="col-md-3">
        <a href="<?= base_url('Pegawai/Kelas'); ?>" style="text-decoration: none; color: black;">
            <div class="info-box shadow">
                <span class="info-box-icon bg-success">
                    <b class="text-white">
                        <?php
                        $no = $db->table('kelas')
                            ->countAllResults(); ?>
                        <?= $no; ?>
                    </b>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Data</span>
                    <span class="info-box-number">Kelas</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </a>
    </div>

    <div class="col-md-3">
        <a href="<?= base_url('Pegawai/Makul'); ?>" style="text-decoration: none; color: black;">
            <div class="info-box shadow">
                <span class="info-box-icon bg-success">
                    <b class="text-white">
                        <?php
                        $no = $db->table('mata_kuliah')
                            ->countAllResults(); ?>
                        <?= $no; ?>
                    </b>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Data</span>
                    <span class="info-box-number">Mata Kuliah</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </a>
    </div>

    <div class="col-md-3">
        <a href="<?= base_url('Pegawai/Berkas'); ?>" style="text-decoration: none; color: black;">
            <div class="info-box shadow">
                <span class="info-box-icon bg-success">
                    <b class="text-white">
                        <?php
                        $no = $db->table('berkas')
                            ->countAllResults(); ?>
                        <?= $no; ?>
                    </b>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Data</span>
                    <span class="info-box-number">Berkas</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </a>
    </div>

    <div class="col-md-3">
        <a href="<?= base_url('Pegawai/Akun'); ?>" style="text-decoration: none; color: black;">
            <div class="info-box shadow">
                <span class="info-box-icon bg-danger">
                    <i class="fa fa-user-cog"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Setting</span>
                    <span class="info-box-number">Akun</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </a>
    </div>
</div>