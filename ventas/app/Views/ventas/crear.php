<h2>Nueva Venta</h2>

<form action="<?= site_url('ventas/guardar') ?>" method="post">

    <label>Cliente</label>
    <select name="id_cliente" required>
        <option value="">Seleccione</option>
        <?php foreach ($clientes as $c): ?>
            <option value="<?= $c['id'] ?>">
                <?= esc($c['nombre']) ?> - <?= esc($c['dni']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <br><br>

    <button type="submit">Iniciar venta</button>

</form>