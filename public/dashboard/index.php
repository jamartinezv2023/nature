
<?php

if (!isset($_SESSION['usuario_id'])) {

    header('Location: /');

    exit;
}
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
Nature Platform Dashboard
</title>

<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
>

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
/>

<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css"
/>

<link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet"
>

<link
    rel="stylesheet"
    href="/assets/css/dashboard.css"
>

</head>

<body>

<div class="wrapper">

```
<!-- SIDEBAR -->

<aside
    id="sidebar"
    class="sidebar"
>

    <div class="sidebar-header">

        <h2>
            Nature
        </h2>

        <button
            id="closeSidebar"
            class="close-btn"
        >
            <i class="fa-solid fa-xmark"></i>
        </button>

    </div>

    <ul class="sidebar-menu">

        <li>
            <a href="#">
                <i class="fa-solid fa-chart-line"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fa-solid fa-users"></i>
                Usuarios
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fa-solid fa-school"></i>
                Instituciones
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fa-solid fa-book"></i>
                Académico
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fa-solid fa-chart-pie"></i>
                Analítica
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fa-solid fa-universal-access"></i>
                Accesibilidad
            </a>
        </li>

        <li>
            <a href="/logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                Cerrar sesión
            </a>
        </li>

    </ul>

</aside>

<!-- CONTENT -->

<div class="main">

    <!-- NAVBAR -->

    <nav class="navbar-custom">

        <div class="navbar-left">

            <button
                id="toggleSidebar"
                class="hamburger"
            >
                <i class="fa-solid fa-bars"></i>
            </button>

            <h1>
                Dashboard
            </h1>

        </div>

        <div class="navbar-right">

            <button
                id="notifyBtn"
                class="notify-btn"
            >
                <i class="fa-solid fa-bell"></i>
            </button>

            <div class="avatar">

                JM

            </div>

        </div>

    </nav>

    <!-- HERO -->

    <section class="hero">

        <div class="hero-content">

            <h2>
                Plataforma Educativa Inteligente
            </h2>

            <p>
                Sistema moderno, accesible, inclusivo y adaptativo.
            </p>

        </div>

    </section>

    <!-- CARDS -->

    <section class="cards">

        <div class="card-dashboard">

            <i class="fa-solid fa-users"></i>

            <h3>
                1,250
            </h3>

            <p>
                Usuarios activos
            </p>

        </div>

        <div class="card-dashboard">

            <i class="fa-solid fa-school"></i>

            <h3>
                24
            </h3>

            <p>
                Instituciones
            </p>

        </div>

        <div class="card-dashboard">

            <i class="fa-solid fa-chart-line"></i>

            <h3>
                5,800
            </h3>

            <p>
                Sesiones
            </p>

        </div>

        <div class="card-dashboard">

            <i class="fa-solid fa-shield-heart"></i>

            <h3>
                100%
            </h3>

            <p>
                Accesibilidad
            </p>

        </div>

    </section>

    <!-- TABLE -->

    <section class="table-section">

        <div class="table-responsive">

            <table class="table table-hover">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Institución</th>

                        <th>Estado</th>

                        <th>Usuarios</th>

                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td>1</td>

                        <td>
                            I.E. Sagrada Familia
                        </td>

                        <td>
                            <span class="badge bg-success">
                                Activo
                            </span>
                        </td>

                        <td>560</td>

                    </tr>

                    <tr>

                        <td>2</td>

                        <td>
                            María Montessori
                        </td>

                        <td>
                            <span class="badge bg-success">
                                Activo
                            </span>
                        </td>

                        <td>320</td>

                    </tr>

                </tbody>

            </table>

        </div>

    </section>

    <!-- FOOTER -->

    <footer class="footer">

        <p>
            © 2026 Nature Platform · Inclusión · Accesibilidad · UX
        </p>

    </footer>

</div>
```

</div>

<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script src="/assets/js/dashboard.js"></script>

</body>

</html>
