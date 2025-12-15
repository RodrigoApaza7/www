<h2>Nueva Persona</h2>

<form method="post" action="<?= site_url('personas/guardar') ?>">
    <input type="text" name="nombre" placeholder="Nombre" required><br>
    <input type="text" name="paterno" placeholder="Paterno"><br>
    <input type="text" name="materno" placeholder="Materno"><br>

    <button type="submit">Guardar</button>
</form>