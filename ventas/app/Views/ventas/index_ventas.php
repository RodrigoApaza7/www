<h2>Punto de Venta</h2>

<h3>Venta #<?= $venta_id ?></h3>

<form action="<?= site_url('ventas/agregar-producto') ?>" method="post">
    <label>ID Producto</label>
    <input type="number" name="id_producto" required>

    <label>Cantidad</label>
    <input type="number" name="cantidad" value="1" min="1" required>

    <button type="submit">Agregar</button>
</form>

<hr>

<table border="1" cellpadding="5">
    <tr>
        <th>Producto</th>
        <th>Cant.</th>
        <th>Precio</th>
        <th>Subtotal</th>
    </tr>

    <?php foreach ($detalle as $d): ?>
        <tr>
            <td><?= esc($d['nombre']) ?></td>
            <td><?= $d['cantidad'] ?></td>
            <td><?= number_format($d['precio_unitario'], 2) ?></td>
            <td><?= number_format($d['subtotal'], 2) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h3>Total: S/ <?= number_format($total, 2) ?></h3>

<form action="<?= site_url('ventas/finalizar') ?>" method="post">
    <button type="submit">Finalizar Venta</button>
</form>