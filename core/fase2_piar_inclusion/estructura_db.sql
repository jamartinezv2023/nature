-- FASE 2: Extensión de Inclusión (Decreto 1421)
CREATE TABLE piar_documentos (
    id_piar SERIAL PRIMARY KEY,
    estudiante_id INT REFERENCES estudiantes(id_estudiante) ON DELETE CASCADE,
    barreras_identificadas JSONB NOT NULL,
    ajustes_razonables JSONB NOT NULL,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
