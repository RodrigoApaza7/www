<?php

namespace App\Controllers;

use App\Models\VentasModel;
use App\Models\ProductosModel;
use App\Models\ClientesModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $ventasModel = new VentasModel();
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

        // 🔹 Total de productos con stock > 0
        $productosStock = $productosModel
            ->where('stock >', 0)
            ->countAllResults();

        // 🔹 Total de clientes registrados
        $totalClientes = $clientesModel->countAll();

        return view('dashboard', [
            'totalHoy'       => $totalHoy['total'] ?? 0,
            'productosStock' => $productosStock,
            'totalClientes'  => $totalClientes
        ]);
    }
}