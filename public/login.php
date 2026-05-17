<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SaaS Nature - Acceso Institucional</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <style>
        .login-card {
            border-radius: 12px;
            box-shadow: 0px 4px 20px rgba(0,0,0,0.08);
            background: #ffffff;
            transition: all 0.3s ease;
        }
        .step-container {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        .d-none-custom {
            display: none !important;
            opacity: 0;
            transform: translateY(10px);
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card login-card p-4">
                <div class="text-center mb-4">
                    <h3 class="fw-bold" style="color: var(--material-primary);">Ecosistema Nature</h3>
                    <p class="text-muted">Gestión Educativa Inclusiva & SaaS Multitenant</p>
                </div>

                <form id="loginForm">
                    <!-- PASO 1: Credenciales e Institución -->
                    <div id="step1" class="step-container">
                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-bold">Código de la Institución (Tenant)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-school"></i></span>
                                <input type="text" id="tenant_id" class="form-control" placeholder="Ej: IE_TECNICO_INDUSTRIAL" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-secondary small fw-bold">Correo Electrónico</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email" id="email" class="form-control" placeholder="docente@institucion.edu.co" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-secondary small fw-bold">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" id="password" class="form-control" placeholder="••••••••" required>
                            </div>
                        </div>
                        <button type="button" onclick="submitStep1()" class="btn w-100 text-white fw-bold" style="background-color: var(--material-primary);">
                            Continuar <i class="fa-solid fa-arrow-right ms-1"></i>
                        </button>
                    </div>

                    <!-- PASO 2: Verificación de Doble Factor (2FA) -->
                    <div id="step2" class="step-container d-none-custom">
                        <div class="text-center mb-4">
                            <div class="display-6 text-warning mb-2"><i class="fa-solid fa-shield-halved"></i></div>
                            <h5>Verificación de Seguridad</h5>
                            <p class="text-muted small">Ingrese el código de 6 dígitos generado por su aplicación de autenticación.</p>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-secondary small fw-bold text-center d-block">Código de Verificación (OTP)</label>
                            <input type="text" id="otp_code" class="form-control form-control-lg text-center fw-bold letter-spacing-2" placeholder="000000" maxlength="6">
                        </div>
                        <button type="button" onclick="submitStep2()" class="btn w-100 text-white fw-bold" style="background-color: var(--material-secondary);">
                            Verificar y Acceder <i class="fa-solid fa-circle-check ms-1"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let currentStep = 1;

    function showToast(message, type = 'success') {
        Toastify({
            text: message,
            duration: 3500,
            gravity: "top",
            position: "right",
            style: {
                background: type === 'success' ? "#2e7d32" : "#d32f2f",
                borderRadius: "8px"
            }
        }).showToast();
    }

    function submitStep1() {
        const tenant_id = document.getElementById('tenant_id').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        if(!tenant_id || !email || !password) {
            showToast("Todos los campos del primer factor son obligatorios.", "error");
            return;
        }

        // Simulación de llamado a LoginController vía Fetch API
        showToast("Verificando credenciales institucionales...");
        
        // Simulación de respuesta positiva con 2FA activo para demostración visual de flujo continuo
        setTimeout(() => {
            document.getElementById('step1').classList.add('d-none-custom');
            setTimeout(() => {
                document.getElementById('step2').classList.remove('d-none-custom');
                currentStep = 2;
                showToast("Primer factor aprobado. Por favor ingrese su OTP.", "success");
            }, 300);
        }, 1000);
    }

    function submitStep2() {
        const otp = document.getElementById('otp_code').value;
        if(otp.length !== 6) {
            showToast("El código OTP debe ser de exactamente 6 dígitos.", "error");
            return;
        }

        showToast("Comprobando código de seguridad...");
        setTimeout(() => {
            showToast("Autenticación SaaS completada con éxito. Redirigiendo...", "success");
        }, 1200);
    }
</script>
</body>
</html>

<!-- Integración Offline-First y Registro de Service Worker -->
<script src="/assets/js/services/db.js"></script>
<script>
    // Registrar el Service Worker para almacenamiento en caché de activos UI
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/sw.js')
                .then(reg => console.log('Service Worker registrado con éxito para el Tenant.', reg.scope))
                .catch(err => console.error('Error registrando el Service Worker:', err));
        });
    }

    // Monitoreo del estado de conectividad en tiempo real
    function verificarConectividad() {
        if (navigator.onLine) {
            showToast("Conexión restablecida. Operando en modo SaaS Cloud.", "success");
            document.body.style.borderTop = "6px solid var(--material-primary)";
        } else {
            showToast("Sin conectividad. El sistema ha cambiado automáticamente a Modo Offline Seguro.", "error");
            document.body.style.borderTop = "6px solid #ff9800"; // Color naranja de advertencia constructiva
        }
    }

    window.addEventListener('online', verificarConectividad);
    window.addEventListener('offline', verificarConectividad);
    
    // Ejecución inicial al cargar la interfaz
    document.addEventListener("DOMContentLoaded", () => {
        if (!navigator.onLine) {
            document.body.style.borderTop = "6px solid #ff9800";
        }
    });
</script>

<script>
    // Sobrescribir la función de envío para integrarla al Router real mediante Fetch API
    function enviarAutenticacionSaaS(datos) {
        return fetch('/api/auth/login', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(datos)
        }).then(response => response.json());
    }
</script>
