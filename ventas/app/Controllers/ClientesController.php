<?php

namespace App\Controllers;

use App\Models\ClientesModel;

class ClientesController extends BaseController
{
    public function index()
    {
        $model = new ClientesModel();
        $data['clientes'] = $model->findAll();

        return view('clientes/index_clientes', $data);
    }

    public function crear()
    {
        return view('clientes/crear');
    }

    public function guardar()
    {

        if (!$this->validate([
            'nombre' => 'required',
            'dni'    => 'required|is_unique[clientes.dni]',
        ])) {
            return redirect()->back()->withInput();
        }

        $model = new ClientesModel();

        $model->insert([
            'nombre'  => $this->request->getPost('nombre'),
            'dni' => $this->request->getPost('dni'),
            'direccion' => $this->request->getPost('direccion'),
        ]);

        return redirect()->to(site_url('clientes'));
    }

    public function editar($id)
    {
        $model = new ClientesModel();
        $data['cliente'] = $model->find($id);

        return view('clientes/editar', $data);
    }

    public function actualizar($id)
    {
        if (!$this->validate([
            'nombre' => 'required',
            'dni'    => "required|is_unique[clientes.dni,id,$id]",
        ])) {
            return redirect()->back()->withInput();
        }

        $model = new ClientesModel();

        $model->update($id, [
            'nombre'    => $this->request->getPost('nombre'),
            'dni'       => $this->request->getPost('dni'),
            'direccion' => $this->request->getPost('direccion'),
        ]);

        return redirect()->to(site_url('clientes'));
    }

    public function eliminar($id)
    {
        $model = new ClientesModel();
        $model->delete($id);

        return redirect()->to(site_url('clientes'));
    }
}