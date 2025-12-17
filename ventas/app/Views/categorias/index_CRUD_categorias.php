<h2>Listado de Categorías</h2>

<a href="<?= site_url('categorias/crear') ?>">Nueva Categoría</a>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($categorias as $c): ?>
    <tr>
        <td><?= $c['id'] ?></td>
        <td><?= $c['nombre'] ?></td>
        <td><?= $c['estado'] ?></td>
        <td>
            <a href="<?= site_url('categorias/editar/'.$c['id']) ?>">Editar</a>
            |
            <a href="<?= site_url('categorias/eliminar/'.$c['id']) ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>