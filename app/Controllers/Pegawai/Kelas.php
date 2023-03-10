<?php

namespace App\Controllers\pegawai;

use App\Controllers\BaseController;

class Kelas extends BaseController
{
    public function index()
    {
        $data = [
            'isi'   => 'pegawai/v_kelas',
            'title' => 'Kelas',
            'kelas' => $this->ModelKelas->getKelas(),
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        $valid = $this->validate([
            'kode_kelas'    => [
                'label'     => 'Kode Kelas',
                'rules'     => 'required|is_unique[kelas.kode_kelas]',
                'errors'    => [
                    'required'      => '{field} wajib diisi!',
                    'is_unique'     => '{filed} sudah ada'
                ]
            ]
        ]);
        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Pegawai/Kelas'));
        } else {
            $data = [
                'kode_kelas' => $this->request->getPost('kode_kelas'),
                'nama_kelas' => $this->request->getPost('nama_kelas'),
                'angkatan_kelas' => $this->request->getPost('angkatan_kelas'),
            ];
            // dd($data);
            $this->ModelKelas->tambah($data);
            set_notifikasi_swal('success', 'Berhasil', 'Menambah kelas!');
            return redirect()->to(base_url('Pegawai/Kelas'));
        }
    }

    public function delete($id_kelas)
    {
        $this->ModelKelas->hapus($id_kelas);
        set_notifikasi_swal('success', 'Berhasil', 'Kelas telah dihapus!');
        return redirect()->to(base_url('Pegawai/Kelas'));
    }
}
