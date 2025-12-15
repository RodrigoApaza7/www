<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

class UsuarioController extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(site_url('login'));
        }

        if (session()->get('usuario_rol') !== 'admin') {
            return redirect()->to(site_url('dashboard'));
        }

        $model = new UsuariosModel();
        $data['usuarios'] = $model->findAll();

        return view('usuarios/index_CRUD_usuarios', $data);
    }

    public function crear()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(site_url('login'));
        }

        if (session()->get('usuario_rol') !== 'admin') {
            return redirect()->to(site_url('dashboard'));
        }

        return view('usuarios/crear');
    }

    public function guardar()
    {
        $model = new UsuariosModel();

        $model->insert([
            'nombre'  => $this->request->getPost('nombre'),
            'usuario' => $this->request->getPost('usuario'),
            'password'=> password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'rol' => 'vendedor'
        ]);

        return redirect()->to(site_url('dashboard'));
    }

    public function editar($id)
    {
        $model = new UsuariosModel();
        $data['usuario'] = $model->find($id);

        return view('usuarios/editar', $data);
    }

    public function actualizar($id)
    {
        $model = new UsuariosModel();

        $data = [
            'nombre'  => $this->request->getPost('nombre'),
            'usuario' => $this->request->getPost('usuario'),
            'rol'     => $this->request->getPost('rol')
        ];

        // Solo actualizar password si se envía
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            );
        }

        $model->update($id, $data);

        return redirect()->to(site_url('usuarios'));
    }

    public function eliminar($id)
    {
        $model = new UsuariosModel();
        $model->delete($id);

        return redirect()->to(site_url('usuarios'));
    }
}