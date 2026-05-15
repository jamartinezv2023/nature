SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS usuario_roles;
DROP TABLE IF EXISTS permisos_roles;
DROP TABLE IF EXISTS permisos;
DROP TABLE IF EXISTS roles;
DROP TABLE IF EXISTS sesiones;
DROP TABLE IF EXISTS audit_log;
DROP TABLE IF EXISTS evidencia_archivos;
DROP TABLE IF EXISTS evidencias;
DROP TABLE IF EXISTS areas;
DROP TABLE IF EXISTS grados;
DROP TABLE IF EXISTS jornadas;
DROP TABLE IF EXISTS sedes;
DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS tenants;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE tenants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    dominio VARCHAR(150) UNIQUE,
    estado ENUM('ACTIVO','INACTIVO') DEFAULT 'ACTIVO',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE roles (
    id TINYINT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) UNIQUE NOT NULL,
    descripcion VARCHAR(255)
);

CREATE TABLE permisos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(100) UNIQUE NOT NULL,
    descripcion VARCHAR(255)
);

CREATE TABLE permisos_roles (
    rol_id TINYINT NOT NULL,
    permiso_id INT NOT NULL,
    PRIMARY KEY (rol_id, permiso_id),
    FOREIGN KEY (rol_id) REFERENCES roles(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (permiso_id) REFERENCES permisos(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tenant_id INT NOT NULL,
    nombre VARCHAR(150) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    telefono VARCHAR(20),
    direccion VARCHAR(255),
    password_hash VARCHAR(255) NOT NULL,
    avatar VARCHAR(255),
    estado ENUM('ACTIVO','INACTIVO') DEFAULT 'ACTIVO',
    debe_cambiar_password TINYINT(1) DEFAULT 1,
    twofa_enabled TINYINT(1) DEFAULT 0,
    ultimo_login DATETIME NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_usuarios_tenant
        FOREIGN KEY (tenant_id)
        REFERENCES tenants(id)
        ON UPDATE CASCADE
);

CREATE TABLE usuario_roles (
    usuario_id INT NOT NULL,
    rol_id TINYINT NOT NULL,
    PRIMARY KEY (usuario_id, rol_id),

    FOREIGN KEY (usuario_id)
        REFERENCES usuarios(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    FOREIGN KEY (rol_id)
        REFERENCES roles(id)
        ON UPDATE CASCADE
);

CREATE TABLE sedes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tenant_id INT NOT NULL,
    nombre VARCHAR(150) NOT NULL,
    direccion VARCHAR(255),
    telefono VARCHAR(20),
    lat DECIMAL(10,6),
    lng DECIMAL(10,6),

    FOREIGN KEY (tenant_id)
        REFERENCES tenants(id)
        ON UPDATE CASCADE
);

CREATE TABLE jornadas (
    id TINYINT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) UNIQUE NOT NULL
);

CREATE TABLE grados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tenant_id INT NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    orden_grado INT NOT NULL,

    FOREIGN KEY (tenant_id)
        REFERENCES tenants(id)
        ON UPDATE CASCADE
);

CREATE TABLE areas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tenant_id INT NOT NULL,
    nombre VARCHAR(150) NOT NULL,

    FOREIGN KEY (tenant_id)
        REFERENCES tenants(id)
        ON UPDATE CASCADE
);

CREATE TABLE evidencias (
    id INT AUTO_INCREMENT PRIMARY KEY,

    tenant_id INT NOT NULL,
    usuario_id INT NOT NULL,

    area_id INT,
    grado_id INT,
    sede_id INT,
    jornada_id TINYINT,

    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT,

    fecha DATETIME,

    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (tenant_id)
        REFERENCES tenants(id),

    FOREIGN KEY (usuario_id)
        REFERENCES usuarios(id),

    FOREIGN KEY (area_id)
        REFERENCES areas(id)
        ON DELETE SET NULL,

    FOREIGN KEY (grado_id)
        REFERENCES grados(id)
        ON DELETE SET NULL,

    FOREIGN KEY (sede_id)
        REFERENCES sedes(id)
        ON DELETE SET NULL,

    FOREIGN KEY (jornada_id)
        REFERENCES jornadas(id)
        ON DELETE SET NULL
);

CREATE TABLE evidencia_archivos (
    id INT AUTO_INCREMENT PRIMARY KEY,

    evidencia_id INT NOT NULL,

    tipo ENUM(
        'DOCUMENTO',
        'IMAGEN',
        'AUDIO',
        'VIDEO',
        'OTRO'
    ) DEFAULT 'OTRO',

    ruta VARCHAR(255) NOT NULL,

    nombre_original VARCHAR(255),

    mime_type VARCHAR(120),

    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (evidencia_id)
        REFERENCES evidencias(id)
        ON DELETE CASCADE
);

CREATE TABLE sesiones (
    id INT AUTO_INCREMENT PRIMARY KEY,

    usuario_id INT NOT NULL,

    token VARCHAR(255) UNIQUE NOT NULL,

    ip VARCHAR(45),

    user_agent TEXT,

    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    expira_en DATETIME,

    revocada TINYINT(1) DEFAULT 0,

    FOREIGN KEY (usuario_id)
        REFERENCES usuarios(id)
        ON DELETE CASCADE
);

CREATE TABLE audit_log (
    id INT AUTO_INCREMENT PRIMARY KEY,

    tenant_id INT,

    usuario_id INT,

    accion VARCHAR(255) NOT NULL,

    ip VARCHAR(45),

    user_agent TEXT,

    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (tenant_id)
        REFERENCES tenants(id)
        ON DELETE SET NULL,

    FOREIGN KEY (usuario_id)
        REFERENCES usuarios(id)
        ON DELETE SET NULL
);

INSERT INTO tenants
(nombre, dominio)
VALUES
(
    'Institución Educativa Sagrada Familia',
    'sagradafamiliapalmira.edu.co'
);

INSERT INTO roles
(nombre, descripcion)
VALUES
('SUPERADMIN', 'Administrador global'),
('ADMIN', 'Administrador institucional'),
('DOCENTE', 'Docente del sistema');

INSERT INTO permisos
(codigo, descripcion)
VALUES
('ALL_ACCESS', 'Acceso total al sistema'),
('GESTION_USUARIOS', 'Administrar usuarios'),
('GESTION_EVIDENCIAS', 'Administrar evidencias'),
('GESTION_REPORTES', 'Administrar reportes');

INSERT INTO permisos_roles
(rol_id, permiso_id)
SELECT
    1,
    id
FROM permisos;

INSERT INTO jornadas
(nombre)
VALUES
('Mañana'),
('Tarde'),
('Única');

INSERT INTO sedes
(
    tenant_id,
    nombre,
    direccion
)
VALUES
(1,'Sagrada Familia','Palmira'),
(1,'María Montessori','Palmira'),
(1,'El Paraíso','Palmira');

INSERT INTO grados
(tenant_id, nombre, orden_grado)
VALUES
(1,'1°',1),
(1,'2°',2),
(1,'3°',3),
(1,'4°',4),
(1,'5°',5),
(1,'6°',6),
(1,'7°',7),
(1,'8°',8),
(1,'9°',9),
(1,'10°',10),
(1,'11°',11);

INSERT INTO areas
(tenant_id, nombre)
VALUES
(1,'Matemáticas'),
(1,'Lengua Castellana'),
(1,'Ciencias Naturales'),
(1,'Ciencias Sociales'),
(1,'Tecnología e Informática');

