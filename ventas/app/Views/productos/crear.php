<h2>Nuevo Producto</h2>

<form method="post" action="<?= site_url('productos/guardar') ?>">
    <input type="text" name="nombre" placeholder="Nombre" required><br>
    <input type="number" step="0.01" name="precio" placeholder="Precio" required><br>
    <input type="number" name="stock" placeholder="Stock" required><br>

    <button type="submit">Guardar</button>
</form>