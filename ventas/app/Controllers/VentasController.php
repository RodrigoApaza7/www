<?php

namespace App\Controllers;

use App\Models\VentasModel;
use App\Models\ClientesModel;
use App\Models\DetalleVentaModel;

class VentasController extends BaseController
{
    public function index()
    {
        $idUsuario = session()->get('usuario_id');

        $ventasModel  = new VentasModel();
        $detalleModel = new DetalleVentaModel();

        //Ver si hay una venta activa en sesión
        $idVenta = session()->get('venta_id');

        //Si no hay venta, crearla
        if (!$idVenta) {
            $ventasModel->insert([
                'id_usuario' => $idUsuario,
                'id_cliente' => null,   // se asignará luego en la caja
                'total'      => 0
            ]);

            $idVenta = $ventasModel->getInsertID();
            session()->set('venta_id', $idVenta);
        }

        //Obtener detalle de la venta
        $detalle = $detalleModel
            ->select('detalle_venta.*, productos.nombre')
            ->join('productos', 'productos.id = detalle_venta.id_producto')
            ->where('id_venta', $idVenta)
            ->findAll();

        //Calcular total (en memoria por ahora)
        $total = array_sum(array_column($detalle, 'subtotal'));

        //Mostrar la caja
        return view('caja/index_ventas', [
            'venta_id' => $idVenta,
            'detalle'  => $detalle,
            'total'    => $total
        ]);
    }

    public function buscarCliente()
    {
        $dni = $this->request->getPost('dni');

        $clientesModel = new ClientesModel();
        $cliente = $clientesModel->where('dni', $dni)->first();

        if ($cliente) {
            $idVenta = session()->get('venta_id');

            $ventasModel = new VentasModel();
            $ventasModel->update($idVenta, [
                'id_cliente' => $cliente['id']
            ]);

            return $this->response->setJSON([
                'existe' => true,
                'cliente' => $cliente
            ]);
        }

        return $this->response->setJSON([
            'existe' => false
        ]);
    }


    public function crearCliente()
    {
        $clientesModel = new ClientesModel();
        $ventasModel   = new VentasModel();

        $dni = $this->request->getPost('dni');

        // evitar duplicado
        if ($clientesModel->where('dni', $dni)->first()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Cliente ya existe'
            ]);
        }

        $idCliente = $clientesModel->insert([
            'nombre'    => $this->request->getPost('nombre'),
            'dni'       => $dni,
            'direccion' => $this->request->getPost('direccion')
        ]);

        $ventasModel->update(session()->get('venta_id'), [
            'id_cliente' => $idCliente
        ]);

        return $this->response->setJSON([
            'success' => true,
            'cliente_id' => $idCliente
        ]);
    }

    public function agregarProducto()
    {
        $productosModel = new \App\Models\ProductosModel();
        $detalleModel   = new \App\Models\DetalleVentaModel();

        $idProducto = $this->request->getPost('id_producto');
        $cantidad   = (int) $this->request->getPost('cantidad');
        $idVenta    = session()->get('venta_id');

        $producto = $productosModel->find($idProducto);

        if (!$producto) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Producto no existe'
            ]);
        }

        if ($producto['stock'] < $cantidad) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Stock insuficiente'
            ]);
        }

        $subtotal = $cantidad * $producto['precio'];

        // insertar detalle
        $detalleModel->insert([
            'id_venta'       => $idVenta,
            'id_producto'    => $idProducto,
            'cantidad'       => $cantidad,
            'precio_unitario'=> $producto['precio'],
            'subtotal'       => $subtotal
        ]);

        // descontar stock
        $productosModel->update($idProducto, [
            'stock' => $producto['stock'] - $cantidad
        ]);

        return $this->response->setJSON([
            'success' => true,
            'producto' => $producto['nombre'],
            'cantidad' => $cantidad,
            'precio'   => $producto['precio'],
            'subtotal' => $subtotal
        ]);
    }

}