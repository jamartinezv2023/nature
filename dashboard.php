<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION["user"])) { header("Location: /index.php"); exit; }

$userData = $_SESSION["user"];
$rawName = is_array($userData) ? ($userData['nombre'] ?? $userData['email'] ?? 'Usuario') : $userData;

if (mb_detect_encoding($rawName, 'UTF-8', true) === false || strpos($rawName, 'Ã') !== false) {
    $userDisplay = mb_convert_encoding($rawName, 'UTF-8', 'ISO-8859-1, Windows-1252');
} else {
    $userDisplay = $rawName;
}
?>
<!DOCTYPE html>
<html lang="es" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NATURESaaS - Panel Inteligente</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4/dist/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap-grid.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .heading-font { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar-link { transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1); }
        .sidebar-link:hover { transform: translateX(4px); }
    </style>
</head>
<body class="h-full text-slate-800 antialiased flex overflow-hidden">
    <aside class="w-72 bg-slate-900 text-slate-300 flex flex-col justify-between border-r border-slate-800 z-20 shrink-0">
        <div>
            <div class="h-20 flex items-center px-8 border-b border-slate-800 gap-3">
                <div class="w-9 h-9 rounded-xl bg-emerald-500 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-emerald-500/30">N</div>
                <div class="flex flex-col">
                    <span class="heading-font text-white font-extrabold text-lg tracking-tight">NATURE<span class="text-emerald-400">SaaS</span></span>
                    <span class="text-xs text-slate-500 font-medium tracking-wide uppercase">Core Platform</span>
                </div>
            </div>
            <nav class="p-4 space-y-1.5">
                <p class="px-4 text-[11px] font-bold tracking-wider text-slate-500 uppercase mb-3">Módulos del Sistema</p>
                <a href="#" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-500 text-white font-semibold shadow-md shadow-emerald-500/10">
                    <i class="fa-solid fa-chart-pie w-5"></i> Dashboard
                </a>
                <a href="#" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-slate-800/60 hover:text-slate-200 font-medium">
                    <i class="fa-solid fa-users w-5 text-slate-500"></i> Usuarios
                </a>
                <a href="#" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-slate-800/60 hover:text-slate-200 font-medium">
                    <i class="fa-solid fa-school w-5 text-slate-500"></i> Instituciones
                </a>
                <a href="#" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-slate-800/60 hover:text-slate-200 font-medium">
                    <i class="fa-solid fa-brain w-5 text-slate-500"></i> Analítica IA
                </a>
            </nav>
        </div>
        <div class="p-4 border-t border-slate-800">
            <a href="/index.php" class="flex items-center justify-center gap-2 w-full py-3 px-4 text-sm font-semibold rounded-xl bg-slate-800 text-rose-400 hover:bg-rose-500 hover:text-white transition-all duration-200 shadow-sm">
                <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión
            </a>
        </div>
    </aside>
    <div class="flex-1 flex flex-col h-full overflow-y-auto">
        <header class="h-20 border-b border-slate-200 bg-white/80 backdrop-blur-md px-8 flex items-center justify-between sticky top-0 z-10 shrink-0">
            <div class="flex flex-col">
                <h1 class="heading-font text-xl font-bold text-slate-900 tracking-tight">Plataforma Educativa Inteligente</h1>
                <p class="text-xs text-slate-500 font-medium hidden sm:block">Sistema moderno, inclusivo y adaptable.</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-slate-900 leading-none mb-1"><?= htmlspecialchars($userDisplay); ?></p>
                    <p class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md inline-block">Superadmin</p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-600 flex items-center justify-center text-white font-bold text-lg shadow-md ring-2 ring-white">
                    <?= strtoupper(substr(htmlspecialchars($userDisplay), 0, 1)); ?>
                </div>
            </div>
        </header>
        <main class="p-8 space-y-8 max-w-7xl w-full mx-auto">
            <section class="relative bg-slate-900 rounded-3xl p-8 overflow-hidden text-white shadow-xl">
                <div class="relative z-10">
                    <span class="bg-emerald-500/10 text-emerald-400 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-emerald-500/20">Módulo Verificado</span>
                    <h2 class="heading-font text-3xl font-extrabold mt-4">¡Bienvenido de vuelta, <?= htmlspecialchars($userDisplay); ?>!</h2>
                    <p class="mt-2 text-slate-400 text-sm">Infraestructura multi-tenant conectada para la Institución Educativa Sagrada Familia (3FN).</p>
                </div>
            </section>
            <section class="row g-4">
                <div class="col-12 col-sm-6 col-lg-3"><div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between"><div><p class="text-xs font-bold uppercase text-slate-400">Usuarios</p><h3 class="text-2xl font-extrabold text-slate-900">1,250</h3></div><div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center text-xl"><i class="fa-solid fa-user-check"></i></div></div></div>
                <div class="col-12 col-sm-6 col-lg-3"><div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between"><div><p class="text-xs font-bold uppercase text-slate-400">Escuelas</p><h3 class="text-2xl font-extrabold text-slate-900">24</h3></div><div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center text-xl"><i class="fa-solid fa-building-columns"></i></div></div></div>
                <div class="col-12 col-sm-6 col-lg-3"><div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between"><div><p class="text-xs font-bold uppercase text-slate-400">Sesiones</p><h3 class="text-2xl font-extrabold text-slate-900">5,800</h3></div><div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-500 flex items-center justify-center text-xl"><i class="fa-solid fa-bolt"></i></div></div></div>
                <div class="col-12 col-sm-6 col-lg-3"><div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between"><div><p class="text-xs font-bold uppercase text-slate-400">Precisión IA</p><h3 class="text-2xl font-extrabold text-emerald-600">98.4%</h3></div><div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center text-xl"><i class="fa-solid fa-chart-line"></i></div></div></div>
            </section>
        </main>
    </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Toastify({
                text: "🚀 Autenticación 2FA Verificada. ¡Acceso concedido!",
                duration: 4000,
                close: true,
                gravity: "top", position: "right",
                style: { background: "linear-gradient(to right, #10b981, #059669)", borderRadius: "14px", fontFamily: "'Plus Jakarta Sans', sans-serif", fontWeight: "600" }
            }).showToast();
        });
    </script>
</body>
</html>
