<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios - Profesional con Bootstrap</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
          crossorigin="anonymous">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
</head>
<body>

    <div class="container mt-5">

        <h2 class="mb-4 text-primary border-bottom pb-2">Listado de Usuarios</h2>

        <a href="<?= site_url('usuarios/crear') ?>" class="btn btn-primary mb-3 shadow-sm">
            <i class="fas fa-user-plus"></i> Nueva Persona
        </a>

        <div class="table-responsive">
            <table class="table table-striped table-hover shadow-lg">
                <thead class="table-dark"> <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $p): ?>
                    <tr>
                        <td><?= $p['id'] ?></td>
                        <td><?= $p['nombre'] ?></td>
                        <td><?= $p['usuario'] ?></td>
                        <td><?= str_repeat('*', strlen($p['password'])) ?></td>
                        <td class="text-nowrap"> <a href="<?= site_url('usuarios/editar/'.$p['id']) ?>" class="btn btn-sm btn-success me-2">
                                <i class="fas fa-edit"></i> Editar
                            </a>

                            <a href="<?= site_url('usuarios/eliminar/'.$p['id']) ?>" onclick="return confirm('¿Eliminar al usuario <?= $p['nombre'] ?>?')" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
            crossorigin="anonymous">
    </script>
</body>
</html>