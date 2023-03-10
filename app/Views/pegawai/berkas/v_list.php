<div class="row">

    <div class="col-md-12 ">
        <div class="card card-default">
            <div class="card-header bg-info">
                <h3 class="card-title">
                    <i class="fas fa-flag-checkered"></i>
                    <?= $title; ?>
                </h3>
                <div class="card-tools">
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#tambah" title="tambah berkas"><i class="fas fa-upload text-white"></i></button>
                </div>
            </div>
            <!-- /.card-header -->
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
                    <table class="table table-striped table-sm table-bordered table-hover" id="example1">
                        <thead class="bg-gradient-success text-nowrap">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama Berkas</th>
                                <th class="text-center">File Berkas</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <?php $no = 1;
                            foreach ($berkas as $key => $row) { ?>
                                <tr>
                                    <th class="text-center"><?= $no++; ?></th>
                                    <td><?= $row['nama_file'] ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#berkas<?= $row['id_berkas']; ?>" title="FIle"><i class="fas fa-file-image text-white"></i></button>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-danger btn-sm" onclick="konfimasi('<?= $row['id_berkas']; ?>')" title="Hapus Data"><i class="fa fa-trash text-white"></i></a>
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


<div class="modal fade" tabindex="1" id="tambah">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Upload Berkas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Pegawai/Berkas/add'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Nama Berkas :</label>
                        <input type="text" name="nama_file" id="" class="form-control" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="">Upload Berkas : <small class="text-danger">*pdf, png, jpg</small></label>
                        <input type="file" name="file_berkas" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-block btn-primary" type="submit"><i class="fa fa-upload"></i> Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
foreach ($berkas as $key => $value) { ?>
    <div class="modal fade" tabindex="1" id="berkas<?= $value['id_berkas']; ?>">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Berkas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <iframe src="<?= base_url('assets/uploads/berkas/' . $value['file_berkas']); ?>" width="100%" height="600px" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
<?php }
?>

<!-- Hapus Kelas -->
<?php
foreach ($berkas as $key => $value) { ?>
    <script>
        function konfimasi(parameter_id) {
            Swal.fire({
                title: 'Anda Yakin?',
                text: "Hapus Berkas <?= $value['nama_file'] ?>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('Pegawai/Berkas/delete'); ?>" + "/" + parameter_id;
                }
            })
        }
    </script>
<?php } ?>