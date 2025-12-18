<h2>📊 Historial de Ventas</h2>

<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <thead>
        <tr style="background-color:#f2f2f2;">
            <th>ID</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Total</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <?php if (empty($ventas)): ?>
            <tr>
                <td colspan="5" style="text-align:center;">
                    No hay ventas registradas
                </td>
            </tr>
        <?php endif; ?>

        <?php foreach ($ventas as $v): ?>
            <tr>
                <td><?= $v['id'] ?></td>
                <td><?= $v['fecha'] ?></td>
                <td><?= esc($v['cliente'] ?? '—') ?></td>
                <td>S/ <?= number_format($v['total'], 2) ?></td>
                <td>
                    <!-- VER DETALLE -->
                    <a href="<?= site_url('historial/' . $v['id']) ?>">
                        Ver
                    </a>

                    &nbsp;|&nbsp;

                    <!-- PDF DE LA VENTA -->
                    <a href="<?= site_url('reportes/ventas/pdf/' . $v['id']) ?>" target="_blank">
                        PDF
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<hr>

<a href="<?= site_url('caja') ?>">← Volver a Caja</a>