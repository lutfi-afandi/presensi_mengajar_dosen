<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'     => CSRF::class,
        'toolbar'  => DebugToolbar::class,
        'honeypot' => Honeypot::class,
        'filteradmin' => \App\Filters\Filteradmin::class,
        'filterdosen' => \App\Filters\Filterdosen::class,
        'filterpegawai' => \App\Filters\Filterpegawai::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            'filteradmin' => [
                'except' => [
                    'login', 'login/*',
                    '/'
                ]
            ],
            'filterdosen' => [
                'except' => [
                    'login', 'login/*',
                    '/'
                ]
            ],
            'filterpegawai' => [
                'except' => [
                    'login', 'login/*',
                    '/'
                ]
            ],
            // 'honeypot',
            // 'csrf',
        ],
        'after' => [
            'filteradmin' => [
                'except' => [
                    'admin', 'admin/*',
                    'admin', 'admin/dashboard/*',
                    'admin', 'admin/absensi/*',
                    'admin', 'admin/berkas/*',
                    'admin', 'admin/dosen/*',
                    'admin', 'admin/kelas/*',
                    'admin', 'admin/matakuliah/*',
                    'admin', 'admin/pegawai/*',
                    'admin', 'admin/ta/*',
                    'admin', 'admin/user/*',
                ]
            ],
            'filterdosen' => [
                'except' => [
                    'dosen', 'dosen/*',
                    'dosen', 'dosen/dashboard/*',
                    'dosen', 'dosen/absensi/*',
                    'dosen', 'dosen/akun/*',
                    'dosen', 'dosen/berkas/*',
                ]
            ],
            'filterpegawai' => [
                'except' => [
                    'pegawai', 'pegawai/*',
                    'pegawai', 'pegawai/akun/*',
                    'pegawai', 'pegawai/berkas/*',
                    'pegawai', 'pegawai/dashboard/*',
                    'pegawai', 'pegawai/dosen/*',
                    'pegawai', 'pegawai/kelas/*',
                    'pegawai', 'pegawai/matakuliah/*',
                    'pegawai', 'pegawai/pegawai/*',
                    'pegawai', 'pegawai/ta/*',
                ]
            ],
            'toolbar',
            // 'honeypot',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [];
}
