<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px 0;
        }
        .main-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 40px;
            max-width: 700px;
            margin: 0 auto;
        }
        .page-header {
            border-bottom: 3px solid #ffc107;
            padding-bottom: 15px;
            margin-bottom: 30px;
            text-align: center;
        }
        .page-header h2 {
            color: #ffc107;
            margin: 0;
            font-weight: 600;
        }
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
        }
        .btn-custom-warning {
            background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);
            border: none;
            padding: 12px 40px;
            border-radius: 8px;
            color: #000;
            font-weight: 600;
            font-size: 1.1rem;
            width: 100%;
        }
        .btn-secondary-custom {
            background: #6c757d;
            border: none;
            padding: 12px 40px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            width: 100%;
            text-align: center;
            display: inline-block;
            text-decoration: none;
        }
        .input-icon {
            position: relative;
        }
        .input-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
        .input-icon .form-control {
            padding-left: 45px;
        }
        .form-group-custom {
            margin-bottom: 25px;
        }
        .icon-header {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: #000;
            font-size: 1.5rem;
        }
        .info-badge {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="main-container">

        <div class="icon-header">
            <i class="fas fa-user-edit"></i>
        </div>

        <div class="page-header">
            <h2>Editar Cliente</h2>
        </div>

        <div class="info-badge">
            <strong>ID del Cliente:</strong> <?= esc($cliente['id']) ?>
        </div>

        <form method="post" action="<?= site_url('clientes/actualizar/'.$cliente['id']) ?>">

            <div class="form-group-custom">
                <label class="form-label">Nombre Completo</label>
                <div class="input-icon">
                    <i class="fas fa-user"></i>
                    <input type="text"
                           class="form-control"
                           name="nombre"
                           value="<?= esc($cliente['nombre']) ?>"
                           required>
                </div>
            </div>

            <div class="form-group-custom">
                <label class="form-label">DNI</label>
                <div class="input-icon">
                    <i class="fas fa-id-card"></i>
                    <input type="text"
                           class="form-control"
                           name="dni"
                           value="<?= esc($cliente['dni']) ?>"
                           maxlength="8"
                           required>
                </div>
            </div>

            <div class="form-group-custom">
                <label class="form-label">Dirección</label>
                <div class="input-icon">
                    <i class="fas fa-location-dot"></i>
                    <input type="text"
                           class="form-control"
                           name="direccion"
                           value="<?= esc($cliente['direccion']) ?>"
                           required>
                </div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-6">
                    <a href="<?= site_url('clientes') ?>" class="btn-secondary-custom">
                        Cancelar
                    </a>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn-custom-warning">
                        Actualizar
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>