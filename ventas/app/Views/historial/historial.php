<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Ventas</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px 0;
        }
        .main-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 30px;
        }
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 30px;
        }
        .page-header h2 {
            margin: 0;
            font-weight: 700;
        }
        .filter-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            border: 2px solid #e9ecef;
        }
        .filter-section h5 {
            color: #667eea;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            font-size: 0.875rem;
            text-transform: uppercase;
        }
        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-filter {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: transform 0.2s;
        }
        .btn-filter:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .btn-clear {
            background: #6c757d;
            border: none;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: transform 0.2s;
        }
        .btn-clear:hover {
            background: #5a6268;
            color: white;
            transform: translateY(-2px);
        }
        .btn-pdf-general {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: transform 0.2s;
            margin-bottom: 20px;
        }
        .btn-pdf-general:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(245, 87, 108, 0.4);
        }
        .table-custom {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .table-custom thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .table-custom tbody tr {
            transition: background-color 0.2s;
        }
        .table-custom tbody tr:hover {
            background-color: #f8f9fa;
        }
        .btn-action {
            padding: 5px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.875rem;
            transition: transform 0.2s;
            display: inline-block;
            margin: 0 2px;
            font-weight: 500;
        }
        .btn-view {
            background-color: #0d6efd;
            color: white;
        }
        .btn-view:hover {
            background-color: #0b5ed7;
            color: white;
            transform: translateY(-2px);
        }
        .btn-pdf {
            background-color: #dc3545;
            color: white;
        }
        .btn-pdf:hover {
            background-color: #c82333;
            color: white;
            transform: translateY(-2px);
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }
        .btn-back {
            background: #6c757d;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            transition: transform 0.2s;
        }
        .btn-back:hover {
            background: #5a6268;
            color: white;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="main-container">
            <div class="page-header">
                <h2><i class="fas fa-chart-line me-2"></i>Historial de Ventas</h2>
            </div>

            <!-- FILTROS -->
            <div class="filter-section">
                <h5><i class="fas fa-filter me-2"></i>Filtros de Búsqueda</h5>
                <form method="get" action="<?= site_url('historial/filtrar') ?>">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="desde" class="form-label">
                                <i class="fas fa-calendar-alt me-2"></i>Desde
                            </label>
                            <input type="date" 
                                   class="form-control" 
                                   id="desde" 
                                   name="desde"
                                   value="<?= esc($filtros['desde'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="hasta" class="form-label">
                                <i class="fas fa-calendar-check me-2"></i>Hasta
                            </label>
                            <input type="date" 
                                   class="form-control" 
                                   id="hasta" 
                                   name="hasta"
                                   value="<?= esc($filtros['hasta'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="cliente_id" class="form-label">
                                <i class="fas fa-user me-2"></i>Cliente
                            </label>
                            <select class="form-select" id="cliente_id" name="cliente_id">
                                <option value="">Todos los clientes</option>
                                <?php if (!empty($clientes)): ?>
                                    <?php foreach ($clientes as $c): ?>
                                        <option value="<?= $c['id'] ?>"
                                            <?= (!empty($filtros['clienteId']) && $filtros['clienteId'] == $c['id']) ? 'selected' : '' ?>>
                                            <?= esc($c['nombre']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end gap-2">
                            <button type="submit" class="btn-filter flex-fill">
                                <i class="fas fa-search me-2"></i>Filtrar
                            </button>
                            <a href="<?= site_url('historial') ?>" class="btn-clear">
                                <i class="fas fa-eraser me-2"></i>Limpiar
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- BOTÓN PDF GENERAL -->
            <div class="mb-3">
                <a href="<?= site_url('historial/pdf?' . http_build_query($_GET)) ?>"
                   target="_blank"
                   class="btn-pdf-general">
                    <i class="fas fa-file-pdf me-2"></i>Generar PDF del Historial
                </a>
            </div>

            <!-- TABLA DE RESULTADOS -->
            <div class="table-responsive">
                <table class="table table-custom table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width: 8%;"><i class="fas fa-hashtag me-2"></i>ID</th>
                            <th style="width: 20%;"><i class="fas fa-calendar me-2"></i>Fecha</th>
                            <th style="width: 30%;"><i class="fas fa-user me-2"></i>Cliente</th>
                            <th style="width: 20%;" class="text-end"><i class="fas fa-money-bill-wave me-2"></i>Total</th>
                            <th style="width: 22%;" class="text-center"><i class="fas fa-cog me-2"></i>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($ventas)): ?>
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="fas fa-inbox"></i>
                                        <h5>No se encontraron resultados</h5>
                                        <p>Intenta ajustar los filtros de búsqueda</p>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($ventas as $v): ?>
                                <tr>
                                    <td><strong><?= $v['id'] ?></strong></td>
                                    <td><?= $v['fecha'] ?></td>
                                    <td><?= esc($v['cliente'] ?? 'No especificado') ?></td>
                                    <td class="text-end fw-bold">S/ <?= number_format($v['total'], 2) ?></td>
                                    <td class="text-center">
                                        <a href="<?= site_url('historial/' . $v['id']) ?>" 
                                           class="btn-action btn-view"
                                           title="Ver detalle">
                                            <i class="fas fa-eye me-1"></i>Ver
                                        </a>
                                        <a href="<?= site_url('reportes/ventas/pdf/' . $v['id']) ?>"
                                           target="_blank"
                                           class="btn-action btn-pdf"
                                           title="Descargar PDF">
                                            <i class="fas fa-file-pdf me-1"></i>PDF
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <a href="<?= site_url('caja') ?>" class="btn-back">
                    <i class="fas fa-arrow-left me-2"></i>Volver a Caja
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>