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
        /* Sidebar */
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
        .nav-links { padding: 15px 0; }
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
        .sidebar a:hover, .accordion-button:hover { background: var(--sidebar-hover); color: #fff; }
        
        /* Acordeón Reportes */
        .accordion-item { background: transparent; border: none; }
        .accordion-button { background: transparent !important; box-shadow: none !important; }
        .accordion-button::after { filter: brightness(0) invert(1); }
        .accordion-body { background: rgba(0,0,0,0.15); padding: 0; }
        .accordion-body a { padding-left: 50px; font-size: 13px; }

        /* Topbar */
        .topbar { background: #fff; border-bottom: 1px solid #e2e8f0; padding: 15px 30px; }
        .user-badge { background: #f8fafc; padding: 5px 15px; border-radius: 20px; border: 1px solid #e2e8f0; font-weight: 500; }

        /* Métricas */
        .card-metric { border: none; border-radius: 16px; transition: transform 0.3s; }
        .icon-shape {
            width: 48px; height: 48px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center; font-size: 1.5rem;
        }
        .metric-value { font-size: 1.75rem; font-weight: 800; color: #1e293b; }
        .logout-link { color: #fb7185 !important; margin-top: 20px; }
    </style>
</head>

<body>
<div class="container-fluid p-0">
    <div class="row g-0">

        <div class="col-lg-2 sidebar d-none d-lg-block">
            <div class="sidebar-header">
                <h4><i class="fas fa-rocket me-2"></i>SystemPC</h4>
            </div>
            <div class="nav-links">
                <a href="<?= site_url('dashboard') ?>"><i class="fas fa-chart-pie me-2"></i> Dashboard</a>
                <a href="<?= site_url('caja') ?>"><i class="fas fa-cash-register me-2"></i> Caja / Ventas</a>
                <a href="<?= site_url('productos') ?>"><i class="fas fa-box me-2"></i> Productos</a>
                <a href="<?= site_url('categorias') ?>"><i class="fas fa-tags me-2"></i> Categorías</a>
                <a href="<?= site_url('clientes') ?>"><i class="fas fa-users me-2"></i> Clientes</a>
                <a href="<?= site_url('historial') ?>"><i class="fas fa-file-invoice-dollar me-2"></i> Historial</a>
                <a href="<?= site_url('usuarios') ?>"><i class="fas fa-user-shield me-2"></i> Usuarios</a>

                <div class="accordion accordion-flush" id="accordionReportes">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseReportes">
                                <i class="fas fa-file-pdf me-2"></i> Reportes
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
                <a href="<?= site_url('logout') ?>" class="logout-link"><i class="fas fa-sign-out-alt me-2"></i> Cerrar sesión</a>
            </div>
        </div>

        <div class="col-lg-10 col-md-12">
            <div class="topbar d-flex justify-content-between align-items-center">
                <h5 class="m-0 fw-bold">Dashboard Informativo</h5>
                <div class="user-badge">
                    <i class="fas fa-circle-user text-primary me-2"></i>
                    <span class="small"><?= esc(session()->get('usuario_nombre') ?? 'Admin') ?></span>
                </div>
            </div>

            <div class="p-4">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card card-metric shadow-sm p-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="text-muted small mb-1 fw-bold">VENTAS DEL DÍA</p>
                                    <div class="metric-value">S/ <?= number_format($totalHoy ?? 0, 2) ?></div>
                                </div>
                                <div class="icon-shape" style="background: #dcfce7; color: #16a34a;"><i class="fas fa-coins"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-metric shadow-sm p-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="text-muted small mb-1 fw-bold">STOCK PRODUCTOS</p>
                                    <div class="metric-value"><?= $productosStock ?? 0 ?></div>
                                </div>
                                <div class="icon-shape" style="background: #fef9c3; color: #ca8a04;"><i class="fas fa-boxes-stacked"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-metric shadow-sm p-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="text-muted small mb-1 fw-bold">TOTAL CLIENTES</p>
                                    <div class="metric-value"><?= $totalClientes ?? 0 ?></div>
                                </div>
                                <div class="icon-shape" style="background: #e0f2fe; color: #0284c7;"><i class="fas fa-user-group"></i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5 g-4">
                    <div class="col-md-8">
                        <div class="card border-0 shadow-sm p-4" style="border-radius: 15px; height: 100%;">
                            <h5 class="card-title fw-bold mb-4">
                                <i class="fas fa-chart-line text-primary me-2"></i>Ventas últimos 7 días
                            </h5>
                            <div style="position: relative; height: 300px;">
                                <canvas id="ventasChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm p-4" style="border-radius: 15px; height: 100%;">
                            <h5 class="card-title fw-bold mb-4">
                                <i class="fas fa-chart-pie text-info me-2"></i>Distribución Clientes
                            </h5>
                            <div style="position: relative; height: 300px;">
                                <canvas id="clientesChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
                            <h5 class="fw-bold"><i class="fas fa-circle-info text-primary me-2"></i>Resumen General</h5>
                            <p class="text-secondary m-0">Análisis visual de los datos de transacciones del sistema.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {

    // Gráfico 1: Ventas (Línea)
    const ventasCanvas = document.getElementById('ventasChart');
    if (ventasCanvas) {
        new Chart(ventasCanvas, {
            type: 'line',
            data: {
                labels: <?= $ventasLabels ?>,
                datasets: [{
                    label: 'Ventas (S/)',
                    data: <?= $ventasData ?>,
                    fill: true,
                    backgroundColor: 'rgba(56, 189, 248, 0.1)',
                    borderColor: '#0284c7',
                    borderWidth: 3,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    // Gráfico 2: Clientes (Dona)
    const clientesCanvas = document.getElementById('clientesChart');
    if (clientesCanvas) {
        new Chart(clientesCanvas, {
            type: 'doughnut',
            data: {
                labels: <?= $clientesLabels ?>,
                datasets: [{
                    data: <?= $clientesData ?>,
                    backgroundColor: [
                        '#38bdf8', // Azul
                        '#10b981', // Verde
                        '#f59e0b', // Ámbar
                        '#6366f1', // Indigo
                        '#ef4444'  // Rojo
                    ],
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }
});
</script>
</body>
</html>