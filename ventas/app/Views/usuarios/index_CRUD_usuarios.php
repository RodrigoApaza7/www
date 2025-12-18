<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Clientes</title>
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
            border-bottom: 3px solid #0d6efd;
            padding-bottom: 15px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        .page-header h2 {
            color: #0d6efd;
            margin: 0;
            font-weight: 600;
        }
        .btn-custom-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            transition: transform 0.2s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-custom-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }
        .table-custom {
            background: white;
            border-radius: 10px;
            overflow: hidden;
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
        }
        .btn-edit {
            background-color: #ffc107;
            color: #000;
        }
        .btn-edit:hover {
            background-color: #ffb300;
            color: #000;
            transform: translateY(-2px);
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
        .btn-delete:hover {
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
        .dni-badge {
            background: #e7f3ff;
            padding: 4px 10px;
            border-radius: 6px;
            font-family: 'Courier New', monospace;
            font-weight: 600;
            color: #0d6efd;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="main-container">
            <div class="page-header">
                <h2><i class="fas fa-users me-2"></i>Listado de Clientes</h2>
                <a href="<?= site_url('clientes/crear') ?>" class="btn-custom-primary">
                    <i class="fas fa-user-plus me-2"></i>Nuevo Cliente
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-custom table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width: 8%;"><i class="fas fa-hashtag me-2"></i>ID</th>
                            <th style="width: 30%;"><i class="fas fa-user me-2"></i>Nombre</th>
                            <th style="width: 15%;"><i class="fas fa-id-card me-2"></i>DNI</th>
                            <th style="width: 30%;"><i class="fas fa-map-marker-alt me-2"></i>Dirección</th>
                            <th style="width: 17%;" class="text-center"><i class="fas fa-cog me-2"></i>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($clientes)): ?>
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="fas fa-user-slash"></i>
                                    <h5>No hay clientes registrados</h5>
                                    <p>Comienza agregando tu primer cliente</p>
                                </div>
                            </td>
                        </tr>
                        <?php else: ?>
                            <?php foreach ($clientes as $c): ?>
                            <tr>
                                <td><strong><?= $c['id'] ?></strong></td>
                                <td>
                                    <i class="fas fa-user-circle text-primary me-2"></i>
                                    <?= $c['nombre'] ?>
                                </td>
                                <td>
                                    <span class="dni-badge"><?= $c['dni'] ?></span>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <i class="fas fa-location-dot me-1"></i>
                                        <?= $c['direccion'] ?>
                                    </small>
                                </td>
                                <td class="text-center">
                                    <a href="<?= site_url('clientes/editar/'.$c['id']) ?>" 
                                       class="btn-action btn-edit"
                                       title="Editar cliente">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </a>
                                    <a href="<?= site_url('clientes/eliminar/'.$c['id']) ?>" 
                                       class="btn-action btn-delete"
                                       onclick="return confirm('¿Está seguro de eliminar este cliente?')"
                                       title="Eliminar cliente">
                                        <i class="fas fa-trash-alt me-1"></i>Eliminar
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>