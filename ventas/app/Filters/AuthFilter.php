<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if ($arguments && isset($arguments[0])) {
            if (session()->get('usuario_rol') !== $arguments[0]) {
                return redirect()->to(site_url('dashboard'));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }

    public $aliases = [
        'auth' => \App\Filters\AuthFilter::class,
    ];

    public $filters = [
        'auth' => ['before' => ['dashboard*']],
    ];

}