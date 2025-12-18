<h2>📊 Historial de Ventas</h2>

<!-- =========================
     FILTROS (GET)
========================= -->
<form method="get" action="<?= site_url('historial/filtrar') ?>">
    <label>Desde:</label>
    <input type="date" name="desde"
           value="<?= esc($filtros['desde'] ?? '') ?>">

    <label>Hasta:</label>
    <input type="date" name="hasta"
           value="<?= esc($filtros['hasta'] ?? '') ?>">

    <label>Cliente:</label>
    <select name="cliente_id">
        <option value="">Todos</option>
        <?php foreach ($clientes as $c): ?>
            <option value="<?= $c['id'] ?>"
                <?= (!empty($filtros['clienteId']) && $filtros['clienteId'] == $c['id']) ? 'selected' : '' ?>>
                <?= esc($c['nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Filtrar</button>
    <a href="<?= site_url('historial') ?>">Limpiar</a>
</form>

<hr>

<!-- =========================
     TABLA DE RESULTADOS
========================= -->
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
                    Sin resultados
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
                    <a href="<?= site_url('historial/' . $v['id']) ?>">Ver</a>
                    &nbsp;|&nbsp;
                    <a href="<?= site_url('reportes/ventas/pdf/' . $v['id']) ?>"
                       target="_blank">PDF</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<hr>

<a href="<?= site_url('caja') ?>">← Volver a Caja</a>