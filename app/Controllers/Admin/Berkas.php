<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

class Berkas extends BaseController
{
    public function index()
    {
        $id_admin = session()->get('id_user');
        $data = [
            'isi'   => 'admin/berkas/v_list',
            'title' => 'DAFTAR BERKAS',
            'ta'    => $this->ModelTa->getTa(),
            'makul'    => $this->ModelMakul->getMakul(),
            'berkas'    => $this->ModelBerkas->getBerkas(),
            'user'      => $this->ModelUser->getAll(),
        ];
        return view('layout/v_wrapper', $data);
        // return view('admin/absensi/v_tambah',$data);
    }

    public function add()
    {
        $id_admin = session()->get('id_user');
        $validation = $this->validate([
            'file_berkas'         => [
                'rules' => 'uploaded[file_berkas]|max_size[file_berkas,5120]|mime_in[file_berkas,image/jpg,image/jpeg,image/gif,image/png,application/pdf]',
                'errors' => [
                    'uploaded'  => 'Pilih file terlebih dulu',
                    'mime_in'   => 'format file tidak sesuai',
                    'max_size'  => 'Ukuran gambar maximal 5 MB'
                ]
            ],
        ]);
        if (!$validation) {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Admin/Berkas'));
        } else {
            $berkas = $this->request->getFile('file_berkas');
            $berkas->move('assets/uploads/berkas/');
            // Ambil nama file
            $berkas_file = $berkas->getName();
            $data = [
                'user_id'  => $this->request->getPost('id_user'),
                'nama_file'     => $this->request->getPost('nama_file'),
                'file_berkas'    => $berkas_file,
            ];
            // dd($data);
            $this->ModelBerkas->tambah($data);
            set_notifikasi_swal('success', 'Berhasil', 'Menambah berkas!');
            return redirect()->to(base_url('Admin/Berkas'));
        }
    }

    public function delete($id_berkas)
    {
        $berkas = $this->ModelBerkas->getBerkas($id_berkas);
        // dd($berkas['foto_berkas']);
        unlink('assets/uploads/berkas/' . $berkas['file_berkas']);

        $this->ModelBerkas->hapus($id_berkas);
        set_notifikasi_swal('success', 'Berhasil', 'Berkas telah dihapus!');
        return redirect()->to(base_url('Admin/Berkas'));
    }

    public function download($id_berkas)
    {
        $berkas = $this->ModelBerkas->getBerkas($id_berkas);
        // dd($berkas);
        return $this->response->download('assets/uploads/berkas/' . $berkas['file_berkas'], null);
    }
}
