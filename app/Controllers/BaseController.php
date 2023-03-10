<?php

namespace App\Controllers;

use App\Models\ModelAbsensi;
use App\Models\ModelBerkas;
use App\Models\ModelDosen;
use App\Models\ModelKelas;
use App\Models\ModelMakul;
use App\Models\ModelTa;
use App\Models\ModelUser;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        session();
        helper('form');
        helper('swal_helper');
        $this->validation = \Config\Services::validation();
        $this->getErrors = \Config\Services::validation()->getErrors();
        $this->db =  \Config\Database::connect();
        $this->session = \Config\Services::session();
        $this->ModelAbsensi = new ModelAbsensi();
        $this->ModelBerkas = new ModelBerkas();
        $this->ModelDosen = new ModelDosen();
        $this->ModelKelas = new ModelKelas();
        $this->ModelMakul = new ModelMakul();
        $this->ModelTa = new ModelTa();
        $this->ModelUser = new ModelUser();
    }
}
