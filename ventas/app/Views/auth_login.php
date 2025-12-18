<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Sistema de Ventas</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
        }
        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        .login-header i {
            font-size: 3rem;
            margin-bottom: 15px;
        }
        .login-header h3 {
            margin: 0;
            font-weight: 700;
            font-size: 1.8rem;
        }
        .login-header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
            font-size: 0.95rem;
        }
        .login-body {
            padding: 40px 35px;
        }
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }
        .input-group-custom {
            position: relative;
            margin-bottom: 25px;
        }
        .input-group-custom i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 10;
        }
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px 12px 45px;
            transition: all 0.3s;
            font-size: 0.95rem;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 14px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.05rem;
            transition: transform 0.2s;
            width: 100%;
            margin-top: 10px;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }
        .alert-custom {
            border-radius: 10px;
            border: none;
            padding: 15px;
            margin-bottom: 25px;
            background: #fee;
            border-left: 4px solid #dc3545;
        }
        .alert-custom i {
            margin-right: 8px;
        }
        .register-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 2px solid #f0f0f0;
        }
        .register-link a {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }
        .register-link a:hover {
            color: #764ba2;
            text-decoration: underline;
        }
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            z-index: 10;
        }
        .password-toggle:hover {
            color: #667eea;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <i class="fas fa-shopping-cart"></i>
            <h3>Sistema de Ventas</h3>
            <p>Ingresa tus credenciales para continuar</p>
        </div>

        <div class="login-body">
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert-custom">
                    <i class="fas fa-exclamation-circle"></i>
                    <strong>Error:</strong> <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('login/autenticar') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="mb-4">
                    <label class="form-label">
                        <i class="fas fa-user me-1"></i>Usuario
                    </label>
                    <div class="input-group-custom">
                        <i class="fas fa-user"></i>
                        <input type="text" 
                               class="form-control" 
                               name="usuario" 
                               placeholder="Ingresa tu usuario"
                               required
                               autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        <i class="fas fa-lock me-1"></i>Contraseña
                    </label>
                    <div class="input-group-custom">
                        <i class="fas fa-lock"></i>
                        <input type="password" 
                               class="form-control" 
                               id="password"
                               name="password" 
                               placeholder="Ingresa tu contraseña"
                               required>
                        <i class="fas fa-eye password-toggle" 
                           id="togglePassword"
                           onclick="togglePasswordVisibility()"></i>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Ingresar al Sistema
                </button>

                <div class="register-link">
                    <p class="mb-0">
                        ¿No tienes cuenta? 
                        <a href="<?= site_url('registro') ?>">
                            <i class="fas fa-user-plus me-1"></i>Registrarse aquí
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePassword');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>