<h2>Nueva Categoría</h2>

<form method="post" action="<?= site_url('categorias/guardar') ?>">
    <input type="text" name="nombre" placeholder="Nombre" required><br>

    <select name="estado">
        <option value="1">Activa</option>
        <option value="0">Inactiva</option>
    </select><br>

    <button type="submit">Guardar</button>
</form>