<h2>🧾 Detalle de Venta #<?= $venta['id'] ?></h2>

<p><strong>Fecha:</strong> <?= $venta['fecha'] ?></p>
<p><strong>Cliente:</strong> <?= esc($venta['cliente'] ?? '—') ?></p>
<p><strong>Total:</strong> S/ <?= number_format($venta['total'], 2) ?></p>

<hr>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio Unitario</th>
        <th>Subtotal</th>
    </tr>

    <?php foreach ($detalle as $d): ?>
        <tr>
            <td><?= esc($d['nombre']) ?></td>
            <td><?= $d['cantidad'] ?></td>
            <td>S/ <?= number_format($d['precio_unitario'], 2) ?></td>
            <td>S/ <?= number_format($d['subtotal'], 2) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<hr>

<a href="<?= site_url('historial') ?>">← Volver al Historial</a>
