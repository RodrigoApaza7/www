<!-- ========================= -->
<!-- BLOQUE CLIENTE (AJAX) -->
<!-- ========================= -->

<h3>Cliente</h3>

<!-- DNI del cliente -->
<input type="text" id="dni" placeholder="DNI">

<!-- Buscar cliente por DNI -->
<button type="button" onclick="buscarCliente()">Buscar</button>

<!-- Aquí se mostrará el cliente encontrado -->
<div id="cliente-info"></div>

<!-- Formulario para crear cliente (oculto al inicio) -->
<div id="cliente-nuevo" style="display:none;">
    <input type="text" id="nombre" placeholder="Nombre">
    <input type="text" id="direccion" placeholder="Dirección">
    <button type="button" onclick="crearCliente()">Crear cliente</button>
</div>

<hr>

<!-- ========================= -->
<!-- BLOQUE PUNTO DE VENTA -->
<!-- ========================= -->

<h2>Punto de Venta</h2>

<!-- ID de la venta actual -->
<h3>Venta #<?= $venta_id ?></h3>

<!-- ========================= -->
<!-- AGREGAR PRODUCTO (AJAX) -->
<!-- ========================= -->

<label>ID Producto</label>
<input type="number" id="id_producto" placeholder="ID producto">

<label>Cantidad</label>
<input type="number" id="cantidad" value="1" min="1">

<button type="button" onclick="agregarProducto()">Agregar</button>

<hr>

<!-- ========================= -->
<!-- TABLA DE PRODUCTOS -->
<!-- ========================= -->

<table border="1" cellpadding="5" id="tabla-productos">
    <tr>
        <th>Producto</th>
        <th>Cant.</th>
        <th>Precio</th>
        <th>Subtotal</th>
    </tr>

    <!-- Productos ya existentes (si recargas la página) -->
    <?php foreach ($detalle as $d): ?>
        <tr>
            <td><?= esc($d['nombre']) ?></td>
            <td><?= $d['cantidad'] ?></td>
            <td><?= number_format($d['precio_unitario'], 2) ?></td>
            <td><?= number_format($d['subtotal'], 2) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<!-- ========================= -->
<!-- TOTAL -->
<!-- ========================= -->

<h3 id="total">Total: S/ <?= number_format($total, 2) ?></h3>

<!-- ========================= -->
<!-- FINALIZAR VENTA -->
<!-- ========================= -->

<button type="button" onclick="finalizarVenta()">Finalizar Venta</button>

<hr>

<!-- ========================= -->
<!-- JAVASCRIPT -->
<!-- ========================= -->

<script>
/* =========================
   VARIABLES GLOBALES
========================= */
let total = <?= $total ?>;

/* =========================
   BUSCAR CLIENTE (AJAX)
========================= */
function buscarCliente() {
    const dni = document.getElementById('dni').value;

    const data = new FormData();
    data.append('dni', dni);

    fetch('<?= site_url('caja/buscar-cliente') ?>', {
        method: 'POST',
        body: data
    })
    .then(res => res.json())
    .then(data => {
        if (data.existe) {
            // Cliente encontrado
            document.getElementById('cliente-info').innerHTML =
                '<strong>Cliente:</strong> ' + data.cliente.nombre;

            document.getElementById('cliente-nuevo').style.display = 'none';
        } else {
            // Cliente no existe → mostrar formulario
            document.getElementById('cliente-info').innerHTML =
                'Cliente no encontrado';

            document.getElementById('cliente-nuevo').style.display = 'block';
        }
    });
}

/* =========================
   CREAR CLIENTE (AJAX)
========================= */
function crearCliente() {
    const data = new FormData();
    data.append('dni', document.getElementById('dni').value);
    data.append('nombre', document.getElementById('nombre').value);
    data.append('direccion', document.getElementById('direccion').value);

    fetch('<?= site_url('caja/crear-cliente') ?>', {
        method: 'POST',
        body: data
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.getElementById('cliente-info').innerHTML =
                '<strong>Cliente creado correctamente</strong>';

            document.getElementById('cliente-nuevo').style.display = 'none';
        } else {
            alert(data.message);
        }
    });
}

/* =========================
   AGREGAR PRODUCTO (AJAX)
========================= */
function agregarProducto() {
    const data = new FormData();
    data.append('id_producto', document.getElementById('id_producto').value);
    data.append('cantidad', document.getElementById('cantidad').value);

    fetch('<?= site_url('caja/agregar-producto') ?>', {
        method: 'POST',
        body: data
    })
    .then(res => res.json())
    .then(data => {
        if (!data.success) {
            alert(data.message);
            return;
        }

        // Agregar fila a la tabla
        const fila = `
            <tr>
                <td>${data.producto}</td>
                <td>${data.cantidad}</td>
                <td>${parseFloat(data.precio).toFixed(2)}</td>
                <td>${parseFloat(data.subtotal).toFixed(2)}</td>
            </tr>
        `;

        document.getElementById('tabla-productos').innerHTML += fila;

        // Actualizar total
        total += parseFloat(data.subtotal);
        document.getElementById('total').innerText =
            'Total: S/ ' + total.toFixed(2);
    });
}

/* =========================
   FINALIZAR VENTA (AJAX)
========================= */
function finalizarVenta() {
    fetch('<?= site_url('caja/finalizar') ?>', {
        method: 'POST'
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert('Venta finalizada correctamente');
            location.reload();
        } else {
            alert(data.message);
        }
    });
}
</script>