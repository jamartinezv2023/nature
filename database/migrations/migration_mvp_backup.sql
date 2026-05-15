
CREATE TABLE usuarios (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nombre VARCHAR(255) NOT NULL,

    email VARCHAR(255) UNIQUE NOT NULL,

    telefono VARCHAR(50),

    password VARCHAR(255) NOT NULL,

    rol ENUM('ADMIN','DOCENTE','ESTUDIANTE','PADRE') DEFAULT 'ESTUDIANTE',

    estado ENUM('ACTIVO','INACTIVO','BLOQUEADO') DEFAULT 'ACTIVO',

    email_verificado BOOLEAN DEFAULT FALSE,

    two_factor_enabled BOOLEAN DEFAULT TRUE,

    failed_attempts INT DEFAULT 0,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE password_resets (

    id INT AUTO_INCREMENT PRIMARY KEY,

    usuario_id INT,

    token VARCHAR(255),

    expira_en DATETIME,

    FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE otp_codes (

    id INT AUTO_INCREMENT PRIMARY KEY,

    usuario_id INT,

    codigo VARCHAR(10),

    canal ENUM('EMAIL','SMS'),

    expira_en DATETIME,

    usado BOOLEAN DEFAULT FALSE,

    FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
);
