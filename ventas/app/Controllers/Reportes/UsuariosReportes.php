<?php

namespace App\Controllers\Reportes;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;

class UsuariosReportes extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(site_url('login'));
        }

        if (session()->get('usuario_rol') !== 'admin') {
            return redirect()->to(site_url('dashboard'));
        }

        return view('reportes/usuarios');
    }
}