<h2>Editar Persona</h2>

<form method="post" action="<?= site_url('personas/actualizar/'.$persona['id']) ?>">
    <input type="text" name="nombre" value="<?= $persona['nombre'] ?>" required><br>
    <input type="text" name="paterno" value="<?= $persona['paterno'] ?>"><br>
    <input type="text" name="materno" value="<?= $persona['materno'] ?>"><br>

    <button type="submit">Actualizar</button>
</form>