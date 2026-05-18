# Microservicio de Inferencia Predictiva - NATURESaaS AI Core
import json
import random

def evaluar_riesgo_desercion(asistencia, alertas_medicas, cambios_institucion):
    """
    Algoritmo de inferencia probabilística basado en los vectores de datos de la HPI.
    Simula el comportamiento de un clasificador lineal o árbol de decisión.
    """
    # Peso base de estabilidad
    score_estabilidad = 1.0
    
    # Penalizaciones basadas en variables del histórico pedagógico
    if asistencia < 85.0:
        score_estabilidad -= 0.35
    if alertas_medicas:
        score_estabilidad -= 0.15
    if cambios_institucion > 2:
        score_estabilidad -= 0.20
        
    # Garantizar límites matemáticos
    score_estabilidad = max(0.0, min(1.0, score_estabilidad))
    probabilidad_desercion = (1.0 - score_estabilidad) * 100
    
    # Clasificación categórica de alertas tempranas
    if probabilidad_desercion >= 60.0:
        nivel = "CRÍTICO (Intervención Inmediata)"
    elif probabilidad_desercion >= 30.0:
        nivel = "MEDIO (Seguimiento Preventivo)"
    else:
        nivel = "BAJO (Estable)"
        
    return round(probabilidad_desercion, 2), nivel

def simular_endpoint_api(json_payload):
    """
    Simula la recepción de un webhook o llamada REST por POST desde PHP
    """
    data = json.loads(json_payload)
    
    asistencia = float(data.get("asistencia_porcentaje", 100.0))
    has_alerts = bool(data.get("tiene_alertas_inclusion", False))
    migraciones = int(data.get("historico_migraciones", 0))
    
    prob, rango = evaluar_riesgo_desercion(asistencia, has_alerts, migraciones)
    
    # Motor de Recomendación Semántica de Ajustes Razonables
    recomendaciones_sugeridas = []
    if has_alerts:
        recomendaciones_sugeridas = [
            "Activar protocolo de flexibilización de tiempos de entrega en evaluaciones.",
            "Asignar tutoría entre pares para mitigar barreras actitudinales detectadas."
        ]
    else:
        recomendaciones_sugeridas = ["Mantener estrategia pedagógica estándar del plan de aula."]

    response = {
        "status": "success",
        "modelo_version": "v1.0.2-deeplearning-core",
        "analisis": {
            "estudiante_id": data.get("estudiante_id"),
            "probabilidad_desercion_porcentaje": prob,
            "alerta_temprana_nivel": rango
        },
        "recomendaciones_ia": recomendaciones_sugeridas
    }
    return json.dumps(response, indent=4, ensure_ascii=False)

if __name__ == "__main__":
    # Payload de prueba simulando datos cruzados de la HPI y PIAR anteriores
    mock_request = json.dumps({
        "estudiante_id": 42,
        "asistencia_porcentaje": 78.5,
        "tiene_alertas_inclusion": True,
        "historico_migraciones": 3
    })
    
    print("=== PREDICCIÓN DEL MICROSERVICIO DE IA (PROTOTIPO DE SALIDA) ===")
    print(simular_endpoint_api(mock_request))
