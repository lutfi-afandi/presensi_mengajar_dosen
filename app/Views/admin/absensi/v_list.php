<div class="row">
    <div class="col-md-12">
        <div class="card mt-3">
            <div class="card-body form">
                <form>
                    <div class="form-group">
                        <input type="date" name="tg_awal" id="tg_awal" class="form-control" value="<?= ($tg_awal != '') ? $tg_awal : ''; ?>">
                    </div>
                    <div class="form-group">
                        <input type="date" name="tg_akhir" id="tg_akhir" class="form-control" value="<?= ($tg_akhir != '') ? $tg_akhir : ''; ?>">
                    </div>
                    <div class="form-group">
                        <select name="dosen_id" class="form-control select2bs4" id="dosen_id" style="width: 100%;" required>
                            <option></option>
                            <?php foreach ($dosens as $key => $dosen) { ?>
                                <option value="<?= $dosen['id_user']; ?>" <?= ($dos['id_user'] == $dosen['id_user']) ? "selected" : ""; ?>><?= $dosen['nama_user']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <a class="btn btn-primary text-white" onclick="btn_excel()"><i class="fa fa-file-excel"></i> Export Excel</a>
                <a class="btn btn-danger" onclick="btn_pdf()"><i class="fa fa-file-pdf"></i> Export PDF</a>
                <a class="btn btn-warning text-white" onclick="btn_refresh()"><i class="fa fa-sync"></i></a>
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
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-sm table-hover" id="example1">
                        <thead class="bg-gradient-success text-nowrap text-sm">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama Dosen</th>
                                <th>Tanggal</th>
                                <th>Semester</th>
                                <th>Mata Kuliah</th>
                                <th>Kelas</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <?php $no = 1;
                            foreach ($absensi as $key => $row) { ?>
                                <tr>
                                    <th><?= $no++; ?></th>
                                    <td><?= $row['nama_user']; ?></td>
                                    <td><?php echo strftime("%d %b %Y", strtotime($row['tanggal'])); ?></td>
                                    <td> <?= $row['nama_makul']; ?> </td>
                                    <td> <?= $row['semester']; ?> <?= $row['ta']; ?> </td>
                                    <td class="text-nowrap"><?= $row['kode_kelas']; ?> <?= $row['nama_kelas']; ?> - <?= $row['angkatan_kelas']; ?></td>
                                    <td><?= date('G:i', strtotime($row['waktu_mulai'])); ?></td>
                                    <td><?= date('G:i', strtotime($row['waktu_selesai'])); ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-flat btn-outline-primary" data-toggle="modal" data-target="#detail<?= $row['id_absensi']; ?>"><i class="fa fa-eye"></i></button>
                                        <a class="btn btn-danger btn-sm" onclick="konfimasi('<?= $row['id_absensi']; ?>')" title="Hapus Data"><i class="fa fa-trash text-white"></i></a>
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
foreach ($absensi as $key => $value) { ?>
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
                    window.location.href = "<?= base_url('Admin/Absensi/delete'); ?>" + "/" + parameter_id;
                }
            })
        }
    </script>
<?php } ?>


<!-- DETAIL -->
<?php
foreach ($absensi as $key => $value) { ?>
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