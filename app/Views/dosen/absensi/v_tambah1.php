<div class="col-md-12 ">
    <div class="card card-default">
        <div class="card-header bg-dark">
            <h3 class="card-title">
                <b> <?= $title; ?> </b>
                <p>AKADEMI FARMASI CENDIKIA FARMA HUSADA</p>
            </h3>
            <div class="card-tools">
                <a href="<?= base_url('Dosen/Dashboard/') ?>" class="btn btn-danger btn-sm"><i class="fas fa-arrow-left"></i> back</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="<?= base_url('Dosen/Absensi/simpan/'); ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <label for="">NAMA</label>
                        <input type="text" name="nama" id="" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label class="text-uppercase">bukti kuliah</label>
                        <input type="file" name="bukti" class="form-control <?= ($validation->hasError('bukti')) ? 'is-invalid' : ''; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('bukti'); ?>
                        </div>
                    </div>
                    <br>
                </div>



        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
    </div>
</div>