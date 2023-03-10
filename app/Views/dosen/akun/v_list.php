<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-text-width"></i>
                Profil Dosen
            </h3>

        </div>
        <div class="text-center">
            <img src="<?= base_url('assets/uploads/foto_dosen/' . $dosen['foto_user']); ?>" style="width: 60%;" class=" text-center card-img-top img-thumbnail" alt="...">
            <button class="btn btn-info btn-block" data-toggle="modal" data-target="#editfoto<?= $dosen['id_user'] ?>" title="Ubah Password"><i class="fas fa-upload text-white"></i> Ubah Foto</button>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-4">NIDN</dt>
                <dd class="col-sm-8"><?= $dosen['nidn']; ?></dd>
                <dt class="col-sm-4">NIK</dt>
                <dd class="col-sm-8"><?= $dosen['nik']; ?></dd>
                <dt class="col-sm-4">Nama Lengkap</dt>
                <dd class="col-sm-8"><?= $dosen['nama_user']; ?></dd>
                <dt class="col-sm-4">Username</dt>
                <dd class="col-sm-8 text-info font-weight-bold"><?= $dosen['username']; ?></dd>
                <dt class="col-sm-4">Jenis Kelamin</dt>
                <dd class="col-sm-8"><?= $dosen['jk_user']; ?></dd>
                <dt class="col-sm-4">Alamat</dt>
                <dd class="col-sm-8"><?= $dosen['alamat_user']; ?></dd>
            </dl>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="<?= base_url('Dosen/Akun/ubah/' . $dosen['id_user']); ?>" class="btn btn-warning " title="Ubah Profil"><i class="fa fa-edit text-white"></i> Ubah Data </a>
            <button class="btn btn-info " data-toggle="modal" data-target="#pass<?= $dosen['id_user'] ?>" title="Ubah Password"><i class="fas fa-lock text-white"></i> Ubah Password</button>

        </div>
    </div>
    <!-- /.card -->
</div>

<!-- Ganti Foto -->
<div class="modal fade" tabindex="1" id="editfoto<?= $dosen['id_user'] ?>">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ganti Foto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <img src="<?= base_url('assets/uploads/foto_dosen/' . $dosen['foto_user']); ?>" class="img img-fluid img-thumbnail" width="250px" alt="">
                </div>
                <form class="" action="<?= base_url('Dosen/akun/ubah_foto/' . $dosen['id_user']); ?>" method="POST" enctype="multipart/form-data">
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
<!-- Ganti Foto -->
<div class="modal fade" tabindex="1" id="pass<?= $dosen['id_user'] ?>">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ganti Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">

                <form class="" action="<?= base_url('Dosen/akun/ubah_password/' . $dosen['id_user']); ?>" method="POST" enctype="multipart/form-data">
                    <label>Masukan Password Baru : </label>
                    <div class="form-group">
                        <input type="text" name="pasbar" class="form-control " autofocus>
                    </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="submit" type="button" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>