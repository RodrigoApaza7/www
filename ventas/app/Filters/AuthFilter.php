<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
{
    log_message('error', 'DEBUG FILTER: ' . json_encode([
        'logged_in'   => session()->get('logged_in'),
        'usuario_rol' => session()->get('usuario_rol'),
        'arguments'   => $arguments,
    ]));

    if (!session()->get('logged_in')) {
        return redirect()->to('/login');
    }

    if (!empty($arguments)) {
        $rolUsuario = session()->get('usuario_rol');

        if (!$rolUsuario || !in_array($rolUsuario, $arguments)) {
            return redirect()->to(site_url('dashboard'));
        }
    }
}


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No se usa
    }
    public $filters = [];

}