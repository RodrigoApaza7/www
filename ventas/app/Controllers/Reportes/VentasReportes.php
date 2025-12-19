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
            ->select('ventas.*, clientes.nombre as cliente, clientes.dni')
            ->join('clientes', 'clientes.id = ventas.id_cliente', 'left')
            ->find($id);

        if ($venta['total'] <= 0) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Venta no finalizada');
        }

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
                    <strong>Cliente:</strong> '.($venta['cliente'] ?? '—').'<br>
                    <strong>DNI:</strong> '.($venta['dni'] ?? '—').'
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
    
    public function pdfGeneral()
    {
        $ventasModel = new \App\Models\VentasModel();

        // mismos filtros que la vista
        $desde     = $this->request->getGet('desde');
        $hasta     = $this->request->getGet('hasta');
        $clienteId = $this->request->getGet('cliente_id');

        $builder = $ventasModel
            ->select('ventas.*, clientes.nombre as cliente')
            ->join('clientes', 'clientes.id = ventas.id_cliente', 'left')
            ->where('ventas.total >', 0);

        if ($desde) {
            $builder->where('DATE(ventas.fecha) >=', $desde);
        }

        if ($hasta) {
            $builder->where('DATE(ventas.fecha) <=', $hasta);
        }

        if ($clienteId) {
            $builder->where('ventas.id_cliente', $clienteId);
        }

        $ventas = $builder
            ->orderBy('ventas.id', 'DESC')
            ->findAll();

        // ======================
        // TCPDF
        // ======================
        $pdf = new \TCPDF();
        $pdf->SetCreator('Sistema de Ventas');
        $pdf->SetAuthor('Sistema');
        $pdf->SetTitle('Reporte General de Ventas');
        $pdf->SetMargins(15, 20, 15);
        $pdf->AddPage();

        $html = '<h2 style="text-align:center;">REPORTE GENERAL DE VENTAS</h2>';

        if ($desde || $hasta) {
            $html .= '<p><strong>Periodo:</strong> '
                . ($desde ?: '—') . ' a ' . ($hasta ?: '—') . '</p>';
        }

        $html .= '<table border="1" cellpadding="5">
                    <thead>
                        <tr style="background-color:#f2f2f2;">
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>';

        $totalGeneral = 0;

        foreach ($ventas as $v) {
            $totalGeneral += $v['total'];

            $html .= '<tr>
                        <td>'.$v['id'].'</td>
                        <td>'.$v['fecha'].'</td>
                        <td>'.($v['cliente'] ?? '—').'</td>
                        <td>'.number_format($v['total'], 2).'</td>
                    </tr>';
        }

        $html .= '</tbody></table>';

        $html .= '<h3 style="text-align:right;">
                    TOTAL GENERAL: S/ '.number_format($totalGeneral, 2).'
                </h3>';

        $pdf->writeHTML($html);
        $pdf->Output('reporte_ventas.pdf', 'I');
        exit;
    }

        /**
     * EXPORTAR CSV
     */
    public function csv()
    {
        $ventasModel = new \App\Models\VentasModel();

        $ventas = $ventasModel
            ->select('ventas.id, ventas.fecha, clientes.nombre as cliente, ventas.total')
            ->join('clientes', 'clientes.id = ventas.id_cliente', 'left')
            ->where('ventas.total >', 0)
            ->orderBy('ventas.id', 'DESC')
            ->findAll();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="ventas.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Fecha', 'Cliente', 'Total']);

        foreach ($ventas as $v) {
            fputcsv($output, [
                $v['id'],
                $v['fecha'],
                $v['cliente'] ?? '—',
                $v['total']
            ]);
        }

        fclose($output);
        exit;
    }

    /**
     * EXPORTAR EXCEL (XLS)
     */
    public function excel()
    {
        $ventasModel = new \App\Models\VentasModel();

        $ventas = $ventasModel
            ->select('ventas.id, ventas.fecha, clientes.nombre as cliente, ventas.total')
            ->join('clientes', 'clientes.id = ventas.id_cliente', 'left')
            ->where('ventas.total >', 0)
            ->orderBy('ventas.id', 'DESC')
            ->findAll();

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=ventas.xls");

        echo "ID\tFecha\tCliente\tTotal\n";

        foreach ($ventas as $v) {
            echo $v['id'] . "\t";
            echo $v['fecha'] . "\t";
            echo ($v['cliente'] ?? '—') . "\t";
            echo $v['total'] . "\n";
        }
        exit;
    }

}