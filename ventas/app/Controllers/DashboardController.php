<?php

namespace App\Controllers;

use App\Models\VentasModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $ventasModel = new VentasModel();

        // =========================
        // TOTAL VENDIDO HOY
        // =========================
        $totalHoy = $ventasModel
            ->selectSum('total')
            ->where('DATE(fecha)', date('Y-m-d'))
            ->where('total >', 0)
            ->first();

        return view('dashboard', [
            'totalHoy' => $totalHoy['total'] ?? 0
        ]);
    }
}