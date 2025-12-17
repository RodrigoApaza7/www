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
        //Login obligatorio
        if (!session()->get('logged_in')) {
            return redirect()->to(site_url('login'));
        }

        //SOLO validar rol si EXPLICITAMENTE se pasaron roles
        if ($arguments !== null && count($arguments) > 0) {

            $rolUsuario = session()->get('usuario_rol');

            if (!$rolUsuario || !in_array($rolUsuario, $arguments)) {
                return redirect()->to(site_url('dashboard'));
            }
        }

        //Si no hay roles, solo login basta
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}