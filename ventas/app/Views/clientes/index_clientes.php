<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px 0;
        }
        .main-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 40px;
            max-width: 1100px; /* Ajustado para mejor visualización de la tabla */
            margin: 0 auto;
        }
        .page-header {
            border-bottom: 3px solid #ffc107;
            padding-bottom: 15px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .page-header h2 {
            color: #ffc107;
            margin: 0;
            font-weight: 600;
        }
        
        /* Estilos para DataTables con tu tema */
        .table-custom-style thead {
            background-color: #212529 !important;
            color: white !important;
        }
        
        /* Botones personalizados */
        .btn-custom-warning {
            background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            color: #000 !important;
            font-weight: 600;
            transition: transform 0.2s;
            text-decoration: none;
            display: inline-block;
        }
        .btn-custom-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
        }
        .btn-secondary-custom {
            background: #6c757d;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
        }
        .btn-danger-custom {
            background: #dc3545;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            text-decoration: none;
        }
        .icon-header {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: #000;
            font-size: 1.5rem;
        }
        
        /* Ajuste de buscador para que no se pegue a la tabla */
        .dataTables_wrapper .dataTables_filter { margin-bottom: 20px; }
    </style>
</head>
<body>

<div class="container">
    <div class="main-container">
        
        <div class="icon-header">
            <i class="fas fa-users"></i>
        </div>

        <div class="page-header">
            <h2><i class="fas fa-list-ul me-2"></i>Clientes</h2>
            <a href="<?= site_url('clientes/crear') ?>" class="btn-custom-warning">
                <i class="fas fa-plus-circle me-1"></i> Nuevo Cliente
            </a>
        </div>

        <div class="table-responsive">
            <table id="tablaClientes" class="table table-hover align-middle table-custom-style shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-3">ID</th>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>Dirección</th>
                        <th width="200" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($clientes)): ?>
                        <?php foreach ($clientes as $c): ?>
                            <tr>
                                <td class="ps-3"><strong>#<?= $c['id'] ?></strong></td>
                                <td><?= esc($c['nombre']) ?></td>
                                <td><span class="badge bg-light text-dark border"><?= esc($c['dni']) ?></span></td>
                                <td><?= esc($c['direccion']) ?></td>
                                <td class="text-center">
                                    <a href="<?= site_url('clientes/editar/'.$c['id']) ?>"
                                       class="btn-custom-warning btn-sm me-1">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <a href="<?= site_url('clientes/eliminar/'.$c['id']) ?>"
                                       class="btn-danger-custom btn-sm"
                                       onclick="return confirm('¿Está seguro de eliminar este cliente?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <a href="<?= site_url('dashboard') ?>" class="btn-secondary-custom">
                <i class="fas fa-arrow-left me-2"></i> Volver al Dashboard
            </a>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {
    $('#tablaClientes').DataTable({
        pageLength: 10,
        responsive: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        }
    });
});
</script>

</body>
</html>