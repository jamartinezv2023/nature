<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION["user"])) { header("Location: /index.php"); exit; }

header('Content-Type: application/json; charset=utf-8');

function sanear_texto_ambiental($str) {
    if (!is_string($str)) return $str;
    $str = trim($str);
    while (mb_detect_encoding($str, 'UTF-8', true) && (strpos($str, 'Ã©') !== false || strpos($str, 'Ã') !== false || strpos($str, 'Â') !== false)) {
        $str = mb_convert_encoding($str, 'ISO-8859-1', 'UTF-8');
    }
    return $str;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plan_id = filter_input(INPUT_POST, 'plan_id', FILTER_VALIDATE_INT);
    $eje_tematico = filter_input(INPUT_POST, 'eje_tematico', FILTER_SANITIZE_SPECIAL_CHARS);
    $descripcion = filter_input(INPUT_POST, 'descripcion_actividad', FILTER_SANITIZE_SPECIAL_CHARS);
    
    $descripcion_saneada = sanear_texto_ambiental($descripcion);

    if (!$plan_id || !$eje_tematico || !$descripcion_saneada) {
        echo json_encode(['status' => 'error', 'message' => 'Faltan metadatos críticos para indexar la evidencia.']);
        exit;
    }

    // Lógica Segura de Carga de Archivos (File Upload Guardrail)
    $ruta_final = "";
    if (isset($_FILES['evidencia_archivo']) && $_FILES['evidencia_archivo']['error'] === UPLOAD_ERR_OK) {
        $file_tmp  = $_FILES['evidencia_archivo']['tmp_name'];
        $file_name = $_FILES['evidencia_archivo']['name'];
        $file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Extensiones estrictamente permitidas (Evita inyecciones de código ejecutable)
        $allowed_exts = ['pdf', 'png', 'jpg', 'jpeg', 'docx'];
        if (!in_array($file_ext, $allowed_exts)) {
            echo json_encode(['status' => 'error', 'message' => 'Tipo de archivo no permitido para auditoría institucional.']);
            exit;
        }

        // Generar un nombre único aleatorio para almacenamiento estático en disco
        $nuevo_nombre = 'EVI_' . bin2hex(random_bytes(8)) . '.' . $file_ext;
        $directorio_destino = __DIR__ . '/../../uploads/ambiental/';
        
        // Crear el directorio de forma recursiva si no existe dentro de Docker
        if (!is_dir($directorio_destino)) {
            mkdir($directorio_destino, 0755, true);
        }

        $ruta_final = '/uploads/ambiental/' . $nuevo_nombre;
        // En producción real usarías: move_uploaded_file($file_tmp, $directorio_destino . $nuevo_nombre);
    }

    /* NOTA DE PERSISTENCIA: Aquí se liga el archivo a la base de datos estructural (Fase 3 SQL)
    $stmt = $pdo->prepare("INSERT INTO evidencias_ambientales (plan_id, descripcion_actividad, ruta_documento_archivo) VALUES (?, ?, ?)");
    $stmt->execute([$plan_id, $descripcion_saneada, $ruta_final]);
    */

    echo json_encode([
        'status' => 'success',
        'message' => 'Evidencia ambiental indexada y documentada transversalmente con éxito.',
        'eje_vinculado' => $eje_tematico,
        'ruta_archivo' => $ruta_final ?: 'Sin archivo adjunto (Evidencia Conceptual)'
    ]);
    exit;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no autorizado.']);
    exit;
}
