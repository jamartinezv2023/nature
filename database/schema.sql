-- ============================================================================
-- ECOSISTEMA NATURE SaaS - ESTRUCTURA DE DATOS EN TERCERA FORMA NORMAL (3FN)
-- Conforme al Estándar IEEE 730 y Aseguramiento de Calidad de Software
-- ============================================================================

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `historial_pedagogico`;
DROP TABLE IF EXISTS `piar_documents`;
DROP TABLE IF EXISTS `students`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `tenants`;
SET FOREIGN_KEY_CHECKS = 1;

-- 1. TABLA: TENANTS (Aislamiento de la Institución Educativa)
CREATE TABLE `tenants` (
    `id` VARCHAR(50) NOT NULL,
    `nombre_institucional` VARCHAR(150) NOT NULL,
    `resolucion_dane` VARCHAR(50) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uidx_dane` (`resolucion_dane`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. TABLA: USERS (Docentes y Personal Administrativo - Depende de Tenants)
CREATE TABLE `users` (
    `id` VARCHAR(36) NOT NULL,
    `tenant_id` VARCHAR(50) NOT NULL,
    `email` VARCHAR(191) NOT NULL,
    `password_hash` VARCHAR(255) NOT NULL,
    `two_factor_secret` VARCHAR(100) DEFAULT NULL,
    `is_two_factor_enabled` TINYINT(1) NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uidx_tenant_email` (`tenant_id`, `email`),
    CONSTRAINT `fk_users_tenant` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. TABLA: STUDENTS (Datos del Alumno - Se extrae del PIAR para cumplir 3FN)
CREATE TABLE `students` (
    `id` VARCHAR(36) NOT NULL,
    `tenant_id` VARCHAR(50) NOT NULL,
    `documento_identidad` VARCHAR(30) NOT NULL,
    `tipo_documento` VARCHAR(10) NOT NULL,
    `nombres` VARCHAR(100) NOT NULL,
    `apellidos` VARCHAR(100) NOT NULL,
    `fecha_nacimiento` DATE NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uidx_tenant_student` (`tenant_id`, `tipo_documento`, `documento_identidad`),
    CONSTRAINT `fk_students_tenant` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. TABLA: PIAR_DOCUMENTS (Formularios Enriquecidos de Ajustes Razonables)
-- Cumple 3FN: No guarda datos del estudiante ni de la institución, solo referencias (FK)
CREATE TABLE `piar_documents` (
    `id` VARCHAR(36) NOT NULL,
    `student_id` VARCHAR(36) NOT NULL,
    `created_by_user_id` VARCHAR(36) NOT NULL,
    `año_lectivo` INT NOT NULL,
    `ajustes_curriculares` TEXT NOT NULL,
    `estado` VARCHAR(30) NOT NULL DEFAULT 'EN_IMPLEMENTACION' COMMENT 'Estados: EN_IMPLEMENTACION, SINCRONIZADO',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uidx_student_year` (`student_id`, `año_lectivo`),
    CONSTRAINT `fk_piar_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_piar_user` FOREIGN KEY (`created_by_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. TABLA: HISTORIAL_PEDAGOGICO (Historia Pedagógica Interoperable - HPI)
CREATE TABLE `historial_pedagogico` (
    `id` VARCHAR(36) NOT NULL,
    `student_id` VARCHAR(36) NOT NULL,
    `tenant_origen_id` VARCHAR(50) NOT NULL,
    `descripcion_evento` TEXT NOT NULL,
    `fecha_registro` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_hpi_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_hpi_tenant` FOREIGN KEY (`tenant_origen_id`) REFERENCES `tenants` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ============================================================================
-- INSERCIÓN DE DATOS SEMILLA (REGISTROS BASE EN CORRESPONDENCIA CON EL MODELO)
-- ============================================================================

-- Registrar Tenant de Prueba
INSERT INTO `tenants` (`id`, `nombre_institucional`, `resolucion_dane`)
VALUES ('IE_TECNICO_INDUSTRIAL', 'Institución Educativa Técnico Industrial', '176001000234');

-- Registrar Usuario/Docente Asociado al Tenant (Contraseña: password123)
INSERT INTO `users` (`id`, `tenant_id`, `email`, `password_hash`, `two_factor_secret`, `is_two_factor_enabled`)
VALUES (
    'u4321-uuid-ejemplo-nature-0001', 
    'IE_TECNICO_INDUSTRIAL', 
    'docente@institucion.edu.co', 
    '$2y$10$7R9bZ2p8Eub2MhW6o9vRKeZp3jE8P3X9G7vD0fS1A6K2L3M4N5O6P', 
    'JBSWY3DPEHPK3PXP', 
    1
);

-- Registrar Estudiante Base asociado al Tenant
INSERT INTO `students` (`id`, `tenant_id`, `documento_identidad`, `tipo_documento`, `nombres`, `apellidos`, `fecha_nacimiento`)
VALUES (
    's9876-uuid-estudiante-0002',
    'IE_TECNICO_INDUSTRIAL',
    '1193456789',
    'TI',
    'Carlos',
    'Gómez',
    '2014-05-12'
);
