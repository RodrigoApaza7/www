<?php

namespace App\Controllers\Reportes;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;

class UsuariosReportes extends BaseController
{

    public function index()
    {
        return view('reportes/usuarios_reportes');
    }

    public function filtrar()
    {
        $rol = $this->request->getGet('rol');

        $model = new UsuariosModel();

        if ($rol && $rol !== 'todos') {
            $usuarios = $model->where('rol', $rol)->findAll();
        } else {
            $usuarios = $model->findAll();
        }

        return $this->response->setJSON($usuarios);
    }

    public function pdf()
    {

        $rol = $this->request->getGet('rol');

        $model = new \App\Models\UsuariosModel();

        // 🔹 FILTRO CORRECTO
        if ($rol && $rol !== 'todos') {
            $usuarios = $model->where('rol', $rol)->findAll();
        } else {
            $usuarios = $model->findAll();
        }

        // TCPDF
        $pdf = new \TCPDF();
        $pdf->SetCreator('Sistema de Ventas');
        $pdf->SetAuthor('Administrador');
        $pdf->SetTitle('Reporte de Usuarios');
        $pdf->SetMargins(15, 20, 15);
        $pdf->AddPage();

        $html = '<h2>Reporte de Usuarios</h2>';
        $html .= '<table border="1" cellpadding="5">
            <thead>
                <tr style="background-color:#f2f2f2;">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($usuarios as $u) {
            $html .= "<tr>
                <td>{$u['id']}</td>
                <td>{$u['nombre']}</td>
                <td>{$u['usuario']}</td>
                <td>{$u['rol']}</td>
            </tr>";
        }

        $html .= '</tbody></table>';

        $pdf->writeHTML($html);
        $pdf->Output('reporte_usuarios.pdf', 'I');
        exit;
    }
}