<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Venta</title>
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
        }
        .venta-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            text-align: center;
        }
        .venta-header h2 {
            margin: 0 0 20px 0;
            font-weight: 700;
        }
        .info-card {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .info-card .label {
            font-weight: 600;
            color: #6c757d;
            display: block;
            font-size: 0.875rem;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .info-card .value {
            font-size: 1.25rem;
            color: #212529;
            font-weight: 600;
        }
        .total-badge {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            font-size: 1.5rem;
            font-weight: bold;
            display: inline-block;
        }
        .table-custom {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .table-custom thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .table-custom tbody tr {
            transition: background-color 0.2s;
        }
        .table-custom tbody tr:hover {
            background-color: #f8f9fa;
        }
        .btn-back {
            background: #6c757d;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            transition: transform 0.2s;
        }
        .btn-back:hover {
            background: #5a6268;
            color: white;
            transform: translateY(-2px);
        }
        .section-title {
            color: #667eea;
            font-weight: 600;
            margin: 30px 0 20px 0;
            padding-bottom: 10px;
            border-bottom: 2px solid #667eea;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main-container">
            <div class="venta-header">
                <h2><i class="fas fa-receipt me-2"></i>Detalle de Venta #<?= $venta['id'] ?></h2>
                <div class="total-badge">
                    <i class="fas fa-money-bill-wave me-2"></i>Total: S/ <?= number_format($venta['total'], 2) ?>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="info-card">
                        <span class="label"><i class="fas fa-calendar me-2"></i>Fecha</span>
                        <span class="value"><?= $venta['fecha'] ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-card">
                        <span class="label"><i class="fas fa-user me-2"></i>Cliente</span>
                        <span class="value"><?= esc($venta['cliente'] ?? 'No especificado') ?></span>
                    </div>
                </div>
            </div>

            <h4 class="section-title">
                <i class="fas fa-box-open me-2"></i>Productos
            </h4>

            <div class="table-responsive">
                <table class="table table-custom table-hover align-middle">
                    <thead>
                        <tr>
                            <th><i class="fas fa-tag me-2"></i>Producto</th>
                            <th class="text-center"><i class="fas fa-list-ol me-2"></i>Cantidad</th>
                            <th class="text-end"><i class="fas fa-coins me-2"></i>Precio Unitario</th>
                            <th class="text-end"><i class="fas fa-calculator me-2"></i>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detalle as $d): ?>
                            <tr>
                                <td><?= esc($d['nombre']) ?></td>
                                <td class="text-center">
                                    <span class="badge bg-primary"><?= $d['cantidad'] ?></span>
                                </td>
                                <td class="text-end">S/ <?= number_format($d['precio_unitario'], 2) ?></td>
                                <td class="text-end fw-bold">S/ <?= number_format($d['subtotal'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-4 text-center">
                <a href="<?= site_url('historial') ?>" class="btn-back">
                    <i class="fas fa-arrow-left me-2"></i>Volver al Historial
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>