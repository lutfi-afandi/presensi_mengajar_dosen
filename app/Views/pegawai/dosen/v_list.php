<!-- Default box -->
<div class="card">
    <div class="card-header bg-primary">
        <h3 class="card-title"><b><?= $title; ?></b></h3>

        <div class="card-tools">
            <a href="<?= base_url('Pegawai/Dosen/tambah'); ?>" class="btn btn-success btn-sm" title="Tambah Kelas"><i class="fa fa-plus"></i> add</a>
        </div>
    </div>
    <div class="card-body">
        <?php
        $errors = session()->getFlashdata('errors');
        if (!empty($errors)) { ?>
            <div class="alert alert-danger" role="alert">
                <ul>
                    <?php foreach ($errors as $key => $value) { ?>
                        <li><?= esc($value); ?></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
        <div class="table-responsive">
            <table class="table table-sm table-striped  " id="example1">
                <thead class="">
                    <tr>
                        <th>#</th>
                        <th>Foto</th>
                        <th>NIDN</th>
                        <th>NIK</th>
                        <th>Nama Dosen</th>
                        <th>JK</th>
                        <th>Alamat</th>
                        <th>username</th>
                        <th>password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($dosen as $key => $row) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <img src="<?= base_url('assets/uploads/foto_dosen/' . $row['foto_user']); ?>" class="img img-fluid " width="50px" alt="">
                            </td>
                            <td><?= $row['nidn']; ?></td>
                            <td><?= $row['nik']; ?></td>
                            <td class="text-nowrap"><?= $row['nama_user']; ?></td>
                            <td class="text-nowrap"><?= $row['jk_user']; ?></td>
                            <td style="white-space: ;"><?= $row['alamat_user']; ?></td>
                            <td><?= $row['username']; ?></td>
                            <td><?= $row['password']; ?></td>
                            <td>
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit<?= $row['id_user']; ?>" title="Ganti foto"><i class="fa fa-file-image text-white"></i></button>

                                <a href="<?= base_url('Pegawai/Dosen/ubah/' . $row['id_user']); ?>" class="btn btn-warning btn-sm" title="Ubah Profil"><i class="fa fa-edit text-white"></i></a>
                                <a class="btn btn-danger btn-sm" onclick="konfimasi('<?= $row['id_user']; ?>')" title="Hapus Data"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<!-- Hapus Kelas -->
<?php
foreach ($dosen as $key => $value) { ?>
    <script>
        function konfimasi(parameter_id) {
            Swal.fire({
                title: 'Anda Yakin?',
                text: "Hapus data <?= $value['nama_user'] ?>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('Pegawai/Dosen/delete'); ?>" + "/" + parameter_id;
                }
            })
        }
    </script>
<?php } ?>

<!-- Ganti Foto -->
<?php foreach ($dosen as $key => $d) { ?>
    <div class="modal fade" tabindex="1" id="edit<?= $d['id_user'] ?>">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ganti Foto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <img src="<?= base_url('assets/uploads/foto_dosen/' . $d['foto_user']); ?>" class="img img-fluid img-thumbnail" width="250px" alt="">
                    </div>
                    <form class="" action="<?= base_url('Pegawai/Dosen/ubah_foto/' . $d['id_user']); ?>" method="POST" enctype="multipart/form-data">
                        <label>Pilih foto Baru : </label>
                        <div class="form-group">
                            <input type="file" name="foto_baru" class="form-control " autofocus>
                        </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" type="button" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>