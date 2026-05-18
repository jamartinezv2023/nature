-- FASE 3: Gestión Transversal Ambiental
CREATE TABLE evidencias_ambientales (
    id_evidencia SERIAL PRIMARY KEY,
    plan_id INT REFERENCES planes_area(id_plan),
    descripcion_actividad TEXT NOT NULL,
    ruta_documento_archivo VARCHAR(512),
    fecha_registro DATE DEFAULT CURRENT_DATE
);
