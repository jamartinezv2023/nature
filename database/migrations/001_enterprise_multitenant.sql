CREATE TABLE tenants (

    id INTEGER PRIMARY KEY AUTOINCREMENT,

    uuid VARCHAR(100) UNIQUE NOT NULL,

    name VARCHAR(255) NOT NULL,

    slug VARCHAR(255) UNIQUE NOT NULL,

    status VARCHAR(50) DEFAULT 'active',

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE institutions (

    id INTEGER PRIMARY KEY AUTOINCREMENT,

    tenant_id INTEGER NOT NULL,

    dane_code VARCHAR(50),

    name VARCHAR(255) NOT NULL,

    city VARCHAR(100),

    department VARCHAR(100),

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (tenant_id)
        REFERENCES tenants(id)
);

CREATE TABLE campuses (

    id INTEGER PRIMARY KEY AUTOINCREMENT,

    institution_id INTEGER NOT NULL,

    name VARCHAR(255) NOT NULL,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (institution_id)
        REFERENCES institutions(id)
);

CREATE TABLE users (

    id INTEGER PRIMARY KEY AUTOINCREMENT,

    tenant_id INTEGER NOT NULL,

    full_name VARCHAR(255) NOT NULL,

    email VARCHAR(255) UNIQUE NOT NULL,

    password VARCHAR(255) NOT NULL,

    role VARCHAR(100) DEFAULT 'admin',

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (tenant_id)
        REFERENCES tenants(id)
);

CREATE TABLE otp_tokens (

    id INTEGER PRIMARY KEY AUTOINCREMENT,

    user_id INTEGER NOT NULL,

    otp_code VARCHAR(10) NOT NULL,

    expires_at DATETIME,

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id)
        REFERENCES users(id)
);

CREATE TABLE audit_logs (

    id INTEGER PRIMARY KEY AUTOINCREMENT,

    tenant_id INTEGER,

    action VARCHAR(255),

    ip_address VARCHAR(100),

    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
