<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punto de Venta</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px 0;
        }
        .main-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 30px;
        }
        .section-header {
            border-bottom: 3px solid #0d6efd;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }
        .section-header h3 {
            color: #0d6efd;
            margin: 0;
        }
        .cliente-info-box {
            background: #e7f3ff;
            border-left: 4px solid #0d6efd;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }
        .venta-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            display: inline-block;
            margin-bottom: 20px;
        }
        .product-table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }
        .total-box {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin: 20px 0;
        }
        .btn-custom-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            transition: transform 0.2s;
        }
        .btn-custom-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .btn-custom-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            transition: transform 0.2s;
        }
        .btn-custom-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(17, 153, 142, 0.4);
        }
        .input-group-custom {
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .form-control {
            border: 1px solid #dee2e6;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            border-color: #667eea;
        }
        .icon-box {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 8px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- BLOQUE CLIENTE -->
        <div class="main-container">
            <div class="section-header">
                <h3><i class="fas fa-user me-2"></i>Información del Cliente</h3>
            </div>
            
            <div class="row g-3">
                <div class="col-md-8">
                    <div class="input-group input-group-custom">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        <input type="text" class="form-control form-control-lg" id="dni" placeholder="Ingrese DNI del cliente">
                        <button class="btn btn-custom-primary" type="button" onclick="buscarCliente()">
                            <i class="fas fa-search me-2"></i>Buscar
                        </button>
                    </div>
                </div>
            </div>

            <div id="cliente-info"></div>

            <div id="cliente-nuevo" style="display:none;" class="mt-4">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>Cliente no encontrado. Complete los datos para crear uno nuevo.
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nombre Completo</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Nombre del cliente">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Dirección</label>
                        <input type="text" class="form-control" id="direccion" placeholder="Dirección del cliente">
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-success btn-lg" onclick="crearCliente()">
                            <i class="fas fa-user-plus me-2"></i>Crear Cliente
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- BLOQUE PUNTO DE VENTA -->
        <div class="main-container">
            <div class="text-center">
                <div class="venta-badge">
                    <i class="fas fa-cash-register me-2"></i>
                    <span class="fs-4">Venta #<?= $venta_id ?></span>
                </div>
            </div>

            <div class="section-header">
                <h3><i class="fas fa-shopping-cart me-2"></i>Agregar Productos</h3>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-5">
                    <label class="form-label fw-bold">ID del Producto</label>
                    <input type="number" class="form-control form-control-lg" id="id_producto" placeholder="Ingrese ID">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Cantidad</label>
                    <input type="number" class="form-control form-control-lg" id="cantidad" value="1" min="1">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="button" class="btn btn-custom-primary btn-lg w-100" onclick="agregarProducto()">
                        <i class="fas fa-plus-circle me-2"></i>Agregar
                    </button>
                </div>
            </div>

            <!-- TABLA DE PRODUCTOS -->
            <div class="table-responsive product-table">
                <table class="table table-hover" id="tabla-productos">
                    <thead class="table-dark">
                        <tr>
                            <th><i class="fas fa-box me-2"></i>Producto</th>
                            <th class="text-center"><i class="fas fa-list-ol me-2"></i>Cantidad</th>
                            <th class="text-end"><i class="fas fa-tag me-2"></i>Precio</th>
                            <th class="text-end"><i class="fas fa-calculator me-2"></i>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detalle as $d): ?>
                            <tr>
                                <td><?= esc($d['nombre']) ?></td>
                                <td class="text-center"><span class="badge bg-primary"><?= $d['cantidad'] ?></span></td>
                                <td class="text-end">S/ <?= number_format($d['precio_unitario'], 2) ?></td>
                                <td class="text-end fw-bold">S/ <?= number_format($d['subtotal'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- TOTAL -->
            <div class="total-box" id="total">
                <i class="fas fa-money-bill-wave me-2"></i>
                Total: S/ <?= number_format($total, 2) ?>
            </div>

            <!-- FINALIZAR VENTA -->
            <div class="text-center">
                <button type="button" class="btn btn-custom-success btn-lg px-5" onclick="finalizarVenta()">
                    <i class="fas fa-check-circle me-2"></i>Finalizar Venta
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
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
                '<div class="cliente-info-box mt-3"><i class="fas fa-check-circle text-success me-2"></i><strong>Cliente:</strong> ' + data.cliente.nombre + '</div>';

            document.getElementById('cliente-nuevo').style.display = 'none';
        } else {
            // Cliente no existe → mostrar formulario
            document.getElementById('cliente-info').innerHTML = '';
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
                '<div class="alert alert-success mt-3"><i class="fas fa-check-circle me-2"></i><strong>Cliente creado correctamente</strong></div>';

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
        const tbody = document.querySelector('#tabla-productos tbody');
        const fila = `
            <tr>
                <td>${data.producto}</td>
                <td class="text-center"><span class="badge bg-primary">${data.cantidad}</span></td>
                <td class="text-end">S/ ${parseFloat(data.precio).toFixed(2)}</td>
                <td class="text-end fw-bold">S/ ${parseFloat(data.subtotal).toFixed(2)}</td>
            </tr>
        `;

        tbody.innerHTML += fila;

        // Actualizar total
        total += parseFloat(data.subtotal);
        document.getElementById('total').innerHTML =
            '<i class="fas fa-money-bill-wave me-2"></i>Total: S/ ' + total.toFixed(2);
        
        // Limpiar campos
        document.getElementById('id_producto').value = '';
        document.getElementById('cantidad').value = '1';
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
</body>
</html>