<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Filteradmin implements FilterInterface
{
    public function __construct()
    {
        helper('swal_helper');
    }
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        if (session()->get('level') == '') {
            return redirect()->to(base_url('login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
        if (session()->get('level') == '1') {

            return redirect()->to(base_url('admin/dashboard'));
        }
    }
}