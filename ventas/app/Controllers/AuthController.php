<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

class AuthController extends BaseController
{
    public function index()
    {
        return view('auth_login');
    }

    public function autenticar()
    {
        $usuarioInput = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');

        $usuarioModel = new UsuariosModel();
        $usuario = $usuarioModel->where('usuario', $usuarioInput)->first();

        if (!$usuario) {
            return redirect()->to(site_url('login'));
        }

        if (!password_verify($password, $usuario['password'])) {
            return redirect()->to(site_url('login'));
        }

        session()->set([
            'usuario_id' => $usuario['id'],
            'usuario_nombre' => $usuario['nombre'],
            'usuario_rol' => $usuario['rol'],
            'logged_in' => true
        ]);

        return redirect()->to(site_url('dashboard'));
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}