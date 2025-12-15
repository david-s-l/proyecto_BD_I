<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Adiasoft 2025</title>
    <!-- Solo carga el CSS de login, no el styles.css -->
    <link rel="stylesheet" href="<?= base_url ?>assets/css/login.css">
    <link rel="shortcut icon" href="<?=base_url?>assets/img/logo.jpg" />
</head>
<body class="login-page">

    <div class="login-container">
        
        <!-- Header -->
        <div class="login-header">
            <div class="login-logo">🔐</div>
            <h1 class="login-title">Adiasoft 2025</h1>
            <p class="login-subtitle">Sistema de Gestión Empresarial</p>
        </div>

        <!-- Body -->
        <div class="login-body">
            
            <!-- Alertas -->
            <?php if (isset($error)): ?>
                <div class="login-alert login-alert-danger">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <?php if (isset($success)): ?>
                <div class="login-alert login-alert-success">
                    <?= $success ?>
                </div>
            <?php endif; ?>

            <!-- Formulario -->
            <form method="POST" action="<?= base_url ?>usuario/login" id="loginForm">
                
                <div class="login-form-group">
                    <label for="username">Usuario</label>
                    <div class="login-input-wrapper">
                        <span class="login-input-icon">👤</span>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            class="login-form-control" 
                            placeholder="Ingresa tu usuario"
                            required
                            autofocus
                            value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
                    </div>
                </div>

                <div class="login-form-group">
                    <label for="password">Contraseña</label>
                    <div class="login-input-wrapper">
                        <span class="login-input-icon">🔒</span>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="login-form-control" 
                            placeholder="Ingresa tu contraseña"
                            required>
                    </div>
                </div>

                <div class="login-options">
                    <div class="login-remember">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Recordarme</label>
                    </div>
                    <a href="#" class="login-forgot">¿Olvidaste tu contraseña?</a>
                </div>

                <button type="submit" class="login-btn" id="btnLogin">
                    Iniciar Sesión
                </button>

            </form>
        </div>

        <!-- Footer -->
        <div class="login-footer">
            <p>&copy; 2025 Grupo MJD - Todos los derechos reservados</p>
        </div>

    </div>

    <script>
        // Efecto de loading en el botón
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('btnLogin');
            btn.classList.add('loading');
            btn.disabled = true;
        });
    </script>

</body>
</html>