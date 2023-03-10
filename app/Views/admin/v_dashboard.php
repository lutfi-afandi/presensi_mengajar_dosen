<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <center>JADWAL KULIAH</center>
            </div>
            <div class="card-body">
                <center>
                    <?php if (empty($jadwal['file_berkas'])) {
                        echo 'Jadwal perkuliahan akan tapil disini';
                    } else { ?>
                        <img src="<?= base_url('assets/uploads/berkas/' . $jadwal['file_berkas']); ?>" alt="" class="img img-thumbnail img-responsive">
                    <?php } ?>
                </center>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-3">
        <a href="<?= base_url('Admin/Dosen'); ?>" style="text-decoration: none; color: black;">
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
        <a href="<?= base_url('Admin/Kelas'); ?>" style="text-decoration: none; color: black;">
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
        <a href="<?= base_url('Admin/Makul'); ?>" style="text-decoration: none; color: black;">
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
        <a href="<?= base_url('Admin/Berkas'); ?>" style="text-decoration: none; color: black;">
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
        <a href="<?= base_url('Admin/Pegawai'); ?>" style="text-decoration: none; color: black;">
            <div class="info-box shadow">
                <span class="info-box-icon bg-danger">
                    <b class="text-white">
                        <?php
                        $no = $db->table('user')
                            ->where('level', '3')
                            ->countAllResults(); ?>
                        <?= $no; ?>
                    </b>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Data</span>
                    <span class="info-box-number">Pegawai</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </a>
    </div>

    <div class="col-md-3">
        <a href="<?= base_url('Admin/User'); ?>" style="text-decoration: none; color: black;">
            <div class="info-box shadow">
                <span class="info-box-icon bg-danger">
                    <b class="text-white">
                        <?php
                        $no = $db->table('user')
                            ->where('level', '1')
                            ->countAllResults(); ?>
                        <?= $no; ?>
                    </b>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Data</span>
                    <span class="info-box-number">User</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </a>
    </div>
</div>