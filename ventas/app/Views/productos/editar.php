<h2>Editar Producto</h2>

<form method="post" action="<?= site_url('productos/actualizar/'.$producto['id']) ?>">
    <input type="text" name="nombre" value="<?= $producto['nombre'] ?>" required><br>
    <input type="number" step="0.01" name="precio" value="<?= $producto['precio'] ?>" required><br>
    <input type="number" name="stock" value="<?= $producto['stock'] ?>" required><br>

    <button type="submit">Actualizar</button>
</form>