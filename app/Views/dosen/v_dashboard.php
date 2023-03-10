<?php date_default_timezone_set("Asia/Jakarta");
setlocale(LC_ALL, 'id_ID.utf8');

$db = Config\Database::connect();
$jadwal = $db->query("SELECT * FROM berkas WHERE nama_file LIKE '%jadwal%'")->getRowArray();
// dd($jadwal);
?>
<br>
<div class="row mt-3">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <center>JADWAL KULIAH</center>
            </div>
            <div class="card-body">
                <center>
                    <embed type="application/pdf" src="<?= base_url('assets/uploads/berkas/jadwal.pdf') ?>" width="100%" height="400"></embed>
                </center>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="row">
            <div class="col-md-12">
                <a href="<?= base_url('Dosen/Absensi/add/' . session()->get('id_user')); ?>" style="text-decoration: none;">
                    <div class="small-box bg-fuchsia">
                        <div class="inner">
                            <h3>Absensi</h3>
                            <p>Mengajar</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-chalkboard-teacher"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">
                <a href="<?= base_url('Dosen/Berkas/') ?>" style="text-decoration: none;">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>Upload</h3>
                            <p>Berkas</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-upload"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

</div>
<div class="row">

    <div class="col-md-12 ">
        <div class="card card-default">
            <div class="card-header bg-info">
                <h3 class="card-title">
                    <i class="fas fa-flag-checkered"></i>
                    <?= $title; ?>
                </h3>
                <div class="card-tools">
                    <a href="<?= base_url('Dosen/Absensi/add/' . session()->get('id_user')) ?>" class="btn btn-warning btn-sm"><i class="fas fa-plus"></i> add</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-sm table-hover" id="example1">
                        <thead class="bg-gradient-success text-nowrap text-sm">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Tanggal</th>
                                <th>Semester</th>
                                <th>Kelas</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Detail</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <?php $no = 1;
                            foreach ($absensi_dosen as $key => $row) { ?>
                                <tr>
                                    <th><?= $no++; ?></th>
                                    <td><?php echo strftime("%d %B %Y", strtotime($row['tanggal'])); ?></td>
                                    <td><?= $row['semester']; ?></td>
                                    <td class="text-nowrap"><?= $row['kode_kelas']; ?> <?= $row['nama_kelas']; ?> - <?= $row['angkatan_kelas']; ?></td>
                                    <td><?= date('G:i', strtotime($row['waktu_mulai'])); ?></td>
                                    <td><?= date('G:i', strtotime($row['waktu_selesai'])); ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-flat btn-outline-primary" data-toggle="modal" data-target="#detail<?= $row['id_absensi']; ?>"><i class="fa fa-eye"></i></button>
                                    </td>
                                    <td>
                                        <a onclick="hapus(<?= $row['id_absensi']; ?>)" class="btn btn-danger btn-sm"><i class="fa fa-trash text-white"></i> </a>
                                        <script>
                                            function hapus(parameter_id) {
                                                if (confirm("Anda yakin akan menghapus data ini?\nTidak dapat dibatalkan!") == true) {
                                                    window.location.href = "<?= base_url('Dosen/Absensi/delete'); ?>" + "/" + parameter_id;
                                                } else {}
                                            }
                                        </script>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<!-- hapus -->
<?php
foreach ($absensi_dosen as $key => $value) { ?>
    <script>
        function konfimasi(parameter_id) {
            Swal.fire({
                title: 'Anda Yakin?',
                text: "Hapus data",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('Dosen/Absensi/delete'); ?>" + "/" + parameter_id;
                }
            })
        }
    </script>
<?php } ?>

<!-- DETAIL -->
<?php
foreach ($absensi_dosen as $key => $value) { ?>
    <div class="modal fade" tabindex="1" id="detail<?= $value['id_absensi']; ?>">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Absensi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <dl class="row">
                                <dt class="col-sm-4">Mata Kuliah</dt>
                                <dd class="col-sm-8"><?= $value['nama_makul']; ?></dd>
                                <dt class="col-sm-4">Waktu Mulai</dt>
                                <dd class="col-sm-8"><?= $value['waktu_mulai']; ?></dd>
                                <dt class="col-sm-4">Waktu Selesai</dt>
                                <dd class="col-sm-8"><?= $value['waktu_selesai']; ?></dd>
                                <dt class="col-sm-4">Instruktur</dt>
                                <dd class="col-sm-8 text-info font-weight-bold"><?= $value['dosen_nama']; ?></dd>
                                <dt class="col-sm-4">Laboran</dt>
                                <dd class="col-sm-8"><?= $value['laboran']; ?></dd>
                                <dt class="col-sm-4">Mahasiswa</dt>
                                <dd class="col-sm-8"><?= $value['mhs_pembantu']; ?></dd>
                                <dt class="col-sm-4">Topik</dt>
                                <dd class="col-sm-8"><?= $value['topik']; ?></dd>
                                <dt class="col-sm-4">Metode</dt>
                                <dd class="col-sm-8"><?php if ($value['metode'] == '1') {
                                                            echo "Luring di Laboratorium";
                                                        } elseif ($value['metode'] == '2') {
                                                            echo "Daring";
                                                        } else {
                                                            echo "Hybrid";
                                                        } ?></dd>
                            </dl>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?php if ($value['bukti'] == 'assets/img/default.png') { ?>
                                <label for="">Bukti</label> <img src="<?= base_url('assets/img/default.png'); ?>" width="100%" alt="">
                            <?php  } else { ?>
                                <label for="">Bukti</label><img src="<?= base_url('assets/uploads/bukti_mengajar/' . $value['bukti']); ?>" width="100%" alt="">
                            <?php   } ?>

                        </div>
                        <div class="col-md-6">
                            <label for="">Tanda Tangan</label><img src="<?= base_url('assets/uploads/ttd_dosen/' . $value['ttd']); ?>" width="100%" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }
?>