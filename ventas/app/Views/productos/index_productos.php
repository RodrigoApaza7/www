<h2>Productos</h2>

<a href="<?= site_url('productos/crear') ?>">Nuevo Producto</a>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Acciones</th>
        <th>Categoría</th>
    </tr>

    <?php foreach ($productos as $p): ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['nombre'] ?></td>
        <td><?= esc($p['categoria']) ?></td>
        <td>S/ <?= $p['precio'] ?></td>
        <td><?= $p['stock'] ?></td>
        <td>
            <a href="<?= site_url('productos/editar/'.$p['id']) ?>">Editar</a>
            <a href="<?= site_url('productos/eliminar/'.$p['id']) ?>"
               onclick="return confirm('¿Eliminar producto?')">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>