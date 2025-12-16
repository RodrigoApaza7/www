<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Usuarios</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <style>
        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container my-5">
    
    <h2 class="mb-4 pb-2 border-bottom text-primary">
        <i class="bi bi-people-fill me-2"></i> Reporte de Usuarios
    </h2>

    <div class="d-flex align-items-center mb-4 flex-wrap gap-2">
        
        <select id="rol" class="form-select" style="min-width:150px; max-width:200px;">
            <option value="todos">Todos</option>
            <option value="admin">Admin</option>
            <option value="vendedor">Vendedor</option>
        </select>
        
        <button id="buscar" class="btn btn-primary">
            <i class="bi bi-search"></i> Buscar
        </button>

        <a id="pdf" href="<?= site_url('reportes/usuarios/pdf') ?>" class="btn btn-danger ms-2">
            <i class="bi bi-file-pdf-fill"></i> Descargar PDF
        </a>
    </div>
    
    <div class="table-responsive shadow-sm border rounded">
        <table class="table table-striped table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody id="resultado">
                <tr>
                    <td colspan="4" class="text-center text-muted p-4">
                        <i class="bi bi-info-circle me-2"></i> Usa el filtro para buscar usuarios.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('buscar').addEventListener('click', () => {
        // Mostrar un mensaje de carga mientras se ejecuta el fetch
        document.getElementById('resultado').innerHTML = `
            <tr>
                <td colspan="4" class="text-center p-3">
                    <div class="spinner-border text-primary spinner-border-sm me-2" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                    Cargando datos...
                </td>
            </tr>
        `;
        
        const rol = document.getElementById('rol').value;

        // TU LÓGICA FETCH/AJAX ORIGINAL (Sin modificar las URLs ni el proceso)
        fetch(`<?= site_url('reportes/usuarios/filtrar') ?>?rol=${rol}`)
            .then(r => r.json())
            .then(data => {
                let html = '';
                data.forEach(u => {
                    // Se usa el badge de Bootstrap para mejorar la apariencia del rol
                    const badgeClass = u.rol === 'admin' ? 'bg-success' : u.rol === 'vendedor' ? 'bg-info text-dark' : 'bg-secondary';

                    html += `
                        <tr>
                            <td>${u.id}</td>
                            <td>${u.nombre}</td>
                            <td>${u.usuario}</td>
                            <td><span class="badge ${badgeClass}">${u.rol}</span></td>
                        </tr>
                    `;
                });
                document.getElementById('resultado').innerHTML = html;
            })
            .catch(error => {
                console.error('Error al cargar los datos:', error);
                document.getElementById('resultado').innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center text-danger p-3">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> Error al cargar los datos.
                        </td>
                    </tr>
                `;
            });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>