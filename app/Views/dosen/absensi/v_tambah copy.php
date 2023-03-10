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
            <form action="<?= base_url('Dosen/Absensi/simpan/'); ?>">
                <div class="row">
                    <div class="col-md-6">
                        <label>TAHUN AKADEMIK</label>
                        <select name="ta_id" class="form-control" id="">
                            <option value="">-tahun akademik-</option>
                            <?php foreach ($ta as $key => $t) { ?>
                                <option value="<?= $t['id_ta']; ?>"><?= $t['ta']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>SEMESTER</label>
                        <select name="semester" class="form-control" id="">
                            <option value="">-semester-</option>
                            <option value="GANJIL">GANJIL</option>
                            <option value="GENAP">GENAP</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>NAMA DOSEN</label>
                        <input type="text" class="form-control" name="" id="" readonly value="<?= session()->get('nama_user'); ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="text-uppercase">mata kuliah</label>
                        <select name="makul_id" class="form-control" id="">
                            <option value="">-mata kuliah-</option>
                            <?php foreach ($makul as $key => $m) { ?>
                                <option value="<?= $m['id_makul']; ?>"><?= $m['kode_makul']; ?> - <?= $m['nama_makul']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="text-uppercase">Kelas</label>
                        <select name="kelas_id" class="form-control" id="">
                            <option value="">-kelas-</option>
                            <?php foreach ($kelas as $key => $t) { ?>
                                <option value="<?= $t['id_kelas']; ?>"><?= $t['kode_kelas']; ?> <?= $t['nama_kelas']; ?> - <?= $t['angkatan_kelas']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="text-uppercase">Tanggal dan Waktu Mulai Mengajar</label>
                        <input type="date" class="form-control" name="tanggal">
                    </div>
                    <div class="col-md-6">
                        <label class="text-uppercase">Waktu Mulai</label>
                        <input type="time" class="form-control" name="waktu_mulai">
                    </div>
                    <div class="col-md-6">
                        <label class="text-uppercase">Waktu Selesai</label>
                        <input type="time" class="form-control" name="waktu_selesai">
                    </div>
                    <div class="col-md-12">
                        <label class="text-uppercase">Dosen Instruktur, Laboran dan Mahasiswa pembantu </label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="dosen_nama" class="form-control">
                        <small>instruktur</small>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="laboran" class="form-control">
                        <small>Laboran</small>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="mhs_pembantu" class="form-control">
                        <small>Mahasiswa</small>
                    </div>
                    <div class="col-md-12">
                        <small>Kolom ini Khusus utk MK PRAKTIKUM. 1) Dosen Pengampu merupakan Instruktur Praktikum 2) Dosen Pengampu wajib hadir pd Prak. Luring (jk tdk hadir wajib menunjuk dosen lain sbg instruktur) 3) Keg. Prak. dpt dibantu 2 org (laboran/Mhs)</small>
                    </div>
                    <div class="col-md-6">
                        <label class="text-uppercase">Topik Praktikum</label>
                        <input type="text" name="topik" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>METODE PRAKTIKUM</label>
                        <select name="metode" class="form-control" id="">
                            <option value="">-metode praktikum-</option>
                            <option value="1">LURING DI LABORATORIUM</option>
                            <option value="2">DARING</option>
                            <option value="3">HYBRID</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="text-uppercase">bukti Praktikum</label>
                        <input type="file" name="bukti" class="form-control">
                    </div>
                    <br>
                    <div class="col-md-12 mt-5">
                        <label class="text-uppercase" for="">Tanda Tangan :</label>
                        <br />
                        <div id="sig" class="kbw-signature"></div>
                        <br><br>
                        <button id="clear" class="btn btn-danger">Clear Signature</button>
                        <button class="btn btn-success">Save</button>
                        <textarea id="signature" name="signed" style="display: none"></textarea>
                    </div>
                </div>


            </form>

        </div>
    </div>
</div>