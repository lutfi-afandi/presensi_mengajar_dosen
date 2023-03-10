<div class="row">
    <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title"><b><?= $title; ?></b></h3>

                <div class="card-tools">
                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#add" title="Tambah Matakuliah"><i class="fa fa-plus"></i> add</button>
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
                    <table class="table table-sm table-striped  text-nowrap" id="example1">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Kode Mata Kuliah</th>
                                <th>Nama Mata Kuliah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($makul as $key => $row) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['kode_makul']; ?></td>
                                    <td><?= $row['nama_makul']; ?></td>
                                    <td>
                                        <a class="btn btn-danger btn-sm" onclick="konfimasi('<?= $row['id_makul']; ?>')" title="Hapus Data"><i class="fa fa-trash text-white"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Model Tambah Matakuliah -->
<div class="modal fade" tabindex="1" id="add">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah makul</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Admin/Matakuliah/add'); ?>" method="POST">
                    <div class="form-group">
                        <label>Kode Mata Kuliah</label>
                        <input type="text" name="kode_makul" class="form-control" autofocus>
                    </div>
                    <div class="form-group">
                        <label>Nama Mata Kuliah</label>
                        <input type="text" name="nama_makul" class="form-control" required>
                    </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="submit" type="button" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Hapus Matakuliah -->
<?php
foreach ($makul as $key => $value) { ?>
    <script>
        function konfimasi(parameter_id) {
            Swal.fire({
                title: 'Anda Yakin?',
                text: "Hapus data <?= $value['kode_makul'] ?>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('Admin/Matakuliah/delete'); ?>" + "/" + parameter_id;
                }
            })
        }
    </script>
<?php } ?>