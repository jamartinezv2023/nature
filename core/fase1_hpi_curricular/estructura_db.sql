-- FASE 1: Esqueleto de interoperabilidad y gestión docente
CREATE TABLE estudiantes (
    id_estudiante SERIAL PRIMARY KEY,
    uuid_hpi UUID UNIQUE NOT NULL, -- Identificador Único de la Historia Pedagógica Interoperable
    nombre VARCHAR(255) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    metadata_interoperable JSONB -- Datos de transferencia nacional
);

CREATE TABLE planes_area (
    id_plan SERIAL PRIMARY KEY,
    docente_id INT NOT NULL,
    asignatura VARCHAR(100) NOT NULL,
    contenido_curricular TEXT NOT NULL
);
