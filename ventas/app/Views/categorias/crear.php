<h2>Nueva Categoría</h2>

<form method="post" action="<?= site_url('categorias/guardar') ?>">
    <input type="text" name="nombre" placeholder="Nombre" required><br>
    <input type="text" name="estado" placeholder="Estado"><br>

    <button type="submit">Guardar</button>
</form>