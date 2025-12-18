<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Categorías</title>
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
        .badge-estado-activo {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
        }
        .badge-estado-inactivo {
            background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="main-container">
            <div class="page-header">
                <h2><i class="fas fa-tags me-2"></i>Listado de Categorías</h2>
                <a href="<?= site_url('categorias/crear') ?>" class="btn-custom-primary">
                    <i class="fas fa-plus-circle me-2"></i>Nueva Categoría
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-custom table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width: 10%;"><i class="fas fa-hashtag me-2"></i>ID</th>
                            <th style="width: 40%;"><i class="fas fa-tag me-2"></i>Nombre</th>
                            <th style="width: 20%;" class="text-center"><i class="fas fa-toggle-on me-2"></i>Estado</th>
                            <th style="width: 30%;" class="text-center"><i class="fas fa-cog me-2"></i>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($categorias)): ?>
                        <tr>
                            <td colspan="4">
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <h5>No hay categorías registradas</h5>
                                    <p>Comienza creando tu primera categoría</p>
                                </div>
                            </td>
                        </tr>
                        <?php else: ?>
                            <?php foreach ($categorias as $c): ?>
                            <tr>
                                <td><strong><?= $c['id'] ?></strong></td>
                                <td><?= $c['nombre'] ?></td>
                                <td class="text-center">
                                    <?php if ($c['estado'] == 'activo' || $c['estado'] == 'Activo' || $c['estado'] == '1'): ?>
                                        <span class="badge badge-estado-activo">
                                            <i class="fas fa-check-circle me-1"></i>Activo
                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-estado-inactivo">
                                            <i class="fas fa-times-circle me-1"></i>Inactivo
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= site_url('categorias/editar/'.$c['id']) ?>" class="btn-action btn-edit">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </a>
                                    <a href="<?= site_url('categorias/eliminar/'.$c['id']) ?>" 
                                       class="btn-action btn-delete" 
                                       onclick="return confirm('¿Está seguro de eliminar esta categoría?')">
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