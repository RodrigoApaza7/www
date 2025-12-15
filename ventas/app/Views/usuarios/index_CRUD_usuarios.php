<h2>Listado de usuarios$usuarios</h2>

<a href="<?= site_url('usuarios$usuarios/crear') ?>">Nueva Persona</a>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Usuario</th>
        <th>Contraseña</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($usuarios as $p): ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['nombre'] ?></td>
        <td><?= $p['usuario'] ?></td>
        <td><?= $p['password'] ?></td>
        <td>
            <a href="<?= site_url('usuarios/editar/'.$p['id']) ?>">Editar</a>
            |
            <a href="<?= site_url('usuarios/eliminar/'.$p['id']) ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>