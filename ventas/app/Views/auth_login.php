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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        
        /* --- CORRECCIÓN DE INPUTS --- */
        .input-group-custom {
            position: relative;
            display: flex;
            align-items: center;
        }
        
        /* Icono de la izquierda (Usuario/Candado) */
        .input-group-custom > .fa-user, 
        .input-group-custom > .fa-lock {
            position: absolute;
            left: 15px;
            color: #6c757d;
            z-index: 5;
            pointer-events: none; /* Evita que el icono bloquee el click */
        }
        
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px !important;
            padding: 12px 45px 12px 45px; /* Espacio para iconos izq y der */
            transition: all 0.3s;
            font-size: 0.95rem;
            width: 100%;
            z-index: 1;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            z-index: 2;
        }

        /* Icono del Ojo (Derecha) */
        .password-toggle {
            position: absolute;
            right: 15px;
            cursor: pointer;
            color: #6c757d;
            z-index: 10; /* Asegura que esté por encima para recibir el click */
            padding: 10px; /* Aumenta el área de click del ojo */
            margin-right: -5px;
        }
        
        .password-toggle:hover {
            color: #667eea;
        }
        /* ---------------------------- */

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
            color: #842029;
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
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong>Error:</strong> <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('login/autenticar') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="mb-4">
                    <label class="form-label">Usuario</label>
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
                    <label class="form-label">Contraseña</label>
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