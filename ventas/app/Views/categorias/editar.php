<h2>Editar Categoría</h2>

<form method="post" action="<?= site_url('categorias/actualizar/'.$categoria['id']) ?>">
    <input type="text" name="nombre" value="<?= esc($categoria['nombre']) ?>" required><br>

    <select name="estado" required>
        <option value="1" <?= $categoria['estado'] == 1 ? 'selected' : '' ?>>
            Activa
        </option>
        <option value="0" <?= $categoria['estado'] == 0 ? 'selected' : '' ?>>
            Inactiva
        </option>
    </select><br>

    <button type="submit">Actualizar</button>
</form>