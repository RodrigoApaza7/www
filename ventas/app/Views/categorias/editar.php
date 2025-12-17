<h2>Editar Categoría</h2>

<form method="post" action="<?= site_url('categorias/actualizar/'.$categoria['id']) ?>">
    <input type="text" name="nombre" value="<?= $categoria['nombre'] ?>" required><br>
    <input type="text" name="estado" value="<?= $categoria['estado'] ?>"><br>

    <button type="submit">Actualizar</button>
</form>