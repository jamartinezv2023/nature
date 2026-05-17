<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nature Platform</title>

    <link rel="stylesheet" href="/assets/css/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/4ad53f5d4b.js" crossorigin="anonymous"></script>
</head>

<body>

<div class="auth-layout">

    <div class="auth-left">

        <h1>Nature Platform</h1>

        <p>
            Plataforma educativa inteligente con accesibilidad,
            analítica avanzada, autenticación segura y experiencia
            enterprise de nueva generación.
        </p>

        <div class="feature-grid">

            <div class="feature-card">
                <i class="fa-solid fa-shield-halved"></i>
                <h3>Seguridad avanzada</h3>
                <p>Autenticación OTP y protección empresarial moderna.</p>
            </div>

            <div class="feature-card">
                <i class="fa-solid fa-chart-line"></i>
                <h3>Analítica inteligente</h3>
                <p>Dashboard avanzado con métricas y monitoreo en tiempo real.</p>
            </div>

            <div class="feature-card">
                <i class="fa-solid fa-universal-access"></i>
                <h3>Accesibilidad</h3>
                <p>Diseño inclusivo adaptable a cualquier usuario.</p>
            </div>

            <div class="feature-card">
                <i class="fa-solid fa-mobile-screen"></i>
                <h3>Responsive</h3>
                <p>Experiencia optimizada para cualquier dispositivo.</p>
            </div>

        </div>

    </div>

    <div class="auth-right">

        <div class="auth-card">

            <h2>Iniciar sesión</h2>

            <p>
                Acceda a la plataforma empresarial Nature.
            </p>

            <form method="POST" action="/login">

                <input
                    class="auth-input"
                    type="email"
                    name="email"
                    placeholder="usuario@correo.com"
                    required
                >

                <input
                    class="auth-input"
                    type="password"
                    name="password"
                    placeholder="********"
                    required
                >

                <button class="auth-btn" type="submit">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Ingresar al sistema
                </button>

            </form>

            <div class="auth-footer">
                © 2026 Nature Platform
            </div>

        </div>

    </div>

</div>

</body>
</html>
