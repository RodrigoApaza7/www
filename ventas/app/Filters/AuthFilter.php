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
        $session = Services::session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (!empty($arguments)) {
            $rolUsuario = $session->get('usuario_rol');

            if (!$rolUsuario || !in_array($rolUsuario, $arguments)) {
                return redirect()->to(site_url('dashboard'));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}