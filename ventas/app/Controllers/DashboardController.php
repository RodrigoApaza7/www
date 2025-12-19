<?php

namespace App\Controllers;

use App\Models\VentasModel;
use App\Models\ProductosModel;
use App\Models\ClientesModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $ventasModel    = new VentasModel();
        $productosModel = new ProductosModel();
        $clientesModel  = new ClientesModel();

        // =========================
        // TOTAL VENDIDO HOY
        // =========================
        $totalHoy = $ventasModel
            ->selectSum('total')
            ->where('DATE(fecha)', date('Y-m-d'))
            ->where('total >', 0)
            ->first();

        // =========================
        // PRODUCTOS EN STOCK
        // =========================
        $productosStock = $productosModel
            ->where('stock >', 0)
            ->countAllResults();

        // =========================
        // CLIENTES REGISTRADOS
        // =========================
        $totalClientes = $clientesModel->countAll();

        // =========================
        // VENTAS ÚLTIMOS 7 DÍAS (Chart.js)
        // =========================
        $ventasPorDia = $ventasModel
            ->select("DATE(fecha) as dia, SUM(total) as total")
            ->where('total >', 0)
            ->where('fecha >=', date('Y-m-d', strtotime('-6 days')))
            ->groupBy('DATE(fecha)')
            ->orderBy('dia', 'ASC')
            ->findAll();

        $labels = [];
        $data   = [];

        foreach ($ventasPorDia as $v) {
            $labels[] = $v['dia'];
            $data[]   = (float) $v['total'];
        }

        return view('dashboard', [
            // cards
            'totalHoy'       => $totalHoy['total'] ?? 0,
            'productosStock' => $productosStock,
            'totalClientes'  => $totalClientes,

            // chart
            'ventasLabels' => json_encode($labels),
            'ventasData'   => json_encode($data),
        ]);
    }
}