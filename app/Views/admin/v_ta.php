<div class="row">
    <div class="col-6">
        <!-- Default box -->
        <div class="card ">
            <div class="card-header bg-primary">
                <h3 class="card-title"><b><?= $title; ?></b></h3>

                <div class="card-tools">
                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#add" title="Tambah Kelas"><i class="fa fa-plus"></i> add</button>
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
                    <table class="table table-sm table-striped  text-nowrap" id="">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Tahun Akademik</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($ta as $key => $row) { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['ta']; ?></td>
                                    <td>
                                        <a class="btn btn-danger btn-sm" onclick="konfimasi('<?= $row['id_ta']; ?>')" title="Hapus Data"><i class="fa fa-trash"></i></a>
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

<!-- Model Tambah Kelas -->
<div class="modal fade" tabindex="1" id="add">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah ta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form class="form-inline" action="<?= base_url('Admin/Ta/add'); ?>" method="POST">
                    <label>Masukan Tahun Akademik</label>
                    <div class="form-group">
                        <input type="number" name="ta1" class="form-control col-md-5" autofocus> / <input type="number" name="ta2" class="form-control col-md-5" autofocus>
                    </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="submit" type="button" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Hapus Kelas -->
<?php
foreach ($ta as $key => $value) { ?>
    <script>
        function konfimasi(parameter_id) {
            Swal.fire({
                title: 'Anda Yakin?',
                text: "Hapus data <?= $value['ta'] ?>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('Admin/Ta/delete'); ?>" + "/" + parameter_id;
                }
            })
        }
    </script>
<?php } ?>