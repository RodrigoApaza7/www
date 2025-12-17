<?php

namespace App\Controllers\Reportes;

use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\CategoriasModel;

class ProductosReportes extends BaseController
{
    //Vista principal del reporte
    public function index()
    {
        dd(session()->get());


        $categoriasModel = new CategoriasModel();

        $data['categorias'] = $categoriasModel
            ->where('estado', 1)
            ->findAll();

        return view('reportes/productos_reportes', $data);
    }

    //AJAX: filtrar productos
    public function filtrar()
    {
        $categoriaId = $this->request->getGet('categoria');

        $model = new ProductosModel();

        $model
            ->select('productos.*, categorias.nombre AS categoria')
            ->join('categorias', 'categorias.id = productos.categoria_id', 'left');

        if ($categoriaId && $categoriaId !== 'todos') {
            $model->where('productos.categoria_id', $categoriaId);
        }

        $productos = $model->findAll();

        return $this->response->setJSON($productos);
    }

    //PDF de productos
    public function pdf()
    {
        $categoriaId = $this->request->getGet('categoria');

        $model = new ProductosModel();

        $model
            ->select('productos.*, categorias.nombre AS categoria')
            ->join('categorias', 'categorias.id = productos.categoria_id', 'left');

        if ($categoriaId && $categoriaId !== 'todos') {
            $model->where('productos.categoria_id', $categoriaId);
        }

        $productos = $model->findAll();

        // TCPDF
        $pdf = new \TCPDF();
        $pdf->SetCreator('Sistema de Ventas');
        $pdf->SetAuthor('Sistema');
        $pdf->SetTitle('Reporte de Productos');
        $pdf->SetMargins(15, 20, 15);
        $pdf->AddPage();

        $html = '<h2>Reporte de Productos</h2>';
        $html .= '<table border="1" cellpadding="5">
            <thead>
                <tr style="background-color:#f2f2f2;">
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($productos as $p) {
            $html .= "<tr>
                <td>{$p['id']}</td>
                <td>{$p['nombre']}</td>
                <td>{$p['categoria']}</td>
                <td>{$p['precio']}</td>
                <td>{$p['stock']}</td>
            </tr>";
        }

        $html .= '</tbody></table>';

        $pdf->writeHTML($html);
        $pdf->Output('reporte_productos.pdf', 'I');
        exit;
    }
}