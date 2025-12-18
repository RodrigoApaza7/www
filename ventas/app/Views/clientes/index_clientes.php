<h2>Clientes</h2>

<a href="<?= site_url('clientes/crear') ?>">Nuevo Cliente</a>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>DNI</th>
        <th>Dirección</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($clientes as $c): ?>
    <tr>
        <td><?= $c['id'] ?></td>
        <td><?= $c['nombre'] ?></td>
        <td><?= $c['dni'] ?></td>
        <td><?= $c['direccion'] ?></td>
        <td>
            <a href="<?= site_url('clientes/editar/'.$c['id']) ?>">Editar</a>
            <a href="<?= site_url('clientes/eliminar/'.$c['id']) ?>"
               onclick="return confirm('¿Eliminar cliente?')">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>