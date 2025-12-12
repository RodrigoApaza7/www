<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Sistema de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow p-4" style="width: 380px;">
        
        <h3 class="text-center mb-3">Iniciar Sesión</h3>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="/login/autenticar" method="POST">
            <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <button class="btn btn-primary w-100">Ingresar</button>
        </form>

    </div>
</div>

</body>
</html>