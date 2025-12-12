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
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $usuarioModel = new UsuariosModel();
        $usuario = $usuarioModel->where('email', $email)->first();

        if (!$usuario) {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }

        if (!password_verify($password, $usuario['password'])) {
            return redirect()->back()->with('error', 'Contraseña incorrecta');
        }

        // Guardar sesión
        session()->set([
            'usuario_id' => $usuario['id'],
            'usuario_nombre' => $usuario['nombre'],
            'usuario_rol' => $usuario['rol'],
            'logged_in' => true
        ]);

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}