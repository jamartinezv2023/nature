<?php

if (!isset($_SESSION["user"])) {
    header("Location: /");
    exit;
}

$user = $_SESSION["user"];
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Dashboard Nature</title>

<link rel="stylesheet"
href="/assets/css/dashboard.css">

<link rel="preconnect"
href="https://fonts.googleapis.com">

<link rel="preconnect"
href="https://fonts.gstatic.com"
crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
rel="stylesheet">

</head>

<body>

<div class="dashboard-layout">

    <aside class="sidebar">

        <div class="brand">
            Nature
        </div>

        <nav class="menu">

            <a href="#" class="active">
                Dashboard
            </a>

            <a href="#">
                Usuarios
            </a>

            <a href="#">
                Instituciones
            </a>

            <a href="#">
                Académico
            </a>

            <a href="#">
                Analítica IA
            </a>

            <a href="#">
                Accesibilidad
            </a>

        </nav>

        <a href="/" class="logout-btn">
            Cerrar sesión
        </a>

    </aside>

    <main class="main-content">

        <header class="topbar">

            <div>

                <h1>
                    Plataforma Educativa Inteligente
                </h1>

                <p>
                    Sistema moderno, inclusivo y adaptable.
                </p>

            </div>

            <div class="user-avatar">
                <?= strtoupper(substr($user, 0, 1)); ?>
            </div>

        </header>

        <section class="stats-grid">

            <div class="stat-card">
                <h3>Usuarios activos</h3>
                <span>1,250</span>
            </div>

            <div class="stat-card">
                <h3>Instituciones</h3>
                <span>24</span>
            </div>

            <div class="stat-card">
                <h3>Sesiones</h3>
                <span>5,800</span>
            </div>

            <div class="stat-card">
                <h3>Precisión IA</h3>
                <span>98%</span>
            </div>

        </section>

        <section class="panel">

            <h2>
                Bienvenido <?= $user; ?>
            </h2>

            <p>
                El dashboard enterprise funciona correctamente.
            </p>

        </section>

    </main>

</div>

</body>
</html>
