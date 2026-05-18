<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION["user"])) { header("Location: /index.php"); exit; }

header('Content-Type: application/json; charset=utf-8');

// Función interna para blindar cadenas contra corrupciones UTF-8
function sanear_input_multibyte($str) {
    if (!is_string($str)) return $str;
    $str = trim($str);
    while (mb_detect_encoding($str, 'UTF-8', true) && (strpos($str, 'Ã©') !== false || strpos($str, 'Ã') !== false || strpos($str, 'Â') !== false)) {
        $str = mb_convert_encoding($str, 'ISO-8859-1', 'UTF-8');
    }
    return $str;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Captura y saneamiento estricto de campos
    $tipo_doc   = filter_input(INPUT_POST, 'tipo_documento', FILTER_SANITIZE_SPECIAL_CHARS);
    $num_doc    = filter_input(INPUT_POST, 'numero_documento', FILTER_SANITIZE_SPECIAL_CHARS);
    $nombre_raw = filter_input(INPUT_POST, 'nombre_completo', FILTER_SANITIZE_SPECIAL_CHARS);
    $fecha_nac  = filter_input(INPUT_POST, 'fecha_nacimiento', FILTER_SANITIZE_SPECIAL_CHARS);
    $alertas    = filter_input(INPUT_POST, 'alertas_iniciales', FILTER_SANITIZE_SPECIAL_CHARS);

    $nombre_completo = sanear_input_multibyte($nombre_raw);

    // 2. Validación de campos obligatorios
    if (!$tipo_doc || !$num_doc || !$nombre_completo || !$fecha_nac) {
        echo json_encode(['status' => 'error', 'message' => 'Faltan campos obligatorios en el formulario.']);
        exit;
    }

    // 3. Preparación de Metadatos JSONB de Alertas
    $json_alertas = json_encode([
        'alerta_discapacidad' => !empty($alertas) ? true : false,
        'descripcion_alerta' => $alertas,
        'usuario_registra' => $_SESSION["user"]["email"] ?? 'Sistema Core'
    ]);

    /* NOTA DE ARQUITECTURA: Aquí se ejecuta la conexión PDO con la base de datos:
    $stmt = $pdo->prepare("INSERT INTO estudiantes (tipo_documento, numero_documento, nombre_completo, fecha_nacimiento, historial_medico_alertas) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$tipo_doc, $num_doc, $nombre_completo, $fecha_nac, $json_alertas]);
    */

    // Respuesta simulada exitosa para desarrollo de la UI
    echo json_encode([
        'status' => 'success',
        'message' => 'Estudiante registrado con éxito en la HPI.',
        'uuid_generado' => bin2hex(random_bytes(16)), // Simulación de UUID v4
        'nombre_procesado' => $nombre_completo
    ]);
    exit;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
    exit;
}
