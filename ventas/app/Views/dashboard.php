<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sistema de Ventas - Home</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
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
        .sidebar h3 {
            font-weight: 600;
        }
        .sidebar a {
            color: #cfd3ff;
            text-decoration: none;
            display: block;
            margin: 12px 0;
            font-size: 15px;
        }
        .sidebar a:hover {
            color: #fff;
        }
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e3e6f0;
            padding: 15px;
        }
        .card {
            border-radius: 12px;
        }
        .card-title {
            font-weight: 600;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- SIDEBAR -->
        <div class="col-3 col-md-2 sidebar">
            <h3>Sistema Ventas</h3>
            <a href="#">Dashboard</a>
            <a href="<?= site_url('productos') ?>">Productos</a>
            <a href="#">Ventas</a>
            <a href="#">Clientes</a>
            <a href="<?= site_url('usuarios') ?>">Gestionar Usuarios</a>
            <a href="<?= site_url('reportes/usuarios') ?>">Reportes</a>
            <a href="#">Configuración</a>
        </div>

        <!-- MAIN CONTENT -->
        <div class="col-9 col-md-10 p-0">
            <div class="topbar d-flex justify-content-between align-items-center">
                <h5 class="m-0">Inicio</h5>
                <div>Usuario: <?php $rolUsuario = session()->get('usuario_rol'); ?></div>
            </div>

            <div class="container mt-4">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card shadow-sm p-3">
                            <h5 class="card-title">Ventas Hoy</h5>
                            <p class="display-6">S/ 0.00</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm p-3">
                            <h5 class="card-title">Productos en Stock</h5>
                            <p class="display-6">0</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm p-3">
                            <h5 class="card-title">Clientes Registrados</h5>
                            <p class="display-6">0</p>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="card shadow-sm p-3">
                            <h5 class="card-title">Resumen General</h5>
                            <p>
                                Bienvenido a tu sistema de ventas. Desde aquí podrás gestionar productos,
                                registrar ventas, administrar clientes y generar reportes.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>