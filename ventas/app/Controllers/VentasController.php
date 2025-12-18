<?php

namespace App\Controllers;

use App\Models\VentasModel;
use App\Models\ClientesModel;
use App\Models\ProductosModel;
use App\Models\DetalleVentaModel;

class VentasController extends BaseController
{
    public function index()
    {
        $ventasModel   = new VentasModel();
        $detalleModel  = new DetalleVentaModel();

        // 1. Ver si hay una venta activa en sesión
        $idVenta = session()->get('venta_id');

        // 2. Si no hay, crearla
        if (!$idVenta) {
            $ventasModel->insert([
                'id_usuario' => session()->get('id'),
                'id_cliente' => null,
                'total'      => 0
            ]);

            $idVenta = $ventasModel->getInsertID();
            session()->set('venta_id', $idVenta);
        }

        // 3. Obtener detalle de la venta
        $detalle = $detalleModel
            ->select('detalle_venta.*, productos.nombre')
            ->join('productos', 'productos.id = detalle_venta.id_producto')
            ->where('id_venta', $idVenta)
            ->findAll();

        // 4. Total
        $total = array_sum(array_column($detalle, 'subtotal'));

        return view('ventas/index_ventas', [
            'venta_id' => $idVenta,
            'detalle'  => $detalle,
            'total'    => $total
        ]);
    }
}