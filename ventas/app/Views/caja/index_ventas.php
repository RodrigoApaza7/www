<h3>Cliente</h3>

<input type="text" id="dni" placeholder="DNI">
<button onclick="buscarCliente()">Buscar</button>

<div id="cliente-info"></div>

<div id="cliente-nuevo" style="display:none;">
    <input type="text" id="nombre" placeholder="Nombre">
    <input type="text" id="direccion" placeholder="Dirección">
    <button onclick="crearCliente()">Crear cliente</button>
</div>


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

<script>
function buscarCliente() {
    const dni = document.getElementById('dni').value;
    const data = new FormData();
    data.append('dni', dni);

    fetch('caja/buscar-cliente', {
        method: 'POST',
        body: data
    })
    .then(r => r.json())
    .then(res => {
        if (res.existe) {
            document.getElementById('cliente-info').innerHTML =
                'Cliente: ' + res.cliente.nombre;
            document.getElementById('cliente-nuevo').style.display = 'none';
        } else {
            document.getElementById('cliente-nuevo').style.display = 'block';
        }
    });
}

function crearCliente() {
    const data = new FormData();
    data.append('dni', document.getElementById('dni').value);
    data.append('nombre', document.getElementById('nombre').value);
    data.append('direccion', document.getElementById('direccion').value);

    fetch('caja/crear-cliente', {
        method: 'POST',
        body: data
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            document.getElementById('cliente-info').innerHTML =
                'Cliente creado correctamente';
            document.getElementById('cliente-nuevo').style.display = 'none';
        }
    });
}
</script>