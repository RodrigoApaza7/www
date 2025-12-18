<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Ventas - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
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
            padding: 20px 15px;
        }
        .sidebar h4 {
            font-weight: 600;
            margin-bottom: 20px;
        }
        .sidebar a {
            color: #cfd3ff;
            text-decoration: none;
            display: block;
            margin: 10px 0;
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
        .metric-value {
            font-size: 2rem;
            font-weight: bold;
        }
        .accordion-button:not(.collapsed) {
            background-color: #2b2f5b;
            color: #fff;
        }
        .accordion-button {
            background-color: #1b1f3b;
            color: #cfd3ff;
        }
        .accordion-body a {
            display: block;
            margin: 6px 0;
            color: #1b1f3b;
            text-decoration: none;
        }
        .accordion-body a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
<div class="container-fluid">
    <div class="row">

        <!-- ================= SIDEBAR ================= -->
        <div class="col-3 col-md-2 sidebar">
            <h4>Sistema Ventas</h4>

            <a href="<?= site_url('dashboard') ?>">📊 Dashboard</a>
            <a href="<?= site_url('caja') ?>">💰 Caja / Ventas</a>
            <a href="<?= site_url('productos') ?>">📦 Productos</a>
            <a href="<?= site_url('clientes') ?>">👥 Clientes</a>
            <a href="<?= site_url('historial') ?>">🧾 Historial de Ventas</a>
            <a href="<?= site_url('usuarios') ?>">👤 Usuarios</a>

            <!-- ====== REPORTES (ACORDEÓN) ====== -->
            <div class="accordion mt-3" id="accordionReportes">
                <div class="accordion-item border-0">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseReportes">
                            📑 Reportes
                        </button>
                    </h2>

                    <div id="collapseReportes"
                         class="accordion-collapse collapse"
                         data-bs-parent="#accordionReportes">

                        <div class="accordion-body bg-light rounded">
                            <a href="<?= site_url('reportes/usuarios') ?>">
                                👤 Reporte de Usuarios
                            </a>

                            <a href="<?= site_url('reportes/productos') ?>">
                                📦 Reporte de Productos
                            </a>

                            <a href="<?= site_url('historial') ?>">
                                💰 Reporte de Ventas
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <a href="<?= site_url('logout') ?>">🚪 Cerrar sesión</a>
        </div>

        <!-- ================= MAIN ================= -->
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

                <!-- MÉTRICAS -->
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card shadow-sm p-3">
                            <div class="text-muted">Ventas del día</div>
                            <div class="metric-value">
                                S/ <?= number_format($totalHoy ?? 0, 2) ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow-sm p-3">
                            <div class="text-muted">Productos en stock</div>
                            <div class="metric-value">
                                <?= $productosStock ?? 0 ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow-sm p-3">
                            <div class="text-muted">Clientes registrados</div>
                            <div class="metric-value">
                                <?= $totalClientes ?? 0 ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RESUMEN -->
                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="card shadow-sm p-4">
                            <h5 class="card-title">Resumen General</h5>
                            <p>
                                Este panel muestra el estado actual del sistema de ventas.
                                Desde aquí puedes acceder a las principales funcionalidades,
                                revisar métricas clave y generar reportes en PDF.
                            </p>

                            <ul>
                                <li>Control de ventas diarias</li>
                                <li>Gestión de productos y stock</li>
                                <li>Administración de clientes y usuarios</li>
                                <li>Generación de reportes en PDF</li>
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