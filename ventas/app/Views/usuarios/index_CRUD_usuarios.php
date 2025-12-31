<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
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
            background: linear-gradient(135deg, #4e54c8 0%, #8f94fb 100%);
            color: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 30px;
        }
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        .page-header h2 {
            margin: 0;
            font-weight: 700;
        }
        /* Botón Dashboard */
        .btn-dashboard {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.4);
            padding: 8px 15px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        .btn-dashboard:hover {
            background: white;
            color: #4e54c8;
            transform: translateX(-3px);
        }
        .btn-add-user {
            background: white;
            color: #4e54c8;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
        }
        .btn-add-user:hover {
            background: #f8f9fa;
            color: #3a40b0;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }
        /* Estilos de tabla */
        .table-custom {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            background: white;
        }
        .table-custom thead {
            background-color: #f1f3f9;
        }
        .table-custom thead th {
            border-bottom: 2px solid #dee2e6;
            color: #495057;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 15px;
        }
        .table-custom tbody td {
            padding: 15px;
            vertical-align: middle;
            color: #495057;
        }
        .user-badge {
            background-color: #e9ecef;
            padding: 5px 10px;
            border-radius: 6px;
            font-family: monospace;
            color: #333;
        }
        .btn-action {
            padding: 6px 12px;
            border-radius: 6px;
            transition: all 0.2s;
            font-weight: 500;
        }
        .btn-edit-user {
            background-color: #d1e7dd;
            color: #0f5132;
            border: none;
        }
        .btn-edit-user:hover {
            background-color: #badbcc;
            transform: scale(1.05);
        }
        .btn-delete-user {
            background-color: #f8d7da;
            color: #842029;
            border: none;
        }
        .btn-delete-user:hover {
            background-color: #f5c2c7;
            transform: scale(1.05);
        }
        .btn-back-bottom {
            background-color: #6c757d;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }
        .btn-back-bottom:hover {
            background-color: #5a6268;
            color: white;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="main-container">
            
            <div class="page-header">
                <div class="mb-3">
                    <a href="<?= site_url('dashboard') ?>" class="btn-dashboard">
                        <i class="fas fa-th-large me-2"></i> Volver al Dashboard
                    </a>
                </div>
                <div class="header-content">
                    <h2><i class="fas fa-users-cog me-2"></i>Listado de Usuarios</h2>
                    <a href="<?= site_url('usuarios/crear') ?>" class="btn-add-user">
                        <i class="fas fa-plus-circle me-1"></i> Nueva Persona
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle table-custom">
                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 25%;">Nombre Completo</th>
                            <th style="width: 15%;">Usuario</th>
                            <th style="width: 15%;">Hobbie</th> <th style="width: 15%;">Contraseña</th>
                            <th style="width: 25%; text-align: center;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($usuarios)): ?>
                            <?php foreach ($usuarios as $p): ?>
                            <tr>
                                <td><span class="text-muted fw-bold">#<?= $p['id'] ?></span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-light d-flex justify-content-center align-items-center me-3" style="width: 40px; height: 40px; color: #4e54c8;">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <span class="fw-semibold"><?= $p['nombre'] ?></span>
                                    </div>
                                </td>
                                <td>
                                    <span class="user-badge"><i class="fas fa-at me-1"></i><?= $p['usuario'] ?></span>
                                </td>
                                <td>
                                    <span><?= !empty($p['hobbie']) ? esc($p['hobbie']) : '---' ?></span>
                                </td>
                                <td>
                                    <span class="text-muted small">
                                        <i class="fas fa-lock me-1"></i><?= str_repeat('•', 8) ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="<?= site_url('usuarios/editar/'.$p['id']) ?>" 
                                           class="btn-action btn-edit-user text-decoration-none" 
                                           title="Editar usuario">
                                            <i class="fas fa-edit me-1"></i> Editar
                                        </a>

                                        <a href="<?= site_url('usuarios/eliminar/'.$p['id']) ?>" 
                                           onclick="return confirm('¿Está seguro de eliminar al usuario <?= $p['nombre'] ?>?')" 
                                           class="btn-action btn-delete-user text-decoration-none"
                                           title="Eliminar usuario">
                                            <i class="fas fa-trash-alt me-1"></i> Eliminar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <?php if (empty($usuarios)): ?>
                <div class="text-center py-5">
                    <i class="fas fa-user-slash fa-3x text-light mb-3"></i>
                    <p class="text-muted">No hay usuarios registrados en el sistema.</p>
                </div>
            <?php endif; ?>

            <div class="mt-4 border-top pt-3">
                <a href="<?= site_url('dashboard') ?>" class="btn-back-bottom">
                    <i class="fas fa-arrow-left me-2"></i> Regresar al Inicio
                </a>
            </div>

        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>