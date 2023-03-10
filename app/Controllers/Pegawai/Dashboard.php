<?php

namespace App\Controllers\pegawai;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'isi'   => 'pegawai/v_dashboard',
            'title' => 'Dashboard',
        ];
        return view('layout/v_wrapper', $data);
    }
}
