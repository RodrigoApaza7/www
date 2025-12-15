<h2>Editar usuario$usuario</h2>

<form method="post" action="<?= site_url('usuarios/actualizar/'.$usuario['id']) ?>">
    <input type="text" name="nombre" value="<?= $usuario['nombre'] ?>" required><br>
    <input type="text" name="usuario" value="<?= $usuario['usuario'] ?>"><br>
    <input type="text" name="password" value="<?= $usuario['password'] ?>"><br>

    <button type="submit">Actualizar</button>
</form>