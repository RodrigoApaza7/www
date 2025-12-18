<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Clientes</h2>
        <a href="<?= site_url('clientes/crear') ?>" class="btn btn-primary">
            + Nuevo Cliente
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Dirección</th>
                <th width="160">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($clientes)): ?>
                <tr>
                    <td colspan="5" class="text-center">
                        No hay clientes registrados
                    </td>
                </tr>
            <?php endif; ?>

            <?php foreach ($clientes as $c): ?>
                <tr>
                    <td><?= $c['id'] ?></td>
                    <td><?= esc($c['nombre']) ?></td>
                    <td><?= esc($c['dni']) ?></td>
                    <td><?= esc($c['direccion']) ?></td>
                    <td>
                        <a href="<?= site_url('clientes/editar/'.$c['id']) ?>"
                           class="btn btn-sm btn-warning">
                            Editar
                        </a>

                        <a href="<?= site_url('clientes/eliminar/'.$c['id']) ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('¿Eliminar cliente?')">
                            Eliminar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary">
        ← Volver al Dashboard
    </a>

</div>

</body>
</html>