<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Productos</title>
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
        }
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 30px;
        }
        .page-header h2 {
            margin: 0;
            font-weight: 700;
        }
        .filter-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            border: 2px solid #e9ecef;
        }
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }
        .form-select {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s;
        }
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-filter {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: transform 0.2s;
        }
        .btn-filter:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .btn-pdf {
            background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
            border: none;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: transform 0.2s;
        }
        .btn-pdf:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(235, 51, 73, 0.4);
        }
        .table-custom {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .table-custom thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .table-custom tbody tr {
            transition: background-color 0.2s;
        }
        .table-custom tbody tr:hover {
            background-color: #f8f9fa;
        }
        .loading-state, .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }
        .loading-state i, .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.5;
        }
        .precio-cell {
            font-weight: 600;
            color: #28a745;
        }
        .badge-stock-alto {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
            color: white;
        }
        .badge-stock-medio {
            background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
            color: #000;
        }
        .badge-stock-bajo {
            background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="main-container">
            <div class="page-header">
                <h2><i class="fas fa-chart-bar me-2"></i>Reporte de Productos</h2>
            </div>

            <!-- FILTROS -->
            <div class="filter-section">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="categoria" class="form-label">
                            <i class="fas fa-folder me-2"></i>Categoría
                        </label>
                        <select id="categoria" class="form-select">
                            <option value="todos">Todas las categorías</option>
                            <?php foreach ($categorias as $c): ?>
                                <option value="<?= $c['id'] ?>">
                                    <?= esc($c['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-8 d-flex gap-2">
                        <button onclick="filtrar()" class="btn-filter">
                            <i class="fas fa-search me-2"></i>Filtrar
                        </button>
                        <button onclick="generarPDF()" class="btn-pdf">
                            <i class="fas fa-file-pdf me-2"></i>Generar PDF
                        </button>
                    </div>
                </div>
            </div>

            <!-- TABLA -->
            <div class="table-responsive">
                <table class="table table-custom table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width: 8%;"><i class="fas fa-hashtag me-2"></i>ID</th>
                            <th style="width: 35%;"><i class="fas fa-box me-2"></i>Producto</th>
                            <th style="width: 20%;"><i class="fas fa-folder me-2"></i>Categoría</th>
                            <th style="width: 17%;" class="text-end"><i class="fas fa-dollar-sign me-2"></i>Precio</th>
                            <th style="width: 20%;" class="text-center"><i class="fas fa-warehouse me-2"></i>Stock</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-productos">
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="fas fa-filter"></i>
                                    <h5>Selecciona una categoría y presiona Filtrar</h5>
                                    <p>Los productos se mostrarán aquí</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
function filtrar() {
    const categoria = document.getElementById('categoria').value;
    const tbody = document.getElementById('tabla-productos');
    
    // Mostrar loading
    tbody.innerHTML = `
        <tr>
            <td colspan="5">
                <div class="loading-state">
                    <i class="fas fa-spinner fa-spin"></i>
                    <h5>Cargando productos...</h5>
                </div>
            </td>
        </tr>
    `;

    fetch(`<?= site_url('reportes/productos/filtrar') ?>?categoria=${categoria}`)
        .then(resp => resp.json())
        .then(data => {
            tbody.innerHTML = '';

            if (data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <h5>No hay productos en esta categoría</h5>
                                <p>Intenta con otra categoría</p>
                            </div>
                        </td>
                    </tr>
                `;
                return;
            }

            data.forEach(p => {
                const stock = parseInt(p.stock);
                let stockBadge = '';
                
                if (stock > 20) {
                    stockBadge = `<span class="badge-stock-alto"><i class="fas fa-check-circle me-1"></i>${stock}</span>`;
                } else if (stock >= 10) {
                    stockBadge = `<span class="badge-stock-medio"><i class="fas fa-exclamation-circle me-1"></i>${stock}</span>`;
                } else {
                    stockBadge = `<span class="badge-stock-bajo"><i class="fas fa-times-circle me-1"></i>${stock}</span>`;
                }

                tbody.innerHTML += `
                    <tr>
                        <td><strong>${p.id}</strong></td>
                        <td>${p.nombre}</td>
                        <td>
                            <span class="badge bg-secondary">${p.categoria ?? 'Sin categoría'}</span>
                        </td>
                        <td class="text-end precio-cell">S/ ${parseFloat(p.precio).toFixed(2)}</td>
                        <td class="text-center">${stockBadge}</td>
                    </tr>
                `;
            });
        })
        .catch(error => {
            tbody.innerHTML = `
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <i class="fas fa-exclamation-triangle text-danger"></i>
                            <h5>Error al cargar los datos</h5>
                            <p>Por favor, intenta nuevamente</p>
                        </div>
                    </td>
                </tr>
            `;
        });
}

function generarPDF() {
    const categoria = document.getElementById('categoria').value;
    window.open(`<?= site_url('reportes/productos/pdf') ?>?categoria=${categoria}`, '_blank');
}

// Cargar todos los productos al inicio
window.addEventListener('load', filtrar);
    </script>
</body>
</html>