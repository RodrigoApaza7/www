<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Producto</title>
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
            border-bottom: 3px solid #0d6efd;
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
        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-custom-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
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
        .input-icon .form-control, 
        .input-icon .form-select {
            padding-left: 45px;
        }
        .form-group-custom {
            margin-bottom: 25px;
        }
        .icon-header {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
                <i class="fas fa-plus-circle"></i>
            </div>
            
            <div class="page-header">
                <h2><i class="fas fa-box me-2"></i>Nuevo Producto</h2>
            </div>

            <form method="post" action="<?= site_url('productos/guardar') ?>">
                <?= csrf_field() ?>
                
                <div class="form-group-custom">
                    <label for="nombre" class="form-label">
                        <i class="fas fa-tag me-2"></i>Nombre del Producto
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-box"></i>
                        <input type="text" 
                               class="form-control" 
                               id="nombre" 
                               name="nombre" 
                               placeholder="Ingrese el nombre del producto" 
                               required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label for="precio" class="form-label">
                                <i class="fas fa-dollar-sign me-2"></i>Precio
                            </label>
                            <div class="input-icon">
                                <i class="fas fa-money-bill-wave"></i>
                                <input type="number" 
                                       step="0.01" 
                                       class="form-control" 
                                       id="precio" 
                                       name="precio" 
                                       placeholder="0.00" 
                                       required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label for="stock" class="form-label">
                                <i class="fas fa-cubes me-2"></i>Stock
                            </label>
                            <div class="input-icon">
                                <i class="fas fa-warehouse"></i>
                                <input type="number" 
                                       class="form-control" 
                                       id="stock" 
                                       name="stock" 
                                       placeholder="0" 
                                       required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group-custom">
                    <label for="categoria_id" class="form-label">
                        <i class="fas fa-folder me-2"></i>Categoría
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-list"></i>
                        <select class="form-select" id="categoria_id" name="categoria_id" required>
                            <option value="" disabled selected>Seleccione una categoría</option>
                            <?php foreach ($categorias as $c): ?>
                                <option value="<?= $c['id'] ?>">
                                    <?= esc($c['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <a href="<?= site_url('productos') ?>" class="btn-secondary-custom">
                            <i class="fas fa-arrow-left me-2"></i>Cancelar
                        </a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn-custom-primary">
                            <i class="fas fa-save me-2"></i>Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>