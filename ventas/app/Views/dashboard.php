<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Sistema de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7fa;
            font-family: "Segoe UI", sans-serif;
        }
        .sidebar {
            background: #1b1f3b;
            min-height: 100vh;
            color: #fff;
            padding: 25px 15px;
        }
        .sidebar a {
            color: #cfd3ff;
            text-decoration: none;
            display: block;
            margin: 12px 0;
        }
        .sidebar a:hover {
            color: #fff;
        }
        .card {
            border-radius: 12px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-2 sidebar">
            <h5>Sistema Ventas</h5>
            <a href="<?= site_url('dashboard') ?>">Dashboard</a>
            <a href="<?= site_url('productos') ?>">Productos</a>
            <a href="<?= site_url('clientes') ?>">Clientes</a>
            <a href="<?= site_url('caja') ?>">Caja</a>
            <a href="<?= site_url('historial') ?>">Historial</a>
            <a href="<?= site_url('reportes/usuarios') ?>">Reportes</a>
        </div>

        <!-- CONTENIDO -->
        <div class="col-10 p-4">

            <h4 class="mb-4">Dashboard</h4>

            <div class="row g-4">

                <!-- PRODUCTOS EN STOCK -->
                <div class="col-md-4">
                    <div class="card shadow-sm p-3">
                        <h6 class="text-muted">Productos en Stock</h6>
                        <p class="display-6"><?= esc($productosStock) ?></p>
                    </div>
                </div>

                <!-- CLIENTES REGISTRADOS -->
                <div class="col-md-4">
                    <div class="card shadow-sm p-3">
                        <h6 class="text-muted">Clientes Registrados</h6>
                        <p class="display-6"><?= esc($totalClientes) ?></p>
                    </div>
                </div>

            </div>

            <div class="mt-5">
                <div class="card p-3">
                    <h6>Resumen</h6>
                    <p>
                        Desde aquí puedes gestionar productos, clientes y ventas.
                        Próximamente se mostrará el resumen de ventas y reportes.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>