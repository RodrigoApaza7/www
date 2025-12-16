<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>

<div class="container my-5">
    
    <h2 class="mb-4 pb-2 border-bottom text-primary">
        <i class="bi bi-people-fill me-2"></i>Reporte de Usuarios
    </h2>

    <div class="d-flex align-items-center mb-4 flex-wrap">
        <div class="me-3 mb-2 mb-md-0">
            <label for="rol" class="form-label visually-hidden">Filtrar por Rol</label>
            <select id="rol" class="form-select" style="min-width:150px;">
                <option value="todos">Todos</option>
                <option value="admin">Admin</option>
                <option value="vendedor">Vendedor</option>
            </select>
        </div>
        
        <button id="buscar" class="btn btn-primary me-2 mb-2 mb-md-0">
            <i class="bi bi-search"></i> Buscar
        </button>

        <a id="pdf" href="<?= site_url('reportes/usuarios/pdf') ?>" class="btn btn-danger mb-2 mb-md-0">
            <i class="bi bi-file-pdf-fill"></i> Descargar PDF
        </a>
    </div>
    
    <div class="table-responsive shadow-sm">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody id="resultado">
                </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('buscar').addEventListener('click', () => {
        // 1. Obtener el valor del filtro de rol
        const rol = document.getElementById('rol').value;

        // 2. Realizar la solicitud Fetch (AJAX)
        // La URL de tu script PHP se mantiene sin cambios: <?= site_url('reportes/usuarios/filtrar') ?>
        fetch(`<?= site_url('reportes/usuarios/filtrar') ?>?rol=${rol}`)
            .then(r => {
                // Verificar si la respuesta es exitosa
                if (!r.ok) {
                    throw new Error(`HTTP error! status: ${r.status}`);
                }
                return r.json();
            })
            .then(data => {
                let html = '';
                // 3. Generar las filas de la tabla con los datos
                data.forEach(u => {
                    // Mejora visual: usar 'badge' de Bootstrap para el rol
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
                // 4. Insertar el HTML generado en el tbody
                document.getElementById('resultado').innerHTML = html;
            })
            .catch(error => {
                console.error('Error al cargar los datos:', error);
                // Mostrar un mensaje de error en la tabla si la solicitud falla
                document.getElementById('resultado').innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center text-danger p-3">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> Error al cargar los datos: ${error.message}
                        </td>
                    </tr>
                `;
            });
    });
</script>

</body>
</html>