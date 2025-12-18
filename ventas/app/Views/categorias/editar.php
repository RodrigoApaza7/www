<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría</title>
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
            max-width: 600px;
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
        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s;
        }
        .form-control:focus, .form-select:focus {
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
            transition: transform 0.2s;
            width: 100%;
        }
        .btn-custom-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
            color: #000;
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
            background: #e7f3ff;
            border-left: 4px solid #0d6efd;
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .info-badge strong {
            color: #0d6efd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main-container">
            <div class="icon-header">
                <i class="fas fa-edit"></i>
            </div>
            
            <div class="page-header">
                <h2><i class="fas fa-tag me-2"></i>Editar Categoría</h2>
            </div>

            <div class="info-badge">
                <i class="fas fa-info-circle me-2"></i>
                <strong>ID:</strong> <?= $categoria['id'] ?>
            </div>

            <form method="post" action="<?= site_url('categorias/actualizar/'.$categoria['id']) ?>">
                <div class="form-group-custom">
                    <label for="nombre" class="form-label">
                        <i class="fas fa-font me-2"></i>Nombre de la Categoría
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-tag"></i>
                        <input type="text" 
                               class="form-control" 
                               id="nombre" 
                               name="nombre" 
                               value="<?= esc($categoria['nombre']) ?>" 
                               placeholder="Ingrese el nombre de la categoría" 
                               required>
                    </div>
                </div>

                <div class="form-group-custom">
                    <label for="estado" class="form-label">
                        <i class="fas fa-toggle-on me-2"></i>Estado
                    </label>
                    <select class="form-select" id="estado" name="estado" required>
                        <option value="1" <?= $categoria['estado'] == 1 ? 'selected' : '' ?>>
                            ✓ Activa
                        </option>
                        <option value="0" <?= $categoria['estado'] == 0 ? 'selected' : '' ?>>
                            ✗ Inactiva
                        </option>
                    </select>
                </div>

                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <a href="<?= site_url('categorias') ?>" class="btn-secondary-custom">
                            <i class="fas fa-arrow-left me-2"></i>Cancelar
                        </a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn-custom-warning">
                            <i class="fas fa-sync-alt me-2"></i>Actualizar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>