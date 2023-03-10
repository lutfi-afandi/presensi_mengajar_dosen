<?php
date_default_timezone_set("Asia/Jakarta"); ?>
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
                    <div class="col-md-6">
                        <label>TAHUN AKADEMIK</label>
                        <select name="ta_id" class="form-control" id="" required>
                            <option value="">-tahun akademik-</option>
                            <?php foreach ($ta as $key => $t) { ?>
                                <option value="<?= $t['id_ta']; ?>" <?= (old('ta_id') == $t['id_ta']) ? "selected" : ""; ?>><?= $t['ta']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>SEMESTER</label>
                        <select name="semester" class="form-control" id="" required value="">
                            <option value="">-semester-</option>
                            <option value="GANJIL" <?= (old('semester') == 'GANJIL') ? "selected" : ""; ?>>GANJIL</option>
                            <option value="GENAP" <?= (old('semester') == 'GENAP') ? "selected" : ""; ?>>GENAP</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>NAMA DOSEN</label>
                        <input type="text" class="form-control" name="" id="" readonly value="<?= (session()->get('level') == '2') ? session()->get('nama_user') : ''; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="text-uppercase">Mata Kuliah</label>
                        <select name="makul_id" class="form-control select2bs4" id="" style="width: 100%;" required>
                            <option value="">-mata kuliah-</option>
                            <?php foreach ($makul as $key => $m) { ?>
                                <option value="<?= $m['id_makul']; ?>" <?= (old('makul_id') == $m['id_makul']) ? "selected" : ""; ?>><?= $m['kode_makul']; ?> - <?= $m['nama_makul']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="text-uppercase">Kelas</label>
                        <select name="kelas_id" class="form-control" id="" required>
                            <option value="">-kelas-</option>
                            <?php foreach ($kelas as $key => $t) { ?>
                                <option value="<?= $t['id_kelas']; ?>" <?= (old('kelas_id') == $t['id_kelas']) ? "selected" : ""; ?>>
                                    [<?= $t['kode_kelas']; ?>] <?= $t['nama_kelas']; ?> - <?= $t['angkatan_kelas']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="text-uppercase">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" required value="<?= old('tanggal'); ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="text-uppercase">Waktu Mulai</label>
                        <input type="time" class="form-control" name="waktu_mulai" required value="<?= old('waktu_mulai'); ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="text-uppercase">Waktu Selesai</label>
                        <input type="time" class="form-control" name="waktu_selesai" required value="<?= old('waktu_selesai'); ?>">
                    </div>
                    <div class="col-md-12">
                        <label class="text-uppercase">Dosen Instruktur, Laboran dan Mahasiswa pembantu </label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="dosen_nama" class="form-control" value="<?= old('dosen_nama'); ?>">
                        <small>instruktur</small>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="laboran" class="form-control" value="<?= old('laboran'); ?>">
                        <small>Laboran</small>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="mhs_pembantu" class="form-control" value="<?= old('mhs_pembantu'); ?>">
                        <small>Mahasiswa</small>
                    </div>
                    <div class="col-md-12">
                        <small><i>*Kolom ini Khusus utk MK PRAKTIKUM. 1) Dosen Pengampu merupakan Instruktur Praktikum 2) Dosen Pengampu wajib hadir pd Prak. Luring (jk tdk hadir wajib menunjuk dosen lain sbg instruktur) 3) Keg. Prak. dpt dibantu 2 org (laboran/Mhs)</i></small>
                    </div>
                    <div class="col-md-6">
                        <label class="text-uppercase">TOPIK</label>
                        <input type="text" name="topik" class="form-control" required value="<?= old('topik'); ?>">
                    </div>
                    <div class="col-md-6">
                        <label>METODE KULIAH</label>
                        <select name="metode" class="form-control" id="" required>
                            <option value="">-metode kuliah-</option>
                            <option value="1" <?= (old('metode') == '1') ? "selected" : ""; ?>>LURING DI LABORATORIUM</option>
                            <option value="2" <?= (old('metode') == '2') ? "selected" : ""; ?>>DARING</option>
                            <option value="3" <?= (old('metode') == '3') ? "selected" : ""; ?>>HYBRID</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="text-uppercase">bukti kuliah</label>
                        <input type="file" name="bukti" class="form-control <?= ($validation->hasError('bukti')) ? 'is-invalid' : ''; ?>" accept="image/*">
                        <div class="invalid-feedback">
                            <?= $validation->getError('bukti'); ?>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-12 mt-5">
                        <label class="text-uppercase" for="">Tanda Tangan :</label>
                        <br />
                        <div id="sig" class="kbw-signature"></div>
                        <br><br>
                        <button id="clear" class="btn btn-danger btn-sm">bersihkan tanda tangan</button>
                        <textarea id="signature" name="signed" style="display: none"></textarea>
                    </div>
                </div>



        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
    </div>
</div>