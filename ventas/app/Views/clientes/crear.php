<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Cliente</title>
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
            border-bottom: 3px solid #0d6efd; /* Azul para "Nuevo" */
            padding-bottom: 15px;
            margin-bottom: 30px;
            text-align: center;
        }
        .page-header h2 {
            color: #0d6efd;
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
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
        }
        .btn-custom-primary {
            background: linear-gradient(135deg, #0d6efd 0%, #00d2ff 100%);
            border: none;
            padding: 12px 40px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            transition: transform 0.2s;
            width: 100%;
        }
        .btn-custom-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
            color: white;
        }
        .btn-secondary-custom {
            background: #6c757d;
            border: none;
            padding: 12px 40px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            transition: transform 0.2s;
            width: 100%;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        .btn-secondary-custom:hover {
            background: #5a6268;
            color: white;
            transform: translateY(-2px);
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
            background: linear-gradient(135deg, #0d6efd 0%, #00d2ff 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main-container">
            <div class="icon-header">
                <i class="fas fa-user-plus"></i>
            </div>
            
            <div class="page-header">
                <h2><i class="fas fa-plus-circle me-2"></i>Nuevo Cliente</h2>
            </div>

            <form method="post" action="<?= site_url('clientes/guardar') ?>">
                <?= csrf_field() ?>

                <div class="form-group-custom">
                    <label for="nombre" class="form-label">
                        <i class="fas fa-user me-2"></i>Nombre Completo
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-user-circle"></i>
                        <input type="text" 
                               class="form-control" 
                               id="nombre" 
                               name="nombre" 
                               placeholder="Ej: Juan Pérez" 
                               required>
                    </div>
                </div>

                <div class="form-group-custom">
                    <label for="dni" class="form-label">
                        <i class="fas fa-id-card me-2"></i>DNI
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-id-card"></i>
                        <input type="text" 
                               class="form-control" 
                               id="dni" 
                               name="dni" 
                               placeholder="Número de identificación" 
                               maxlength="8"
                               required>
                    </div>
                </div>

                <div class="form-group-custom">
                    <label for="direccion" class="form-label">
                        <i class="fas fa-map-marker-alt me-2"></i>Dirección
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-location-dot"></i>
                        <input type="text" 
                               class="form-control" 
                               id="direccion" 
                               name="direccion" 
                               placeholder="Dirección de residencia" 
                               required>
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <a href="<?= site_url('clientes') ?>" class="btn-secondary-custom">
                            <i class="fas fa-times me-2"></i>Cancelar
                        </a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn-custom-primary">
                            <i class="fas fa-save me-2"></i>Guardar Cliente
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>