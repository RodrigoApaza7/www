<?php

namespace App\Controllers;

use App\Models\PersonasModel;

class PersonasController extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(site_url('login'));
        }

        $model = new PersonasModel();
        $data['personas'] = $model->findAll();

        return view('personas/index_CRUD_personas', $data);
    }

    public function crear()
    {
        return view('personas/crear');
    }

    public function guardar()
    {
        $model = new PersonasModel();

        $model->insert([
            'nombre'  => $this->request->getPost('nombre'),
            'paterno' => $this->request->getPost('paterno'),
            'materno' => $this->request->getPost('materno')
        ]);

        return redirect()->to(site_url('personas'));
    }

    public function editar($id)
    {
        $model = new PersonasModel();
        $data['persona'] = $model->find($id);

        return view('personas/editar', $data);
    }

    public function actualizar($id)
    {
        $model = new PersonasModel();

        $model->update($id, [
            'nombre'  => $this->request->getPost('nombre'),
            'paterno' => $this->request->getPost('paterno'),
            'materno' => $this->request->getPost('materno')
        ]);

        return redirect()->to(site_url('personas'));
    }

    public function eliminar($id)
    {
        $model = new PersonasModel();
        $model->delete($id);

        return redirect()->to(site_url('personas'));
    }
}