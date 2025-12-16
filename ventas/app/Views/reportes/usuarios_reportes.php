<h2>Reporte de Usuarios</h2>

<select id="rol" class="form-select mb-3" style="max-width:200px;">
    <option value="todos">Todos</option>
    <option value="admin">Admin</option>
    <option value="vendedor">Vendedor</option>
</select>

<button id="buscar" class="btn btn-primary mb-3">Buscar</button>

<a id="pdf" href="<?= site_url('reportes/usuarios/pdf') ?>" class="btn btn-danger mb-3 ms-2">
    Descargar PDF
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Rol</th>
        </tr>
    </thead>
    <tbody id="resultado"></tbody>
</table>

<script>
document.getElementById('buscar').addEventListener('click', () => {
    const rol = document.getElementById('rol').value;

    fetch(`<?= site_url('reportes/usuarios/filtrar') ?>?rol=${rol}`)
        .then(r => r.json())
        .then(data => {
            let html = '';
            data.forEach(u => {
                html += `
                    <tr>
                        <td>${u.id}</td>
                        <td>${u.nombre}</td>
                        <td>${u.usuario}</td>
                        <td>${u.rol}</td>
                    </tr>
                `;
            });
            document.getElementById('resultado').innerHTML = html;
        });
});
</script>