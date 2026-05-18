<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($_SESSION["user"])) { header("Location: /index.php"); exit; }

// Simulación de detección automática de alertas de la Fase 1
$estudiante_mock_id = 42;
$nombre_estudiante_mock = "Juan Carlos Pérez Martínez";
$tiene_alerta_inclusion = true; 
?>
<!DOCTYPE html>
<html lang="es" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NATURESaaS - Diseñador de PIAR Enriquecido</title>
    <script src="https://cdn.tailwindcss.com/3.4.15"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .heading-font { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="p-8 max-w-4xl mx-auto">

    <div class="mb-6 flex justify-between items-center">
        <a href="/dashboard.php" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700 transition-all">
            <i class="fa-solid fa-arrow-left"></i> Panel de Control
        </a>
        <span class="bg-amber-100 text-amber-800 text-xs font-bold px-3 py-1 rounded-full border border-amber-200">
            <i class="fa-solid fa-gavel"></i> Decreto 1421 de 2017
        </span>
    </div>

    <?php if ($tiene_alerta_inclusion): ?>
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden">
        
        <div class="bg-gradient-to-r from-slate-900 to-indigo-950 p-8 text-white">
            <span class="bg-indigo-500/20 text-indigo-300 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-indigo-500/30">Fase 2: Flexibilización Curricular</span>
            <h1 class="heading-font text-2xl font-extrabold mt-3">Diseño del Plan Individual de Ajustes Razonables (PIAR)</h1>
            <p class="text-slate-400 text-sm mt-1">Estudiante vinculado HPI: <strong class="text-white"><?= $nombre_estudiante_mock; ?></strong></p>
        </div>

        <form id="piarForm" class="p-8 space-y-8">
            <input type="hidden" name="estudiante_id" value="<?= $estudiante_mock_id; ?>">

            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200/60">
                <h3 class="heading-font font-bold text-slate-800 flex items-center gap-2 mb-4">
                    <i class="fa-solid fa-ban text-rose-500"></i> 1. Identificación de Barreras Contextuales
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Barreras en el Contexto Escolar / Aula</label>
                        <textarea name="barreras[escolar]" rows="2" placeholder="Ej: Dificultad de acceso a material escrito visual, barreras arquitectónicas..." class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white font-medium focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all" required></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Barreras Sociales o Actitudinales</label>
                        <textarea name="barreras[social]" rows="2" placeholder="Describa dinámicas del grupo o entorno familiar si aplica..." class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white font-medium focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all"></textarea>
                    </div>
                </div>
            </div>

            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200/60">
                <h3 class="heading-font font-bold text-slate-800 flex items-center gap-2 mb-4">
                    <i class="fa-solid fa-sliders text-emerald-500"></i> 2. Ajustes Razonables de Implementación Coherente
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Ajustes en Metodología / Didáctica</label>
                        <textarea name="ajustes[metodologia]" rows="3" placeholder="Ej: Uso de macrotipos, lectores de pantalla, segmentación de actividades..." class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white font-medium focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all" required></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Ajustes en la Evaluación</label>
                        <textarea name="ajustes[evaluacion]" rows="3" placeholder="Ej: Evaluaciones orales estructuradas, flexibilidad de tiempos de entrega..." class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-white font-medium focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all" required></textarea>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-500 mb-2">Objetivos de Aprendizaje Específicos y Flexibles</label>
                <textarea name="objetivos[metas]" rows="3" placeholder="Defina las competencias mínimas priorizadas para el año lectivo corriente..." class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 font-medium focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all" required></textarea>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-indigo-600/20 hover:bg-indigo-700 transition-all flex items-center justify-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i> Consolidar PIAR y Activar Historial HPI
                </button>
            </div>
        </form>
    </div>
    <?php else: ?>
    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-xl text-center">
        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto text-slate-400 text-2xl mb-4">
            <i class="fa-solid fa-folder-minus"></i>
        </div>
        <h2 class="heading-font text-xl font-bold text-slate-900">Módulo PIAR en Espera</h2>
        <p class="text-slate-500 text-sm mt-1 max-w-md mx-auto">Este estudiante no posee registros de condiciones o alertas pedagógicas iniciales activas en su Historia Pedagógica Interoperable.</p>
    </div>
    <?php endif; ?>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        const form = document.getElementById('piarForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                fetch('piar-procesar.php', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if(data.status === 'success') {
                        Toastify({
                            text: "🚀 " + data.message,
                            duration: 5000,
                            style: { background: "linear-gradient(to right, #6366f1, #4f46e5)", borderRadius: "12px" }
                        }).showToast();
                    } else {
                        Toastify({
                            text: "❌ Error: " + data.message,
                            duration: 4000,
                            style: { background: "linear-gradient(to right, #f43f5e, #e11d48)", borderRadius: "12px" }
                        }).showToast();
                    }
                })
                .catch(() => {
                    Toastify({
                        text: "💥 Falla de comunicación de red interna con el backend.",
                        duration: 4000,
                        style: { background: "linear-gradient(to right, #f43f5e, #e11d48)", borderRadius: "12px" }
                    }).showToast();
                });
            });
        }
    </script>
</body>
</html>
