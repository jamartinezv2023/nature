<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION["user"])) { header("Location: /index.php"); exit; }

$userData = $_SESSION["user"];
$rawName = is_array($userData) ? ($userData['nombre'] ?? $userData['email'] ?? 'Usuario') : $userData;

// Saneamiento Multibyte para nombres como "José Alfredo Martínez Valdés"
if (mb_detect_encoding($rawName, 'UTF-8', true) === false || strpos($rawName, 'Ã') !== false) {
    $userDisplay = mb_convert_encoding($rawName, 'UTF-8', 'ISO-8859-1', 'Windows-1252');
} else { $userDisplay = $rawName; }
?>
<!DOCTYPE html>
<html lang="es" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NATURESaaS - Centro de Mando Estratégico</title>
    <script src="https://cdn.tailwindcss.com/3.4.15"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap-grid.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .heading-font { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.3); }
        .sidebar-link { transition: all 0.2s ease; }
        .sidebar-link:hover { transform: translateX(5px); }
    </style>
</head>
<body class="h-full text-slate-800 antialiased flex overflow-hidden">

    <aside class="w-72 bg-slate-900 text-slate-300 flex flex-col justify-between border-r border-slate-800 z-20 shrink-0">
        <div>
            <div class="h-20 flex items-center px-8 border-b border-slate-800 gap-3">
                <div class="w-9 h-9 rounded-xl bg-emerald-500 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-emerald-500/30">N</div>
                <div class="flex flex-col">
                    <span class="heading-font text-white font-extrabold text-lg tracking-tight">NATURE<span class="text-emerald-400">SaaS</span></span>
                    <span class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Ecosystem v1.0</span>
                </div>
            </div>
            <nav class="p-4 space-y-1.5">
                <p class="px-4 text-[10px] font-bold tracking-widest text-slate-500 uppercase mb-3">Módulos Inteligentes</p>
                <a href="#" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-500 text-white font-semibold shadow-md">
                    <i class="fa-solid fa-chart-pie w-5"></i> General
                </a>
                <a href="core/fase1_hpi_curricular/hpi-formulario.php" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-slate-100 font-medium">
                    <i class="fa-solid fa-id-card-clip w-5"></i> Registro HPI
                </a>
                <a href="core/fase2_piar_inclusion/piar-formulario.php" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-slate-100 font-medium">
                    <i class="fa-solid fa-user-shield w-5 text-indigo-400"></i> Módulo PIAR
                </a>
                <a href="core/fase3_ambiental/ambiental-formulario.php" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-slate-100 font-medium">
                    <i class="fa-solid fa-leaf w-5 text-emerald-400"></i> Gestión Ambiental
                </a>
                <a href="core/fase4_ia_analytics/ia-dashboard.php" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-slate-100 font-medium">
                    <i class="fa-solid fa-brain w-5 text-purple-400"></i> Analítica IA
                </a>
            </nav>
        </div>
        <div class="p-4 border-t border-slate-800">
            <a href="/index.php" class="flex items-center justify-center gap-2 w-full py-3 px-4 text-sm font-semibold rounded-xl bg-slate-800 text-rose-400 hover:bg-rose-500 hover:text-white transition-all">
                <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión
            </a>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-full overflow-y-auto">
        <header class="h-20 border-b border-slate-200 bg-white/80 backdrop-blur-md px-8 flex items-center justify-between sticky top-0 z-10 shrink-0">
            <div class="flex flex-col">
                <h1 class="heading-font text-xl font-bold text-slate-900 tracking-tight tracking-tight">Plataforma Educativa Inteligente</h1>
                <p class="text-xs text-slate-500 font-medium hidden sm:block">Sistema moderno, inclusivo y adaptable para Instituciones Educativas.</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-slate-900 leading-none mb-1"><?= htmlspecialchars($userDisplay); ?></p>
                    <p class="text-[10px] font-extrabold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded uppercase border border-emerald-100">Superadmin</p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-slate-800 to-slate-950 flex items-center justify-center text-white font-bold text-lg shadow-md border-2 border-white">
                    <?= strtoupper(substr(htmlspecialchars($userDisplay), 0, 1)); ?>
                </div>
            </div>
        </header>

        <main class="p-8 space-y-8 max-w-7xl w-full mx-auto">
            
            <section class="relative bg-slate-900 rounded-[2rem] p-10 overflow-hidden text-white shadow-2xl">
                <div class="absolute right-0 top-0 w-1/2 h-full bg-gradient-to-l from-emerald-500/10 to-transparent"></div>
                <div class="relative z-10">
                    <span class="bg-emerald-500/20 text-emerald-400 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-emerald-500/30">Identidad 3FN Verificada</span>
                    <h2 class="heading-font text-4xl font-extrabold mt-4 tracking-tight">¡Bienvenido al Futuro, <?= htmlspecialchars($userDisplay); ?>!</h2>
                    <p class="mt-2 text-slate-400 text-sm max-w-2xl leading-relaxed">Su ecosistema educativo ahora integra Historia Pedagógica Interoperable, Inclusión PIAR, Seguimiento Ambiental y Analítica Predictiva con IA.</p>
                </div>
            </section>

            <section class="row g-4">
                <div class="col-12 col-md-3">
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all">
                        <p class="text-[10px] font-bold uppercase text-slate-400 tracking-widest">HPI Sincronizadas</p>
                        <h3 class="text-2xl font-black text-slate-900 mt-1">1,250</h3>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all">
                        <p class="text-[10px] font-bold uppercase text-slate-400 tracking-widest">Ajustes PIAR</p>
                        <h3 class="text-2xl font-black text-indigo-600 mt-1">142</h3>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all">
                        <p class="text-[10px] font-bold uppercase text-slate-400 tracking-widest">Evidencias PRAE</p>
                        <h3 class="text-2xl font-black text-emerald-600 mt-1">5,800</h3>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all">
                        <p class="text-[10px] font-bold uppercase text-slate-400 tracking-widest">Precisión IA</p>
                        <h3 class="text-2xl font-black text-purple-600 mt-1">98.4%</h3>
                    </div>
                </div>
            </section>

            <section>
                <h3 class="heading-font text-lg font-bold text-slate-900 mb-5 flex items-center gap-2">
                    <i class="fa-solid fa-rocket text-emerald-500"></i> Acciones del Ecosistema
                </h3>
                <div class="row g-4">
                    <div class="col-12 col-md-6 col-lg-3">
                        <a href="core/fase1_hpi_curricular/hpi-formulario.php" class="block group">
                            <div class="bg-white p-6 rounded-[1.5rem] border border-slate-200 shadow-sm hover:border-emerald-500/50 hover:shadow-xl hover:shadow-emerald-500/5 transition-all h-full">
                                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-id-card"></i>
                                </div>
                                <h4 class="font-bold text-slate-900">Registro HPI</h4>
                                <p class="text-xs text-slate-500 mt-2 leading-relaxed">Cree la Historia Pedagógica Interoperable única para nuevos estudiantes.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <a href="core/fase2_piar_inclusion/piar-formulario.php" class="block group">
                            <div class="bg-white p-6 rounded-[1.5rem] border border-slate-200 shadow-sm hover:border-indigo-500/50 hover:shadow-xl hover:shadow-indigo-500/5 transition-all h-full">
                                <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-500 flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-universal-access"></i>
                                </div>
                                <h4 class="font-bold text-slate-900">Diseñador PIAR</h4>
                                <p class="text-xs text-slate-500 mt-2 leading-relaxed">Gestione los Planes Individuales de Ajustes Razonables (Dec. 1421).</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <a href="core/fase3_ambiental/ambiental-formulario.php" class="block group">
                            <div class="bg-white p-6 rounded-[1.5rem] border border-slate-200 shadow-sm hover:border-teal-500/50 hover:shadow-xl hover:shadow-teal-500/5 transition-all h-full">
                                <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-leaf"></i>
                                </div>
                                <h4 class="font-bold text-slate-900">Gestión Ambiental</h4>
                                <p class="text-xs text-slate-500 mt-2 leading-relaxed">Capture evidencias documentales PRAE de forma transversal.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <a href="core/fase4_ia_analytics/ia-dashboard.php" class="block group">
                            <div class="bg-white p-6 rounded-[1.5rem] border border-slate-200 shadow-sm hover:border-purple-500/50 hover:shadow-xl hover:shadow-purple-500/5 transition-all h-full">
                                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-brain"></i>
                                </div>
                                <h4 class="font-bold text-slate-900">IA Predictiva</h4>
                                <p class="text-xs text-slate-500 mt-2 leading-relaxed">Ejecute modelos de Machine Learning y prevención de deserción.</p>
                            </div>
                        </a>
                    </div>
                </div>
            </section>

        </main>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Toastify({
                text: "🌌 Ecosistema NATURESaaS v1.0 Cargado.",
                duration: 4000,
                close: true,
                gravity: "top", position: "right",
                style: { background: "linear-gradient(to right, #0f172a, #334155)", borderRadius: "14px", fontFamily: "'Plus Jakarta Sans', sans-serif" }
            }).showToast();
        });
    </script>
</body>
</html>
