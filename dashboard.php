<?php
/**
 * NATURAE SaaS - Dashboard de Control Principal (Producción)
 * Resiliente a Sesiones Multi-Tenant e Infraestructura Docker
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_lifetime' => 86400,
        'cookie_secure'   => false,
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax'
    ]);
}

// Control de Acceso Estricto: Si no hay sesión válida, se expulsa inmediatamente
if (!isset($_SESSION['user'])) {
    header("Location: /index.php");
    exit;
}

require_once __DIR__ . '/config/database.php';

$user = $_SESSION['user'];
$tenant_id = $_SESSION['tenant_id'] ?? 1; // Segmentación por Tenant

try {
    // 1. Contador de Usuarios Activos en el Tenant
    $stmtUsers = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE tenant_id = ? AND estado = 'ACTIVO'");
    $stmtUsers->execute([$tenant_id]);
    $totalUsuarios = $stmtUsers->fetchColumn();

    // 2. Contador Global de Sedes vinculadas al Tenant
    $stmtSedes = $pdo->prepare("SELECT COUNT(*) FROM sedes WHERE tenant_id = ?");
    $stmtSedes->execute([$tenant_id]);
    $totalSedes = $stmtSedes->fetchColumn();

    // 3. Contador de Sesiones Activas Globales y No Revocadas en el ecosistema
    $stmtSesiones = $pdo->prepare("SELECT COUNT(*) FROM sesiones WHERE revocada = 0 AND expira_en > NOW()");
    $stmtSesiones->execute();
    $totalSesiones = $stmtSesiones->fetchColumn();

} catch (\Exception $e) {
    error_log("Error al cargar métricas del Dashboard: " . $e->getMessage());
    $totalUsuarios = 0;
    $totalSedes = 0;
    $totalSesiones = 0;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NATURE SaaS - Panel de Administración</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f8fafc; margin: 0; color: #1e293b; }
        header { background: #ffffff; padding: 15px 30px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; }
        header h1 { margin: 0; font-size: 22px; color: #0f172a; }
        header h1 span { color: #27ae60; }
        .user-info { font-size: 14px; color: #64748b; }
        .user-info strong { color: #0f172a; }
        .logout-btn { color: #ef4444; text-decoration: none; margin-left: 15px; font-weight: 600; }
        .container { max-width: 1200px; margin: 40px auto; padding: 0 20px; }
        .welcome-box { background: #ffffff; padding: 25px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.02); border: 1px solid #e2e8f0; margin-bottom: 30px; }
        .welcome-box h2 { margin: 0 0 10px 0; color: #0f172a; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; }
        .stat-card { background: #ffffff; padding: 25px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.02); border: 1px solid #e2e8f0; border-top: 4px solid #27ae60; }
        .stat-card h3 { margin: 0 0 10px 0; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; }
        .stat-card span { font-size: 32px; font-weight: 700; color: #0f172a; display: block; }
    </style>
</head>
<body>

<header>
    <h1>NATURE<span>SaaS</span> Panel</h1>
    <div class="user-info">
        Usuario: <strong><?= htmlspecialchars($user['nombre']); ?></strong> (Tenant ID: <?= htmlspecialchars($tenant_id); ?>)
        <a href="/logout.php" class="logout-btn">Cerrar Sesión</a>
    </div>
</header>

<div class="container">
    <div class="welcome-box">
        <h2>¡Bienvenido de vuelta, <?= htmlspecialchars($user['nombre']); ?>!</h2>
        <p style="margin: 0; color: #64748b;">Infraestructura de datos conectada en estricta Tercera Forma Normal (3FN). Datos procesados en tiempo real desde el contenedor Docker.</p>
    </div>

    <section class="stats-grid">
        <div class="stat-card">
            <h3>Usuarios Activos</h3>
            <span><?= number_format($totalUsuarios); ?></span>
        </div>

        <div class="stat-card">
            <h3>Sedes Institucionales</h3>
            <span><?= number_format($totalSedes); ?></span>
        </div>

        <div class="stat-card">
            <h3>Sesiones Activas</h3>
            <span><?= number_format($totalSesiones); ?></span>
        </div>

        <div class="stat-card">
            <h3>Precisión IA</h3>
            <span>98.4%</span>
        </div>
    </section>
</div>

</body>
</html>
