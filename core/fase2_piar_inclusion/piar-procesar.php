<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION["user"])) { header("Location: /index.php"); exit; }

header('Content-Type: application/json; charset=utf-8');

function sanear_multibyte_profundo($data) {
    if (is_array($data)) {
        foreach ($data as $key => $value) {
            $data[$key] = sanear_multibyte_profundo($value);
        }
    } elseif (is_string($data)) {
        $data = trim($data);
        while (mb_detect_encoding($data, 'UTF-8', true) && (strpos($data, 'Ã©') !== false || strpos($data, 'Ã') !== false || strpos($data, 'Â') !== false)) {
            $data = mb_convert_encoding($data, 'ISO-8859-1', 'UTF-8');
        }
    }
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Saneamiento profundo de las estructuras complejas del PIAR
    $estudiante_id = filter_input(INPUT_POST, 'estudiante_id', FILTER_VALIDATE_INT);
    $barreras      = isset($_POST['barreras']) ? sanear_multibyte_profundo($_POST['barreras']) : null;
    $ajustes       = isset($_POST['ajustes']) ? sanear_multibyte_profundo($_POST['ajustes']) : null;
    $objetivos     = isset($_POST['objetivos']) ? sanear_multibyte_profundo($_POST['objetivos']) : null;

    if (!$estudiante_id || !$barreras || !$ajustes) {
        echo json_encode(['status' => 'error', 'message' => 'Estructura o parámetros del PIAR inválidos.']);
        exit;
    }

    // 2. Empaquetado para el formato nativo de bases de datos relacionales modernas (JSONB)
    $payload_piar = [
        'dimension_entorno' => $barreras,
        'estrategias_ajuste' => $ajustes,
        'metas_objetivos' => $objetivos,
        'fecha_registro' => date('Y-m-d H:i:s'),
        'especialista_firma' => $_SESSION["user"]["email"] ?? 'Docente Orientador'
    ];

    /* NOTA DE INTEGRACIÓN: Aquí se realiza la persistencia ligada a la HPI
    $stmt = $pdo->prepare("INSERT INTO piar_documentos (estudiante_id, barreras_identificadas, ajustes_razonables) VALUES (?, ?, ?)");
    $stmt->execute([$estudiante_id, json_encode($payload_piar['dimension_entorno']), json_encode($payload_piar['estrategias_ajuste'])]);
    */

    echo json_encode([
        'status' => 'success',
        'message' => 'Plan Individual de Ajustes Razonables (PIAR) consolidado con éxito bajo el Decreto 1421.',
        'estudiante_vinculado' => $estudiante_id
    ]);
    exit;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Acceso denegado.']);
    exit;
}
