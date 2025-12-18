<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Usuarios</title>
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
            min-width: 200px;
        }
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-search {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: transform 0.2s;
        }
        .btn-search:hover {
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
            text-decoration: none;
            display: inline-block;
        }
        .btn-pdf:hover {
            color: white;
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
        .loading-state, .empty-state, .info-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }
        .loading-state i, .empty-state i, .info-state i {
            font-size: 3rem;
            margin-bottom: 15px;
        }
        .loading-state i {
            color: #667eea;
        }
        .empty-state i {
            opacity: 0.5;
        }
        .info-state i {
            color: #0d6efd;
            opacity: 0.6;
        }
        .badge-admin {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 500;
            color: white;
        }
        .badge-vendedor {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 500;
            color: #000;
        }
        .badge-otro {
            background: #6c757d;
            padding: 6px 14px;
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
                <h2><i class="fas fa-users me-2"></i>Reporte de Usuarios</h2>
            </div>

            <!-- FILTROS -->
            <div class="filter-section">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="rol" class="form-label">
                            <i class="fas fa-user-tag me-2"></i>Rol
                        </label>
                        <select id="rol" class="form-select">
                            <option value="todos">Todos los roles</option>
                            <option value="admin">Admin</option>
                            <option value="vendedor">Vendedor</option>
                        </select>
                    </div>
                    <div class="col-md-9 d-flex gap-2">
                        <button id="buscar" class="btn-search">
                            <i class="fas fa-search me-2"></i>Buscar
                        </button>
                        <a id="pdf" href="<?= site_url('reportes/usuarios/pdf') ?>" class="btn-pdf">
                            <i class="fas fa-file-pdf me-2"></i>Descargar PDF
                        </a>
                    </div>
                </div>
            </div>

            <!-- TABLA -->
            <div class="table-responsive">
                <table class="table table-custom table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width: 10%;"><i class="fas fa-hashtag me-2"></i>ID</th>
                            <th style="width: 35%;"><i class="fas fa-user me-2"></i>Nombre</th>
                            <th style="width: 35%;"><i class="fas fa-id-badge me-2"></i>Usuario</th>
                            <th style="width: 20%;" class="text-center"><i class="fas fa-user-shield me-2"></i>Rol</th>
                        </tr>
                    </thead>
                    <tbody id="resultado">
                        <tr>
                            <td colspan="4">
                                <div class="info-state">
                                    <i class="fas fa-info-circle"></i>
                                    <h5>Selecciona un rol y presiona Buscar</h5>
                                    <p>Los usuarios se mostrarán aquí</p>
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
        document.getElementById('buscar').addEventListener('click', () => {
            const tbody = document.getElementById('resultado');
            
            // Mostrar loading
            tbody.innerHTML = `
                <tr>
                    <td colspan="4">
                        <div class="loading-state">
                            <i class="fas fa-spinner fa-spin"></i>
                            <h5>Cargando usuarios...</h5>
                        </div>
                    </td>
                </tr>
            `;

            const rol = document.getElementById('rol').value;

            // Actualizar enlace del PDF
            const pdfLink = document.getElementById('pdf');
            if (rol === 'todos') {
                pdfLink.href = `<?= site_url('reportes/usuarios/pdf') ?>`;
            } else {
                pdfLink.href = `<?= site_url('reportes/usuarios/pdf') ?>?rol=${rol}`;
            }

            // Hacer la petición AJAX
            fetch(`<?= site_url('reportes/usuarios/filtrar') ?>?rol=${rol}`)
                .then(r => r.json())
                .then(data => {
                    if (data.length === 0) {
                        tbody.innerHTML = `
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="fas fa-inbox"></i>
                                        <h5>No se encontraron usuarios</h5>
                                        <p>Intenta con otro rol</p>
                                    </div>
                                </td>
                            </tr>
                        `;
                        return;
                    }

                    let html = '';
                    data.forEach(u => {
                        let badgeClass = '';
                        let badgeIcon = '';
                        
                        if (u.rol === 'admin') {
                            badgeClass = 'badge-admin';
                            badgeIcon = '<i class="fas fa-crown me-1"></i>';
                        } else if (u.rol === 'vendedor') {
                            badgeClass = 'badge-vendedor';
                            badgeIcon = '<i class="fas fa-store me-1"></i>';
                        } else {
                            badgeClass = 'badge-otro';
                            badgeIcon = '<i class="fas fa-user me-1"></i>';
                        }

                        html += `
                            <tr>
                                <td><strong>${u.id}</strong></td>
                                <td>${u.nombre}</td>
                                <td><code>${u.usuario}</code></td>
                                <td class="text-center">
                                    <span class="${badgeClass}">${badgeIcon}${u.rol}</span>
                                </td>
                            </tr>
                        `;
                    });
                    tbody.innerHTML = html;
                })
                .catch(error => {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="4">
                                <div class="empty-state">
                                    <i class="fas fa-exclamation-triangle text-danger"></i>
                                    <h5>Error al cargar los datos</h5>
                                    <p>Por favor, intenta nuevamente</p>
                                </div>
                            </td>
                        </tr>
                    `;
                });
        });
    </script>
</body>
</html>