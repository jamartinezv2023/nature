<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION["user"])) { header("Location: /index.php"); exit; }

header('Content-Type: application/json; charset=utf-8');

// Capturar el ID del alumno a analizar de forma segura
$estudiante_id = filter_input(INPUT_GET, 'estudiante_id', FILTER_VALIDATE_INT);

if (!$estudiante_id) {
    echo json_encode(['status' => 'error', 'message' => 'Identificador del estudiante inválido para análisis predictivo.']);
    exit;
}

// 1. En producción real, aquí consultarías los históricos consolidados en las Fases 1, 2 y 3:
// $datos_alumno = $pdo->query("SELECT ... WHERE id = $estudiante_id")->fetch();

// 2. Estructuración del vector de características (Feature Vector) para el modelo de Machine Learning
$feature_vector = [
    "estudiante_id" => $estudiante_id,
    "asistencia_porcentaje" => 74.2, // Dato simulado proveniente del control de asistencia
    "tiene_alertas_inclusion" => true, // Bandera extraída de las alertas de la HPI
    "historico_migraciones" => 2 // Extraído del historial de interoperabilidad de la base de datos
];

$json_payload = json_encode($feature_vector);

/* NOTA DE ENTORNO DISTRIBUIDO: En tu clúster de Docker, la llamada se realiza por HTTP REST:
$ch = curl_init('http://nature-ai-service:5000/predict');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_payload);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
$response = curl_exec($ch);
curl_close($ch);
*/

// Simulación de respuesta inmediata de la tubería de Python (Pipe de comunicación local para testing)
$cmd = "python3 " . escapeshellarg(__DIR__ . '/ia-service.py');
$output = shell_exec($cmd);

// Extraer el JSON de la salida limpia del script
$json_start = strpos($output, '{');
$json_clean = substr($output, $json_start);

echo $json_clean;
exit;
