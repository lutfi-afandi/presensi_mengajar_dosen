<?php

namespace App\Controllers\pegawai;

use App\Controllers\BaseController;

class Matakuliah extends BaseController
{
    public function index()
    {
        $data = [
            'isi'   => 'pegawai/v_makul',
            'title' => 'Mata Kuliah',
            'makul' => $this->ModelMakul->getMakul(),
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        $valid = $this->validate([
            'kode_makul'    => [
                'label'     => 'Kode Mata Kuliah',
                'rules'     => 'required|is_unique[mata_kuliah.kode_makul]',
                'errors'    => [
                    'required'      => '{field} wajib diisi!',
                    'is_unique'     => '{filed} sudah ada'
                ]
            ]
        ]);
        if (!$valid) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Pegawai/Matakuliah'));
        } else {
            $data = [
                'kode_makul' => $this->request->getPost('kode_makul'),
                'nama_makul' => $this->request->getPost('nama_makul'),
            ];
            // dd($data);
            $this->ModelMakul->tambah($data);
            set_notifikasi_swal('success', 'Berhasil', 'Menambah makul!');
            return redirect()->to(base_url('Pegawai/Matakuliah'));
        }
    }

    public function delete($id_makul)
    {
        $this->ModelMakul->hapus($id_makul);
        set_notifikasi_swal('success', 'Berhasil', 'Matakuliah telah dihapus!');
        return redirect()->to(base_url('Pegawai/Matakuliah'));
    }
}
