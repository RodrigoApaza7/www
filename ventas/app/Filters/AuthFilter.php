<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        //Verificar login
        if (!session()->get('logged_in')) {
            return redirect()->to(site_url('login'));
        }

        //Si la ruta define roles
        if (is_array($arguments) && count($arguments) > 0) {

            $rolUsuario = session()->get('usuario_rol');

            // Si no hay rol o no está permitido
            if (!$rolUsuario || !in_array($rolUsuario, $arguments)) {
                return redirect()->to(site_url('dashboard'));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}