<?php

namespace App\Controllers\Reportes;

use App\Controllers\BaseController;
use App\Models\VentasModel;
use App\Models\DetalleVentaModel;

class VentasReportes extends BaseController
{
    /**
     * (opcional)
     * Vista de filtros de ventas
     */
    public function index()
    {
        return view('reportes/ventas_reportes');
    }

    /**
     * PDF de una venta específica
     */
    public function pdf($id)
    {
        $ventasModel  = new VentasModel();
        $detalleModel = new DetalleVentaModel();

        // Obtener venta + cliente
        $venta = $ventasModel
            ->select('ventas.*, clientes.nombre as cliente')
            ->join('clientes', 'clientes.id = ventas.id_cliente', 'left')
            ->find($id);

        if (!$venta) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Venta no encontrada');
        }

        // Obtener detalle de productos
        $detalle = $detalleModel
            ->select('detalle_venta.*, productos.nombre')
            ->join('productos', 'productos.id = detalle_venta.id_producto')
            ->where('id_venta', $id)
            ->findAll();

        // ======================
        // TCPDF
        // ======================
        $pdf = new \TCPDF();
        $pdf->SetCreator('Sistema de Ventas');
        $pdf->SetAuthor('Sistema');
        $pdf->SetTitle('Boleta de Venta');
        $pdf->SetMargins(15, 20, 15);
        $pdf->AddPage();

        // ======================
        // HTML
        // ======================
        $html = '<h2 style="text-align:center;">BOLETA DE VENTA</h2>';

        $html .= '<p>
                    <strong>Venta #:</strong> '.$venta['id'].'<br>
                    <strong>Fecha:</strong> '.$venta['fecha'].'<br>
                    <strong>Cliente:</strong> '.($venta['cliente'] ?? '—').'
                  </p>';

        $html .= '<table border="1" cellpadding="5">
                    <thead>
                        <tr style="background-color:#f2f2f2;">
                            <th>Producto</th>
                            <th>Cant.</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($detalle as $d) {
            $html .= '<tr>
                        <td>'.$d['nombre'].'</td>
                        <td>'.$d['cantidad'].'</td>
                        <td>'.number_format($d['precio_unitario'], 2).'</td>
                        <td>'.number_format($d['subtotal'], 2).'</td>
                      </tr>';
        }

        $html .= '</tbody></table>';

        $html .= '<h3 style="text-align:right;">
                    Total: S/ '.number_format($venta['total'], 2).'
                  </h3>';

        // Escribir PDF
        $pdf->writeHTML($html);
        $pdf->Output('venta_'.$venta['id'].'.pdf', 'I');
        exit;
    }
}