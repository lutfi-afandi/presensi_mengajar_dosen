<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

class Ta extends BaseController
{
    public function index()
    {
        $data = [
            'isi'   => 'admin/v_ta',
            'title' => 'Ta',
            'ta' => $this->ModelTa->getTa(),
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        $data = [
            'ta' => $this->request->getPost('ta1') . "/" . $this->request->getPost('ta2'),
        ];
        // dd($data);
        $this->ModelTa->tambah($data);
        set_notifikasi_swal('success', 'Berhasil', 'Menambah ta!');
        return redirect()->to(base_url('Admin/Ta'));
    }

    public function delete($id_ta)
    {
        $this->ModelTa->hapus($id_ta);
        set_notifikasi_swal('success', 'Berhasil', 'Ta telah dihapus!');
        return redirect()->to(base_url('Admin/Ta'));
    }
}
