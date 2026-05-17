-- Ecosistema Nature SaaS - Estructura de Datos Base (IEEE 730)
-- Configuración de tabla compatible con el aislamiento por Tenant y 2FA

CREATE TABLE IF NOT EXISTS `users` (
    `id` VARCHAR(36) NOT NULL,
    `tenant_id` VARCHAR(50) NOT NULL COMMENT 'Identificador único de la institución educativa',
    `email` VARCHAR(191) NOT NULL,
    `password_hash` VARCHAR(255) NOT NULL,
    `two_factor_secret` VARCHAR(100) DEFAULT NULL,
    `is_two_factor_enabled` TINYINT(1) NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uidx_tenant_email` (`tenant_id`, `email`),
    INDEX `idx_tenant` (`tenant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Registro semilla de prueba (Contraseña por defecto: password123)
-- Representa a un docente de apoyo en la institución técnica industrial con 2FA habilitado
INSERT INTO `users` (`id`, `tenant_id`, `email`, `password_hash`, `two_factor_secret`, `is_two_factor_enabled`) 
VALUES (
    'u4321-uuid-ejemplo-nature-0001', 
    'IE_TECNICO_INDUSTRIAL', 
    'docente@institucion.edu.co', 
    '$2y$10$7R9bZ2p8Eub2MhW6o9vRKeZp3jE8P3X9G7vD0fS1A6K2L3M4N5O6P', 
    'JBSWY3DPEHPK3PXP', 
    1
) ON DUPLICATE KEY UPDATE `id`=`id`;
