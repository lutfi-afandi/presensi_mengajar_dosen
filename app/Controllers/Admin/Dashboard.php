<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'isi'   => 'admin/v_dashboard',
            'title' => 'Dashboard',
        ];
        return view('layout/v_wrapper', $data);
    }
}
