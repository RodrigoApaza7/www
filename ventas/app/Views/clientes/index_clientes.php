<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>👥 Lista de Clientes</h2>
        <a href="<?= site_url('clientes/crear') ?>" class="btn btn-success">
            ➕ Nuevo Cliente
        </a>
    </div>

    <!-- TABLA -->
    <div class="card shadow-sm">
        <div class="card-body">

            <?php if (empty($clientes)): ?>
                <div class="alert alert-info">
                    No hay clientes registrados.
                </div>
            <?php else: ?>

            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>Dirección</th>
                        <th width="180">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $c): ?>
                        <tr>
                            <td><?= $c['id'] ?></td>
                            <td><?= esc($c['nombre']) ?></td>
                            <td><?= esc($c['dni']) ?></td>
                            <td><?= esc($c['direccion']) ?></td>
                            <td>
                                <a href="<?= site_url('clientes/editar/'.$c['id']) ?>"
                                   class="btn btn-warning btn-sm">
                                    ✏️ Editar
                                </a>

                                <a href="<?= site_url('clientes/eliminar/'.$c['id']) ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('¿Seguro de eliminar este cliente?')">
                                    🗑️ Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php endif; ?>

        </div>
    </div>

    <!-- VOLVER -->
    <div class="mt-3">
        <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary">
            ← Volver al Dashboard
        </a>
    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>