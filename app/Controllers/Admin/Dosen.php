<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

class Dosen extends BaseController
{
    public function index()
    {
        $data = [
            'isi'   => 'admin/dosen/v_list',
            'title' => 'Dosen',
            'dosen' => $this->ModelUser->getDosen(),
        ];
        return view('layout/v_wrapper', $data);
    }

    public function tambah()
    {
        $data = [
            'isi'   => 'admin/dosen/v_tambah',
            'title' => 'Tambah Dosen',
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
                'rules' => 'uploaded[foto_user]|max_size[foto_user,5000]|mime_in[foto_user,image/jpg,image/jpeg,image/gif,image/png]',
                'errors' => [
                    'uploaded'  => 'Pilih Foto terlebih dulu',
                    'mime_in'   => 'format file tidak sesuai',
                    'max_size'  => 'Ukuran gambar maximal 5 MB'
                ]
            ],
        ]);
        if (!$validation) {
            return redirect()->to(base_url('Admin/Dosen/tambah'))->withInput()->with('validation', $validation);
        } else {
            $fileFoto = $this->request->getFile('foto_user');
            $fileFoto->move('assets/uploads/foto_dosen');
            // Ambil nama file
            $foto_dosen = $fileFoto->getName();
            $data = [
                'nidn' => $this->request->getPost('nidn'),
                'nama_user' => $this->request->getPost('nama_user'),
                'nik' => $this->request->getPost('nik'),
                'alamat_user' => $this->request->getPost('alamat_user'),
                'jk_user' => $this->request->getPost('jk_user'),
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'level'     => '2',
                'foto_user'    => $foto_dosen,
            ];
            // dd($data);
            $this->ModelUser->tambah($data);
            set_notifikasi_swal('success', 'Berhasil', 'Menambah dosen!');
            return redirect()->to(base_url('Admin/Dosen'));
        }
    }


    public function ubah($id_dosen)
    {
        $data = [
            'isi'   => 'admin/dosen/v_ubah',
            'title' => 'Ubah data Dosen',
            'validation' => $this->validation,
            'dosen' => $this->ModelUser->getDosen($id_dosen),
        ];
        return view('layout/v_wrapper', $data);
    }

    public function update($id_dosen)
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
            return redirect()->to(base_url('Admin/Dosen/ubah/' . $id_dosen))->withInput()->with('validation', $validation);
        } else {

            $data = [
                'id_user'      => $id_dosen,
                'nidn' => $this->request->getPost('nidn'),
                'nik' => $this->request->getPost('nik'),
                'nama_user' => $this->request->getPost('nama_user'),
                'alamat_user' => $this->request->getPost('alamat_user'),
                'jk_user' => $this->request->getPost('jk_user'),
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
            ];
            // dd($data);
            $this->ModelUser->edit($data);
            set_notifikasi_swal('success', 'Berhasil', 'Mengubah data dosen!');
            return redirect()->to(base_url('Admin/Dosen'));
        }
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
            return redirect()->to(base_url('Admin/Dosen'));
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
            set_notifikasi_swal('success', 'Berhasil', 'Menambah dosen!');
            return redirect()->to(base_url('Admin/Dosen'));
        }
    }

    public function delete($id_dosen)
    {
        $dosen = $this->ModelUser->getDosen($id_dosen);
        // dd($dosen['foto_dosen']);
        unlink('assets/uploads/foto_dosen/' . $dosen['foto_user']);

        $this->ModelUser->hapus($id_dosen);
        set_notifikasi_swal('success', 'Berhasil', 'Dosen telah dihapus!');
        return redirect()->to(base_url('Admin/Dosen'));
    }
}
