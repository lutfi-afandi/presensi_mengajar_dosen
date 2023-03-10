<?php

namespace App\Controllers\dosen;

use App\Controllers\BaseController;

class Absensi extends BaseController
{
    public function add($id_dosen)
    {

        $data = [
            'isi'   => 'dosen/absensi/v_tambah',
            'title' => 'DAFTAR KEHADIRAN MENGAJAR DOSEN',
            'ta'    => $this->ModelTa->getTa(),
            'makul'    => $this->ModelMakul->getMakul(),
            'kelas'    => $this->ModelKelas->getKelas(),
            'validation'    => $this->validation,
        ];
        return view('layout/v_wrapper', $data);
        // return view('dosen/absensi/v_tambah',$data);
    }

    public function simpan_old()
    {
        $validation  = $this->validate([
            'bukti'         => [
                'rules'     => 'uploaded[bukti]|max_size[bukti,10000]|mime_in[bukti,image/jpg,image/jpeg,image/gif,image/png,application/pdf]',
                'errors' => [
                    'uploaded'  => 'Pilih file terlebih dulu',
                    'mime_in'   => 'format file tidak sesuai',
                    'max_size'  => 'Ukuran gambar maximal 5 MB'
                ]
            ]
        ]);

        if (!$validation) {
            $fileBukti = $this->request->getFile('bukti');
            // dd($this->validate('uploaded'));
            return redirect()->to(base_url('Dosen/Absensi/add/' . session()->get('id_user')))->withInput()->with('validation', $validation);
        } else {
            $file_string = $this->request->getVar('signed');
            $image = explode(";base64,", $file_string);
            $image_type = explode("image/", $image[0]);
            $image_type_png = $image_type[1];
            $image_base64 = base64_decode($image[1]);

            $folderPath = ROOTPATH . 'assets/uploads/ttd_dosen/';
            $file_ttd = uniqid();
            $file = $folderPath . $file_ttd . '.' . $image_type_png;
            $session = session();
            file_put_contents($file, $image_base64);

            // file bukti
            $fileBukti = $this->request->getFile('bukti');
            $fileBukti->move('assets/uploads/bukti_mengajar/');
            // Ambil nama file
            $namaBukti = $fileBukti->getName();

            $data = [
                'dosen_id' => session()->get('id_user'),
                'ta_id' => $this->request->getPost('ta_id'),
                'semester' => $this->request->getPost('semester'),
                'makul_id' => $this->request->getPost('makul_id'),
                'kelas_id' => $this->request->getPost('kelas_id'),
                'tanggal' => $this->request->getPost('tanggal'),
                'waktu_mulai' => $this->request->getPost('waktu_mulai'),
                'waktu_selesai' => $this->request->getPost('waktu_selesai'),
                'dosen_nama' => $this->request->getPost('dosen_nama'),
                'laboran' => $this->request->getPost('laboran'),
                'mhs_pembantu' => $this->request->getPost('mhs_pembantu'),
                'topik' => $this->request->getPost('topik'),
                'metode' => $this->request->getPost('metode'),
                'bukti' => $namaBukti,
                'ttd' => $file_ttd . ".png",
            ];

            // dd($data);
            $this->ModelAbsensi->tambah($data);
            set_notifikasi_swal('success', 'Berhasil', 'Pendaftaran Berhasil!');
            return redirect()->to(base_url('Dosen/Dashboard'));
        }
    }

    public function simpan()
    {
        $dir = 'assets/uploads/bukti_mengajar/';
        $bukti = $this->request->getFile('bukti');

        $file_string = $this->request->getVar('signed');
        $image = explode(";base64,", $file_string);
        $image_type = explode("image/", $image[0]);
        $image_type_png = $image_type[1];
        $image_base64 = base64_decode($image[1]);

        $folderPath = 'assets/uploads/ttd_dosen/';
        $file_ttd = uniqid();
        $file = $folderPath . $file_ttd . '.' . $image_type_png;
        $session = session();
        file_put_contents($file, $image_base64);

        $data['dosen_id'] =  session()->get('id_user');
        $data['ta_id'] =  $this->request->getPost('ta_id');
        $data['semester'] =  $this->request->getPost('semester');
        $data['makul_id'] =  $this->request->getPost('makul_id');
        $data['kelas_id'] =  $this->request->getPost('kelas_id');
        $data['tanggal'] =  $this->request->getPost('tanggal');
        $data['waktu_mulai'] =  $this->request->getPost('waktu_mulai');
        $data['waktu_selesai'] =  $this->request->getPost('waktu_selesai');
        $data['dosen_nama'] =  $this->request->getPost('dosen_nama');
        $data['laboran'] =  $this->request->getPost('laboran');
        $data['mhs_pembantu'] =  $this->request->getPost('mhs_pembantu');
        $data['topik'] =  $this->request->getPost('topik');
        $data['metode'] =  $this->request->getPost('metode');
        $data['ttd'] =  $file_ttd . ".png";

        if (!empty($bukti->getName())) {
            $newname = "Absen-" . date("ymd-His");
            $ext = $bukti->getExtension();
            $bukti->move($dir, $newname . '.' . $ext);
            $data['bukti'] = $bukti->getName();
            // dd($da ta);
        } else {
            $data['bukti'] = 'assets/img/default.png';
        }

        // dd($data);
        $this->ModelAbsensi->tambah($data);
        set_notifikasi_swal('success', 'Berhasil', 'Pendaftaran Berhasil!');
        return redirect()->to(base_url('Dosen/Dashboard'));
    }

    public function delete($id_absensi)
    {
        $absensi = $this->db->table('absensi')->where('id_absensi', $id_absensi)->get()->getRowArray();
        // dd($absensi['bukti']);
        if (file_exists('./assets/uploads/ttd_dosen/' . $absensi['ttd'])) {
            unlink('./assets/uploads/ttd_dosen/' . $absensi['ttd']);
        }
        if (file_exists('./assets/uploads/bukti_mengajar/' . $absensi['bukti'])) {
            unlink('./assets/uploads/bukti_mengajar/' . $absensi['bukti']);
        }
        // dd($data);
        $this->ModelAbsensi->hapus($id_absensi);
        set_notifikasi_swal('info', 'Berhasil', 'Data Berhasil dihapus!');
        return redirect()->to(base_url('Dosen/Dashboard'));
    }
}
