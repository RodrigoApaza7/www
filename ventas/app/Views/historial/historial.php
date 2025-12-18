<h2>📊 Historial de Ventas</h2>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Fecha</th>
        <th>Cliente</th>
        <th>Total</th>
        <th>Acción</th>
    </tr>

    <?php if (empty($ventas)): ?>
        <tr>
            <td colspan="5">No hay ventas registradas</td>
        </tr>
    <?php endif; ?>

    <?php foreach ($ventas as $v): ?>
        <tr>
            <td><?= $v['id'] ?></td>
            <td><?= $v['fecha'] ?></td>
            <td><?= esc($v['cliente'] ?? '—') ?></td>
            <td>S/ <?= number_format($v['total'], 2) ?></td>
            <td>
                <a href="<?= site_url('historial/' . $v['id']) ?>">
                    Ver detalle
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<hr>

<a href="<?= site_url('caja') ?>">← Volver a Caja</a>