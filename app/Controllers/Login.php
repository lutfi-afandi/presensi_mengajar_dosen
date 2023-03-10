<?php

namespace App\Controllers;

use App\Models\ModelUser;

class Login extends BaseController
{
    public function __construct()
    {
        $this->ModelUser = new ModelUser();
    }
    public function index()
    {
        $data = [
            'title' => 'Login Absensi',
            'validation' => $this->validation,
        ];

        return view('v_login', $data);
    }

    public function cek_login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $level = $this->request->getPost('level');

        $validation = $this->validate([
            'username'    => [
                'label'     => 'Username',
                'rules'     => 'required',
                'errors'    => [
                    'required'      => '{field} wajib diisi!',
                ]
            ],
            'password'    => [
                'label'     => 'Password',
                'rules'     => 'required',
                'errors'    => [
                    'required'      => '{field} wajib diisi!',
                ]
            ],
        ]);

        if (!$validation) {
            // jika input tidak valid
            return redirect()->to(base_url('Login'))->withInput()->with('validation', $this->validation);
        } else {
            $cek_admin = $this->ModelUser->login_admin($username, $password);
            $cek_dosen = $this->ModelUser->login_dosen($username, $password);
            $cek_pegawai = $this->ModelUser->login_pegawai($username, $password);
            // jika dilihat di data sebagai admin
            if ($cek_admin) {
                session()->set('username', $cek_admin['username']);
                session()->set('id_user', $cek_admin['id_user']);
                session()->set('jk', $cek_admin['jk_user']);
                session()->set('nama_user', $cek_admin['nama_user']);
                session()->set('level', $cek_admin['level']);
                session()->set('foto', $cek_admin['foto_user']);
                return redirect()->to(base_url('Admin/Dashboard'));
            }
            // jika dilihat di data sebagai dosen
            elseif ($cek_dosen) {
                // dd($cek_dosen);
                session()->set('username', $cek_dosen['username']);
                session()->set('id_user', $cek_dosen['id_user']);
                session()->set('jk', $cek_dosen['jk_user']);
                session()->set('nama_user', $cek_dosen['nama_user']);
                session()->set('level', $cek_dosen['level']);
                session()->set('foto', $cek_dosen['foto_user']);
                return redirect()->to(base_url('Dosen/Dashboard'));
            }
            // jika dilihat di data sebagai pegawai
            elseif ($cek_pegawai) {
                session()->set('username', $cek_pegawai['username']);
                session()->set('id_user', $cek_pegawai['id_user']);
                session()->set('jk', $cek_pegawai['jk_user']);
                session()->set('nama_user', $cek_pegawai['nama_user']);
                session()->set('level', $cek_pegawai['level']);
                session()->set('foto', $cek_pegawai['foto_user']);
                return redirect()->to(base_url('Pegawai/Dashboard'));
            }
            // jika tidak ada data
            else {
                set_notifikasi_swal('error', 'Login Gagal!', 'Username atau Password salah!!');
                return redirect()->to(base_url('Login'));
            }
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('Login'));
    }
}
