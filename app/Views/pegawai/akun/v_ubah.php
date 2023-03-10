<div class="row">
    <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header bg-danger">
                <h3 class="card-title"><b><?= $title; ?></b></h3>

                <div class="card-tools">
                    <a href="<?= base_url('Pegawai/Akun/'); ?>" class="btn btn-danger btn-xs" title="kembali"><i class="fa fa-arrow-left"></i> kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form action="<?= base_url('Pegawai/Akun/simpan/' . $pegawai['id_user']); ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>NIDN</label>
                            <input type="text" name="" class="form-control" value="<?= $pegawai['nidn']; ?>" readonly>

                        </div>
                        <div class="form-group col-md-6">
                            <label>NIK</label>
                            <input required type="text" name="nik" class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" value="<?= $pegawai['nik']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nama Lengkap</label>
                            <input required type="text" name="nama_user" class="form-control <?= ($validation->hasError('nama_pegawai')) ? 'is-invalid' : ''; ?>" value="<?= $pegawai['nama_user']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Jenis Kelamin</label>
                            <select name="jk_user" class="form-control">
                                <option value="">-Pilih Jenis Kelamin-</option>
                                <option value="Laki-Laki" <?= ($pegawai['jk_user'] == 'Laki-Laki') ? 'selected' : ''; ?>>Laki-Laki</option>
                                <option value="Perempuan" <?= ($pegawai['jk_user'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Username</label>
                            <input type="text" name="username" value="<?= $pegawai['username']; ?>" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Alamat</label>
                            <textarea name="alamat_user" cols="5" rows="3" class="form-control"><?= $pegawai['alamat_user']; ?></textarea>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 ">
                            <button class="btn btn-primary btn-block" type="submit">UPDATE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>