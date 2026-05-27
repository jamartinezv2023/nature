<?php
/**
 * NATURAE SaaS - Verificación de Doble Factor (Paso 2)
 * Algoritmo de Validación TOTP Nativo según RFC 6238
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

// Seguridad: Si no hay una pre-sesión pendiente de MFA, rebota al index
if (!isset($_SESSION['mfa_pendiente_usuario_id'])) {
    header("Location: /index.php");
    exit;
}

$error_msg = '';

// Procesar el formulario cuando se envía el código de 6 dígitos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = preg_replace('/\s+/', '', $_POST['codigo'] ?? ''); // Quitar espacios

    try {
        // 1. Recuperar el secreto 2FA del usuario guardado en la DB de Docker
        $stmt = $pdo->prepare("SELECT id, tenant_id, nombre, email, two_factor_secret FROM usuarios WHERE id = ? LIMIT 1");
        $stmt->execute([$_SESSION['mfa_pendiente_usuario_id']]);
        $usuario = $stmt->fetch();

        if ($usuario) {
            $secret = $usuario['two_factor_secret'];
            
            // 2. ALGORITMO DE VERIFICACIÓN TOTP (Decodificación Base32 y Hash HMAC-SHA1)
            $base32chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
            $base32charsFlipped = array_flip(str_split($base32chars));
            
            $secretUpper = strtoupper($secret);
            $secretCharCount = strlen($secretUpper);
            $binarySecret = "";
            
            for ($i = 0; $i < $secretCharCount; $i = $i + 8) {
                $x = "";
                if (!isset($base32charsFlipped[$secretUpper[$i]])) continue;
                for ($j = 0; $j < 8; $j++) {
                    $x .= str_pad(decbin($base32charsFlipped[$secretUpper[$i + $j]]), 5, '0', STR_PAD_LEFT);
                }
                $eightBits = str_split($x, 8);
                for ($z = 0; $z < count($eightBits); $z++) {
                    if (strlen($eightBits[$z]) == 8) {
                        $binarySecret .= chr(bindec($eightBits[$z]));
                    }
                }
            }

            // Calcular el intervalo de tiempo actual (Ventana de 30 segundos)
            $timeSlice = floor(time() / 30);
            $codigoValido = false;

            // Tolerancia de ±1 intervalo de tiempo para absorber retrasos de reloj del celular
            for ($i = -1; $i <= 1; $i++) {
                $calculatedTime = $timeSlice + $i;
                $timePad = str_pad(pack('N', $calculatedTime), 8, "\0", STR_PAD_LEFT);
                $hash = hash_hmac('sha1', $timePad, $binarySecret, true);
                $offset = ord($hash[19]) & 0xf;
                $calculatedCode = (
                    ((ord($hash[$offset+0]) & 0x7f) << 24) |
                    ((ord($hash[$offset+1]) & 0xff) << 16) |
                    ((ord($hash[$offset+2]) & 0xff) << 8) |
                    (ord($hash[$offset+3]) & 0xff)
                ) % 1000000;
                
                if (str_pad($calculatedCode, 6, '0', STR_PAD_LEFT) === $codigo) {
                    $codigoValido = true;
                    break;
                }
            }

            // 3. Evaluar el resultado matemático del Token
            if ($codigoValido) {
                // Promover pre-sesión a sesión legítima del sistema
                $_SESSION['user'] = [
                    'id'     => $usuario['id'],
                    'nombre' => $usuario['nombre'],
                    'email'  => $usuario['email']
                ];
                $_SESSION['tenant_id'] = $usuario['tenant_id'];

                // Limpiar banderas temporales de control
                unset($_SESSION['mfa_pendiente_usuario_id']);
                unset($_SESSION['mfa_pendiente_tenant_id']);

                // Registrar en log de auditoría (3FN)
                $stmtLog = $pdo->prepare("INSERT INTO audit_log (tenant_id, usuario_id, accion, ip) VALUES (?, ?, 'LOGIN_MFA_EXITOSO', ?)");
                $stmtLog->execute([$usuario['tenant_id'], $usuario['id'], $_SERVER['REMOTE_ADDR']]);

                header("Location: /dashboard");
                exit;
            } else {
                $error_msg = "Código de verificación incorrecto o expirado.";
            }
        } else {
            header("Location: /index.php");
            exit;
        }
    } catch (\Exception $e) {
        error_log("Error en Verificación 2FA: " . $e->getMessage());
        $error_msg = "Error interno de validación.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>NATURE SaaS - Autenticación de Doble Factor</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f4f6f9; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
        .card { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 100%; max-width: 400px; text-align: center; }
        h2 { color: #2c3e50; margin-bottom: 10px; }
        p { color: #7f8c8d; font-size: 14px; margin-bottom: 20px; }
        input[type="text"] { width: 90%; padding: 12px; font-size: 18px; text-align: center; letter-spacing: 4px; border: 2px solid #cbd5e1; border-radius: 6px; margin-bottom: 15px; }
        input[type="text"]:focus { border-color: #3498db; outline: none; }
        button { background: #27ae60; color: white; border: none; padding: 12px; width: 97%; border-radius: 6px; font-size: 16px; cursor: pointer; font-weight: bold; }
        button:hover { background: #219653; }
        .error { color: #e74c3c; font-size: 13px; margin-bottom: 15px; text-align: left; background: #fdedec; padding: 10px; border-radius: 4px; border-left: 4px solid #e74c3c; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Verificación de Seguridad</h2>
        <p>Introduce el código de 6 dígitos generado por tu aplicación de autenticación para acceder a tu cuenta Enterprise.</p>
        
        <?php if (!empty($error_msg)): ?>
            <div class="error"><?= htmlspecialchars($error_msg); ?></div>
        <?php endif; ?>

        <form action="verificar-2fa.php" method="POST" autocomplete="off">
            <input type="text" name="codigo" placeholder="000000" maxlength="6" required autofocus autocomplete="one-time-code">
            <button type="submit">Verificar Código</button>
        </form>
    </div>
</body>
</html>
