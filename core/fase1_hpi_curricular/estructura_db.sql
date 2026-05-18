-- Base de Datos Optimizada para la Historia Pedagógica Interoperable (HPI)

CREATE TABLE IF NOT EXISTS instituciones (
    id_institucion SERIAL PRIMARY KEY,
    codigo_dane VARCHAR(50) UNIQUE NOT NULL,
    nombre_institucion VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS estudiantes (
    id_estudiante SERIAL PRIMARY KEY,
    uuid_hpi UUID UNIQUE NOT NULL DEFAULT gen_random_uuid(), -- Llave única nacional de interoperabilidad
    institucion_id INT REFERENCES instituciones(id_institucion) ON DELETE RESTRICT,
    tipo_documento VARCHAR(10) NOT NULL, -- CC, TI, RC, NES
    numero_documento VARCHAR(50) UNIQUE NOT NULL,
    nombre_completo VARCHAR(255) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    estado_academico VARCHAR(20) DEFAULT 'ACTIVO', -- ACTIVO, RETIRADO, GRADUADO
    historial_medico_alertas JSONB DEFAULT '{}'::jsonb, -- Alertas de salud o discapacidades iniciales
    creado_el TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS hpi_registro_historico (
    id_registro SERIAL PRIMARY KEY,
    estudiante_id INT REFERENCES estudiantes(id_estudiante) ON DELETE CASCADE,
    institucion_origen_id INT REFERENCES instituciones(id_institucion),
    año_lectivo INT NOT NULL,
    grado_cursado VARCHAR(20) NOT NULL,
    observacion_pedagógica TEXT,
    promovido BOOLEAN DEFAULT TRUE,
    registro_firmado_por VARCHAR(255) NOT NULL,
    metadata_curricular JSONB DEFAULT '{}'::jsonb -- Logros, notas agregadas o competencias
);

-- Índices estratégicos para búsquedas ultra rápidas en millones de registros
CREATE INDEX IF NOT EXISTS idx_estudiantes_documento ON estudiantes(numero_documento);
CREATE INDEX IF NOT EXISTS idx_estudiantes_uuid ON estudiantes(uuid_hpi);
CREATE INDEX IF NOT EXISTS idx_hpi_historico_estudiante ON hpi_registro_historico(estudiante_id);
