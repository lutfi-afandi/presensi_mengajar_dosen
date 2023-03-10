<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

class Pegawai extends BaseController
{
    public function index()
    {
        $data = [
            'isi'   => 'admin/pegawai/v_list',
            'title' => 'Pegawai',
            'pegawai' => $this->ModelUser->getPegawai(),
        ];
        return view('layout/v_wrapper', $data);
    }

    public function tambah()
    {
        $data = [
            'isi'   => 'admin/pegawai/v_tambah',
            'title' => 'Tambah Pegawai',
            'validation' => $this->validation,
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        $validation = $this->validate([
            'nidn'    => [
                'label'     => 'NIDN',
                'rules'     => 'required|is_unique[user.nidn]',
                'errors'    => [
                    'required'      => '{field} wajib diisi!',
                    'is_unique'     => '{filed} sudah ada'
                ]
            ],
            'username'    => [
                'label'     => 'Username',
                'rules'     => 'required|is_unique[user.username]',
                'errors'    => [
                    'required'      => '{field} wajib diisi!',
                    'is_unique'     => '{filed} sudah ada'
                ]
            ],
            'foto_user'         => [
                'rules' => 'uploaded[foto_user]|max_size[foto_user,5120]|mime_in[foto_user,image/jpg,image/jpeg,image/gif,image/png]',
                'errors' => [
                    'uploaded'  => 'Pilih Foto terlebih dulu',
                    'mime_in'   => 'format file tidak sesuai',
                    'max_size'  => 'Ukuran gambar maximal 5 MB'
                ]
            ],
        ]);
        if (!$validation) {
            return redirect()->to(base_url('Admin/Pegawai/tambah'))->withInput()->with('validation', $validation);
        } else {
            $fileFoto = $this->request->getFile('foto_user');
            $fileFoto->move('assets/uploads/foto_user');
            // Ambil nama file
            $foto_user = $fileFoto->getName();
            $data = [
                'nidn' => $this->request->getPost('nidn'),
                'nama_user' => $this->request->getPost('nama_user'),
                'nik' => $this->request->getPost('nik'),
                'alamat_user' => $this->request->getPost('alamat_user'),
                'jk_user' => $this->request->getPost('jk_user'),
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'level'     => '3',
                'foto_user'    => $foto_user,
            ];
            // dd($data);
            $this->ModelUser->tambah($data);
            set_notifikasi_swal('success', 'Berhasil', 'Menambah Pegawai!');
            return redirect()->to(base_url('Admin/Pegawai'));
        }
    }


    public function ubah($id_pegawai)
    {
        $data = [
            'isi'   => 'admin/pegawai/v_ubah',
            'title' => 'Ubah data Dosen',
            'validation' => $this->validation,
            'pegawai' => $this->ModelUser->getPegawai($id_pegawai),
        ];
        return view('layout/v_wrapper', $data);
    }

    public function update($id_pegawai)
    {
        $validation = $this->validate([
            'nidn'    => [
                'label'     => 'NIDN',
                'rules'     => 'required',
                'errors'    => [
                    'required'      => '{field} wajib diisi!',
                ]
            ],
            'username'    => [
                'label'     => 'Username',
                'rules'     => 'required',
                'errors'    => [
                    'required'      => '{field} wajib diisi!',
                ]
            ],

        ]);
        if (!$validation) {
            return redirect()->to(base_url('Admin/Pegawai/ubah/' . $id_pegawai))->withInput()->with('validation', $validation);
        } else {

            $data = [
                'id_user'      => $id_pegawai,
                'nidn' => $this->request->getPost('nidn'),
                'nama_user' => $this->request->getPost('nama_user'),
                'alamat_user' => $this->request->getPost('alamat_user'),
                'jk_user' => $this->request->getPost('jk_user'),
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
            ];
            // dd($data);
            $this->ModelUser->edit($data);
            set_notifikasi_swal('success', 'Berhasil', 'Mengubah data dosen!');
            return redirect()->to(base_url('Admin/Pegawai'));
        }
    }

    public function ubah_foto($id_pegawai)
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
            return redirect()->to(base_url('Admin/Pegawai'));
        } else {
            $dosen = $this->ModelUser->getPegawai($id_pegawai);
            // dd($dosen['foto_user']);
            unlink('assets/uploads/foto_user/' . $dosen['foto_user']);

            $fileFoto = $this->request->getFile('foto_baru');
            $fileFoto->move('assets/uploads/foto_user');
            // Ambil nama file
            $foto_user = $fileFoto->getName();
            $data = [
                'id_user'  => $id_pegawai,
                'foto_user'    => $foto_user,
            ];
            // dd($data);
            $this->ModelUser->edit($data);
            set_notifikasi_swal('success', 'Berhasil', 'Menambah dosen!');
            return redirect()->to(base_url('Admin/Pegawai'));
        }
    }

    public function delete($id_pegawai)
    {
        $dosen = $this->ModelUser->getPegawai($id_pegawai);
        // dd($dosen['foto_user']);
        unlink('assets/uploads/foto_user/' . $dosen['foto_user']);

        $this->ModelUser->hapus($id_pegawai);
        set_notifikasi_swal('success', 'Berhasil', 'Dosen telah dihapus!');
        return redirect()->to(base_url('Admin/Pegawai'));
    }
}
