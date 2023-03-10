<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

class User extends BaseController
{
    public function index()
    {
        $data = [
            'isi'   => 'admin/user/v_list',
            'title' => 'User',
            'user' => $this->ModelUser->getUser(),
        ];
        return view('layout/v_wrapper', $data);
    }

    public function tambah()
    {
        $data = [
            'isi'   => 'admin/user/v_tambah',
            'title' => 'Tambah User',
            'validation' => $this->validation,
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        $validation = $this->validate([
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
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Admin/User'));
        } else {
            $fileFoto = $this->request->getFile('foto_user');
            $fileFoto->move('assets/uploads/foto_user');
            // Ambil nama file
            $foto_user = $fileFoto->getName();
            $data = [
                'nama_user' => $this->request->getPost('nama_user'),
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'level'     => '1',
                'foto_user'    => $foto_user,
            ];
            // dd($data);
            $this->ModelUser->tambah($data);
            set_notifikasi_swal('success', 'Berhasil', 'Menambah user!');
            return redirect()->to(base_url('Admin/User'));
        }
    }

    public function update($id_user)
    {
        $validation = $this->validate([

            'username'    => [
                'label'     => 'Username',
                'rules'     => 'required',
                'errors'    => [
                    'required'      => '{field} wajib diisi!',
                ]
            ],

        ]);
        if (!$validation) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Admin/User'));
        } else {

            $data = [
                'id_user'      => $id_user,
                'nama_user' => $this->request->getPost('nama_user'),
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
            ];
            // dd($data);
            $this->ModelUser->edit($data);
            set_notifikasi_swal('success', 'Berhasil', 'Mengubah data user!');
            return redirect()->to(base_url('Admin/User'));
        }
    }
    public function pasbar($id_user)
    {
        $validation = $this->validate([

            'pasbar'    => [
                'label'     => 'Password',
                'rules'     => 'required',
                'errors'    => [
                    'required'      => '{field} wajib diisi!',
                ]
            ],

        ]);
        if (!$validation) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Admin/User'));
        } else {

            $data = [
                'id_user'      => $id_user,
                'password' => $this->request->getPost('pasbar'),
            ];
            // dd($data);
            $this->ModelUser->edit($data);
            set_notifikasi_swal('success', 'Berhasil', 'Mengubah data user!');
            return redirect()->to(base_url('Admin/User'));
        }
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
            return redirect()->to(base_url('Admin/User'));
        } else {
            $user = $this->ModelUser->getUser($id_user);
            // dd($user['foto_user']);
            unlink('assets/uploads/foto_user/' . $user['foto_user']);

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
            set_notifikasi_swal('success', 'Berhasil', 'Menambah user!');
            return redirect()->to(base_url('Admin/User'));
        }
    }

    public function delete($id_user)
    {
        $user = $this->ModelUser->getUser($id_user);
        // dd($user['foto_user']);
        unlink('assets/uploads/foto_user/' . $user['foto_user']);

        $this->ModelUser->hapus($id_user);
        set_notifikasi_swal('success', 'Berhasil', 'User telah dihapus!');
        return redirect()->to(base_url('Admin/User'));
    }
}
