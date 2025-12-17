<?php

namespace App\Controllers;

use App\Models\VentasModel;
use App\Models\DetalleVentaModel;
use App\Models\ProductosModel;

class VentasController extends BaseController
{
    public function index()
    {
        $model = new UsuariosModel();
        $data['usuarios'] = $model->findAll();

        return view('usuarios/index_CRUD_usuarios', $data);
    }

    public function guardar()
    {
        $db = \Config\Database::connect();
        $db->transStart();

        $ventasModel  = new VentasModel();
        $detalleModel = new DetalleVentaModel();
        $productosModel = new ProductosModel();

        $cliente_id = $this->request->getPost('cliente_id');
        $productos  = $this->request->getPost('productos'); 
        // productos = [ [producto_id, cantidad], ... ]

        if (!$cliente_id || empty($productos)) {
            return redirect()->back()->with('error', 'Datos incompletos');
        }

        $total = 0;

        //Calcular total y validar stock
        foreach ($productos as $item) {
            $producto = $productosModel->find($item['producto_id']);

            if (!$producto) {
                $db->transRollback();
                return redirect()->back()->with('error', 'Producto no existe');
            }

            if ($producto['stock'] < $item['cantidad']) {
                $db->transRollback();
                return redirect()->back()
                    ->with('error', 'Stock insuficiente para ' . $producto['nombre']);
            }

            $subtotal = $producto['precio'] * $item['cantidad'];
            $total += $subtotal;
        }

        //Insertar venta
        $venta_id = $ventasModel->insert([
            'cliente_id' => $cliente_id,
            'usuario_id' => session('usuario_id'),
            'total'      => $total,
            'fecha'      => date('Y-m-d H:i:s')
        ]);

        //Insertar detalle y descontar stock
        foreach ($productos as $item) {
            $producto = $productosModel->find($item['producto_id']);
            $subtotal = $producto['precio'] * $item['cantidad'];

            $detalleModel->insert([
                'venta_id'        => $venta_id,
                'producto_id'     => $item['producto_id'],
                'cantidad'        => $item['cantidad'],
                'precio_unitario' => $producto['precio'],
                'subtotal'        => $subtotal
            ]);

            // Descontar stock
            $productosModel->update(
                $item['producto_id'],
                ['stock' => $producto['stock'] - $item['cantidad']]
            );
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Error al registrar venta');
        }

        return redirect()->to('/ventas')->with('success', 'Venta registrada correctamente');
    }
}