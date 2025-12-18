<h2>Nuevo Cliente</h2>

<form method="post" action="<?= site_url('clientes/guardar') ?>">
    <?= csrf_field() ?>
    
    <input type="text" name="nombre" placeholder="Nombre" required><br>
    <input type="text" name="dni" placeholder="DNI" required><br>
    <input type="text" name="direccion" placeholder="Dirección" required><br>

    <select name="categoria_id" required>
        <option value="" disabled selected>Seleccione categoría</option>
        <?php foreach ($categorias as $c): ?>
            <option value="<?= $c['id'] ?>">
                <?= esc($c['nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Guardar</button>
</form>