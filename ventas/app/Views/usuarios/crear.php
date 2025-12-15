<h2>Nuevo Usuario</h2>

<form method="post" action="<?= site_url('usuarios/guardar') ?>">
    <input type="text" name="nombre" placeholder="Nombre" required><br>
    <input type="text" name="usuario" placeholder="usuario"><br>
    <input type="text" name="password" placeholder="password"><br>

    <button type="submit">Guardar</button>
</form>