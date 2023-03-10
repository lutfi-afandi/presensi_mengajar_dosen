<?php

namespace App\Controllers\pegawai;

use App\Controllers\BaseController;

class Akun extends BaseController
{
    public function index()
    {
        $id_user = session()->get('id_user');
        // dd($this->ModelUser->getPegawai($id_user));
        $data = [
            'isi'   => 'pegawai/akun/v_list',
            'title' => 'AKUN DOSEN',
            'pegawai'    => $this->ModelUser->getPegawai($id_user),
        ];
        return view('layout/v_wrapper', $data);
    }

    public function ubah($id_user)
    {
        $pegawai = $this->ModelUser->getPegawai($id_user);
        $data = [
            'isi'   => 'pegawai/akun/v_ubah',
            'title' => 'UBAH DATA',
            'pegawai'    => $pegawai,
            'validation' => $this->validation,
        ];
        return view('layout/v_wrapper', $data);
    }

    public function simpan($id_user)
    {
        $data = [
            'id_user'       => $id_user,
            'nama_user' => $this->request->getPost('nama_user'),
            'nik' => $this->request->getPost('nik'),
            'alamat_user' => $this->request->getPost('alamat_user'),
            'jk_user' => $this->request->getPost('jk_user'),
            'level'     => '3',
        ];
        // dd($data);
        $this->ModelUser->edit($data);
        set_notifikasi_swal('success', 'Berhasil', 'Menambah pegawai!');
        return redirect()->to(base_url('Pegawai/Akun'));
    }

    public function ubah_foto($id_user)
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
            return redirect()->to(base_url('Pegawai/Akun'));
        } else {
            $pegawai = $this->ModelUser->getPegawai($id_user);
            // dd($pegawai['foto_user']);
            unlink('assets/uploads/foto_user/' . $pegawai['foto_user']);

            $fileFoto = $this->request->getFile('foto_baru');
            $fileFoto->move('assets/uploads/foto_user');
            // Ambil nama file
            $foto_user = $fileFoto->getName();
            $data = [
                'id_user'  => $id_user,
                'foto_user'    => $foto_user,
            ];
            // dd($data);
            $this->ModelUser->edit($data);
            set_notifikasi_swal('success', 'Berhasil', 'Mengganti foto pegawai!');
            return redirect()->to(base_url('Pegawai/Akun'));
        }
    }

    public function ubah_password($id_user)
    {
        $data = [
            'id_user'  => $id_user,
            'password'    => $this->request->getPost('pasbar'),
        ];
        // dd($data);
        $this->ModelUser->edit($data);
        set_notifikasi_swal('success', 'Berhasil', 'Mengganti Password pegawai!');
        return redirect()->to(base_url('Pegawai/Akun'));
    }
}
