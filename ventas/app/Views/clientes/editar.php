<h2>Editar Cliente</h2>

<form method="post" action="<?= site_url('clientes/actualizar/'.$cliente['id']) ?>">
    <input type="text" name="nombre" value="<?= $cliente['nombre'] ?>" required><br>
    <input type="text" name="dni" value="<?= $cliente['dni'] ?>" required><br>
    <input type="text" name="direccion" value="<?= $cliente['direccion'] ?>" required><br>

    <select name="categoria_id" required>
        <?php foreach ($categorias as $c): ?>
            <option value="<?= $c['id'] ?>"
                <?= $cliente['categoria_id'] == $c['id'] ? 'selected' : '' ?>>
                <?= esc($c['nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Actualizar</button>
</form>