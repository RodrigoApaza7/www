<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Ventas - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
            --accent-color: #38bdf8;
        }
        body {
            background-color: #f1f5f9;
            font-family: 'Inter', "Segoe UI", sans-serif;
        }
        /* Sidebar Mejorado */
        .sidebar {
            background: var(--sidebar-bg);
            min-height: 100vh;
            color: #fff;
            padding: 0;
            transition: all 0.3s;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }
        .sidebar-header {
            padding: 25px 20px;
            background: rgba(0,0,0,0.2);
            text-align: center;
        }
        .sidebar-header h4 {
            font-size: 1.2rem;
            letter-spacing: 1px;
            color: var(--accent-color);
        }
        .nav-links {
            padding: 15px 0;
        }
        .sidebar a, .accordion-button {
            color: #cbd5e1;
            text-decoration: none;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            font-size: 14px;
            transition: 0.3s;
            border: none;
        }
        .sidebar a i, .accordion-button i {
            width: 25px;
            font-size: 1.1rem;
        }
        .sidebar a:hover, .accordion-button:hover {
            background: var(--sidebar-hover);
            color: #fff;
        }
        /* Corrección Acordeón Reportes */
        .accordion-item {
            background: transparent;
            border: none;
        }
        .accordion-button {
            background: transparent !important;
            box-shadow: none !important;
        }
        .accordion-button::after {
            filter: brightness(0) invert(1); /* Flecha blanca */
        }
        .accordion-body {
            background: rgba(0,0,0,0.15);
            padding: 0;
        }
        .accordion-body a {
            padding-left: 50px;
            font-size: 13px;
        }
        /* Topbar */
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 15px 30px;
        }
        .user-badge {
            background: #f8fafc;
            padding: 5px 15px;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            font-weight: 500;
        }
        /* Cards de Métricas */
        .card-metric {
            border: none;
            border-radius: 16px;
            transition: transform 0.3s;
        }
        .card-metric:hover {
            transform: translateY(-5px);
        }
        .icon-shape {
            width: 48px;
            height: 48px;
            background: #e0f2fe;
            color: #0284c7;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        .metric-value {
            font-size: 1.75rem;
            font-weight: 800;
            color: #1e293b;
        }
        .logout-link {
            color: #fb7185 !important;
            margin-top: 20px;
        }
        .logout-link:hover {
            background: #4c1d24 !important;
        }
    </style>
</head>

<body>
<div class="container-fluid p-0">
    <div class="row g-0">

        <div class="col-lg-2 sidebar">
            <div class="sidebar-header">
                <h4><i class="fas fa-rocket me-2"></i>POS SYSTEM</h4>
            </div>

            <div class="nav-links">
                <a href="<?= site_url('dashboard') ?>"><i class="fas fa-chart-pie"></i> Dashboard</a>
                <a href="<?= site_url('caja') ?>"><i class="fas fa-cash-register"></i> Caja / Ventas</a>
                <a href="<?= site_url('productos') ?>"><i class="fas fa-box"></i> Productos</a>
                <a href="<?= site_url('clientes') ?>"><i class="fas fa-users"></i> Clientes</a>
                <a href="<?= site_url('historial') ?>"><i class="fas fa-file-invoice-dollar"></i> Historial</a>
                <a href="<?= site_url('usuarios') ?>"><i class="fas fa-user-shield"></i> Usuarios</a>

                <div class="accordion accordion-flush" id="accordionReportes">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseReportes">
                                <i class="fas fa-file-pdf"></i> Reportes
                            </button>
                        </h2>
                        <div id="collapseReportes" class="accordion-collapse collapse" data-bs-parent="#accordionReportes">
                            <div class="accordion-body">
                                <a href="<?= site_url('reportes/usuarios') ?>"><i class="fas fa-minus me-2 small"></i> Usuarios</a>
                                <a href="<?= site_url('reportes/productos') ?>"><i class="fas fa-minus me-2 small"></i> Productos</a>
                                <a href="<?= site_url('historial') ?>"><i class="fas fa-minus me-2 small"></i> Ventas</a>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="mx-3 opacity-25">
                <a href="<?= site_url('logout') ?>" class="logout-link"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
            </div>
        </div>

        <div class="col-lg-10">

            <div class="topbar d-flex justify-content-between align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active fw-bold text-dark" aria-current="page">Panel Principal</li>
                    </ol>
                </nav>
                <div class="user-badge">
                    <i class="fas fa-circle-user text-primary me-2"></i>
                    <span class="small"><?= esc(session()->get('usuario_nombre') ?? 'Admin') ?></span>
                </div>
            </div>

            <div class="p-4">
                <div class="container-fluid">
                    
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="card card-metric shadow-sm p-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="text-muted small mb-1 uppercase fw-bold">Ventas del día</p>
                                        <div class="metric-value">S/ <?= number_format($totalHoy ?? 0, 2) ?></div>
                                    </div>
                                    <div class="icon-shape" style="background: #dcfce7; color: #16a34a;">
                                        <i class="fas fa-coins"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-metric shadow-sm p-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="text-muted small mb-1 uppercase fw-bold">Productos en Stock</p>
                                        <div class="metric-value"><?= $productosStock ?? 0 ?></div>
                                    </div>
                                    <div class="icon-shape" style="background: #fef9c3; color: #ca8a04;">
                                        <i class="fas fa-boxes-stacked"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-metric shadow-sm p-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="text-muted small mb-1 uppercase fw-bold">Total Clientes</p>
                                        <div class="metric-value"><?= $totalClientes ?? 0 ?></div>
                                    </div>
                                    <div class="icon-shape" style="background: #e0f2fe; color: #0284c7;">
                                        <i class="fas fa-user-group"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm overflow-hidden">
                                <div class="card-header bg-white py-3">
                                    <h5 class="m-0 fw-bold"><i class="fas fa-circle-info text-primary me-2"></i>Estado del Sistema</h5>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <p class="text-secondary">Bienvenido al panel de control central. Aquí tienes un resumen de las capacidades activas:</p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <ul class="list-unstyled">
                                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Monitoreo en tiempo real</li>
                                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Control de inventario</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <ul class="list-unstyled">
                                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Reportes PDF exportables</li>
                                                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Seguridad de usuarios</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-center d-none d-md-block">
                                            <i class="fas fa-chart-line fa-8x text-light"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
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