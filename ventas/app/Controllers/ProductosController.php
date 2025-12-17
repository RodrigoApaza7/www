<?php

namespace App\Controllers;

use App\Models\ProductosModel;

class ProductosController extends BaseController
{
    public function index()
    {
        $model = new ProductosModel();
        $data['productos'] = $model->findAll();

        return view('productos/index_productos', $data);
    }

    public function crear()
    {
        return view('productos/crear');
    }

    public function guardar()
    {
        $model = new ProductosModel();

        $model->insert([
            'nombre' => $this->request->getPost('nombre'),
            'precio' => $this->request->getPost('precio'),
            'stock'  => $this->request->getPost('stock'),
        ]);

        return redirect()->to(site_url('productos'));
    }

    public function editar($id)
    {
        $model = new ProductosModel();
        $data['producto'] = $model->find($id);

        return view('productos/editar', $data);
    }

    public function actualizar($id)
    {
        $model = new ProductosModel();

        $model->update($id, [
            'nombre' => $this->request->getPost('nombre'),
            'precio' => $this->request->getPost('precio'),
            'stock'  => $this->request->getPost('stock'),
        ]);

        return redirect()->to(site_url('productos'));
    }

    public function eliminar($id)
    {
        $model = new ProductosModel();
        $model->delete($id);

        return redirect()->to(site_url('productos'));
    }
}