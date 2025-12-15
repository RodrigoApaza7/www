<h2>Listado de Personas</h2>

<a href="<?= site_url('personas/crear') ?>">Nueva Persona</a>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Paterno</th>
        <th>Materno</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($personas as $p): ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['nombre'] ?></td>
        <td><?= $p['paterno'] ?></td>
        <td><?= $p['materno'] ?></td>
        <td>
            <a href="<?= site_url('usuarios/editar/'.$p['id']) ?>">Editar</a>
            |
            <a href="<?= site_url('usuarios/eliminar/'.$p['id']) ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>