<!-- ===================================================== -->
<!-- ARCHIVO: /public/index.php -->
<!-- LOGIN SaaS RESPONSIVE COMPLETO -->
<!-- ===================================================== -->

<?php

$error = $_GET['error'] ?? null;
$registered = $_GET['registered'] ?? null;
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        PRICA NATURE SaaS
    </title>

    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <!-- CSS -->

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >

</head>

<body>

    <div class="container-fluid min-vh-100">

        <div class="row min-vh-100">

            <!-- PANEL IZQUIERDO -->

            <div
                class="col-lg-6 d-none d-lg-flex login-banner"
            >

                <div class="overlay"></div>

                <div class="banner-content">

                    <h1>
                        PRICA NATURE
                    </h1>

                    <p>
                        Plataforma SaaS Inteligente
                        para Gestión Ambiental Escolar
                    </p>

                </div>

            </div>

            <!-- LOGIN -->

            <div
                class="col-lg-6 d-flex align-items-center justify-content-center p-3"
            >

                <div class="card login-card shadow-lg">

                    <div class="card-body p-4 p-md-5">

                        <div class="text-center mb-4">

                            <h2 class="fw-bold">
                                Login Institucional
                            </h2>

                            <p class="text-muted">
                                Acceso seguro multi-tenant
                            </p>

                        </div>

                        <?php if($error): ?>

                            <div class="alert alert-danger">

                                Usuario o contraseña incorrectos

                            </div>

                        <?php endif; ?>

                        <?php if($registered): ?>

                            <div class="alert alert-success">

                                Usuario registrado correctamente

                            </div>

                        <?php endif; ?>

                        <form
                            action="auth.php?action=login"
                            method="POST"
                        >

                            <!-- EMAIL -->

                            <div class="mb-3">

                                <label class="form-label">

                                    Correo electrónico

                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">

                                        <i class="bi bi-envelope"></i>

                                    </span>

                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        placeholder="usuario@dominio.com"
                                        required
                                        autocomplete="email"
                                    >

                                </div>

                            </div>

                            <!-- PASSWORD -->

                            <div class="mb-4">

                                <label class="form-label">

                                    Contraseña

                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">

                                        <i class="bi bi-lock"></i>

                                    </span>

                                    <input
                                        type="password"
                                        name="password"
                                        class="form-control"
                                        placeholder="Ingrese su contraseña"
                                        required
                                        autocomplete="current-password"
                                    >

                                </div>

                            </div>

                            <!-- BOTÓN -->

                            <button
                                class="btn btn-success w-100 btn-lg"
                                type="submit"
                            >

                                <i class="bi bi-box-arrow-in-right"></i>

                                Ingresar

                            </button>

                        </form>

                        <!-- LINKS -->

                        <div class="mt-4 text-center">

                            <a
                                href="register.php"
                                class="d-block mb-2"
                            >
                                Registrarse
                            </a>

                            <a
                                href="forgot-password.php"
                                class="d-block"
                            >
                                Recuperar contraseña
                            </a>

                        </div>

                        <!-- DEMO -->

                        <div class="alert alert-info mt-4 small">

                            <strong>
                                SUPERADMIN SaaS:
                            </strong>

                            <br>

                            josealfredomartinezvaldes@gmail.com

                            <br>

                            Colombia*2026

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>