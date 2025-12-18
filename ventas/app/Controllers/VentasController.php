<?php

namespace App\Controllers;

use App\Models\VentasModel;
use App\Models\ClientesModel;

class VentasController extends BaseController
{
    public function index()
    {
        $model = new VentasModel();

        $data['ventas'] = $model
            ->select('ventas.*, clientes.nombre as cliente')
            ->join('clientes', 'clientes.id = ventas.id_cliente')
            ->orderBy('ventas.id', 'DESC')
            ->findAll();

        return view('ventas/index', $data);
    }

    public function crear()
    {
        $clientesModel = new ClientesModel();

        $data['clientes'] = $clientesModel->findAll();

        return view('ventas/crear', $data);
    }

    public function guardar()
    {
        if (!$this->validate([
            'id_cliente' => 'required'
        ])) {
            return redirect()->back()->withInput();
        }

        $model = new VentasModel();

        $model->insert([
            'id_usuario' => session()->get('id'), // usuario logueado
            'id_cliente' => $this->request->getPost('id_cliente'),
            'total'      => 0
        ]);

        $idVenta = $model->getInsertID();

        // luego iremos a agregar productos
        return redirect()->to(site_url('ventas/detalle/' . $idVenta));
    }
}