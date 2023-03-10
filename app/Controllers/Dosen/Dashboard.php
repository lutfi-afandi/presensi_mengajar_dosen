<?php

namespace App\Controllers\dosen;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
        $this->bulan = date("m");
    }

    public function index()
    {
        $id_dosen = session()->get('id_user');
        $absensi = $this->db->table('absensi')->where('id_absensi', '13')->get()->getRowArray();
        // dd('./assets/uploads/bukti_mengajar/' . $absensi['bukti']);
        // dd(file_exists('./assets/uploads/bukti_mengajar/' . $absensi['bukti']));

        // dd($this->bulan);
        $data = [
            'isi'   => 'dosen/v_dashboard',
            'title' => 'DAFTAR MENGAJAR BULAN INI',
            'absensi_dosen' => $this->ModelAbsensi->getAbsensi_dosen($id_dosen, $this->bulan),
        ];
        // dd($data['absensi_dosen']);
        return view('layout/v_wrapper', $data);
    }
}
