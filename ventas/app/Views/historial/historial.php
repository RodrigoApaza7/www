<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Ventas</title>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <style>
        body { background-color: #f8f9fa; padding: 20px 0; }
        .main-container { background: white; border-radius: 15px; box-shadow: 0 0 20px rgba(0,0,0,0.1); padding: 30px; }
        .page-header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 25px; border-radius: 12px; margin-bottom: 30px; }
        .page-header h2 { margin: 0; font-weight: 700; }
        
        /* Estilos de los botones de DataTables para que combinen con tu diseño */
        .dt-buttons { margin-bottom: 15px; }
        button.dt-button, div.dt-button, a.dt-button {
            background: #667eea !important;
            color: white !important;
            border-radius: 8px !important;
            border: none !important;
            font-weight: 600 !important;
            padding: 8px 15px !important;
        }
        button.dt-button:hover { background: #764ba2 !important; }

        .filter-section { background: #f8f9fa; padding: 25px; border-radius: 12px; margin-bottom: 25px; border: 2px solid #e9ecef; }
        .form-label { font-weight: 600; color: #495057; text-transform: uppercase; font-size: 0.875rem; }
        
        .table-custom thead th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: white !important;
            padding: 15px !important;
        }
        .btn-action { padding: 5px 12px; border-radius: 5px; text-decoration: none; font-size: 0.875rem; font-weight: 500; }
        .btn-view { background-color: #0d6efd; color: white; }
        .btn-pdf { background-color: #dc3545; color: white; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="main-container">
            <div class="page-header">
                <h2><i class="fas fa-chart-line me-2"></i>Historial de Ventas</h2>
            </div>

            <div class="filter-section">
                <h5><i class="fas fa-filter me-2"></i>Filtros de Búsqueda</h5>
                <form method="get" action="<?= site_url('historial/filtrar') ?>">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Desde</label>
                            <input type="date" class="form-control" name="desde" value="<?= esc($filtros['desde'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Hasta</label>
                            <input type="date" class="form-control" name="hasta" value="<?= esc($filtros['hasta'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Cliente</label>
                            <select class="form-select" name="cliente_id">
                                <option value="">Todos los clientes</option>
                                <?php foreach ($clientes as $c): ?>
                                    <option value="<?= $c['id'] ?>"><?= esc($c['nombre']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end gap-2">
                            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table id="tablaVentas" class="table table-custom table-hover align-middle display shadow-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th class="text-end">Total</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ventas as $v): ?>
                            <tr>
                                <td><strong><?= $v['id'] ?></strong></td>
                                <td><?= $v['fecha'] ?></td>
                                <td><?= esc($v['cliente'] ?? 'No especificado') ?></td>
                                <td class="text-end fw-bold">S/ <?= number_format($v['total'], 2) ?></td>
                                <td class="text-center">
                                    <a href="<?= site_url('historial/' . $v['id']) ?>" class="btn-action btn-view">Ver</a>
                                    <a href="<?= site_url('reportes/ventas/pdf/' . $v['id']) ?>" class="btn-action btn-pdf">PDF</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tablaVentas').DataTable({
                // dom: 'Bfrtip' -> B: Botones, f: Filtro, r: Procesando, t: Tabla, i: Info, p: Paginación
                dom: '<"d-flex justify-content-between"fB>rtip', 
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        title: 'Historial de Ventas',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i> Exportar PDF',
                        title: 'Historial de Ventas',
                        className: 'btn btn-danger'
                    }
                ],
                pageLength: 10,
                order: [[0, 'desc']],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                }
            });
        });
    </script>
</body>
</html>