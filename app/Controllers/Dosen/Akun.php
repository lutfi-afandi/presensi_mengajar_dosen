<?php

namespace App\Controllers\dosen;

use App\Controllers\BaseController;

class Akun extends BaseController
{
    public function index()
    {
        $id_dosen = session()->get('id_user');
        $data = [
            'isi'   => 'dosen/akun/v_list',
            'title' => 'AKUN DOSEN',
            'dosen'    => $this->ModelUser->getDosen($id_dosen),
        ];
        return view('layout/v_wrapper', $data);
        // return view('dosen/absensi/v_tambah',$data);
    }

    public function ubah($id_dosen)
    {
        $dosen = $this->ModelUser->getDosen($id_dosen);
        $data = [
            'isi'   => 'dosen/akun/v_ubah',
            'title' => 'UBAH DATA',
            'dosen'    => $dosen,
            'validation' => $this->validation,
        ];
        return view('layout/v_wrapper', $data);
    }

    public function simpan($id_dosen)
    {
        $data = [
            'id_user'       => $id_dosen,
            'nama_user' => $this->request->getPost('nama_user'),
            'nik' => $this->request->getPost('nik'),
            'alamat_user' => $this->request->getPost('alamat_user'),
            'jk_user' => $this->request->getPost('jk_user'),
            'level'     => '2',
        ];
        // dd($data);
        $this->ModelUser->edit($data);
        set_notifikasi_swal('success', 'Berhasil', 'Menambah dosen!');
        return redirect()->to(base_url('Dosen/Akun'));
    }

    public function ubah_foto($id_dosen)
    {
        $validation = $this->validate([
            'foto_baru'         => [
                'rules' => 'uploaded[foto_baru]|max_size[foto_baru,5120]|mime_in[foto_baru,image/jpg,image/jpeg,image/gif,image/png]',
                'errors' => [
                    'uploaded'  => 'Pilih Foto terlebih dulu',
                    'mime_in'   => 'format file tidak sesuai',
                    'max_size'  => 'Ukuran gambar maximal 5 MB'
                ]
            ],
        ]);
        if (!$validation) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Dosen/Akun'));
        } else {
            $dosen = $this->ModelUser->getDosen($id_dosen);
            // dd($dosen['foto_dosen']);
            unlink('assets/uploads/foto_dosen/' . $dosen['foto_user']);

            $fileFoto = $this->request->getFile('foto_baru');
            $fileFoto->move('assets/uploads/foto_dosen');
            // Ambil nama file
            $foto_dosen = $fileFoto->getName();
            $data = [
                'id_user'  => $id_dosen,
                'foto_user'    => $foto_dosen,
            ];
            // dd($data);
            $this->ModelUser->edit($data);
            set_notifikasi_swal('success', 'Berhasil', 'Mengganti foto dosen!');
            return redirect()->to(base_url('Dosen/Akun'));
        }
    }

    public function ubah_password($id_dosen)
    {
        $data = [
            'id_user'  => $id_dosen,
            'password'    => $this->request->getPost('pasbar'),
        ];
        // dd($data);
        $this->ModelUser->edit($data);
        set_notifikasi_swal('success', 'Berhasil', 'Mengganti Password dosen!');
        return redirect()->to(base_url('Dosen/Akun'));
    }
}
