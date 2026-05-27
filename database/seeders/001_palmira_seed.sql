INSERT INTO tenants (
    uuid,
    name,
    slug
)
VALUES (
    'tenant-sagrada-familia',
    'Institución Educativa Sagrada Familia',
    'sagrada-familia'
);

INSERT INTO institutions (
    tenant_id,
    dane_code,
    name,
    city,
    department
)
VALUES (
    1,
    '176520000001',
    'Institución Educativa Sagrada Familia',
    'Palmira',
    'Valle del Cauca'
);

INSERT INTO campuses (
    institution_id,
    name
)
VALUES
(1, 'Sede Central'),
(1, 'María Montessori'),
(1, 'El Paraíso');

INSERT INTO users (
    tenant_id,
    full_name,
    email,
    password,
    role
)
VALUES (
    1,
    'José Alfredo Martínez Valdés',
    'jamartinezv2020@gmail.com',
    '$2y$10$Xm6G.D1YUFpaip2g06soROP5IssSxp.qIsjGNPsYHlbiK6BXm/yoy',
    'super_admin'
);
