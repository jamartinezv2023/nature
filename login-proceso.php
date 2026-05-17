<?php
/**
 * NATURAE SaaS - Controlador de Autenticación (Paso 1)
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_lifetime' => 86400,
        'cookie_secure'   => false, 
        'cookie_httponly' => true,  
        'cookie_samesite' => 'Lax'
    ]);
}

require_once __DIR__ . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /index.php");
    exit;
}

$email    = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    header("Location: /index.php?error=campos_vacios");
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT id, tenant_id, nombre, email, password_hash, estado, twofa_enabled FROM usuarios WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if (!$usuario || $usuario['estado'] !== 'ACTIVO') {
        header("Location: /index.php?error=credenciales_invalidas");
        exit;
    }

    if (!password_verify($password, $usuario['password_hash'])) {
        header("Location: /index.php?error=credenciales_invalidas");
        exit;
    }

    if ($usuario['twofa_enabled'] == 1) {
        $_SESSION['mfa_pendiente_usuario_id'] = $usuario['id'];
        $_SESSION['mfa_pendiente_tenant_id']  = $usuario['tenant_id'];
        header("Location: /verificar-2fa.php");
        exit;
    } else {
        $_SESSION['user']      = ['id' => $usuario['id'], 'nombre' => $usuario['nombre'], 'email' => $usuario['email']];
        $_SESSION['tenant_id'] = $usuario['tenant_id'];

        $stmtLog = $pdo->prepare("INSERT INTO audit_log (tenant_id, usuario_id, accion, ip) VALUES (?, ?, 'LOGIN_DIRECTO_EXITOSO', ?)");
        $stmtLog->execute([$usuario['tenant_id'], $usuario['id'], $_SERVER['REMOTE_ADDR']]);

        header("Location: /dashboard.php");
        exit;
    }
} catch (\Exception $e) {
    error_log("Error en Login: " . $e->getMessage());
    header("Location: /index.php?error=error_interno");
    exit;
}
