<?php
/**
 * NATURAE SaaS - Puerta de Entrada / Login Inicial
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_lifetime' => 86400,
        'cookie_secure'   => false,
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax'
    ]);
}

// Si ya tiene una sesión legítima activa, saltarse el login e ir al Dashboard
if (isset($_SESSION['user'])) {
    header("Location: /dashboard.php");
    exit;
}

// Mapeo de errores semánticos para el usuario
$error = $_GET['error'] ?? '';
$mensaje_error = '';

if ($error === 'campos_vacios') {
    $mensaje_error = 'Por favor, rellene todos los campos obligatorios.';
} elseif ($error === 'credenciales_invalidas') {
    $mensaje_error = 'El correo electrónico o la contraseña son incorrectos.';
} elseif ($error === 'error_interno') {
    $mensaje_error = 'Ocurrió un problema en el servidor. Inténtelo más tarde.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NATURAE SaaS - Acceso al Sistema</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #eef2f3; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
        .login-container { background: #ffffff; padding: 40px; border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); width: 100%; max-width: 420px; box-sizing: border-box; }
        .logo-area { text-align: center; margin-bottom: 30px; }
        .logo-area h1 { margin: 0; color: #2c3e50; font-size: 28px; font-weight: 700; letter-spacing: -0.5px; }
        .logo-area span { color: #27ae60; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; color: #34495e; font-size: 14px; font-weight: 600; }
        input[type="email"], input[type="password"] { width: 100%; padding: 12px; border: 1px solid #dcdde1; border-radius: 6px; box-sizing: border-box; font-size: 15px; transition: border-color 0.3s ease; }
        input[type="email"]:focus, input[type="password"]:focus { border-color: #27ae60; outline: none; }
        button { background: #27ae60; color: #ffffff; border: none; width: 100%; padding: 14px; border-radius: 6px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background 0.3s ease; }
        button:hover { background: #219653; }
        .alert { background: #fdedec; color: #e74c3c; padding: 12px; border-radius: 6px; border-left: 4px solid #e74c3c; font-size: 14px; margin-bottom: 20px; }
    </style>
</head>
<body>

<div class="login-container">
    <div class="logo-area">
        <h1>NATURE<span>SaaS</span></h1>
    </div>

    <?php if (!empty($mensaje_error)): ?>
        <div class="alert">
            <?= htmlspecialchars($mensaje_error); ?>
        </div>
    <?php endif; ?>

    <form action="login-proceso.php" method="POST" autocomplete="off">
        <div class="form-group">
            <label for="email">Correo Electrónico Institucional</label>
            <input type="email" id="email" name="email" required autofocus placeholder="ejemplo@institucion.edu.co">
        </div>
        
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required placeholder="••••••••••••">
        </div>

        <button type="submit">Iniciar Sesión Segura</button>
    </form>
</div>

</body>
</html>
