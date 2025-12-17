<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Productos</title>

    <!-- Ajusta si ya tienes CSS global -->
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .filtros {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h2>Reporte de Productos</h2>

<!-- 🔹 FILTROS -->
<div class="filtros">
    <label for="categoria">Categoría:</label>
    <select id="categoria">
        <option value="todos">Todas</option>
        <?php foreach ($categorias as $c): ?>
            <option value="<?= $c['id'] ?>">
                <?= esc($c['nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button onclick="filtrar()">Filtrar</button>
    <button onclick="generarPDF()">PDF</button>
</div>

<!-- 🔹 TABLA -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Stock</th>
        </tr>
    </thead>
    <tbody id="tabla-productos">
        <!-- AJAX -->
    </tbody>
</table>

<script>
function filtrar() {
    const categoria = document.getElementById('categoria').value;

    fetch(`<?= site_url('reportes/productos/filtrar') ?>?categoria=${categoria}`)
        .then(resp => resp.json())
        .then(data => {
            const tbody = document.getElementById('tabla-productos');
            tbody.innerHTML = '';

            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5">No hay productos</td></tr>';
                return;
            }

            data.forEach(p => {
                tbody.innerHTML += `
                    <tr>
                        <td>${p.id}</td>
                        <td>${p.nombre}</td>
                        <td>${p.categoria ?? ''}</td>
                        <td>${p.precio}</td>
                        <td>${p.stock}</td>
                    </tr>
                `;
            });
        });
}

function generarPDF() {
    const categoria = document.getElementById('categoria').value;
    window.open(`<?= site_url('reportes/productos/pdf') ?>?categoria=${categoria}`, '_blank');
}
</script>

</body>
</html>