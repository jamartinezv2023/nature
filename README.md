
# Auth Microservice - Plataforma Educativa

## Características

- Registro de usuarios
- Inicio de sesión
- Cierre de sesión
- Recuperación de contraseña
- Doble factor de autenticación (2FA)
- OTP vía email
- OTP vía móvil
- Protección CSRF
- Hashing seguro
- Arquitectura desacoplada
- Compatible con CRUD Instituciones

## Tecnologías

- PHP 8
- MySQL/MariaDB
- Bootstrap 5
- PDO
- Arquitectura por capas

## Instalación

1. Crear base de datos
2. Ejecutar migration.sql
3. Configurar config/env.php
4. Servir carpeta public/

## Flujo

Frontend -> Controller -> Service -> Repository -> DB
