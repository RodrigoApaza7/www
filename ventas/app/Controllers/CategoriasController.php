<?php

namespace App\Controllers;

use App\Models\CategoriasModel;

class CategoriasController extends BaseController
{
    public function index()
    {
        $model = new CategoriasModel();
        $data['categorias'] = $model->findAll();

        return view('categorias/index_CRUD_categorias', $data);
    }

    public function crear()
    {
        return view('categorias/crear');
    }

    public function guardar()
    {
        $model = new CategoriasModel();

        $model->insert([
            'nombre'  => $this->request->getPost('nombre'),
            'estado' => $this->request->getPost('estado'),
        ]);

        return redirect()->to(site_url('categorias'));
    }

    public function editar($id)
    {
        $model = new CategoriasModel();
        $data['categoria'] = $model->find($id);

        return view('categorias/editar', $data);
    }

    public function actualizar($id)
    {
        $model = new CategoriasModel();

        $model->update($id, [
            'nombre'  => $this->request->getPost('nombre'),
            'estado' => $this->request->getPost('estado')
        ]);

        return redirect()->to(site_url('categorias'));
    }

    public function eliminar($id)
    {
        $model = new CategoriasModel();
        $model->delete($id);

        return redirect()->to(site_url('categorias'));
    }
}