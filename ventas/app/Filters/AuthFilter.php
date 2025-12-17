<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        dd([
        'logged_in' => session()->get('logged_in'),
        'usuario_rol' => session()->get('usuario_rol'),
        'arguments' => $arguments,
        ]);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No se usa
    }
    public $filters = [];

}