<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sistema de Ventas - Dashboard</title>

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
        .metric-value {
            font-size: 2rem;
            font-weight: bold;
        }
        .metric-label {
            color: #6c757d;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- =========================
             SIDEBAR
        ========================= -->
        <div class="col-3 col-md-2 sidebar">
            <h3>Sistema Ventas</h3>

            <a href="<?= site_url('dashboard') ?>">Dashboard</a>
            <a href="<?= site_url('caja') ?>">Caja / Ventas</a>
            <a href="<?= site_url('productos') ?>">Productos</a>
            <a href="<?= site_url('clientes') ?>">Clientes</a>
            <a href="<?= site_url('historial') ?>">Historial de Ventas</a>
            <a href="<?= site_url('usuarios') ?>">Usuarios</a>
            <a href="<?= site_url('categorias') ?>">Configuración</a>
            <a href="<?= site_url('logout') ?>">Cerrar sesión</a>
        </div>

        <!-- =========================
             MAIN CONTENT
        ========================= -->
        <div class="col-9 col-md-10 p-0">

            <!-- TOPBAR -->
            <div class="topbar d-flex justify-content-between align-items-center">
                <h5 class="m-0">Dashboard</h5>
                <div>
                    Usuario: <?= esc(session()->get('usuario_nombre') ?? '—') ?>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="container mt-4">

                <!-- =========================
                     MÉTRICAS PRINCIPALES
                ========================= -->
                <div class="row g-4">

                    <!-- Ventas Hoy -->
                    <div class="col-md-4">
                        <div class="card shadow-sm p-3">
                            <div class="metric-label">Ventas del día</div>
                            <div class="metric-value">
                                S/ <?= number_format($totalHoy ?? 0, 2) ?>
                            </div>
                            <small class="text-muted">
                                Total de ventas cerradas hoy
                            </small>
                        </div>
                    </div>

                    <!-- Productos en Stock -->
                    <div class="col-md-4">
                        <div class="card shadow-sm p-3">
                            <div class="metric-label">Productos en stock</div>
                            <div class="metric-value">
                                <?= $productosStock ?? 0 ?>
                            </div>
                            <small class="text-muted">
                                Unidades disponibles en inventario
                            </small>
                        </div>
                    </div>

                    <!-- Clientes Registrados -->
                    <div class="col-md-4">
                        <div class="card shadow-sm p-3">
                            <div class="metric-label">Clientes registrados</div>
                            <div class="metric-value">
                                <?= $totalClientes ?? 0 ?>
                            </div>
                            <small class="text-muted">
                                Total de clientes en el sistema
                            </small>
                        </div>
                    </div>

                </div>

                <!-- =========================
                     SECCIÓN RESUMEN
                ========================= -->
                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="card shadow-sm p-4">
                            <h5 class="card-title">Resumen General</h5>
                            <p>
                                Este panel muestra un resumen del estado actual del sistema:
                                ventas realizadas, inventario disponible y clientes registrados.
                                Desde aquí puedes acceder rápidamente a las principales
                                funcionalidades del sistema de ventas.
                            </p>

                            <ul>
                                <li>Registrar nuevas ventas desde <strong>Caja</strong></li>
                                <li>Gestionar productos y stock</li>
                                <li>Consultar historial y generar reportes en PDF</li>
                                <li>Visualizar métricas clave del negocio</li>
                            </ul>
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