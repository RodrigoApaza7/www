<?php

namespace App\Controllers;

use App\Models\ProductosModel;
use App\Models\CategoriasModel;

class ProductosController extends BaseController
{
    public function index()
    {
        $model = new ProductosModel();
        $data['productos'] = $model
            ->select('productos.*, categorias.nombre AS categoria')
            ->join('categorias', 'categorias.id = productos.categoria_id', 'left')
            ->findAll();

        return view('productos/index_productos', $data);
    }

    public function crear()
    {
        $categoriasModel = new CategoriasModel();

        $data['categorias'] = $categoriasModel
            ->select('id, nombre, estado')
            ->where('estado', 1)
            ->findAll();

        return view('productos/crear', $data);
    }

    public function guardar()
    {
        $model = new ProductosModel();
        $db = \Config\Database::connect();
        dd($db->database);

        $model->insert([
            'nombre'       => $this->request->getPost('nombre'),
            'precio'       => $this->request->getPost('precio'),
            'stock'        => $this->request->getPost('stock'),
            'categoria_id' => (int) $this->request->getPost('categoria_id'),
        ]);

        return redirect()->to(site_url('productos'));
    }

    public function editar($id)
    {
        $productosModel = new ProductosModel();
        $categoriasModel = new CategoriasModel();

        $data['producto'] = $productosModel->find($id);
        $data['categorias'] = $categoriasModel
            ->where('estado', 1)
            ->findAll();

        return view('productos/editar', $data);
    }

    public function actualizar($id)
    {
        $model = new ProductosModel();

        $model->update($id, [
            'nombre' => $this->request->getPost('nombre'),
            'precio' => $this->request->getPost('precio'),
            'stock'  => $this->request->getPost('stock'),
            'categoria_id' => $this->request->getPost('categoria_id')
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